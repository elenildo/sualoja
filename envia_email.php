<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Sao_Paulo');

require_once('PHPMailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

//$body             = file_get_contents('conteudo.txt');
$body             = "<b>Conteúdo da mensagem enviada.<br> Pode ser usado também uma variável.</b>";
//$body             = preg_replace('/[\]/','',$body); 


$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;// no servidor hostinger mudar para 587   // set the SMTP port for the GMAIL server
$mail->Username   = "elenildo.dev@gmail.com";  // GMAIL username
$mail->Password   = "besouro dourado";            // GMAIL password

$mail->SetFrom('elenildo.dev@gmail.com', 'Elenildo Developer');

$mail->AddReplyTo("elenildo.dev@gmail.com","Elenildo Developer");

$mail->Subject    = "Teste de envio de e-mail pelo PHP";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "elenildosantos@yahoo.com.br";
$mail->AddAddress($address, "Elenildo Santos");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
