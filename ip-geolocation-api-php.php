<?php
    $clientIp = "CLIENT_IP_ADDRESS";
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
