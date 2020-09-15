<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

//TODO Implemet payload
//TODO with if error and if status ok
//TODO with json return

namespace App;

class ResponsePayload {

    protected $structure = [
        'data' => null,
        'status' => '',
        'message' => ''
    ];

    protected $isErrorResponse = false;

    protected $payload = [];

    protected $httpCode = 0;

    public function __construct() {

        $this->payload = $this->structure;
    }

    public function setData($data) {

        $this->payload['data'] = $data;
    }

    public function applyError($message = '') {

        $this->isErrorResponse = true;

        $this->applyMessage($message);


    }

    public function applyMessage($message = '') {

        if(empty($this->payload['message'])) {

            $this->payload['message'] = $message;
        } else {

            $this->payload['message'] .= '; ' . $message;
        }
        
    }

    private function makeResponse() {

        if($this->isErrorResponse) {

            $this->payload['status'] = 'error';

            $this->httpCode = 400;

            if(empty($this->payload['message'])) {

                $this->payload['message'] = 'Something went wrong!';
            }

            $this->payload['data'] = null;
        } else {

            $this->payload['status'] = 'ok';

            $this->httpCode = 200;

            if(empty($this->payload['message'])) {

                $this->payload['message'] = 'Action successful!';
            }
        }

        return $this->payload;
    }

    public function jsonResponse() {

        return json_encode($this->makeResponse());
    }

    public function response() {

        return $this->makeResponse();
    }

    public function getStructure() {

        return $this->structure;
    }

    public function getPayload() {

        return $this->payload;
    }

    public function getIsErrorResponse() {

        return $this->IsErrorResponse;
    }

    public function getHttpCode() {

        return (int) $this->httpCode;
    }

    public function getPayloadDataSize() {

        if($this->payload['data'] === false || $this->payload['data'] == null) {

            return false;
        } else {

            return true;
        }
    }
}