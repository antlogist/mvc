<?php

$router = new AltoRouter();

$router->map("GET", "/mvc/", "App\Controllers\IndexController@show", "home");
$router->map("GET", "/mvc/featured", "App\Controllers\IndexController@featuredProducts", "feature_product");
$router->map("GET", "/mvc/get-products", "App\Controllers\IndexController@getProducts", "get_product");
$router->map("POST", "/mvc/load-more", "App\Controllers\IndexController@loadMoreProducts", "load_more_product");

//Admin routs
require_once __DIR__ . "/admin_routes.php";
