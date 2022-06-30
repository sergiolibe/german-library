<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->post('/auth/signup', 'AuthController@sign_up'); // Register
$router->post('/auth/signin', 'AuthController@sign_in'); // Login
