<?php
	session_start();
	
	if(isset($_SESSION['user'])){
		if(isset($_SESSION['pedido'])){
			$pedido = $_SESSION['pedido'];
			
			include_once "inc_conexao.php";
			
			$sql = "INSERT INTO pedidos(id_cliente,subtotal,frete,desconto,total,status,formapg) 
			VALUES({$pedido['id']},{$pedido['subtotal']},{$pedido['frete']},{$pedido['desconto']},{$pedido['total']},'{$pedido['status']}','{$pedido['formapg']}')";
			$res = mysqli_query($conexao,$sql) or die(mysql_error());
			$id_ped = mysqli_insert_id($conexao);
			
			foreach($pedido['itens'] as $item){
				if($item['id'] == 0) continue;
				$sql = "INSERT INTO item_pedido(id_pedido,id_produto,preco,quantidade) VALUES({$id_ped},{$item['id']},{$item['preco']},{$item['qtd']})";
				$ret = mysqli_query($conexao,$sql);
			}
			mysqli_close($conexao);
			
			unset($_SESSION['pedido']);
			unset($_SESSION['carrinho']);
			unset($_SESSION['cart_frete']);
			unset($_SESSION['cart_sub']);
			
			header('Location: compra_finalizada.php');
			
		}else
			echo "O carrinho já foi finalizado";
	}else
		echo 'Para acessar esta área é preciso estar logado';
	
?>