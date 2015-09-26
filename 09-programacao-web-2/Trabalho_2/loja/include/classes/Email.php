<?php
"phpmailer.php";
class Email
{
	function Enviar($email) {
		//$Vai 		= "Nome: $Nome\n\nE-mail: $Email\n\nMensagem: $Mensagem\n";

		$error;
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->Username = 'poswebfurbturma11@gmail.com';
		$mail->Password = 'poswebturma11';
		$mail->SetFrom('poswebfurbturma11@gmail.com', 'Pos web furb - turma 11');
		$mail->Subject = 'Email da Loja Virtual';
		$mail->Body = $email->mensagem;
		$mail->AddAddress($email->email);
		if(!$mail->Send()) {
			echo 'Mail error: '.$mail->ErrorInfo;
		} else {
			Header("location:index.html");
			echo "<script>alert('Email enviado com sucesso');</script>";
		}
	}
}
?>
