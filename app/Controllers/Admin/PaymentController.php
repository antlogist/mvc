<?php
namespace App\Controllers\Admin;

use App\Models\Payment;

class PaymentController {

  public $payments;
  public $links;
  public $table_name = "payments";

  function __construct() {
    $total = Payment::all()->count();

    //Assign variables to the result of paginate function from helper
    list($this->payments, $this->links) = paginate(4, $total, $this->table_name, new Payment);

  }


  function show() {
    $payments = $this->payments;
    $links = $this->links;
    return view('admin/payments/payments', compact('payments', 'links'));
  }
}
