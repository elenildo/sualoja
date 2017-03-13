<?php 
	$imagem = $registro["imagem"];
	$preco = $registro['preco']; 
	if(empty($imagem)) $imagem = "img/sem_foto.jpg";
?>

<div class="item_busca">
	<a href="produto.php?id=<?=$registro["id"]?>" style="text-decoration:none">
		<div style="text-align:center; width:20%; float:left;">
			<img src="<?= $imagem ?>" width="100">
		</div>
	</a>
	<div style="text-align:left; width:40%; float:left;">
		
		<div style="width:100%; color:#0606aa; font-size:18px; height: 30px;">
			<a href="produto.php?id=<?=$registro["id"]?>" style="text-decoration:none"><p><?= $registro["nome"]?></p></a>
		</div>
		
		<div style="width:100%; color:#888; height:75px;">
			<p><?= $registro["descricao"]?></p>
		</div>
		<div style="width:100%;">
			<img src="asd"> <img src="asd"> <img src="asd">
		</div>
	</div>
	<div style="text-align:right; width:20%; float:left;">
		<p style="font-size:12px; color:#777">De R$ <?php echo number_format($preco,2,',','.')?> por</p>
		<p style="font-size:20px; font-weight:bold; color:#07079c">R$ <?php echo number_format($preco,2,',','.')?></p>
		<p style="font-size:12px; color:#777">Em 10X de R$ <?php echo number_format(($preco / 10),2,',','.')?><br>OU</p><br>
		<p style="font-size:20px; font-weight:bold; color:green">R$ <?php echo number_format($preco-($preco * 0.15),2,',','.')?></p>
		<p style="color:#888; font-size: 12px;">15% de desconto no boleto</p>
	</div>
	<div style="text-align:center; width:20%; float:left;">
		<br><br>
		<?php 
			if((int)$registro["estoque"] > 0):
		 ?>
				<a href="carrinho_control.php?id=<?= $registro["id"] ?>" ><img src="img/comprar.png" ></a>
				<a href="carrinho_control.php?addcart=<?= $registro["id"] ?>"><p>Adicionar ao Carrinho</p></a>
		<?php 
			else:
		 ?>
				<br><h3 style="color: red;">Em falta</h3>
		<?php 
			endif;
		 ?>
				
		
	</div>
</div>