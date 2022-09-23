<?php

use LDAP\Result;

session_start();
$result = [];
$url = "http://192.168.20.11:5656/api/v1/version";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


$resp =curl_exec($curl);
$info = curl_getinfo($curl);
if($info['http_code'] ===200){
    $status = 'Connected';
    $color = 'green';
}
else{
    $status = 'Disconnected'; 
    $color = 'red';
}

$_SESSION['status'] = $status;
$_SESSION['color'] = $color;
$result = json_decode($resp);
curl_close($curl);
