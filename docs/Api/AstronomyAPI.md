# Ipgeolocation\Sdk\AstronomyAPI

All URIs are relative to https://api.ipgeolocation.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getAstronomyDetails()**](AstronomyAPI.md#getAstronomyDetails) | **GET** /astronomy |  |


## `getAstronomyDetails()`

```php
getAstronomyDetails($ip, $location, $lat, $long, $date, $output, $lang): \Ipgeolocation\Sdk\\Model\AstronomyResponse
```



The Astronomy API provides the location-based rise and set times for the Sun and Moon along with the current position, distance from earth, and azimuth of the Sun and the Moon for a specific date at the queried time.

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ip** | **string**| query paramter &#39;ip&#39;. If not provided, will be your network IP | [optional] |
| **location** | **string**| query paramter &#39;location&#39;. If not provided, will be your ip location | [optional] |
| **lat** | **string**| query paramter &#39;lat&#39;. | [optional] |
| **long** | **string**| query paramter &#39;long&#39;. | [optional] |
| **date** | **string**| The date (YYYY-MM-DD) to lookup for. default will be the current date | [optional] |
| **output** | **string**| Desired output format. | [optional] |
| **lang** | **string**| By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\AstronomyResponse**](../Model/AstronomyResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#api-endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
