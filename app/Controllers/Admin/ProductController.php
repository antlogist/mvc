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

class ProductController extends BaseController {
  public $table_name = "categories";
  public $categories;
  public $subcategories;
  public $links;
  public $subcategories_links;
  
  function __construct() {
    //Get all categories
    $this->categories = Category::all();
  }
  
  function showCreateProductForm() {
    //Return view and create array of vars and data
    return view("admin/products/create", [
      "categories" => $this->categories,
    ]);
  }
}
