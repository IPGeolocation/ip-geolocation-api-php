# Changelog

## 3.0.2

- Hide API keys in errors and when using `print_r()` or `var_dump()` on clients or settings.
- Keep redirects from sending lookup data and custom headers to another server.
- Fix connection and response timeouts.
- Keep HTTP status codes when error responses cannot be read.
- Check bulk results for missing, extra or invalid entries.
- Add Arabic (`ar`) and the missing CDN, proxy, bot and corporate gateway fields.

Existing public methods and PHP 8.1+ support remain available.

## 3.0.1

- Raised the minimum `guzzlehttp/guzzle` version to 7.15.2 and the dev `phpunit/phpunit` version to 10.5.62, so installs can no longer resolve releases with known security vulnerabilities. No API or behavior changes.

## 3.0.0

- Replaced the old multi-API SDK with the new PHP SDK for the IPGeolocation.io IP Location API.
- Added typed and raw single lookup methods for `/v3/ipgeo`.
- Added typed and raw bulk lookup methods for `/v3/ipgeo-bulk`.
- Added request validation, metadata parsing, and explicit error mapping.
