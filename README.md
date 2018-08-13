# ip-geolocation-api-php

## Quick Start Guide
  
  There is a methode get_location($apikey, $clientIp) in below given snippet which takes apiKey and clientIp as parameter and returns the response from ipgeolocation. 
  
  All you have to do is replace keyword "YOUR_CLIENT_IP" with your valid client ip and "YOUR_API_KEY" with valid apiKey provided by ipgeolocation. 
  
  Note: This snippet requires a valid IPGeolocation API key. Sign up (https://ipgeolocation.io/signup?plan=1) if you don’t have API key. And you may leave YOUR_CLIENT_IP empty.
  
```
<?php
$clientIp = "YOUR_CLIENT_IP";
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
