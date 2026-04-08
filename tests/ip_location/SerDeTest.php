<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use Ipgeolocation\Sdk\BulkLookupError;
use Ipgeolocation\Sdk\BulkLookupSuccess;
use Ipgeolocation\Sdk\IpGeolocationResponse;
use Ipgeolocation\Sdk\SerDe;
use PHPUnit\Framework\TestCase;

final class SerDeTest extends TestCase
{
    public function testParsesSingleLookup(): void
    {
        $response = SerDe::parseSingleLookup(json_encode([
            'ip' => '8.8.8.8',
            'location' => [
                'country_name' => 'United States',
                'city' => 'Mountain View',
            ],
        ], JSON_THROW_ON_ERROR));

        self::assertInstanceOf(IpGeolocationResponse::class, $response);
        self::assertSame('8.8.8.8', $response->ip);
        self::assertSame('United States', $response->location?->country_name);
        self::assertSame('Mountain View', $response->location?->city);
    }

    public function testParsesBulkMixedResponse(): void
    {
        $results = SerDe::parseBulkLookup(json_encode([
            [
                'ip' => '8.8.8.8',
                'location' => ['country_name' => 'United States'],
            ],
            [
                'message' => 'Invalid IP address.',
            ],
        ], JSON_THROW_ON_ERROR));

        self::assertCount(2, $results);
        self::assertInstanceOf(BulkLookupSuccess::class, $results[0]);
        self::assertInstanceOf(BulkLookupError::class, $results[1]);
        self::assertSame('8.8.8.8', $results[0]->data->ip);
        self::assertSame('Invalid IP address.', $results[1]->error->message);
    }

    public function testExtractsNestedApiMessage(): void
    {
        $message = SerDe::extractApiMessage(json_encode([
            'error' => ['message' => 'Paid plan required.'],
        ], JSON_THROW_ON_ERROR));

        self::assertSame('Paid plan required.', $message);
    }

    public function testParsesBulkNestedErrorShape(): void
    {
        $results = SerDe::parseBulkLookup(json_encode([
            [
                'error' => ['message' => 'Invalid IP address.'],
            ],
        ], JSON_THROW_ON_ERROR));

        self::assertCount(1, $results);
        self::assertInstanceOf(BulkLookupError::class, $results[0]);
        self::assertSame('Invalid IP address.', $results[0]->error->message);
    }

    public function testBuildsMetadataWithCaseInsensitiveHeaders(): void
    {
        $metadata = SerDe::toMetadata(200, 42, [
            'x-credits-charged' => ['2'],
            'X-Successful-Record' => ['1'],
            'content-type' => ['application/json'],
        ]);

        self::assertSame(2, $metadata->credits_charged);
        self::assertSame(1, $metadata->successful_records);
        self::assertSame('application/json', $metadata->firstHeaderValue('Content-Type'));
    }

    public function testParsesEmptyObjectTransitions(): void
    {
        $response = SerDe::parseSingleLookup(json_encode([
            'ip' => '1.1.1.1',
            'time_zone' => [
                'name' => 'Australia/Brisbane',
                'dst_start' => new \stdClass(),
                'dst_end' => new \stdClass(),
            ],
        ], JSON_THROW_ON_ERROR));

        self::assertSame('Australia/Brisbane', $response->time_zone?->name);
        self::assertNotNull($response->time_zone?->dst_start);
        self::assertNotNull($response->time_zone?->dst_end);
    }
}
