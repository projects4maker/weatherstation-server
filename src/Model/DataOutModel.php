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
}