<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest {
  
  function abide(array $dataAndValues, array $policies) {
    foreach ($dateAndValues as $column => $value) {
      if (in_array($column, array_keys($policies))) {
        //do validation
        self::doValidation([
          "column" => $column,
          "value"  => $value,
          "policies" => $policies[$column]
        ])
      }
    }
  }
  
  private static function doValidate() {
    
  }

  /**
   * [[Description]]
   * @param $column, field name or column
   * @param $value, value passed into the form
   * @param $policy, the rule we set
   * @return boolean, true | false
   */
  protected static function unique($column, $value, $policy) {
    if ($value !== null && !empty(trim($value))) {
      //return false if value already exists
      return !Capsule::table($policy)->where($column, "=", $value)->exists();
    }
    return true;
  }
  
  protected static function required($column, $value, $policy) {
    return $value !== null && !empty(trim($value));
  }
  
  protected static function minLength($column, $value, $policy) {
     if ($value !== null && !empty(trim($value))) {
       return strlen($value) >= $policy;
     }
    return true;
  }
  
  protected static function maxLength($column, $value, $policy) {
     if ($value !== null && !empty(trim($value))) {
       return strlen($value) <= $policy;
     }
    return true;
  }
  
  protected static function email($column, $value, $policy) {
     if ($value !== null && !empty(trim($value))) {
       return filter_var($value, FILTER_VALIDATE_EMAIL);
     }
    return true;
  }
  
  protected static function mixed($column, $value, $policy) {
     if (!preg_match("/^[a-zA-Z0-9 .,_~\-!@#\&%\^\'\*\(\)]*$/", $value)) {
       return false;
     }
    return true;
  }
  
  protected static function string($column, $value, $policy) {
     if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
       return false;
     }
    return true;
  }
  
  protected static function numbers($column, $value, $policy) {
     if (!preg_match("/^[0-9. ]*$/", $value)) {
       return false;
     }
    return true;
  }
  
}
