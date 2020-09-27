<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller;

use App\FileLoader;

class DashController {

    public function __construct(){}

    public function login($request, $response, $args){

        $file = new FileLoader(__DIR__ . '/../../app/views/login.php');

        $content = $file->include();

        $response->getBody()->write($content);
        return $response->withHeader('Content-Type', 'text/html')
                        ->withStatus(200);

    }

    public function dashboard($request, $response, $args){

        $file = new FileLoader(__DIR__ . '/../../app/views/dashboard.php');

        $content = $file->include();

        $response->getBody()->write(
            $content
        );
        return $response;

    }

    private function makePublicAuth() {

    }

}