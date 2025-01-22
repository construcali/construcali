<?php
session_start();
?>

<?php
	include("../modelos/class_paginas.php");
	include("../modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->login(); //entrar a base de datos

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// revisar si puso la informacion
			if (empty($_POST['descripcion']) || empty($_POST['ciudad'])) {
				$mensaje = '<h2>Debe poner toda la informacion para poder cotizar</h2>';
				echo $mensaje;
			}else{
				
				$usuarioid = $_SESSION['usuario'];
				$catid = $_POST['sector'];
				$descripcion = $_POST['descripcion'];
				$ciudad = $_POST['ciudad'];
				//conseguir el nombre de la categoria con catid
				$sector = $main->con_casilla(categoria,categorias,catid,$catid);
				// titulo del mensaje
				$titulo = 'Cotizacion de '.$sector;

				$servicio = htmlspecialchars($descripcion);
				if (get_magic_quotes_gpc())
						{
							$servicio = stripslashes($servicio);
						}
				$servicio = mysql_real_escape_string($servicio);
				$servicio = strtolower($servicio);
				$servicio = ucfirst($servicio);
				$ciudad = strtolower($ciudad);
				$ciudad = ucfirst($ciudad);
				// conseguir el departamento para mas adelanto usarlo cuando se envien las cotizaciones
				$provincia = $_POST['departamento'];
				
				//registar la cotizacion y obtener el numero de la cotizacion
				$date = date("Y-m-d G:i:s");
				$estado = 0;
				
				// se mete la cotizacion en la tabla de pedidos
				$main->entrar(); //entrar a base de datos de servicios
				// registra la cotizacion en la tabla de pedidos y 
				// obtiene una id que usa como cotizacionid en la tabla de anouncements
				$cotizacionid = $meto->meter_pedido(pedidos,$titulo,$ciudad,$servicio,$catid,$date,$usuarioid);
				//conseguir informacion de usuario
			 	$contactos = $main->con_tabla_id(usuarios,usuarioid,$usuarioid);
			 	foreach ($contactos as $contacto)
			 	{
			 		$nombre = $contacto['nombre'];
			 		$apellidos = $contacto['apellidos'];
			 		$email = $contacto['email'];
			 		$telefono = $contacto['telefono'];
			 		$nombre = $nombre."\t".$apellidos;
			 	}
			 	//enviar cotizacion de servicios a empresas
			 	$link = '"http://construcali.com/cotizaciones.php?content=anouncements#servicio';
			 	$link2 = $cotizacionid.'"'; 
			 	//'http://construcali.com/usuarios.php?content=actividades';
			
			 	$contenido =  'Cotizacion enviada por: ' .$nombre. "\n<br>"
					 .'con el email: '.$email. "\n<br>"
					 .'con el telefono: '.$telefono. "\n<br>"
					 .'desde la ciudad de: '.$ciudad. "\n<br>"
					 .'con el objectivo de cotizar '."\n<br>"
					 .$titulo . "\n<br>"
					 .'Porfavor Haga click en el siguiente' . "\n<br>"
					 .'<a href='.$link.$link2.'>Enlace</a> para ver el servicio requerido y responderlo.'."\n<br>"
					 .'Aproveche para promocionar su empresa'."\n<br>"
					 .'Construcali.com'."\n<br>"
					 .'La Construccion a su Alcance';
				$main->login(); //entrar a base de datos de construcali	
				//Aqui se mete la cotizacion a anouncements
				// la funcion esta en el modelo class_metidas, linea 41
				// cotizacionid es para relacioner la tabla de anouncements a pedidos
				$meto->meter_proyecto(anouncements,$titulo,$ciudad,$servicio,$sector,$date,$usuarioid,$cotizacionid); 
				//$subject = strtolower($titulo);
				//$subject = ucfirst($subject);
				$headers = "Reply-To: admin@construcali.com". "\r\n";
				$headers .= "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";
				$direciones = $main->get_casillas_id(email,companies,clase,$catid);
				foreach ($direciones as $key => $direcion) {
					mail($direcion,$titulo,$contenido,$headers);
				}
				//enviar reporte a
				$oficial = 'construcali.publicidad@gmail.com';
				mail($oficial,$titulo,$contenido,$headers);

				$mensaje = '<h2>Su cotizacion de servicios se ha enviado a las empresas en la categoria de '.$sector.' y recibira una respuesta de ellas a su correo electronico</h2>';
				echo $mensaje;	 
			} // closes else
		}

?>