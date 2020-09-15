<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller;

use App\WeatherStationService as Weatherstation; 
use App\ResponsePayload as Payload; 
use App\Model\DataInModel;

class PostController {

    protected $data = [];

    protected $needlyValues = [
        'humidity',
        'pressure',
        'temperature',
        'hash'
    ];

    protected $payload = null;

    public function __construct(){

        $this->payload = new Payload();

        $this->data = $_POST;
        $_POST = null;   
    }

    public function response($request, $response, $args){

        $this->checkData();

        if(!$this->payload->getIsErrorResponse()) {

            if(!Weatherstation::auth($this->data['hash'])) {

                $this->payload->applyError('Authentication failed.');
            } else {

                $model = new DataInModel();
                $model->updateDatabase($this->data);
            }
        }

        $response->getBody()->write($this->payload->jsonResponse());
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus($this->payload->getHttpCode());
    }

    protected function checkData() {

        foreach($this->needlyValues as $value) {

            if(!isset($this->data[$value])) {
                
                $this->payload->applyError('Missing value: ' . $value);
            }
        }

    }

    public function getData() {

        return $this->data;
    }

    public function getNeedlyValues() {

        return $this->needlyValues;
    }
}