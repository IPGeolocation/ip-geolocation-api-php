<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Ipgeolocation\Sdk\GuzzleTransport;
use Ipgeolocation\Sdk\HttpRequestData;
use Ipgeolocation\Sdk\RequestTimeoutException;
use Ipgeolocation\Sdk\TransportException;
use PHPUnit\Framework\TestCase;

final class GuzzleTransportTest extends TestCase
{
    public function testReturnsResponseData(): void
    {
        $transport = new GuzzleTransport(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, ['X-Credits-Charged' => '1'], '{"ip":"8.8.8.8"}'),
            ])),
        ]));

        $response = $transport->sendRequest(new HttpRequestData(
            url: 'https://api.ipgeolocation.io/v3/ipgeo?apiKey=test-key',
            method: 'GET',
            headers: ['Accept' => ['application/json']],
            body: null,
            connect_timeout: 10.0,
            read_timeout: 30.0
        ));

        self::assertSame(200, $response->status_code);
        self::assertSame('{"ip":"8.8.8.8"}', $response->body);
        self::assertSame(['1'], $response->headers['X-Credits-Charged']);
    }

    public function testCompressedResponseWithoutHeaderCallbackIsDecoded(): void
    {
        $body = '{"ip":"8.8.8.8"}';
        $compressed = gzencode($body);
        $transport = new GuzzleTransport(new Client(['handler' => HandlerStack::create(new MockHandler([
            static fn () => new Response(200, ['Content-Encoding' => 'gzip', 'Content-Length' => strlen($compressed)], $compressed),
        ]))]));
        $result = $transport->sendRequest(new HttpRequestData('https://example.test', 'GET', [], null, 1, 1));
        self::assertSame($body, $result->body);
    }

    public function testMapsTimeoutsToRequestTimeoutException(): void
    {
        $transport = new GuzzleTransport(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new ConnectException(
                    'cURL error 28: Operation timed out',
                    new Request('GET', 'https://api.ipgeolocation.io/v3/ipgeo')
                ),
            ])),
        ]));

        $this->expectException(RequestTimeoutException::class);

        $transport->sendRequest(new HttpRequestData(
            url: 'https://api.ipgeolocation.io/v3/ipgeo',
            method: 'GET',
            headers: [],
            body: null,
            connect_timeout: 1.0,
            read_timeout: 1.0
        ));
    }

    public function testRejectsResponseBodyThatExceedsConfiguredLimit(): void
    {
        $transport = new GuzzleTransport(new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, [], '12345'),
            ])),
        ]), 4);

        $this->expectException(TransportException::class);
        $this->expectExceptionMessage('Response body exceeded max size of 4 bytes');

        $transport->sendRequest(new HttpRequestData(
            url: 'https://api.ipgeolocation.io/v3/ipgeo',
            method: 'GET',
            headers: [],
            body: null,
            connect_timeout: 10.0,
            read_timeout: 30.0
        ));
    }
}
