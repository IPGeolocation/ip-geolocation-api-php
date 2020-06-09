# IP Geolocation API PHP SDK

## Introduction

[IPGeolocation API](https://ipgeolocation.io) is the solution to identify country code (ISO2 and ISO3 standard), country name, continent code, continent name, country capital, state/province, district, city, zip code, latitude and longitude of city, is country belongs to Europian Union, calling code, top level domain (TLD), languages, country flag, internet service provider (ISP), connection type, organization, geoname ID, currency code, currency name, time zone ID, time zone offset, current time in the time zone, is time zone in daylight saving time, and total daylight savings. This document provides important information to help you get up to speed with IPGeolocation API using IP Geolocation API PHP SDK.

Developers can use this PHP SDK for software and web projects related to, but not limited to:

1. Display native language and currency
2. Redirect based on the country
3. Digital rights management
4. Web log stats and analysis
5. Auto-selection of country, state/province and city on forms
6. Filter access from countries you do not do business with
7. Geo-targeting for increased sales and click-through

## Quick Start Guide

You need a valid 'IPGeolocation API key' to use this SDK. [Sign up](https://ipgeolocation.io/signup) here and get your free API key if you don't have one.

**Note:** Complete documentation to use this SDK is also available at [IP Geolocation API PHP SDK Documentation](https://ipgeolocation.io/documentation/ip-geolocation-api-php-sdk-201809051255).

## System Requirements  

Internet connection is required to run this component.

## Basic Usage

Call method **get_geolocation($apiKey, $ip, $lang, $fields, $excludes)** passing _API key_ and _IP address_ as parameters (rest of the parameters are optional) and it will return the Geolocation for the passed IP address.
To customize the geolocation response, you can pass the other parameters to **get_geolocation** method as described below:

* $lang  
Pass the _language_ parameter to get the geolocation information in a language other than English. By default, it is set to English language.  
IPGeolocation provides response in the following languages:
  * English (en)
  * German (de)
  * Russian (ru)
  * Japanese (ja)
  * French (fr)
  * Chinese Simplified (cn)
  * Spanish (es)
  * Czech (cs)
  * Italian (it)  
  Only the paid plan subscriptions can get the response in languages other than English. All the other users will only get the response in English.

* $fields  
Pass the _fields_ parameter to get the specified fields only. By default, it is set to get all the fields in the response.

* $excludes
Pass the _exlcludes_ parameter to get remove the unnecessary fields from the response. By default, it set to not to exclude any fields.

```php
<?php
    $apiKey = "PUT_YOUR_API_KEY_HERE";
    $ip = "CLIENT_IP_ADDRESS";
    $location = get_geolocation($apiKey, $ip);
    $decodedLocation = json_decode($location, true);
    
    echo "<pre>";
    print_r($decodedLocation);
    echo "</pre>";

    function get_geolocation($apiKey, $ip, $lang = "en", $fields = "*", $excludes = "") {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip."&lang=".$lang."&fields=".$fields."&excludes=".$excludes;
        $cURL = curl_init();

        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));
        
        return curl_exec($cURL);
    }
?>
```

### Example

Here is an example to get the geolocation for a list of IP addresses and display the result as a table:

```php
<style>
    table, th, tr, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th, td {
        padding: 5px 30px;
    }
</style>

<?php
    $apiKey = "PUT_YOUR_API_KEY_HERE";
    $ips = array("3.3.3.3", "4.4.4.4", "5.5.5.5", "6.6.6.6", "7.7.7.7");

    echo "<table>";
    echo "<tr>";
    echo "<th>IP</th>";
    echo "<th>Continent</th>";
    echo "<th>Country</th>";
    echo "<th>Organization</th>";
    echo "<th>ISP</th>";
    echo "<th>Languages</th>";
    echo "<th>Is EU Member?</th>";
    echo "<th>Currency</th>";
    echo "<th>Timezone</th>";
    echo "</tr>";

    foreach ($ips as $ip) {
        $location = get_geolocation($apiKey, $ip);
        $decodedLocation = json_decode($location, true);

        echo "<tr>";

        if ($decodedLocation['message'] != '') {
            echo "<td>".$ip."</td>";
            echo "<td>".$decodedLocation['message']."</td>";
        } else {
            echo "<td>".$decodedLocation['ip']."</td>";
            echo "<td>".$decodedLocation['continent_name']." (".$decodedLocation['continent_code'].")</td>";
            echo "<td>".$decodedLocation['country_name']." (".$decodedLocation['country_code2'].")</td>";
            echo "<td>".$decodedLocation['organization']."</td>";
            echo "<td>".$decodedLocation['isp']."</td>";
            echo "<td>".$decodedLocation['languages']."</td>";

            if ($decodedLocation['is_eu'] == true) {
                echo "<td>Yes</td>";
            } else {
                echo "<td>No</td>";
            }
            
            echo "<td>".$decodedLocation['currency']['name']."</td>";
            echo "<td>".$decodedLocation['time_zone']['name']."</td>";
        }

        echo "</tr>";
    }

    echo "</table>";

    function get_geolocation($apiKey, $ip, $lang = "en", $fields = "*", $excludes = "") {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip."&lang=".$lang."&fields=".$fields."&excludes=".$excludes;
        $cURL = curl_init();

        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));

        return curl_exec($cURL);
    }
?>
```
