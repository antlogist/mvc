<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\SubCategory;
use App\Classes\Session;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class SubCategoryController extends BaseController {

  function store() {
    if (Request::has("post")) {
      $request = Request::get("post");
      $extra_errors = [];
      //Token validation
      if (CSRFToken::verifyCSRFToken($request->token, false)) {
        //Validation rules
        $rules = [
          "name" => ["required" => true, "maxLength" => 25, "string" => true],
          "category_id" => ["required" => true]
        ];
        //Cat name validation process
        $validate = new ValidateRequest;
        $validate->abide($_POST, $rules);
        
        $duplicate_subcategory = SubCategory::where("name", $request->name)
          ->where("category_id", $request->$category_id)->exists();
        if ($duplicate_subcategory) {
          $extra_errors["name"] = array("Subcategory already exists");
        }
        
        $category = Category:where("category_id", $request->$category_id)->exists();
        if (!$category) {
          $extra_errors["name"] = array("Invalid product category");
        }
        
        //If has errors
        if ($validate->hasError() || $duplicate_subcategory || !$category) {
          $errors = $validate->getErrorMessages();
          count($extra_errors) ? $response = array_merge($errors, $extra_errors) : $response = $errors;
          
          header("HTTP/1.1 422 Unprocessible Entity", true, 422);
          echo json_encode($response);
          exit;
        }
        //Process form data
        SubCategory::create([
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
      if (CSRFToken::verifyCSRFToken($request->token, false)) {
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
  
  function delete($id) {
    if (Request::has("post")) {
      $request = Request::get("post");
      //Token validation
      if (CSRFToken::verifyCSRFToken($request->token, false)) {
        //Process form data
        Category::destroy($id);
        Session::add("success", "Category Deleted");
        Redirect::to("admin/products/categories");
        Redirect::to($_SERVER["APP_URL"] . "/admin/product/categories");
        exit;
      } 
        throw new \Exception("Token mismatch");
      }
    return null;
  }
}
