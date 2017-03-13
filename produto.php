<!DOCTYPE html>
<?php include_once "inc_conexao.php" ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Detalhes do produto</title>
		<link rel="stylesheet" href="css/estilo.css">
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
		<?php
			if(isset($_GET['id'])){
				$sql = "SELECT * FROM produtos WHERE id = {$_GET['id']}";
			}
			$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
			//echo "Offet:".$offset;
			//echo "total da busca:".$total;
			//echo "total_paginas:".$total_paginas;
			
			$reg = mysqli_fetch_assoc($resultado);
			$preco_venda = $reg["preco"];

			mysqli_close($conexao);
		?>
		<div class="container">
			<div class="conteudo">
				<div id="produto-title">
					<h1><?=$reg["nome"]?></h1>
				</div>
				<div id="produto-image">
					<img src="<?=$reg["imagem"]?>" >
				</div>
				<div id="produto-pay">
					<div style="padding-top:20px; padding-bottom:20px">
						<p>Disponibilidade</p>
						<?php if((int)$reg["estoque"] > 0) :?> 
							<p style="font-weight:bold; font-size:20px; color:green;">Imediata</p>
						<?php else : ?> 
							<p style="font-weight:bold; font-size:20px; color:red;">Indisponível no momento</p>
						<?php endif ?>
					</div>
					<div style="padding-top:20px; border-top:1px solid #ccc;">
						<?php if((int)$reg["estoque"] > 0) :?> 
							<a href="carrinho_control.php?id=<?= $reg["id"] ?>&preco=<?= $preco_venda ?>">
								<img src="img/comprar_detalhes.png">
							</a>
						<?php endif ?>
					</div>
					<div style="padding-top:10px; padding-bottom:10px; ">
						<p style="font-size:25px; color:darkblue;">R$ <?= number_format($preco_venda,2,',','.')?></p>
						<p>Em 10X de <?php echo number_format(($preco_venda / 10),2,',','.') ?> sem juros no cartão</p><br>
						<p style="font-size:30px; color:green;">R$ <?= number_format($preco_venda-($preco_venda * 0.15),2,',','.') ?></p> à vista no boleto com 15% de desconto
					</div>
					<div style="padding-top:20px; border-top:1px solid #ccc;">
						<p>PARCELAMENTO</p>
						<img src="img/bandeiras.gif">
						<table width="100%" border="1">
							<tr><td>1x R$ 10,00</td><td>6x R$ 10,00</td></tr>
							<tr><td>2x R$ 10,00</td><td>7x R$ 10,00</td></tr>
							<tr><td>3x R$ 10,00</td><td>8x R$ 10,00</td></tr>
							<tr><td>4x R$ 10,00</td><td>9x R$ 10,00</td></tr>
							<tr><td>5x R$ 10,00</td><td>10x R$ 10,00</td></tr>
						</table>
						<br><p>Compartilhar</p>
					</div>
				</div>
				<div style="width:100%; float:left; margin-top:10px; padding-top:10px; border:1px solid #ccc; border-radius:5px;">
					<span style="padding:10px; color:darkblue; font-weight:bold;">DESCRIÇÃO</span>
					<div style="margin-top:10px; padding:10px; border-top:1px solid #ccc;" ><?= $reg["descricao"] ?></div>
				</div>
				<div style="width:100%; float:left; margin-top:10px; padding-top:10px; border:1px solid #ccc; border-radius:5px;">
					<span style="padding:10px; color:darkblue; font-weight:bold;">DETALHES</span>
					<div style="margin-top:10px; padding:10px; border-top:1px solid #ccc;" ><?= $reg["detalhes"] ?></div>
				</div>
				
			</div>
		</div>
		
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>