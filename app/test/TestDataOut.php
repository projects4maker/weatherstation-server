<?php

require __DIR__ . '/../vendor/autoload.php';

use App\WeatherStationService;
use App\Model\DataOutModel;

WeatherStationService::start();

$outModel = new DataOutModel();
$data = $outModel->readDatabaseEntitiesByRows(10);

echo json_encode($data);