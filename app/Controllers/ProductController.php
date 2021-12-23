<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use App\Classes\Request;
use App\Classes\CSRFToken;

class ProductController extends BaseController {
	function show($id) {
      $token = CSRFToken::_token();
      $product = Product::where("id", $id)->first();
      return view("product", compact("token", "product"));
    }

    function showAll() {
      $token = CSRFToken::_token();
      return view("products", compact("token"));
    }

    function showSubCategory($slug) {
      $token = CSRFToken::_token();
      $id = SubCategory::where("slug", $slug)->first()->id;
      $products = Product::where("sub_category_id", $id)->get();
      return view("subcategory", compact("token", "products"));
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

    function get($id) {
      $product = Product::where("id", $id)->with(["category", "subCategory"])->first();
      if($product) {
        $similar_products = Product::where("category_id", $product->category_id)
          ->where("id", "!=", $id)
          ->inRandomOrder()
          ->limit(8)->get();
        echo json_encode([
          "product" => $product,
          "category" => $product->category,
          "subCategory" => $product->subCategory,
          "similarProducts" => $similar_products
        ]);
          exit;
      }
      header("HTTP/1.1 422 Unprocessable Entity", true, 422);
      echo "Product not found";
      exit;
    }
}
