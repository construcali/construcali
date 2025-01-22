<?php
session_start();
?>

<!-- Se llama desde cotizarAnunciar.js -->
<?php
	include("../../modelos/class_paginas.php");
	$main = new pagina();
	$main->login(); //entrar a base de datos
	// procesar la cotizacion
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$departamentos = $main->con_tabla(departamentos);
			$categorias = $main->con_dos_tabla(catid,categoria,categorias);
			asort($categorias);
			// revisar si puso la informacion
			if (empty($_POST['email']) || empty($_POST['nombre']) || empty($_POST['telefono'])){
				$mensaje = 'Debe poner toda la informacion para poder cotizar';
				echo $mensaje;
			}else{
				
				//conseguir informacion de usuario
			 	$nombre =$_POST['nombre'];
			 	$email = $_POST['email'];
			 	$telefono = $_POST['telefono'];
			 	$ciudad = $_POST['ciudad'];
				
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
				//crear la tabla de la cotizacion
				for ($i=0; $i<=5; $i++){
					if ($stock[$i]){
							$output .= "<tr><td>".$stock[$i]."</td><td></td><td> ".$quantity[$i]." </td><td></td><td> ".$unit[$i]. "</td></tr>";
						}
					}
				 
			 	//enviar email de la cotizacion
			 	$contenido = '<div>Lista enviada por: ' .$nombre.'</div>'. "<br>"
					 .'<div>con el email: '.$email.'</div>'."<br>"
					 .'<div>con el telefono: '.$telefono.'</div>'."<br>"
					 .'<div>desde la ciudad: '.$ciudad.'</div>'."<br>"
					 .'<div>con el objectivo de cotizar</div>'."<br>"
					 .'<div><table><tr><td>Material</td><td>Cantidad</td><td>Unidad</td></tr>' .$output.'</table></div>'."<br>"
					 .'Aproveche para promocionar su empresa'."<br>"
					 .'construcali.com'."\n"
					 .'La Construccion a su Alcance';
				 
				
				//Enviar correo a empresas en esa categoria
				$subject = strtolower($titulo);
				$subject = ucfirst($subject);
				$headers = "Reply-To:".$email."\r\n";
				$headers .= "CC: construcali.publicidad@gmail.com "."\r\n";
				$headers .= "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";
				$direciones = $main->get_casillas_id(email,companies,clase,$catid);
				foreach ($direciones as $key => $carta) {
					mail($carta,$subject,$contenido,$headers);
				}

				//registrar al usuario si no se ha registrado antes
				$estado = $main->revisar_email($email);
				if (!isset($estado)){
					//generar clave 
					$password = str_shuffle($nombre);
					$estadousuario = $meto->meter_usuario($nombre,'apellidos',$ciudad,$email,$password);
					//enviar email de confirmacion
					if ($estadousuario){
						$mailcontent = 'Gracias por registrarse con nosotros'."\t".$nombre."\t".'esta es su informacion para entrar a construcali.com'."\n".'Nombre de Usuario:'."\t".$email."\t".'Clave:'."\t".$password."<br>".'construcali.com'."<br>".'La Construccion a su Alcance';
						$toaddress = 'construcali.publicidad@gmail.com';
						$subject =  'Nuevo Subscriptor';
						mail ($toaddress, $subject, $mailcontent);
						mail ($email, $subject, $mailcontent);
					}
				}
				$mensaje = 'Su Cotizacion de Materiales se ha enviado';
				echo $mensaje;
			} //closes else
			
	}else{
		$mensaje = 'Por favor envie una cotizacion';
		echo $mensaje;
	}
?>