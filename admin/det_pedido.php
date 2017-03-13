<!DOCTYPE html>
<?php include_once "../inc_conexao.php"; ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Título</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
		<?php 

			$id = $_GET["id"];

			if(isset($_GET["acao"])){
				$acao = $_GET["acao"];
				$sql = "UPDATE pedidos SET status ='$acao' WHERE id=$id";
				$atualiza = mysqli_query($conexao, $sql);
			}

			$sql = "SELECT p.* , c.nome as nome
			FROM pedidos p, clientes c 
			WHERE p.id=$id";

			$resultado = mysqli_query($conexao, $sql);
			$registro = mysqli_fetch_assoc($resultado);
			$data = $registro["data"];
			$cliente = $registro["nome"];
			$status = $registro["status"];
			$total = $registro["total"];
			$formapg = $registro["formapg"];
		?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Detalhes do Pedido</span>
				</div>
				<div class="barra_btn">
					<a href="pedidos.php"><img src="img/voltar.png" title="Voltar"></a>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="detalhe">
				<div style="width: 540px; float: left;">
					<label>ID: </label>
					<span><?php if(isset($id))echo $id ?></span><br><br>
					<label>Data</label><br>
					<span><?php echo date('d/m/Y H:m:i',strtotime($data)) ?></span><br><br>
					<label>Cliente</label><br>
					<span><?php echo $cliente; ?></span><br><br>
					<label>Valor</label><br>
					<span>R$ <?php echo number_format($total,'2',',','.') ?></span><br><br>
					<label>Forma de Pagamento</label><br>
					<span><?php echo $formapg ?></span><br><br>
				</div>
				<div style="width: 300px; float: left; ">
				<?php 
					if($status == "Pendente"):
				?>
						
					<a href="?id=<?=$id?>&acao=Finalizado" onclick="return confirm('Deseja finalizar esta venda?')"><h2>Finalizar Pedido</h2></a>
					<br>
					<a href="?id=<?=$id?>&acao=Cancelado" onclick="return confirm('Deseja cancelar esta venda?')"><h2>Cancelar Pedido</h2></a>
				
				<?php else: ?>

					<h2 <?php echo ($status == 'Finalizado')? 'style="color:green"' :'style="color:red"' ?> >Pedido <?= $status ?><h2>

				<?php endif; ?>
				</div>
			</div>
			<div style="float: left; padding-top: 20px; padding-bottom: 10px;">
				<?php
					$sql = "SELECT p.nome as nome, p.id as idp, i.*
									FROM produtos p, item_pedido i
									WHERE i.id_pedido = {$id} and i.id_produto = p.id";
					
					$itens = mysqli_query($conexao, $sql);
					$qtd = mysqli_num_rows($itens);
					
					if($qtd > 0){
						echo "<h2>Itens do Pedido</h2><br>";
						echo "<table border='1' cellpadding='5'><tr><th>Produto</th><th>Preço Unitário</th><th>Quantidade</th><th>Subtotal</th></tr>";
						while($reg = mysqli_fetch_assoc($itens)){
							$preco = number_format($reg['preco'],'2',',','.');
							$subtotal = number_format(($reg['preco'] * $reg['quantidade']),'2',',','.');
							$quantidade = $reg['quantidade'];
							$id_prod = $reg['idp'];

							if(isset($acao)){
								/*Atualiza o estoque*/
								if($acao == 'Finalizado'){
									$upd = mysqli_query($conexao, "UPDATE produtos set estoque = estoque - $quantidade WHERE id = $id_prod");
								}
							}

							echo "<tr><td>{$reg['nome']}</td><td>{$preco}</td><td>{$quantidade}</td><td>{$subtotal}</td></tr>";
						}
						echo "</table>";
					}
					mysqli_close($conexao);
				?>
			</div>
		</div>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>