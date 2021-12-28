<?php

$router->map("POST", "/mvc/cart", "App\Controllers\CartController@addItem", "add_cart_item");
$router->map("GET", "/mvc/cart", "App\Controllers\CartController@show", "view_cart");
$router->map("GET", "/mvc/cart/items", "App\Controllers\CartController@getCartItems", "get_cart_items");
$router->map("POST", "/mvc/cart/update-qty", "App\Controllers\CartController@updateQuantity", "update_cart_qty");
$router->map("POST", "/mvc/cart/remove-item", "App\Controllers\CartController@removeItem", "remove_cart_item");
$router->map("POST", "/mvc/cart/empty", "App\Controllers\CartController@emptyCart", "empty_cart");

//Checkout
$router->map("POST", "/mvc/cart/create-checkout-session", "App\Controllers\CartController@createCheckoutSession", "create_checkout_session");

//Stripe response
$router->map("GET", "/mvc/cart/stripe-success", "App\Controllers\CartController@stripeSuccess", "stripe_success");
$router->map("GET", "/mvc/cart/stripe-cancel", "App\Controllers\CartController@stripeCancel", "stripe_cancel");

//Paypal
$router->map("POST", "/mvc/cart/paypal-complete-payment", "App\Controllers\CartController@paypalCompletePayment", "paypal_complete_payment");
$router->map("GET", "/mvc/cart/paypal-success", "App\Controllers\CartController@paypalSuccess", "paypal_success");
$router->map("GET", "/mvc/cart/paypal-cancel", "App\Controllers\CartController@paypalCancel", "paypal_cancel");
