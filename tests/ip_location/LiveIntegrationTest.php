<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use Ipgeolocation\Sdk\ApiException;
use Ipgeolocation\Sdk\IpGeolocationClient;
use Ipgeolocation\Sdk\ResponseFormat;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('live')]
final class LiveIntegrationTest extends TestCase
{
    private static function shouldRunLiveTests(): bool
    {
        return getenv('IPGEO_RUN_LIVE_TESTS') === 'true'
            && getenv('IPGEO_FREE_KEY') !== false
            && getenv('IPGEO_PAID_KEY') !== false;
    }

    private function freeClient(): IpGeolocationClient
    {
        return new IpGeolocationClient(['api_key' => (string) getenv('IPGEO_FREE_KEY')]);
    }

    private function paidClient(): IpGeolocationClient
    {
        return new IpGeolocationClient(['api_key' => (string) getenv('IPGEO_PAID_KEY')]);
    }

    public function testFreePlanBaseLookupWorks(): void
    {
        if (!self::shouldRunLiveTests()) {
            self::markTestSkipped('Set IPGEO_RUN_LIVE_TESTS=true, IPGEO_FREE_KEY, and IPGEO_PAID_KEY to enable live tests');
        }

        $response = $this->freeClient()->lookupIpGeolocation(['ip' => '8.8.8.8']);
        self::assertSame('8.8.8.8', $response->data->ip);
    }

    public function testFreePlanDomainLookupIsRejected(): void
    {
        if (!self::shouldRunLiveTests()) {
            self::markTestSkipped('Set IPGEO_RUN_LIVE_TESTS=true, IPGEO_FREE_KEY, and IPGEO_PAID_KEY to enable live tests');
        }

        $this->expectException(ApiException::class);
        $this->freeClient()->lookupIpGeolocation(['ip' => 'ipgeolocation.io']);
    }

    public function testPaidPlanBulkMixedLookupReturnsSuccessAndErrorItems(): void
    {
        if (!self::shouldRunLiveTests()) {
            self::markTestSkipped('Set IPGEO_RUN_LIVE_TESTS=true, IPGEO_FREE_KEY, and IPGEO_PAID_KEY to enable live tests');
        }

        $response = $this->paidClient()->bulkLookupIpGeolocation([
            'ips' => ['8.8.8.8', 'invalid-ip', '1.1.1.1'],
            'include' => ['security'],
        ]);

        self::assertCount(3, $response->data);
        self::assertTrue($response->data[0]->success);
        self::assertFalse($response->data[1]->success);
        self::assertNotNull($response->data[1]->error->message);
    }

    public function testPaidPlanRawXmlWorks(): void
    {
        if (!self::shouldRunLiveTests()) {
            self::markTestSkipped('Set IPGEO_RUN_LIVE_TESTS=true, IPGEO_FREE_KEY, and IPGEO_PAID_KEY to enable live tests');
        }

        $response = $this->paidClient()->lookupIpGeolocationRaw([
            'ip' => '8.8.8.8',
            'output' => ResponseFormat::XML,
        ]);

        self::assertStringContainsString('<', $response->data);
    }
}
