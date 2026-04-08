<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk\Test\Support;

use Ipgeolocation\Sdk\HttpRequestData;
use Ipgeolocation\Sdk\HttpResponseData;
use Ipgeolocation\Sdk\HttpTransport;

final class FakeTransport implements HttpTransport
{
    /** @var array<int, HttpResponseData|\Throwable> */
    private array $responses = [];

    /** @var array<int, HttpRequestData> */
    public array $requests = [];

    public function push(HttpResponseData|\Throwable $response): void
    {
        $this->responses[] = $response;
    }

    public function sendRequest(HttpRequestData $request): HttpResponseData
    {
        $this->requests[] = $request;
        $next = array_shift($this->responses);
        if ($next instanceof \Throwable) {
            throw $next;
        }

        if (!$next instanceof HttpResponseData) {
            throw new \RuntimeException('No fake response queued');
        }

        return $next;
    }

    public function close(): void
    {
    }
}
