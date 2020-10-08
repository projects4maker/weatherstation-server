<?php
/**
 * raah @ projects4maker.com
 * 
 * Weatherstation project server source
 * 
 * @see projects4maker.com/weatherstation
 */

use App\Controller\Api\GetController;
use App\Controller\Api\PostController;
use App\Controller\Dashboard\DashboardController;
use App\Controller\Dashboard\LoginController;
use App\Controller\Dashboard\AjaxController;
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

$app->any(WeatherStationService::get('sub_path'), function ($request, $response, $args) {
    return $response
            ->withHeader('Location', WeatherStationService::get('sub_path') . 'dashboard')
            ->withStatus(302);
});

$app->post(WeatherStationService::get('sub_path') . 'ajax/{request}', AjaxController::class . ':response');

$app->map(['GET', 'POST'], WeatherStationService::get('sub_path') . 'login', LoginController::class . ':response');

$app->get(WeatherStationService::get('sub_path') . 'dashboard', DashboardController::class . ':response');