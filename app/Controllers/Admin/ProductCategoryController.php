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
          "name" => ["required" => true, "maxLength" => 25, "string" => true, "unique" => "categories"]
        ];
        //Cat name validation process
        $validate = new ValidateRequest;
        $validate->abide($_POST, $rules);
        //If has errors
        if ($validate->hasError()) {
          $errors = $validate->getErrorMessages();
          return view("admin/products/categories", [
            "categories" => $this->categories,
            "links" => $this->links,
            "errors" => $errors
          ]);
        }
        //Process form data
        Category::create([
          "name" => $request->name,
          "slug" => slug($request->name),
        ]);
        //Get all categories
        $categories = Category::all();
        $message = "Category created";
        //Count category
        $total = Category::all()->count();
        //Assign variables to the result of paginate function from helper
        list($this->categories, $this->links) = paginate(3, $total, $this->table_name, new Category);
        //Return view from helper
        return view("admin/products/categories", [
          "categories" => $this->categories,
          "links" => $this->links,
          "success" => $message
        ]);
      }
      throw new \Exception("Token mismatch");
    }
    return null;
  }

  function edit($id) {
    if (Request::has("post")) {
      $request = Request::get("post");
      //Token validation
      if (CSRFToken::verifyCSRFToken($request->token)) {
        //Validation rules
        $rules = [
          "name" => ["required" => true, "maxLength" => 25, "string" => true, "unique" => "categories"]
        ];
        //Cat name validation process
        $validate = new ValidateRequest;
        $validate->abide($_POST, $rules);
        //If has errors
        if ($validate->hasError()) {
          $errors = $validate->getErrorMessages();
          header("HTTP/1.1 422 Unprocessible Entity", true, 422);
          echo json_encode($errors);
          exit;
        }
        //Process form data
        Category::where("id", $id)->update([
          "name" => $request->name,
        ]);
        echo json_encode([
          "success" => "Record updated successfully"
        ]);
        exit;
      }
      throw new \Exception("Token mismatch");
    }
    return null;
  }
}
