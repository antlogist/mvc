<?php
namespace App\Classes;

class ErrorHandler() {
	
	function handleErrors($error_number, $error_message, $error_file, $error_line) {
		$error = "[{$error_number}] An error occurred in file {$error_file} on line {$error_line}: {$error_message}";
		
		$environment = $_SERVER["APP_ENV"];
		
		if($environment === "local") {
			$whoops = new \Whoops\Run;
			$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
			$whoops->register();
		}
	} else {
		$data = [
			"to" => $_SERVER["ADMIN_EMAIL"],
			"subject" => "System Error",
			"view" => "errors",
			"name" => "Admin",
			"body" => $error
		];
		ErrorHandler::emailAdmin($data)->outputFriendlyError();
	}
	
	function outputFriendlyError() {
		ob_end_clean();
		view("errors/generic/");
		exit;
	}
	
	static function emailAdmin($data) {
		$mail = new Mail();
		$mail->send($data);
		return new static;
	}
}