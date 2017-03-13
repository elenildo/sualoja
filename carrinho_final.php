<?php
	$frete = $_POST["txtfrete"];
	$sub = $_POST["txtsub"];
	
	session_start();
	$_SESSION["cart_frete"] = $frete;
	$_SESSION["cart_sub"] = $sub;
	
	if($_SESSION["user"])
		header('Location: formapg.php');
	else
		header('Location: login.php');
	
?>