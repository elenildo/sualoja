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
		<?php 
			$qtitens = isset($_SESSION['carrinho']) ? sizeof($_SESSION['carrinho']) : 0;
			if($qtitens <= 1)
				echo "<div style='margin-top:200px; margin-bottom:300px; text-align:center'><h2>Seu carrinho está vazio.</h2><br>
						<a href='index.php'><p>Voltar para a loja</p></a></div>";
			else{
		?>
		<div class="container">
			<div class="barra-nav">
				<h2>Carrinho de Compras</h2>
			</div>
		<?php
		
			$dados = array();
			$mgspn = "Digite seu CEP na caixa ao lado para calcular o frete";
			if(isset($_POST["cepDestino"])){
				$cepDestino = $_POST["cepDestino"];
				$parametros = array();

				 // C?igo e senha da empresa, se voc?tiver contrato com os correios, se n? tiver deixe vazio.
				 $parametros['nCdEmpresa'] = '';
				 $parametros['sDsSenha'] = '';

				 // CEP de origem e destino. Esse parametro precisa ser num?ico, sem "-" (h?en) espa?s ou algo diferente de um n?mero.
				 $parametros['sCepOrigem'] = '96010140';
				 $parametros['sCepDestino'] = $cepDestino; //'02460000';

				 // O peso do produto dever?ser enviado em quilogramas, leve em considera?o que isso dever?incluir o peso da embalagem.
				 $parametros['nVlPeso'] = '1';

				 // O formato tem apenas duas op?es: 1 para caixa / pacote e 2 para rolo/prisma.
				 $parametros['nCdFormato'] = '1';

				 // O comprimento, altura, largura e diametro dever?ser informado em cent?etros e somente n?meros
				 $parametros['nVlComprimento'] = '16';
				 $parametros['nVlAltura'] = '5';
				 $parametros['nVlLargura'] = '15';
				 $parametros['nVlDiametro'] = '0';

				 // Aqui voc?informa se quer que a encomenda deva ser entregue somente para uma determinada pessoa ap? confirma?o por RG. Use "s" e "n".
				 $parametros['sCdMaoPropria'] = 's';

				 // O valor declarado serve para o caso de sua encomenda extraviar, ent? voc?poder?recuperar o valor dela. Vale lembrar que o valor da encomenda interfere no valor do frete. Se n? quiser declarar pode passar 0 (zero).
				 $parametros['nVlValorDeclarado'] = '200';

				 // Se voc?quer ser avisado sobre a entrega da encomenda. Para n? avisar use "n", para avisar use "s".
				 $parametros['sCdAvisoRecebimento'] = 'n';

				 // Formato no qual a consulta ser?retornada, podendo ser: Popup ?mostra uma janela pop-up - URL ?envia os dados via post para a URL informada - XML ?Retorna a resposta em XML
				 $parametros['StrRetorno'] = 'xml';

				 // C?igo do Servi?, pode ser apenas um ou mais. Para mais de um apenas separe por virgula.
				 $parametros['nCdServico'] = '40010,41106,40215';


				 $parametros = http_build_query($parametros);
				 $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
				 $curl = curl_init($url.'?'.$parametros);
				 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				 $dados = curl_exec($curl);
				 $dados = simplexml_load_string($dados);
				 
			}
			$carrinho = isset($_SESSION['carrinho'])? $_SESSION['carrinho'] : array(array("id"=>"0", "qtd"=>0));

			include_once "inc_conexao.php";
			$total = 0.0;
			$excesso = false;
		?>
			
				<table id="tab-cart">
					<tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th><th></th></tr>
		<?php			
				foreach($carrinho as $item){
					if($item["id"] == "0") continue; 
					$sql = "SELECT id,nome,preco,imagem,estoque FROM produtos WHERE id=".$item['id'];
					$resultado = mysqli_query($conexao,$sql);
					$obj = mysqli_fetch_assoc($resultado);
					$sub = (int)$item["qtd"] * $obj["preco"];
					$total += $sub;
		?>	
					<tr>
						<td>
							<img src="<?=$obj["imagem"]?>" width="15%" style="float:left;"> 
							<div style="width:100%; font-size:20px; text-align:center; padding-top:30px;">
								<?=$obj["nome"]?> 
							</div>
						</td>
						<td>R$ <?= number_format($obj["preco"],2,",",".")?></td>
						<td>
							<form method="POST" action="carrinho_control.php">
								<input type="hidden" name="cod" value="<?=$obj["id"]?>" >
								<input type="text" name="qtd_itens" size="5px" value="<?=$item["qtd"]?>">
								<input type="image" src="img/reload.png" title="Atualizar valor">
							</form>
							<?php if($obj['estoque'] < $item['qtd']){
								echo "<span style='color:red'>A quantidade solicitada excede nosso estoque.</span>";
								$excesso = true;
								$mgspn = 'A quantidade solicitada excede nosso estoque.';
								}
							?> 
						</td>
						<td>R$ <?= number_format($sub, 2,",",".") ?></td>
						<td>
							<a href="carrinho_control.php?del=<?=$obj["id"]?>"><span>Remover</span>
						</td>
					</tr>
		
		<?php
				}
		?>
					<tr>
						<td colspan="5" bgcolor="#f0f0f0">
							<a href="carrinho_control.php?clear=true" onClick="return confirm('Deseja remover todos os itens do carrinho?');">
								<span style="padding:10px; margin:10px; float:left; font-size:15px; border:1px solid #ccc; background-color:#cdeccd;">Esvaziar carrinho</span>
							</a>
						</td>
					</tr>
				</table>
				<div style="width:620px; border:1px solid #ccc; margin-top:10px; float:left; min-height:250px;">
					<div style="float:left; width:48%; padding-top:110px; padding-left:20px;">
					<form method="post" action="">
						<table width="988" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="408">
							  CEP : 
							  <input name="cepDestino" type="text" id="cepDestino" value="<?php echo isset($_SESSION["user"])? $_SESSION["user"]["cep_user"] : ''; ?>">
							  <input name="postok" type="submit" id="postok" value="Calcular">
							  <input name="cepOrigem" type="hidden" id="cepOrigem" value="86975000">
							<td width="580"><div class="texto" id="result"></div></td>
						  </tr>
						</table>
					</form>
					<?php if( isset($_SESSION['user'])) echo "<a href='cadastro.php?op=alter'>Alterar meu endereço</a>" ?>
					</div>
					<div style="float:left; padding-top:33px; font-size: 10px;">
		<?php
				mysqli_close($conexao);
				
				if($dados != null){
					$mgspn = "Escolha uma forma de envio";
					$servicos = array('41106'=>'PAC','40010'=>'Sedex','40215'=>'Sedex 10');
					echo "<table cellpadding='10' border='1'><tr align='center' bgcolor='#ccc'><td>Serviço</td><td>Valor</td><td>Entrega</td></tr>";
					foreach($dados->cServico as $linhas) {
						if($linhas->Erro == 0) {
							echo "<tr>";
							echo "<td align='right'>".$servicos["$linhas->Codigo"]." <input type='radio' name='envio' id='envio' value='{$linhas->Valor}' onChange='return pega_valor(value,$total)'></td><td> R$ {$linhas->Valor} </td><td>{$linhas->PrazoEntrega} dias</td>";
							echo "</tr>";
						}//else 
							//echo $linhas->MsgErro."<br>";
					}
					echo "</table>";
				}
		?>
					</div>
				</div>
				
				<div style="width:390px; border:1px solid #ccc; margin-top:10px; float:left; min-height:250px; margin-left:10px;">
					<div style="padding-top:20px; padding-left:10px; font-size:25px;">
					<table width="100%">
					<tr><td >Subtotal:</td><td align="left">R$ <?= number_format($total,'2',',','.')?></td></tr>
					<tr><td >Frete:</td><td align="left">R$ <span id='spnfrete'></span></td></tr>
					<tr><td >Total:</td><td align="left">R$ <span id='spnsoma'></span></td></tr>
					</table>
					</div>
					<div style='text-align:center; font-size:16px; color:red; padding-top:10px'>
						<form method="post" action="carrinho_final.php" name="form-finaliza">
							<input type="hidden" name="txtfrete" id="txtfrete" value="0">
							<input type="hidden" name="txtsub" id="txtsub" value="<?=$total?>">
							<br>
							<?php if(! $excesso): ?>
								<button id="btnfinaliza" style="font-size:20px; background-color:#ccc; color:white; padding:10px; border-radius:5px" disabled >Finalizar Compra</button><br>
							<?php endif;?>
							<span id='spnmensagem'><?=$mgspn?></span>
						</form>
					</div>
				</div>
		</div>	
		<script type="text/javascript">
			function number_format(numero, decimal, decimal_separador, milhar_separador ){
				numero = (numero + '').replace(/[^0-9+\-Ee.]/g, '');
				var n = !isFinite(+numero) ? 0 : +numero,

					prec = !isFinite(+decimal) ? 0 : Math.abs(decimal),
					sep = (typeof milhar_separador === 'undefined') ? ',' : milhar_separador,
					dec = (typeof decimal_separador === 'undefined') ? '.' : decimal_separador,
					s = '',
					toFixedFix = function (n, prec) {
						var k = Math.pow(10, prec);
						return '' + Math.round(n * k) / k;
					};
				// Fix para IE: parseFloat(0.55).toFixed(0) = 0;
				s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
				if (s[0].length > 3) {
					s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
				}
				if ((s[1] || '').length < prec) {
					s[1] = s[1] || '';
					s[1] += new Array(prec - s[1].length + 1).join('0');
				}
			 
				return s.join(dec);
			}
			function pega_valor(valor,sub){
				a = valor.replace(",",".");
				b = parseFloat(a);
				total = b + sub;
				res = number_format(total,2,',','.')
				
				document.getElementById("spnfrete").innerHTML=valor;
				document.getElementById("spnsoma").innerHTML=res;
				document.getElementById("txtfrete").value=b;
				document.getElementById("btnfinaliza").disabled = false;
				document.getElementById("btnfinaliza").style.background="#2f962f";
				document.getElementById("spnmensagem").innerHTML="";
				return false
			}
			
		</script>
		<?php } ?>
		<?php include_once "inc_rodape.php" ?>
	</body>
</html>