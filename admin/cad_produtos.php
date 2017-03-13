<?php

	include_once "../inc_conexao.php";
	
	$op = isset($_POST["op"])?$_POST["op"]:"novo";
	$id = isset($_POST["id"])?$_POST["id"]:"";
	$nome = isset($_POST["nome"])?$_POST["nome"]:"";
	$descricao = isset($_POST["descricao"])?$_POST["descricao"]:"";
	$preco = isset($_POST["preco"])?$_POST["preco"]:"";
	$estoque = isset($_POST["estoque"])?$_POST["estoque"]:"";
	$detalhes = isset($_POST["detalhes"])?$_POST["detalhes"]:"";
	$destaque = isset($_POST["destaque"])?$_POST["destaque"]:"";
	$id_sub = isset($_POST["subcat"])?$_POST["subcat"]:"";
	$caminho = "";
	
	if(isset($_FILES["imagem"])){
		$ext = strtolower(substr($_FILES["imagem"]["name"],-4)); //pega a extensão
		$allowedExts = array(".gif", ".jpeg", ".jpg", ".png", ".bmp"); //Extensões permitidas
		
		if(in_array($ext, $allowedExts)){
			date_default_timezone_set("Brazil/East"); //timezone padrão
			$new_name = date('Y.m.d-H.i.s').$ext; //definindo um novo nome com base no horário
			$dir = "img/";
			$caminho = $dir.$new_name;
			move_uploaded_file($_FILES['imagem']['tmp_name'],"../".$caminho);
		}
	}
	
	if($op == "novo"){
		$sql = "INSERT INTO produtos(nome,descricao,preco,estoque,detalhes,imagem,destaque,id_sub) VALUES";
		$sql.= "('$nome','$descricao','$preco','$estoque','$detalhes','$caminho','$destaque','$id_sub')";
		$resultado = mysqli_query($conexao, $sql);
		//echo "Incluído com sucesso";
		//echo "<br><a href='index.php'>home</a>";
		header('Location: index.php');
	}
	if($op == "editar"){
		$sql = "UPDATE produtos SET nome='$nome',
		descricao='$descricao',preco='$preco',
		estoque='$estoque',detalhes='$detalhes',
		destaque='$destaque',id_sub='$id_sub'";
		if($caminho != "") $sql.= ",imagem='$caminho'";
		$sql.= "WHERE id=$id";
		$resultado = mysqli_query($conexao, $sql);
		//echo "Alterado com sucesso";
		//echo "<br><a href='index.php'>home</a>";
		header('Location: index.php');
	}
	if($op == "excluir"){
		$sql = "DELETE FROM produtos WHERE id='$id'";
		$resultado = mysqli_query($conexao, $sql);
		/*
		echo "Excluído com sucesso";
		echo "<br><a href='index.php'>home</a>";
		*/
		header('Location: index.php');
	}
	
	mysqli_close($conexao);
	
?>