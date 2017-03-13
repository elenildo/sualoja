<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Forma de pagamento</title>
		<link rel="stylesheet" href="css/estilo.css">
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
		<?php //include_once "inc_banner.php" 
			if(!isset($_SESSION['carrinho']))
				echo "<div style='margin-top:200px; margin-bottom:300px; text-align:center'><h2>Esta sessão já expirou.</h2><br>
						<a href='index.php'><p>Voltar para a loja</p></a></div>";
			else{
			
				$frete = $_SESSION['cart_frete'];
				$subtotal = $_SESSION['cart_sub'];
				$total = $frete + $subtotal;
		?>
		<div class="container">
			<div class="barra-nav">
				<div style="padding:5px; width:100%; text-align:left; color:darkblue">
					<h2 id="titulo">Escolha uma forma de pagamento</h2>
				</div>
			</div>
			<div class="forma-pg">
				<h2>Boleto Bancário</h2><br>
				<p>O total a pagar da sua compra foi de <span>R$ <?= number_format($total,2,",",".") ?></span>. Usando este método você tem 15% de desconto e 
				paga <span>R$ <?= number_format($subtotal - ($subtotal*0.15) + $frete,2,",",".") ?></span></p>
				<br>
				<form method="POST" action="confirma_compra.php">
				<input type="hidden" name="formapg" value="boleto">
				<button>Pagar com Boleto</button>
				</form>
			</div>
			<div class="forma-pg">
				<h2>Cartão de Crédito</h2><br>
				<p>Usando este método você tem 10% de desconto para pagamento à vista e paga <span>R$ <?= number_format($total-($total*0.10),2,",",".")?></span>.
				Para compra em 2 ou 3 vezes você tem um desconto de 5%</p><br>
				<form>
					Parcelamento <select ></select><br><br>
					Nome <input type="text"><br><br>
					Numero do cartão <input type="text"><br><br>
					validade(mm/aa) <select ></select>
					<select ></select><br><br>
					Código de segurança <input type="text"><br><br>
					CPF <input type="text"><br><br>
					Data de nascimento <input type="text"> <input type="text"> <input type="text"> <br><br>
					<button>Pagar com cartão</button>
				</form>
			</div>
		</div>
		<?php } ?>
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>