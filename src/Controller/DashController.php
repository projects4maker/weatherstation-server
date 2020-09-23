<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller;

class DashController {

    public function __constructor(){}

    public function dashboard($request, $response, $args){

        $content = file_get_contents(__DIR__ . '/../../app/views/dashboard.html');

        $response->getBody()->write(
            $content
        );
        return $response;

    }

    private function makePublicAuth() {
        
    }

}