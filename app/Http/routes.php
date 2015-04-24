<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return $app->welcome();
});



$app->get('/login/endpoint', 'App\Http\Controllers\SessionController@endpoint');

$app->get('/login/error', 'App\Http\Controllers\SessionController@error');

$app->get('/login/facebook', 'App\Http\Controllers\SessionController@facebook');

$app->get('/logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\SessionController@logout']);


$app->get('/{identifier_id:[0-9]+}', [
    'as' => 'home',
    'middleware' => 'login',
    'uses' => 'App\Http\Controllers\UserController@index'
]);