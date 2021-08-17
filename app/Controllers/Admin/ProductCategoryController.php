<?php
namespace App\Controllers\Admin;

use App\Models\Category;

class ProductCategoryController {
  function show() {
    $categories = Category::all();
    return view("admin/products/categories", compact("categories"));
  }
  
  function store() {
    
  }
}
