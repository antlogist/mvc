<?php

namespace App\Classes;

class Request {
  /**
   * return all requests
   * @param [$is_array = false]
   * @return mixed
   */
  static function all($is_array = false) {
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
  
  //check request availability
  
  //get request data
  
  //refresh request
}
