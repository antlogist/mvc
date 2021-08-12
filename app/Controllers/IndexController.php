<?php
namespace App\Controllers;

use App\Classes\Mail;
  
class IndexController extends BaseController {
	public function show() {
		echo "Inside Homepage from controller class";
		
		$mail = new Mail();
	  	
//		$data = [
//			"to" => "test@test.com",
//			"subject" => "Welcome to MVC store example",
//			"view" => "welcome",
//			"name" => "Anthony Underwood",
//			"body" => "Email template"
//		];

		if($mail->send($data)) {
			echo "Email send successfully!";
		} else {
			echo "Email sending failed!";
		}
	}
}