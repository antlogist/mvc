<?php
namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductCategoryController {
  public $table_name = "categories";
  public $categories;
  public $links;
  
  function __construct() {
    //Count category
    $total = Category::all()->count();
    //Create new instance
    $object = new Category;
    //Assign variables to the result of paginate function from helper
    list($this->categories, $this->links) = paginate(3, $total, $this->table_name, $object);
  }
  
  function show() {
    //Return view and create array of vars and data
    return view("admin/products/categories", [
      "categories" => $this->categories,
      "links" => $this->links,
    ]);
  }

  function store() {
    if (Request::has("post")) {
      $request = Request::get("post");
      //Token validation
      if (CSRFToken::verifyCSRFToken($request->token)) {
        //Validation rules
        $rules = [
          "name" => ["required" => true, "maxLength" => 5, "string" => true, "unique" => "categories"]
        ];
        //Cat name validation process
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
