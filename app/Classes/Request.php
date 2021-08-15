<?php

namespace App\Classes;

class Request {
  //return all requests
  static function all($is_array = false) {
    $result = [];
    
    if (count($_GET) > 0) $result["get"] = $_GET;
    if (count($_POST) > 0) $result["post"] = $_POST;
    
  }
  //get specific request type
  
  //check request availability
  
  //get request data
  
  //refresh request
}
