<?php
namespace App\Routing;

class RouteDispatcher {
  protected $match;
  protected $controller;
  protected $method;
  
  function __construct($router) {
	
	/*
	* Returns ['target' => $target,'params' => $params,'name' => $name] if matched.
	* Returns false if not matched.
	*/
    $this->match = $router->match();
    
    if ($this->match) {
      list($controller, $method) = explode("@", $this->match["target"]);
      $this->controller = $controller;
      $this->method = $method;
      
	/*
	* If the value can be called as a function from the current scope.
	*/
      if (is_callable(array(new $this->controller, $this->method))) {
		  /*
		  * Call method ($this->method) 
		  * in instance of a Class (new $this->controller) 
		  * with certain parameters ($this->match["params"])
		  */
        call_user_func_array(array(new $this->controller, $this->method), array($this->match["params"]));
      } else {
        echo "The method {$this->method} is not defined in the controller {$this->controller}";
      }
    } else {
      header($_SERVER["SERVER_PROTOCOL"] . "404 Not Found");
		/* Helper function */
      view("errors/404");
    }
  }
}
