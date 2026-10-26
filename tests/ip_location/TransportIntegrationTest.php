<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use GuzzleHttp\Client;
use Ipgeolocation\Sdk\GuzzleTransport;
use Ipgeolocation\Sdk\HttpRequestData;
use Ipgeolocation\Sdk\IpGeolocationClient;
use Ipgeolocation\Sdk\RequestTimeoutException;
use Ipgeolocation\Sdk\Test\Support\HttpTestServer;
use Ipgeolocation\Sdk\TransportException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class TransportIntegrationTest extends TestCase
{
    private array $servers = [];

    protected function tearDown(): void
    {
        foreach ($this->servers as $server) {
            $server->close();
        }
    }

    private function server(bool $tls = false): HttpTestServer
    {
        return $this->servers[] = new HttpTestServer($tls);
    }

    public function testSingleAndBulkRequestsUseTheRealTransport(): void
    {
        $server = $this->server();
        $client = new IpGeolocationClient(['api_key' => 'test-key', 'base_url' => $server->url]);
        $response = $client->lookupIpGeolocation([
            'ip' => '8.8.8.8', 'include' => ['security', 'abuse'],
            'user_agent' => 'php-security-test', 'headers' => ['X-Test' => 'yes'],
        ]);
        self::assertSame('8.8.8.8', $response->data->ip);
        self::assertSame('United States', $response->data->location?->country_name);
        self::assertFalse($response->data->security?->is_proxy);
        self::assertSame(['abuse@example.com'], $response->data->abuse?->emails);
        self::assertSame(1, $response->metadata->credits_charged);
        $bulk = $client->bulkLookupIpGeolocation([
            'ips' => ['8.8.8.8', 'invalid-ip', '1.1.1.1'], 'user_agent' => 'php-security-test',
        ]);
        self::assertCount(3, $bulk->data);
        self::assertSame('8.8.8.8', $bulk->data[0]->data->ip);
        self::assertFalse($bulk->data[1]->success);
        self::assertSame('Invalid IP address.', $bulk->data[1]->error->message);
        self::assertSame('1.1.1.1', $bulk->data[2]->data->ip);
        self::assertSame(2, $bulk->metadata->successful_records);
        $client->close();
    }

    public function testAcceptsATrustedCertificate(): void
    {
        $server = $this->server(true);
        $transport = new GuzzleTransport(new Client(['verify' => $server->caFile]));
        $response = $transport->sendRequest($this->request($server->url . '/ok'));
        self::assertSame(200, $response->status_code);
        self::assertSame('{}', $response->body);
    }

    public function testRejectsAnUntrustedCertificateByDefault(): void
    {
        $server = $this->server(true);
        $this->expectException(TransportException::class);
        (new GuzzleTransport())->sendRequest($this->request($server->url . '/ok'));
    }

    public function testRejectsACertificateForAnotherHostname(): void
    {
        $server = $this->server(true);
        $transport = new GuzzleTransport(new Client(['verify' => $server->caFile]));
        $this->expectException(TransportException::class);
        $transport->sendRequest($this->request(str_replace('localhost', '127.0.0.1', $server->url) . '/ok'));
    }

    public static function stalledResponses(): array
    {
        return [['/slow-body'], ['/slow-headers']];
    }

    #[DataProvider('stalledResponses')]
    public function testStalledResponsesHonorTheReadTimeout(string $path): void
    {
        $server = $this->server();
        $started = microtime(true);
        $this->expectException(RequestTimeoutException::class);
        $this->expectExceptionMessageMatches('/^HTTP request timed out$/');
        try {
            (new GuzzleTransport())->sendRequest(new HttpRequestData(
                $server->url . $path,
                'GET',
                ['Accept' => ['application/json']],
                null,
                4.0,
                1.0
            ));
        } finally {
            self::assertLessThan(2.5, microtime(true) - $started, 'The transport must not wait for the 3-second response');
        }
    }

    public static function oversizedResponses(): array
    {
        return [['/oversized'], ['/compressed']];
    }

    #[DataProvider('oversizedResponses')]
    public function testBoundsDecodedResponseBytes(string $path): void
    {
        $server = $this->server();
        $this->expectException(TransportException::class);
        $this->expectExceptionMessage('Response body exceeded max size of 1024 bytes');
        (new GuzzleTransport(null, 1024))->sendRequest($this->request($server->url . $path));
    }

    public function testRejectsATruncatedResponse(): void
    {
        $server = $this->server();
        $this->expectException(TransportException::class);
        (new GuzzleTransport())->sendRequest($this->request($server->url . '/truncated'));
    }

    public function testRedirectsKeepOnlyTheFinalResponseBody(): void
    {
        $server = $this->server();
        $headers = 0;
        $transport = new GuzzleTransport(new Client(['on_headers' => static function () use (&$headers): void {
            $headers++;
        }]));
        $response = $transport->sendRequest($this->request($server->url . '/redirect'));
        self::assertSame(200, $response->status_code);
        self::assertSame('{}', $response->body);
        self::assertSame(2, $headers, 'Preserve custom client callbacks across redirects');
    }

    private function request(string $url): HttpRequestData
    {
        return new HttpRequestData($url, 'GET', ['Accept' => ['application/json']], null, 1.0, 1.0);
    }
}
