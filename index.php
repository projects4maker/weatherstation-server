<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

require __DIR__ . '/vendor/autoload.php';

use App\WeatherStationService;
use App\Controller\ErrorController;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$errorMiddleware->setDefaultErrorHandler(function($request, $exception) use ($app) {

    $handler = new ErrorController();
    return $handler->response($request, 
        $app->getResponseFactory()->createResponse(), 
        $exception);
});

WeatherStationService::start();

require __DIR__ . '/app/routes.php';

$app->run();