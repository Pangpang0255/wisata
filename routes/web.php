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

$router->get('/', 'WebController@login'); // Langsung ke login admin
$router->get('/login', 'WebController@login');
$router->get('/admin', 'WebController@login'); // Alias untuk login admin
$router->get('/dashboard', 'WebController@dashboard');


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('wisata', ['uses' => 'WisataController@showAll']);
    $router->get('wisata/{id}', ['uses' => 'WisataController@showOne']);
    $router->post('wisata', ['uses' => 'WisataController@create']);
    $router->delete('wisata/{id}', ['uses' => 'WisataController@delete']);
    $router->put('wisata/{id}', ['uses' => 'WisataController@update']);

    // jwt-auth
    $router->post('login', ['uses' => 'AuthController@login']);
    $router->post('logout', ['uses' => 'AuthController@logout']);
    $router->post('refresh', ['uses' => 'AuthController@refresh']);
    $router->post('user-profile', ['uses' => 'AuthController@me']);
});

