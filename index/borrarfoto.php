<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->login(); //entrar a base de datos construcali
	$fotoid = $_POST['fotoid2'];
	$empresaid = $_POST['empresaid2'];
	$meto->borrar_puntajes(1,$empresaid);
	$meto->borrar_fotos($fotoid);
	return true;
?>