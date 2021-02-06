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

$router->group(['prefix' => ''], function () use ($router)
{
    $router->get('v1/api/items',               ['uses' => 'ItemController@showAll']);
  
    $router->post('v1/api/items/create',       ['uses' => 'ItemController@create']);
  
    $router->delete('v1/api/item/delete/{id}', ['uses' => 'ItemController@delete']);
  
    $router->put('v1/api/item/{id}',           ['uses' => 'ItemController@update']);
  });
  