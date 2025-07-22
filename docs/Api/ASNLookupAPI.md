# Ipgeolocation\Sdk\ASNLookupAPI

All URIs are relative to https://api.ipgeolocation.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getAsnInfo()**](ASNLookupAPI.md#getAsnInfo) | **GET** /asn |  |


## `getAsnInfo()`

```php
getAsnInfo($ip, $asn, $include, $excludes, $fields): \Ipgeolocation\Sdk\\Model\ASNResponse
```



ASN API provides comprehensive details for an ASN including the as name,  organization name, the country of registration, associated domain, and its  type (ISP, host provider, or business). The API also shows the allocation  date of provided ASN and if it is currently allocated or not. It also contains  the routing information including peering, upstreams, and downstreams to help  understand the relationship between different ASNs.  Example Use Cases:  - Looking up ASN information for an IP address (e.g., `GET /asn?ip=8.8.8.8`)  - Retrieving ASN information for a specific ASN number (e.g., `GET /asn?asn=12345`)  - Getting peering relationships for an ASN (e.g., `GET /asn?asn=12345&include=peers`)

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ip** | **string**| query parameter &#39;ip&#39;. | [optional] |
| **asn** | **int**| query paramter &#39;asn&#39;. | [optional] |
| **include** | **string**| This parameter can have four options: a) peers b) downstreams c) upstreams d) routes e) whois_response. You may add any of them in comma-separated way. In order to get the ASN details with peering data, pass peers string in the include parameter like mentioned below. | [optional] |
| **excludes** | **string**| You can exclude fields from the response according to you requirement with the exception of ip field. For example, you want to remove date_allocated and allocation_status from api response, you can put the keys in excludes parameter like this. | [optional] |
| **fields** | **string**| You can filter out only those fields which you want to see in the response by using the fields parameter. To retrieve only the AS organization, its country and downstreams in api response, you can put the keys in fields parameter like this. API will combine these fields with the default ASN response. Note: Parameters &#x60;peers, downstreams, upstreams, routes, whois_response&#x60; can be used in both &#x60;include&#x60; , and &#x60;fields&#x60;. If you use include and fields at the same time, fields parameter will be considered only. | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\ASNResponse**](../Model/ASNResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#api-endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
