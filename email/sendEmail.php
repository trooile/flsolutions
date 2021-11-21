<?php
require_once('PHPMailer.php');
require_once('SMTP.php');
require_once('Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendEmail($subject, $body = null,$altbody,$to, $image = null){
	$mail = new PHPMailer(true);
try {
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'collegetool.flsolutions@gmail.com';
	$mail->Password = 'flsolutions123';
	$mail->Port = 587;
 
	$mail->setFrom('collegetool.flsolutions@gmail.com');
	$mail->addAddress($to);
 
	$mail->isHTML(true);
	$mail->Subject = $subject;
	if(!empty($image)){
		$mail->AddEmbeddedImage($body, "image-attach", "image.png");
		$mail->Body = '<a href="http://35.199.109.22/"><img alt="PHPMailer" src="cid:image-attach"></a>';
	}else{
		$mail->Body = $body;
	}
	$mail->AltBody = $altbody;

	if($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
	return;
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";}
}