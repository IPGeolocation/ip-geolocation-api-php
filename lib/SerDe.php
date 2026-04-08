<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

final class SerDe
{
    /**
     * @param array<string, ?string> $params
     */
    public static function buildQuery(array $params): string
    {
        $items = [];
        foreach ($params as $key => $value) {
            if ($value === null) {
                continue;
            }

            $keyText = trim((string) $key);
            $valueText = trim($value);
            if ($keyText === '' || $valueText === '') {
                continue;
            }

            $items[] = rawurlencode($keyText) . '=' . rawurlencode($valueText);
        }

        return $items === [] ? '' : '?' . implode('&', $items);
    }

    /**
     * @param array<string, array<int, string>> ...$headerMaps
     * @return array<string, array<int, string>>
     */
    public static function mergeHeaders(?array ...$headerMaps): array
    {
        $merged = [];
        $namesByLower = [];

        foreach ($headerMaps as $headerMap) {
            if ($headerMap === null) {
                continue;
            }

            foreach ($headerMap as $rawName => $rawValues) {
                $name = trim((string) $rawName);
                if ($name === '') {
                    continue;
                }

                $lower = strtolower($name);
                if (isset($namesByLower[$lower]) && $namesByLower[$lower] !== $name) {
                    unset($merged[$namesByLower[$lower]]);
                }

                $namesByLower[$lower] = $name;
                $merged[$name] = array_values(array_map('strval', $rawValues));
            }
        }

        return $merged;
    }

    /**
     * @param array<string, array<int, string>> $requestHeaders
     * @return array<int, string>
     */
    public static function resolveUserAgentHeader(
        ?string $requestUserAgent,
        array $requestHeaders,
        string $defaultUserAgent
    ): array {
        if ($requestUserAgent !== null) {
            return [$requestUserAgent];
        }

        $customValues = self::headerValuesIgnoreCase($requestHeaders, 'User-Agent');
        if ($customValues !== null && $customValues !== []) {
            return $customValues;
        }

        return [$defaultUserAgent];
    }

    public static function validateJsonOutput(string $output): void
    {
        if (ResponseFormat::normalize($output) === ResponseFormat::XML) {
            throw new ValidationException(
                'XML output is not supported by typed methods. Use ' . ResponseFormat::JSON . '.'
            );
        }
    }

    public static function parseSingleLookup(string $body): IpGeolocationResponse
    {
        $payload = self::parseJson($body, 'Failed to deserialize API response');
        if (!is_array($payload) || array_is_list($payload)) {
            throw new SerializationException('Failed to deserialize API response');
        }

        return self::parseIpGeolocationResponse($payload);
    }

    /**
     * @return array<int, BulkLookupResult>
     */
    public static function parseBulkLookup(string $body): array
    {
        $payload = self::parseJson($body, 'Failed to deserialize bulk lookup response');
        if (!is_array($payload) || !array_is_list($payload)) {
            throw new SerializationException('Failed to deserialize bulk response: expected an array');
        }

        $results = [];
        foreach ($payload as $item) {
            if (!is_array($item)) {
                throw new SerializationException('Failed to deserialize API response');
            }

            if (self::bulkErrorItem($item)) {
                $results[] = new BulkLookupError(
                    new BulkLookupErrorDetails(self::bulkErrorMessage($item))
                );
                continue;
            }

            $results[] = new BulkLookupSuccess(self::parseIpGeolocationResponse($item));
        }

        return $results;
    }

