<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller\Api;

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
            
            /**
             * casing retun by the date
             */
            elseif(count($this->data) == 2 &&
                isset($this->data['date'])) {

                    $date = $this->data['date'];    
                
                    if(strtotime($date) != false) {

                        $model = new DataOutModel();
                        $this->payload->setData(
                            $model->readDatabaseEntitiesByDateRange($date . ' 00:00:00', $date . ' 23:59:59')
                        );
                    } else {

                        $this->payload->applyError('Value date is not the correct format: ' . $date);
                    }
            }

            /**
             * casing retun by the date, periode of time
             */
            elseif(count($this->data) == 3 &&
                isset($this->data['sdate']) &&
                isset($this->data['edate'])) {


                    $startDate = $this->data['sdate'];
                    $endDate = $this->data['edate'];    
                    

                    if(strtotime($startDate) != false &&
                    strtotime($endDate) != false) {

                        if(strtotime($startDate) >= strtotime($endDate)) {

                            $this->payload->applyError('End date musste be after start date.');
                        } else {

                            $model = new DataOutModel();
                            $this->payload->setData(
                                $model->readDatabaseEntitiesByDateRange($startDate . ' 00:00:00', $endDate . ' 23:59:59')
                            );
                        }
                    } else {

                        $this->payload->applyError('Value date is not the correct format: ' . $startDate . ' / ' . $endDate);
                    }
            }

            /**
             * casing return by hum, with range
             */
            elseif(count($this->data) == 2 || 
                count($this->data) == 3 &&
                isset($this->data['humidity'])) {

                    $humidity = $this->data['humidity'];

                    if(isset($this->data['range'])) {

                        if(!is_numeric($this->data['range'])) {

                            $this->payload->applyError('Range parameter musst be a numeric val.: ' . $this->data['range']);
                        }

                        $offset = $this->data['range']/2;

                        $rangeDown = $humidity - $offset;
                        $rangeTop = $humidity + $offset;
                    } else {

                        $rangeDown = $humidity;
                        $rangeTop = $humidity;
                    }

                    $model = new DataOutModel();
                    $this->payload->setData(
                        $model->readDatabaseEntitiesByHumidityRange($rangeDown, $rangeTop)
                    );
            }

            /**
             * casing return by pressure, with range
             */
            elseif(count($this->data) == 2 || 
                count($this->data) == 3 &&
                isset($this->data['pressure'])) {

                    $pressure = $this->data['pressure'];

                    if(isset($this->data['range'])) {

                        if(!is_numeric($this->data['range'])) {

                            $this->payload->applyError('Range parameter musst be a numeric val.: ' . $this->data['range']);
                        }

                        $offset = $this->data['range']/2;

                        $rangeDown = $pressure - $offset;
                        $rangeTop = $pressure + $offset;
                    } else {

                        $rangeDown = $pressure;
                        $rangeTop = $pressure;
                    }

                    $model = new DataOutModel();
                    $this->payload->setData(
                        $model->readDatabaseEntitiesByPressureRange($rangeDown, $rangeTop)
                    );
            }

            /**
             * casing return by temperature, with range
             */
            elseif(count($this->data) == 2 || 
                count($this->data) == 3 &&
                isset($this->data['temperature'])) {

                    $temperature = $this->data['temperature'];

                    if(isset($this->data['range'])) {

                        if(!is_numeric($this->data['range'])) {

                            $this->payload->applyError('Range parameter musst be a numeric val.: ' . $this->data['range']);
                        }

                        $offset = $this->data['range']/2;

                        $rangeDown = $temperature - $offset;
                        $rangeTop = $temperature + $offset;
                    } else {

                        $rangeDown = $temperature;
                        $rangeTop = $temperature;
                    }

                    $model = new DataOutModel();
                    $this->payload->setData(
                        $model->readDatabaseEntitiesByTemperatureRange($rangeDown, $rangeTop)
                    );
            }

            if(!$this->payload->getPayloadDataSize()) {
            
                $this->payload->applyError('Empty database or there is no entry with this selection.');
            }
        }

        $response->getBody()->write($this->payload->jsonResponse());
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus($this->payload->getHttpCode());
    }

    public function getData() {

        return $this->data;
    }
}