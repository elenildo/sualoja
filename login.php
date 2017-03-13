<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="css/estilo.css">
		<script type="text/javascript">
			
			function validacaoEmail(field) {
				usuario = field.value.substring(0, field.value.indexOf("@"));
				dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);

				if ((usuario.length >=1) &&
					(dominio.length >=3) && 
					(usuario.search("@")==-1) && 
					(dominio.search("@")==-1) &&
					(usuario.search(" ")==-1) && 
					(dominio.search(" ")==-1) &&
					(dominio.search(".")!=-1) &&      
					(dominio.indexOf(".") >=1)&& 
					(dominio.lastIndexOf(".") < dominio.length - 1)) {
				document.getElementById("msgemail").innerHTML="E-mail válido";
				alert("E-mail valido");
				}
				else{
				document.getElementById("msgemail").innerHTML="<font color='red'>E-mail inválido </font>";
				alert("E-mail invalido");
				}
			}
			
			function valida_cpf(strCPF){
				var Soma;
				var Resto;
				Soma = 0;
				if (strCPF == "00000000000" || strCPF == "") return false;
				
				for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
				Resto = (Soma * 10) % 11;
				
				if ((Resto == 10) || (Resto == 11))  Resto = 0;
				if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
				
				Soma = 0;
				for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
				Resto = (Soma * 10) % 11;
				
				if ((Resto == 10) || (Resto == 11))  Resto = 0;
				if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
				return true;
			}
			
			function valida(){
				if(form2.email.value ==""){
					alert("Digite seu e-mail");
					form2.email.focus();
					return false;
				}
				if(form2.senha.value ==""){
					alert("Digite uma senha.");
					form2.senha.focus();
					return false;
				}
				if(form2.senha.value != form2.resenha.value){
					alert("A senha digitada não confere.");
					form2.resenha.focus();
					return false;
				}
				if(form2.cpf.value == ""){
					alert("Digite seu CPF.");
					form2.cpf.focus();
					return false;
				}
				/*
				if(!valida_cpf(form2.cpf.value)){
					alert("O CPF digitado é inválido.\nDigite somente números");
					form2.cpf.focus();
					return false;
				}
				*/
			}
		</script>
	</head>
	<body>
		<?php include_once "inc_topo.php" ?>
		<?php include_once "inc_menu.php" ?>
		<?php //include_once "inc_banner.php" ?>
		<div class="container">
			<div class="conteudo">
				<div id="painel-login-esq">
					<h2>Já sou cadastrado</h2>
					<div class="painel-centro">
						<form method="POST" action="auth.php" id="form1">
							E-mail<br><input type="text" name="email" size="50px"><br><br>
							Senha<br><input type="password" name="senha" size="40px"><br><br>
							<a href="esqueci_senha.php">Esqueci a senha</a><br><br>
							<button>Logar</button>
						</form>
						<div class="p-info">
						<?php 
							if(isset($_SESSION["auth_message"])) echo $_SESSION["auth_message"];
						?>
						</div>
					</div>
				</div>
				<div id="painel-login-dir">
					<h2>Ainda não sou cadastrado</h2>
					<div class="painel-centro">
						<form method="POST" action="cad_cliente.php" id="form2" onSubmit="return valida()">
							E-mail<br><input type="text" name="email" size="50px" ><br><br>
							Digite uma senha<br><input type="password" name="senha" size="20px"><br><br>
							Confirme sua senha<br><input type="password" name="resenha" size="20px"><br><br>
							CPF/CNPJ(somente números)<br><input type="text" name="cpf" size="40px"><br><br>
							<button>Cadastrar</button>
						</form>
						<div class="p-info">
						<?php 
							if(isset($_SESSION["cad_message"])) echo $_SESSION["cad_message"];
						?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>