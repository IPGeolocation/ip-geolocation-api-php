<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\CurlMultiHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\TransferStats;
use GuzzleHttp\Psr7\FnStream;
use GuzzleHttp\Psr7\LazyOpenStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

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
        $this->client = $client ?? new Client(['handler' => HandlerStack::create(new CurlMultiHandler(['select_timeout' => 0.01]))]);
    }

    public function sendRequest(HttpRequestData $request): HttpResponseData
    {
        $response = null;
        $stream = null;
        $sink = null;
        $handle = null;
        $transferStarted = null;
        $deadline = null;
        $timedOut = false;
        $externalSink = null;
        $bodyError = null;
        $started = microtime(true);
        $connectTimeout = self::timeout($request->connect_timeout);
        $readTimeout = self::timeout($request->read_timeout);
        try {
            $message = new Request($request->method, $request->url, $request->headers, $request->body);
            $decode = $this->client->getConfig('decode_content');
            foreach ($this->client->getConfig('headers') ?? [] as $name => $value) {
                if (strcasecmp($name, 'Accept-Encoding') === 0 && !$message->hasHeader('Accept-Encoding')) {
                    $message = $message->withHeader('Accept-Encoding', $value);
                }
            }
            if ($decode !== false && !$message->hasHeader('Accept-Encoding')) {
                $message = $message->withHeader('Accept-Encoding', is_string($decode) ? $decode : '');
            }
            $redirects = $this->client->getConfig('allow_redirects');
            if ($redirects !== false) {
                $redirects = is_array($redirects) ? $redirects : [];
                $callback = $redirects['on_redirect'] ?? null;
                $origin = $message->getUri();
                $redirects['on_redirect'] = static function ($previous, $reply, UriInterface $next) use ($origin, $callback): void {
                    if ($next->getUserInfo() !== '' || !self::sameOrigin($origin, $next)) {
                        throw new TransportException('Redirect to a different server is not allowed');
                    }
                    if (is_callable($callback)) {
                        $callback($previous, $reply, $next);
                    }
                };
            }
            $body = '';
            $wireBytes = 0;
            $inflater = null;
            $usedSink = false;
            $headerResponse = null;
            $curlDecoded = false;
            $totalTimeout = (float) ($this->client->getConfig('timeout') ?? 0);
            $headerTimeout = $totalTimeout > 0 ? min($totalTimeout, $connectTimeout) : $connectTimeout;
            $resetBody = static function (ResponseInterface $reply) use (&$body, &$wireBytes, &$inflater, &$curlDecoded, $decode): void {
                $body = '';
                $wireBytes = 0;
                $encoding = strtolower(trim($reply->getHeaderLine('Content-Encoding')));
                $inflater = !$curlDecoded && $decode !== false && function_exists('inflate_init') && in_array($encoding, ['gzip', 'deflate'], true)
                    ? inflate_init($encoding === 'gzip' ? ZLIB_ENCODING_GZIP : ZLIB_ENCODING_DEFLATE)
                    : null;
            };
            $expired = static function () use (&$handle, &$deadline, &$transferStarted, &$timedOut, $totalTimeout): bool {
                if ($handle === null) {
                    return false;
                }
                $now = hrtime(true) / 1e9;
                $timedOut = $now >= $deadline || ($totalTimeout > 0 && $now - $transferStarted >= $totalTimeout);
                return $timedOut;
            };
            $refreshDeadline = static function () use (&$deadline, $readTimeout): void {
                $deadline = hrtime(true) / 1e9 + $readTimeout;
            };
            $consume = function (string $chunk) use (&$body, &$wireBytes, &$inflater): string {
                $wireBytes += strlen($chunk);
                $decoded = '';
                foreach (str_split($chunk, $inflater === null ? 8192 : 1024) as $part) {
                    if ($inflater !== null) {
                        $part = @inflate_add($inflater, $part, ZLIB_SYNC_FLUSH);
                        if ($part === false) {
                            throw new TransportException('Invalid compressed response');
                        }
                    }
                    if (strlen($part) > $this->max_response_body_bytes - strlen($body)) {
                        throw new TransportException('Response body exceeded max size of ' . $this->max_response_body_bytes . ' bytes');
                    }
                    $body .= $part;
                    $decoded .= $part;
                }
                return $decoded;
            };
            $destination = $this->client->getConfig('sink');
            $bufferResource = fopen('php://temp', 'w+');
            $buffer = Utils::streamFor($bufferResource);
            $sink = FnStream::decorate($buffer, ['write' => static function (string $chunk) use ($buffer, $consume, $expired, $refreshDeadline, &$usedSink, &$externalSink, &$bodyError, $destination): int {
                $usedSink = true;
                try {
                    if ($expired()) {
                        throw new RequestTimeoutException('HTTP request timed out while waiting for response data');
                    }
                    $decoded = $consume($chunk);
                    if ($destination !== null && $externalSink === null) {
                        $externalSink = is_string($destination) ? new LazyOpenStream($destination, 'w+') : Utils::streamFor($destination);
                    }
                    if ($buffer->write($decoded) !== strlen($decoded)
                        || ($externalSink !== null && $externalSink->write($decoded) !== strlen($decoded))) {
                        throw new TransportException('Could not write the response body');
                    }
                    $refreshDeadline();
                    return strlen($chunk);
                } catch (\Throwable $error) {
                    $bodyError = $error;
                    return 0;
                }
            }]);
            $onHeaders = $this->client->getConfig('on_headers');
            $onStats = $this->client->getConfig('on_stats');
            $progress = $this->client->getConfig('progress');
            $curl = [CURLOPT_XFERINFOFUNCTION => static function ($current, $total, $downloaded, $uploadTotal, $uploaded) use (&$handle, &$transferStarted, &$deadline, $headerTimeout, $expired, $progress): int {
                if ($handle === null) {
                    $transferStarted = hrtime(true) / 1e9;
                    $deadline = $transferStarted + $headerTimeout;
                }
                $handle = $current;
                if ($expired()) {
                    return 1;
                }
                if (is_callable($progress)) {
                    $progress($total, $downloaded, $uploadTotal, $uploaded);
                }
                return 0;
            }];
            if ($decode !== false) {
                $curl[CURLOPT_ENCODING] = is_string($decode) ? $decode : '';
            }
            $curl[CURLOPT_LOW_SPEED_LIMIT] = 1;
            $curl[CURLOPT_LOW_SPEED_TIME] = (int) ceil($readTimeout);
            $options = [
                'http_errors' => false,
                'stream' => true,
                'decode_content' => false,
                'connect_timeout' => $connectTimeout,
                'timeout' => $headerTimeout,
                'sink' => $sink,
                'progress' => static function (): void {},
                'read_timeout' => ceil($readTimeout),
                'allow_redirects' => $redirects,
                'on_headers' => static function ($reply) use (&$response, &$headerResponse, &$usedSink, &$externalSink, &$curlDecoded, &$handle, $decode, $bufferResource, $destination, $resetBody, $onHeaders, $expired, $refreshDeadline, $totalTimeout): void {
                    if (!$reply instanceof ResponseInterface || $reply->getStatusCode() < 200) {
                        return;
                    }
                    $response = $headerResponse = $reply;
                    if ($expired()) {
                        throw new RequestTimeoutException('HTTP request timed out while waiting for response headers');
                    }
                    if ($handle !== null) {
                        curl_setopt($handle, CURLOPT_TIMEOUT_MS, $totalTimeout > 0 ? (int) ceil(self::timeout($totalTimeout) * 1000) : 0);
                    }
                    $curlDecoded = $handle !== null && $decode !== false && $reply->hasHeader('Content-Encoding');
                    $usedSink = false;
                    $resetBody($reply);
                    ftruncate($bufferResource, 0);
                    rewind($bufferResource);
                    if (is_string($destination)) {
                        $externalSink?->close();
                        $externalSink = null;
                    }
                    $refreshDeadline();
                    if (is_callable($onHeaders)) {
                        $onHeaders($curlDecoded ? self::decodedHeaders($reply) : $reply);
                    }
                },
                'on_stats' => static function ($stats) use (&$handle, &$curlDecoded, $onStats): void {
                    $handle = null;
                    if (is_callable($onStats)) {
                        if ($curlDecoded && $stats->hasResponse()) {
                            $stats = new TransferStats($stats->getRequest(), self::decodedHeaders($stats->getResponse()), $stats->getTransferTime(), $stats->getHandlerErrorData(), $stats->getHandlerStats());
                        }
                        $onStats($stats);
                    }
                },
                'curl' => $curl,
            ];
            $response = $this->client->send($message, $options);
            if ($bodyError !== null) {
                throw $bodyError;
            }
            $stream = $response->getBody();
            if ($headerResponse === null) {
                $resetBody($response);
                $usedSink = false;
                if ($stream->isSeekable()) {
                    $stream->rewind();
                }
            }
            if (get_class($stream) === Stream::class) {
                $resource = $stream->detach();
                if (is_resource($resource)) {
                    $idleTimeout = $totalTimeout > 0 ? min($totalTimeout, $readTimeout) : $readTimeout;
                    stream_set_timeout($resource, (int) $idleTimeout, (int) round(($idleTimeout - (int) $idleTimeout) * 1000000));
                    $stream = Utils::streamFor($resource);
                }
            }
            $headers = $response->getHeaders();
            $encoding = strtolower(trim($response->getHeaderLine('Content-Encoding')));
            if (!$usedSink) {
                while (!$stream->eof()) {
                    $chunk = $stream->read($inflater === null ? 8192 : 1024);
                    if ($stream->getMetadata('timed_out')) {
                        throw new RequestTimeoutException('HTTP request timed out while waiting for response data');
                    }
                    if ($chunk === '') {
                        if (!$stream->eof()) {
                            throw new TransportException('Response stream stopped before it finished');
                        }
                        break;
                    }
                    $consume($chunk);
                }
            }
            $length = $response->getHeaderLine('Content-Length');
            if ($curlDecoded) {
                $response = self::decodedHeaders($response);
                $headers = $response->getHeaders();
                $length = '';
            }
            if ($encoding === '' && $response->hasHeader('x-encoded-content-encoding')) {
                $length = '';
                $response = $response->withoutHeader('Content-Length');
                $headers = $response->getHeaders();
            }
            if (($length !== '' && ctype_digit($length) && $wireBytes !== (int) $length)
                || ($inflater !== null && (inflate_get_status($inflater) !== ZLIB_STREAM_END || inflate_get_read_len($inflater) !== $wireBytes))) {
                throw new TransportException('Response body ended before it was complete');
            }
            if ($inflater !== null) {
                $headers = self::decodedHeaders($response)->getHeaders();
            }
            return new HttpResponseData($response->getStatusCode(), $body, $headers);
        } catch (\Throwable $error) {
            if ($response !== null && $response->getStatusCode() >= 400) {
                return new HttpResponseData($response->getStatusCode(), '', $response->getHeaders());
            }
            $error = $bodyError ?? $error;
            if ($error instanceof TransportException) {
                throw $error;
            }
            if ($timedOut || ($stream !== null && $stream->getMetadata('timed_out')) || $this->isTimeoutException($error)
                || ($error instanceof ConnectException && microtime(true) - $started >= ($headerTimeout ?? $connectTimeout))) {
                throw new RequestTimeoutException('HTTP request timed out', $error);
            }
            throw new TransportException('HTTP transport error', $error);
        } finally {
            try {
                $stream?->close();
                if ($sink !== $stream) {
                    $sink?->close();
                }
            } catch (\Throwable) {
            }
        }
    }

    public function close(): void
    {
    }

    private static function decodedHeaders(ResponseInterface $response): ResponseInterface
    {
        $response = $response->withHeader('x-encoded-content-encoding', $response->getHeaderLine('Content-Encoding'))->withoutHeader('Content-Encoding');
        if ($response->hasHeader('Content-Length')) {
            $response = $response->withHeader('x-encoded-content-length', $response->getHeaderLine('Content-Length'))->withoutHeader('Content-Length');
        }
        return $response;
    }

    private static function timeout(float $seconds): float
    {
        return min(max($seconds, 0.001), 2147483.0);
    }

    private static function sameOrigin(UriInterface $left, UriInterface $right): bool
    {
        return strtolower($left->getScheme()) === strtolower($right->getScheme())
            && strtolower($left->getHost()) === strtolower($right->getHost())
            && ($left->getPort() ?? ($left->getScheme() === 'https' ? 443 : 80)) === ($right->getPort() ?? ($right->getScheme() === 'https' ? 443 : 80));
    }

    private function isTimeoutException(\Throwable $error): bool
    {
        if (method_exists($error, 'getHandlerContext') && (($error->getHandlerContext()['errno'] ?? null) === 28)) {
            return true;
        }
        return str_contains(strtolower($error->getMessage()), 'timed out');
    }
}
