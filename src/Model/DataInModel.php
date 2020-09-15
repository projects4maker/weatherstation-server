<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Model;

use App\Db;
use App\WeatherStationService;

class DataInModel {

    public function updateDatabase(array $parameter) {

        $sql = 'INSERT INTO %dbname%.weather_storage (draw_time, humidity, pressure, temperature) VALUES (NOW(), :h, :p, :t)';

        $db = new Db();
        $pdo = $db->getPdo();
        $statement = $pdo->prepare(
            str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
        );
        $statement->bindParam(':h', $parameter['humidity'], \PDO::PARAM_INT);
        $statement->bindParam(':p', $parameter['pressure'], \PDO::PARAM_INT);
        $statement->bindParam(':t', $parameter['temperature'], \PDO::PARAM_STR);
        $statement->execute();
        $db = null;
    }
}