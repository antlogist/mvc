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
$router->map("POST", "/mvc/admin/product/subcategory/[i:id]/edit", 
             "App\Controllers\Admin\SubCategoryController@edit", "edit_product_subcategory");
$router->map("POST", "/mvc/admin/product/subcategory/[i:id]/delete", 
             "App\Controllers\Admin\SubCategoryController@delete", "delete_product_subcategory");

//Products
$router->map("GET", "/mvc/admin/product/category/[i:id]/selected", 
             "App\Controllers\Admin\ProductController@getSubcategories", "selected_category");
$router->map("GET", "/mvc/admin/product/create", 
             "App\Controllers\Admin\ProductController@showCreateProductForm", "create_product_form");
$router->map("POST", "/mvc/admin/product/create", 
             "App\Controllers\Admin\ProductController@store", "create_product");

$router->map("GET", "/mvc/admin/products", 
             "App\Controllers\Admin\ProductController@show", "show_products");
