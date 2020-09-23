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

class DataOutModel {

    private $pdo = null;

    public function __construct() {

        $db = new Db();
        $this->pdo = $db->getPdo();
    }

    public function __destruct() {

        $this->pdo = null;
    }

    public function readDatabaseEntitieLastValue() {

        $sql = 'SELECT humidity, pressure, temperature, draw_time FROM %dbname%.weather_storage ORDER BY entry_id DESC LIMIT 1';

        $statement = $this->pdo->query(
            str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
        );

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function readDatabaseEntitiesByRows($rows) {

        if($rows <= 0 ) {

            return; 
        }

        $sql = 'SELECT humidity, pressure, temperature, draw_time FROM %dbname%.weather_storage ORDER BY entry_id DESC LIMIT '.$rows;

        $statement = $this->pdo->query(
            str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
        );

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readDatabaseEntitieById($id) {

        if($id <= 0) {

            return; 
        }

        $sql = 'SELECT humidity, pressure, temperature, draw_time FROM %dbname%.weather_storage WHERE entry_id =' . $id;

        $statement = $this->pdo->query(
            str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
        );
        
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function readDatabaseEntitiesByDateRange($startDate, $endDate) {

        if($startDate == '' || $endDate == '') {

            return; 
        }

        $sql = 'SELECT humidity, pressure, temperature, draw_time FROM %dbname%.weather_storage WHERE draw_time BETWEEN "' . $startDate . 
        '" AND "' . $endDate . '" ORDER BY entry_id ASC';

        $statement = $this->pdo->query(
            str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
        );

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readDatabaseEntitiesByHumidityRange($rangeDown, $rangeTop) {

        if($rangeDown == 0 || $rangeTop == 0) {

            return; 
        }

        $sql = 'SELECT humidity, pressure, temperature, draw_time FROM %dbname%.weather_storage WHERE humidity BETWEEN "' . $rangeDown . 
        '" AND "' . $rangeTop . '" ORDER BY humidity ASC';

        $statement = $this->pdo->query(
            str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
        );

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readDatabaseEntitiesByPressureRange($rangeDown, $rangeTop) {

        if($rangeDown == 0 || $rangeTop == 0) {

            return; 
        }

        $sql = 'SELECT humidity, pressure, temperature, draw_time FROM %dbname%.weather_storage WHERE pressure BETWEEN "' . $rangeDown . 
        '" AND "' . $rangeTop . '" ORDER BY pressure ASC';

        $statement = $this->pdo->query(
            str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
        );

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readDatabaseEntitiesByTemperatureRange($rangeDown, $rangeTop) {

        if($rangeDown == 0 || $rangeTop == 0) {

            return; 
        }

        $sql = 'SELECT humidity, pressure, temperature, draw_time FROM %dbname%.weather_storage WHERE temperature BETWEEN "' . $rangeDown . 
        '" AND "' . $rangeTop . '" ORDER BY temperature ASC';

        $statement = $this->pdo->query(
            str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
        );

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}