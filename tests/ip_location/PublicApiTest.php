<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use Ipgeolocation\Sdk\ApiResponse;
use Ipgeolocation\Sdk\ApiResponseMetadata;
use Ipgeolocation\Sdk\BulkLookupError;
use Ipgeolocation\Sdk\BulkLookupErrorDetails;
use Ipgeolocation\Sdk\BulkLookupSuccess;
use Ipgeolocation\Sdk\IpGeolocationClient;
use Ipgeolocation\Sdk\IpGeolocationClientConfig;
use Ipgeolocation\Sdk\IpGeolocationResponse;
use Ipgeolocation\Sdk\LookupIpGeolocationRequest;
use PHPUnit\Framework\TestCase;

final class PublicApiTest extends TestCase
{
    public function testCoreClassesAreUsable(): void
    {
        $config = new IpGeolocationClientConfig(api_key: 'test-key');
        $client = new IpGeolocationClient($config);
        $request = new LookupIpGeolocationRequest(ip: '8.8.8.8');
        $metadata = new ApiResponseMetadata(null, null, 200, 5, []);
        $response = new ApiResponse(new IpGeolocationResponse(ip: '8.8.8.8'), $metadata);
        $success = new BulkLookupSuccess(new IpGeolocationResponse(ip: '8.8.8.8'));
        $error = new BulkLookupError(new BulkLookupErrorDetails('Invalid IP address.'));

        self::assertSame('test-key', $config->api_key);
        self::assertSame('8.8.8.8', $request->ip);
        self::assertSame('8.8.8.8', $response->data->ip);
        self::assertTrue($success->isSuccess());
        self::assertFalse($error->isSuccess());

        $client->close();
    }

    public function testTypedResponsesCanBeSerializedToArraysAndJson(): void
    {
        $response = new IpGeolocationResponse(ip: '8.8.8.8');

        self::assertSame(['ip' => '8.8.8.8'], $response->toArray());
        self::assertSame('{"ip":"8.8.8.8"}', json_encode($response, JSON_THROW_ON_ERROR));
    }
}
