<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Carrinho de Compras</title>
		<link rel="stylesheet" href="css/estilo.css">
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
		<div class="container">
			<div class="barra-nav">
				<h2>Conferir Pedido</h2>
			</div>
			<div class="conteudo">
		<?php
			
			$carrinho = isset($_SESSION['carrinho'])? $_SESSION['carrinho'] : array(array("id"=>"0", "qtd"=>0));
			$iduser = $_SESSION['user']['id_user'];
			$subtotal = $_SESSION['cart_sub'];
			$frete = $_SESSION['cart_frete'];
			$desconto = 0.0;
			
			if(isset($_POST['formapg'])){
				$formapg = $_POST['formapg'];
				if($formapg == 'boleto')
					$desconto = 0.15;
				else if($formapg == 'cartao')
					$desconto = 0.10;
				
			}
			
			$calc_desc = $subtotal * $desconto;
			$total = $subtotal - $calc_desc + $frete;
			
			$ped = array();
			$itens = array();
	
			$ped['id'] = $iduser;
			$ped['subtotal'] = $_SESSION['cart_sub'];
			$ped['frete'] = $_SESSION['cart_frete'];
			$ped['status'] = 'Pendente';
			$ped['desconto'] = $calc_desc;
			$ped['total'] = $total;
			$ped['formapg'] = $formapg;
			
			include_once "inc_conexao.php";
			
			$sql = "SELECT nome,sobrenome,email,rua,numero,bairro,cidade,uf FROM clientes WHERE id = $iduser";
			$res_cli = mysqli_query($conexao,$sql) or die(mysql_error());
			$res = mysqli_fetch_assoc($res_cli);

		?>
				<div style="border:1px solid #ccc; padding:10px; float:left">
					<div class="div-sep">
						<h2>Dados do cliente</h2><br>
						<span>Nome: <?php echo "{$res['nome']} {$res['sobrenome']}" ?></span><br>
						<span>E-mail: <?=$res['email']?></span><br><br>
					</div>
					<div class="div-sep">
						<h2>Endereço de Entrega</h2><br>
						<span><?=$res['rua']?>, nº <?=$res['numero']?></span><br>
						<span><?=$res['bairro']?> - <?=$res['cidade']?> /<?=$res['uf']?></span><br><br>
					</div>
					<div class="div-sep">
						<h2>Itens Comprados</h2><br>
						<div style="float:left;" >
						<table border="1" cellpadding="4">
							<tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th></tr>
		<?php			
				foreach($carrinho as &$item){
					if($item["id"] == "0") continue; 
					$sql = "SELECT id,nome,preco,imagem FROM produtos WHERE id=".$item['id'];
					$resultado = mysqli_query($conexao,$sql);
					$obj = mysqli_fetch_assoc($resultado);

					$sub = (int)$item["qtd"] * $obj["preco"]; 
					$item["preco"] = $obj["preco"];
		?>	
							<tr>
								<td>
									<img src="<?=$obj["imagem"]?>" width="15%" style="float:left;"> 
									<div style="width:350px; font-size:18px; text-align:center; padding-top:10px;">
										<?=$obj["nome"]?> 
									</div>
								</td>
								<td>R$ <?= number_format($obj["preco"],2,",",".")?></td>
								<td><?=$item["qtd"]?></td>
								<td>R$ <?= number_format($sub, 2,",",".") ?></td>
							</tr>
		<?php
				}
				mysqli_close($conexao);
			
				$ped['itens'] = $carrinho;
				$_SESSION['pedido'] = $ped;
				
		?>
						</table>
						</div>
						<div style="float:left; margin-left:5px; border:1px solid #ccc; font-size:20px; padding:10px;">
							<table cellpadding="4">
								<tr><td>Subtotal: </td><td align="right">R$ <?= number_format($subtotal,2,',','.') ?></td></tr>
								<tr><td>Frete: </td><td align="right">R$ <?= number_format($frete,2,',','.') ?></td></tr>
								<tr><td>Desconto: </td><td align="right">- R$ <?= number_format($calc_desc,2,',','.') ?></td></tr>
								<tr><td>Total: </td><td align="right">R$ <?= number_format($total,2,',','.') ?></td></tr>
							</table>
						</div>
					</div>
					<div class="div-sep">
						<h2>Termos e condições do site</h2><br>
						<iframe src="docs/contrato.html" width="100%" height="780" style="border: 1px solid #ccc;"></iframe>
						<form name="form_finaliza" method="post" action="gera_pedido.php" >
							<br><input type="checkbox" name="termo"> Li e aceito as condições<br><br>
							<button type="submit">Tudo OK, finalizar a Compra</button>
						</form>
					</div>
				</div>
			</div>
	
		</div>
		<script type="text/javascript">
			function finaliza(){
				if(! form_finaliza.termo.checked){
					alert("Você deve aceitar os termos do site para continuar");
				}
				return false
			}
		</script>
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>