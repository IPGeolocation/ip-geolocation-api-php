# IP Geolocation API PHP SDK

## Overview
The official **PHP Client Library/SDK** for **[IPGeolocation.io](https://ipgeolocation.io)**'s set of APIs, provides a quick, developer friendly, way to access IP Location, threat intelligence, Timezone, Astronomy, ASN, Abuse Contact, and user-agent data. Lookup your own IP or provide any IPv4, IPv6 or domain name to get structured results in PHP, without the need for manual HTTP handling.

- [IP Location API](https://ipgeolocation.io/ip-location-api.html): Get all-in-one unified solution for **location** (city, locality, state, country, etc.), **currency**, **network** (AS number, ASN name, organization, asn type, date of allocation, company/ISP name, company type, company domain), **timezone** , **useragent** string parsing, **security** (threat score, is_tor, is_bot, proxy_provider, cloud_provider), and **abuse contact** (route/CIDR network, country, address, email, phone numbers) information.
- [IP Security API](https://ipgeolocation.io/ip-security-api.html): Get security, network, location, hostname, timezone and useragent parsing.
- [ASN API](https://ipgeolocation.io/asn-api.html): Get ASN details along with peers, upstreams, downstreams, routes, and raw WHOIS.
- [Abuse Contact API](https://ipgeolocation.io/ip-abuse-contact-api.html): Get abuse emails, phone numbers, kind, organization, route/CIDR network and country.
- [Astronomy API](https://ipgeolocation.io/astronomy-api.html): Get sunrise, sunset, moonrise, moonset, moon phases with precise twilight period times in combination with location information.
- [Timezone API](https://ipgeolocation.io/timezone-api.html): Get timezone name, multiple time formats, daylight saving status and its details along with location information.
- [Timezone Convert API](https://ipgeolocation.io/timezone-api.html): Convert time between timezone names, geo coordinates, location addresses, IATA codes, ICAO codes, or UN/LOCODE.
- [User Agent API](https://ipgeolocation.io/user-agent-api.html): Get browser, Operating System, and device info from single or multiple Useragent string parsing.

This library aims to empower developers to integrate threat intelligence, personalization, fraud prevention, compliance, and analytics features directly into PHP based applications. Whether you're enriching signup forms with ip geolocation data, localizing content, embedding threat intelligence in back-end systems, or converting time zones and currencies, the library ensures seamless, scalable integration with IPGeolocation.io's global API infrastructure.

Based on:
- API version: 2.0.0

**Official Release:**
- Available on [**Packagist**](https://packagist.org/packages/ipgeolocation/ipgeolocation-php-sdk)
- Source Code: [**GitHub Repository**](https://github.com/IPGeolocation/ip-geolocation-api-php)

## Table of Contents
1. [Requirements](#requirements)
2. [Installation](#installation)
   - [Using Composer](#using-composer)
   - [Manual Installation](#manual-installation)
3. [API Plan Tiers and Documentation](#api-plan-tiers-and-documentation)
4. [API Endpoints](#api-endpoints)
5. [Fields and Methods Availability](#fields-and-methods-availability)
6. [Authentication Setup](#authentication-setup)
   - [How to Get Your API Key](#how-to-get-your-api-key)
   - [ApiKeyAuth](#apikeyauth)
7. [IP Geolocation Examples](#ip-geolocation-examples)
   - [Developer (Free) Plan Examples](#developer-free-plan-examples)
   - [Standard Plan Examples](#standard-plan-examples)
   - [Advanced Plan Examples](#advanced-plan-examples)
   - [Bulk IP Geolocation Examples](#bulk-ip-geolocation-example)
8. [IP Security Examples](#ip-security-examples)
   - [Get Default Fields](#get-default-fields-2)
   - [Include Multiple Optional Fields](#include-multiple-optional-fields)
   - [Request with Field Filtering](#request-with-field-filtering)
   - [Bulk IP Security Lookup](#bulk-ip-security-lookup)
9. [ASN API Examples](#asn-api-examples)
   - [Get ASN Information by IP Address](#get-asn-information-by-ip-address)
   - [Get ASN Information by ASN Number](#get-asn-information-by-asn-number)
   - [Combine All objects using Include](#combine-all-objects-using-include)
10. [Abuse Contact API Examples](#abuse-contact-api-examples)
    - [Lookup Abuse Contact by IP](#lookup-abuse-contact-by-ip)
    - [Lookup Abuse Contact with Specific Fields](#lookup-abuse-contact-with-specific-fields)
    - [Lookup Abuse Contact while Excluding Fields](#lookup-abuse-contact-while-excluding-fields)
11. [Timezone API Examples](#timezone-api-examples)
    - [Get Timezone by IP Address](#get-timezone-by-ip-address)
    - [Get Timezone by Timezone Name](#get-timezone-by-timezone-name)
    - [Get Timezone from Any Address](#get-timezone-from-any-address)
    - [Get Timezone from Location Coordinates](#get-timezone-from-location-coordinates)
    - [Get Timezone and Airport Details from IATA Code](#get-timezone-and-airport-details-from-iata-code)
    - [Get Timezone and City Details from UN/LOCODE](#get-timezone-and-city-details-from-unlocode)
12. [Timezone Converter Examples](#timezone-converter-examples)
    - [Convert Current Time from One Timezone to Another](#convert-current-time-from-one-timezone-to-another)
13. [User Agent API Examples](#user-agent-api-examples)
    - [Parse a Basic User Agent String](#parse-a-basic-user-agent-string)
    - [Bulk User Agent Parsing Example](#bulk-user-agent-parsing-example)
14. [Astronomy API Examples](#astronomy-api-examples)
    - [Astronomy by Coordinates](#astronomy-by-coordinates)
    - [Astronomy by IP Address](#astronomy-by-ip-address)
    - [Astronomy by Location String](#astronomy-by-location-string)
    - [Astronomy for Specific Date](#astronomy-for-specific-date)
    - [Astronomy in Different Language](#astronomy-in-different-language)
15. [Models](#models)

## Requirements
- PHP 8.1 or higher
- Composer
- Guzzle (installed automatically via Composer)

## Installation
### Using Composer

It is recommended to install the SDK using Composer:

```bash
composer require ipgeolocation/ipgeolocation-php-sdk
```
If you want to include a local development version:
```bash
composer install
```

### Manual Installation
If you wish to manually include the SDK without Composer:
1. Clone this repository
2. Include the autoload.php from the vendor folder:
   ```php
   require_once('/path/to/vendor/autoload.php');
   ```
3. Ensure dependencies in `vendor/` are installed via:
   ```bash
   composer install
   ```

## API Plan Tiers and Documentation

The documentation below corresponds to the four available API tier plans:

- **Developer Plan** (Free): [Full Documentation](https://ipgeolocation.io/ip-location-api.html#Free)
- **Standard Plan**: [Full Documentation](https://ipgeolocation.io/ip-location-api.html#Standard)
- **Advance Plan**: [Full Documentation](https://ipgeolocation.io/ip-location-api.html#Advance)
- **Security Plan**: [Full Documentation](https://ipgeolocation.io/ip-security-api.html#documentation-overview)

For a detailed comparison of what each plan offers, visit the [Pricing Page](https://ipgeolocation.io/pricing.html).

## API Endpoints

All URIs are relative to *https://api.ipgeolocation.io/v2*

| Class               | Method                                                                                                                                                           | HTTP request              | Description                                                             |
|---------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------|-------------------------------------------------------------------------|
| *IPGeolocationAPI*  | [**getIpGeolocation**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/IPGeolocationAPI.md#getipgeolocation)                        | **GET** /ipgeo            | Get geolocation data for a single IP address                            |
| *IPGeolocationAPI*  | [**getBulkIpGeolocation**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/IPGeolocationAPI.md#getbulkipgeolocation)                | **POST** /ipgeo-bulk      | Get geolocation data for multiple IP addresses in a single API request  |
| *IPSecurityAPI*     | [**getIpSecurityInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/IPSecurityAPI.md#getipsecurityinfo)                         | **GET** /security         | Retrieve security information (VPN, TOR, proxy, etc.) for a single IP   |
| *IPSecurityAPI*     | [**getBulkIpSecurityInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/IPSecurityAPI.md#getbulkipsecurityinfo)                 | **POST** /security-bulk   | Retrieve security threat intelligence for multiple IPs                  |
| *ASNLookupAPI*      | [**getAsnInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/ASNLookupAPI.md#getasninfo)                                        | **GET** /asn              | Get details of any ASN number or associated IP address                  |
| *AbuseContactAPI*   | [**getAbuseContactInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/AbuseContactAPI.md#getabusecontactinfo)                   | **GET** /abuse            | Retrieve abuse reporting contact information for a given IP address     |
| *AstronomyAPI*      | [**getAstronomyDetails**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/AstronomyAPI.md#getastronomydetails)                      | **GET** /astronomy        | Get sunrise, sunset, moonrise, moonset, and related data for a location |
| *TimezoneAPI*       | [**getTimezoneInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/TimezoneAPI.md#gettimezoneinfo)                               | **GET** /timezone         | Timezone information details                                            |
| *TimeConversionAPI* | [**convertTimeBetweenTimezones**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/TimeConversionAPI.md#converttimebetweentimezones) | **GET** /timezone/convert | Convert time between two specified timezones                            |
| *UserAgentAPI*      | [**getUserAgentDetails**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/UserAgentAPI.md#getuseragentdetails)                      | **GET** /user-agent       | Get details of user-agent                                               |
| *UserAgentAPI*      | [**parseUserAgentString**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/UserAgentAPI.md#parseuseragentstring)                    | **POST** /user-agent      | Handle single User-Agent string                                         |
| *UserAgentAPI*      | [**parseBulkUserAgentStrings**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/UserAgentAPI.md#parsebulkuseragentstrings)          | **POST** /user-agent-bulk | Handle multiple user-agent string lookups                               |

## Fields and Methods Availability
IP Geolocation offers four plans from billing point of view: **Free, Standard, Security, Advance**. The availability of each method calling from the respective class, over all plans are presented below.

| Class               | Method                                                                                                                                                              | Free | Standard | Security | Advance |
|---------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------|:----:|:--------:|:--------:|:-------:|
| *IPGeolocationApi*  | [**getIpGeolocation**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/IPGeolocationAPI.md#get_ip_geolocation)                         |  ✔   |    ✔     |    ✖     |    ✔    |
| *IPGeolocationApi*  | [**getBulkIpGeolocation**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/IPGeolocationAPI.md#get_bulk_ip_geolocation)                |  ✖   |    ✔     |    ✖     |    ✔    |
| *IPSecurityApi*     | [**getIpSecurityInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/IPSecurityAPI.md#get_ip_security_info)                         |  ✖   |    ✖     |    ✔     |    ✖    |
| *IPSecurityApi*     | [**getBulkIpSecurityInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/IPSecurityAPI.md#get_bulk_ip_security_info)                |  ✖   |    ✖     |    ✔     |    ✖    |
| *ASNLookupApi*      | [**getAsnInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/ASNLookupAPI.md#get_asn_info)                                         |  ✖   |    ✖     |    ✖     |    ✔    |
| *AbuseContactApi*   | [**getAbuseContactInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/AbuseContactAPI.md#get_abuse_contact_info)                   |  ✖   |    ✖     |    ✖     |    ✔    |
| *AstronomyApi*      | [**getAstronomyDetails**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/AstronomyAPI.md#get_astronomy_details)                       |  ✔   |    ✔     |    ✔     |    ✔    |
| *TimezoneApi*       | [**getTimezoneInfo**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/TimezoneAPI.md#get_timezone_info)                                |  ✔   |    ✔     |    ✔     |    ✔    |
| *TimeConversionApi* | [**convertTimeBetweenTimezones**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/TimeConversionAPI.md#convert_time_between_timezones) |  ✔   |    ✔     |    ✔     |    ✔    |
| *UserAgentApi*      | [**getUserAgentDetails**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/UserAgentAPI.md#get_user_agent_details)                      |  ✔   |    ✔     |    ✔     |    ✔    |
| *UserAgentApi*      | [**parseUserAgentString**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/UserAgentAPI.md#parse_user_agent_string)                    |  ✔   |    ✔     |    ✔     |    ✔    |
| *UserAgentApi*      | [**parseBulkUserAgentStrings**](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Api/UserAgentAPI.md#parse_bulk_user_agent_strings)         |  ✖   |    ✔     |    ✔     |    ✔    |

> [!TIP]
> The availability of fields in every API endpoint across all API plans is provided in the **_Reference Table_** within each respective API Documentation. e.g., for IPGeolocationApi, please visit [https://ipgeolocation.io/ip-location-api.html#reference-to-ipgeolocation-api-response](https://ipgeolocation.io/ip-location-api.html#reference-to-ipgeolocation-api-response).


## Authentication Setup
To authenticate API requests, you will need an API key from [ipgeolocation.io](https://ipgeolocation.io/).

### How to Get Your API Key

1. **Sign up** here: [https://app.ipgeolocation.io/signup](https://app.ipgeolocation.io/signup)
2. **(optional)** Verify your email, if you signed up using email.
3. **Log in** to your account: [https://app.ipgeolocation.io/login](https://app.ipgeolocation.io/login)
4. After logging in, navigate to your **Dashboard** to find your API key: [https://app.ipgeolocation.io/dashboard](https://app.ipgeolocation.io/dashboard)

<a id="ApiKeyAuth"></a>
### ApiKeyAuth
Once you've obtained the api key, configure your can configure it as follows:
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
    ->setApiKey('apiKey', 'YOUR_API_KEY_HERE');
```
> [!TIP]
> Do not hardcode your API keys in code that is committed to public repositories.  
> Consider using environment variables or a secure vault instead. IPGeolocation.io also provides request origins (CORS) approach to eliminate the apiKey parameter. Check [https://ipgeolocation.io/documentation.html#authorization](https://ipgeolocation.io/documentation.html#authorization).


## IP Geolocation Examples

This section shows how to use the `getIpGeolocation()` method from the PHP SDK across **Free**, **Standard**, and **Advanced** subscription tiers. Each example highlights different parameter combinations: `fields`, `include`, and `excludes`.

**Parameters**

- `fields`: Use this parameter to include specific fields in the response.

- `excludes`: Use this parameter to omit specific fields from the response.

- `include`: Use this parameter to add optional modules to the response, such as:
  - `security`
  - `user_agent`
  - `hostname`
  - `liveHostname`
  - `hostnameFallbackLive`
  - `abuse`
  - `dma`
  - `timezone`

For the full list of supported fields and modules, please refer to the official [IP Geolocation API Documentation](https://ipgeolocation.io/ip-location-api.html#documentation-overview).

The `ip` parameter in the SDK can accept any valid IPv4 address, IPv6 address, or domain name. If the `ip=` parameter is not specified, the API will return information about the public IP of the machine where the SDK is running.


### Developer (Free) Plan Examples

#### Get Default Fields

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
    ->setApiKey('apiKey', 'YOUR_API_KEY');

$apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
    new GuzzleHttp\Client(),
    $config
);

try {
    $response = $apiInstance->getIpGeolocation(
        "8.8.8.8",  // IP
        null,       // lang
        null,       // fields
        null,       // excludes
        null,       // include
        null      // output
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling IPGeolocationAPI->getIpGeolocation: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "8.8.8.8",
    "location": {
        "continent_code": "NA",
        "continent_name": "North America",
        "country_code2": "US",
        "country_code3": "USA",
        "country_name": "United States",
        "country_name_official": "United States of America",
        "country_capital": "Washington, D.C.",
        "state_prov": "California",
        "state_code": "US-CA",
        "district": "Santa Clara",
        "city": "Mountain View",
        "zipcode": "94043-1351",
        "latitude": "37.42240",
        "longitude": "-122.08421",
        "is_eu": false,
        "country_flag": "https://ipgeolocation.io/static/flags/us_64.png",
        "geoname_id": "6301403",
        "country_emoji": "🇺🇸"
    },
    "country_metadata": {
        "calling_code": "+1",
        "tld": ".us",
        "languages": [
            "en-US",
            "es-US",
            "haw",
            "fr"
        ]
    },
    "currency": {
        "code": "USD",
        "name": "US Dollar",
        "symbol": "$"
    }
}                                                                    
```

Filtering Specific Fields from the Response (Use of '`exclude`' and '`fields`')
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
    new GuzzleHttp\Client(), $config);

try {
    $response = $apiInstance->getIpGeolocation(
        "8.8.4.4",                                     // IP
        null,                                          // lang
        "location",                                    // fields
        "location.continent_code,location.continent_name", // excludes
        null,                                          // include
        null                                         // output
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling IPGeolocationAPI->getIpGeolocation: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "8.8.4.4",
    "location": {
        "country_code2": "US",
        "country_code3": "USA",
        "country_name": "United States",
        "country_name_official": "United States of America",
        "country_capital": "Washington, D.C.",
        "state_prov": "California",
        "state_code": "US-CA",
        "district": "Santa Clara",
        "city": "Mountain View",
        "zipcode": "94043-1351",
        "latitude": "37.42240",
        "longitude": "-122.08421",
        "is_eu": false,
        "country_flag": "https://ipgeolocation.io/static/flags/us_64.png",
        "geoname_id": "6301403",
        "country_emoji": "🇺🇸"
    }
} 
```

### Standard Plan Examples
#### Get Default Fields

```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
    new GuzzleHttp\Client(),
    $config
);

try {
    $response = $apiInstance->getIpGeolocation(
        "8.8.8.8",  // IP
        null,       // lang
        null,       // fields
        null,       // excludes
        null,       // include
        null      // output
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling IPGeolocationAPI->getIpGeolocation: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "8.8.8.8",
    "location": {
        "continent_code": "NA",
        "continent_name": "North America",
        "country_code2": "US",
        "country_code3": "USA",
        "country_name": "United States",
        "country_name_official": "United States of America",
        "country_capital": "Washington, D.C.",
        "state_prov": "California",
        "state_code": "US-CA",
        "district": "Santa Clara",
        "city": "Mountain View",
        "zipcode": "94043-1351",
        "latitude": "37.42240",
        "longitude": "-122.08421",
        "is_eu": false,
        "country_flag": "https://ipgeolocation.io/static/flags/us_64.png",
        "geoname_id": "6301403",
        "country_emoji": "🇺🇸"
    },
    "country_metadata": {
        "calling_code": "+1",
        "tld": ".us",
        "languages": [
            "en-US",
            "es-US",
            "haw",
            "fr"
        ]
    },
    "network": {
        "asn": {
            "as_number": "AS15169",
            "organization": "Google LLC",
            "country": "US"
        },
        "company": {
            "name": "Google LLC"
        }
    },
    "currency": {
        "code": "USD",
        "name": "US Dollar",
        "symbol": "$"
    }
}
```
#### Retrieving Geolocation Data in Multiple Languages
Here is an example to get the geolocation data for IP address '2001:4230:4890::1' in French language:
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
    new GuzzleHttp\Client(),
    $config
);

try {
    $response = $apiInstance->getIpGeolocation(
        "2001:4230:4890::1",  // IP
        "fr",                 // lang
        null,                 // fields
        null,                 // excludes
        null,                 // include
        null                // output
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling IPGeolocationAPI->getIpGeolocation: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "2001:4230:4890:0:0:0:0:1",
    "location": {
        "continent_code": "AF",
        "continent_name": "Afrique",
        "country_code2": "MU",
        "country_code3": "MUS",
        "country_name": "Maurice",
        "country_name_official": "",
        "country_capital": "Port Louis",
        "state_prov": "Wilhems des plaines",
        "state_code": "MU-PW",
        "district": "Quatre Bornes",
        "city": "Quatre Bornes",
        "zipcode": "72201",
        "latitude": "-20.24304",
        "longitude": "57.49631",
        "is_eu": false,
        "country_flag": "https://ipgeolocation.io/static/flags/mu_64.png",
        "geoname_id": "1106777",
        "country_emoji": "🇲🇺"
    },
    "country_metadata": {
        "calling_code": "+230",
        "tld": ".mu",
        "languages": [
            "en-MU",
            "bho",
            "fr"
        ]
    },
    "network": {
        "asn": {
            "as_number": "AS0",
            "organization": "",
            "country": ""
        },
        "company": {
            "name": "African Network Information Center AfriNIC Ltd"
        }
    },
    "currency": {
        "code": "MUR",
        "name": "Mauritius Rupee",
        "symbol": "₨"
    }
}
```
#### Include Hostname, Timezone and User-Agent

```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
    new GuzzleHttp\Client(),
    $config
);

try {
    $response = $apiInstance->getIpGeolocation(
        "4.5.6.7",                                             // IP
        null,                                                  // lang
        "location.country_name,location.country_capital",      // fields
        null,                                                  // excludes
        "user_agent,time_zone,hostnameFallbackLive",           // include
        null                                                 // output
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling IPGeolocationAPI->getIpGeolocation: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "4.5.6.7",
    "hostname": "4.5.6.7",
    "location": {
        "country_name": "United States",
        "country_capital": "Washington, D.C."
    },
    "time_zone": {
        "name": "America/Chicago",
        "offset": -6,
        "offset_with_dst": -5,
        "current_time": "2025-07-01 06:13:11.646-0500",
        "current_time_unix": 1751368391.646,
        "is_dst": true,
        "dst_savings": 1,
        "dst_exists": true,
        "dst_start": {
            "utc_time": "2025-03-09 TIME 08",
            "duration": "+1H",
            "gap": true,
            "date_time_after": "2025-03-09 TIME 03",
            "date_time_before": "2025-03-09 TIME 02",
            "overlap": false
        },
        "dst_end": {
            "utc_time": "2025-11-02 TIME 07",
            "duration": "-1H",
            "gap": false,
            "date_time_after": "2025-11-02 TIME 01",
            "date_time_before": "2025-11-02 TIME 02",
            "overlap": true
        }
    },
    "user_agent": {
        "user_agent_string": "Ipgeolocation-SDK/2.0.0/PHP",
        "name": "PHP",
        "type": "Robot",
        "version": "??",
        "version_major": "??",
        "device": {
            "name": "PHP",
            "type": "Robot",
            "brand": "PHP",
            "cpu": "Unknown"
        },
        "engine": {
            "name": "PHP",
            "type": "Robot",
            "version": "??",
            "version_major": "??"
        },
        "operating_system": {
            "name": "Cloud",
            "type": "Cloud",
            "version": "??",
            "version_major": "??",
            "build": "??"
        }
    }
}
```
> [!NOTE]
> 
> The IP Geolocation API supports hostname lookup for all paid  subscriptions. However, this is not included by default. To enable hostname resolution, use the `include` parameter with one of the following options:
> - `hostname`: Performs a quick lookup using the internal hostname database. If no match is found, the IP is returned as-is. This is fast but may produce incomplete results.
> - `liveHostname`: Queries live sources for accurate hostname resolution. This may increase response time.
> - `hostnameFallbackLive`: Attempts the internal database first, and falls back to live sources if no result is found. This option provides a balance of speed and reliability.

### Advanced Plan Examples
#### Include DMA, Abuse, and Security

```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
    new GuzzleHttp\Client(),
    $config
);

try {
    $response = $apiInstance->getIpGeolocation(
        "8.8.8.8",                                             // IP
        null,                                                  // lang
        null,                                                  // fields
        "location.country_flag,location.country_emoji",        // excludes
        "dma,abuse,security",                                  // include
        null                                                   // output
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling IPGeolocationAPI->getIpGeolocation: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "8.8.8.8",
    "location": {
        "continent_code": "NA",
        "continent_name": "North America",
        "country_code2": "US",
        "country_code3": "USA",
        "country_name": "United States",
        "country_name_official": "United States of America",
        "country_capital": "Washington, D.C.",
        "state_prov": "California",
        "state_code": "US-CA",
        "district": "Santa Clara",
        "city": "Mountain View",
        "zipcode": "94043-1351",
        "latitude": "37.42240",
        "longitude": "-122.08421",
        "is_eu": false,
        "geoname_id": "6301403",
        "accuracy_radius": "",
        "locality": "Mountain View",
        "dma_code": "807"
    },
    "country_metadata": {
        "calling_code": "+1",
        "tld": ".us",
        "languages": [
            "en-US",
            "es-US",
            "haw",
            "fr"
        ]
    },
    "network": {
        "asn": {
            "as_number": "AS15169",
            "organization": "Google LLC",
            "country": "US",
            "asn_name": "GOOGLE",
            "type": "BUSINESS",
            "domain": "about.google",
            "date_allocated": "",
            "allocation_status": "assigned",
            "num_of_ipv4_routes": "983",
            "num_of_ipv6_routes": "104",
            "rir": "ARIN"
        },
        "connection_type": "",
        "company": {
            "name": "Google LLC",
            "type": "Business",
            "domain": "googlellc.com"
        }
    },
    "currency": {
        "code": "USD",
        "name": "US Dollar",
        "symbol": "$"
    },
    "security": {
        "threat_score": 0,
        "is_tor": false,
        "is_proxy": false,
        "proxy_type": "",
        "proxy_provider": "",
        "is_anonymous": false,
        "is_known_attacker": false,
        "is_spam": false,
        "is_bot": false,
        "is_cloud_provider": false,
        "cloud_provider": ""
    },
    "abuse": {
        "route": "8.8.8.0/24",
        "country": "",
        "handle": "ABUSE5250-ARIN",
        "name": "Abuse",
        "organization": "Abuse",
        "role": "abuse",
        "kind": "group",
        "address": "1600 Amphitheatre Parkway\nMountain View\nCA\n94043\nUnited States",
        "emails": [
            "network-abuse@google.com"
        ],
        "phone_numbers": [
            "+1-650-253-0000"
        ]
    }
}
```
These examples demonstrate typical usage of the IP Geolocation API with different subscription tiers. Use `fields` to specify exactly which data to receive, `include` for optional data like security and user agent, and excludes to omit specific keys from the response.

> [!NOTE]
> All features available in the Free plan are also included in the Standard and Advanced plans. Similarly, all features of the Standard plan are available in the Advanced plan.

### Bulk IP Geolocation Example

The SDK supports bulk IP geolocation requests using the `getBulkIpGeolocation()` method.  
All parameters like `fields`, `include`, and `excludes` can be used in bulk requests.

```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPGeolocationAPI(
    new \GuzzleHttp\Client(),
    $config
);

$bulkRequest = new \Ipgeolocation\Sdk\Model\BulkIPRequest([
    'ips' => ["8.8.8.8", "1.1.1.1"]
]);

try {
    $response = $apiInstance->getBulkIpGeolocation(
        $bulkRequest,
        null,                                                   // lang
        "location.country_name,location.city",                  // fields
        "location.continent_code",                              // excludes
        "security,timezone",                                    // include
        null                                                  // output
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling IPGeolocationAPI->getBulkIpGeolocation: ', $e->getMessage(), PHP_EOL;
}
```

## IP Security Examples

This section shows how to use the `getIpSecurityInfo()` method with various subscription tiers. Each example demonstrates how to query threat intelligence and risk metadata using parameters like `fields`, `excludes`, and `include`.

For the full API specs, refer to [IP Security API Documentation](https://ipgeolocation.io/ip-security-api.html#documentation-overview).

### Get Default Fields

```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPSecurityAPI(
    new \GuzzleHttp\Client(),
    $config
);

try {
    $response = $apiInstance->getIpSecurityInfo(
        "2.56.188.34",  // ip
        null,           // include
        null,           // fields
        null,           // excludes
        null,           // output
        null            // lang
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo "API call failed: {$e->getMessage()}";
}
```
Sample Response:
```json
{
    "ip": "2.56.188.34",
    "security": {
        "threat_score": 80,
        "is_tor": false,
        "is_proxy": true,
        "proxy_type": "VPN",
        "proxy_provider": "Nord VPN",
        "is_anonymous": true,
        "is_known_attacker": true,
        "is_spam": false,
        "is_bot": false,
        "is_cloud_provider": true,
        "cloud_provider": "Packethub S.A."
    }
}
```

### Include Multiple Optional Fields
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPSecurityAPI(
    new \GuzzleHttp\Client(),
    $config
);

try {
    $response = $apiInstance->getIpSecurityInfo(
        "2.56.188.34",                                 // ip
        "location,network,currency,time_zone,user_agent,country_metadata,hostname", // include
        null,                                          // fields
        null,                                          // excludes
        null,                                          // output
        null                                           // lang
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo "API call failed: {$e->getMessage()}";
}
```

> [!NOTE] 
> You can get all the available fields in standard plan in combination with security data, when subscribed to security plan.

### Request with Field Filtering

```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPSecurityAPI(
    new \GuzzleHttp\Client(),
    $config
);

try {
    $response = $apiInstance->getIpSecurityInfo(
        "195.154.221.54",  // ip
        null,              // include
        "security.is_tor,security.is_proxy,security.is_bot,security.is_spam",  // fields
        null,              // excludes
        null,              // output
        null               // lang
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo "API call failed: " . $e->getMessage();
}
```
Sample Response:
```json
{
    "ip": "195.154.221.54",
    "security": {
        "is_tor": false,
        "is_proxy": true,
        "is_spam": false,
        "is_bot": false
    }
}
```
### Bulk IP Security Lookup
The SDK also supports bulk IP Security requests using the `getBulkIPSecurityInfo()` method. All parameters like `fields`, `include`, and `excludes` can also be used in bulk requests.
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\IPSecurityAPI(
    new \GuzzleHttp\Client()
);

$bulkRequest = new \Ipgeolocation\Sdk\Model\BulkIPRequest([
            'ips' => ["2.56.188.34", "2.56.188.35"]
        ]);

try {
    $response = $apiInstance->getBulkIpSecurityInfo(
        $bulkRequest,                              // bulk request object
        "location,network",                        // include
        "security.threat_score,location.country_name", // fields
        null,                                      // excludes
        null,                                    // output
        null                                       // lang
    );

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo "API call failed: " . $e->getMessage();
}
```
## ASN API Examples

This section provides usage examples of the `getAsnInfo()` method from the SDK. These methods allow developers to retrieve detailed ASN-level network data either by ASN number or by IP address.

> [!NOTE]
> ASN API is only available in the Advanced subscription Plan.

Refer to the [ASN API documentation](https://ipgeolocation.io/asn-api.html#documentation-overview) for a detailed list of supported fields and behaviors.

### Get ASN Information by IP Address
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\ASNLookupAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAsnInfo(
        '8.8.8.8',    // ip
        null,         // asn
        null,         // include
        null,         // excludes
        null          // fields
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling ASNLookupAPI->getAsnInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "8.8.8.8",
    "asn": {
        "as_number": "AS15169",
        "organization": "Google LLC",
        "country": "US",
        "asn_name": "GOOGLE",
        "type": "BUSINESS",
        "domain": "about.google",
        "date_allocated": "",
        "allocation_status": "assigned",
        "num_of_ipv4_routes": 983,
        "num_of_ipv6_routes": 104,
        "rir": "ARIN"
    }
}
```

### Get ASN Information by ASN Number
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\ASNLookupAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAsnInfo(
        null,         // ip
        '15169',    // asn
        null,         // include
        null,         // excludes
        null          // fields
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling ASNLookupAPI->getAsnInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "8.8.8.8",
    "asn": {
        "as_number": "AS15169",
        "organization": "Google LLC",
        "country": "US",
        "asn_name": "GOOGLE",
        "type": "BUSINESS",
        "domain": "about.google",
        "date_allocated": "",
        "allocation_status": "assigned",
        "num_of_ipv4_routes": 983,
        "num_of_ipv6_routes": 104,
        "rir": "ARIN"
    }
}
```
### Combine All objects using Include
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\ASNLookupAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAsnInfo(
        null,                                                // ip
        12,                                                  // asn
        'peers,downstreams,upstreams,routes,whois_response', // include
        null,                                                // excludes
        null                                                 // fields
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling ASNLookupAPI->getAsnInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "asn": {
        "as_number": "AS12",
        "organization": "New York University",
        "country": "US",
        "asn_name": "NYU-DOMAIN",
        "type": "EDUCATION",
        "domain": "nyu.edu",
        "date_allocated": "",
        "allocation_status": "assigned",
        "num_of_ipv4_routes": 12,
        "num_of_ipv6_routes": 1,
        "rir": "ARIN",
        "routes": [
            "192.76.177.0/24",
            "216.165.96.0/20",
            "...",
            "216.165.120.0/22"
        ],
        "upstreams": [
            {
                "as_number": "AS3269",
                "description": "Telecom Italia S.p.A.",
                "country": "IT"
            },
            "...",
            {
                "as_number": "AS137",
                "description": "Consortium GARR",
                "country": "IT"
            }
        ],
        "downstreams": [
            {
                "as_number": "AS394666",
                "description": "NYU Langone Health",
                "country": "US"
            },
            {
                "as_number": "AS54965",
                "description": "Polytechnic Institute of NYU",
                "country": "US"
            }
        ],
        "peers": [
            {
                "as_number": "AS3269",
                "description": "Telecom Italia S.p.A.",
                "country": "IT"
            },
            "...",
            {
                "as_number": "AS54965",
                "description": "Polytechnic Institute of NYU",
                "country": "US"
            }
        ],
        "whois_response": "<raw-whois-response>"
    }
}   
```

## Abuse Contact API Examples
This section demonstrates how to use the `getAbuseContactInfo()` method of the AbuseContact API. This API helps security teams, hosting providers, and compliance professionals quickly identify the correct abuse reporting contacts for any IPv4 or IPv6 address. You can retrieve data like the responsible organization, role, contact emails, phone numbers, and address to take appropriate mitigation action against abusive or malicious activity.

> [!NOTE]
> Abuse Contact API is only available in Advanced subscription Plan.

Refer to the official [Abuse Contact API documentation](https://ipgeolocation.io/ip-abuse-contact-api.html#documentation-overview) for details on all available fields.

### Lookup Abuse Contact by IP
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\AbuseContactAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAbuseContactInfo(
        '1.0.0.0',  // ip
        null,       // excludes
        null        // fields
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling AbuseContactAPI->getAbuseContactInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "1.0.0.0",
    "abuse": {
        "route": "1.0.0.0/24",
        "country": "AU",
        "handle": "IRT-APNICRANDNET-AU",
        "name": "IRT-APNICRANDNET-AU",
        "organization": "",
        "role": "abuse",
        "kind": "group",
        "address": "PO Box 3646\nSouth Brisbane, QLD 4101\nAustralia",
        "emails": [
            "helpdesk@apnic.net"
        ],
        "phone_numbers": [
            "+61 7 3858 3100"
        ]
    }
}
```
### Lookup Abuse Contact with Specific Fields
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\AbuseContactAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAbuseContactInfo(
        '1.2.3.4',                          // ip
        null,                               // excludes
        'abuse.role,abuse.emails'           // fields
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling AbuseContactAPI->getAbuseContactInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "1.2.3.4",
    "abuse": {
        "role": "abuse",
        "emails": [
            "helpdesk@apnic.net"
        ]
    }
}
```
### Lookup Abuse Contact while Excluding Fields
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\AbuseContactAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAbuseContactInfo(
        '9.9.9.9',                             // ip
        'abuse.handle,abuse.emails',           // excludes
        null                                   // fields
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling AbuseContactAPI->getAbuseContactInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "9.9.9.9",
    "abuse": {
        "route": "9.9.9.0/24",
        "country": "",
        "name": "Quad9 Abuse",
        "organization": "Quad9 Abuse",
        "role": "abuse",
        "kind": "group",
        "address": "1442 A Walnut Street Ste 501\nBerkeley\nCA\n94709\nUnited States",
        "phone_numbers": [
            "+1-415-831-3129"
        ]
    }
}
```

## Timezone API Examples
This section provides usage examples of the `getTimezoneInfo()` method from the PHP SDK, showcasing how to fetch timezone and time-related data using different query types — IP address, latitude/longitude, timezone ID, IATA code, ICAO code, or UN/LOCODE.

For full API specifications, refer to the [Timezone API documentation](https://ipgeolocation.io/timezone-api.html#documentation-overview).

### Get Timezone by IP Address
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\TimezoneAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getTimezoneInfo(
        null,    // tz
        null,    // location
        null,    // lat
        null,    // long
        "8.8.8.8", // ip
        null,    // iata_code
        null,    // icao_code
        null,    // lo_code
        null,    // output
        null     // lang
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling TimezoneAPI->getTimezoneInfo: ', $e->getMessage(), PHP_EOL;
}

```
Sample Response:
```json
{
    "ip": "8.8.8.8",
    "location": {
        "continent_code": "NA",
        "continent_name": "North America",
        "country_code2": "US",
        "country_code3": "USA",
        "country_name": "United States",
        "country_name_official": "United States of America",
        "is_eu": false,
        "state_prov": "California",
        "state_code": "US-CA",
        "district": "Santa Clara",
        "city": "Mountain View",
        "zipcode": "94043-1351",
        "latitude": "37.42240",
        "longitude": "-122.08421"
    },
    "time_zone": {
        "name": "America/Los_Angeles",
        "offset": -8,
        "offset_with_dst": -7,
        "date": "2025-07-02",
        "date_time": "2025-07-02 05:05:16",
        "date_time_txt": "Wednesday, July 02, 2025 05:05:16",
        "date_time_wti": "Wed, 02 Jul 2025 05:05:16 -0700",
        "date_time_ymd": "2025-07-02T05:05:16-07:00",
        "date_time_unix": 1751457916.876,
        "time_24": "05:05:16",
        "time_12": "05:05:16 AM",
        "week": 27,
        "month": 7,
        "year": 2025,
        "year_abbr": "25",
        "is_dst": true,
        "dst_savings": 1,
        "dst_exists": true,
        "dst_start": {
            "utc_time": "2025-03-09 TIME 10",
            "duration": "+1H",
            "gap": true,
            "date_time_after": "2025-03-09 TIME 03",
            "date_time_before": "2025-03-09 TIME 02",
            "overlap": false
        },
        "dst_end": {
            "utc_time": "2025-11-02 TIME 09",
            "duration": "-1H",
            "gap": false,
            "date_time_after": "2025-11-02 TIME 01",
            "date_time_before": "2025-11-02 TIME 02",
            "overlap": true
        }
    }
}
```
### Get Timezone by Timezone Name
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\TimezoneAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getTimezoneInfo(
        "Europe/London"    //tz (timezone)
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling TimezoneAPI->getTimezoneInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "time_zone": {
        "name": "Europe/London",
        "offset": 0,
        "offset_with_dst": 1,
        "date": "2025-07-02",
        "date_time": "2025-07-02 13:14:06",
        "date_time_txt": "Wednesday, July 02, 2025 13:14:06",
        "date_time_wti": "Wed, 02 Jul 2025 13:14:06 +0100",
        "date_time_ymd": "2025-07-02T13:14:06+01:00",
        "date_time_unix": 1751458446.395,
        "time_24": "13:14:06",
        "time_12": "01:14:06 PM",
        "week": 27,
        "month": 7,
        "year": 2025,
        "year_abbr": "25",
        "is_dst": true,
        "dst_savings": 1,
        "dst_exists": true,
        "dst_start": {
            "utc_time": "2025-03-30 TIME 01",
            "duration": "+1H",
            "gap": true,
            "date_time_after": "2025-03-30 TIME 02",
            "date_time_before": "2025-03-30 TIME 01",
            "overlap": false
        },
        "dst_end": {
            "utc_time": "2025-10-26 TIME 01",
            "duration": "-1H",
            "gap": false,
            "date_time_after": "2025-10-26 TIME 01",
            "date_time_before": "2025-10-26 TIME 02",
            "overlap": true
        }
    }
}
```
### Get Timezone from Any Address
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\TimezoneAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getTimezoneInfo(
        null,
        "Munich, Germany"   // location
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling TimezoneAPI->getTimezoneInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "location": {
        "location_string": "Munich, Germany",
        "country_name": "Germany",
        "state_prov": "Bavaria",
        "city": "Munich",
        "locality": "",
        "latitude": "48.13711",
        "longitude": "11.57538"
    },
    "time_zone": {
        "name": "Europe/Berlin",
        "offset": 1,
        "offset_with_dst": 2,
        "date": "2025-07-02",
        "date_time": "2025-07-02 15:12:45",
        "date_time_txt": "Wednesday, July 02, 2025 15:12:45",
        "date_time_wti": "Wed, 02 Jul 2025 15:12:45 +0200",
        "date_time_ymd": "2025-07-02T15:12:45+02:00",
        "date_time_unix": 1751461965.506,
        "time_24": "15:12:45",
        "time_12": "03:12:45 PM",
        "week": 27,
        "month": 7,
        "year": 2025,
        "year_abbr": "25",
        "is_dst": true,
        "dst_savings": 1,
        "dst_exists": true,
        "dst_start": {
            "utc_time": "2025-03-30 TIME 01",
            "duration": "+1H",
            "gap": true,
            "date_time_after": "2025-03-30 TIME 03",
            "date_time_before": "2025-03-30 TIME 02",
            "overlap": false
        },
        "dst_end": {
            "utc_time": "2025-10-26 TIME 01",
            "duration": "-1H",
            "gap": false,
            "date_time_after": "2025-10-26 TIME 02",
            "date_time_before": "2025-10-26 TIME 03",
            "overlap": true
        }
    }
}
```
### Get Timezone from Location Coordinates
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\TimezoneAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getTimezoneInfo(
        null,
        null,
        48.8566,   // latitude
        2.3522     // longitude
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling TimezoneAPI->getTimezoneInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "time_zone": {
        "name": "Europe/Paris",
        "offset": 1,
        "offset_with_dst": 2,
        "date": "2025-07-02",
        "date_time": "2025-07-02 15:14:35",
        "date_time_txt": "Wednesday, July 02, 2025 15:14:35",
        "date_time_wti": "Wed, 02 Jul 2025 15:14:35 +0200",
        "date_time_ymd": "2025-07-02T15:14:35+02:00",
        "date_time_unix": 1751462075.118,
        "time_24": "15:14:35",
        "time_12": "03:14:35 PM",
        "week": 27,
        "month": 7,
        "year": 2025,
        "year_abbr": "25",
        "is_dst": true,
        "dst_savings": 1,
        "dst_exists": true,
        "dst_start": {
            "utc_time": "2025-03-30 TIME 01",
            "duration": "+1H",
            "gap": true,
            "date_time_after": "2025-03-30 TIME 03",
            "date_time_before": "2025-03-30 TIME 02",
            "overlap": false
        },
        "dst_end": {
            "utc_time": "2025-10-26 TIME 01",
            "duration": "-1H",
            "gap": false,
            "date_time_after": "2025-10-26 TIME 02",
            "date_time_before": "2025-10-26 TIME 03",
            "overlap": true
        }
    }
}
```
### Get Timezone and Airport Details from IATA Code
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\TimezoneAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getTimezoneInfo(
        null,
        null,
        null,
        null,
        null,
        "ZRH",  //IATA Code
        null    //ICAO Code
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling TimezoneAPI->getTimezoneInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "airport_details": {
        "type": "large_airport",
        "name": "Zurich Airport",
        "latitude": "47.45806",
        "longitude": "8.54806",
        "elevation_ft": 1417,
        "continent_code": "EU",
        "country_code": "CH",
        "state_code": "CH-ZH",
        "city": "Zurich",
        "iata_code": "ZRH",
        "icao_code": "LSZH",
        "faa_code": ""
    },
    "time_zone": {
        "name": "Europe/Zurich",
        "offset": 1,
        "offset_with_dst": 2,
        "date": "2025-07-02",
        "date_time": "2025-07-02 15:17:40",
        "date_time_txt": "Wednesday, July 02, 2025 15:17:40",
        "date_time_wti": "Wed, 02 Jul 2025 15:17:40 +0200",
        "date_time_ymd": "2025-07-02T15:17:40+02:00",
        "date_time_unix": 1751462260.085,
        "time_24": "15:17:40",
        "time_12": "03:17:40 PM",
        "week": 27,
        "month": 7,
        "year": 2025,
        "year_abbr": "25",
        "is_dst": true,
        "dst_savings": 1,
        "dst_exists": true,
        "dst_start": {
            "utc_time": "2025-03-30 TIME 01",
            "duration": "+1H",
            "gap": true,
            "date_time_after": "2025-03-30 TIME 03",
            "date_time_before": "2025-03-30 TIME 02",
            "overlap": false
        },
        "dst_end": {
            "utc_time": "2025-10-26 TIME 01",
            "duration": "-1H",
            "gap": false,
            "date_time_after": "2025-10-26 TIME 02",
            "date_time_before": "2025-10-26 TIME 03",
            "overlap": true
        }
    }
}
```
Similarly, you can fetch Airport Details and Timezone from using any ICAO code as well

### Get Timezone and City Details from UN/LOCODE
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\TimezoneAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getTimezoneInfo(
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        "ESBCN"   // UN/LOCODE 
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling TimezoneAPI->getTimezoneInfo: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "lo_code_details": {
        "lo_code": "ESBCN",
        "city": "Barcelona",
        "state_code": "",
        "country_code": "ES",
        "country_name": "",
        "location_type": "Port, Rail Terminal, Road Terminal, Airport, Postal Exchange",
        "latitude": "41.38289",
        "longitude": "2.17743"
    },
    "time_zone": {
        "name": "Europe/Madrid",
        "offset": 1,
        "offset_with_dst": 2,
        "date": "2025-07-02",
        "date_time": "2025-07-02 15:24:45",
        "date_time_txt": "Wednesday, July 02, 2025 15:24:45",
        "date_time_wti": "Wed, 02 Jul 2025 15:24:45 +0200",
        "date_time_ymd": "2025-07-02T15:24:45+02:00",
        "date_time_unix": 1751462685.856,
        "time_24": "15:24:45",
        "time_12": "03:24:45 PM",
        "week": 27,
        "month": 7,
        "year": 2025,
        "year_abbr": "25",
        "is_dst": true,
        "dst_savings": 1,
        "dst_exists": true,
        "dst_start": {
            "utc_time": "2025-03-30 TIME 01",
            "duration": "+1H",
            "gap": true,
            "date_time_after": "2025-03-30 TIME 03",
            "date_time_before": "2025-03-30 TIME 02",
            "overlap": false
        },
        "dst_end": {
            "utc_time": "2025-10-26 TIME 01",
            "duration": "-1H",
            "gap": false,
            "date_time_after": "2025-10-26 TIME 02",
            "date_time_before": "2025-10-26 TIME 03",
            "overlap": true
        }
    }
}
```

## Timezone Converter Examples
This section provides usage examples of the `convertTimeBetweenTimezones()` method from the SDK. The Timezone Converter API allows you to convert a specific time from one timezone to another using timezone identifiers and optional date/time inputs.

For more details, refer to the [Timezone Converter API documentation](https://ipgeolocation.io/timezone-api.html#convert-time-bw-time-zones).

### Convert Current Time from One Timezone to Another
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\TimeConversionAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->convertTimeBetweenTimezones(
                "2024-12-08 11:00", // time
                "America/New_York", // tz_from    
                "Asia/Tokyo",       // tz_to
                null,               // lat_from
                null,               // long_from
                null,               // lat_to
                null,               // long_to,
                null,               // location_from
                null,               // location_to
                null,               // icao_from
                null,               // icao_to
                null,               // iata_from
                null,               // iata_to
                null,               // locode_from
                null                // locode_to
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling TimezoneAPI->convertTimezone: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "original_time": "2024-12-08T11:00:00+00:00",
    "converted_time": "2024-12-09T01:00:00+00:00",
    "diff_hour": 14,
    "diff_min": 840
}
```
Similarly, you can convert time from any timezone to another timezone using location coordinates (Latitude and Longitude), location addresses, IATA codes, ICAO codes and UN/LUCODE.

## User Agent API Examples
This section provides usage examples of the `getUserAgent()` method from the SDK. The User Agent API extracts and classifies information from user agent strings, including browser, engine, device, OS, and type metadata.

For full explanation, visit the [User Agent API documentation}(https://ipgeolocation.io/user-agent-api.html#documentation-overview).

### Parse a Basic User Agent String
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$config = \Ipgeolocation\Sdk\Configuration::getDefaultConfiguration()
    ->setApiKey('apiKey', 'YOUR_API_KEY');

$apiInstance = new \Ipgeolocation\Sdk\Api\UserAgentAPI(
    new \GuzzleHttp\Client(),
    $config);

try {
    $response = $apiInstance->getUserAgentDetails(
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36", // user_agent
        "json" // output
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling UserAgentAPI->getUserAgentDetails: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "user_agent_string": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36",
    "name": "Chrome",
    "type": "Browser",
    "version": "125",
    "version_major": "125",
    "device": {
        "name": "Desktop",
        "type": "Desktop",
        "brand": "Unknown",
        "cpu": "Intel x86_64"
    },
    "engine": {
        "name": "Blink",
        "type": "Browser",
        "version": "125",
        "version_major": "125"
    },
    "operating_system": {
        "name": "Windows NT",
        "type": "Desktop",
        "version": "??",
        "version_major": "??",
        "build": "??"
    }
}
```
> [!NOTE] 
> If you don’t pass any `userAgentString`, the API will return the data of the device’s user agent automatically.

### Bulk User Agent Parsing Example
The SDK also supports bulk User Agent parsing using the `getBulkUserAgent()` method. This allows parsing multiple user agent strings in a single request. All fields available in single-user-agent parsing are returned per entry.
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\UserAgentAPI(
    new \GuzzleHttp\Client(),
    $config);

$bulkRequest = new \Ipgeolocation\Sdk\Model\BulkUserAgentRequest([
    'ua_strings' => [
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36",
        "Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Mobile/15E148 Safari/604.1"
    ]
]);

try {
    $response = $apiInstance->parseBulkUserAgentStrings(
        null, // output
        $bulkRequest // request body with ua_strings array
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling UserAgentAPI->parseBulkUserAgentStrings: ', $e->getMessage(), PHP_EOL;
}
```
## Astronomy API Examples
This section provides usage examples of the `getAstronomyDetails()` method from the SDK, allowing developers to fetch sun and moon timings and position data based on coordinates, IP, or location string.

Refer to the official [Astronomy API documentation](https://ipgeolocation.io/astronomy-api.html#documentation-overview) for more details.
### Astronomy by Coordinates
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\AstronomyAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAstronomyDetails(
        null,          // ip
        null,          // location
        '40.7128',     // lat
        '-74.0060',    // long
        null,          // date
        null,          // output
        null           // lang
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling AstronomyAPI->getAstronomyDetails: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "location": {
        "country_name": "",
        "state_prov": "New York",
        "city": "New York",
        "locality": "",
        "latitude": "40.71280",
        "longitude": "-74.00600",
        "elevation": "6"
    },
    "astronomy": {
        "date": "2025-07-22",
        "current_time": "11:39:14.541",
        "mid_night": "01:02",
        "night_end": "03:48",
        "morning": {
            "astronomical_twilight_begin": "03:48",
            "astronomical_twilight_end": "04:32",
            "nautical_twilight_begin": "04:32",
            "nautical_twilight_end": "05:12",
            "civil_twilight_begin": "05:12",
            "civil_twilight_end": "05:43",
            "blue_hour_begin": "04:59",
            "blue_hour_end": "05:24",
            "golden_hour_begin": "05:24",
            "golden_hour_end": "06:23"
        },
        "sunrise": "05:43",
        "sunset": "20:21",
        "evening": {
            "golden_hour_begin": "19:41",
            "golden_hour_end": "20:40",
            "blue_hour_begin": "20:40",
            "blue_hour_end": "21:05",
            "civil_twilight_begin": "20:21",
            "civil_twilight_end": "20:52",
            "nautical_twilight_begin": "20:52",
            "nautical_twilight_end": "21:31",
            "astronomical_twilight_begin": "21:31",
            "astronomical_twilight_end": "22:16"
        },
        "night_begin": "22:16",
        "sun_status": "-",
        "solar_noon": "13:02",
        "day_length": "14:37",
        "sun_altitude": 62.82722241745091,
        "sun_distance": 152012050.75662628,
        "sun_azimuth": 133.02002629599787,
        "moon_phase": "WANING_CRESCENT",
        "moonrise": "02:48",
        "moonset": "19:10",
        "moon_status": "-",
        "moon_altitude": 75.5370183362362,
        "moon_distance": 370295.6824700026,
        "moon_azimuth": 214.66678019013276,
        "moon_parallactic_angle": 29.353598394960347,
        "moon_illumination_percentage": "-5.93",
        "moon_angle": 331.8045439685618
    }
}
```
### Astronomy by IP Address
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\AstronomyAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAstronomyDetails(
        '8.8.8.8',     // ip
        null,          // location
        null,          // lat
        null,          // long
        null,          // date
        null,          // output
        null           // lang
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling AstronomyAPI->getAstronomyDetails: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "8.8.8.8",
    "location": {
        "continent_code": "NA",
        "continent_name": "North America",
        "country_code2": "US",
        "country_code3": "USA",
        "country_name": "United States",
        "country_name_official": "United States of America",
        "is_eu": false,
        "state_prov": "California",
        "state_code": "US-CA",
        "district": "Santa Clara",
        "city": "Mountain View",
        "locality": "Charleston Terrace",
        "zipcode": "94043-1351",
        "latitude": "37.42240",
        "longitude": "-122.08421",
        "elevation": "3"
    },
    "astronomy": {
        "date": "2025-07-22",
        "current_time": "08:39:55.205",
        "mid_night": "01:15",
        "night_end": "04:18",
        "morning": {
            "astronomical_twilight_begin": "04:18",
            "astronomical_twilight_end": "04:58",
            "nautical_twilight_begin": "04:58",
            "nautical_twilight_end": "05:35",
            "civil_twilight_begin": "05:35",
            "civil_twilight_end": "06:04",
            "blue_hour_begin": "05:23",
            "blue_hour_end": "05:47",
            "golden_hour_begin": "05:47",
            "golden_hour_end": "06:42"
        },
        "sunrise": "06:04",
        "sunset": "20:24",
        "evening": {
            "golden_hour_begin": "19:46",
            "golden_hour_end": "20:42",
            "blue_hour_begin": "20:42",
            "blue_hour_end": "21:05",
            "civil_twilight_begin": "20:24",
            "civil_twilight_end": "20:54",
            "nautical_twilight_begin": "20:54",
            "nautical_twilight_end": "21:30",
            "astronomical_twilight_begin": "21:30",
            "astronomical_twilight_end": "22:10"
        },
        "night_begin": "22:10",
        "sun_status": "-",
        "solar_noon": "13:14",
        "day_length": "14:20",
        "sun_altitude": 28.653227103400308,
        "sun_distance": 152012050.75662628,
        "sun_azimuth": 85.6614152465088,
        "moon_phase": "WANING_CRESCENT",
        "moonrise": "03:23",
        "moonset": "19:16",
        "moon_status": "-",
        "moon_altitude": 56.618284786489866,
        "moon_distance": 370296.5525127226,
        "moon_azimuth": 94.13736413594489,
        "moon_parallactic_angle": -64.23660556269962,
        "moon_illumination_percentage": "-5.93",
        "moon_angle": 331.8108250066616
    }
}
```
### Astronomy by Location String
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\AstronomyAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAstronomyDetails(
        null,              // ip
        'Milan, Italy',    // location
        null,              // lat
        null,              // long
        null,              // date
        null,              // output
        null               // lang
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling AstronomyAPI->getAstronomyDetails: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "location": {
        "location_string": "Milan, Italy",
        "country_name": "Italy",
        "state_prov": "Lombardy",
        "city": "Milan",
        "locality": "",
        "latitude": "45.46419",
        "longitude": "9.18963",
        "elevation": "122"
    },
    "astronomy": {
        "date": "2025-07-22",
        "current_time": "17:40:39.691",
        "mid_night": "01:29",
        "night_end": "03:39",
        "morning": {
            "astronomical_twilight_begin": "03:39",
            "astronomical_twilight_end": "04:35",
            "nautical_twilight_begin": "04:35",
            "nautical_twilight_end": "05:21",
            "civil_twilight_begin": "05:21",
            "civil_twilight_end": "05:54",
            "blue_hour_begin": "05:06",
            "blue_hour_end": "05:35",
            "golden_hour_begin": "05:35",
            "golden_hour_end": "06:40"
        },
        "sunrise": "05:54",
        "sunset": "21:04",
        "evening": {
            "golden_hour_begin": "20:19",
            "golden_hour_end": "21:24",
            "blue_hour_begin": "21:24",
            "blue_hour_end": "21:52",
            "civil_twilight_begin": "21:04",
            "civil_twilight_end": "21:38",
            "nautical_twilight_begin": "21:38",
            "nautical_twilight_end": "22:23",
            "astronomical_twilight_begin": "22:23",
            "astronomical_twilight_end": "23:18"
        },
        "night_begin": "23:18",
        "sun_status": "-",
        "solar_noon": "13:29",
        "day_length": "15:10",
        "sun_altitude": 33.16901712690754,
        "sun_distance": 152012050.75662628,
        "sun_azimuth": 265.5180922308362,
        "moon_phase": "WANING_CRESCENT",
        "moonrise": "02:36",
        "moonset": "19:49",
        "moon_status": "-",
        "moon_altitude": 18.031012117027515,
        "moon_distance": 370297.50457103224,
        "moon_azimuth": 292.54687652540406,
        "moon_parallactic_angle": 47.43099453826072,
        "moon_illumination_percentage": "-5.93",
        "moon_angle": 331.81769636391914
    }
}
```

### Astronomy for Specific Date
```php
$apiInstance = new \Ipgeolocation\Sdk\Api\AstronomyAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAstronomyDetails(
        null,          // ip
        null,          // location
        '-27.47',      // lat
        '153.02',      // long
        '2025-01-01',  // date
        null,          // output
        null           // lang
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling AstronomyAPI->getAstronomyDetails: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "location": {
        "country_name": "Australia",
        "state_prov": "Queensland",
        "city": "Brisbane",
        "locality": "Brisbane",
        "latitude": "-27.47000",
        "longitude": "153.02000",
        "elevation": ""
    },
    "astronomy": {
        "date": "2025-01-01",
        "current_time": "01:41:18.164",
        "mid_night": "23:51",
        "night_end": "03:24",
        "morning": {
            "astronomical_twilight_begin": "03:24",
            "astronomical_twilight_end": "03:57",
            "nautical_twilight_begin": "03:57",
            "nautical_twilight_end": "04:29",
            "civil_twilight_begin": "04:29",
            "civil_twilight_end": "04:56",
            "blue_hour_begin": "04:19",
            "blue_hour_end": "04:40",
            "golden_hour_begin": "04:40",
            "golden_hour_end": "05:30"
        },
        "sunrise": "04:56",
        "sunset": "18:46",
        "evening": {
            "golden_hour_begin": "18:12",
            "golden_hour_end": "19:02",
            "blue_hour_begin": "19:02",
            "blue_hour_end": "19:23",
            "civil_twilight_begin": "18:46",
            "civil_twilight_end": "19:13",
            "nautical_twilight_begin": "19:13",
            "nautical_twilight_end": "19:45",
            "astronomical_twilight_begin": "19:45",
            "astronomical_twilight_end": "20:18"
        },
        "night_begin": "20:18",
        "sun_status": "-",
        "solar_noon": "11:51",
        "day_length": "13:50",
        "sun_altitude": -32.94269010974199,
        "sun_distance": 147102938.88036567,
        "sun_azimuth": 149.5582728622541,
        "moon_phase": "NEW_MOON",
        "moonrise": "05:42",
        "moonset": "20:08",
        "moon_status": "-",
        "moon_altitude": -33.27880092264766,
        "moon_distance": 383157.0010883984,
        "moon_azimuth": 161.48378331957554,
        "moon_parallactic_angle": -161.60525103359274,
        "moon_illumination_percentage": "0.59",
        "moon_angle": 8.794260638660125
    }
}
```
### Astronomy in Different Language
You can also get Astronomy Data in other languages as well.

> [!NOTE]
> Only paid subscriptions can access this feature.

```php
$apiInstance = new \Ipgeolocation\Sdk\Api\AstronomyAPI(
    new \GuzzleHttp\Client(), 
    $config);

try {
    $response = $apiInstance->getAstronomyDetails(
        '1.1.1.1',     // ip
        null,          // location
        null,          // lat
        null,          // long
        null,          // date
        null,          // output
        'fr'           // lang
    );
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (\Exception $e) {
    echo 'Exception when calling AstronomyAPI->getAstronomyDetails: ', $e->getMessage(), PHP_EOL;
}
```
Sample Response:
```json
{
    "ip": "1.1.1.1",
    "location": {
        "continent_code": "OC",
        "continent_name": "Océanie",
        "country_code2": "AU",
        "country_code3": "AUS",
        "country_name": "Australie",
        "country_name_official": "",
        "is_eu": false,
        "state_prov": "Queensland",
        "state_code": "AU-QLD",
        "district": "Brisbane",
        "city": "Brisbane Sud",
        "locality": "",
        "zipcode": "4101",
        "latitude": "-27.47306",
        "longitude": "153.01421",
        "elevation": ""
    },
    "astronomy": {
        "date": "2025-07-23",
        "current_time": "01:42:01.150",
        "...": "",
        "moon_angle": 331.8302785192621
    }
}
```

## Models

- [ASNConnection](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/ASNConnection.md)
- [ASNResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/ASNResponse.md)
- [ASNDetails](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/ASNDetails.md)
- [Abuse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/Abuse.md)
- [AbuseResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/AbuseResponse.md)
- [Astronomy](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/Astronomy.md)
  [AstronomyEvening](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/AstronomyEvening.md)
- [AstronomyLocation](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/AstronomyLocation.md)
- [AstronomyMorning](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/AstronomyMorning.md)
- [AstronomyResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/AstronomyResponse.md)
- [CountryMetadata](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/CountryMetadata.md)
- [Currency](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/Currency.md)
- [ErrorResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/ErrorResponse.md)
- [GeolocationResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/GeolocationResponse.md)
- [BulkIPGeolocationResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/BulkIPGeolocationResponse.md)
- [BulkIPGeolocationResponse1](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/BulkIPGeolocationResponse1.md)
- [BulkIPRequest](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/BulkIPRequest.md)
- [BulkIPSecurityResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/BulkIPSecurityResponse.md)
- [BulkIPSecurityResponse1](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/BulkIPSecurityResponse1.md)
- [Location](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/Location.md)
- [LocationMinimal](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/LocationMinimal.md)
- [Network](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/Network.md)
- [NetworkAsn](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/NetworkAsn.md)
- [NetworkCompany](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/NetworkCompany.md)
- [NetworkMinimal](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/NetworkMinimal.md)
- [NetworkMinimalAsn](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/NetworkMinimalAsn.md)
- [NetworkMinimalCompany](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/NetworkMinimalCompany.md)
- [BulkUserAgentRequest](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/BulkUserAgentRequest.md)
- [UserAgentRequest](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/UserAgentRequest.md)
- [Security](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/Security.md)
- [IPSecurityAPIResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/IPSecurityAPIResponse.md)
- [TimeConversionResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimeConversionResponse.md)
- [TimeZone](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimeZone.md)
- [TimeZoneDetailedResponse](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimeZoneDetailedResponse.md)
- [TimeZoneDstEnd](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimeZoneDstEnd.md)
- [TimeZoneDstStart](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimeZoneDstStart.md)
- [TimezoneAirport](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimezoneAirport.md)
- [TimezoneDetail](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimezoneDetail.md)
- [TimezoneDetailDstEnd](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimezoneDetailDstEnd.md)
- [TimezoneDetailDstStart](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimezoneDetailDstStart.md)
- [TimezoneLocation](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimezoneLocation.md)
- [TimezoneLocode](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/TimezoneLocode.md)
- [UserAgentData](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/UserAgentData.md)
- [UserAgentDataDevice](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/UserAgentDataDevice.md)
- [UserAgentDataEngine](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/UserAgentDataEngine.md)
- [UserAgentDataOperatingSystem](https://github.com/IPGeolocation/ip-geolocation-api-php/blob/master/docs/Model/UserAgentDataOperatingSystem.md)
