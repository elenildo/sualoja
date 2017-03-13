<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cadastro</title>
		<link rel="stylesheet" href="css/estilo.css">
		<script type="text/javascript" src="js/jquery-3.1.1.min.js" ></script>
		<script type="text/javascript" src="js/cep.js" ></script>
		
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
		<?php //include_once "inc_banner.php" ?>
		<?php
			$op = '';
			if(isset($_GET['op'])){
				$op = $_GET['op'];
			}
		?>
		<div class="container">
			<div class="conteudo">
				<div style="border:1px solid #ccc; border-radius:5px; color:darkblue; width:650px; margin-top:20px; margin-left: 200px; padding-top:10px;">
					<h2 align="center">Finalizando o cadastro</h2>
					<div style="padding:40px;">
						<form method="POST" action="cad_cliente_end.php">
						<input type='hidden' name='op' value='<?php echo $op ?>' >
						<table>
						<?php if($op == ''): ?>
						<tr>
							<td>
							Nome<br>
							<input name="nome" type="text" id="nome"  size="30" maxlength="9" /><br /><br />
							</td>
							<td>
							Sobrenome<br>
							<input name="sobrenome" type="text" id="sobrenome" value="" size="30" maxlength="9" /><br /><br />
							</td>
						</tr>
						<tr>
							<td>
							Telefone<br>
							<input name="telefone" type="text" id="telefone" value="" size="12" maxlength="12" /><br /><br />
							</td>
							<td>
							Celular<br>
							<input name="celular" type="text" id="celular" value="" size="13" maxlength="13" /><br /><br />
							</td>
						</tr>
						<?php endif; ?>
						<tr>
							<td colspan="2">
							Cep<br>
							<input name="cep" type="text" id="cep" value="<?php echo isset($_SESSION['cep_user'])? $_SESSION['cep_user'] : '' ?>" size="10" maxlength="9" /><br /><br />
							Rua<br>
							<input name="rua" type="text" id="rua" size="60" /><br /><br />
							Número<br>
							<input name="numero" type="text" id="numero" size="5" /><br /><br />
							Bairro<br>
							<input name="bairro" type="text" id="bairro" size="40" /><br /><br />
							</td>
						</tr>
						<tr>
							<td>
							Cidade<br>
							<input name="cidade" type="text" id="cidade" size="40" /><br /><br />
							</td>
							<td>
							Estado<br>
							<input name="uf" type="text" id="uf" size="2" /><br /><br />
							</td>
						</tr>
						</table>
							<button style="width:200px">Enviar</button>
						</form>
						<div class="p-info">
						<?php 
							if(isset($_SESSION["auth_message"])) echo $_SESSION["auth_message"];
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>