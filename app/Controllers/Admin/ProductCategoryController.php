<?php
namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductCategoryController {
  function show() {
    $categories = Category::all();
    return view("admin/products/categories", compact("categories"));
  }
  
  function store() {
    if (Request::has("post")) {
      $request = Request::get("post");
//      $validator = new ValidateRequest();
//      $data = $validator::unique("name", "JavaScript", "categories");
      
      $data = ValidateRequest::mixed("name", $request->name, true);
      
      if ($data) {
        echo "Good!";
        exit;
      } else {
        echo $data;
        echo "Invalid email address"; 
        exit;
      }
      
      if (CSRFToken::verifyCSRFToken($request->token)) {
        //process form data
        Category::create([
          "name" => $request->name,
          "slug" => slug($request->name),
        ]);
        $categories = Category::all();
        $message = "Category created";
        return view("admin/products/categories", compact("categories", "message"));
      }
      throw new \Exception("Token mismatch");
    }
    
    return null;
  }
}
