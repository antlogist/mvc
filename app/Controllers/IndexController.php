<?php
namespace App\Controllers;

use App\Models\Product;
  
class IndexController extends BaseController {
	function show() {
      return view("home");
    }
  
  function featuredProducts() {
    $products = Product::where("featured", 1)->inRandomOrder()->limit(4)->get();
    echo json_encode(["featured" => $products]);
  }
}
