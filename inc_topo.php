<?php 
	session_start();
	$user = isset($_SESSION["user"]) ? $_SESSION["user"] : "";
?>
<script>
	function buscar(busca){
		if(form1.busca.value == ""){
			alert("Digite algo na caixa de pesquisa");
			return false;
		}
	}
</script>
<div class="barra-topo">
	<div id="bt-centro">
	<?php if(! $user): ?>
		<a href="login.php">
			<img src="img/login.png" title="Login" >
			<div class="bt-painel">Faça seu Login</div>
		</a>
	<?php else: ?>
		<a href="auth.php?logout=true" >
			<img src="img/logout.png" title="Sair">
			<div class="bt_painel">Bem vindo, <?= isset($user['nome'])?$user['nome']:$user['email'] ?></div>
		</a>
	<?php endif ?>
	</div>
</div>
<div id="painel-topo" >
	<div id="pt-main">
		<div id="pt-esq">
			<a href="index.php"><img src="img/logo.png" title="Home" ></a> 
		</div>
		<div id="pt-dir">
			<div class="pt-dir-div">
				<span >QUEM SOMOS | FALE CONOSCO | MINHA CONTA </span>
			</div>
			<div class="pt-dir-div">
				<a href="carrinho.php" title="Meu Carrinho">
					<div id="pt-carrinho">
						Meu Carrinho<br>
						<?php echo isset($_SESSION["carrinho"])? (sizeof($_SESSION["carrinho"])-1)." itens" : "Vazio"; ?>
					</div>
					<img src="img/cart.png">
				</a>
			</div>
			<div class="pt-dir-div1" >
				<div class="barra_busca">
					<form method="GET" action="listagem.php" name="form1" onSubmit="return buscar();">
						<input type="text" name="busca">
						<button type="submit" >PESQUISAR</button> 
					</form>
				</div>
			</div>
		</div>
	</div>
</div>