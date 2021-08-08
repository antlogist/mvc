<?php

namespace App\Classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database {
	function __construct() {
		$db = new Capsule();
		$db->addConnection([
			'driver' => $_SERVER["DB_DRIVER"],
			'host' => $_SERVER["DB_HOST"],
			'database' => $_SERVER["DB_NAME"],
			'username' => $_SERVER["DB_USERNAME"],
			'password' => $_SERVER["DB_PASSWORD"],
			'charset' => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix' => ''
		]);
		
		// Make this Capsule instance available globally via static methods.
		$db->setAsGlobal();
		
		// Setup the Eloquent ORM
		$db->bootEloquent();
	}
}
