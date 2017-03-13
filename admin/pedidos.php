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
		}
	}else{
		$sql = "SELECT id FROM pedidos";
		$res = mysqli_query($conexao, $sql)or die(mysql_error());
		$total = mysqli_num_rows($res);
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pedidos</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Controle de Pedidos</span>
				</div>
				<div class="barra_btn">
					<a href="produto.php?op=novo"><img src="img/add.png" title="Novo"></a>
				</div>
				
				<form method="GET" action="" style="padding-top:10px;">
					<select name="campo">
						<option value="id_cliente">Cód Cliente</option>
						<option value="email">E-mail do Cliente</option>
						<option value="data">Data da Compra</option>
					</select>
					<input type="text" placeholder="Digite um valor" name="busca">
					<button type="submit">Filtrar</button> 
				</form>
			</div>
			
			<div class="listagem">
				<table cellpadding="5px" border="1" width="100%" style="border-collapse:collapse;">
					<tr bgcolor="#ccc">
						<th>id</th>
						<th>Cliente</th>
						<th>Data</th>
						<th>Total</th>
						<th>Status</th>
						<th>Forma PG</th>
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
						$sql = "SELECT c.id as id_cli, c.email as cliente ,p.* 
						FROM clientes c, pedidos p 
						WHERE {$campo}='{$busca}' and c.id = p.id_cliente 
						ORDER BY id DESC LIMIT {$limite} OFFSET {$offset}";
					else
						$sql = "SELECT c.id as id_cli, c.email as cliente ,p.* 
						FROM clientes c, pedidos p 
						WHERE c.id = p.id_cliente 
						ORDER BY id DESC LIMIT {$limite} OFFSET {$offset}";
 					
					$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
					$total_paginas = ceil($total / $limite) ;
					
					while($registro = mysqli_fetch_assoc($resultado)){
						$id = $registro["id"];
				?>
						<tr align="center" <?php echo ($registro["status"] == 'Cancelado')?'style="background:#f3d399"':'' ?>>
							<td><?= $id ?></td>
							<td><a href="cliente.php?id=<?= $registro['id_cli']?>"><?= $registro["cliente"]?><a></td>
							<td><?= $registro["data"]?></td>
							<td><?= number_format($registro["total"],'2',',','.') ?></td>
							<td><?= $registro["status"]?></td>
							<td><?= $registro["formapg"]?></td>
							<td width="25px">
								<form method="get" action="det_pedido.php">
									<input type="hidden" name="id" value="<?= $id ?>">
									<button type="submit" style="background: url('img/edit.png') no-repeat 5px 5px; width:30px; height:30px; border:1px solid #ccc;"></button>
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