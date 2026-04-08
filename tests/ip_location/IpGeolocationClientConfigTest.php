<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use Ipgeolocation\Sdk\IpGeolocationClientConfig;
use Ipgeolocation\Sdk\ValidationException;
use PHPUnit\Framework\TestCase;

final class IpGeolocationClientConfigTest extends TestCase
{
    public function testNormalizesRequestOriginAndBaseUrl(): void
    {
        $config = new IpGeolocationClientConfig(
            api_key: 'test-key',
            request_origin: 'https://app.example.com/',
            base_url: 'https://api.ipgeolocation.io/'
        );

        self::assertSame('test-key', $config->api_key);
        self::assertSame('https://app.example.com', $config->request_origin);
        self::assertSame('https://api.ipgeolocation.io', $config->base_url);
        self::assertSame(10.0, $config->connect_timeout);
        self::assertSame(30.0, $config->read_timeout);
    }

    public function testRejectsRequestOriginWithPath(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('request_origin must not include a path');

        new IpGeolocationClientConfig(request_origin: 'https://app.example.com/path');
    }

    public function testRejectsNonPositiveTimeout(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('read_timeout must be greater than zero');

        new IpGeolocationClientConfig(read_timeout: 0);
    }

    public function testSerializationRedactsApiKey(): void
    {
        $config = new IpGeolocationClientConfig(api_key: 'test-key');

        self::assertSame(
            [
                'api_key' => '[REDACTED]',
                'base_url' => 'https://api.ipgeolocation.io',
                'connect_timeout' => 10.0,
                'read_timeout' => 30.0,
            ],
            $config->toArray()
        );

        $decoded = json_decode((string) json_encode($config, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);

        self::assertSame('[REDACTED]', $decoded['api_key']);
        self::assertSame('https://api.ipgeolocation.io', $decoded['base_url']);
        self::assertSame(10, $decoded['connect_timeout']);
        self::assertSame(30, $decoded['read_timeout']);
    }
}
