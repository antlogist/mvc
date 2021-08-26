<?php

//Admin routs
$router->map("GET", "/mvc/admin", "App\Controllers\Admin\DashboardController@show", "admin_dashboard");
$router->map("POST", "/mvc/admin", "App\Controllers\Admin\DashboardController@get", "admin_form");

//Product management
$router->map("GET", "/mvc/admin/product/categories", 
             "App\Controllers\Admin\ProductCategoryController@show", "product_category");
$router->map("POST", "/mvc/admin/product/categories", 
             "App\Controllers\Admin\ProductCategoryController@store", "create_product_category");

$router->map("POST", "/mvc/admin/product/categories/[i:id]/edit", 
             "App\Controllers\Admin\ProductCategoryController@edit", "edit_product_category");
$router->map("POST", "/mvc/admin/product/categories/[i:id]/delete", 
             "App\Controllers\Admin\ProductCategoryController@delete", "delete_product_category");

//Subcategories
$router->map("POST", "/mvc/admin/product/subcategory/create", 
             "App\Controllers\Admin\SubCategoryController@store", "create_subcategory");

