<?php

$router->map("POST", "/mvc/cart", "App\Controllers\CartController@addItem", "add_cart_item");
$router->map("GET", "/mvc/cart", "App\Controllers\CartController@show", "view_cart");
$router->map("GET", "/mvc/cart/items", "App\Controllers\CartController@getCartItems", "get_cart_items");
$router->map("POST", "/mvc/cart/update-qty", "App\Controllers\CartController@updateQuantity", "update_cart_qty");
$router->map("POST", "/mvc/cart/remove-item", "App\Controllers\CartController@removeItem", "remove_car_item");

