<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'drones'], function () use ($router) {
    $router->get('/', 'DroneController@List');
    $router->post('/', 'DroneController@Insert');
    $router->put('/{id}', 'DroneController@Update');
    $router->delete('/{id}', 'DroneController@Delete');
    $router->get('/paginar/{limit}', 'DroneController@Paginate');
    $router->get('/sort/{field}/{order}', 'DroneController@Sort');
    $router->get('/filter/{name}/{status}', 'DroneController@Filter');
});