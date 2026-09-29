# Changelog

## 3.0.1

- Raised the minimum `guzzlehttp/guzzle` version to 7.15.2 and the dev `phpunit/phpunit` version to 10.5.62, so installs can no longer resolve releases with known security vulnerabilities. No API or behavior changes.

## 3.0.0

- Replaced the old multi-API SDK with the new PHP SDK for the IPGeolocation.io IP Location API.
- Added typed and raw single lookup methods for `/v3/ipgeo`.
- Added typed and raw bulk lookup methods for `/v3/ipgeo-bulk`.
- Added request validation, metadata parsing, and explicit error mapping.
