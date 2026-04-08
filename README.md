# IPGeolocation PHP SDK

Official PHP SDK for the IPGeolocation.io IP Location API.

Look up IPv4, IPv6, and domains with `/v3/ipgeo` and `/v3/ipgeo-bulk`. Get geolocation, company, ASN, timezone, network, hostname, abuse, user-agent, and security data.

- PHP 8.1+
- Sync client built on Guzzle
- Typed responses plus raw JSON and XML methods

## Table of Contents

- [Installation](#installation)
- [Quick Start](#quick-start)
- [At a Glance](#at-a-glance)
- [Get Your API Key](#get-your-api-key)
- [Authentication](#authentication)
- [Plan Behavior](#plan-behavior)
- [Client Configuration](#client-configuration)
- [Available Methods](#available-methods)
- [Request Options](#request-options)
- [Examples](#examples)
- [Response Metadata](#response-metadata)
- [JSON Helpers](#json-helpers)
- [Errors](#errors)
- [Troubleshooting](#troubleshooting)
- [Frequently Asked Questions](#frequently-asked-questions)
- [Links](#links)

## Installation

```bash
composer require ipgeolocation/ipgeolocation-php-sdk
```

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Ipgeolocation\Sdk\IpGeolocationClient;
```

- package: `ipgeolocation/ipgeolocation-php-sdk`
- Package page: <https://packagist.org/packages/ipgeolocation/ipgeolocation-php-sdk>
- GitHub repository: <https://github.com/IPGeolocation/ip-geolocation-api-php>

## Quick Start

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Ipgeolocation\Sdk\IpGeolocationClient;

$client = new IpGeolocationClient([
    'api_key' => getenv('IPGEO_API_KEY'),
]);

try {
    $response = $client->lookupIpGeolocation([
        'ip' => '8.8.8.8',
    ]);

    echo $response->data->ip . PHP_EOL; // 8.8.8.8
    echo ($response->data->location?->country_name ?? '') . PHP_EOL; // United States
    echo ($response->data->location?->city ?? '') . PHP_EOL;
    echo ($response->data->time_zone?->name ?? '') . PHP_EOL;
    echo ($response->metadata->credits_charged ?? 0) . PHP_EOL;
} finally {
    $client->close();
}
```

You can pass plain arrays to request methods. If you want validation before the request is sent, use `LookupIpGeolocationRequest` and `BulkLookupIpGeolocationRequest`.

## At a Glance

| Item | Value |
|------|-------|
| Package | `ipgeolocation/ipgeolocation-php-sdk` |
| Namespace | `Ipgeolocation\Sdk` |
| Supported Endpoints | `/v3/ipgeo`, `/v3/ipgeo-bulk` |
| Supported Inputs | IPv4, IPv6, domain |
| Main Data Returned | Geolocation, company, ASN, timezone, network, hostname, abuse, user-agent, currency, security |
| Authentication | API key, request-origin auth for `/v3/ipgeo` only |
| Response Formats | Structured JSON, raw JSON, raw XML |
| Bulk Limit | Up to 50,000 IPs or domains per request |
| Transport | Guzzle |

## Get Your API Key

Create an IPGeolocation account and copy an API key from your dashboard.

1. Sign up: <https://app.ipgeolocation.io/signup>
2. Verify your email if prompted
3. Sign in: <https://app.ipgeolocation.io/login>
4. Open your dashboard: <https://app.ipgeolocation.io/dashboard>
5. Copy an API key from the `API Keys` section

For server-side code, keep the API key in an environment variable or secret manager. For browser-based single lookups on paid plans, use request-origin auth instead of exposing an API key in frontend code.

## Authentication

### API Key

```php
$client = new IpGeolocationClient([
    'api_key' => getenv('IPGEO_API_KEY'),
]);
```

### Request-Origin Auth

```php
$client = new IpGeolocationClient([
    'request_origin' => 'https://app.example.com',
]);
```

`request_origin` must be an absolute `http` or `https` origin with no path, query string, fragment, or userinfo.

> [!IMPORTANT]
> Request-origin auth does not work with `/v3/ipgeo-bulk`. Bulk lookup always requires `api_key`.

> [!NOTE]
> If you set both `api_key` and `request_origin`, both are sent. The API key appears in the query string, so avoid logging full request URLs.

## Plan Behavior

Feature availability depends on your plan and request parameters.

| Capability | Free | Paid |
|------------|------|------|
| Single IPv4 and IPv6 lookup | Supported | Supported |
| Domain lookup | Not supported | Supported |
| Bulk lookup | Not supported | Supported |
| Non-English `lang` | Not supported | Supported |
| Request-origin auth | Not supported | Supported for `/v3/ipgeo` only |
| Optional modules via `include` | Not supported | Supported |
| `include: ["*"]` | Base response only | All plan-available modules |

Paid plans still need `include` for optional modules. `fields` and `excludes` only trim the response. They do not turn modules on or unlock paid data.

## Client Configuration

| Field | Type | Default | Notes |
|-------|------|---------|-------|
| `api_key` | `string` | unset | Required for bulk lookup. Optional for single lookup if `request_origin` is set. |
| `request_origin` | `string` | unset | Must be an absolute `http` or `https` origin. |
| `base_url` | `string` | `https://api.ipgeolocation.io` | Override the API base URL. |
| `connect_timeout` | `float` | `10.0` | Time to open the connection, in seconds. |
| `read_timeout` | `float` | `30.0` | Time to wait for response data before timing out, in seconds. |

The client constructor accepts either an `IpGeolocationClientConfig` or an array with the same keys.

## Available Methods

| Method | Returns | Notes |
|--------|---------|-------|
| `lookupIpGeolocation($request = null)` | `ApiResponse` with typed `data` | Single lookup. Typed JSON response. |
| `lookupIpGeolocationRaw($request = null)` | `ApiResponse` with string `data` | Single lookup. Raw JSON or XML string. |
| `bulkLookupIpGeolocation($request)` | `ApiResponse` with bulk result array | Bulk lookup. Typed JSON response. |
| `bulkLookupIpGeolocationRaw($request)` | `ApiResponse` with string `data` | Bulk lookup. Raw JSON or XML string. |
| `close()` | `void` | Closes the client. Do not reuse the client after this. |

> [!NOTE]
> Typed methods support JSON only. Use the raw methods when you need XML output.

## Request Options

| Field | Applies To | Notes |
|-------|------------|-------|
| `ip` | Single lookup | IPv4, IPv6, or domain. Omit it for caller IP lookup. |
| `ips` | Bulk lookup | Array of 1 to 50,000 IPs or domains. |
| `lang` | Single and bulk | One of `en`, `de`, `ru`, `ja`, `fr`, `cn`, `es`, `cs`, `it`, `ko`, `fa`, `pt`. |
| `include` | Single and bulk | Array of module names such as `security`, `abuse`, `user_agent`, `hostname`, `liveHostname`, `hostnameFallbackLive`, `geo_accuracy`, `dma_code`, or `*`. |
| `fields` | Single and bulk | Array of field paths to keep, for example `["location.country_name", "security.threat_score"]`. |
| `excludes` | Single and bulk | Array of field paths to remove from the response. |
| `user_agent` | Single and bulk | Overrides the outbound `User-Agent` header. |
| `headers` | Single and bulk | Extra request headers. Use an associative array where each value is a string or an array of strings. |
| `output` | Single and bulk | `"json"` or `"xml"`. Typed methods require JSON. |

## Examples

The examples below assume you already have a configured client in scope:

```php
$client = new IpGeolocationClient([
    'api_key' => getenv('IPGEO_API_KEY'),
]);
```

### Caller IP

Omit `ip` to look up the public IP of the machine making the request.

```php
$response = $client->lookupIpGeolocation();
echo $response->data->ip . PHP_EOL;
```

### Domain Lookup

Domain lookup is a paid-plan feature.

```php
$response = $client->lookupIpGeolocation([
    'ip' => 'ipgeolocation.io',
]);

echo $response->data->ip . PHP_EOL;
echo ($response->data->domain ?? '') . PHP_EOL; // ipgeolocation.io
echo ($response->data->location?->country_name ?? '') . PHP_EOL;
```

### Security and Abuse

```php
$response = $client->lookupIpGeolocation([
    'ip' => '9.9.9.9',
    'include' => ['security', 'abuse'],
]);

echo ($response->data->security?->threat_score ?? 0) . PHP_EOL;
echo ($response->data->abuse?->emails[0] ?? '') . PHP_EOL;
```

### User-Agent Parsing

To parse a visitor user-agent string, pass `include: ["user_agent"]` and send the visitor string in the request `User-Agent` header.

```php
$visitorUa = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9';

$response = $client->lookupIpGeolocation([
    'ip' => '115.240.90.163',
    'include' => ['user_agent'],
    'headers' => ['User-Agent' => $visitorUa],
]);

echo ($response->data->user_agent?->name ?? '') . PHP_EOL;
echo ($response->data->user_agent?->operating_system?->name ?? '') . PHP_EOL;
```

> [!NOTE]
> The `user_agent` request field overrides the SDK's default outbound `User-Agent` header. It takes precedence over `headers["User-Agent"]`.

### Filtered Response

```php
$response = $client->lookupIpGeolocation([
    'ip' => '8.8.8.8',
    'include' => ['security'],
    'fields' => ['location.country_name', 'security.threat_score', 'security.is_vpn'],
    'excludes' => ['currency'],
]);

echo ($response->data->location?->country_name ?? '') . PHP_EOL;
echo ($response->data->security?->threat_score ?? 0) . PHP_EOL;
echo ($response->data->security?->is_vpn ? 'true' : 'false') . PHP_EOL;
```

### Raw XML

```php
$response = $client->lookupIpGeolocationRaw([
    'ip' => '8.8.8.8',
    'output' => 'xml',
]);

echo $response->data . PHP_EOL;
```

### Bulk Lookup

Bulk lookup is a paid-plan feature and always requires `api_key`.

Each bulk result is either a success or an error.

```php
$response = $client->bulkLookupIpGeolocation([
    'ips' => ['8.8.8.8', 'invalid-ip', '1.1.1.1'],
    'include' => ['security'],
]);

foreach ($response->data as $result) {
    if ($result->success) {
        echo $result->data->ip . PHP_EOL;
        echo ($result->data->security?->threat_score ?? 0) . PHP_EOL;
        continue;
    }

    echo ($result->error->message ?? '') . PHP_EOL;
}
```

## Response Metadata

Each method returns an `ApiResponse` with `data` and `metadata`.

`metadata` includes:

| Field | Meaning |
|-------|---------|
| `credits_charged` | Credits charged for the request when the API returns that header |
| `successful_records` | Number of successful bulk records when the API returns that header |
| `status_code` | HTTP status code |
| `duration_ms` | Client-side request time in milliseconds |
| `raw_headers` | Response headers as an associative array of header names to string arrays |

Helper methods:

```php
$metadata = $response->metadata;

echo $metadata->status_code . PHP_EOL;
echo $metadata->duration_ms . PHP_EOL;
print_r($metadata->headerValues('X-Credits-Charged'));
echo ($metadata->firstHeaderValue('Content-Type') ?? '') . PHP_EOL;
```

## JSON Helpers

Typed response objects extend `ValueObject`, so you can turn them into arrays or JSON when you need to log, cache, or forward them.

```php
$array = $response->data->toArray();
$json = json_encode($response->data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);

print_r($array);
echo $json . PHP_EOL;
```

## Errors

The SDK throws these exception classes:

- `Ipgeolocation\Sdk\ValidationException`
- `Ipgeolocation\Sdk\SerializationException`
- `Ipgeolocation\Sdk\TransportException`
- `Ipgeolocation\Sdk\RequestTimeoutException`
- `Ipgeolocation\Sdk\ApiException`
- `Ipgeolocation\Sdk\BadRequestException`
- `Ipgeolocation\Sdk\UnauthorizedException`
- `Ipgeolocation\Sdk\ForbiddenException`
- `Ipgeolocation\Sdk\NotFoundException`
- `Ipgeolocation\Sdk\MethodNotAllowedException`
- `Ipgeolocation\Sdk\PayloadTooLargeException`
- `Ipgeolocation\Sdk\UnsupportedMediaTypeException`
- `Ipgeolocation\Sdk\LockedException`
- `Ipgeolocation\Sdk\RateLimitException`
- `Ipgeolocation\Sdk\ClientClosedRequestException`
- `Ipgeolocation\Sdk\ServerErrorException`

Example:

```php
try {
    $client->lookupIpGeolocation(['ip' => '8.8.8.8']);
} catch (\Ipgeolocation\Sdk\ApiException $error) {
    echo $error->status_code . PHP_EOL;
    echo ($error->api_message ?? '') . PHP_EOL;
    echo $error->getMessage() . PHP_EOL;
}
```

## Troubleshooting

- `bulk lookup requires api_key in client config`
  Bulk lookup does not support request-origin auth on its own.
- `single lookup requires api_key or request_origin in client config`
  Set at least one authentication option before calling the single lookup methods.
- `XML output is not supported by typed methods`
  Use `lookupIpGeolocationRaw` or `bulkLookupIpGeolocationRaw` for XML output.
- `client is closed`
  Create a new client after calling `close`.
- `TransportException` or `RequestTimeoutException`
  Increase `connect_timeout` or `read_timeout`, or add retry logic. `read_timeout` is how long the client waits for response data before timing out.

## Frequently Asked Questions

<details>
<summary><strong>Can I pass a plain array instead of a request object?</strong></summary>
Yes. All client methods accept either the typed request object or a plain array with the same keys.
</details>

<details>
<summary><strong>How do I look up my own public IP?</strong></summary>
Call <code>lookupIpGeolocation()</code> with no <code>ip</code> value.
</details>

<details>
<summary><strong>How do I get XML?</strong></summary>
Use the raw methods with <code>output =&gt; "xml"</code>.
</details>

<details>
<summary><strong>How do I read bulk errors?</strong></summary>
Check <code>$result-&gt;success</code>. Success items use <code>$result-&gt;data</code>. Error items use <code>$result-&gt;error-&gt;message</code>.
</details>

## Links

- API docs: <https://ipgeolocation.io/documentation/ip-location-api.html>
- Dashboard: <https://app.ipgeolocation.io/dashboard>
- Pricing: <https://ipgeolocation.io/pricing.html>
- Packagist package: <https://packagist.org/packages/ipgeolocation/ipgeolocation-php-sdk>
- GitHub repo: <https://github.com/IPGeolocation/ip-geolocation-api-php>