    public static function toApiException(int $statusCode, string $body): ApiException
    {
        $apiMessage = self::extractApiMessage($body);
        $message = $apiMessage === null
            ? 'API request failed with HTTP status ' . $statusCode
            : 'API request failed with HTTP status ' . $statusCode . ': ' . $apiMessage;

        return match ($statusCode) {
            400 => new BadRequestException($message, $statusCode, $apiMessage),
            401 => new UnauthorizedException($message, $statusCode, $apiMessage),
            403 => new ForbiddenException($message, $statusCode, $apiMessage),
            404 => new NotFoundException($message, $statusCode, $apiMessage),
            405 => new MethodNotAllowedException($message, $statusCode, $apiMessage),
            413 => new PayloadTooLargeException($message, $statusCode, $apiMessage),
            415 => new UnsupportedMediaTypeException($message, $statusCode, $apiMessage),
            423 => new LockedException($message, $statusCode, $apiMessage),
            429 => new RateLimitException($message, $statusCode, $apiMessage),
            499 => new ClientClosedRequestException($message, $statusCode, $apiMessage),
            default => $statusCode >= 500 && $statusCode <= 599
                ? new ServerErrorException($message, $statusCode, $apiMessage)
                : new ApiException($message, $statusCode, $apiMessage),
        };
    }

    public static function extractApiMessage(?string $body): ?string
    {
        if ($body === null) {
            return null;
        }

        $normalized = trim($body);
        if ($normalized === '') {
            return null;
        }

        try {
            $payload = json_decode($normalized, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return substr($normalized, 0, 512);
        }

        if (!is_array($payload) || array_is_list($payload)) {
            return substr($normalized, 0, 512);
        }

        $message = $payload['message'] ?? null;
        if ($message === null && isset($payload['error']) && is_array($payload['error']) && !array_is_list($payload['error'])) {
            $message = $payload['error']['message'] ?? null;
        }

        return self::stringOrNull($message) ?? substr($normalized, 0, 512);
    }

    /**
     * @param array<string, array<int, string>>|null $rawHeaders
     */
    public static function toMetadata(int $statusCode, int $durationMs, ?array $rawHeaders): ApiResponseMetadata
    {
        $headers = $rawHeaders ?? [];

        return new ApiResponseMetadata(
            credits_charged: self::parseIntHeader(self::firstHeaderIgnoreCase($headers, 'X-Credits-Charged')),
            successful_records: self::parseIntHeader(self::firstHeaderIgnoreCase($headers, 'X-Successful-Record')),
            status_code: $statusCode,
            duration_ms: max($durationMs, 0),
            raw_headers: $headers
        );
    }

    /**
     * @param array<string, array<int, string>> $headers
     * @return array<int, string>|null
     */
    public static function headerValuesIgnoreCase(array $headers, string $name): ?array
    {
        foreach ($headers as $key => $values) {
            if (strcasecmp($key, $name) === 0) {
                return $values;
            }
        }

        return null;
    }

    /**
     * @param array<string, array<int, string>> $headers
     */
    public static function firstHeaderIgnoreCase(array $headers, string $name): ?string
    {
        $values = self::headerValuesIgnoreCase($headers, $name);
        return $values[0] ?? null;
    }

    private static function parseIntHeader(?string $value): ?int
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim($value);
        if ($normalized === '' || preg_match('/^\d+$/', $normalized) !== 1) {
            return null;
        }

        return (int) $normalized;
    }

