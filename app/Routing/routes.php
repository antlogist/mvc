<?php

$router = new AltoRouter();

$router->map("GET", "/mvc/", "App\Controllers\IndexController@show", "home");

//Admin routs
require_once __DIR__ . "/admin_routes.php";
