<?php
// coger las columnas catid y categoria de la tabla articulo_categorias
	include("../modelos/class_paginas.php");
	$main = new pagina();
	$main->entrar(); // entrar a la base de datos de informacion
	$categorias = $main->con_matrix_dos(email,nombre,usuarios);

	foreach ($categorias as $categoria) { 
		// code...
		echo '|'.$categoria['email'].'|'.$categoria['nombre'].'|<br/>';
		// echo $categoria['nombre'].'<br />';
	}


	?>