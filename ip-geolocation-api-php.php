
<?php

$response = get_web_page("https://api.ipgeolocation.io/ipgeo?apiKey=d9d46f08bfb34ee59e4e8c74f07bb449&ip=103.255.5.105");
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