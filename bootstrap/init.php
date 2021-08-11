<?php

//Start session if it is not already started
if(!isset($_SESSION)) session_start();

//load environment variable
require_once __DIR__ . "/../app/config/_env.php";

//instantiate Database Class
new \App\Classes\Database();

//set custom error handler
set_error_handler([new \App\Classes\ErrorHandler(), "handleErrors"]);

//load routes
require_once __DIR__ . "/../app/Routing/routes.php";

//instantiate RouteDispatcher class
new \App\Routing\RouteDispatcher($router);
