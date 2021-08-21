<?php
namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductCategoryController {
  public $table_name = "categories";
  function show() {
    $total = Category::all()->count();
    $object = new Category;
    
    //Assign variables as if they were an array
    list($categories, $links) = paginate(3, $total, $this->table_name, $object);
    
    return view("admin/products/categories", compact("categories", "links"));
  }
  
  function store() {
    if (Request::has("post")) {
      $request = Request::get("post");
      
      if (CSRFToken::verifyCSRFToken($request->token)) {
        //Validation rules
        $rules = [
          "name" => ["required" => true, "maxLength" => 5, "string" => true, "unique" => "categories"]
        ];
        //Validation process
        $validate = new ValidateRequest;
        $validate->abide($_POST, $rules);
        //If has errors
        if ($validate->hasError()) {
          var_dump($validate->getErrorMessages());
          exit();
        }
        //Process form data
        Category::create([
          "name" => $request->name,
          "slug" => slug($request->name),
        ]);
        //Get all categories
        $categories = Category::all();
        $message = "Category created";
        //Return view from helper
        return view("admin/products/categories", compact("categories", "message"));
      }
      throw new \Exception("Token mismatch");
    }
    
    return null;
  }
}
