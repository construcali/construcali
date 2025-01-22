<?php
// coger las columnas catid y categoria de la tabla articulo_categorias
	include("../modelos/class_paginas.php");
	$main = new pagina();
	$main->login(); // entrar a la base de datos de informacion
	
	$empresas = $main->con_matrix_tres(empresaid,empresa,contacto,companies);

	foreach ($empresas as $empresa) { 
		// code...
		// echo '|'.$empresa['empresaid'].'|'.$empresa['empresa'].'|'.$empresa['email'].'|<br/>';
		// echo '&nbsp;'.$empresa['empresaid'].'&nbsp;'.$empresa['empresa'].'&nbsp;'.$empresa['email'].'&nbsp;<br/>';
		echo $empresa['contacto'].'<br/>';
	}


	?>