<?php
session_start();
?>

<?php
	include("modelos/class_paginas.php");
	include("modelos/class_buscados.php");
	$main = new pagina();
	$busco = new buscado();
	$main->abrir(); //entrar a base de datos
	//saber si hay empresaid
	$loginid = $_SESSION['usuario'];
	$sihayempresaid = $_SESSION['empresaid'];
	//coger la informacion
	$articulos = $_POST['articulo'];
	//acomodar palabras_llaves
	$articulos = mysql_real_escape_string($articulos);
	$articulos = trim($articulos);
	//coger la palabra que se busca
	$keywords = split(' ', $articulos);
	$num_keywords = count($keywords);
		for($i=0; $i<$num_keywords; $i++)
		{
			if ($i != 0)
			{
				$palabras_claves .= "|".$keywords[$i];
			}
			else
			{
				$palabras_claves = $keywords[$i];
			}
		}

	//buscar los materiales o articulos que requieren
	$insumos = $busco->buscar_entabla(articulos,nombre,$palabras_claves,insumoid,0,10);
	if (count($insumos) == 0){
		echo '<h2>No se encontraron articulos con ese nombre, intentelo de nuevo</h2>';
	}else{
	//responder
	echo json_encode($insumos);
	//echo $palabras_claves;
	}
?>