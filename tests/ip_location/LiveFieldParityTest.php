<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test;

use Ipgeolocation\Sdk\IpGeolocationClient;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('live')]
final class LiveFieldParityTest extends TestCase
{
    private static function shouldRunLiveHardening(): bool
    {
        return getenv('IPGEO_RUN_LIVE_HARDENING') === 'true'
            && getenv('IPGEO_PAID_KEY') !== false;
    }

    private function paidClient(): IpGeolocationClient
    {
        return new IpGeolocationClient(['api_key' => (string) getenv('IPGEO_PAID_KEY')]);
    }

    public function testIncludeStarResponseMatchesTypedModel(): void
    {
        if (!self::shouldRunLiveHardening()) {
            self::markTestSkipped('Set IPGEO_RUN_LIVE_HARDENING=true and IPGEO_PAID_KEY to enable live field parity tests');
        }

        $raw = $this->paidClient()->lookupIpGeolocationRaw([
            'ip' => '8.8.8.8',
            'include' => ['*'],
        ]);
        $typed = $this->paidClient()->lookupIpGeolocation([
            'ip' => '8.8.8.8',
            'include' => ['*'],
        ]);

        $payload = json_decode($raw->data, true, 512, JSON_THROW_ON_ERROR);
        self::assertSame($payload['ip'] ?? null, $typed->data->ip);
        self::assertSame($payload['location']['country_name'] ?? null, $typed->data->location?->country_name);
    }

    public function testFilteredSecurityResponseMatchesTypedModel(): void
    {
        if (!self::shouldRunLiveHardening()) {
            self::markTestSkipped('Set IPGEO_RUN_LIVE_HARDENING=true and IPGEO_PAID_KEY to enable live field parity tests');
        }

        $raw = $this->paidClient()->lookupIpGeolocationRaw([
            'ip' => '8.8.8.8',
            'include' => ['security'],
            'fields' => ['location.country_name', 'security.threat_score', 'security.is_vpn'],
        ]);
        $typed = $this->paidClient()->lookupIpGeolocation([
            'ip' => '8.8.8.8',
            'include' => ['security'],
            'fields' => ['location.country_name', 'security.threat_score', 'security.is_vpn'],
        ]);

        $payload = json_decode($raw->data, true, 512, JSON_THROW_ON_ERROR);
        self::assertSame($payload['location']['country_name'] ?? null, $typed->data->location?->country_name);
        self::assertSame((float) ($payload['security']['threat_score'] ?? 0), $typed->data->security?->threat_score);
        self::assertSame($payload['security']['is_vpn'] ?? null, $typed->data->security?->is_vpn);
    }
}
