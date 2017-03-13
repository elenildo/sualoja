<?php 
	$imagem = $registro["imagem"]; 
	if(empty($imagem)) $imagem = "img/sem_foto.jpg";
?>

<div class="item">
	<a href="produto.php?id=<?=$registro["id"]?>" style="text-decoration:none;">
		<div style="text-align:center;">
			<img src="<?= $imagem ?>" width="200">
		</div>
		<div style="padding:10px;">
			<div style="color:darkblue; height:50px; font-size:18px;">
				<p><?= $registro["nome"]?></p>
			</div>
			<div style="color:gray; height:60px;">
				<p><?= mb_strimwidth($registro["descricao"],0,64,'...')?></p>
			</div>
			<div style="padding-bottom:10px; border-bottom:1px solid #ccc">
				<span>Por apenas<span>
				<p style="font-size:20px; color:darkblue;">R$ <?= number_format($registro["preco"], 2, ",", ".")?></p>
			</div>
		</div>
	</a>
	<div style="text-align:center;">
		<a href="carrinho_control.php?id=<?= $registro["id"] ?>"><img src="img/comprar.png"></a>
		<a href="carrinho_control.php?addcart=<?= $registro["id"] ?>">
			<img src="img/adicionar.png" title="Adicionar ao carrinho">
		</a>
	</div>
</div>