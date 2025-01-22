<!--  Este archivo no se usa todavia --> 
<!-- Este es el archivo para calificar y recomendar empresas -->
<!-- Por ahora se usa empresas.php?content=nuevarecomendacion -->

<?php
	include("../modelos/class_paginas.php");
	include("../modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->entrar(); //entrar a la base de datos de servicios
	$cal = $_GET['calificacion'];
	$meto->calificar('evaluaciones','calificacion',$cal);
	//echo "<li>Se ha borrado el clasificado con el numero $ordenid</li>";
	echo $ordenid;
?>