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
    // users
    $router->get('users',  ['middleware' => 'auth', 'uses' => 'UserController@showAll']);
    $router->get('user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@showOne']);
    $router->post('user', ['middleware' => 'auth', 'uses' => 'UserController@create']);
    $router->delete('user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@delete']);
    $router->put('user/{id}', ['middleware' => 'auth', 'uses' => 'UserController@update']);

    // usergroups
    $router->get('usergroups',  ['middleware' => 'auth', 'uses' => 'UsergroupController@showAll']);
    $router->get('usergroup/{id}', ['middleware' => 'auth', 'uses' => 'UsergroupController@showOne']);
    $router->post('usergroup', ['middleware' => 'auth', 'uses' => 'UsergroupController@create']);
    $router->delete('usergroup/{id}', ['middleware' => 'auth', 'uses' => 'UsergroupController@delete']);
    $router->put('usergroup/{id}', ['middleware' => 'auth', 'uses' => 'UsergroupController@update']);
});