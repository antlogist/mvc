<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\SubCategory;

class Payment extends Model {

  use SoftDeletes;

  public $timestamps = true;
  protected $fillable = ['user_id', 'order_no', 'amount', 'status'];
  protected $dates = ["deleted_at"];

  function transform($data) {
    $payments = [];
    foreach($data as $item) {
      $added = new Carbon($item->created_at);
      array_push($payments, [
        "id" => $item->id,
        "user_id" => $item->user_id,
        "order_no" => $item->order_no,
        "amount" => $item->amount,
        "status" => $item->status,
        "user_name" => User::where('id', $item->user_id)->first()->fullname,
        "added" => $added->toFormattedDateString()
      ]);
    }
    return $payments;
  }

}