    /**
     */
    private static function parseJson(string $body, string $message): mixed
    {
        try {
            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $error) {
            throw new SerializationException($message, $error);
        }
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseIpGeolocationResponse(array $node): IpGeolocationResponse
    {
        return new IpGeolocationResponse(
            ip: self::stringOrNull($node['ip'] ?? null),
            domain: self::stringOrNull($node['domain'] ?? null),
            hostname: self::stringOrNull($node['hostname'] ?? null),
            location: self::parseOptionalObject($node['location'] ?? null, [self::class, 'parseLocation']),
            country_metadata: self::parseOptionalObject($node['country_metadata'] ?? null, [self::class, 'parseCountryMetadata']),
            network: self::parseOptionalObject($node['network'] ?? null, [self::class, 'parseNetwork']),
            currency: self::parseOptionalObject($node['currency'] ?? null, [self::class, 'parseCurrency']),
            asn: self::parseOptionalObject($node['asn'] ?? null, [self::class, 'parseAsn']),
            company: self::parseOptionalObject($node['company'] ?? null, [self::class, 'parseCompany']),
            security: self::parseOptionalObject($node['security'] ?? null, [self::class, 'parseSecurity']),
            abuse: self::parseOptionalObject($node['abuse'] ?? null, [self::class, 'parseAbuse']),
            time_zone: self::parseOptionalObject($node['time_zone'] ?? null, [self::class, 'parseTimeZoneInfo']),
            user_agent: self::parseOptionalObject($node['user_agent'] ?? null, [self::class, 'parseUserAgent'])
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseAbuse(array $node): Abuse
    {
        return new Abuse(
            route: self::stringOrNull($node['route'] ?? null),
            country: self::stringOrNull($node['country'] ?? null),
            name: self::stringOrNull($node['name'] ?? null),
            organization: self::stringOrNull($node['organization'] ?? null),
            kind: self::stringOrNull($node['kind'] ?? null),
            address: self::stringOrNull($node['address'] ?? null),
            emails: self::stringArrayOrNull($node['emails'] ?? null),
            phone_numbers: self::stringArrayOrNull($node['phone_numbers'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseAsn(array $node): Asn
    {
        return new Asn(
            as_number: self::stringOrNull($node['as_number'] ?? null),
            organization: self::stringOrNull($node['organization'] ?? null),
            country: self::stringOrNull($node['country'] ?? null),
            type: self::stringOrNull($node['type'] ?? null),
            domain: self::stringOrNull($node['domain'] ?? null),
            date_allocated: self::stringOrNull($node['date_allocated'] ?? null),
            rir: self::stringOrNull($node['rir'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseCompany(array $node): Company
    {
        return new Company(
            name: self::stringOrNull($node['name'] ?? null),
            type: self::stringOrNull($node['type'] ?? null),
            domain: self::stringOrNull($node['domain'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseCountryMetadata(array $node): CountryMetadata
    {
        return new CountryMetadata(
            calling_code: self::stringOrNull($node['calling_code'] ?? null),
            tld: self::stringOrNull($node['tld'] ?? null),
            languages: self::stringArrayOrNull($node['languages'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseCurrency(array $node): Currency
    {
        return new Currency(
            code: self::stringOrNull($node['code'] ?? null),
            name: self::stringOrNull($node['name'] ?? null),
            symbol: self::stringOrNull($node['symbol'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseDstTransition(array $node): DstTransition
    {
        return new DstTransition(
            utc_time: self::stringOrNull($node['utc_time'] ?? null),
            duration: self::stringOrNull($node['duration'] ?? null),
            gap: self::boolOrNull($node['gap'] ?? null),
            date_time_after: self::stringOrNull($node['date_time_after'] ?? null),
            date_time_before: self::stringOrNull($node['date_time_before'] ?? null),
            overlap: self::boolOrNull($node['overlap'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseLocation(array $node): Location
    {
        return new Location(
            continent_code: self::stringOrNull($node['continent_code'] ?? null),
            continent_name: self::stringOrNull($node['continent_name'] ?? null),
            country_code2: self::stringOrNull($node['country_code2'] ?? null),
            country_code3: self::stringOrNull($node['country_code3'] ?? null),
            country_name: self::stringOrNull($node['country_name'] ?? null),
            country_name_official: self::stringOrNull($node['country_name_official'] ?? null),
            country_capital: self::stringOrNull($node['country_capital'] ?? null),
            state_prov: self::stringOrNull($node['state_prov'] ?? null),
            state_code: self::stringOrNull($node['state_code'] ?? null),
            district: self::stringOrNull($node['district'] ?? null),
            city: self::stringOrNull($node['city'] ?? null),
            locality: self::stringOrNull($node['locality'] ?? null),
            accuracy_radius: self::stringOrNull($node['accuracy_radius'] ?? null),
            confidence: self::stringOrNull($node['confidence'] ?? null),
            dma_code: self::stringOrNull($node['dma_code'] ?? null),
            zipcode: self::stringOrNull($node['zipcode'] ?? null),
            latitude: self::stringOrNull($node['latitude'] ?? null),
            longitude: self::stringOrNull($node['longitude'] ?? null),
            is_eu: self::boolOrNull($node['is_eu'] ?? null),
            country_flag: self::stringOrNull($node['country_flag'] ?? null),
            geoname_id: self::stringOrNull($node['geoname_id'] ?? null),
            country_emoji: self::stringOrNull($node['country_emoji'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseNetwork(array $node): Network
    {
        return new Network(
            connection_type: self::stringOrNull($node['connection_type'] ?? null),
            route: self::stringOrNull($node['route'] ?? null),
            is_anycast: self::boolOrNull($node['is_anycast'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseSecurity(array $node): Security
    {
        return new Security(
            threat_score: self::numericOrNull($node['threat_score'] ?? null),
            is_tor: self::boolOrNull($node['is_tor'] ?? null),
            is_proxy: self::boolOrNull($node['is_proxy'] ?? null),
            proxy_provider_names: self::stringArrayOrNull($node['proxy_provider_names'] ?? null),
            proxy_confidence_score: self::numericOrNull($node['proxy_confidence_score'] ?? null),
            proxy_last_seen: self::stringOrNull($node['proxy_last_seen'] ?? null),
            is_residential_proxy: self::boolOrNull($node['is_residential_proxy'] ?? null),
            is_vpn: self::boolOrNull($node['is_vpn'] ?? null),
            vpn_provider_names: self::stringArrayOrNull($node['vpn_provider_names'] ?? null),
            vpn_confidence_score: self::numericOrNull($node['vpn_confidence_score'] ?? null),
            vpn_last_seen: self::stringOrNull($node['vpn_last_seen'] ?? null),
            is_relay: self::boolOrNull($node['is_relay'] ?? null),
            relay_provider_name: self::stringOrNull($node['relay_provider_name'] ?? null),
            is_anonymous: self::boolOrNull($node['is_anonymous'] ?? null),
            is_known_attacker: self::boolOrNull($node['is_known_attacker'] ?? null),
            is_bot: self::boolOrNull($node['is_bot'] ?? null),
            is_spam: self::boolOrNull($node['is_spam'] ?? null),
            is_cloud_provider: self::boolOrNull($node['is_cloud_provider'] ?? null),
            cloud_provider_name: self::stringOrNull($node['cloud_provider_name'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseTimeZoneInfo(array $node): TimeZoneInfo
    {
        return new TimeZoneInfo(
            name: self::stringOrNull($node['name'] ?? null),
            offset: self::numericOrNull($node['offset'] ?? null),
            offset_with_dst: self::numericOrNull($node['offset_with_dst'] ?? null),
            current_time: self::stringOrNull($node['current_time'] ?? null),
            current_time_unix: self::numericOrNull($node['current_time_unix'] ?? null),
            current_tz_abbreviation: self::stringOrNull($node['current_tz_abbreviation'] ?? null),
            current_tz_full_name: self::stringOrNull($node['current_tz_full_name'] ?? null),
            standard_tz_abbreviation: self::stringOrNull($node['standard_tz_abbreviation'] ?? null),
            standard_tz_full_name: self::stringOrNull($node['standard_tz_full_name'] ?? null),
            is_dst: self::boolOrNull($node['is_dst'] ?? null),
            dst_savings: self::numericOrNull($node['dst_savings'] ?? null),
            dst_exists: self::boolOrNull($node['dst_exists'] ?? null),
            dst_tz_abbreviation: self::stringOrNull($node['dst_tz_abbreviation'] ?? null),
            dst_tz_full_name: self::stringOrNull($node['dst_tz_full_name'] ?? null),
            dst_start: self::parseOptionalObject($node['dst_start'] ?? null, [self::class, 'parseDstTransition']),
            dst_end: self::parseOptionalObject($node['dst_end'] ?? null, [self::class, 'parseDstTransition'])
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseUserAgent(array $node): UserAgent
    {
        return new UserAgent(
            user_agent_string: self::stringOrNull($node['user_agent_string'] ?? null),
            name: self::stringOrNull($node['name'] ?? null),
            type: self::stringOrNull($node['type'] ?? null),
            version: self::stringOrNull($node['version'] ?? null),
            version_major: self::stringOrNull($node['version_major'] ?? null),
            device: self::parseOptionalObject($node['device'] ?? null, [self::class, 'parseUserAgentDevice']),
            engine: self::parseOptionalObject($node['engine'] ?? null, [self::class, 'parseUserAgentEngine']),
            operating_system: self::parseOptionalObject($node['operating_system'] ?? null, [self::class, 'parseUserAgentOperatingSystem'])
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseUserAgentDevice(array $node): UserAgentDevice
    {
        return new UserAgentDevice(
            name: self::stringOrNull($node['name'] ?? null),
            type: self::stringOrNull($node['type'] ?? null),
            brand: self::stringOrNull($node['brand'] ?? null),
            cpu: self::stringOrNull($node['cpu'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseUserAgentEngine(array $node): UserAgentEngine
    {
        return new UserAgentEngine(
            name: self::stringOrNull($node['name'] ?? null),
            type: self::stringOrNull($node['type'] ?? null),
            version: self::stringOrNull($node['version'] ?? null),
            version_major: self::stringOrNull($node['version_major'] ?? null)
        );
    }

    /**
     * @param array<string, mixed> $node
     */
    private static function parseUserAgentOperatingSystem(array $node): UserAgentOperatingSystem
    {
        return new UserAgentOperatingSystem(
            name: self::stringOrNull($node['name'] ?? null),
            type: self::stringOrNull($node['type'] ?? null),
            version: self::stringOrNull($node['version'] ?? null),
            version_major: self::stringOrNull($node['version_major'] ?? null),
            build: self::stringOrNull($node['build'] ?? null)
        );
    }

    /**
     * @param callable(array<string, mixed>): mixed $parser
     */
    private static function parseOptionalObject(mixed $value, callable $parser): mixed
    {
        if ($value === null) {
            return null;
        }

        if (!is_array($value)) {
            throw new SerializationException('Failed to deserialize API response');
        }

        if ($value !== [] && array_is_list($value)) {
            throw new SerializationException('Failed to deserialize API response');
        }

        return $parser($value);
    }

    private static function stringOrNull(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        if (!is_string($value)) {
            throw new SerializationException('Failed to deserialize API response');
        }

        return $value;
    }

    private static function numericOrNull(mixed $value): ?float
    {
        if ($value === null) {
            return null;
        }

        if (!is_int($value) && !is_float($value)) {
            throw new SerializationException('Failed to deserialize API response');
        }

        return (float) $value;
    }

    private static function boolOrNull(mixed $value): ?bool
    {
        if ($value === null) {
            return null;
        }

        if (!is_bool($value)) {
            throw new SerializationException('Failed to deserialize API response');
        }

        return $value;
    }

    /**
     * @return array<int, string>|null
     */
    private static function stringArrayOrNull(mixed $value): ?array
    {
        if ($value === null) {
            return null;
        }

        if (!is_array($value) || !array_is_list($value)) {
            throw new SerializationException('Failed to deserialize API response');
        }

        $result = [];
        foreach ($value as $item) {
            if (!is_string($item)) {
                throw new SerializationException('Failed to deserialize API response');
            }
            $result[] = $item;
        }

        return $result;
    }

    /**
     * @param array<string, mixed> $item
     */
    private static function bulkErrorItem(array $item): bool
    {
        if (($item['success'] ?? null) === true) {
            return false;
        }

        if (($item['success'] ?? null) === false || array_key_exists('message', $item)) {
            return true;
        }

        return isset($item['error'])
            && is_array($item['error'])
            && !array_is_list($item['error'])
            && array_key_exists('message', $item['error']);
    }

    /**
     * @param array<string, mixed> $item
     */
    private static function bulkErrorMessage(array $item): ?string
    {
        $message = self::stringOrNull($item['message'] ?? null);
        if ($message !== null) {
            return $message;
        }

        if (!isset($item['error']) || !is_array($item['error']) || array_is_list($item['error'])) {
            return null;
        }

        return self::stringOrNull($item['error']['message'] ?? null);
    }
}
