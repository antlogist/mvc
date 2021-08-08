<?php

require_once __DIR__ . "/../bootstrap/init.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$category = Capsule::select('SELECT * FROM categories');

echo "<pre>";
var_dump($category);
echo "</pre>";
