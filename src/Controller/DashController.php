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

    public function __construct(){}

    public function login($request, $response, $args){

        $content = file_get_contents(__DIR__ . '/../../app/views/login.html');

        $response->getBody()->write(
            $content
        );
        return $response;

    }

    public function dashboard($request, $response, $args){

        $content = file_get_contents(__DIR__ . '/../../app/views/dash.html');

        $response->getBody()->write(
            $content
        );
        return $response;

    }

    private function makePublicAuth() {

    }

}