# # ASNDetails

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**as_number** | **string** |  | [optional]
**organization** | **string** |  | [optional]
**country** | **string** |  | [optional]
**asn_name** | **string** |  | [optional]
**type** | **string** |  | [optional]
**domain** | **string** |  | [optional]
**date_allocated** | **\DateTime** |  | [optional]
**allocation_status** | **string** |  | [optional]
**num_of_ipv4_routes** | **int** |  | [optional]
**num_of_ipv6_routes** | **int** |  | [optional]
**rir** | **string** |  | [optional]
**routes** | **string[]** | It will only be included in the response, if you set include&#x3D;routes in the request | [optional]
**upstreams** | [**\Ipgeolocation\Sdk\\Model\ASNConnection[]**](ASNConnection.md) | It will only be included in the response, if you set include&#x3D;upstreams in the request | [optional]
**downstreams** | [**\Ipgeolocation\Sdk\\Model\ASNConnection[]**](ASNConnection.md) | It will only be included in the response, if you set include&#x3D;downstreams in the request | [optional]
**peers** | [**\Ipgeolocation\Sdk\\Model\ASNConnection[]**](ASNConnection.md) | It will only be included in the response, if you set include&#x3D;peers in the request | [optional]
**whois_response** | **string** | It will only be included in the response, if you set include&#x3D;whois_response in the request | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#api-endpoints) [[Back to README]](../../README.md)
