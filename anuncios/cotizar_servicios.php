<?php
session_start();
?>

<?php
	include("../../modelos/class_paginas.php");
	$main = new pagina();
	$main->login(); //entrar a base de datos

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//conseguir departamentos y categorias
			$departamentos = $main->con_tabla(departamentos);
			$categorias = $main->con_tabla(categorias);
			asort($categorias);
			// revisar si puso la informacion
			if (empty($_POST['email']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['titulo'])) {
				$mensaje = '<h2>Debe poner toda la informacion para poder cotizar</h2>';
				echo $mensaje;
			}else{
				//procesar cotizacion de servicios
				//conseguir informacion de usuario
			 	$nombre =$_POST['nombre'];
			 	$email = $_POST['email'];
			 	$telefono = $_POST['telefono'];
			 	$ciudad = $_POST['ciudad'];

				$mensaje = '<h2>Su cotizacion se ha enviado</h2>';
				$usuarioid = $_SESSION['usuario'];
				$titulo = $_POST['titulo'];
				$catid = $_POST['sector'];
				$descripcion = $_POST['descripcion'];
				$ciudad = $_POST['ciudad'];
				//conseguir el nombre de la categoria con catid
				$sector = $main->con_casilla(categoria,categorias,catid,$catid);
				$servicio = htmlspecialchars($descripcion);
				if (get_magic_quotes_gpc())
						{
							$servicio = stripslashes($servicio);
							$titulo = stripslashes($titulo);
						}
				$servicio = mysql_real_escape_string($servicio);
				$titulo = mysql_real_escape_string($titulo);
				$servicio = strtolower($servicio);
				$servicio = ucfirst($servicio);
				$ciudad = strtolower($ciudad);
				$ciudad = ucfirst($ciudad);
				
			 	//enviar cotizacion de servicios a empresas
			
			 	$contenido =  'Cotizacion enviada por: ' .$nombre. "\n"
					 .'con el email: '.$email. "\n"
					 .'con el telefono: '.$telefono. "\n"
					 .'desde la ciudad de: '.$ciudad. "\n"
					 .'con el objectivo de cotizar '."<br>"
					 .$titulo . "<br>"
					 .$servicio . "<br>"
					 .'Aproveche para promocionar su empresa'."<br>"
					 .'construcali.com'."<br>"
					 .'La Construccion a su Alcance';
					 
				$subject = strtolower($titulo);
				$subject = ucfirst($subject);
				$headers = "Reply-To: admin@construcali.com". "\r\n";
				$headers .= "CC: construcali.publicidad@gmail.com "."\r\n";
				$headers .= "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";
				$direciones = $main->get_casillas_id(email,companies,clase,$catid);
				foreach ($direciones as $key => $direcion) {
					mail($direcion,$subject,$contenido,$headers);
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
				echo $mensaje;
				//include("vistas/cotizar.inc.php");
			} // closes else
		}

?>