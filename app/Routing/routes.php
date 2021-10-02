<?php

$router = new AltoRouter();

$router->map("GET", "/mvc/", "App\Controllers\IndexController@show", "home");
$router->map("GET", "/mvc/featured", "App\Controllers\IndexController@featuredProducts", "feature_product");
$router->map("GET", "/mvc/get-products", "App\Controllers\IndexController@getProducts", "get_product");
$router->map("POST", "/mvc/load-more", "App\Controllers\IndexController@loadMoreProducts", "load_more_product");

$router->map("GET", "/mvc/product/[i:id]", "App\Controllers\ProductController@show", "product");
$router->map("GET", "/mvc/product-details/[i:id]", "App\Controllers\ProductController@get", "product_details");

$router->map("POST", "/mvc/cart", "App\Controllers\CartController@addItem", "add_cart_item");
$router->map("GET", "/mvc/cart", "App\Controllers\CartController@show", "view_cart");
$router->map("GET", "/mvc/cart/items", "App\Controllers\CartController@getCartItems", "get_cart_items");

//Admin routs
require_once __DIR__ . "/admin_routes.php";
