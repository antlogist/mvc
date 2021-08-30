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
  
  function showCreateProductForm() {
    //Return view and create array of vars and data
    return view("admin/products/create", [
      "categories" => $this->categories,
    ]);
  }
}
