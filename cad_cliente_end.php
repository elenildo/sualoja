<?php

	session_start();
	
	if(isset($_SESSION["user"])){
		
		$id = $_SESSION["user"]["id_user"];
		$oper = $_POST['op'];
		
		if($oper == ''){
			$nome = $_POST["nome"];
			$sobrenome = $_POST["sobrenome"];
			$telefone = $_POST["telefone"];
			$celular = $_POST["celular"];
		}
		$cep = $_POST["cep"];
		$rua = $_POST["rua"];
		$numero = $_POST["numero"];
		$bairro = $_POST["bairro"];
		$cidade = $_POST["cidade"];
		$uf = $_POST["uf"];
		
		$sql = "UPDATE clientes SET cep='$cep', rua='$rua', numero='$numero', bairro='$bairro', cidade='$cidade', uf='$uf'";
		($oper == '')? $sql.=", telefone='$telefone', celular='$celular', nome='$nome',sobrenome='$sobrenome'" :"";
		$sql.=" WHERE id=$id";
		
		include_once "inc_conexao.php";
		
		$resultado = mysqli_query($conexao, $sql) or die(mysql_error());
		mysqli_close($conexao);
		$_SESSION["user"]["cep_user"] = $cep;
		
		if(isset($_SESSION['carrinho']))
			header('Location: carrinho.php');
		else
			header('Location: index.php');
	}

	
	
?>