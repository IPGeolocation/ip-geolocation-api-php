<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

final class ResponseFormat
{
    public const JSON = 'json';
    public const XML = 'xml';

    private function __construct()
    {
    }

    public static function normalize(?string $value): string
    {
        if ($value === null) {
            return self::JSON;
        }

        $normalized = strtolower(trim($value));
        if ($normalized === '') {
            throw new ValidationException('output must not be blank');
        }

        if (!in_array($normalized, [self::JSON, self::XML], true)) {
            throw new ValidationException('output must be "json" or "xml"');
        }

        return $normalized;
    }
}
