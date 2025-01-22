<?php
	session_start();
	include("../modelos/class_paginas.php");
	include("../modelos/class_metidas.php");
	$usuarioid = $_SESSION['usuario'];
	$main = new pagina();
	$lista = new metida();

	if (empty($usuarioid)){
		echo "false";
	}else{
	//entrar a la base de datos de informacion
	$main->abrir();


	//el id de la categoria si viene de la pagina de articulos
		$claseid = $_POST['claseid'];
		//es mejor hacer el enlace a donde se envia la informacion, relativo.

		//La tabla y la cantidad de articulos en esa tabla que viene de la funcion articulos
		$counter = $_POST['counter'];
		
		//si hay usuarioid y se envio una categoria del formulario articulos via post
		if (isset($usuarioid) && isset($claseid)){
			
			if (!isset($_SESSION['carrito']))
			{
				$_SESSION['carrito'] = array();
				$_SESSION['cantidad'] = 0;
				$_SESSION['precio_total'] = '0.00';
				// $_SESSION['clases'] = array();
			}
			$k=1;
			for($i=0;$i<$counter;$i++){
					$insumoid = $_POST['insumoid'.$k];
					$cantidad = $_POST['cantidad'.$k];
					$precio = $_POST['precio'.$k];
					$k++;
					if(isset($cantidad) && $cantidad != 0){
						if(isset($_SESSION['carrito'][$insumoid]))
							$_SESSION['carrito'][$insumoid] += $cantidad;
						else
							$_SESSION['carrito'][$insumoid] = $cantidad;
					}//end if
			}//end for loop
			$_SESSION['precio_total'] = $lista->calcular_total($_SESSION['carrito']);
			$_SESSION['cantidad'] = $lista->contar_articulos($_SESSION['carrito']);
			// guardar la session de la claseid
			// $_SESSION['clases'] = $claseid;
			// conseguir el listado completo de articulos con su informacion en el carrito
			$mensaje_resultado = '<h2>se incluyeron los articulos en su lista <a href="https://construcali.com/analisis.php?content=lista">Ver Lista</a></h2> ';
			$articulos = $lista->hacer_lista($_SESSION['carrito']);
			echo $mensaje_resultado;
		}
	}
	?>