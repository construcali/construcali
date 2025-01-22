<?php
// coger las columnas catid y categoria de la tabla articulo_categorias
	include("../modelos/class_paginas.php");
	$main = new pagina();
	$main->abrir(); // entrar a la base de datos de informacion
	$categorias = $main->con_matrix_dos(catid,categoria,articulos_categorias);

	foreach ($categorias as $categoria) { 
		// code...
		echo '|'.$categoria['catid'].'|'.$categoria['categoria'].'|<br/>';
	}


	?>