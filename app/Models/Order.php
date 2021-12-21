<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Payment;
use App\Models\User;

class Order extends Model {

  use SoftDeletes;

  public $timestamps = true;
  protected $fillable = ['user_id', 'order_no', 'product_id', 'quantity', 'unit_price', 'status', 'total'];
  protected $dates = ["deleted_at"];

  function transform($data) {
    $orders = [];
    foreach($data as $item) {
      $added = new Carbon($item->created_at);
      array_push($orders, [
        "id" => $item->id,
        "user_id" => $item->user_id,
        "order_no" => $item->order_no,
        "product_id" => $item->product_id,
        "product_name" => Product::where('id', $item->product_id)->first()->name,
        "quantity" => $item->quantity,
        "unit_price" => $item->unit_price,
        "status" => $item->status,
        "total" => $item->total,
        "added" => $added->toFormattedDateString(),
        "payment_status" => Payment::where('order_no', $item->order_no)->first()->status,
        "user_name" => User::where('id', $item->user_id)->first()->fullname
      ]);
    }
    return $orders;
  }

}
