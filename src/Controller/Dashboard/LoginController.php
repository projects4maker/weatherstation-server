<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

namespace App\Controller\Dashboard;

use App\FileLoader;

class LoginController {

    public function __construct(){}

    public function response($request, $response, $args){

        $file = new FileLoader(__DIR__ . '/../../../app/views/login.php');

        $content = $file->include();

        $response->getBody()->write($content);
        return $response->withHeader('Content-Type', 'text/html')
                        ->withStatus(200);
    }
}