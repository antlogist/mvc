<?php

namespace App\Classes;

use App\Classes\Session;

class CSRFToken {
  /**
   * Generate token
   * @private
   * @return mixed
   */
  static function _token() {
    if (!Session::has("token")) {
      $randomToken = base64_encode(openssl_random_pseudo_bytes(32));
      Session::add("token", $randomToken);
    }
    
    return Session::get("token");
  }
  
  /**
   * Verify token
   * @param $requestToken
   * @return boolean
   */
  static function verifyCSRFToken($requestToken) {
    if (Session::has("token") && Session::get("token") === $requestToken) {
      return true;
    }
    return false;
  }
}
