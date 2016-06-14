<?php
require_once (DOC_PATH_ROOT."/Lib/SwiftMailer/swiftmailer-master/lib/swift_required.php");
require_once (DOC_PATH_ROOT."/Config/swiftmailer.config.php");
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

class SwiftMailer{
	public function sendMail($to,$name,$subject,$body){
		// date_default_timezone_set("PRC");
		$transport = Swift_SmtpTransport::newInstance(Transport,25);
		$transport ->setUsername(UserUame);
		$transport ->setPassword(Password);

		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance();
		$message ->setFrom(array(UserUame=>Name));
		$message ->setTo(array($to=>$name));
		$message ->setSubject($subject);
		$message ->setBody($body,"text/html","utf-8");
		try{
			$mailer ->send($message);
		}catch(Swift_ConnectionException $e){
			$code = "400";
			$message = $e ->getMessage();
			return Json::makeJson($code,$message);
		}
		$code = "200";
		$message = "发送成功";
		return Json::makeJson($code,$message);
	}
}