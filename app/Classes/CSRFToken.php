<?php

namespace App\Classes;

use App\Classes\Session;

class CSRFToken {
  static function _token() {
      if (!Session::has("token")) {
        $randomToken = base64_decode(openssl_random_pseudo_bytes(32));
        Session::add("token", $randomToken);
      }
    
    return Session::get("token");
  }
  
  static function verifyCSRFToken($requestToken) {
    
  }
}
