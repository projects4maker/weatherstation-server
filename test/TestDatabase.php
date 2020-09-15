<?php

require __DIR__ . '/../vendor/autoload.php';

use App\WeatherStationService;
use App\Model\DataInModel;
use App\Model\DataOutModel;

$values = [
    'humidity' => rand(1,100),
    'pressure' => rand(999, 1050),
    'temperature' => rand(23,35).".".rand(0,9),

];

WeatherStationService::start();

$inModel = new DataInModel();
$inModel->updateDatabase($values);

echo "Data in works ..\n";

$outModel = new DataOutModel();
$data = $outModel->readDatabaseEntitieLastValue();

if($values['humidity'] == $data['humidity'] &&
    $values['pressure'] == $data['pressure'] &&
    $values['temperature'] == $data['temperature']) {

    echo "Data out works too!";
} else {
    echo "Something goes wrong!";
}