<?php

namespace App\Classes;

use PHPMailer;
	
class Mail {
	protected $mail;
	
	function __construct() {
		$this->mail = new PHPMiler();
		$this->setUp();
	}
	
	function setUp() {
		$this->mail->isSMTP();
		$this->mail->Mailer = "smtp";
		$this->mail->SMTPAuth = true;
		$this->mail->SMTPSecure = "tls";
		
		$this->mail->Host = $_SERVER["SMTP_HOST"];
		$this->mail->Port = $_SERVER["SMTP_PORT"];
		
		$environment = $_SERVER["APP_ENV"];
		
		if ($environment === "local") {
			$this->mail->SMTPDebug = 2;
		}
		
		//auth info
		$this->mail->Username = $_SERVER["EMAIL_USERNAME"];
		$this->mail->Password = $_SERVER["EMAIL_PASSWORD"];
		
		$this->mail->isHTML(true);
		$this->mail->SingleTo = true;
		
		//sender info
		$this->mail->From = $_SERVER("ADMIN_EMAIL");
		$this->mail->FromName = "MVC_Store";
	}
	
	function send($data) {
		$body = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	email body
</body>
</html>'
		
		$this->mail->addAddress($data["to"], $data["name"]);
		$this->mail->Subject = $data["subject"];
		$this->mail->Body = $body;
	}
	
}