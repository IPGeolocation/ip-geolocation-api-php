<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

final class LookupIpGeolocationRequest extends ValueObject
{
    public readonly ?string $ip;
    public readonly ?string $lang;
    /** @var array<int, string> */
    public readonly array $include;
    /** @var array<int, string> */
    public readonly array $fields;
    /** @var array<int, string> */
    public readonly array $excludes;
    public readonly ?string $user_agent;
    /** @var array<string, array<int, string>> */
    public readonly array $headers;
    public readonly string $output;

    /**
     * @param array<int, string> $include
     * @param array<int, string> $fields
     * @param array<int, string> $excludes
     * @param array<string, string|array<int, string>> $headers
     */
    public function __construct(
        ?string $ip = null,
        ?string $lang = null,
        array $include = [],
        array $fields = [],
        array $excludes = [],
        ?string $user_agent = null,
        array $headers = [],
        ?string $output = ResponseFormat::JSON
    ) {
        $this->ip = self::normalizeIp($ip);
        $this->lang = RequestNormalizer::language($lang);
        $this->include = RequestNormalizer::tokens($include, 'include');
        $this->fields = RequestNormalizer::tokens($fields, 'fields');
        $this->excludes = RequestNormalizer::tokens($excludes, 'excludes');
        $this->user_agent = RequestNormalizer::optionalString($user_agent, 'user_agent');
        $this->headers = RequestNormalizer::headers($headers);
        $this->output = ResponseFormat::normalize($output);
    }

    private static function normalizeIp(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim($value);
        if ($normalized === '') {
            throw new ValidationException('ip must not be blank');
        }

        return $normalized;
    }
}
