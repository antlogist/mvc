<?php
namespace App\Controllers;

use App\Models\Product;
use App\Classes\Request;
use App\Classes\CSRFToken;

class IndexController extends BaseController {
	function show() {
      $token = CSRFToken::_token();
      return view("home", compact("token"));
    }

  function featuredProducts() {
    $products = Product::where("featured", 1)->inRandomOrder()->limit(4)->get();
    echo json_encode(["featured" => $products]);
  }

  function getProducts() {
    $products = Product::where("featured", 0)->skip(0)->take(8)->get();
    echo json_encode(["products" => $products, "count" => count($products)]);
  }

  function loadMoreProducts() {
    $request = Request::get("post");
    if(CSRFToken::verifyCSRFToken($request->token, false)) {
      $count = $request->count;
      $item_per_page = $count + $request->next;
      $products = Product::where("featured", 0)->skip(0)->take($item_per_page)->get();
      echo json_encode(["products" => $products, "count" => count($products)]);
    }
  }
}
