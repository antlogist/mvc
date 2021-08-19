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
  
  
  
}
