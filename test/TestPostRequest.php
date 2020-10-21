
<?php

require __DIR__ . '/../vendor/autoload.php';

use App\WeatherStationService;

$values = [
    'humidity' => rand(1,100),
    'pressure' => rand(999, 1050),
    'temperature' => rand(23,35).".".rand(0,9),

];

WeatherStationService::start();

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"localhost/api/post");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "hash=" . WeatherStationService::get('weather_station_very_hash') .
            "&humidity=".$values['humidity'] .
            "&pressure=".$values['pressure'] .
            "&temperature=".$values['temperature']);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

echo $server_output;