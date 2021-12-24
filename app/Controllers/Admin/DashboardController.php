<?php

namespace App\Controllers\Admin;

use App\Classes\Session;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Redirect;
use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Capsule\Manager as Capsule;

class DashboardController extends BaseController {

  function __construct() {
    if(!Role::middleware('admin')) {
      Redirect::to('/mvc/login');
    }
  }

  function show() {

    $orders = Order::all()->count();
    $products = Product::all()->count();
    $users = User::all()->count();
    $payments = Payment::all()->sum('amount') / 100;

    return view("admin/dashboard", compact('orders', 'products', 'payments', 'users'));
  }

  function getChartData() {


    $revenue = Capsule::table('payments')->select(
      Capsule::raw('sum(amount) / 100 as `amount`'),
      Capsule::raw("CONCAT(MONTH(created_at), '-', YEAR(created_at)) new_date, YEAR(created_at) year, Month(created_at) month")
    )->groupby('new_date', 'year', 'month')->get();

    $orders = Capsule::table('orders')->select(
      Capsule::raw('count(id) as `count`'),
      Capsule::raw("CONCAT(MONTH(created_at), '-', YEAR(created_at)) new_date, YEAR(created_at) year, Month(created_at) month")
    )->groupby('new_date', 'year', 'month')->get();

    echo json_encode([
      'revenues'  => $revenue,
      'orders'    => $orders
    ]);

  }
}
