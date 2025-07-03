# Ipgeolocation\Sdk\TimeConversionAPI

All URIs are relative to https://api.ipgeolocation.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**convertTimeBetweenTimezones()**](TimeConversionAPI.md#convertTimeBetweenTimezones) | **GET** /timezone/convert |  |


## `convertTimeBetweenTimezones()`

```php
convertTimeBetweenTimezones($time, $tz_from, $tz_to, $lat_from, $long_from, $lat_to, $long_to, $location_from, $location_to, $icao_from, $icao_to, $iata_from, $iata_to, $locode_from, $locode_to): \Ipgeolocation\Sdk\\Model\TimeConversionResponse
```



You can convert a timestamp provided as a query paramter time from one time zone to another time zone.

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **time** | **string**| time parameter takes the input in the following two formats: i) &#39;yyyy-MM-dd HH:mm&#39;, and ii) &#39;yyyy-MM-dd HH:mm:ss&#39;. This parameter is optional and you can omit it to convert the current time between two coordinates, time zones or locations. | [optional] |
| **tz_from** | **string**| timezone to convert from | [optional] |
| **tz_to** | **string**| timezone to convert to | [optional] |
| **lat_from** | **float**| latitude to convert from | [optional] |
| **long_from** | **float**| longitude to convert from | [optional] |
| **lat_to** | **float**| latitude to convert to | [optional] |
| **long_to** | **float**| longitude to convert to | [optional] |
| **location_from** | **string**| location to convert from | [optional] |
| **location_to** | **string**| location to convert to | [optional] |
| **icao_from** | **string**| location to convert from | [optional] |
| **icao_to** | **string**| location to convert to | [optional] |
| **iata_from** | **string**| location to convert from | [optional] |
| **iata_to** | **string**| location to convert to | [optional] |
| **locode_from** | **string**| location to convert from | [optional] |
| **locode_to** | **string**| location to convert to | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\TimeConversionResponse**](../Model/TimeConversionResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
