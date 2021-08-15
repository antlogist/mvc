<?php

namespace App\Controllers\Admin;

use App\Classes\Session;
use App\Classes\Request;
use App\Controllers\BaseController;

class DashboardController extends BaseController {
	function show() {
      Session::add("admin", "You are welcome!");
      
      if (Session::has("admin")) {
        $msg = Session::get("admin");
      } else {
        $msg = "Not defined";
      }
      
      return view("admin/dashboard", ["admin" => $msg]);
	}
  function get() {
    if (Request::has("file")) {
      $request = Request::get("file");
      var_dump($request); 
    }
    var_dump("posting doesn't exist");
  }
}
