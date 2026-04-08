<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use Ipgeolocation\Sdk\BulkLookupIpGeolocationRequest;
use Ipgeolocation\Sdk\LookupIpGeolocationRequest;
use Ipgeolocation\Sdk\ResponseFormat;
use Ipgeolocation\Sdk\ValidationException;
use PHPUnit\Framework\TestCase;

final class LookupIpGeolocationRequestTest extends TestCase
{
    public function testNormalizesLookupRequest(): void
    {
        $request = new LookupIpGeolocationRequest(
            ip: ' 8.8.8.8 ',
            lang: 'EN',
            include: ['security', 'abuse'],
            fields: ['location.country_name'],
            excludes: ['currency'],
            user_agent: ' custom-agent ',
            headers: ['X-Test' => ' value '],
            output: ResponseFormat::JSON
        );

        self::assertSame('8.8.8.8', $request->ip);
        self::assertSame('en', $request->lang);
        self::assertSame(['security', 'abuse'], $request->include);
        self::assertSame(['location.country_name'], $request->fields);
        self::assertSame(['currency'], $request->excludes);
        self::assertSame('custom-agent', $request->user_agent);
        self::assertSame(['X-Test' => ['value']], $request->headers);
        self::assertSame(ResponseFormat::JSON, $request->output);
    }

    public function testRejectsBlankHeaderValue(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('header values must not contain blank strings');

        new LookupIpGeolocationRequest(headers: ['X-Test' => '   ']);
    }

    public function testRejectsEmptyBulkIps(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('ips must not be empty');

        new BulkLookupIpGeolocationRequest(ips: []);
    }

    public function testRejectsBulkIpsOverTheLimit(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('ips must contain at most 50000 entries');

        new BulkLookupIpGeolocationRequest(ips: array_fill(0, 50001, '8.8.8.8'));
    }
}
