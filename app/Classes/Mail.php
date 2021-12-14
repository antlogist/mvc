<?php

namespace App\Classes;

//use PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;

class Mail {
	protected $mail;

	function __construct() {
		$this->mail = new PHPMailer();
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
			$this->mail->SMTPOptions = [
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_sign' => true,
				)
			];
			$this->mail->SMTPDebug = "";
		}

		//auth info
		$this->mail->Username = $_SERVER["EMAIL_USERNAME"];
		$this->mail->Password = $_SERVER["EMAIL_PASSWORD"];

		$this->mail->isHTML(true);
		$this->mail->SingleTo = true;

		//sender info
		$this->mail->From = $_SERVER["ADMIN_EMAIL"];

		$this->mail->FromName = "MVC_Store";
	}

	function send($data) {

		$this->mail->addAddress($data["to"], $data["name"]);
		$this->mail->Subject = $data["subject"];
		$this->mail->Body = make($data["view"], array("data" => $data["body"]));

		return $this->mail->send();
	}
}
