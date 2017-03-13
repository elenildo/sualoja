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
			$guia = "Clientes";
			$id = $_GET["id"];
			$resultado = mysqli_query($conexao, "SELECT * FROM clientes WHERE id='$id'");
			$registro = mysqli_fetch_assoc($resultado);
			$nome = $registro["nome"];
			$sobrenome = $registro["sobrenome"];
			$email = $registro["email"];
			$data = $registro["data"];
			$ativo = $registro["ativo"];	
		?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Cadastro de <?php echo $guia ?></span>
				</div>
				<div class="barra_btn">
					<a href="clientes.php"><img src="img/voltar.png" title="Voltar"></a>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="detalhe">
				<label>ID: </label>
				<span><?php if(isset($id))echo $id ?></span><br><br>
				<label>Nome</label><br>
				<span><?php echo "$nome $sobrenome"; ?></span><br><br>
				<label>Status</label><br>
				<span><?php echo ($ativo > 0)? 'Ativo' : 'Inativo'; ?></span><br><br>
				<label>Cadastrado em</label><br>
				<span><?php echo date('d/m/Y H:m:i',strtotime($data)) ?></span><br><br>
				<label>e-mail</label><br>
				<span><?php echo $email; ?></span><br><br>
			</div>
			<?php
				$pedidos = mysqli_query($conexao, "SELECT id,data,total,status FROM pedidos WHERE id_cliente='$id'");
				$qtd_ped = mysqli_num_rows($pedidos);
				
				if($qtd_ped > 0){
					echo "<h2>Compras deste cliente</h2><br>";
					echo "<table border='1' cellpadding='5'><tr><th>Data</th><th>Total da compra</th><th>Status</th><th>Produtos Comprados</th></tr>";
					while($reg = mysqli_fetch_assoc($pedidos)){
						$data = date('d/m/Y', strtotime($reg['data']));
						echo "<tr><td>{$data}</td><td>{$reg['total']}</td><td>{$reg['status']}</td><td>";
						$sql = "SELECT p.nome as nome, i.quantidade
								FROM produtos p, item_pedido i
								WHERE i.id_pedido = {$reg['id']} and i.id_produto = p.id";
						
						$itens = mysqli_query($conexao, $sql);
						while($item = mysqli_fetch_assoc($itens)){
							echo "0{$item['quantidade']} {$item['nome']}<br>";
						}
						echo "</td></tr>";
					}
					echo "</table>";
				}
				mysqli_close($conexao);
			?>
		</div>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>