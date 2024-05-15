<?php

$url = "https://aareguru.existenz.ch/v2018/current?city=bern&app=my.app.ch&version=1.0.42";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

curl_close($ch);

$data = json_decode($output, true);
$aareFlow = $data["aare"]['flow'];
$aareTemp = $data["aare"]['temperature'];
$airTemp = $data['weather']['current']['tt'];

$aareData = [
    'aareFlow' => $aareFlow,
    'aareTemp' => $aareTemp,
    'airTemp' => $airTemp
];

?>