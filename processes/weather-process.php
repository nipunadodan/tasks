<?php
use Orange\ApiConnect;

$data = [
    'q' => $_GET['q'],
    'appid' => $_GET['appid'],
];
$api = ApiConnect::getJSON('https://samples.openweathermap.org/data/2.5/weather',$data);

print_r($api);