<?php 
	$id = $_GET['id'];
	
	include "../inc_conexao.php";
	
	
	$nome = isset($_POST['nome'])?$_POST['nome']:"";
	if($nome != ''){
		$sql = "SELECT id FROM subcategoria WHERE nome ='$nome'";
		$resultado = mysqli_query($conexao, $sql);
		$qtd = mysqli_num_rows($resultado);
		if($qtd < 1){
			$sql = "INSERT INTO subcategoria(nome) values('$nome')";
			$resultado = mysqli_query($conexao, $sql);
			?>
			<script>
				//window.top.location.reload();
				window.opener.location.reload();
				window.close();
			</script>
			<?php
		}else
			?>
			<script>
				alert("Já existe uma categoria com este nome");
			</script>
			<?php
	}
			?>
			

<div>
	<span></span>
	<form method="POST" action="">
		<input type="text" name="nome">
		<button>Salvar</button>
	</form>
</div>