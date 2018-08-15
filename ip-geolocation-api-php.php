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
