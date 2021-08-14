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
  
  /**
   * check session
   * @param $name
   * @return bool
   * @throws \Exception
   */
  static function has($name) {
    if($name != "" && !empty($name)) {
      return (isset($_SESSION[$name])) ? true : false;
    }
       
    throw new \Exception("Name required");
  }
  
  //remove session
  
}
