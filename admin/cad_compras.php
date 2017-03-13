<!DOCTYPE html>
<?php include_once "../inc_conexao.php"; ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Título</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
		
		<script type="text/javascript">
			function valida(){
				if(form1.id_sub.value ==""){
					alert("Selecione uma categoria.");
					form1.id_sub.focus();
					return false;
				}
				if(form1.nome.value ==""){
					alert("Digite o nome do produto.");
					form1.nome.focus();
					return false;
				}
				if(form1.descricao.value ==""){
					alert("Digite uma breve descricao do produto.");
					form1.descricao.focus();
					return false;
				}
				if(form1.preco.value ==""){
					alert("Digite o preço do produto.");
					form1.preco.focus();
					return false;
				}
				if(form1.estoque.value ==""){
					alert("Digite a quantidade em estoque.");
					form1.estoque.focus();
					return false;
				}
			}
			function newPopup(id){
				varWindow = window.open (
				'popup.php?id='+id,
				'pagina',
				"width=350, height=255, top=100, left=110, scrollbars=no " );
			}

		</script>
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
		<?php
			$operacao = $_GET["op"];

			if($operacao == "editar"){
				$id = $_GET["id"];
				$sql = "SELECT * FROM compras WHERE id=$id";
				
				$resultado = mysqli_query($conexao, $sql);
				$registro = mysqli_fetch_assoc($resultado);
				
				$data = date('d/m/Y', strtotime($registro["data"]));
				$id_prod = $registro["id_produto"];
				$produto = $registro["produto"];
				$qtde = $registro["quantidade"];
				$preco = $registro["preco_compra"];
				$forn = $registro["fornecedor"];
				
			}
			if($operacao == "novo"){
				if(isset($_GET["idp"])){
					$id_prod = (int)$_GET["idp"];

					$sql = "SELECT nome,preco FROM produtos WHERE id=$id_prod";
					$res = mysqli_query($conexao, $sql);
					$registro = mysqli_fetch_assoc($res);
					$produto = $registro["nome"];
					$preco_venda = $registro["preco"];
				}
			}
			
		?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Compra de Mercadoria</span>
				</div>
				<div class="barra_btn">
					<a href="index.php"><img src="img/voltar.png" title="Voltar"></a>
				</div>
			</div>
		</div>
		<div class="container">
			<div style="padding-top:20px;">
				<form method="post" action="compras_control.php" name="form1">
		<input type="text" name="data" placeholder="Nome do produto" size="10px" maxLength="10" value="<?= isset($data)?$data:date('d/m/Y'); ?>"> <br><br>
					

					<select name="id_prod" id="id_prod">
						<option value="">Selecione um Produto</option>
						<?php
							$resultado = mysqli_query($conexao, "SELECT id, nome FROM produtos ORDER BY nome") or die(mysql_error());
							while($linha = mysqli_fetch_assoc($resultado)){
								if($id_prod == $linha['id'])
									echo "<option value='".$linha['id']."' selected='selected' >".$linha['nome']."</option>";
								else
									echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
			
							}
							mysqli_close($conexao);
						?>
					</select> <a href="produto.php?op=novo">Adicionar Produto</a> <br><br>
					
					<input type="hidden" name="produto" id="nome_prod" value="<?= isset($produto)?$produto:''?>">
					<input type="hidden" name="op" value="<?= $_GET["op"]; ?>">
					<input type="hidden" name="id" value="<?php if(isset($id))echo $id ?>">
					<input type="text" name="fornecedor" placeholder="Nome do fornecedor" size="50px" maxLength="32" value="<?= isset($forn)?$forn:''?>"> <br><br>
					<input type="text" name="quantidade" placeholder="quantidade" size="8px" maxLength="5" value="<?= isset($qtde)?$qtde:'' ?>"> <br><br>
					<span><?= isset($preco_venda)? 'Preço de Venda: '.number_format($preco_venda,'2',',','.').'<br><br>' : '<br>' ?></span>
					<input type="text" name="preco" placeholder="Preço de compra" size="15px" value="<?= isset($preco)?$preco:'' ?>"> <br><br>
					
					<button type="image" style="background: url('img/Save.png'); width:36px; height:36px;" title="Salvar"></button>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#id_prod').on('change', function() {
					valor = $('#id_prod option:selected').text();
  					$('#nome_prod').val(valor);
				})
			})
		</script>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>