<?php

namespace App\Controllers\Admin;

use App\Classes\Session;
use App\Classes\Request;
use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;

class DashboardController extends BaseController {

  function show() {

    $orders = Order::all()->count();
    $products = Product::all()->count();
    $users = User::all()->count();
    $payments = Payment::all()->sum('amount');

    return view("admin/dashboard", compact('orders', 'products', 'payments', 'users'));
  }

  function get() {

  }
}
