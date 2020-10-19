<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller\Dashboard;

use App\WeatherStationService as Weatherstation; 
use App\ResponsePayload as Payload; 
use App\Exception\ProcException;

class AjaxController {

    protected $data = [];

    protected $payload = null;

    public function __construct(){
        
        $this->payload = new Payload();

        $this->data = $_POST;
        $_POST = null;
    }

    public function response($request, $response, $args){

        if($args['request'] == 'login') {

            if(!isset($this->data['hash'])) {

                $this->payload->applyError('Missing hash.');
            }
            
            $this->handleLogin();
        } elseif($args['request'] == 'logout') {

            $this->handleLogout();
        } else {

            throw new ProcException('Unknown ajax request.');
        }

        $response->getBody()->write($this->payload->jsonResponse());
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus($this->payload->getHttpCode());
    }

    protected function handleLogin() {

        if(Weatherstation::auth($this->data['hash'])) {

            //development-bug-fix
            $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;

            /**
             * set cookie
             */
            setcookie(
                'hash', //name
                Weatherstation::get('weather_station_very_hash'), //value
                time()+99999, //expire
                Weatherstation::get('sub_path'), //path
                $domain,  //vaild 
                false //unset
            );

            $this->payload->setData(['auth' => 'ok', 'msg' => 'Auth successful.']);
        } else {

            $this->payload->setData(['auth' => 'failed', 'msg' => 'Auth failed.']);
        }
    }

    protected function handleLogout() {

        //development-bug-fix
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;

        /**
         * set cookie
         */
        setcookie(
            'hash', //name
            '', //value
            time()+99999, //expire
            Weatherstation::get('sub_path'), //path
            $domain,  //vaild 
            true //unset
        );

        $this->payload->setData(['logout' => 'ok', 'msg' => 'Logout successful.']);
    
        //TODO: Add fail
    }
}