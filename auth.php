<?php
	session_start();
	
	if(isset($_GET['logout'])){
		$_SESSION[] = array();
		session_destroy();
		header('Location: index.php');
	}else{
	
		if(isset($_SESSION["user"])){
			$_SESSION["auth_message"] = "Já existe um usuário logado.<br>Feche o navegador e abra novamente a página.";
			header("Location: login.php");
		}else{
			$email = $_POST["email"];
			$senha = $_POST["senha"];
			
			include_once "inc_conexao.php";
			
			$sql = "SELECT id,nome,cep,email FROM clientes WHERE email='$email' and senha='$senha'";
			$resultado = mysqli_query($conexao,$sql);
			$total = mysqli_num_rows($resultado);
		
			if($total > 0){
				$objeto = mysqli_fetch_assoc($resultado);
				
				$usr = array();
				$usr['nome'] = $objeto["nome"];
				$usr['id_user'] = $objeto["id"];
				$usr['cep_user'] = $objeto["cep"];
				$usr['email'] = $objeto["email"];

				$_SESSION["user"] = $usr;
				$_SESSION["auth_message"] = "";
				
				if(isset($_SESSION["cart_frete"]))
					header("Location: formapg.php");
				else
					header("Location: index.php");
			}else{
				$_SESSION["auth_message"] = "Acesso negado";
				header("Location: login.php");
			}
		}
		mysqli_close($conexao);
	}
?>