<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App;

use App\Db;

class WeatherStationService extends Config {
    
    static public function start() {
    
        self::loadConfig();
    }

    static public function auth(string $hash = '') {

        if($hash == self::get('weather_station_very_hash')) {

            return true;
        } else {

            return false;
        }
    }
}