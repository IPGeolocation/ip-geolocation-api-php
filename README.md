# ip-geolocation-api-php

## Quick Start Guide

  Following is a php code snippet that gets the golocation data from the ip addess given. 
  
  There is a methode get_web_page which takes url as parameter and returns the response from ipgeolocation. All you have to do is call the get_web_page function with the correct url 
  
  What constitutes a correct URL?
      the correct url is created by 
  
  Url takes one required parameter apiKey.
  
  Note: This Url requires a valid IPGeolocation API key. Sign up (https://ipgeolocation.io/signup?plan=1) if you don’t have one.
  
  And replace 103.255.5.105 (ip) with your client ip.

```
<?php
$response = get_web_page("https://api.ipgeolocation.io/ipgeo?apiKey=YOUR_API_KEY&ip=YOUR_CLIENTS_IP");

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
