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
use App\WeatherStationService;
use App\Exception\ProcException;

class LoginController {

    protected $data = null;

    protected $isLoginAttempt = false;

    public function __construct(){

        if(!empty($_POST) && !empty($_GET)) {

            throw new ProcException("Test"); //TODO
        } elseif(isset($_POST)) {

            $this->isLoginAttempt = true;
            $this->data = $_POST;
            $_POST = null;
        }
    }

    public function response($request, $response, $args){

        /**
         * value in the views
         */
        $isInvalid = false;

        if($this->isLoginAttempt &&
            isset($this->data['login_hash']) &&
            isset($this->data['try_auth'])) {
                
                if(WeatherStationService::auth($this->data['login_hash'])) {

                    //TODO set cookie and redirect
                } else {

                    $isInvalid = true;
                }
        }

        $file = new FileLoader(__DIR__ . '/../../../app/views/login.php');

        $content = $file->include();

        $response->getBody()->write($content);
        return $response->withHeader('Content-Type', 'text/html')
                        ->withStatus(200);
    }
}