<?php
session_start();
?>

<!--Beginning Header -->
<?php
	include("modelos/class_paginas.php");
	include("modelos/class_buscados.php");
	include("modelos/class_metidas.php");
	//definir una constante
	define("WWW_ROOT","https://construcali.com");
	$main = new pagina();
	$busco = new buscado();
	$lista = new metida();
	$main->login(); //entrar a base de datos de construcali
	//saber si hay empresaid
	$usuarioid = $_SESSION['usuario'];
	$loginid = $_SESSION['usuario'];
	$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
	include("vistas/analisis/header_analisis.php");
?>
<!--End of page header -->
<!-- Index
- content = presupuesto: linea 81
- Proceso de Cotizacion: Linea 155
- Lista de articulos: Linea 142 - content = lista
- Editar factura: Linea 262
 -->

<!--Beginning Main -->
<?php
	if (!isset($loginid)){
		include("vistas/login.inc.php");
	}
	else if (!isset($_REQUEST['content']))
	{	
		
		//categorias de empresas y departamentos
		$departamentos = $main->con_tabla(departamentos);
		$categorias = $main->con_dos_tabla(catid,categoria,categorias);
		asort($categorias); 
		//entrar a la base de datos de informacion
		$main->abrir();
		//conseguir las categorias de los materiales de construccion
		$etiquetas = $main->con_tabla_ordenada(articulos_categorias,categoria);
		//conseguir ciertas categorias de los materiales de construccion
		$categories = array (1,3,7,14,20,27,31,39,46,50,56,61,70,72,75);
		foreach ($categories as $catid){
			$secciones[$catid] = $main->con_casilla(categoria,articulos_categorias,catid,$catid); 
		}

		//si hay usuarioid
		if (isset($usuarioid)){
				// conseguir la informacion del cotizante
				$main->entrar();
				$nombre_cotizante = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
				$apellido_cotizante = $main->con_casilla(apellidos,usuarios,usuarioid,$usuarioid);
				$nombre = $nombre_cotizante.' '.$apellido_cotizante;
				$telefono = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
				$email = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
				$ciudad = $main->con_casilla(ciudad,usuarios,usuarioid,$usuarioid);
				include("vistas/analisis.inc.php");
		}else{
				$alerta = 'Inicio sesion para hacer presupuestos';
				include("vistas/analisis/precios.inc.php");
		}
		
	}
	else if($_REQUEST['content'] === 'articulos')
	{	
		// si es un request $_POST
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$claseid = $_POST['claseid'];
				// entrar a la base de datos, conseguir las categorias y los articulos
				$main->abrir();
				//conseguir las categorias de los materiales de construccion
				$etiquetas = $main->con_tabla_ordenada(articulos_categorias,categoria);
				//conseguir ciertas categorias de los materiales de construccion
				$categories = array (1,3,7,14,20,27,31,39,46,50,56,61,70,72,75);
				foreach ($categories as $catid){
					$secciones[$catid] = $main->con_casilla(categoria,articulos_categorias,catid,$catid); 
				}
				//conseguir los articulos
				$materiales = $main->con_tabla_id('articulos','catid',$claseid);
				include("vistas/analisis/articulos.inc.php");
			}else{
				//el id de la categoria si viene de una de los enlaces a las categorias
				$claseid = $_GET['id'];
				//entrar a la base de datos de informacion
				$main->abrir();
				//conseguir las categorias de los materiales de construccion
				$etiquetas = $main->con_tabla_ordenada(articulos_categorias,categoria);
				//conseguir ciertas categorias de los materiales de construccion
				$categories = array (1,3,7,14,20,27,31,39,46,50,56,61,70,72,75);
				foreach ($categories as $catid){
					$secciones[$catid] = $main->con_casilla(categoria,articulos_categorias,catid,$catid); 
				}
				//conseguir los articulos
				$materiales = $main->con_tabla_id('articulos','catid',$claseid);
				include("vistas/analisis/articulos.inc.php");
			}
		
	}
	else if ($_REQUEST['content'] === 'presupuesto')
	{
		//el id de la categoria si viene de la pagina de articulos
		$claseid = $_POST['claseid'];
		//es mejor hacer el enlace a donde se envia la informacion, relativo.

		//La tabla y la cantidad de articulos en esa tabla que viene de la funcion articulos
		$counter = $_POST['counter'];
		//cargar las categorias
		//entrar a la base de datos de informacion
		$main->abrir();
		//conseguir ciertas categorias de los materiales de construccion
		$categories = array (1,3,7,14,20,27,31,39,46,50,56,61,70,72,75);
			foreach ($categories as $catid){
					$secciones[$catid] = $main->con_casilla(categoria,articulos_categorias,catid,$catid); 
			}
		//conseguir las categorias de los materiales de construccion
		$etiquetas = $main->con_tabla(articulos_categorias);
		//si hay usuarioid y se envio una categoria del formulario articulos via post
		if (isset($usuarioid) && isset($claseid)){
			//conseguir los materiales en la tabla de articulos con la claseid
			$materiales = $main->con_tabla_id('articulos','catid',$claseid);
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
			// si si hay artticulos
			if ($_SESSION['cantidad'] > 0){
				// conseguir el listado completo de articulos con su informacion en el carrito
				$mensaje_resultado = '<h2>se incluyeron los articulos en su lista</h2>';
				$articulos = $lista->hacer_lista($_SESSION['carrito']);  
				include("vistas/analisis/articulos.inc.php");
			}else{
				$mensaje_resultado = '<h2>Por favor ponga una cantidad para incluir el articulo';
				include("vistas/analisis/articulos.inc.php");
			}
			
		}else{
			//Vamos a permitir a los visitantes ver los precios sin session
			$main->abrir();
			//conseguir las categorias de los materiales de construccion
			$etiquetas = $main->con_tabla(articulos_categorias);
			//conseguir los articulos
			$materiales = $main->con_tabla_id('articulos','catid',$claseid);
			//mensaje para la usuario o el usuario
			$mensaje_resultado = 'Debe entrar como usuaria o usuario para hacer una lista,  catid: '.$claseid;
			include("vistas/analisis/articulos.inc.php");
			//include("vistas/login.inc.php");
		}
	   
	}
	else if ($_REQUEST['content'] === 'lista')
	{
		//entrar a la base de datos de informacion
		$main->abrir();
		//conseguir las categorias de los materiales de construccion
		$etiquetas = $main->con_tabla_ordenada(articulos_categorias,categoria);
		//determinar si va a editar o cotizar
		$boton = $_POST['boton'];
		//conseguir ciertas categorias de los materiales de construccion
		$categories = array (1,3,7,14,20,27,31,39,46,50,56,61,70,72,75);
		foreach ($categories as $catid){
					$secciones[$catid] = $main->con_casilla(categoria,articulos_categorias,catid,$catid); 
			}
		//si hay usuarioid, hacer la lista de materiales con precios, costos y unidades
		if (isset($usuarioid) && empty($boton)){
			if (($_SESSION['cantidad'] > 0)){
				$_SESSION['precio_total'] = $lista->calcular_total($_SESSION['carrito']);
				$_SESSION['cantidad'] = $lista->contar_articulos($_SESSION['carrito']);
				$materiales = $lista->hacer_lista($_SESSION['carrito']);
				include("vistas/analisis/lista.inc.php");
			}else{
				$mensaje = 'Todavia no ha puesto materiales en su lista';
				//conseguir las categorias de los materiales de construccion
				//$etiquetas = $main->con_tabla(articulos_categorias);
				//conseguir ciertas categorias de los materiales de construccion
				$categories = array (1,3,7,14,20,27,31,39,46,50,56,61,70,72,75);
				foreach ($categories as $catid){
					$secciones[$catid] = $main->con_casilla(categoria,articulos_categorias,catid,$catid); 
					}
				include("vistas/analisis/analisis.inc.php");
			}
		}elseif(isset($usuarioid) && $boton == 'editar'){
			//conseguir cuantos renglones tiene la tabla
			$counter  = $_POST['counter'];
			//conseguir los nuevos valores de la tabla
			$k=1;
			for($i=0;$i<$counter;$i++){
					$insumoid = $_POST['insumoid'.$k];
					$cantidad = $_POST['cantidad'.$k];
					$precio = $_POST['precio'.$k];
					$k++;
					if(isset($cantidad)){
							$_SESSION['carrito'][$insumoid] = $cantidad;
					}//end if
			}//end for
			$_SESSION['precio_total'] = $lista->calcular_total($_SESSION['carrito']);
			$_SESSION['cantidad'] = $lista->contar_articulos($_SESSION['carrito']);
			$materiales = $lista->hacer_lista($_SESSION['carrito']);
			include("vistas/analisis/lista.inc.php");
		}elseif(isset($usuarioid) && $boton == 'cotizar'){
			//procesar cotizacion de materiales
			// Determinar si hay una categoria en el formulario
			$catid = 27;
			//conseguir la cantidad de renglones
			$counter = $_POST['counter'];
			// Hacer la lista de materiales		
			$stock = array();
			$quantity = array();
			$unit = array();
			$j = 0;
			for ($i=1; $i<=$counter; $i++)
				{
					$stock[$j] = $_POST['nombre'.$i];
					$quantity[$j] = $_POST['cantidad'.$i];
					$unit[$j] = $_POST['unidad'.$i];
					$j=$j+1;
				}
			//entrar a base de datos de servicios
			$main->entrar();
			//conseguir informacion de usuario
		 	$contacto = $main->con_tabla_unid(usuarios,usuarioid,$usuarioid);
		 	// Determinar la ciudad del usuario
			$ciudad = $contacto['ciudad'];
			$ciudad = strtolower($ciudad);
			$ciudad = ucfirst($ciudad);
			//Registrar la cotizacion y obtener el numero de la cotizacion
			$date = date("Y-m-d G:i:s");
			$estado = 0;
			//la tabla es cotizaciones
			$cotizacionid = $lista->registrar_cotizacion($usuarioid,$date,$estado,$catid,$ciudad);
			//meter el numero de cotizacion y la lista de materiales
			//$lista es la instancia en este controlador, en usuarios uso $meto
			//la tabla es cotizaciones_listas
			//creo el anuncio sin el html
			for ($i=0; $i<=$counter; $i++){
				if ($quantity[$i]){
						$output .= "<tr><td>".$stock[$i]. "</td><td>".$quantity[$i]. "</td><td>".$unit[$i]. "</td></tr>";
						$anuncio .= $stock[$i]."\t".$quantity[$i]."\t".$unit[$i]."\n";
						$item = $stock[$i];
						$qty = $quantity[$i]; // se crea una columna para unidades separada
						$unidad = $unit[$i]; // de cantidad
						$lista->meter_cotizacion($cotizacionid,$item,$qty,$unidad);
					}
				}

		 	$nombre = $contacto['nombre'];
		 	$apellidos = $contacto['apellidos'];
		 	$email = $contacto['email'];
		 	$telephone = $contacto['telefono'];
		 	$cotizante = $nombre."\t".$apellidos;
			
		 	//enviar cotizacion a empresas
		 	$link = '"http://construcali.com/inicio.php?content=responder&id=';	
			//$link = '"http://construcali.com/usuarios.php?content=actividades#material';	
			$link2 = $cotizacionid.'"';
		 	$contenido = '<div>Lista enviada por: ' .$cotizante.'</div>'. "\n"
				 .'<div>con el email: '.$email.'</div>'."\n"
				 .'<div>con el telefono: '.$telefono.'</div>'."\n"
				 .'<div>desde la ciudad: '.$ciudad.'</div>'."\n"
				 .'<div>con el objectivo de cotizar</div>'."\n"
				 .'<div><table><tr><td>Material</td><td>Cantidad</td><td>Unidad</td></tr>' .$output.'</table></div>'."\n"
				 .'Aproveche para promocionar su empresa'."\n"
				 .'<div>Por favor haga click en el siguiente <a href='.$link.$link2.'>enlace</a> para responder</div>'."\n"
				 .'Aproveche para promocionar su Empresa'."\n"
				 .'Construcali.COM'."\n"
				 .'La Construccion a su Alcance';
			$main->login(); //entrar a base de datos de construcali	 
			$sector = $main->con_casilla(categoria,categorias,catid,$catid);
			$titulo = 'Cotizacion en la categoria de '. $sector; 
			//meter la cotizacion en la tabla de anuncios, se hace creando el anuncio
			//sin el html 
			$lista->meter_anuncio($titulo,$ciudad,$anuncio,$sector,$date,$usuarioid,$cotizacionid); 
			//Enviar correo a empresas en esa categoria
			
			$subject = 'Cotizacion enviada por '. $cotizante; 
			$headers = "Reply-To: admin@construcali.com". "\r\n";
			$headers .= "CC: construcali.publicidad@gmail.com "."\r\n";
			$headers .= "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";
			$direciones = $main->get_casillas_id(email,companies,clase,$catid);
			foreach ($direciones as $key => $carta) {
				mail($carta,$subject,$contenido,$headers);
			}
	 		//mostrar pagina de lista de nuevo
	 		//entar de nuevo a informacion
	 		$main->abrir();
	 		$_SESSION['precio_total'] = $lista->calcular_total($_SESSION['carrito']);
			$_SESSION['cantidad'] = $lista->contar_articulos($_SESSION['carrito']);
			$materiales = $lista->hacer_lista($_SESSION['carrito']);
			$mensaje = '<h2>Su Cotizacion de Materiales se ha enviado</h2>';
			include("vistas/analisis/lista.inc.php");
		}elseif(isset($usuarioid) && isset($boton)){
			//echo $boton; si coge el valor especifico de ese boton con el nombre boton que se cliquea
			//Quitar el ese insumo de la session, $boton ahora tiene el $insumoid
			unset($_SESSION['carrito'][$boton]);
			$main->abrir();
	 		$_SESSION['precio_total'] = $lista->calcular_total($_SESSION['carrito']);
			$_SESSION['cantidad'] = $lista->contar_articulos($_SESSION['carrito']);
			$materiales = $lista->hacer_lista($_SESSION['carrito']);
			$articulo = $main->con_casilla(nombre,articulos,insumoid,$boton);
			$mensaje = '<h2>Se ha borrado el articulo: '.$articulo.'</h2>';
			include("vistas/analisis/lista.inc.php");
		}
		else{
				include("vistas/login.inc.php");
		}
	   
	}
	else if($_REQUEST['content'] === 'factura')
	{
		$boton = $_GET['boton']; // para editar la factura
		$guardar = $_POST['guardar']; // par guarrdar la edicion de la factura
		$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
		if (isset($sihayempresaid)){
			$company = $main->con_tabla_unid(companies,empresaid,$sihayempresaid);
			$logo = $main->con_casilla(foto,logos,empresaid,$sihayempresaid);
			$logo = 'http://construcali.com/logo/'.$logo;
		}
		if (empty($logo))
			$logo = 'http://construcali.com/logo/LogoCasco.png';
	   //si hay usuarioid
		if (isset($usuarioid) && $boton == 'editar'){
				//conseguir la informacion del carrito
				$main->abrir();
		 		$_SESSION['precio_total'] = $lista->calcular_total($_SESSION['carrito']);
				$_SESSION['cantidad'] = $lista->contar_articulos($_SESSION['carrito']);
				$materiales = $lista->hacer_lista($_SESSION['carrito']);
				//cuante rapida con el iva del 16%
				$precio_subtotal = $_SESSION['precio_total'];
				$iva = (19 * $precio_subtotal)/100;
				$precio_coniva = $precio_subtotal + ($iva);
				//conseguir la informacion del usuario
				$main->entrar();
				//conseguir informacion de usuario
		 		$contacto = $main->con_tabla_unid(usuarios,usuarioid,$usuarioid);
				include("vistas/analisis/carrito.inc.php");
		}elseif (isset($usuarioid) && $guardar == 'factura'){
				$main->abrir();
		 		$_SESSION['precio_total'] = $lista->calcular_total($_SESSION['carrito']);
				$_SESSION['cantidad'] = $lista->contar_articulos($_SESSION['carrito']);
				$materiales = $lista->hacer_lista($_SESSION['carrito']);
				//informacion fecha y numero de factura
				$fecha = $_POST['fecha'];
				$numero_factura = $_POST['numero_factura'];
				//informacion usuario
		 		$nombre = $_POST['nombre'];
		 		$apellidos = $_POST['apellidos'];
		 		$telefono = $_POST['telefono'];
		 		$email = $_POST['email'];
		 		$direcion = $_POST['direcion'];
		 		$barrio = $_POST['barrio'];
		 		$ciudad = $_POST['ciudad'];
		 		$departamento = $_POST['departamento'];
		 		//informacion de la empresa
		 		$compania_empresa = $_POST['compania_empresa'];
		 		$compania_direcion = $_POST['compania_direcion'];
		 		$compania_telefono = $_POST['compania_telefono'];
		 		$compania_ciudad = $_POST['compania_ciudad'];
		 		$compania_url = $_POST['compania_url'];
		 		$compania_email = $_POST['compania_email'];
		 		//mensaje o instrucciones
				$mensaje_factura =  $_POST['mensaje_factura'];
				//conseguir los materiales y sus precios
				$counter = $_POST['counter'];
				// Hacer la lista de materiales		
				$stock = array();
				$quantity = array();
				$unit = array();
				$precio = array();
				$subtotal = array();
				$j = 0;
				for ($i=1; $i<=$counter; $i++)
					{
						$stock[$j] = $_POST['material'.$i];
						$quantity[$j] = $_POST['cantidad'.$i];
						$unit[$j] = $_POST['unidad'.$i];
						$precio[$j] = $_POST['precio'.$i];
						$subtotal[$j] = $_POST['subtotal'.$i];
						$j=$j+1;
					}
				//conseguir los totales y el iva
				$valor = $_POST['valor'];
				$total = $_POST['total'];
				$iva = $_POST['iva'];
				include("vistas/analisis/factura.inc.php");
		}
		else{
				$logo = 'LogoCasco.png'; // redifinirlo porque en login le anteponene logo/
				include("vistas/login.inc.php");
		}
	}
	else if($_REQUEST['content'] === 'cotizar'){
		include("vistas/analisis/cotizar.inc.php");
	}
	else if($_REQUEST['content'] === '')
	{
		if (isset($usuarioid)){
			echo "error 404 - Pagina no encontrada";
		}else{
			include("vistas/login.inc.php");
		}
		
	}
?>
<!--End Main -->

<!-- Start of page footer -->
<?php include("vistas/footer.html"); ?>
<!-- End of page footer -->
