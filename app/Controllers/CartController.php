<?php
namespace App\Controllers;

use App\Classes\Session;
use App\Classes\Cart;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\Mail;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;

class CartController extends BaseController {

  function __construct() {
    if(!Role::middleware('user') || !Role::middleware('admin')) {
      Redirect::to('/mvc/login');
    }
  }

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
      Session::add("cartTotal", $cartTotal);

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

    if (!isAuthenticated) {
      echo json_encode(["error" => "Something went wrong"]);
      exit;
    }

    $result = array();

    $items = $this->getCartItems(true);

    $lineItems = array();

    $order_no = strtoupper(uniqid());

    foreach($items as $item) {
      array_push($lineItems, [
        'quantity' => $item['quantity'],
        'price_data' => [
          'currency' => 'usd',
          'product_data' => [
            'name' => $item['name'],
          ],
          'unit_amount' => convertMoneyToCents($item["price"]),
        ]

      ]);
    }

    $checkout_session = \Stripe\Checkout\Session::create([
      'line_items' => $lineItems,
      'payment_method_types' => [
        'card',
      ],
      'mode' => 'payment',
      'success_url' => $_SERVER["APP_URL"] . '/cart/stripe-success?stripe_session={CHECKOUT_SESSION_ID}',
      'cancel_url' => $_SERVER["APP_URL"] . '/cart/stripe-cancel?stripe_session={CHECKOUT_SESSION_ID}',
      'payment_intent_data' => [
        'metadata' => [
          'order_no' => $order_no,
          'user_id' => $_SESSION["SESSION_USER_ID"]
        ]
      ]
    ]);

    Session::add("stripe_session", $checkout_session->id);

    echo $checkout_session->url;
  }

  function stripeSuccess() {

    if (Request::has("get")) {
      $request = Request::get("get");
      if ($request->stripe_session == Session::get("stripe_session")) {

        $result["product"]  = array();
        $result["order_no"] = array();
        $result["total"]    = array();

        $order_id = Session::get("stripe_session");

        foreach($_SESSION["user_cart"] as $cart_items) {

          $productId = $cart_items["product_id"];
          $quantity = $cart_items["quantity"];
          $item = Product::where("id", $productId)->first();

          if(!$item) {
            continue;
          }

          $totalPrice = $item->price * $quantity;
          $totalPrice = number_format($totalPrice, 2);

          //store info
          Order::create([
            "user_id" => user()->id,
            "product_id" => $productId,
            "unit_price" => $item->price,
            "status" => "Pending",
            "quantity" => $quantity,
            "total" => $totalPrice,
            "order_no" => $order_id
          ]);

          $item->quantity = $item->quantity - $quantity;
          $item->save();

          array_push($result["product"], [
            "name" => $item->name,
            "price" => $item->price,
            "total" => $totalPrice,
            "quantity" => $quantity,
          ]);
        }

        Payment::create([
          'user_id' => user()->id,
          'order_no' => $order_id,
          'amount' => convertMoneyToCents(Session::get("cartTotal")),
          'status' => "paid",
        ]);

        $result["order_no"] = $order_id;
        $result["total"] = Session::get("cartTotal");

        $data = [
          "to" => user()->email,
          "subject" => "Order Confirmation",
          "view" => "purchase",
          "name" => user()->fullname,
          "body" => $result
        ];

        Cart::clear();

        (new Mail())->send($data);

        echo json_encode([
          "success" => "Thank you, we have received your payment and now processing your order."
        ]);
      }
    }

    return view("stripe-success");
  }

  function stripeCancel() {
    return view("stripe-cancel");
  }
}
