<?php
require_once('../email/PHPMailer.php');
require_once('../email/SMTP.php');
require_once('../email/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

 $mail = new PHPMailer(true);

function enviarEmail ($from, $to, $subject, $body){
	global $mail;
	try {
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'flsolutions.collegetool@gmail.com';
		$mail->Password = 'flsolutions123';
		$mail->Port = 587;

		$mail->setFrom($from);
		$mail->addAddress($to);


		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $body;
		//$mail->AltBody = 'E-mail teste';

		if ($mail->send()) {
			echo 'Email enviado com sucesso';
		} else {
			echo 'Email nao enviado com sucesso';
		}
	} catch (Exception $e) {
		echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
	}
}

