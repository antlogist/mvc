<?php
namespace App\Controllers;

use App\Classes\Cart;
use App\Classes\Request;
use App\Classes\CSRFToken;
  
class CartController extends BaseController {
  
  function addItem() {
    if (Request::has("post")) {
      $request = Request::get("post");
      if (CSRFToken::verifyCSRFToken($request->token, false)) {
        if (!$request->product_id) {
          throw new \Exception("Malicious Activity");
        }
        Cart::add($request);
        echo json_encode(["success" => "Product added to cart successfully"]);
        exit;
      }
    }
  }
}
