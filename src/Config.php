<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App;

use App\Exception\TerminateException as TException;

class Config {

    static private $loaded = false;

    static private $file = __DIR__ . '/../config/config.ini';

    static private $config = [];

    static private $configneedly = [
        'weather_station_very_hash',
        'host',
        'dbname',
        'user',
        'password'
    ];

    static public function loadConfig() {

        if(!is_readable(self::$file) || !is_file(self::$file)) {

            throw new TException('Cant read or find the config file. Place it in config/ and name it config.ini.');
        }

        $parsed = parse_ini_file(self::$file, false); //dont load groups

        self::$config = $parsed;

        //Solve issue if the sub_path is empty OR "/"
        if(isset(self::$config['sub_path'])) {

            if(substr(self::$config['sub_path'], -1) == '/') {

                self::$config['sub_path'] = substr(self::$config['sub_path'], 0, -1);
            }
        }

        self::$loaded = true;
    }

    static public function get($property) {

        if(empty($property)) {

            return;
        }

        if(self::checkConfigProperty($property)) {

            return self::$config[$property];
        }

    }

    static public function checkConfigProperty($property = '') {

        if(!self::$loaded) {

            self::loadConfig();
        }     

        if(!array_key_exists($property, self::$config)) {

            return false;
        }
        
        $value = self::$config[$property];

        if($value == '' || empty($value)) {

            throw new TException("Property $property is empty");

            return false;
        }

        return true;
    }

    static public function getLoaded() {

        return self::$loaded;
    }

    static public function getFile() {

        return self::$file;
    }
    
    static public function getConfigneedly() {
        
        return self::$configneedly;
    }
}