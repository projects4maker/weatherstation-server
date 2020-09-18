<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

use App\Controller\GetController;
use App\Controller\PostController;
use App\Controller\DashController;
use App\WeatherStationService;
use Slim\Interfaces\RouteCollectorProxyInterface as GroupInterface;

//Main /api group
$app->group(WeatherStationService::get('sub_path') . 'api', function (GroupInterface $group){

    //Redirect to the dash controller
    $group->any('/', function ($request, $response, $args) {
        return $response
                ->withHeader('Location', WeatherStationService::get('sub_path'))
                ->withStatus(302);
    });

    /**
     * Api get route:
     * 
     * For the arguments and more
     * see the docs
     */
    $group->get('/get', GetController::class . ':response');
    
    /**
     * Api post route:
     * 
     * For the arguments and more
     * see the docs
     */
    $group->post('/post', PostController::class . ':response');

});

//Dash router
$app->get(WeatherStationService::get('sub_path'), DashController::class . ':response');