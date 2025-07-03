# Ipgeolocation\Sdk\TimezoneAPI

All URIs are relative to https://api.ipgeolocation.io/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getTimezoneInfo()**](TimezoneAPI.md#getTimezoneInfo) | **GET** /timezone | Timezone information details |


## `getTimezoneInfo()`

```php
getTimezoneInfo($tz, $location, $lat, $long, $ip, $iata_code, $icao_code, $lo_code, $output, $lang): \Ipgeolocation\Sdk\\Model\TimeZoneDetailedResponse
```

Timezone information details

The Time Zone API provides current time, date, and time zone-related information. It supports various input types including time zone name, geographic coordinates, addresses, IPs, and location codes.  The API determines the time zone based on the following priority order if multiple parameters are provided:   1. Time Zone Name   2. Geographic Coordinates (latitude & longitude)   3. Location Address   4. IP Address   5. IATA Code   6. ICAO Code   7. UN/LOCODE  Enriched response data is returned based on the type of input: - IP: includes geolocation info - Address: includes location metadata - IATA/ICAO: includes airport info - UN/LOCODE: includes city details  You can call the time zone API without passing any time zone, coordinates, IATA, ICAO, LO code or IP address as well. It will use the calling machine's IP address to return the regional time zone information.

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tz** | **string**| pass a valid time zone name as a query parameter tz to get the time zone information. | [optional] |
| **location** | **string**| pass any address of a location as the query parameter location to get the time zone information. | [optional] |
| **lat** | **float**| pass the latitude of a location as query parameters to get the time zone information. | [optional] |
| **long** | **float**| pass the longitude of a location as query parameters to get the time zone information. | [optional] |
| **ip** | **string**| You can pass any IPv4 or IPv6 address as a query parameter ip to get the regional timezone information. | [optional] |
| **iata_code** | **string**| pass any 3 letter IATA code as a query paramter iata_code to get the comprehensive airport details along with the time zone information, in which that airport exists. | [optional] |
| **icao_code** | **string**| pass any 4 letter ICAO code as a query paramter icao_code to get the comprehensive airport details along with the time zone information, in which that airport exists. | [optional] |
| **lo_code** | **string**| pass any 5 letter UNLOCODE as a query paramter lo_code to get the comprehensive lo code/city details along with the time zone information of the concerned city. | [optional] |
| **output** | **string**| Desired output format (json or xml). | [optional] |
| **lang** | **string**| By default, the API responds in English. You can change the response language by passing the language code as a query parameter &#x60;lang&#x60;. Multi language feature is available only for &#x60;paid users&#x60;. | [optional] |

### Return type

[**\Ipgeolocation\Sdk\\Model\TimeZoneDetailedResponse**](../Model/TimeZoneDetailedResponse.md)

### Authorization

[ApiKeyAuth](../../README.md#ApiKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
