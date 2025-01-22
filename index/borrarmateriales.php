<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->entrar(); //entrar a base de datos servicios
	$ordenid = $_GET['ordenid'];
	$meto->borrar_materiales($ordenid);
	$respuestaid = $main->con_casilla(respuestaid,cotizaciones_respuestas,ordenid,$ordenid);
	$meto->borrar_cotizaciones_precios($respuestaid);
	echo "<h2>Se ha borrado la cotizacion de materiales numero $ordenid y sus respuestas</h2>";
?>