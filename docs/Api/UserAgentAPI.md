# Ipgeolocation\Sdk\UserAgentAPI

All URIs are relative to https://api.ipgeolocation.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getUserAgentDetails()**](UserAgentAPI.md#getUserAgentDetails) | **GET** /user-agent | Get details of user-agent |
| [**parseBulkUserAgentStrings()**](UserAgentAPI.md#parseBulkUserAgentStrings) | **POST** /user-agent-bulk | Handle multiple user-agent string lookups |
| [**parseUserAgentString()**](UserAgentAPI.md#parseUserAgentString) | **POST** /user-agent | Handle single User-Agent string |


## `getUserAgentDetails()`

```php
getUserAgentDetails($user_agent, $output): \Ipgeolocation\Sdk\\Model\UserAgentData
```

Get details of user-agent

User Agent Parser API provides the accurate browser, device, and operating system details from a User Agent String. It also provides information about crawlers and attack sources. You can use these details to customize user experience, prevent crawlers and attackers from accessing your website.

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **user_agent** | **string**|  | [optional] |
| **output** | **string**| Desired output format (json or xml). | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\UserAgentData**](../Model/UserAgentData.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `parseBulkUserAgentStrings()`

```php
parseBulkUserAgentStrings($output, $parse_bulk_user_agent_strings_request): \Ipgeolocation\Sdk\\Model\UserAgentData[]
```

Handle multiple user-agent string lookups

This endpoint allows you to perform the parsing of multiple User-Angent strings (max. 50,000) at the same time. The requests count per round is equal to total User-Agent strings passed. This feature is `only available for paid plans`.

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **output** | **string**| Desired output format (json or xml). | [optional] |
| **parse_bulk_user_agent_strings_request** | [**\Ipgeolocation\Sdk\\Model\BulkUserAgentRequest**](../Model/BulkUserAgentRequest.md)|  | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\UserAgentData[]**](../Model/UserAgentData.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `parseUserAgentString()`

```php
parseUserAgentString($output, $parse_user_agent_string_request): \Ipgeolocation\Sdk\\Model\UserAgentData
```

Handle single User-Agent string

You can also provide custom User-Agent string to parse in JSON payload. This endpoint is meant to be called from server-side and is available for paid subscriptions only.
### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **output** | **string**| Desired output format (json or xml). | [optional] |
| **parse_user_agent_string_request** | [**\Ipgeolocation\Sdk\\Model\UserAgentRequest**](../Model/UserAgentRequest.md)|  | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\UserAgentData**](../Model/UserAgentData.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
