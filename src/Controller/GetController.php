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
use App\Model\DataOutModel;

class GetController {

    protected $data = [];

    protected $payload = null;

    public function __construct(){

        $this->payload = new Payload();

        $this->data = $_GET;
        $_GET = null;
    }

    public function response($request, $response, $args){

        if(!isset($this->data['hash'])) {

            $this->payload->applyError('Missing value: hash');
        } elseif(!Weatherstation::auth($this->data['hash'])) {

            $this->payload->applyError('Authentication failed');
        } else {

            /**
             * casing return one value
             */
            if(count($this->data) == 1) {

                $model = new DataOutModel();
                $this->payload->setData([0 => $model->readDatabaseEntitieLastValue()]);
            }
            /**
             * casing return limited values
             * with limit=?
             */
            elseif(count($this->data) == 2 &&
                isset($this->data['limit'])) {

                    $limit = $this->data['limit'];
                    if($limit > 0 && $limit < 999) {

                        $model = new DataOutModel();
                        $this->payload->setData($model->readDatabaseEntitiesByRows($limit));
                    } else {

                        $this->payload->applyError('Value limit is not between 0 and 999: ' . $limit);
                    }
            }
            /**
             * casing retun by the entry_id
             */
            elseif(count($this->data) == 2 &&
                isset($this->data['id'])) {

                    $id = $this->data['id'];

                    if(is_numeric($id)) {

                        $model = new DataOutModel();
                        $this->payload->setData([0 => $model->readDatabaseEntitieById($id)]);
                    } else {

                        $this->payload->applyError('Value id has to be type of numeric: ' . $id);
                    }
            }

            if(!$this->payload->getPayloadDataSize()) {
            
                $this->payload->applyError('Empty database or there is no entry with this selection.');
            }
        }

        //TODO: Add get by date
        //TODO: Add get by date, periode of time
        //TODO: Add get by parameter values like humidity, with hight and low limit

        $response->getBody()->write($this->payload->jsonResponse());
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus($this->payload->getHttpCode());
    }

    public function getData() {

        return $this->data;
    }
}