<?php
	
	$login = $_POST["login"];
	$senha = $_POST["senha"];
	
	include_once "../inc_conexao.php";
	
	$sql = "SELECT * FROM usuarios WHERE login='$login' and senha='$senha'";
	$resultado = mysqli_query($conexao,$sql);
	$total = mysqli_num_rows($resultado);
	
	if($total > 0){
		/*
		$login = mysql_result($resultado,0,"login");
		$senha = mysql_result($resultado,0,"senha");
		*/
		$objeto = mysqli_fetch_assoc($resultado);
		
		session_start();
		$_SESSION["user_admin"] = $objeto["nome"];
		header("Location: index.php");
		
	}else{
		session_start();
		$_SESSION["auth_message"] = "Acesso negado";
		header("Location: login.php");
	}
?>