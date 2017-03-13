// Script para a realização da Busca Instantanêa com Ajax
// Função para iniciar o Ajax no browser do cliente

function openAjax() {

	var ajax;
	
	try{
	   // XMLHttpRequest para browsers decentes, como: Firefox, Safari, dentre outros.
	   ajax = new XMLHttpRequest(); 
	}catch(ee){
		try{
			// Para o IE da MS
			ajax = new ActiveXObject("Msxml2.XMLHTTP"); 
		}catch(e){
			try{
				// Para o IE da MS
				ajax = new ActiveXObject("Microsoft.XMLHTTP"); 
			}catch(E){
				ajax = false;
			}
		}
	}
	return ajax;
}

// Função que realiza a busca instantânea e posiciona em uma div na página principal
function calculoFrete() {
	if( document.getElementById ) { // Para os browsers complacentes com o DOM W3C.
		
		
	var cepOrigem = document.getElementById('cepOrigem').value;
	var cepDestino = document.getElementById('cepDestino').value;
	var peso = document.getElementById('peso').value;
	// div que exibirá o resultado da busca.
	var exibeResultado = document.getElementById('result'); 

		// Verifica se o campo não está vazio, ou se foi digitado no mínimo nove caracteres.
		if(cepOrigem !== "" && cepOrigem !== null && cepOrigem.length >= 9) { 
			
			// Inicia o Ajax.
			var ajax = openAjax(); 
			
			var URL = "calcularFrete.php?cepOrigem="+cepOrigem+"&cepDestino="+cepDestino+"&peso="+peso;
			ajax.open("GET", URL, true);
			
			ajax.onreadystatechange = function() {
				// Quando estiver carregando, exibe: carregando...
				if(ajax.readyState == 1) { 
					exibeResultado.innerHTML = "<span class='texto'>Calculando Frete...</span>";
				}
				// Quando estiver tudo pronto.
				if(ajax.readyState == 4) { 
					if(ajax.status == 200) {
						var resultado = ajax.responseText; 
						// Coloca o resultado (da busca) retornado pelo Ajax nessa variável (var resultado).
						// Resolve o problema dos acentos (saiba mais aqui: http://www.plugsites.net/leandro/?p=4)
						resultado = resultado.replace(/\+/g," "); 
						// Resolve o problema dos acentos
						resultado = unescape(resultado); 
						exibeResultado.innerHTML = resultado;
					} else {
						exibeResultado.innerHTML = "<span class='text'>Erro realizando busca instantânea</span> ";
					}
				}
			}
			// submete
			ajax.send(null); 
		} 
	}
}