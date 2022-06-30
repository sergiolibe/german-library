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


// Words
$router->get('/', 'WordController@all');
$router->get('/words', 'WordController@all');
$router->get('/add_new', 'WordController@add_new');
$router->get('/words/{id:[0-9]+}', 'WordController@by_id');
$router->get('/words/{text}', 'WordController@by_text');

// Words Api
$router->get('/api/words', 'WordController@api__all');
$router->post('/api/words', 'WordController@api__create_word');
$router->get('/api/words/{id:[0-9]+}', 'WordController@api__by_id');
$router->get('/api/words/{text}', 'WordController@api__by_text');
