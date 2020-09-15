<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App;

use App\WeatherStationService;
use App\Exception\TerminateException as TException;

class Db {

    private $pdo = null;

    public function __construct() {

        $host = WeatherStationService::get('host');
        $port = WeatherStationService::get('port');
        $dbname = WeatherStationService::get('dbname');
        $user = WeatherStationService::get('user');
        $password = WeatherStationService::get('password');

        if($port == 0 || $port == '0' || $port == '') {

            $port_string = '';
        } else {

            $port_string = ';port=' . $port;
        }

        try {

            $this->pdo = new  \PDO(
                'mysql:dbname=' . $dbname .
                ';host=' . $host .
                $port_string,
                $user,
                $password);
                
        } catch(\PDOException $e) {

            throw new TException('Cant create MySQL-Connection: '.$e->getMessage());
        }
    }

    public function __destruct() {

        $this->pdo = null;
    }

    public function getPdo() {
        
        return $this->pdo;
    }
}