<?php

$router = new AltoRouter();

$router->map("GET", "/mvc/", "App\Controllers\IndexController@show", "home");

//Admin routs
$router->map("GET", "/mvc/admin", "App\Controllers\Admin\DashboardController@show", "admin_dashboard");
$router->map("POST", "/mvc/admin", "App\Controllers\Admin\DashboardController@get", "admin_form");

//Product management
$router->map("GET", "/mvc/admin/product/categories", 
             "App\Controllers\Admin\ProductCategoryController@show", "product_category");
$router->map("POST", "/mvc/admin/product/categories", 
             "App\Controllers\Admin\ProductCategoryController@store", "create_product_category");
