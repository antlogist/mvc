<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\SubCategory;
use App\Classes\Session;
use App\Classes\Role;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductCategoryController extends BaseController {
  public $table_name = "categories";
  public $categories;
  public $subcategories;
  public $links;
  public $subcategories_links;

  function __construct() {

    if(!Role::middleware('admin')) {
      Redirect::to('/mvc/login');
    }

    //Count category
    $total = Category::all()->count();
    //Count subcategories
    $subTotal = SubCategory::all()->count();
    //Create new instance
    $object = new Category;
    //Assign variables to the result of paginate function from helper
    list($this->categories, $this->links) = paginate(3, $total, $this->table_name, $object);
    list($this->subcategories, $this->subcategories_links) = paginate(3, $subTotal, "sub_categories", new SubCategory);
  }

  function show() {
    //Return view and create array of vars and data
    return view("admin/products/categories", [
      "categories" => $this->categories,
      "links" => $this->links,
      "subcategories" => $this->subcategories,
      "subcategories_links" => $this->subcategories_links
    ]);
  }

  function store() {
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
          return view("admin/products/categories", [
            "categories" => $this->categories,
            "links" => $this->links,
            "errors" => $errors,
            "subcategories" => $this->categories,
            "subcategories_links" => $this->subcategories_links
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
        //Count subcategories
        $subTotal = SubCategory::all()->count();
        //Assign variables to the result of paginate function from helper
        list($this->categories, $this->links) = paginate(3, $total, $this->table_name, new Category);
        list($this->subcategories, $this->subcategories_links) = paginate(3, $subTotal, "sub_categories", new SubCategory);
        //Return view from helper
        return view("admin/products/categories", [
          "categories" => $this->categories,
          "links" => $this->links,
          "success" => $message,
          "subcategories" => $this->categories,
          "subcategories_links" => $this->subcategories_links
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

        $subcategories = SubCategory::where("category_id", $id)->get();
        if (count($subcategories)) {
          foreach ($subcategories as $subcategory) {
            $subcategory->delete();
          }
        }

        Session::add("success", "Category Deleted");
        Redirect::to($_SERVER["APP_URL"] . "/admin/product/categories");
        exit;
      }
        throw new \Exception("Token mismatch");
      }
    return null;
  }
}
