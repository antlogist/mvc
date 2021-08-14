<?php

namespace App\Classes;

class Session {
  /**
   * Create a session
   * @param $name
   * @param $value
   * @return mixed
   * @throws \Exception
   */
  static function add($name, $value) {
    if($name != "" && !empty($name) && $value != "" && !empty($value)) {
      return $_SESSION[$name] = $value;
    }
    
    throw new \Exception("Name and value required");
  }
  
  /**
   * get value from session
   * @param $name
   * @return mixed
   */
  static function get($name) {
    return $_SESSION[$name];
  }
  
  //check is session exists
  
  
  //remove session
  
}
