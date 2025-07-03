# Ipgeolocation\Sdk\IPSecurityAPI

All URIs are relative to https://api.ipgeolocation.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getBulkIpSecurityInfo()**](IPSecurityAPI.md#getBulkIpSecurityInfo) | **POST** /security-bulk |  |
| [**getIpSecurityInfo()**](IPSecurityAPI.md#getIpSecurityInfo) | **GET** /security |  |


## `getBulkIpSecurityInfo()`

```php
getBulkIpSecurityInfo($bulk_ip_request, $include, $fields, $excludes, $output, $lang): \Ipgeolocation\Sdk\\Model\BulkIPSecurityResponse[]
```



The Bulk IP Security Lookup API can provide security details for up to `50,000` bulk IPs. This API also has parameters to customize the response, just like the single IP Security Lookup API.

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **bulk_ip_request** | [**\Ipgeolocation\Sdk\\Model\BulkIPRequest**](../Model/BulkIPRequest.md)|  | |
| **include** | **string**| Include optional objects like &#x60;location&#x60;, &#x60;network&#x60;.  Use comma-separated values. Example: include&#x3D;location,network | [optional] |
| **fields** | **string**| Get specific fields, objects from the response. | [optional] |
| **excludes** | **string**| Exclude specific fields, objects from the response. | [optional] |
| **output** | **string**| Desired output format. | [optional] |
| **lang** | **string**| By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\BulkIPSecurityResponse[]**](../Model/BulkIPSecurityResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getIpSecurityInfo()`

```php
getIpSecurityInfo($ip, $include, $fields, $excludes, $output, $lang): \Ipgeolocation\Sdk\\Model\IPSecurityAPIResponse
```



IP Security API provides security details of a given IP. It detects whether the IP is proxy, tor or bot. It also shows the proxy types of the IP (like VPN, PROXY, RELAY etc.) with it's VPN/proxy service provider making our API powerful VPN checker. It finds the IPs that are involved in spam activities. It also checks whether the IP links to a cloud provider and includes the provider's name.

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ip** | **string**| query parameter &#39;ip&#39;. If not provided, will be your network IP | [optional] |
| **include** | **string**| Include optional details like location and/or network. | [optional] |
| **fields** | **string**| Get specific fields, objects from the response. | [optional] |
| **excludes** | **string**| Exclude specific fields, objects from the response. | [optional] |
| **output** | **string**| Desired output format (json or xml). | [optional] |
| **lang** | **string**| By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\IPSecurityAPIResponse**](../Model/IPSecurityAPIResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
