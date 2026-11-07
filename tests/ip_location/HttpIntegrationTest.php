<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Handler\StreamHandler;
use GuzzleHttp\HandlerStack;
use Ipgeolocation\Sdk\GuzzleTransport;
use Ipgeolocation\Sdk\HttpRequestData;
use Ipgeolocation\Sdk\IpGeolocationClient;
use Ipgeolocation\Sdk\RateLimitException;
use Ipgeolocation\Sdk\RequestTimeoutException;
use Ipgeolocation\Sdk\TransportException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class HttpIntegrationTest extends TestCase
{
    private static $server;
    private static array $pipes = [];
    private static string $base;

    public static function setUpBeforeClass(): void
    {
        self::$server = proc_open(['python3', __DIR__ . '/Support/http_fixture.py'], [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']], self::$pipes);
        if (!is_resource(self::$server)) {
            throw new \RuntimeException('Cannot start HTTP fixture');
        }
        stream_set_timeout(self::$pipes[1], 10);
        $ports = json_decode(fgets(self::$pipes[1]), true, 512, JSON_THROW_ON_ERROR);
        self::$base = 'http://127.0.0.1:' . $ports['origin'];
    }

    public static function tearDownAfterClass(): void
    {
        proc_terminate(self::$server);
        foreach (self::$pipes as $pipe) {
            fclose($pipe);
        }
        proc_close(self::$server);
    }

    private function client(string $route, float $timeout = 1, ?GuzzleTransport $transport = null): IpGeolocationClient
    {
        return new IpGeolocationClient(['api_key' => 'test-key', 'base_url' => self::$base . '/' . $route, 'connect_timeout' => $timeout, 'read_timeout' => $timeout], $transport ?? $this->transport());
    }

    private function transport(int $limit = GuzzleTransport::DEFAULT_MAX_RESPONSE_BODY_BYTES, array $options = []): GuzzleTransport
    {
        $mode = getenv('TEST_HTTP_HANDLER');
        if ($mode === 'curl' || $mode === 'stream') {
            $options['handler'] = HandlerStack::create($mode === 'curl' ? new CurlHandler() : new StreamHandler());
        }
        return new GuzzleTransport($options === [] && $mode !== 'injected' ? null : new Client($options), $limit);
    }

    #[DataProvider('workingRoutes')]
    public function testSuccessPreservesData(string $route): void
    {
        $result = $this->client($route)->lookupIpGeolocation(['ip' => '8.8.8.8', 'lang' => 'ar']);
        self::assertSame('8.8.8.8', $result->data->ip);
        self::assertSame('مصر', $result->data->location->country_name);
        if (in_array($route, ['gzip', 'deflate'], true)) {
            self::assertNull($result->metadata->firstHeaderValue('Content-Encoding'));
            self::assertNotNull($result->metadata->firstHeaderValue('x-encoded-content-length'));
        }
    }

    public static function workingRoutes(): array
    {
        return [['echo'], ['gzip'], ['deflate'], ['redirect-same']];
    }

    #[DataProvider('redirectRoutes')]
    public function testRedirectsCannotSendDataElsewhere(string $route): void
    {
        try {
            $this->client($route)->bulkLookupIpGeolocation(['ips' => ['8.8.8.8'], 'headers' => ['X-Marker' => 'test-marker']]);
            self::fail('Expected redirect rejection');
        } catch (TransportException $error) {
            self::assertStringNotContainsString('test-key', (string) $error);
        }
        $received = (new GuzzleTransport())->sendRequest(new HttpRequestData(self::$base . '/received', 'GET', [], null, 1, 1));
        self::assertSame([], json_decode($received->body, true));
    }

    public static function redirectRoutes(): array
    {
        return [['redirect-other'], ['redirect-port'], ['redirect-user'], ['redirect-loop']];
    }

    #[DataProvider('delayedRoutes')]
    public function testRealTimeouts(string $route): void
    {
        $start = microtime(true);
        try {
            $this->client($route, 0.05)->lookupIpGeolocation();
            self::fail('Expected timeout');
        } catch (RequestTimeoutException) {
            $elapsed = microtime(true) - $start;
            self::assertGreaterThan(0.025, $elapsed);
            self::assertLessThan(getenv('TEST_HTTP_HANDLER') === 'curl' ? 1.2 : 0.3, $elapsed);
        }
    }

    public static function delayedRoutes(): array
    {
        return [['headers-delay'], ['body-delay'], ['body-stall']];
    }

    public function testHealthyProgressCanTakeLongerThanEitherTimeout(): void
    {
        $start = microtime(true);
        self::assertSame('8.8.8.8', $this->client('progress', 0.15)->lookupIpGeolocation()->data->ip);
        self::assertGreaterThan(0.2, microtime(true) - $start);
    }

    public function testCompressedResponseCanKeepMakingProgress(): void
    {
        self::assertSame('8.8.8.8', $this->client('gzip-progress', 0.05)->lookupIpGeolocation()->data->ip);
    }

    public function testSlowResponseStaysWithinTheIdleTimeout(): void
    {
        $result = $this->client('trickle', 2, new GuzzleTransport())->lookupIpGeolocation();
        self::assertNull($result->data->ip);
    }

    public function testVeryLargeTimeoutsRemainUsable(): void
    {
        self::assertSame('8.8.8.8', $this->client('echo', PHP_FLOAT_MAX)->lookupIpGeolocation()->data->ip);
    }

    public function testVerySmallTimeoutsExpire(): void
    {
        $this->expectException(RequestTimeoutException::class);
        $this->client('headers-delay', 0.0000001, new GuzzleTransport())->lookupIpGeolocation();
    }

    #[DataProvider('brokenBodies')]
    public function testInvalidSuccessfulBodiesFail(string $route, int $limit): void
    {
        $this->expectException(TransportException::class);
        $this->client($route, 1, $this->transport($limit))->lookupIpGeolocation();
    }

    public static function brokenBodies(): array
    {
        return [['cut', 4096], ['gzip-cut', 4096], ['bad-gzip', 4096], ['gzip-big', 1024], ['echo', 16]];
    }

    #[DataProvider('unreadableErrors')]
    public function testHttpErrorsKeepStatusEvenWhenBodyFails(string $route): void
    {
        try {
            $this->client($route, 0.05, $this->transport(1024))->lookupIpGeolocation();
            self::fail('Expected API error');
        } catch (RateLimitException $error) {
            self::assertSame(429, $error->status_code);
            self::assertNull($error->api_message);
        }
    }

    public static function unreadableErrors(): array
    {
        return [['error-cut'], ['error-gzip-cut'], ['error-large'], ['error-delay']];
    }

    public function testExplicitDecodeFalseReturnsCompressedBytes(): void
    {
        $result = $this->client('gzip', 1, $this->transport(4096, ['decode_content' => false]))->lookupIpGeolocationRaw();
        self::assertSame('gzip', $result->metadata->firstHeaderValue('Content-Encoding'));
        self::assertSame('8.8.8.8', json_decode(gzdecode($result->data), true)['ip']);
    }

    public function testExactSizeBoundaryAndLargerLimit(): void
    {
        $body = $this->client('echo')->lookupIpGeolocationRaw()->data;
        foreach ([strlen($body), strlen($body) + 1] as $limit) {
            self::assertSame($body, $this->client('echo', 1, $this->transport($limit))->lookupIpGeolocationRaw()->data);
        }
        $this->expectException(TransportException::class);
        $this->client('echo', 1, $this->transport(strlen($body) - 1))->lookupIpGeolocationRaw();
    }

    public function testCustomCurlTotalTimeoutIsPreserved(): void
    {
        $transport = new GuzzleTransport(new Client(['handler' => HandlerStack::create(new CurlHandler()), 'timeout' => 0.05]));
        $this->expectException(RequestTimeoutException::class);
        $this->client('progress', 1, $transport)->lookupIpGeolocation();
    }

    public function testCurlSupportsBrotliAndConfiguredEncodingHeaders(): void
    {
        if (empty(curl_version()['brotli_version'])) {
            self::markTestSkipped('This libcurl build has no Brotli decoder');
        }
        foreach ([['decode_content' => 'br'], ['headers' => ['Accept-Encoding' => 'br']]] as $options) {
            $options['handler'] = HandlerStack::create(new CurlHandler());
            $transport = new GuzzleTransport(new Client($options));
            $result = $this->client('br', 1, $transport)->lookupIpGeolocation();
            self::assertSame('8.8.8.8', $result->data->ip);
            self::assertNull($result->metadata->firstHeaderValue('Content-Encoding'));
            $headers = json_decode($this->client('request-headers', 1, $transport)->lookupIpGeolocationRaw()->data, true);
            self::assertSame('br', $headers['Accept-Encoding']);
        }
    }

    public function testCustomCallbacksStillRun(): void
    {
        $headers = [];
        $stats = [];
        $progress = 0;
        $redirects = 0;
        $transport = new GuzzleTransport(new Client([
            'handler' => HandlerStack::create(new CurlHandler()),
            'on_headers' => static function ($response) use (&$headers): void { $headers[] = $response->getHeaders(); },
            'on_stats' => static function ($result) use (&$stats): void { $stats[] = $result->getResponse()->getHeaders(); },
            'progress' => static function () use (&$progress): void { ++$progress; },
            'allow_redirects' => ['on_redirect' => static function () use (&$redirects): void { ++$redirects; }],
        ]));
        $this->client('gzip', 1, $transport)->lookupIpGeolocation();
        self::assertArrayNotHasKey('Content-Encoding', $headers[0]);
        self::assertSame($headers[0], $stats[0]);
        $this->client('redirect-same', 1, $transport)->lookupIpGeolocation();
        self::assertSame(1, $redirects);
        self::assertCount(3, $stats);
        self::assertGreaterThan(0, $progress);
    }

    public function testDefaultClientRejectsUnfinishedChunkedResponse(): void
    {
        $this->expectException(TransportException::class);
        $this->client('chunked-cut', 1, new GuzzleTransport())->lookupIpGeolocation();
    }

    public function testDefaultClientKeepsStatusForUnfinishedChunkedError(): void
    {
        $this->expectException(RateLimitException::class);
        $this->client('error-chunked-cut', 1, new GuzzleTransport())->lookupIpGeolocation();
    }

    public function testCurlResetsRedirectBodyAndRunsFailureStats(): void
    {
        $sizes = [];
        $path = tempnam(sys_get_temp_dir(), 'ipgeo-redirect-');
        try {
            $transport = new GuzzleTransport(new Client([
                'handler' => HandlerStack::create(new CurlHandler()),
                'sink' => $path,
                'on_stats' => static function ($stats) use (&$sizes): void {
                    $sizes[] = $stats->getResponse()?->getBody()->getSize();
                },
            ]));
            $body = $this->client('redirect-body', 1, $transport)->lookupIpGeolocationRaw()->data;
            self::assertSame([2048, strlen($body)], $sizes);
            self::assertSame($body, file_get_contents($path));
            $failures = 0;
            $transport = new GuzzleTransport(new Client([
                'handler' => HandlerStack::create(new CurlHandler()),
                'on_stats' => static function () use (&$failures): void { ++$failures; },
            ]), 16);
            try {
                $this->client('echo', 1, $transport)->lookupIpGeolocation();
                self::fail('Expected size limit');
            } catch (TransportException) {
                self::assertSame(1, $failures);
            }
        } finally {
            unlink($path);
        }
    }

    public function testCustomCurlSinkReceivesDecodedData(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'ipgeo-response-');
        try {
            $transport = new GuzzleTransport(new Client(['handler' => HandlerStack::create(new CurlHandler()), 'sink' => $path]));
            $body = $this->client('gzip', 1, $transport)->lookupIpGeolocationRaw()->data;
            self::assertSame($body, file_get_contents($path));
            self::assertSame('8.8.8.8', json_decode($body, true)['ip']);
        } finally {
            unlink($path);
        }
    }

    public function testStreamHandlerLeavesUnusedSinkOpen(): void
    {
        if (!ini_get('allow_url_fopen')) {
            self::markTestSkipped('The native stream handler is disabled');
        }
        $sink = fopen('php://temp', 'w+');
        $transport = new GuzzleTransport(new Client(['handler' => HandlerStack::create(new StreamHandler()), 'sink' => $sink]));
        $this->client('echo', 1, $transport)->lookupIpGeolocation();
        self::assertIsResource($sink);
        self::assertSame(0, ftell($sink));
        fclose($sink);
    }

    public function testNativeCurlOptionsCannotBypassRedirectOrSizeChecks(): void
    {
        $transport = new GuzzleTransport(new Client(['handler' => HandlerStack::create(new CurlHandler()), 'curl' => [CURLOPT_FOLLOWLOCATION => true, CURLOPT_NOPROGRESS => true]]));
        try {
            $this->client('redirect-other', 1, $transport)->bulkLookupIpGeolocation(['ips' => ['8.8.8.8']]);
            self::fail('Expected redirect rejection');
        } catch (TransportException) {
            $received = (new GuzzleTransport())->sendRequest(new HttpRequestData(self::$base . '/received', 'GET', [], null, 1, 1));
            self::assertSame([], json_decode($received->body, true));
        }
        $transport = new GuzzleTransport(new Client(['handler' => HandlerStack::create(new CurlHandler()), 'curl' => [CURLOPT_WRITEFUNCTION => static fn ($handle, $body) => strlen($body)]]), 16);
        $this->expectException(TransportException::class);
        $this->client('echo', 1, $transport)->lookupIpGeolocation();
    }

    public function testFiftyThousandResultsRemainComplete(): void
    {
        $previous = ini_set('memory_limit', '1G');
        try {
            $results = $this->client('large', 10)->bulkLookupIpGeolocation(['ips' => array_fill(0, 50000, '8.8.8.8')])->data;
            self::assertCount(50000, $results);
            self::assertSame('مصر', $results[49999]->data->location->country_name);
            self::assertSame(str_repeat('x', 2048), $results[49999]->data->location->city);
        } finally {
            unset($results);
            gc_mem_caches();
            ini_set('memory_limit', $previous);
        }
    }
}
