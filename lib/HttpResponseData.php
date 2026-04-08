<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

final class HttpResponseData extends ValueObject
{
    /**
     * @param array<string, array<int, string>> $headers
     */
    public function __construct(
        public readonly int $status_code,
        public readonly string $body,
        public readonly array $headers
    ) {
    }
}
