<?php

//Root folder path
define("BASE_PATH", realpath(__DIR__."/../../"));

//Autoload composer
require_once __DIR__."/../../vendor/autoload.php";

//Composer vlucas/dotenv Object
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();
