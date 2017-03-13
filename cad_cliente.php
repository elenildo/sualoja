<?php

	session_start();
	include_once "inc_conexao.php";
	
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$resenha = $_POST["resenha"];
	$cpf = $_POST["cpf"];
	
	$sql = "SELECT id FROM clientes WHERE email = '$email' or cpf = '$cpf'";
	$resultado = mysqli_query($conexao, $sql);
	$quant = mysqli_num_rows($resultado);
	
	if($quant > 0){
		$_SESSION["cad_message"] = "Já existe um usuário cadastrado com este e-mail ou CPF.<br>Escolha a opção 'Esqueci a senha' no formulário ao lado";
		header('Location: login.php');
	}else{
	
		$sql = "INSERT INTO clientes(email,cpf,senha) VALUES";
		$sql.= "('$email','$cpf','$senha')";
		$resultado = mysqli_query($conexao, $sql);
		$id = mysqli_insert_id($conexao); //retorna o novo id inserido 
		mysqli_close($conexao);
		
		$_SESSION["user"]["email"] = $email;
		$_SESSION["user"]["id_user"] = $id;
		$_SESSION["cad_message"] = "";
		
		header('Location: cadastro.php');
	}

	
	
?>