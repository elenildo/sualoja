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
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Cadastro de Clientes</span>
				</div>
				
				<form method="post" action="" style="padding-top:10px;">
					<select name="campo">
						<option value="nome">Nome</option>
						<option value="id">Código</option>
						<option value="email">E-mail</option>
					</select>
					<input type="text" placeholder="Digite um valor" name="busca">
					<button type="submit">Filtrar</button> 
				</form>
				
			</div>
			
			<div class="listagem">
				<table cellpadding="5px" border="1" width="100%" style="border-collapse:collapse;">
					<tr bgcolor="#ccc">
						<th>id</th>
						<th>e-mail</th>
						<th>Nome</th>
						<th>Sobrenome</th>
						<th>Cadastro em</th>
						<th>Status</th>
						<th colspan="2">Ações</th>
					</tr>
				<?php
					if(isset($_POST["id_del"])){
						$id = $_POST["id_del"];
						$sql = "DELETE FROM clientes WHERE id=$id";
						$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
					}
					if(isset($_POST["busca"]))
						$sql = 'SELECT * FROM clientes WHERE '. $_POST["campo"] .' like "%'. $_POST["busca"].'%"';
					else 
						$sql = "SELECT * FROM clientes";
						
					$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
					$total = mysqli_num_rows($resultado);
					echo $total." clientes encontrados";
					
					for($i=0; $i<$total; $i++){
						$registro = mysqli_fetch_assoc($resultado);
						$id = $registro["id"];
				?>
					<tr align="center">
						<td><?php echo $id ?></td>
						<td><?php echo $registro["email"]?></td>
						<td><?php echo $registro["nome"]?></td>
						<td><?php echo $registro["sobrenome"]?></td>
						<td><?php echo $registro["data"]?></td>
						<td><?php echo $registro["ativo"]?></td>
						<td width="25px">
							<form method="get" action="cliente.php">
								<input type="hidden" name="id" value="<?php echo $id ?>">
								<button type="submit" style="background: url('img/edit.png') no-repeat 5px 5px; width:30px; height:30px; border:1px solid #ccc;"></button>
							</form>
						</td>
						<td width="25px">
							<form method="post" action="" onSubmit='return confirm("Deseja excluir este registro?")'>
								<input type="hidden" name="id_del" value="<?php echo $id ?>">
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
		</div>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>