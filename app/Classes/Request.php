<?php

namespace App\Classes;

class Request {
  /**
   * return all requests
   * @param [$is_array = false]
   * @return mixed
   */
  static function all($is_array = false) {
    /**
    * When $is_array = true, JSON objects will be returned as associative arrays; 
    * when false, JSON objects will be returned as objects
    */
    $result = [];
    
    if (count($_GET) > 0) $result["get"] = $_GET;
    if (count($_POST) > 0) $result["post"] = $_POST;
    $result["file"] = $_FILES;
    
    return json_decode(json_encode($result), $is_array);
    
  }
  /**
   * get specific request type
   * @param $key
   * @return mixed
   */
  static function get($key) {
    $object = new static;
    $data = $object->all();
    return $data->$key;
  }
  
  /**
   * check request availability
   * @param $key
   * @return bool
   */
  static function has($key) {
    return (array_key_exists($key, self::all(true))) ? true : false;
  }
  
  /**
   * get request data
   * @param $key
   * @param $value
   * @return mixed
   */
  static function old($key, $value) {
    $object = new static;
    $data = $object->all();
    return isset($data->$key->$value) ? $data->$key->$value : "";
  }
  
  //refresh request
  static function refresh() {
    $_POST = [];
    $_GET = [];
    $_FILES = [];
  }
}
