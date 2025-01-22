<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->entrar(); //entrar a la base de datos servicios
	$ordenid = $_GET['productoid'];
	$meto->borrar_renglon('evaluaciones','productoid',$ordenid);
	//echo "<li>Se ha borrado el clasificado con el numero $ordenid</li>";
	echo $ordenid;
?>