<?php
// coger las columnas catid y categoria de la tabla articulo_categorias
	include("../modelos/class_paginas.php");
	$main = new pagina();
	$main->abrir(); // entrar a la base de datos de informacion
	$categorias = $main->con_matrix_dos(catid,categoria,articulos_categorias);
	// crear array descripciones
	$descripciones =  array("lavamanos","Ladrillos","ventanas");
	$i = 0; // contador
	foreach($descripciones as $item_nombre){
		echo $item_nombre.'<br/>';
		if(in_array($item_nombre, $categorias)){
			echo 'Encontramos '.$item_nombre.', en las categorias esta,'.$categorias[$i]['categoria'].'<br />';
			$catid = $main->con_casilla(catid,articulos_categorias,categoria,$item_nombre);
			echo 'la catid de '.$item_nombre.' es '.$catid.'<br />'; 
		}
		$i = $i+1;
	}
	/*
	No funciono con in_array pienso que porque in_array es para un array unidimensional
	*/
	foreach ($categorias as $categoria) { 
		// bucle para $descripciones
		foreach ($descripciones as $item_nombre){
			$comparadas = strcasecmp($item_nombre, $categoria['categoria']);
			if ($comparadas == 0){
				//$catid = $main->con_casilla(catid,articulos_categorias,categoria,$item_nombre);
				echo 'La catid de '.$categoria['categoria'].' es '. $categoria['catid'].'<br />';
			}
		}
	}


	?>