<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller;

use App\ResponsePayload as Payload;

class ErrorController {

    protected $payload = null;

    public function __construct() {

        $this->payload = new Payload();
    }

    public function response($request, $response, $exception) {

        $this->payload->applyError($exception->getMessage());

        $response->getBody()->write($this->payload->jsonResponse());
        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus($this->payload->getHttpCode());
    }
}