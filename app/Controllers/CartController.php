<?php
namespace App\Controllers;

use App\Classes\Session;
use App\Classes\Cart;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Models\Product;
// use Stripe\Stripe;

class CartController extends BaseController {
  function show() {
    return view("cart");
  }

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

  function getCartItems($stripe = false) {
    try {
      $result = array();
      $cartTotal = 0;
      if(!Session::has("user_cart") || count(Session::get("user_cart")) < 1) {
        echo json_encode([
          "fail" => "No items in the cart"
        ]);
        exit;
      }
      $index = 0;
      foreach($_SESSION["user_cart"] as $cart_items) {
        $productId = $cart_items["product_id"];
        $quantity = $cart_items["quantity"];
        $item = Product::where("id", $productId)->first();

        if(!$item) {
          continue;
        }

        $totalPrice = $item->price * $quantity;
        $cartTotal = $totalPrice + $cartTotal;
        $totalPrice = number_format($totalPrice, 2);

        array_push($result, [
          "id" => $item->id,
          "name" => $item->name,
          "image" => $item->image_path,
          "description" => $item->description,
          "price" => $item->price,
          "total" => $totalPrice,
          "quantity" => $quantity,
          "stock" => $item->quantity,
          "index" => $index
        ]);
        $index++;
      }
      $cartTotal = number_format($cartTotal, 2);
      if ($stripe == false) {
        echo json_encode(["items" => $result, "cartTotal" => $cartTotal, "authenticated" => isAuthenticated(), "amountInCents" => convertMoneyToCents($cartTotal)]);
        exit;
      } else {
        return $result;
      }
    }catch(\Exception $ex) {
      // echo $ex->getMessage();
    }
  }

  function updateQuantity() {
    if (Request::has("post")) {
      $request = Request::get("post");
        if (!$request->product_id) {
          throw new \Exception("Malicious Activity");
        }

        $index = 0;
        $quantity = '';

        foreach($_SESSION["user_cart"] as $cart_items) {
          $index++;
          foreach($cart_items as $key => $value) {
            if ($key == "product_id" && $value == $request->product_id) {
              switch($request->operator) {
                case "+":
                  $quantity = $cart_items["quantity"] + 1;
                  break;
                case "-":
                  $quantity = $cart_items["quantity"] - 1;
                  if($quantity < 1){
                    $quantity = 1;
                  }
                  break;
              }

              array_splice($_SESSION["user_cart"], $index-1, 1,
                array([
                  "product_id" => $request->product_id,
                  "quantity" => $quantity
                ]));

            }
          }
        }

      }
  }

  function removeItem() {
    if (Request::has("post")) {
      $request = Request::get("post");
      if ($request->item_index === "") {
        throw new \Exception("Malicious Activity");
      }
      Cart::removeItem($request->item_index);
      echo json_encode(["success" => "Product removed from the cart"]);
      exit;
    }
  }

  function emptyCart() {
    if (Request::has("post")) {
      $request = Request::get("post");
      if($request->empty_cart == true) {
        Cart::clear();
        echo json_encode(["success" => "Products removed from the cart"]);
        exit;
      }
    }
  }

  function createCheckoutSession() {

    $items = $this->getCartItems(true);

    $lineItems = array();

    foreach($items as $item) {
      array_push($lineItems, [
        'name' => $item["name"],
        'amount' => convertMoneyToCents($item["price"]),
        'currency' => 'usd',
        'quantity' => $item['quantity']
      ]);
    }
    if (Request::has("post")) {
      $request = Request::get("post");
    }

    header('Content-Type: application/json');

    $checkout_session = \Stripe\Checkout\Session::create([
      'line_items' => $lineItems,
      'payment_method_types' => [
        'card',
      ],
      'mode' => 'payment',
      'success_url' => $_SERVER["APP_URL"] . '/success.html',
      'cancel_url' => $_SERVER["APP_URL"] . '/cancel.html',
    ]);

    echo $checkout_session->url;

    // header("HTTP/1.1 303 See Other");
    // header("Location: " . $checkout_session->url);

  }
}
