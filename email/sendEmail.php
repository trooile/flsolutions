<?php
require_once('PHPMailer.php');
require_once('SMTP.php');
require_once('Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendEmail($subject, $body,$altbody,$to){
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
	$mail->Body = $body;
	$mail->AltBody = $altbody;
 
	if($mail->send()) {
		echo 'Email enviado com sucesso';
	} else {
		echo 'Email nao enviado';
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";}
}

sendEmail('Assunto teste','Corpo do E-mail teste','alttest','augusto.cardone@hotmail.com');