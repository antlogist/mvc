<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Classes\Session;
use App\Classes\UploadFile;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductController extends BaseController {
  public $table_name = "products";
  public $products;
  public $categories;
  public $subcategories;
  public $links;
  public $subcategories_links;
  
  function __construct() {
    //Get all categories
    $this->categories = Category::all();
    
    $total = Product::all()->count();
      
    //Assign variables to the result of paginate function from helper
    list($this->products, $this->links) = paginate(3, $total, $this->table_name, new Product);
  }
  
  function show() {
    $products = $this->products;
    return view("admin/products/inventory", compact("products"));
  }
  
  function showCreateProductForm() {
    //Return view and create array of vars and data
    $categories = $this->categories;
    return view("admin/products/create", 
                compact("categories")); //Array containing variables and their values
  }
  
  function getSubcategories($id) {
    $subcategories = SubCategory::where("category_id", $id)->get();
    echo json_encode($subcategories);
    exit;
  }
  
  function store() {
    if (Request::has("post")) {
      $request = Request::get("post");
      //Token validation
      if (CSRFToken::verifyCSRFToken($request->token, false)) {
        //Validation rules
        $rules = [
          "name" => ["required" => true, "minLength" => 3, "maxLength" => 70, "string" => true, "unique" => $this->table_name],
          "price" => ["required" => true, "minLength" => 2, "numbers" => true],
          "quantity" => ["required" => true],
          "category" => ["required" => true],
          "sub_category" => ["required" => true],
          "description" => ["required" => true, "mixed" => true, "minLength" => 4, "maxLength" => 500],
        ];
        //Product name validation process
        $validate = new ValidateRequest;
        $validate->abide($_POST, $rules);
        
        //File validation
        $file = Request::get("file");
        isset($file->productImage->name) ? $filename = $file->productImage->name : $filename = "";
        
        $file_error = [];
        //Check if empty
        if (empty($filename)) {
          $file_error["productImage"] = ["The product image is required"];
        } else if (!UploadFile::isImage($filename)){
          $file_error["productImage"] = ["The file is not an image, please try again!"];
        }
        
        //If has errors
        if ($validate->hasError() || count($file_error)) {
          $response = $validate->getErrorMessages();
          count($file_error) ? $errors = array_merge($response, $file_error) : $errors = $response;
          return view("admin/products/create", [
            "categories" => $this->categories,
            "errors" => $errors
          ]);
        }
        
        //Directory separator
        $ds = DIRECTORY_SEPARATOR;
        $temp_file = $file->productImage->tmp_name;
        $image_path = UploadFile::move($temp_file, "images{$ds}uploads{$ds}products", $filename)->path();
        
        //Process form data
        Product::create([
          "name" => $request->name,
          "description" => $request->description,
          "price" => $request->price,
          "quantity" => $request->quantity,
          "category_id" => $request->category,
          "sub_category_id" => $request->subcategory,
          "image_path" => $image_path,
        ]);
        
        Request::refresh();

        //Return view from helper
        return view("admin/products/create", [
          "categories" => $this->categories,
          "success" => "Record created"
        ]);
      }
      throw new \Exception("Token mismatch");
    }
    return null;
  }
}
