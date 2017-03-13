<?php

	include_once "../inc_conexao.php";
	
	$op = isset($_POST["op"])?$_POST["op"]:"novo";
	$id = isset($_POST["id"])?$_POST["id"]:"";
	$data = isset($_POST["data"])?$_POST["data"]:"";
	$id_prod = isset($_POST["id_prod"])?$_POST["id_prod"]:"";
	$preco = isset($_POST["preco"])?$_POST["preco"]:"";
	$produto = isset($_POST["produto"])?$_POST["produto"]:"";
	$qtde = isset($_POST["quantidade"])?$_POST["quantidade"]:"";
	$fornecedor = isset($_POST["fornecedor"])?$_POST["fornecedor"]:"";
	$dataf = date('Y-m-d',strtotime($data));

	if($op == "novo"){
		$sql = "INSERT INTO compras(data,id_produto,produto,quantidade,preco_compra,fornecedor) VALUES";
		$sql.= "('$dataf',$id_prod,'$produto',$qtde,$preco,'$fornecedor')";
		$resultado = mysqli_query($conexao, $sql);
		if($resultado){
			$query = "UPDATE produtos SET estoque = estoque+$qtde WHERE id=$id_prod";
			$res = mysqli_query($conexao, $query);
		}
	}

	if($op == "editar"){
		$res = mysqli_query($conexao, "SELECT quantidade,id_produto from compras WHERE id=$id");
		$obj = mysqli_fetch_assoc($res);
		$qtde_anterior = $obj['quantidade'];
		$id_anterior = $obj['id_produto'];
		$sql = "";

		if($id_prod == $id_anterior){
			if($qtde_anterior != $qtde){
				$sql = "UPDATE produtos SET estoque = estoque-$qtde_anterior + $qtde WHERE id=$id_prod";
				$res = mysqli_query($conexao, $sql);
				$sql = "UPDATE compras SET data='$dataf', preco_compra=$preco, quantidade=$qtde, fornecedor='$fornecedor' WHERE id=$id";
				$res2 = mysqli_query($conexao, $sql);
			}else{
				$sql = "UPDATE compras SET data='$dataf', preco_compra=$preco, fornecedor='$fornecedor' WHERE id=$id";
				$res = mysqli_query($conexao, $sql);
			}
		}else{
			$sql = "UPDATE produtos SET estoque = estoque-$qtde_anterior WHERE id=$id_anterior";
			$res = mysqli_query($conexao, $sql);
			$sql = "UPDATE compras SET data='$dataf', id_produto=$id_prod, produto='$produto', preco_compra=$preco, quantidade=$qtde, 
			fornecedor='$fornecedor' WHERE id=$id";
			$res = mysqli_query($conexao, $sql);
			$sql = "UPDATE produtos SET estoque = estoque+$qtde WHERE id=$id_prod";
			$res = mysqli_query($conexao, $sql);
		}
	}

	if($op == "excluir"){

		$res = mysqli_query($conexao, "SELECT quantidade,id_produto from compras WHERE id=$id");
		$obj = mysqli_fetch_assoc($res);
		$qtde_anterior = $obj['quantidade'];
		$id_anterior = $obj['id_produto'];

		$sqlx = "UPDATE produtos SET estoque = estoque - $qtde_anterior WHERE id=$id_anterior";
		$res = mysqli_query($conexao, $sqlx);
		//echo $sqlx;

		$sql = "DELETE FROM compras WHERE id='$id'";
		$resultado = mysqli_query($conexao, $sql);
		
	}
	
	mysqli_close($conexao);
	header('Location: compras.php');
	
?>