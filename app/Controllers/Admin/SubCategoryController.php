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

  function __construct() {
    if(!Role::middleware('admin')) {
      Redirect::to('/mvc/login');
    }
  }

  function store() {
    //If POST req available
    if (Request::has("post")) {
      //Get POST req sending to the server
      $request = Request::get("post");
      $extra_errors = [];
      //Token validation
      if (CSRFToken::verifyCSRFToken($request->token, false)) {

        //Validation rules
        $rules = [
          "name" => ["required" => true, "maxLength" => 25, "mixed" => true],
          "category_id" => ["required" => true]
        ];
        //Cat name validation process
        $validate = new ValidateRequest;
        $validate->abide($_POST, $rules);

        //Subcats duplicateion validation
        $duplicate_subcategory = SubCategory::where("name", $request->name)
                    ->where("category_id", $request->category_id)->exists();

        if ($duplicate_subcategory) {
          $extra_errors["name"] = array("Subcategory already exists");
        }

        //If cat does not exist
        $category = Category::where("id", $request->category_id)->exists();
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
          "category_id" => $request->category_id,
          "slug" => slug($request->name),
        ]);
        echo json_encode(["success" => "Subcategory created successfully"]);
        exit;
      }
      throw new \Exception("Token mismatch");
    }
    return null;
  }

  function edit($id) {
    //If POST req available
    if (Request::has("post")) {
      //Get POST req sending to the server
      $request = Request::get("post");

      $extra_errors = [];

      //Token validation
      if (CSRFToken::verifyCSRFToken($request->token, false)) {

        //Cat name validation process
        $validate = new ValidateRequest;


        //Subcats duplicateion validation
        $duplicate_subcategory = SubCategory::where("name", $request->name)
                    ->where("category_id", $request->category_id)->exists();

        if ($duplicate_subcategory) {
          $extra_errors["name"] = array("You have not make any changes");
        }

        //If cat does not exist
        $category = Category::where("id", $request->category_id)->exists();
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
        SubCategory::where("id", $id)->update([
          "name" => $request->name,
          "category_id" => $request->category_id,
        ]);
        echo json_encode([
          "success" => "Subcategory updated successfully"
        ]);
        exit;
      }
      throw new \Exception("Token mismatch");
    }
    return null;
  }

  function delete($id) {
    //If POST req available
    if (Request::has("post")) {
      //Get POST req sending to the server
      $request = Request::get("post");
      //Token validation
      if (CSRFToken::verifyCSRFToken($request->token, false)) {
        //Process form data
        SubCategory::destroy($id);
        //Add success key to the SESSION
        Session::add("success", "Sub category Deleted");
        //Redirect back to the categories page and update the page
        Redirect::to($_SERVER["APP_URL"] . "/admin/product/categories");
        exit;
      }
        throw new \Exception("Token mismatch");
      }
    return null;
  }

}
