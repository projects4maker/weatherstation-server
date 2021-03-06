<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Helper;

use App\WeatherStationService;
use App\Db;

class RunFirstTime {

    protected $sqlfile = __DIR__ .'/../../app/db/weatherstation.sql';

    public function doInstall() {

        //Check Config
        $errors = 0;

        foreach(WeatherStationService::getConfigneedly() as $value) {

            if(WeatherStationService::checkConfigProperty($value) == false) {

                echo("Property '$value' are missing. :/ \n");
                $errors++;
            }
        }

        if($errors > 0) {

            exit();
        }


        if(is_file($this->sqlfile) && is_readable($this->sqlfile)) {

            $sql = file_get_contents($this->sqlfile);
        } else {

            echo("Unable to find the sql file at: " . $this->sqlfile);
            exit();
        }

        //Install: Database
        try {
            
            $db = new Db();
            $pdo = $db->getPdo();
            $statement = $pdo->prepare(
                str_replace('%dbname%', WeatherStationService::get('dbname'), $sql)
            );
            $statement->execute();
        } catch(PDOException $e) {
            
            echo("Some errors happend while installing the database: " . $e->getMessage());
            exit();
        }


        //Escape
        echo("Finish.");
        exit();
    }

    public function getSqlFile() {
        
        return $this->sqlfile;
    }

}
