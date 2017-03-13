// Script para a realiza��o da Busca Instantan�a com Ajax
// Fun��o para iniciar o Ajax no browser do cliente

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

// Fun��o que realiza a busca instant�nea e posiciona em uma div na p�gina principal
function calculoFrete() {
	if( document.getElementById ) { // Para os browsers complacentes com o DOM W3C.
		
		
	var cepOrigem = document.getElementById('cepOrigem').value;
	var cepDestino = document.getElementById('cepDestino').value;
	var peso = document.getElementById('peso').value;
	// div que exibir� o resultado da busca.
	var exibeResultado = document.getElementById('result'); 

		// Verifica se o campo n�o est� vazio, ou se foi digitado no m�nimo nove caracteres.
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
						// Coloca o resultado (da busca) retornado pelo Ajax nessa vari�vel (var resultado).
						// Resolve o problema dos acentos (saiba mais aqui: http://www.plugsites.net/leandro/?p=4)
						resultado = resultado.replace(/\+/g," "); 
						// Resolve o problema dos acentos
						resultado = unescape(resultado); 
						exibeResultado.innerHTML = resultado;
					} else {
						exibeResultado.innerHTML = "<span class='text'>Erro realizando busca instant�nea</span> ";
					}
				}
			}
			// submete
			ajax.send(null); 
		} 
	}
}