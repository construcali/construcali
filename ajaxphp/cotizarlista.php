<?php

	session_start();
	include("../modelos/class_paginas.php");
	include("../modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$usuarioid = $_SESSION['usuario'];
#este codigo se usa para enviar la lista de materiales a cotizar desde tablero.in.php usando cotizarAnunciar.js
//procesar cotizacion de materiales
			$mensaje = '<h2>Su Cotizacion de Materiales se ha enviado</h2>';
			
			$titulo = $_POST['titulo'];
			$catid = $_POST['sector'];
			// si dejan la categoria de costruccion residencial
			// entonces que se envie la cotizacion a la categoria de ferreterias.
			if ($catid == 1) 
				$catid = 27;
			$departamento = $_POST['departamento'];
			$ciudad = $_POST['ciudad'];
			$telefono = $_POST['telefono'];
			//en caso de que escriban la ciudad
			$ciudad = strtolower($ciudad);
			$ciudad = ucfirst($ciudad);
			// Hacer la lista de materiales		
			$stock = array();
			$quantity = array();
			$unit = array();
			$j = 0;
			for ($i=1; $i<=5; $i++)
				{
					$stock[$j] = $_POST['insumo'.$i];
					$quantity[$j] = $_POST['precio'.$i];
					$unit[$j] = $_POST['unidad'.$i];
					$j=$j+1;
				}
			//entrar a base de datos de servicios
			$main->entrar();	
			//Registrar la cotizacion y obtener el numero de la cotizacion
			$date = date("Y-m-d G:i:s");
			$estado = 0;
			//registrar la cotizacion en la tabla de cotizaciones
			$cotizacionid = $meto->registrar_cotizacion($usuarioid,$date,$estado,$catid,$ciudad);
			//meter el numero de cotizacion y la lista de materiales
			//la tabla de cotizaciones_listas debe ser modificada para incluir cantidad y unidades en 
			//columnas separadas.
			for ($i=0; $i<=5; $i++){
				if ($stock[$i]){
						$output .= "<tr><td>".$stock[$i]."</td><td></td><td> ".$quantity[$i]." </td><td></td><td> ".$unit[$i]. "</td></tr>";
						$anuncio .= $stock[$i]."\t".$quantity[$i]."\t".$unit[$i]."\n";
						$item = $stock[$i];
						$qty = $quantity[$i]; // se crea una columna para unidades separada
						$unidad = $unit[$i]; // de cantidad, registrar en la tabla de cotizaciones_listas
						$meto->meter_cotizacion($cotizacionid,$item,$qty,$unidad);
					}
				}

			//conseguir informacion de usuario
		 	$contacto = $main->con_tabla_unid(usuarios,usuarioid,$usuarioid);
		 	$nombre = $contacto['nombre'];
		 	$apellidos = $contacto['apellidos'];
		 	$nombre = $nombre.' '.$apellidos;
		 	$email = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
		 	$telephone = $contacto['telefono'];
		 		if ($telephone != $telefono)
		 				$meto->actualizar_usuario_dato(telefono,$telefono,$usuarioid);
		 	$nombre = $nombre."\t".$apellidos;
			 
		 	//enviar cotizacion a empresas
		 	$link = '"http://construcali.com/inicio.php?content=responder&id=';	
			//$link = '"http://construcali.com/usuarios.php?content=actividades#material';	
			$link2 = $cotizacionid.'"';
		 	$contenido = '<div>Lista enviada por: ' .$nombre.'</div>'. "\n<br>"
				 .'<div>con el email: '.$email.'</div>'."\n<br>"
				 .'<div>con el telefono: '.$telefono.'</div>'."\n<br>"
				 .'<div>desde la ciudad: '.$ciudad.'</div>'."\n<br>"
				 .'<div>con el objectivo de cotizar</div>'."\n<br>"
				 .'<div><table><tr><td>Material</td><td></td><td>Cantidad</td><td></td><td>Unidad</td></tr>' .$output.'</table></div>'."\n"
				 .'Aproveche para promocionar su empresa'."\n<br>"
				 .'<div>Por favor haga click en el siguiente <a href='.$link.$link2.'>enlace</a> para responder</div>'."\n"
				 .'Aproveche para promocionar su Empresa'."\n<br>"
				 .'Construcali.com'."\n<br>"
				 .'La Construccion a su Alcance';
		
			$main->login(); //entrar a base de datos de construcali	 
			$sector = $main->con_casilla(categoria,categorias,catid,$catid);
			//meter la cotizacion en la tabla de anuncios
			//meter_anuncio necesita incorportar la cotizacionid para vincular la tabla de 
			//anuncios a la de cotizaciones y poder responderla despues
			$meto->meter_anuncio($titulo,$ciudad,$anuncio,$sector,$date,$usuarioid,$cotizacionid);
			//Enviar correo a empresas en esa categoria
			$subject = strtolower($titulo);
			$subject = ucfirst($subject);
			
			$headers = "Reply-To: admin@construcali.com". "\r\n";
			$headers .= "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";
			$direciones = $main->get_casillas_id(email,companies,clase,$catid);
			foreach ($direciones as $key => $carta) {
				mail($carta,$subject,$contenido,$headers);
			}

			$oficial = 'construcali.publicidad@gmail.com';
			mail($oficial,$subject,$contenido,$headers);

			echo $cotizacionid;

?>