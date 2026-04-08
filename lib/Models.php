<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

/**
 * @template T
 */
class ApiResponse extends ValueObject
{
    /**
     * @param T $data
     */
    public function __construct(
        public readonly mixed $data,
        public readonly ApiResponseMetadata $metadata
    ) {
    }
}

class ApiResponseMetadata extends ValueObject
{
    /**
     * @param array<string, array<int, string>> $raw_headers
     */
    public function __construct(
        public readonly ?int $credits_charged,
        public readonly ?int $successful_records,
        public readonly int $status_code,
        public readonly int $duration_ms,
        public readonly array $raw_headers = []
    ) {
        if ($this->status_code < 100 || $this->status_code > 599) {
            throw new \InvalidArgumentException('status_code must be between 100 and 599');
        }

        if ($this->duration_ms < 0) {
            throw new \InvalidArgumentException('duration_ms must be greater than or equal to zero');
        }
    }

    /**
     * @return array<int, string>
     */
    public function headerValues(string $name): array
    {
        $normalized = trim($name);
        if ($normalized === '') {
            throw new \InvalidArgumentException('header name must not be blank');
        }

        foreach ($this->raw_headers as $key => $values) {
            if (strcasecmp($key, $normalized) === 0) {
                return $values;
            }
        }

        return [];
    }

    public function firstHeaderValue(string $name): ?string
    {
        $values = $this->headerValues($name);
        return $values[0] ?? null;
    }
}

class Abuse extends ValueObject
{
    /**
     * @param array<int, string>|null $emails
     * @param array<int, string>|null $phone_numbers
     */
    public function __construct(
        public readonly ?string $route = null,
        public readonly ?string $country = null,
        public readonly ?string $name = null,
        public readonly ?string $organization = null,
        public readonly ?string $kind = null,
        public readonly ?string $address = null,
        public readonly ?array $emails = null,
        public readonly ?array $phone_numbers = null
    ) {
    }
}

class Asn extends ValueObject
{
    public function __construct(
        public readonly ?string $as_number = null,
        public readonly ?string $organization = null,
        public readonly ?string $country = null,
        public readonly ?string $type = null,
        public readonly ?string $domain = null,
        public readonly ?string $date_allocated = null,
        public readonly ?string $rir = null
    ) {
    }
}

class Company extends ValueObject
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $type = null,
        public readonly ?string $domain = null
    ) {
    }
}

class CountryMetadata extends ValueObject
{
    /**
     * @param array<int, string>|null $languages
     */
    public function __construct(
        public readonly ?string $calling_code = null,
        public readonly ?string $tld = null,
        public readonly ?array $languages = null
    ) {
    }
}

class Currency extends ValueObject
{
    public function __construct(
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?string $symbol = null
    ) {
    }
}

class DstTransition extends ValueObject
{
    public function __construct(
        public readonly ?string $utc_time = null,
        public readonly ?string $duration = null,
        public readonly ?bool $gap = null,
        public readonly ?string $date_time_after = null,
        public readonly ?string $date_time_before = null,
        public readonly ?bool $overlap = null
    ) {
    }
}

class Location extends ValueObject
{
    public function __construct(
        public readonly ?string $continent_code = null,
        public readonly ?string $continent_name = null,
        public readonly ?string $country_code2 = null,
        public readonly ?string $country_code3 = null,
        public readonly ?string $country_name = null,
        public readonly ?string $country_name_official = null,
        public readonly ?string $country_capital = null,
        public readonly ?string $state_prov = null,
        public readonly ?string $state_code = null,
        public readonly ?string $district = null,
        public readonly ?string $city = null,
        public readonly ?string $locality = null,
        public readonly ?string $accuracy_radius = null,
        public readonly ?string $confidence = null,
        public readonly ?string $dma_code = null,
        public readonly ?string $zipcode = null,
        public readonly ?string $latitude = null,
        public readonly ?string $longitude = null,
        public readonly ?bool $is_eu = null,
        public readonly ?string $country_flag = null,
        public readonly ?string $geoname_id = null,
        public readonly ?string $country_emoji = null
    ) {
    }
}

class Network extends ValueObject
{
    public function __construct(
        public readonly ?string $connection_type = null,
        public readonly ?string $route = null,
        public readonly ?bool $is_anycast = null
    ) {
    }
}

