<!DOCTYPE html>
<?php include_once "../inc_conexao.php"; ?>
<?php

	$total = isset($_GET["total"])? $_GET["total"] : 0;
	$busca = isset($_GET["valor"])? $_GET["valor"] : "";
	$campo = isset($_GET["campo"])? $_GET["campo"] : "";
	
	$total_paginas = 0;
	
	if(isset($_GET["busca"])){
		$busca = $_GET["busca"];
		if($busca == ""){
			$total = 0;
		}else{
			$sql = "SELECT id FROM produtos WHERE nome like '%$busca%'";
			$res = mysqli_query($conexao, $sql)or die(mysqli_error($conexao));
			$total = mysqli_num_rows($res);
		}
	}else{
		$sql = "SELECT id FROM produtos";
		
		$res = mysqli_query($conexao, $sql)or die(mysqli_error($conexao));
		$total = mysqli_num_rows($res);
		
	}
	
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Produtos</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Cadastro de Produtos</span>
				</div>
				<div class="barra_btn">
					<a href="produto.php?op=novo"><img src="img/add.png" title="Novo"></a>
				</div>
				
				<form method="GET" action="" style="padding-top:10px;">
					<select name="campo">
						<option value="nome">Nome</option>
						<option value="id">Código</option>
						<option value="preco">Preço</option>
					</select>
					<input type="text" placeholder="Digite um valor" name="busca">
					<button type="submit">Filtrar</button> 
				</form>
				
			</div>
			
			<div class="listagem">
				<table cellpadding="5px" border="1" width="100%" style="border-collapse:collapse;">
					<tr bgcolor="#ccc">
						<th align="left">Foto</th>
						<th>id</th>
						<th>Nome</th>
						<th>Preço</th>
						<th>Estoque</th>
						<th>Destaque</th>
						<th colspan="3">Ações</th>
					</tr>
				<?php
					
					if( isset( $_GET['pagina'] ) && (int)$_GET['pagina'] >= 1)
						$pagina = (int)$_GET['pagina'];
					else
						$pagina = 1;
						
					$limite = 10;
					$offset = $limite * ($pagina-1);
					
					if($busca != "")
						$sql = "SELECT * FROM produtos WHERE {$campo} like '%{$busca}%' ORDER BY id DESC LIMIT {$limite} OFFSET {$offset}";
					else
						$sql = "SELECT * FROM produtos ORDER BY id DESC LIMIT {$limite} OFFSET {$offset}";
						
					$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
					$total_paginas = ceil($total / $limite) ;
					
					while($registro = mysqli_fetch_assoc($resultado)){
						$id = $registro["id"];
				?>
						<tr align="center">
							<td align="left" width="40px"><img src='<?php echo "../".$registro["imagem"]?>' width="32px"></td>
							<td><?= $id ?></td>
							<td><?= $registro["nome"]?></td>
							<td><?= $registro["preco"]?></td>
							<td><?= $registro["estoque"]?></td>
							<td><?= ($registro["destaque"] == 1)?'Sim':'' ?></td>
							<td><a href="cad_compras.php?op=novo&idp=<?=$id ?>">Comprar</a></td>
							<td width="25px">
								<form method="get" action="produto.php">
									<input type="hidden" name="id" value="<?= $id ?>">
									<input type="hidden" name="op" value="editar">
									<button type="submit" style="background: url('img/edit.png') no-repeat 5px 5px; width:30px; height:30px; border:1px solid #ccc;"></button>
								</form>
							</td>
							<td width="25px">
								<form method="post" action="cad_produtos.php" onSubmit='return confirm("Deseja excluir este registro?")'>
									<input type="hidden" name="id" value="<?= $id ?>">
									<input type="hidden" name="op" value="excluir">
									<button type="submit" style="background: url('img/remove.png') no-repeat 4px 4px; width:30px; height:30px; border:1px solid #ccc;" ></button>
								</form>
							</td>
						</tr>
				<?php
					}
					mysqli_close($conexao);
				?>
				</table>
			</div>
			<div class="barra_busca">
				<div style="padding-top:10px; padding-bottom:10px; text-align:center">
				<?php
				if($pagina !== 1){ // Sem isto irá exibir "Página Anterior" na primeira página.
				?>
					<a href="?total=<?= $total?>&valor=<?= $busca ?>&campo=<?= $campo?>&pagina=<?= $pagina-1 ?>"  style="text-decoration:none;">
						<span class="botao_pag" > Página Anterior </span>
					</a>
				<?php
				}
				if($pagina < $total_paginas){
				?>
					<a href="?total=<?= $total?>&valor=<?= $busca ?>&campo=<?= $campo?>&pagina=<?= $pagina+1; ?>" style="text-decoration:none;">
						<span class="botao_pag" > Próxima Página </span>
					</a>
				<?php }?>
				</div>
			</div>
		</div>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>
