<!DOCTYPE html>
<?php include_once "../inc_conexao.php"; ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Produtos</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
		
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
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
					$sql = "SELECT id FROM compras WHERE produto like '%$busca%'";
					$res = mysqli_query($conexao, $sql)or die(mysql_error());
					$total = mysqli_num_rows($res);
				}
			}else{
				$sql = "SELECT id FROM compras";
				$res = mysqli_query($conexao, $sql)or die(mysql_error());
				$total = mysqli_num_rows($res);
			}
		?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Compras</span>
				</div>
				<div class="barra_btn">
					<a href="cad_compras.php?op=novo"><img src="img/add.png" title="Novo"></a>
				</div>

				<form method="GET" action="" style="padding-top:10px;">
					<select name="campo">
						<option value="produto">Nome</option>
						<option value="id">Código</option>
						<option value="data">Data</option>
					</select>
					<input type="text" placeholder="Digite um valor" name="busca">
					<button type="submit">Filtrar</button> 
				</form>
				
			</div>
			
			<div class="listagem">
				<table cellpadding="5px" border="1" width="100%" style="border-collapse:collapse;">
					<tr bgcolor="#ccc">
						<th>Data</th>
						<th>Código</th>
						<th>Produto</th>
						<th>Fornecedor</th>
						<th>Quantidade</th>
						<th>Preço</th>
						<th colspan="2">Ações</th>
					</tr>
				<?php
					
					if( isset( $_GET['pagina'] ) && (int)$_GET['pagina'] >= 1)
						$pagina = (int)$_GET['pagina'];
					else
						$pagina = 1;
						
					$limite = 10;
					$offset = $limite * ($pagina-1);
					
					if($busca != "")
						$sql = "SELECT * FROM compras WHERE {$campo} like '%{$busca}%' ORDER BY id DESC LIMIT {$limite} OFFSET {$offset}";
					else
						$sql = "SELECT * FROM compras ORDER BY id DESC LIMIT {$limite} OFFSET {$offset}";
						
					$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
					$total_paginas = ceil($total / $limite) ;
					
					while($registro = mysqli_fetch_assoc($resultado)){
						$id = $registro["id"];
						$data = date('d/m/Y',strtotime($registro["data"]));
				?>
						<tr align="center">
							<td><?= $data ?></td>
							<td><?= $registro["id_produto"]?></td>
							<td><?= $registro["produto"]?></td>
							<td><?= $registro["fornecedor"]?></td>
							<td><?= $registro["quantidade"]?></td>
							<td><?= number_format($registro["preco_compra"],2,',','.') ?></td>
							<td width="25px">
								<form method="get" action="cad_compras.php">
									<input type="hidden" name="id" value="<?= $id ?>">
									<input type="hidden" name="op" value="editar">
									<button type="submit" style="background: url('img/edit.png') no-repeat 5px 5px; width:30px; height:30px; border:1px solid #ccc;"></button>
								</form>
							</td>
							<td width="25px">
								<form method="post" action="compras_control.php" onSubmit='return confirm("Deseja excluir este registro?")'>
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