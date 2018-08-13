# ip-geolocation-api-php

## Quick Start Guide

  Here is a complete example of code of php curl for ipgeolocation.
  
  There is a methode get_web_page which takes url as parameter and return response from ipgeolocation.
  
  Url takes one required parameter apiKey.
  
  Note: This Url requires a valid IPGeolocation API key. Sign up if you don’t have one.
  
  And replace 103.255.5.105 (ip) with your client ip.

```
<?php
$response = get_web_page("https://api.ipgeolocation.io/ipgeo?apiKey=YOUR_API_KEY&ip=103.255.5.105");
$resArr = array();
$resArr = json_decode($response);
echo "<pre>"; print_r($resArr); echo "</pre>";
function get_web_page($url) {
    $cURL = curl_init();
    curl_setopt($cURL, CURLOPT_URL, $url);
    curl_setopt($cURL, CURLOPT_HTTPGET, true);
curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
));
    $content  = curl_exec($cURL);
    curl_close($cURL);
    return $content;
}
?>
```
