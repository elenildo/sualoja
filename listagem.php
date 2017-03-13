<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Resultado da busca</title>
		<link rel="stylesheet" href="css/estilo.css">
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
		<?php include_once "inc_banner.php" ?>
		<?php
			include_once "inc_conexao.php"; 
			
			$total = isset($_GET["total"])? $_GET["total"] : 0;
			$busca = isset($_GET["valor"])? $_GET["valor"] : "";
			$usuario = isset($_SESSION['email']) ? $_SESSION['email'] : '';

			$total_paginas = 0;
			
			if(isset($_GET["busca"])){
				$busca = $_GET["busca"];
				if($busca == ""){
					$total = 0;
				}else{
					$sql = "SELECT id FROM produtos WHERE nome like '%$busca%'";
					$res = mysqli_query($conexao, $sql)or die(mysqli_error($conexao));
					$total = mysqli_num_rows($res);
					if($total == 0){
						$sql2 = "INSERT INTO buscas(data,busca,usuario) VALUES('".date('Y-m-d')."','$busca','{$usuario}')" ;

						$log = mysqli_query($conexao, $sql2)or die(mysqli_error($conexao));
					}
				}
			}
			
		?>
		<div class="container">
			<div class="barra-nav">
				<div style="float:left; color:darkorange; padding-left:10px;">
					Sua busca retornou <?php echo $total ?> produtos
				</div>
				<div style="float:left; padding-left:170px;">
					<form method="post" action="">
						Ordenar por
						<select name="ordenacao">
							<option value="mais_recentes">Mais recentes</option>
							<option value="menor_preco">Menor preço</option>
							<option value="maior_preco">Maior preço</option>
						</select>
					</form>
				</div>
			</div>
			<div class="lista">
				<?php
					
					if( isset( $_GET['pagina'] ) && (int)$_GET['pagina'] >= 1)
						$pagina = (int)$_GET['pagina'];
					else
						$pagina = 1;
						
					$limite = 8;
					$offset = $limite * ($pagina-1);
					
					if($busca != ""){
						$sql = "SELECT id,nome,descricao,preco,imagem,estoque FROM produtos WHERE nome LIKE '%$busca%' LIMIT {$limite} OFFSET {$offset}";
						$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
						$total_paginas = ceil($total / $limite) ;
						
						while($registro = mysqli_fetch_assoc($resultado)){
							
					?>
					
							<?php include "inc_item_busca.php" ?>
					
					<?php 
						}
					}
					mysqli_close($conexao);
				?>
			</div>
			<div class="barra_busca">
				<div style="padding-top:10px; padding-bottom:10px; text-align:center">
				<?php
				if($pagina !== 1){ // Sem isto irá exibir "Página Anterior" na primeira página.
				?>
					<a href="listagem.php?total=<?= $total?>&valor=<?= $busca ?>&pagina=<?= $pagina-1 ?>"  style="text-decoration:none;">
						<span class="botao_pag" > Página Anterior </span>
					</a>
				<?php
				}
				if($pagina < $total_paginas){
				?>
					<a href="listagem.php?total=<?= $total?>&valor=<?= $busca ?>&pagina=<?= $pagina+1; ?>" style="text-decoration:none;">
						<span class="botao_pag" > Próxima Página </span>
					</a>
				<?php }?>
				</div>
			</div>
		</div>
		
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>