<?php
		session_start();
		
		$carrinho = isset($_SESSION['carrinho'])? $_SESSION['carrinho'] : array(array("id"=>"0", "preco"=>0.0,"qtd"=>0));
		
		if(isset($_GET['clear'])){
			$_SESSION['carrinho'] = array(array("id"=>"0", "preco"=>0.0,"qtd"=>0));
		}
			
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			$found = false;
			foreach($carrinho as &$item){
				if($id == $item["id"]){ 
					$item["qtd"] ++;
					$found = true;
				}
			}
			if(!$found){
				$carrinho[] = array("id" =>$id,"preco"=>0.0, "qtd"=>1);
			}
			
			$_SESSION['carrinho'] = $carrinho;
			
		}
		
		if(isset($_POST['qtd_itens'])){
			$id = $_POST['cod'];
			$qtd = $_POST['qtd_itens'];
			foreach($carrinho as &$item){
				if($id == $item["id"]){ 
					$item["qtd"] = $qtd;
					break;
				}
			}
			
			$_SESSION['carrinho'] = $carrinho;
		}
		
		if(isset($_GET["del"])){
			$id = $_GET["del"];
			
			foreach($carrinho as $key => $value){
				if($id == $value["id"]){ 
					unset($carrinho[$key]);
					break;
				}
			}
			/*
			for($i = 1; $i < sizeof($carrinho); $i++){
				if($id == $carrinho[$i]["id"]){ 
					//$carrinho[$i]["id"] = 0; //Marca como removido
					unset($carrinho[$i]);
					break;
				}
			}
			*/
			$_SESSION['carrinho'] = $carrinho;
		}
		
		if(isset($_GET['addcart'])){
			$id = $_GET['addcart'];
			
			$found = false;
			foreach($carrinho as &$item){
				if($id == $item["id"]){ 
					$item["qtd"] ++;
					$found = true;
				}
			}
			if(!$found){
				$carrinho[] = array("id" =>$id, "preco" =>0.0, "qtd"=>1);
			}
			
			$_SESSION['carrinho'] = $carrinho;
			
			$url = $_SERVER["HTTP_REFERER"]; //Encontra a última página visitada
			header("Location: $url");
			
		}else
			header('Location: carrinho.php');
		
		
?>