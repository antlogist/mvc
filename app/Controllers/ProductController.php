<?php
namespace App\Controllers;

use App\Models\Product;
use App\Classes\Request;
use App\Classes\CSRFToken;
  
class IndexController extends BaseController {
	function show($id) {
      $token = CSRFToken::_token();
      $products = Product::where("id", $id)->first();
      return view("product", compact("token", "product"));
    }
}
