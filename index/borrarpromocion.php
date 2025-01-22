<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->login(); //entrar a la base de datos construcali
	$ordenid = $_GET['productoid'];
	$meto->borrar_promocion($ordenid);
	echo "<h2>Se ha borrado la oferta con el numero $ordenid</h2>";
	
?>