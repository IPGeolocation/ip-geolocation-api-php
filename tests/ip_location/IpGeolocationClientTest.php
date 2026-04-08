<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use Ipgeolocation\Sdk\BulkLookupIpGeolocationRequest;
use Ipgeolocation\Sdk\HttpResponseData;
use Ipgeolocation\Sdk\IpGeolocationClient;
use Ipgeolocation\Sdk\ResponseFormat;
use Ipgeolocation\Sdk\ValidationException;
use Ipgeolocation\Sdk\Test\Support\FakeTransport;
use PHPUnit\Framework\TestCase;

final class IpGeolocationClientTest extends TestCase
{
    public function testLookupBuildsExpectedGetRequest(): void
    {
        $transport = new FakeTransport();
        $transport->push(new HttpResponseData(
            status_code: 200,
            body: json_encode(['ip' => '8.8.8.8'], JSON_THROW_ON_ERROR),
            headers: ['Content-Type' => ['application/json']]
        ));

        $client = new IpGeolocationClient(
            [
                'api_key' => 'test-key',
                'request_origin' => 'https://app.example.com',
            ],
            $transport
        );

        $response = $client->lookupIpGeolocation([
            'ip' => '8.8.8.8',
            'include' => ['security'],
            'headers' => ['X-Test' => 'yes'],
        ]);

        self::assertSame('8.8.8.8', $response->data->ip);
        self::assertCount(1, $transport->requests);
        self::assertSame('GET', $transport->requests[0]->method);
        self::assertStringContainsString('/v3/ipgeo?', $transport->requests[0]->url);
        self::assertStringContainsString('apiKey=test-key', $transport->requests[0]->url);
        self::assertStringContainsString('ip=8.8.8.8', $transport->requests[0]->url);
        self::assertStringContainsString('include=security', $transport->requests[0]->url);
        self::assertSame(['https://app.example.com'], $transport->requests[0]->headers['Origin']);
        self::assertSame(['yes'], $transport->requests[0]->headers['X-Test']);
    }

    public function testBulkBuildsExpectedPostRequest(): void
    {
        $transport = new FakeTransport();
        $transport->push(new HttpResponseData(
            status_code: 200,
            body: json_encode([['ip' => '8.8.8.8']], JSON_THROW_ON_ERROR),
            headers: ['Content-Type' => ['application/json']]
        ));

        $client = new IpGeolocationClient(['api_key' => 'test-key'], $transport);

        $response = $client->bulkLookupIpGeolocation(new BulkLookupIpGeolocationRequest(
            ips: ['8.8.8.8'],
            include: ['security']
        ));

        self::assertSame('8.8.8.8', $response->data[0]->data->ip);
        self::assertSame('POST', $transport->requests[0]->method);
        self::assertSame('{"ips":["8.8.8.8"]}', $transport->requests[0]->body);
        self::assertSame(['application/json'], $transport->requests[0]->headers['Content-Type']);
    }

    public function testTypedMethodsRejectXml(): void
    {
        $client = new IpGeolocationClient(['api_key' => 'test-key'], new FakeTransport());

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('XML output is not supported by typed methods');

        $client->lookupIpGeolocation(['output' => ResponseFormat::XML]);
    }

    public function testClosePreventsFurtherRequests(): void
    {
        $client = new IpGeolocationClient(['api_key' => 'test-key'], new FakeTransport());
        $client->close();

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('client is closed');

        $client->lookupIpGeolocation();
    }
}
