<!DOCTYPE html>
<?php include_once "../inc_conexao.php"; ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Configurar Páginas</title>
		<link rel="stylesheet" href="css/estilo_adm.css">
		<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
		<style type="text/css">
			/* Style the list */
			ul.tab {
				list-style-type: none;
				margin: 0;
				padding: 0;
				overflow: hidden;
				border: 1px solid #ccc;
				background-color: #f1f1f1;
			}

			/* Float the list items side by side */
			ul.tab li {float: left;}

			/* Style the links inside the list items */
			ul.tab li a {
				display: inline-block;
				color: black;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
				transition: 0.3s;
				font-size: 17px;
			}

			/* Change background color of links on hover */
			ul.tab li a:hover {background-color: #ddd;}

			/* Create an active/current tablink class */
			ul.tab li a:focus, .active {background-color: #ccc;}

			/* Style the tab content */
			.tabcontent {
				display: none;
				padding: 6px 12px;
				border: 1px solid #ccc;
				border-top: none;
			}
		</style>
		<script type="text/javascript">
			function openCity(evt, cityName) {
				// Declare all variables
				var i, tabcontent, tablinks;

				// Get all elements with class="tabcontent" and hide them
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}

				// Get all elements with class="tablinks" and remove the class "active"
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}

				// Show the current tab, and add an "active" class to the link that opened the tab
				document.getElementById(cityName).style.display = "block";
				evt.currentTarget.className += " active";
			}
		</script>
	</head>
	<body>
		<?php include_once "inc_topo_adm.html" ?>
		<div class="container">
			<div class="navbar_adm">
				<div style="float:left; width:300px; padding-top:12px;">
					<span>Configurar Páginas</span>
				</div>
				
			</div>
			<div class="">
				<ul class="tab">
				  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'home')" id="defaultOpen">Home</a></li>
				  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Paris')">Paris</a></li>
				  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</a></li>
				</ul>
				
				<div id="home" class="tabcontent">
				  <h3>Home page</h3>
				  <p>Coloque aqui as definições da página inicial, como a imagem do banner, imagens do carrossel,
					exibição de conteúdo e quantidade de itens a ser exibidos.
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				  </p>
				</div>

				<div id="Paris" class="tabcontent">
				  <h3>Paris</h3>
				  <p>Paris is the capital of France.</p> 
				</div>

				<div id="Tokyo" class="tabcontent">
				  <h3>Tokyo</h3>
				  <p>Tokyo is the capital of Japan.</p>
				</div>
				
			</div>
		</div>
		
		<?php include_once "inc_rodape_adm.html" ?>
	</body>

<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</html>