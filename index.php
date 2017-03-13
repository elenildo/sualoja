<!DOCTYPE html>
<?php include_once "inc_conexao.php"; ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Loja Simples</title>
		<link rel="stylesheet" href="css/estilo.css">
		<script src="js/jssor.slider-22.2.6.min.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
		<?php include_once "inc_carrossel.php" ?>
		<div class="container">
			<div class="barra_busca">
				<div style="padding:5px; width:100%; text-align:left; color:darkblue">
					<h2 id="titulo">Produtos em destaque</h2>
				</div>
			</div>
			<div class="lista">
				<?php
				
					$sql = "SELECT id,nome,descricao,preco,imagem FROM produtos WHERE destaque = 1";
					$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
					
					while($registro = mysqli_fetch_assoc($resultado)){
				?>
				
				<?php include "inc_item.php" ?>
				
				<?php 
					}
					mysqli_close($conexao);
				?>
			</div>
			<div class="barra_busca">
			
			</div>
		</div>
		
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>
