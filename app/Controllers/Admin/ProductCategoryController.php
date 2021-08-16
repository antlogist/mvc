<?php
namespace App\Controllers\Admin;

use App\Models\Category;

class ProductCategoryController {
  function show() {
    $categories = Category::all();
    echo "<pre>";
    var_dump($categories);
    echo "</pre>";
    exit;
  }
  
  function store() {
    
  }
}
