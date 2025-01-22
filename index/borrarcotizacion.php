<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->entrar(); //entrar a base de datos servicios
	$ordenid = $_GET['ordenid'];
	$meto->borrar_pedidos($ordenid);
	echo "<li>Se ha borrado la cotizacion numero $ordenid y sus respuestas</li>";
?>