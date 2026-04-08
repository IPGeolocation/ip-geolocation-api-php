<?php

declare(strict_types=1);

namespace Ipgeolocation\Sdk;

interface HttpTransport
{
    public function sendRequest(HttpRequestData $request): HttpResponseData;

    public function close(): void;
}
