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
  
  /**
   * remove session
   * @param $name
   */
  static function remove($name) {
    if(self::has($name)){
      unset($_SESSION[$name]);
    }
  }
  
  /**
   * Flash a message and unset the old session
   * @param $name 
   * @param $value
   * @return mixed | null
   */
  static function flash($name, $value = '')
  {
      if(self::has($name)){
          $old_value = self::get($name);
          self::remove($name);

          return $old_value;
      }else{
          self::add($name, $value);
      }

      return null;
  }
  
}
