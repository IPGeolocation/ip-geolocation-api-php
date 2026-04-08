<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

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
        try {
            $response = $this->client->send(
                new Request($request->method, $request->url, $request->headers, $request->body),
                [
                    'http_errors' => false,
                    'stream' => true,
                    'connect_timeout' => $request->connect_timeout,
                    'curl' => [
                        \CURLOPT_LOW_SPEED_LIMIT => 1,
                        \CURLOPT_LOW_SPEED_TIME => max(1, (int) ceil($request->read_timeout)),
                    ],
                ]
            );

            $stream = $response->getBody();
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
                    'HTTP request timed out after ' . (int) ($request->connect_timeout * 1000) . 'ms while opening the connection',
                    $error
                );
            }

            throw new TransportException('HTTP transport error', $error);
        } catch (RequestException $error) {
            if ($this->isTimeoutException($error)) {
                throw new RequestTimeoutException(
                    'HTTP request timed out while waiting for response body data',
                    $error
                );
            }

            throw new TransportException('HTTP transport error', $error);
        } catch (GuzzleException $error) {
            throw new TransportException('HTTP transport error', $error);
        }
    }

    public function close(): void
    {
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
