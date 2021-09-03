<?php
namespace App\Controllers;

use App\Classes\Mail;
  
class IndexController extends BaseController {
	function show() {
      return view("home");
    }
}
