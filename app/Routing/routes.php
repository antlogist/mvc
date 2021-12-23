<?php

$router = new AltoRouter();

$router->map("GET", "/mvc/", "App\Controllers\IndexController@show", "home");
$router->map("GET", "/mvc/featured", "App\Controllers\IndexController@featuredProducts", "feature_product");
$router->map("GET", "/mvc/get-products", "App\Controllers\IndexController@getProducts", "get_product");
$router->map("POST", "/mvc/load-more", "App\Controllers\IndexController@loadMoreProducts", "load_more_product");

$router->map("GET", "/mvc/product/[i:id]", "App\Controllers\ProductController@show", "product");
$router->map("GET", "/mvc/products", "App\Controllers\ProductController@showAll", "products");
$router->map("GET", "/mvc/product-details/[i:id]", "App\Controllers\ProductController@get", "product_details");
$router->map("POST", "/mvc/product/load-more", "App\Controllers\ProductController@loadMoreProducts", "load_more_products");

//Subcategory
$router->map("GET", "/mvc/product-subcategory/[*:slug]", "App\Controllers\ProductController@showSubCategory", "product_subcategory");

//Cart routs
require_once __DIR__ . "/cart.php";

//Auth routs
require_once __DIR__ . "/auth.php";

//Admin routs
require_once __DIR__ . "/admin_routes.php";
