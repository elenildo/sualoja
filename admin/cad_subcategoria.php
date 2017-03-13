<?php 
	
	include "../inc_conexao.php";
	
	
	$nome = isset($_POST['nome'])?$_POST['nome']:"";
	if($nome != ''){
		$sql = "SELECT id FROM subcategoria WHERE nome ='$nome'";
		$resultado = mysqli_query($conexao, $sql);
		$qtd = mysqli_num_rows($resultado);
		if($qtd < 1){
			$sql = "INSERT INTO subcategoria(nome) values('$nome')";
			$resultado = mysqli_query($conexao, $sql);
		}else
			echo "Já existe uma categoria com esse nome";
			
	}else
		echo "O nome não pode ser em branco";
?>