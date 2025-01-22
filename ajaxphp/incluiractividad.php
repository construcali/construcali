<?php
session_start();
?>

<?php
	include("../modelos/class_paginas.php");
	include("../modelos/class_metidas.php");
	$main = new pagina();
	$lista = new metida();
	$main->abrir(); //entrar a base de datos
	//coger la info de javascript incluirArticulo.js
	// incluir articulo coge la informacion de detallados.inc.php
	$insumoid = $_POST['materialid'];
	$actividad = $_POST['material'];
	$unidad = $_POST['medida'];
	$precio = $_POST['costo'];
	// establecer si no hay sessiones todavia
	if (!isset($_SESSION['presupuesto']))
			{
				$_SESSION['presupuesto'] = array();
				$_SESSION['actividades'] = array();
				$_SESSION['qty'] = 0;
				$_SESSION['valor_obra'] = '0.00';
			}
	// poner articulo en la session
	$cantidad = 1;
	if(isset($_SESSION['presupuesto'][$insumoid]))
		$_SESSION['presupuesto'][$insumoid] += $cantidad;
	else
		$_SESSION['presupuesto'][$insumoid] = $cantidad;
	// llenar array
	$_SESSION['actividades'][$insumoid] = $actividad; 
	//calcular totales
	$_SESSION['valor_obra'] = $lista->calcular_valor_total($_SESSION['presupuesto'],precio,analisis,insumoid); //carrito,precio,tabla,id
	$_SESSION['qty'] = $lista->contar_articulos($_SESSION['presupuesto']);

	$usuarioid = $_SESSION['usuario'];
	if (empty($usuarioid)){
		echo "false";
	}else{
		echo "true";
	}
?>