<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

final class BulkLookupIpGeolocationRequest extends ValueObject
{
    /** @var array<int, string> */
    public readonly array $ips;
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
     * @param array<int, string> $ips
     * @param array<int, string> $include
     * @param array<int, string> $fields
     * @param array<int, string> $excludes
     * @param array<string, string|array<int, string>> $headers
     */
    public function __construct(
        array $ips,
        ?string $lang = null,
        array $include = [],
        array $fields = [],
        array $excludes = [],
        ?string $user_agent = null,
        array $headers = [],
        ?string $output = ResponseFormat::JSON
    ) {
        $this->ips = self::normalizeIps($ips);
        $this->lang = RequestNormalizer::language($lang);
        $this->include = RequestNormalizer::tokens($include, 'include');
        $this->fields = RequestNormalizer::tokens($fields, 'fields');
        $this->excludes = RequestNormalizer::tokens($excludes, 'excludes');
        $this->user_agent = RequestNormalizer::optionalString($user_agent, 'user_agent');
        $this->headers = RequestNormalizer::headers($headers);
        $this->output = ResponseFormat::normalize($output);
    }

    /**
     * @param array<int, string> $ips
     * @return array<int, string>
     */
    private static function normalizeIps(array $ips): array
    {
        $normalized = RequestNormalizer::tokens($ips, 'ips');
        if ($normalized === []) {
            throw new ValidationException('ips must not be empty');
        }

        if (count($normalized) > 50000) {
            throw new ValidationException('ips must contain at most 50000 entries');
        }

        return $normalized;
    }
}
