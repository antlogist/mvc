<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest {
  
  private static $error = [];
  private static $error_messages = [
    "string" => "The :attribute field cannot contain numbers",
    "required" => "The :attribute field field is required",
    "minLength" => "The :attribute field must be a minimum of :policy characters",
    "maxLength" => "The :attribute field must be a maximum of :policy characters",
    "mixed" => "The :attribute field can contain letters, numbers, dash and space only",
    "number" => "The :attribute field cannot contain letters e.g. 15.0, 15",
    "email" => "Email address is not valid",
    "unique" => "The :attribute is already taken, please try another one",
  ];
  
  /**
   * @param array $dataAndValues, column and data to validate
   * @param array $policies, the rules that validation must satisfy
   */
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
  
  /**
   * Perform validation for the data and set error messages
   * @param array $data
   */
  private static function doValidation(array $data) {
    $column = $data["column"];
    foreach ($data["policies"] as $rule => $policy) {
      $valid = call_user_func_array([self::class, $rule], [$rule, $data["value"], $policy]);
      if (!$valid) {
        self::setError(
          str_replace([":attribute", ":policy", "_"], 
                      [$column, $policy, " "], 
                      self::$error_messages[$rule]), $column;
        );
      }
    }
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
  
  /**
   * Set specific error
   * @param $error
   * @param [$key = null]
   */
  private static function setError($error, $key = null) {
    if($key) {
      self::$error[$key][] = $error;
    } else {
      self::$error = $error;
    }
  }
}
