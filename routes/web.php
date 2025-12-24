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

$router->get('/', 'WebController@login'); // Redirect ke login
$router->get('/wisata', 'WebController@userDashboard'); // Dashboard user/public
$router->get('/login', 'WebController@login');
$router->get('/admin', 'WebController@login'); // Alias untuk login admin
$router->get('/dashboard', 'WebController@dashboard');
$router->get('/test', function () {
    return response()->json(['message' => 'Test route works']);
});


$router->group(['prefix' => 'api', 'middleware' => 'throttle:200,1'], function () use ($router) {
    // Public endpoints (200 req/min - cukup untuk development & production)
    $router->get('wisata', ['uses' => 'WisataController@showAll']);
    $router->get('wisata/{id}', ['uses' => 'WisataController@showOne']);
    
    // Auth endpoints (20 req/min untuk keamanan login)
    $router->post('login', ['middleware' => 'throttle:20,1', 'uses' => 'AuthController@login']);
    $router->post('logout', ['uses' => 'AuthController@logout']);
    $router->post('refresh', ['uses' => 'AuthController@refresh']);
    $router->post('user-profile', ['uses' => 'AuthController@me']);
    
    // Protected endpoints (200 req/min)
    $router->post('wisata', ['uses' => 'WisataController@create']);
    $router->delete('wisata/{id}', ['uses' => 'WisataController@delete']);
    $router->put('wisata/{id}', ['uses' => 'WisataController@update']);
});

