<!DOCTYPE html>
<?php include_once "inc_conexao.php" ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Compra finalizada</title>
		<link rel="stylesheet" href="css/estilo.css">
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
	
		<div class="container">
			<div style='margin-top:200px; margin-bottom:300px; text-align:center'>
				<h1>Compra efetuada com sucesso!</h1>
				<br>
				<h2>Agradecemos a preferência. Clique no botão abaixo para imprimir seu boleto.<h2><br>
				<input type="button" value="Gerar Boleto" >
			</div>
		</div>
		
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>