<?php

use  App\Http\Controllers\RandomUserController;

/** @var \Laravel\Lumen\Routing\Router $router */
ini_set('display_errors', 1);
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
$router->get('exec', 'RandomUserController@exec');
