<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller\Dashboard;

use App\FileLoader;
use App\WeatherStationService as Weatherstation; 

class DashboardController {

    protected $data = [];

    public function __construct(){
        
        $this->data = $_COOKIE;
    }

    public function response($request, $response, $args){

        if(!isset($this->data['hash']) ||
            isset($this->data['hash']) && !Weatherstation::auth($this->data['hash'])) {

            return $response
                ->withHeader('Location', Weatherstation::get('sub_path') . 'login')
                ->withStatus(302);
        }

        $file = new FileLoader(__DIR__ . '/../../../app/views/dashboard.php');

        $content = $file->include();

        $response->getBody()->write($content);
        return $response->withHeader('Content-Type', 'text/html')
                        ->withStatus(200);
    }
}