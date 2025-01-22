<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->entrar(); //entrar a base de datos servicios
	$ordenid = $_GET['ordenid'];
	$meto->borrar_correos($ordenid);
	echo "<h2>Se ha borrado el correo con el numero $ordenid </h2>";
?>