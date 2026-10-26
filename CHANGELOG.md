# Changelog

## 3.0.2

- Enforce connection and read limits with cURL, reject truncated responses, and bound decoded response bodies, including gzip.
- Validate HTTP headers and user-agent values before sending requests, including through custom transports.
- Redact API keys from configuration debug output and transport diagnostics, and close response streams after use.
- Report timeouts without incorrectly identifying the connection phase or duration.
- Add local HTTP/TLS regression coverage and CI for PHP 8.1 through 8.5, including the lowest allowed dependencies on PHP 8.1.
- Keep public methods, response models, JSON/XML support and PHP 8.1 syntax compatibility. Custom Guzzle exception subclasses with incompatible constructors are normalized to the corresponding base exception, and nested diagnostic causes are redacted copies.

## 3.0.1

- Raised the minimum `guzzlehttp/guzzle` version to 7.15.2 and the dev `phpunit/phpunit` version to 10.5.62, so installs can no longer resolve releases with known security vulnerabilities. No API or behavior changes.

## 3.0.0

- Replaced the old multi-API SDK with the new PHP SDK for the IPGeolocation.io IP Location API.
- Added typed and raw single lookup methods for `/v3/ipgeo`.
- Added typed and raw bulk lookup methods for `/v3/ipgeo-bulk`.
- Added request validation, metadata parsing, and explicit error mapping.
