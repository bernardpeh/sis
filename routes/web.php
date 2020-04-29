<?php

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('users',  ['middleware' => 'auth', 'uses' => 'UserController@showAllUsers']);

    $router->get('user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@showOneUser']);

    $router->post('user', ['middleware' => 'auth', 'uses' => 'UserController@create']);

    $router->delete('user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@delete']);

    $router->put('user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@update']);
});