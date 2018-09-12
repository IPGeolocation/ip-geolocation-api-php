# IP Geolocation API PHP SDK

## Introduction

IPGeolocation API is the solution to identify country code (ISO2 and ISO3 standard), country name, continent code, continent name, country capital, state/province, district, city, zip code, latitude and longitude of city, is country belongs to Europian Union, calling code, top level domain (TLD), languages, country flag, internet service provider (ISP), connection type, organization, geoname ID, currency code, currency name, time zone ID, time zone offset, current time in the time zone, is time zone in daylight saving time, and total daylight savings. This document provides important information to help you get up to speed with IPGeolocation API using IP Geolocation API PHP SDK.

Developers can use this PHP SDK for software and web projects related to, but not limited to:

* Display native language and currency
* Redirect based on the country
* Digital rights management
* Web log stats and analysis
* Auto-selection of country, state/province and city on forms
* Filter access from countries you do not do business with
* Geo-targeting for increased sales and click-through

## Quick Start Guide
In this document, you will go through the basic steps to use IP Geolocation API PHP SDK.  
You need a valid 'IPGeolocation API key' to use this SDK. [Sign up](https://ipgeolocation.io/signup) here and get your free API key if you don't have one.

## System Requirements  

Internet connection is required to run this component.

## Basic Usage

Call method **get_location($apikey, $clientIp)** passing *IP address (optional)* and *API key* as parameters and it will return IP Geolocation API response.
Note: If you want IP to geolocation for the machine calling IPGeolocation API, leave out the *IP address* parameter.

```php
<?php
    $clientIp = null;
    $apikey = "PUT_YOUR_API_KEY_HERE";
    $response = get_location($apikey, $clientIp);
    $json = array();
    $json = json_decode($response, true);
    
    echo "<pre>";
    print_r($json);
    echo "</pre>";

    function get_location($apiKey, $ip = null) {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip;
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
    $ips = array("3.3.3.3", "4.4.4.4", "5.5.5.5", "6.6.6.6", "7.7.7.7");
    $apikey = "PUT_YOUR_API_KEY_HERE";

    echo "<table>";
    echo "<tr>";
    echo "<th>IP</th>";
    echo "<th>Continent</th>";
    echo "<th>Country</th>";
    echo "<th>Organization</th>";
    echo "<th>ISP</th>";
    echo "<th>Languages</th>";
    echo "<th>Is EU?</th>";
    echo "</tr>";

    foreach($ips as $ip) {
        $location = get_location($apikey, $ip);
        $decodedLocation = json_decode($location);

        echo "<tr>";
        echo "<td>$decodedLocation->ip</td>";
        echo "<td>$decodedLocation->continent_name ($decodedLocation->continent_code)</td>";
        echo "<td>$decodedLocation->country_name ($decodedLocation->country_code2)</td>";
        echo "<td>$decodedLocation->organization</td>";
        echo "<td>$decodedLocation->isp</td>";
        echo "<td>$decodedLocation->languages</td>";
        if($decodedLocation->is_eu == true) {
            echo "<td>Yes</td>";
        } else {
            echo "<td>No</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    function get_location($apiKey, $ip = null) {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip;
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
