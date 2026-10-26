<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\FnStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\ResponseInterface;

final class GuzzleTransport implements HttpTransport
{
    public const DEFAULT_MAX_RESPONSE_BODY_BYTES = 134217728;

    private ClientInterface $client;

    public function __construct(
        ?ClientInterface $client = null,
        private readonly int $max_response_body_bytes = self::DEFAULT_MAX_RESPONSE_BODY_BYTES
    ) {
        if ($this->max_response_body_bytes <= 0) {
            throw new \InvalidArgumentException('max_response_body_bytes must be a positive integer');
        }

        $this->client = $client ?? new Client();
    }

    public function sendRequest(HttpRequestData $request): HttpResponseData
    {
        $resource = Utils::tryFopen('php://temp', 'w+');
        $buffer = Utils::streamFor($resource);
        $sink = FnStream::decorate($buffer, [
            'write' => function (string $chunk) use ($buffer): int {
                if ($buffer->tell() + strlen($chunk) > $this->max_response_body_bytes) {
                    throw new TransportException(
                        'Response body exceeded max size of ' . $this->max_response_body_bytes . ' bytes'
                    );
                }
                return $buffer->write($chunk);
            },
        ]);
        $onHeaders = $this->client->getConfig('on_headers');
        try {
            $response = $this->client->send(
                new Request($request->method, $request->url, $request->headers, $request->body),
                [
                    'http_errors' => false,
                    // cURL enforces connection and low-speed timeouts; the sink bounds decoded bytes.
                    'stream' => false,
                    'sink' => $sink,
                    'read_timeout' => $request->read_timeout,
                    'on_headers' => static function ($response) use ($resource, $buffer, $onHeaders): void {
                        ftruncate($resource, 0);
                        $buffer->rewind();
                        if ($onHeaders !== null && $response instanceof ResponseInterface) {
                            $onHeaders($response);
                        }
                    },
                    'connect_timeout' => $request->connect_timeout,
                    'curl' => [
                        \CURLOPT_LOW_SPEED_LIMIT => 1,
                        \CURLOPT_LOW_SPEED_TIME => max(1, (int) ceil($request->read_timeout)),
                    ],
                ]
            );

            $stream = $response->getBody();
            if ($stream->isSeekable()) {
                $stream->rewind();
            } elseif ($stream->eof() && $buffer->tell() > 0) {
                $stream = $sink;
                $stream->rewind();
            }
            $chunks = [];
            $bodyBytes = 0;
            while (!$stream->eof()) {
                $chunk = $stream->read(8192);
                if ($chunk === '') {
                    continue;
                }

                $bodyBytes += strlen($chunk);
                if ($bodyBytes > $this->max_response_body_bytes) {
                    throw new TransportException(
                        'Response body exceeded max size of ' . $this->max_response_body_bytes . ' bytes'
                    );
                }

                $chunks[] = $chunk;
            }
            $body = implode('', $chunks);

            /** @var array<string, array<int, string>> $headers */
            $headers = $response->getHeaders();

            return new HttpResponseData(
                status_code: $response->getStatusCode(),
                body: $body,
                headers: $headers
            );
        } catch (ConnectException $error) {
            if ($this->isTimeoutException($error)) {
                throw new RequestTimeoutException(
                    'HTTP request timed out',
                    $this->redactError($error)
                );
            }

            throw new TransportException('HTTP transport error', $this->redactError($error));
        } catch (RequestException $error) {
            if ($this->isTimeoutException($error)) {
                throw new RequestTimeoutException(
                    'HTTP request timed out',
                    $this->redactError($error)
                );
            }

            throw new TransportException('HTTP transport error', $this->redactError($error));
        } catch (GuzzleException $error) {
            throw new TransportException('HTTP transport error', $this->redactError($error));
        } finally {
            if (isset($response)) {
                $response->getBody()->close();
            }
            $sink->close();
        }
    }

    public function close(): void
    {
    }

    private function redactError(GuzzleException $error): \Throwable
    {
        $message = self::redactApiKey($error->getMessage());
        $previous = $error->getPrevious();
        $safePrevious = $previous === null ? null : new \RuntimeException(
            self::redactApiKey($previous->getMessage()),
            (int) $previous->getCode()
        );
        if ($error instanceof ConnectException || $error instanceof RequestException) {
            $request = $error->getRequest();
            $uri = $request->getUri();
            $request = $request->withUri($uri->withQuery(substr(self::redactApiKey('?' . $uri->getQuery()), 1)));
            $context = $error->getHandlerContext();
            array_walk_recursive($context, static function (&$value): void {
                if (is_string($value)) {
                    $value = self::redactApiKey($value);
                }
            });
            $class = $error::class;
            $base = $error instanceof ConnectException ? ConnectException::class : RequestException::class;
            // Custom exception subclasses may require a different constructor signature.
            if ((new \ReflectionMethod($class, '__construct'))->getDeclaringClass()->getName() !== $base) {
                $class = $base;
            }
            if ($error instanceof ConnectException) {
                return new $class($message, $request, $safePrevious, $context);
            }
            return new $class($message, $request, $error->getResponse(), $safePrevious, $context);
        }
        return new TransferException($message, (int) $error->getCode(), $safePrevious);
    }

    private static function redactApiKey(string $text): string
    {
        return preg_replace('/([?&]apiKey=)[^&#\s]+/i', '$1[REDACTED]', $text) ?? $text;
    }

    private function isTimeoutException(\Throwable $error): bool
    {
        if (method_exists($error, 'getHandlerContext')) {
            /** @var array<string, mixed> $context */
            $context = $error->getHandlerContext();
            if (($context['errno'] ?? null) === 28) {
                return true;
            }
        }

        return str_contains(strtolower($error->getMessage()), 'timed out');
    }
}