class Security extends ValueObject
{
    /**
     * @param array<int, string>|null $proxy_provider_names
     * @param array<int, string>|null $vpn_provider_names
     */
    public function __construct(
        public readonly ?float $threat_score = null,
        public readonly ?bool $is_tor = null,
        public readonly ?bool $is_proxy = null,
        public readonly ?array $proxy_provider_names = null,
        public readonly ?float $proxy_confidence_score = null,
        public readonly ?string $proxy_last_seen = null,
        public readonly ?bool $is_residential_proxy = null,
        public readonly ?bool $is_vpn = null,
        public readonly ?array $vpn_provider_names = null,
        public readonly ?float $vpn_confidence_score = null,
        public readonly ?string $vpn_last_seen = null,
        public readonly ?bool $is_relay = null,
        public readonly ?string $relay_provider_name = null,
        public readonly ?bool $is_anonymous = null,
        public readonly ?bool $is_known_attacker = null,
        public readonly ?bool $is_bot = null,
        public readonly ?bool $is_spam = null,
        public readonly ?bool $is_cloud_provider = null,
        public readonly ?string $cloud_provider_name = null
    ) {
    }
}

class TimeZoneInfo extends ValueObject
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?float $offset = null,
        public readonly ?float $offset_with_dst = null,
        public readonly ?string $current_time = null,
        public readonly ?float $current_time_unix = null,
        public readonly ?string $current_tz_abbreviation = null,
        public readonly ?string $current_tz_full_name = null,
        public readonly ?string $standard_tz_abbreviation = null,
        public readonly ?string $standard_tz_full_name = null,
        public readonly ?bool $is_dst = null,
        public readonly ?float $dst_savings = null,
        public readonly ?bool $dst_exists = null,
        public readonly ?string $dst_tz_abbreviation = null,
        public readonly ?string $dst_tz_full_name = null,
        public readonly ?DstTransition $dst_start = null,
        public readonly ?DstTransition $dst_end = null
    ) {
    }
}

class UserAgentDevice extends ValueObject
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $type = null,
        public readonly ?string $brand = null,
        public readonly ?string $cpu = null
    ) {
    }
}

class UserAgentEngine extends ValueObject
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $type = null,
        public readonly ?string $version = null,
        public readonly ?string $version_major = null
    ) {
    }
}

class UserAgentOperatingSystem extends ValueObject
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $type = null,
        public readonly ?string $version = null,
        public readonly ?string $version_major = null,
        public readonly ?string $build = null
    ) {
    }
}

class UserAgent extends ValueObject
{
    public function __construct(
        public readonly ?string $user_agent_string = null,
        public readonly ?string $name = null,
        public readonly ?string $type = null,
        public readonly ?string $version = null,
        public readonly ?string $version_major = null,
        public readonly ?UserAgentDevice $device = null,
        public readonly ?UserAgentEngine $engine = null,
        public readonly ?UserAgentOperatingSystem $operating_system = null
    ) {
    }
}

class IpGeolocationResponse extends ValueObject
{
    public function __construct(
        public readonly ?string $ip = null,
        public readonly ?string $domain = null,
        public readonly ?string $hostname = null,
        public readonly ?Location $location = null,
        public readonly ?CountryMetadata $country_metadata = null,
        public readonly ?Network $network = null,
        public readonly ?Currency $currency = null,
        public readonly ?Asn $asn = null,
        public readonly ?Company $company = null,
        public readonly ?Security $security = null,
        public readonly ?Abuse $abuse = null,
        public readonly ?TimeZoneInfo $time_zone = null,
        public readonly ?UserAgent $user_agent = null
    ) {
    }
}

interface BulkLookupResult
{
    public function isSuccess(): bool;
}

class BulkLookupSuccess extends ValueObject implements BulkLookupResult
{
    public readonly bool $success;

    public function __construct(public readonly IpGeolocationResponse $data)
    {
        $this->success = true;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}

class BulkLookupErrorDetails extends ValueObject
{
    public function __construct(public readonly ?string $message = null)
    {
    }
}

class BulkLookupError extends ValueObject implements BulkLookupResult
{
    public readonly bool $success;

    public function __construct(public readonly BulkLookupErrorDetails $error)
    {
        $this->success = false;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}
