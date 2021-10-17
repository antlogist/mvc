<?php

$router->map("GET", "/mvc/register", "App\Controllers\AuthController@showRegisterForm", "register");
$router->map("POST", "/mvc/register", "App\Controllers\AuthController@register", "register_me");

$router->map("GET", "/mvc/login", "App\Controllers\AuthController@showLoginForm", "login");
$router->map("POST", "/mvc/login", "App\Controllers\AuthController@login", "login_me_in");

$router->map('GET', '/mvc/logout', 'App\Controllers\AuthController@logout', 'logout');
