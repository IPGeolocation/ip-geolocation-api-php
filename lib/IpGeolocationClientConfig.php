<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

final class IpGeolocationClientConfig extends ValueObject
{
    public const DEFAULT_BASE_URL = 'https://api.ipgeolocation.io';
    public const DEFAULT_CONNECT_TIMEOUT = 10.0;
    public const DEFAULT_READ_TIMEOUT = 30.0;
    private const REDACTED_API_KEY = '[REDACTED]';

    public readonly ?string $api_key;
    public readonly ?string $request_origin;
    public readonly string $base_url;
    public readonly float $connect_timeout;
    public readonly float $read_timeout;

    public function __construct(
        ?string $api_key = null,
        ?string $request_origin = null,
        string $base_url = self::DEFAULT_BASE_URL,
        float|int $connect_timeout = self::DEFAULT_CONNECT_TIMEOUT,
        float|int $read_timeout = self::DEFAULT_READ_TIMEOUT
    ) {
        $this->api_key = self::normalizeApiKey($api_key);
        $this->request_origin = self::normalizeRequestOrigin($request_origin);
        $this->base_url = self::normalizeBaseUrl($base_url);
        $this->connect_timeout = self::normalizeTimeout($connect_timeout, 'connect_timeout');
        $this->read_timeout = self::normalizeTimeout($read_timeout, 'read_timeout');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $keepNulls = false): array
    {
        $data = parent::toArray($keepNulls);
        if (array_key_exists('api_key', $data)) {
            $data['api_key'] = self::REDACTED_API_KEY;
        }

        return $data;
    }

    private static function normalizeApiKey(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim($value);
        if ($normalized === '') {
            throw new ValidationException('api_key must not be blank');
        }

        return $normalized;
    }

    private static function normalizeRequestOrigin(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim($value);
        if ($normalized === '') {
            throw new ValidationException('request_origin must not be blank');
        }

        if (str_contains($normalized, "\r") || str_contains($normalized, "\n")) {
            throw new ValidationException('request_origin must not contain CR or LF');
        }

        $parts = parse_url($normalized);
        if ($parts === false || !isset($parts['scheme'], $parts['host'])) {
            throw new ValidationException('request_origin must be an absolute http or https origin');
        }

        if (!in_array($parts['scheme'], ['http', 'https'], true)) {
            throw new ValidationException('request_origin must be an absolute http or https origin');
        }

        if (isset($parts['path']) && !in_array($parts['path'], ['', '/'], true)) {
            throw new ValidationException('request_origin must not include a path');
        }

        if (isset($parts['query']) || isset($parts['fragment'])) {
            throw new ValidationException('request_origin must not include query or fragment');
        }

        if (isset($parts['user']) || isset($parts['pass'])) {
            throw new ValidationException('request_origin must not include userinfo');
        }

        $port = '';
        if (isset($parts['port'])) {
            $isDefault = ($parts['scheme'] === 'http' && $parts['port'] === 80)
                || ($parts['scheme'] === 'https' && $parts['port'] === 443);
            $port = $isDefault ? '' : ':' . $parts['port'];
        }

        return $parts['scheme'] . '://' . $parts['host'] . $port;
    }

    private static function normalizeBaseUrl(string $value): string
    {
        $normalized = rtrim(trim($value), '/');
        if ($normalized === '') {
            throw new ValidationException('base_url must not be blank');
        }

        $parts = parse_url($normalized);
        if ($parts === false || !isset($parts['scheme'], $parts['host'])) {
            throw new ValidationException('base_url must be an absolute http or https URL');
        }

        if (!in_array($parts['scheme'], ['http', 'https'], true)) {
            throw new ValidationException('base_url must be an absolute http or https URL');
        }

        if (isset($parts['query']) || isset($parts['fragment'])) {
            throw new ValidationException('base_url must not include query or fragment');
        }

        if (isset($parts['user']) || isset($parts['pass'])) {
            throw new ValidationException('base_url must not include userinfo');
        }

        return $normalized;
    }

    private static function normalizeTimeout(float|int $value, string $field): float
    {
        $normalized = (float) $value;
        if (!is_finite($normalized)) {
            throw new ValidationException($field . ' must be finite');
        }

        if ($normalized <= 0) {
            throw new ValidationException($field . ' must be greater than zero');
        }

        return $normalized;
    }
}
