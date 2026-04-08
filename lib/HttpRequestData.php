<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

final class HttpRequestData extends ValueObject
{
    /**
     * @param array<string, array<int, string>> $headers
     */
    public function __construct(
        public readonly string $url,
        public readonly string $method,
        public readonly array $headers,
        public readonly ?string $body,
        public readonly float $connect_timeout,
        public readonly float $read_timeout
    ) {
    }
}
