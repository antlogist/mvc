<?php
namespace App\Controllers\Admin;

use App\Models\Order;

class OrderController {

  public $orders;
  public $links;
  public $table_name = "orders";

  function __construct() {
    $total = Order::all()->count();

    //Assign variables to the result of paginate function from helper
    list($this->orders, $this->links) = paginate(3, $total, $this->table_name, new Order);

  }


  function show() {
    $orders = $this->orders;
    $links = $this->links;
    return view('admin/orders/orders', compact('orders', 'links'));
  }
}
