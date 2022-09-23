<?php
session_start();
$errors = [];
$data =[];

$_POST['title'] = "stop";
$_POST['content'] = "stop";
if (empty($_POST['title'])) {
    $errors['title'] = 'title is required.';
}

if (empty($_POST['content'])) {
    $errors['content'] = 'content is required.';
}
$Field0=["field" => "f0", "value" => "Breaking News"];
$Field1 = ["field" => "f1", "value" => $_POST['title']];
$Field2 =["field" => "f2", "value" => $_POST['content']];
$combined =[$Field0,$Field1,$Field2];


if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['casparServer'] = "OVERLAY";
    $data['casparChannel'] = "1";
    $data['casparlayer'] = "6";
    $data['webplayoutLayer'] = "6";
    $data['dataformat'] = "json";
    $data['relativeTemplatePath'] = 'softpix/Template_Pack_1.1/YELLOW_DARK.html';
    $data['DataFields'] = $combined;
    $data['command'] = "stop";
}

$json = json_encode($data);
$result = str_replace('\\', '', $json);

$url = "http://192.168.20.11:5656/api/v1/directplayout";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

curl_setopt($curl, CURLOPT_POSTFIELDS, $result);

$resp = curl_exec($curl);
curl_close($curl);


$_SESSION['errors'] = $errors;
$_SESSION['stopped'] = true;
header('Location: index.php');
