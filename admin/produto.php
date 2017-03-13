<!DOCTYPE html>
<?php include_once "../inc_conexao.php"; ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Produto</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
		<style type="text/css">
			#cad_categoria{display: none; border:1px solid #ccc; padding: 10px;}
			#spn_nova_cat{cursor: pointer; border:1px solid #ccc; padding: 2px;}

		</style>

		<script src="ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
		
		<script type="text/javascript">

			// $(document).ready(function(){
			// 	function cadastrar(nome){
			// 		var page = "cad_subcategoria.php";
			// 		$.ajax({
			// 			type:'POST',
			// 			dataType:'html',
			// 			url:page,
			// 			beforeSend: function(){
			// 				$("#msg").html("Carregando...");
			// 			},
			// 			data:{nome:nome},
			// 			success: function(msg){
			// 				$("#msg").html(msg);
			// 			}
			// 		});
			// 	}

			// 	$("#spn_nova_cat").click(function(){
			// 		$("#cad_categoria").slideDown();
			// 		$("#nome_cat").focus();
			// 	});
			// 	$("#btn_add").click(function(){
			// 		cadastrar($("#nome_cat").val());
			// 	});
			// });
			
        //});

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
			}

				
			// function novaCategoria(nome){
			
			// 	$("#cad_categoria").css(display:block);

			// }
			
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
				$sql = "SELECT * FROM produtos WHERE id=$id";
				
				$resultado = mysqli_query($conexao, $sql);
				$registro = mysqli_fetch_assoc($resultado);
				
				$nome = $registro["nome"];
				$descricao = $registro["descricao"];
				$preco = $registro["preco"];
				$estoque = $registro["estoque"];
				$detalhes = $registro["detalhes"];
				$destaque = $registro["destaque"];
				$id_sub = $registro["id_sub"];
				$imagem = $registro["imagem"];
				
			}
		?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Cadastro de Produtos</span>
				</div>
				<div class="barra_btn">
					<a href="index.php"><img src="img/voltar.png" title="Voltar"></a>
				</div>
			</div>
		</div>
		<div class="container">
			<div style="padding-top:20px;">

				<form method="post" enctype="multipart/form-data" action="cad_produtos.php" onSubmit="return valida();" name="form1">
					<select name="subcat" id="id_sub">
						<option value="">Selecione uma categoria</option>
						<?php
							$resultado = mysqli_query($conexao, "SELECT id, nome FROM subcategoria ORDER BY nome") or die(mysql_error());
							while($linha = mysqli_fetch_assoc($resultado)){
								if($id_sub == $linha['id'])
									echo "<option value='".$linha['id']."' selected='selected' >".$linha['nome']."</option>";
								else
									echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
			
							}
							mysqli_close($conexao);
						?>
					</select> <a href="javascript:newPopup('<?php if(isset($id))echo $id ?>')">Adicionar categoria</a>
					<!-- <span id='spn_nova_cat'>Nova Categoria</span>
					<div id='cad_categoria'>
						<label>Digite o nome da categoria</label>
						<input type="text" id='nome_cat'>
						<input type="button" id='btn_add' value="Adicionar">
						<span id="msg"></span>
					</div> --><br><br>
					<input type="hidden" name="op" value="<?= $_GET["op"]; ?>">
					<input type="hidden" name="id" value="<?php if(isset($id))echo $id ?>">
					<input type="text" name="nome" placeholder="Nome do produto" size="60px" maxLength="32" value="<?= isset($nome)?$nome:'' ?>"> <br><br>
					<input type="text" name="descricao" placeholder="Descrição do produto" size="60px" maxLength="64" value="<?= isset($descricao)?$descricao:'' ?>"> <br><br>
					<input type="text" name="preco" placeholder="Preço de venda" value="<?= isset($preco)? $preco:'' ?>"> <br><br>
					<label for="destaque">Exibir na homepage como destaque</label> &nbsp;
					<input type="checkbox" name="destaque" id="destaque" value="1" <?php if(isset($destaque)) echo ($destaque == 1)?'checked':'' ?> ><br><br>
					<input type="text" name="estoque" placeholder="Estoque atual" value="<?= isset($estoque)? $estoque:'' ?>" > <br><br>
					<textArea name="detalhes" id="textarea1" placeholder="Detalhes do produto" cols="76" rows="20"><?= isset($detalhes)? $detalhes:'' ?></textArea> <br><br>
					<div style="width:630px; border:1px solid #ddd; text-align:center; margin-bottom:10px; padding-top:10px;">
						<?php 
						if(isset($imagem) and $imagem != "") echo "<img src='../$imagem' width='20%'><br>"; 
						?>
						<input type="file" accept="image/*" name="imagem" placeholder="Caminho da foto" size="100px"> <br><br>
					</div>
					<button type="image" style="background: url('img/Save.png'); width:36px; height:36px;" title="Salvar"></button>
				</form>
			</div>
		</div>
		<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'textarea1' );

                	

            </script>
		<?php include_once "inc_rodape_adm.html" ?>
	</body>
</html>
