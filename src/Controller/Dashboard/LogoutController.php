<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller\Dashboard;

class LogoutController {

    public function __construct(){}

    public function response($request, $response, $args){

        $response->getBody()->write($content);
        return $response->withHeader('Content-Type', 'text/html')
                        ->withStatus(200);
    }
}