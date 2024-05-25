<?php

include 'extract.php';

// echo "Hello World";
// echo "<br>";
// print_r($aareData);

// transform data
$aareSpeed = ($aareData['aareFlow'] / 75) * 3.6;
$aareTime = round((27 / $aareSpeed) * 60);

// echo $aareSpeed;
// echo "<br>";
// echo $aareTime;

$aareDataTrans = [
    'speed' => $aareSpeed,
    'travelTime' => $aareTime,
    'temperature' => $aareTemp
];

// print_r($aareDataTrans);

?>