<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest {

  protected static function unique($column, $value, $policy) {
    if ($value !== null && !empty(trim($value))) {
      //return false if value already exists
      return !Capsule::table($policy)->where($column, "=", $value)->exists();
    }
    
    return true;
  }
  
  static function required($column, $value, $policy) {
    return $value !== null && !empty(trim($value));
  }
  
  static function minLength($column, $value, $policy) {
     if ($value !== null && !empty(trim($value))) {
       return strlen($value) >= $policy;
     }
    
    return true;
  }
  
  static function maxLength($column, $value, $policy) {
     if ($value !== null && !empty(trim($value))) {
       return strlen($value) <= $policy;
     }
    
    return true;
  }
  
}
