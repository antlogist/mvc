<?php

$router = new AltoRouter();

$router->map("GET", "/mvc/", "App\Controllers\IndexController@show", "home");
$router->map("GET", "/mvc/featured", "App\Controllers\IndexController@featuredProducts", "feature_product");

//Admin routs
require_once __DIR__ . "/admin_routes.php";
