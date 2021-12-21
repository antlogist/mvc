<?php
namespace App\Controllers\Admin;

use App\Models\Order;
use App\Classes\Role;
use App\Classes\Redirect;

class OrderController {

  public $orders;
  public $links;
  public $table_name = "orders";

  function __construct() {

    if(!Role::middleware('admin')) {
      Redirect::to('/mvc/login');
    }

    $total = Order::all()->count();

    //Assign variables to the result of paginate function from helper
    list($this->orders, $this->links) = paginate(4, $total, $this->table_name, new Order);

  }


  function show() {
    $orders = $this->orders;
    $links = $this->links;
    return view('admin/orders/orders', compact('orders', 'links'));
  }
}
