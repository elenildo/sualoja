<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/estilo.css">
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
		<?php include_once "inc_banner.php" ?>
		<?php
			include_once "inc_conexao.php";
			
			if(isset($_POST["email"])){
				$email = $_POST["email"];
				$senha = "";
				$msg = "";
				
				$sql = "SELECT email,senha,nome,sobrenome FROM clientes WHERE email = '$email'";
				$resultado = mysqli_query($conexao, $sql);
				$quant = mysqli_num_rows($resultado);
			
				if($quant > 0){
					$objeto = mysqli_fetch_assoc($resultado);
					$email = $objeto["email"];
					$senha = $objeto["senha"];
					$nome = $objeto["nome"];
					$sobrenome = $objeto["senha"];
					
					//error_reporting(E_ALL);
					error_reporting(E_STRICT);

					date_default_timezone_set('America/Sao_Paulo');

					require_once('PHPMailer/class.phpmailer.php');
					//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

					$mail             = new PHPMailer();

					//$body             = file_get_contents('conteudo.txt');
					$body             = "<b>Olá, você solicitou a recuperação da sua senha em nosso site.<br>A senha fornecida é: {$senha} </b>";
					//$body             = preg_replace('/[\]/','',$body); 

					$mail->IsSMTP(); // telling the class to use SMTP
					$mail->Host       = "smtp.gmail.com"; // SMTP server
					//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
															   // 1 = errors and messages
															   // 2 = messages only
					$mail->SMTPAuth   = true;                  // enable SMTP authentication
					$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
					$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
					$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
					$mail->Username   = "elenildo.dev@gmail.com";  // GMAIL username
					$mail->Password   = "besouro dourado";            // GMAIL password
					$mail->SetFrom('elenildo.dev@gmail.com', 'Loja Simples');
					$mail->AddReplyTo("elenildo.dev@gmail.com","Loja Simples");
					$mail->Subject    = "Recuperação de senha de acesso";
					$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
					$mail->MsgHTML($body);
					$address = $email;
					$mail->AddAddress($address, "$nome $sobrenome");

					//$mail->AddAttachment("images/phpmailer.gif");      // attachment
					//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

					if(!$mail->Send()) {
						$msg = "<h2>Houve um erro ao enviar o e-mail</h2><br>".$mail->ErrorInfo;
						//echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
						$sent = true;
					}
					
				}else{
					 $msg = "<h2>O e-mail informado não consta em nosso cadastro</h2>";
				}
			}
		?>
		<div class="container">
			<div class="barra_busca">
				<div style="padding:5px; width:100%; text-align:left; color:darkblue">
					<h2>Recuperação de Senha</h2>
				</div>
			</div>
		
		<?php if(! isset($sent)): ?>
			<div style="width:100%; float:left; border:1px solid #ccc; border-radius:5px; color:darkblue; margin-bottom:200px; text-align:center; margin-top:10px; padding-top:20px;">
				<h2>Digite seu e-mail</h2>
				<div style="padding:30px; margin-top:10px; color:#555; text-align:left; height:130px;">
					<form method="POST" action="" id="form1" onSubmit="return valida()">
						E-mail<br><input type="text" name="email" size="50px"><br><br>
						<button>Enviar</button>
					</form>
				</div>
				<font color="red"><?php echo isset($msg) ? $msg : ""; ?></font>
			</div>
		<?php else: ?>
			<div style="margin:0 auto; width:400px;">
				<div style="width:100%; min-height:600px; float:left; margin-top:10px;">
					<div style="width:500px; float:left; border:1px solid #ccc; border-radius:5px; color:red; margin-bottom:10px; text-align:center; padding:10px;">
						<h2>Pronto.<br>Sua senha foi enviada para seu e-mail cadastrado.</h2>
					</div>
				</div>
			</div>
		<?php endif ?>
		</div>
		
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>