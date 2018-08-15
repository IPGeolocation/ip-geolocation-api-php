# IP Geolocation API PHP SDK
You need a valid IPGeolocation API key to use this SDK. Sign up(https://ipgeolocation.io/signup?plan=1) if you don’t have API key.

## Quick Start Guide
Call method **get_location($apikey, $clientIp)** passing *API key* and *IP address (optional)* as parameters and it will return IPGeolocation API response.
Note: If you want IP to geolocation for machine calling IPGeolocation API, don't pass the *IP address* parameter.

### Basic Usage
```php
<?php
    $clientIp = "IP_ADDRESS";
    $apikey = "YOUR_API_KEY";
    
    $response = get_location($apikey, $clientIp);
    $resArr = array();
    $resArr = json_decode($response);
    
    echo "<pre>"; print_r($resArr); echo "</pre>";
    function get_location($apiKey, $ip = null) {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip;
        $cURL = curl_init();
        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);

        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
             'Content-Type: application/json',
             'Accept: application/json'
        ));

        $content = curl_exec($cURL);
        curl_close($cURL);
        return $content;
    }
?>
```
