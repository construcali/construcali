<?php
session_start();
?>

<!--Beginning Header -->
<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	include("modelos/class_buscados.php");
	$main = new pagina();
	$busco = new buscado();
	$meto = new metida();
	$main->login(); //entrar a base de datos
	//saber si hay empresaid
	$loginid = $_SESSION['usuario'];
	$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
	include("vistas/header.php");
?>
<!--End of page header -->
<!-- 
content = unproducto 206
content = unservicio 223
content = buscar 244
#anunciar - linea 314
content = anunciar-servicios - linea 596
content = cotizar - linea 323
#se cotizan materiales en vistas/anuncios/cotizando.php
content = anuncios - 351
#cotizar_servicios - 436
-->
<!--Beginning Main -->
<?php
//puedo usar un switch structure
	if (!isset($loginid)){
		include("vistas/login.inc.php");
	}
	else if (!isset($_REQUEST['content']))
	{	
		
		$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
		$categorias = $main->get_casillas(sector,productos);
		//conseguir la categoria de la tabla de servicios
		$categories = $main->get_casillas(sector,servicios);
		//conseguir la informacion de productos y servicios a la venta
		if (!isset ($_GET['page']))
	   	  $thispage = 1;
   	   	else
	      $thispage = $_GET['page'];
		$recordsperpage = 15;
		$offset = ($thispage-1) * $recordsperpage;
		//consigue los clasificados de productos y servicios
		$result_req = $main->conseguir_los_anuncios($offset,$recordsperpage);
		//contar los renglones de productos y servicios
		$productos_records = $main->contar_records(productoid,productos);
		$servicios_records = $main->contar_records(productoid,servicios);
		$totrecords = $productos_records + $servicios_records;
	    $totpages = ceil($totrecords/$recordsperpage); 
		$requeridas = array();
		$i=0;
		while ($servicio = mysql_fetch_array($result_req,MYSQL_ASSOC)){
            $productoid = $servicio['productoid'];
            //de que tabla viene
            if ($servicio['tipo'] == 'articulo'){
            	$requeridas[$i]['anouncement'] = $main->con_casilla(producto,productos,productoid,$productoid);
            }
            elseif ($servicio['tipo'] == 'labor'){
            	$requeridas[$i]['anouncement'] = $main->con_casilla(servicio,servicios,productoid,$productoid);//el nombre de este index cambia en cada tabla
            }
            $requeridas[$i]['titulo'] = $servicio['titulo'];
            $requeridas[$i]['ciudad'] = $servicio['ciudad'];
            $requeridas[$i]['usuarioid'] = $servicio['usuarioid'];
            $requeridas[$i]['sector'] = $servicio['sector'];
            $requeridas[$i]['fecha'] = $servicio['date'];
            $requeridas[$i]['productoid'] = $servicio['productoid'];
            $requeridas[$i]['clase'] = $servicio['tipo'];
            //conseguir la foto 
            // $requeridas[$i]['photo'] = $servicio['foto'];
            //conseguir info de la empresa del userid si la hay
            $userid = $servicio['usuarioid'];
            $requeridas[$i]['companyid'] = $main->con_casilla(empresaid,companies,usuarioid,$userid); 
            $main->entrar();
                $requeridas[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
                $requeridas[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
                $requeridas[$i]['email'] = $main->con_casilla(email,usuarios,usuarioid,$userid);
            $main->login(); //necesita otra ves entrar a la basde de datos donde esta productos y servicios
                $i++;
        }
             
		include("vistas/anuncios/anuncios.inc.php");
	}
	else if($_REQUEST['content'] === 'productos')
	{
	    $sector = $_GET['sector'];
	    //conseguir la categoria de la tabla de productos
	    $categorias = $main->get_casillas(sector,productos);
		//conseguir la categoria de la tabla de servicios
		$categories = $main->get_casillas(sector,servicios);
	    if (!isset ($_GET['page']))
	   	  $thispage = 1;
   	    else
	      $thispage = $_GET['page'];
	    $recordsperpage = 15;
	    $offset = ($thispage-1) * $recordsperpage;
	   	   //funcion para hacer la paginacion
	    if (empty($sector))
	   		$totrecords = $main->contar_records(productoid,productos);
	    else
	   		$totrecords = $main->contar_ids(productoid,productos,sector,$sector);
	    $totpages = ceil($totrecords/$recordsperpage); 
	   //conseguir informacion de productos
	    if (empty($sector))
	   		$anouncements = $main->con_info_desc(productos,date,$offset,$recordsperpage);
	    else
	   		$anouncements = $main->con_donde_order_limit(productos,sector,$sector,date,$offset,$recordsperpage);
	   $clasificados = array();
	   $i=0;
	   foreach ($anouncements as $anouncement) {
	   			$productoid = $anouncement['productoid'];
	   			$clasificados[$i]['productoid'] = $productoid;
                $clasificados[$i]['titulo'] = $anouncement['titulo'];
                $clasificados[$i]['ciudad'] = $anouncement['ciudad'];
                $usuarioid = $anouncement['usuarioid'];
                $clasificados[$i]['usuarioid'] = $usuarioid;
                $clasificados[$i]['producto'] = $anouncement['producto'];
                $clasificados[$i]['sector'] = $anouncement['sector'];
                $clasificados[$i]['fecha'] = $main->get_fecha(productos,$productoid);
                $main->entrar();
                $clasificados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
                $main->login(); //necesita otra ves entrar a la basde de datos donde esta productos y servicios
                $i++;
            }     
	   
	    //$fotos = $main->con_info_desc(boletines,productoid,0,8); 
	   include("vistas/anuncios/estosproductos.inc.php"); 
	}
	else if($_REQUEST['content'] === 'servicios')
	{
	   $sector = $_GET['sector'];
	   //conseguir la categoria de la tabla de productos
	   $categorias = $main->get_casillas(sector,productos);
		//conseguir la categoria de la tabla de servicios
	   $categories = $main->get_casillas(sector,servicios);
	   //funcion para hacer la paginacion
	   if (!isset ($_GET['page']))
	   	 $thispage = 1;
   	   else
	     $thispage = $_GET['page'];
	   $recordsperpage = 15;
	   $offset = ($thispage-1) * $recordsperpage;
	   if (empty($sector))
	   		$totrecords = $main->contar_records(productoid,servicios);
	   else
	   		$totrecords = $main->contar_ids(productoid,servicios,sector,$sector);
	   $totpages = ceil($totrecords/$recordsperpage);
	   //con_empresa sirve para cualquier tabla
	   if (empty($sector))
	   		$anouncements = $main->con_info_desc(servicios,date,$offset,$recordsperpage);
	   else
	   		$anouncements = $main->con_donde_order_limit(servicios,sector,$sector,date,$offset,$recordsperpage);
	   $clasificados = array();
	   $i=0;
	   foreach ($anouncements as $anouncement) {
	   			$productoid = $anouncement['productoid'];
	   			$clasificados[$i]['productoid'] = $productoid;
                $clasificados[$i]['titulo'] = $anouncement['titulo'];
                $clasificados[$i]['ciudad'] = $anouncement['ciudad'];
                $usuarioid = $anouncement['usuarioid'];
                $clasificados[$i]['usuarioid'] = $usuarioid;
                $clasificados[$i]['servicio'] = $anouncement['servicio'];
                $clasificados[$i]['sector'] = $anouncement['sector'];
                $clasificados[$i]['fecha'] = $main->get_fecha(servicios,$productoid);
                $main->entrar();
                $clasificados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
               $main->login(); //necesita otra ves entrar a la basde de datos donde esta productos y servicios
                $i++;
            }
       
        //$fotos = $main->con_info_desc(boletines,productoid,0,8);          
	   
	   include("vistas/anuncios/estosservicios.inc.php"); 
	}
	else if($_REQUEST['content'] === 'unanuncio')
	{
		// esta seccion de un anuncio ya no se esta usando
		$productoid = $_GET['id'];
		$clasificado = $main->con_tabla_id(anuncios,productoid,$productoid);
		$usuarioid = $clasificado[0]['usuarioid'];
		$clasificado[0]['fecha'] = $main->get_fecha(anuncios,$productoid);
		$main->entrar();
		$clasificado[0]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
		$clasificado[0]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
		$clasificado[0]['email'] = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
		//url para compartir el anuncio en las redes sociales
		$url = 'http://construcali.com/cotizaciones.php?content=unanuncio&id='.$productoid;
		include('vistas/anuncios/unanuncio.inc.php');
	}
	else if($_REQUEST['content'] === 'unanouncement')
	{
		// esta seccion de un announcement ya no se esta usando
		$productoid = $_GET['id'];
		$clasificado = $main->con_tabla_id(anouncements,productoid,$productoid);
		$userid = $clasificado[0]['usuarioid'];
		$hayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$userid);
		$clasificado[0]['fecha'] = $main->get_fecha(anouncements,$productoid);
		if (isset($hayempresaid)){ $nombre_empresa = $main->con_casilla(empresa,companies,empresaid,$hayempresaid);}
		$main->entrar();
		$clasificado[0]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
		$clasificado[0]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
		$clasificado[0]['email'] = $main->con_casilla(email,usuarios,usuarioid,$userid);//email del anunciante
		$url = 'http://construcali.com/cotizaciones.php?content=unanouncement&id='.$productoid;
		include('vistas/anuncios/unanouncement.inc.php');
	}
	else if($_REQUEST['content'] === 'unproducto')
	{
		$productoid = $_GET['id'];
		$clasificado = $main->con_tabla_id(productos,productoid,$productoid);
		$userid = $clasificado[0]['usuarioid'];
		$hayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$userid);
		
		$clasificado[0]['fecha'] = $main->get_fecha(productos,$productoid);
		// nombre de usuario
        $nombre = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
		if (isset($hayempresaid)){ 
			$nombre_empresa = $main->con_casilla(empresa,companies,empresaid,$hayempresaid);
			$nombre_empresa = htmlentities($nombre_empresa);
		}
		 // conseguir el whatsapp
        $whatsapp = $main->con_casilla(whatsapp,redessociales,empresaid,$hayempresaid);
        $whatsapp = trim($whatsapp);
        // replace - for empty space
        $forwhatsapp = str_replace('-', ' ', $whatsapp);
        $wsnumber = explode(" ", $forwhatsapp);
        $whatsapp = implode($wsnumber);
        $whatsapp = substr($whatsapp,0, 10);
        $whatsapp = '57'.$whatsapp;
		$main->entrar();
		$clasificado[0]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$uerid);
		$clasificado[0]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
		$clasificado[0]['email'] = $main->con_casilla(email,usuarios,usuarioid,$userid);//email del anunciante
		$url = 'http://construcali.com/anuncios.php?content=unproducto&id='.$productoid;
		include('vistas/anuncios/unproducto.inc.php');
	}
	else if($_REQUEST['content'] === 'unservicio')
	{
		$productoid = $_GET['id'];
		$clasificado = $main->con_tabla_id(servicios,productoid,$productoid);
		$userid = $clasificado[0]['usuarioid'];
		$hayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$userid);
		$clasificado[0]['fecha'] = $main->get_fecha(servicios,$productoid);
		if (isset($hayempresaid)){ 
			$nombre_empresa = $main->con_casilla(empresa,companies,empresaid,$hayempresaid);
			$nombre_empresa = htmlentities($nombre_empresa);
		}
		$main->entrar();
		$clasificado[0]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
		$clasificado[0]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
		$clasificado[0]['email'] = $main->con_casilla(email,usuarios,usuarioid,$userid);//email del anunciante
		$url = 'http://construcali.com/anuncios.php?content=unservicio&id='.$productoid;
		include('vistas/anuncios/unservicio.inc.php');
	}
	else if($_REQUEST['content'] === 'buscar')
	{
		$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
		$categorias = $main->get_casillas(sector,productos);
		//conseguir la categoria de la tabla de servicios
		$categories = $main->get_casillas(sector,servicios);
		//coger terminos a buscar
		$palabras_llaves = $_POST['palabraClave'];
		//acomodar palabras_llaves
		$palabras_llaves = mysql_real_escape_string($palabras_llaves);
		$palabras_llaves = trim($palabras_llaves);
		//coger la palabra que se busca
		$keywords = split(' ', $palabras_llaves);
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
		//busar en los productos que han anunciado
		$anouncements = $busco->buscar_entabla_or_limit(productos,producto,titulo,$palabras_claves,date,0,15);
		$clasificados = array();
	    $i=0;
	    foreach ($anouncements as $anouncement) {
	   			$productoid = $anouncement['productoid'];
                $clasificados[$i]['titulo'] = $anouncement['titulo'];
                $clasificados[$i]['ciudad'] = $anouncement['ciudad'];
                $userid = $anouncement['usuarioid'];
                $clasificados[$i]['usuarioid'] = $usuarioid;
                $clasificados[$i]['anouncement'] = $anouncement['producto'];//el nombre de este index cambia en cada tabla
                $clasificados[$i]['sector'] = $anouncement['sector'];
                $clasificados[$i]['fecha'] = $main->get_fecha(productos,$productoid);
                $clasificados[$i]['productoid'] = $productoid;
                $main->entrar();
                $clasificados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
                $clasificados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
                $clasificados[$i]['email'] = $main->con_casilla(email,usuarios,usuarioid,$userid);
                $main->login();
                $i++;
            }
        //buscar en los servicios que ofrecen
        $servicios = $busco->buscar_entabla_or_limit(servicios,servicio,titulo,$palabras_claves,date,0,15);
        $serficados = array();
        $i=0;
	    foreach ($servicios as $servicio) {
	   			$productoid = $servicio['productoid'];
                $serficados[$i]['titulo'] = $servicio['titulo'];
                $serficados[$i]['ciudad'] = $servicio['ciudad'];
                $userid = $anouncement['usuarioid'];
                $serficados[$i]['usuarioid'] = $usuarioid;
                $serficados[$i]['anouncement'] = $servicio['servicio'];//el nombre de este index cambia en cada tabla
                $serficados[$i]['sector'] = $servicio['sector'];
                $serficados[$i]['fecha'] = $main->get_fecha(servicios,$productoid);
                $serficados[$i]['productoid'] = $productoid;
                $main->entrar();
                $serficados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
                $serficados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
                $serficados[$i]['email'] = $main->con_casilla(email,usuarios,usuarioid,$userid);
                $main->login();
                $i++;
            } 
			
			if ((count($anouncements) == 0) && (count($servicios) == 0)){
				$mensaje_resultado = 'No se encontraron resultados para '.$palabras_llaves.' en la busquedad';
			}else{
				$mensaje_resultado = 'Se encontraron los siguientes resultados para '.$palabras_llaves;
			}        
            include("vistas/anuncios/rescontenido.inc.php");
	}else if ($_REQUEST['content'] === 'cotizar'){
		$departamentos = $main->con_tabla(departamentos);
		$categorias = $main->con_dos_tabla(catid,categoria,categorias); 
		asort($categorias);
		if (isset($_SESSION['usuario'])){
				$id_de_usuario = $_SESSION['usuario'];
				mail('construcali.publicidad@gmail.com', 'Click en el enlace de cotizar', $id_de_usuario.' dio click en cotizar');
				include("vistas/analisis/analisis.inc.php");
		}else{
			include("vistas/cotizar.inc.php");
		}
	}else if ($_REQUEST['content'] === 'anunciar'){
		// anunciar.inc.php muestra el formulario adecuado para usuarios y no usuarios
		// categorias de los proudctos en clasificados
		$categories = $main->get_casillas(sector,productos);
		$departamentos = $main->con_tabla(departamentos);
		// categorias generales de la construccion
		$categorias = $main->con_tabla(categorias);
		asort($categorias);
		$usuarioid = $_SESSION['usuario'];
		if (isset($usuarioid)){
			$id_de_usuario = $_SESSION['usuario'];
			mail('construcali.publicidad@gmail.com', 'Click en el enlace de cotizar', $id_de_usuario.' dio click en cotizar');
			//entrar a bd de servicios
			$main->entrar();
			$telephone = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
			$city = $main->con_casilla(ciudad,usuarios,usuarioid,$usuarioid);
		}
		include("vistas/anuncios/anunciar.inc.php");
	}else if ($_REQUEST['content'] === 'anuncios'){
		#coger el id de quien maneja la empresa
		$userid = $_GET['userid'];
		#contar todos los anuncios puestos enproductos por este userid
		$totrecords = $main->contar_ids(productoid,productos,usuarioid,$userid);
		if(!isset($_GET['page']))
			$thispage = 1;
		else
			$thispage = $_GET['page'];
		$recordsperpage = 10;
		#hacer la paginacion
		$offset = ($thispage-1)*$recordsperpage;
		$totpages = ceil($totrecords/$recordsperpage);
		#termina paginacion
		 //conseguir la categoria de la tabla de productos
	    $categorias = $main->get_casillas(sector,productos);
		//conseguir la categoria de la tabla de servicios
		$categories = $main->get_casillas(sector,servicios);
		//nombre de la empresa
        $companyid = $main->con_casilla(empresaid,companies,usuarioid,$userid);
        $company = $main->con_casilla(empresa,companies,empresaid,$companyid);
        //coger la informacion de la tabla productos
        $clasificados = $main->con_donde_order_limit(productos,usuarioid,$userid,date,$offset,$recordsperpage);
        //entrar a base de datos de servicios y coger la info del userid
        $main->entrar();
        $nombre = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
        $telefono = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
        $email = $main->con_casilla(email,usuarios,usuarioid,$userid);
		
		include("vistas/anuncios/anuncios.inc.php");
	}else if ($_REQUEST['content'] === 'cotizar_servicios'){
		
	}else if ($_REQUEST['content'] === 'anunciar_productos'){
		// a esete modulo se llega desde anunciar.inc.php
		$usuarioid = $_SESSION['usuario'];
		$email = $_POST['email'];
		if (!isset($usuarioid)){
			$main->entrar();
			//coge el usuarioid con el email
			$usuarioid = $main->con_casilla(usuarioid,usuarios,email,$email);
			$main->login();
		}
		$departamentos = $main->con_tabla(departamentos);
		$categorias = $main->get_categorias();
		//informacion del formulario
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellido'];
		$telefono = $_POST['telefono'];
		$titulo = $_POST['titulo'];
		$ciudad = $_POST['ciudad'];
		$deparid = $_POST['departamento'];
		$sector = $_POST['sector'];
		$descripcion = $_POST['productos'];
		$productos = htmlspecialchars($descripcion);
		if (get_magic_quotes_gpc())
		{
			$titulo = stripslashes($titulo);
			$productos = stripslashes($productos);
		}
		$productos = mysql_real_escape_string($productos);
		$titulo = mysql_real_escape_string($titulo);
		$productos = strtolower($productos);
		$producto = ucfirst($productos);
		$ciudad = strtolower($ciudad);
		$ciudad - ucfirst($ciudad);
		$format = 'Y-m-d';
		$today = time();
		$date = date($format, $today);

		//conseguir la informacion binaria de la foto
		$thumbnail = getFoto($_FILES['picture']);
		$thumbnail = mysql_real_escape_string($thumbnail);
			//revisar que hayan puesto toda la informacion
			if (empty($email) || empty($nombre) || empty($telefono) || empty($titulo) || empty($ciudad)){
				$mensaje = '<h2>Debe poner toda la informacion para poder cotizar</h2>';
				include("vistas/anunciar.inc.php");
			//si ha entrado como usuario
			}elseif (!empty($usuarioid)){
			//procesar publicacion de clasificado de productos/materiales/maquinaria
			$mensaje = '<h2>Su Clasificado ha sido publicado</h2>';
			//meter clasificado
			$clasificadoid = $meto->anunciar_producto($titulo,$deparid,$ciudad,$producto,$thumbnail,$sector,$date,$usuarioid);
			$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
				if($sihayempresaid != 0) { 
					$meto->meter_datos(puntajes,$sihayempresaid,3,100);
					$mensaje .= '<h2>Ha sumado 100 puntos a su cuenta, felicitaciones</h2>';
				}
		 	include("vistas/anuncios/anunciar.inc.php");
		 	}else{
		 	// registrelo como usuario
			$clave = explode("@", $email);
			$password = $clave[0];
			//entrar a base de datos de servicios
			$main->entrar();
			$usuarioid = $meto->meter_usuario($nombre,$apellidos,$ciudad,$email,$password);
			//enviarle un mensaje de que se ha registrado
			$meto->meter_subscriptor($usuarioid,$nombre,$apellidos,$ciudad,$email);
			$meto->actualizar_usuario_dato(telefono,$telefono,$usuarioid);
			$mailcontent = 'Gracias por registrarse con nosotros'."\t".$nombre."\t".'esta es su informacion para entrar a colconstruccion.com'."\n".'Nombre de Usuario:'."\t".$email."\t".'Clave:'."\t".$password."\n";
			//headers
			$headers .= "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";

			$toaddress = 'construcali.publicidad@gmail.com';
			$subject =  'Nuevo Usuario';
			mail ($toaddress, $subject, $mailcontent,$headers);
			mail ($email, $subject, $mailcontent,$headers);
			
		 	$mensaje = '<h2>Su Clasificado ha sido publicado</h2>';
			$mensaje .= '<h2> y se ha registrado como usuario, revise su email '.$email.'</h2>';
			//entara a la base de datos construcali
			$main->login();
			// meter clasificado
			$clasificadoid = $meto->anunciar_producto($titulo,$ciudad,$producto,$thumbnail,$sector,$date,$usuarioid);
			$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
				if($sihayempresaid != 0) { 
					$meto->meter_datos(puntajes,$sihayempresaid,3,100);
					$mensaje .= '<h2>Ha sumado 100 puntos a su cuenta, felicitaciones</h2>';
				}		
			include("vistas/anuncios/anunciar.inc.php");	
		 	}//closes else
	}elseif($_REQUEST['content'] === 'anunciar_servicios'){
		//este modulo ya no se va a usar
	$departamentos = $main->con_tabla(departamentos);
	$categorias = $main->get_categorias();
	
	$usuarioid = $_SESSION['usuario'];
	$email = $_POST['email'];
	if (!isset($usuarioid)){
			$main->entrar();
			$usuarioid = $main->con_casilla(usuarioid,usuarios,email,$email);
			$main->login();
		}
	
	//coger la informacion del formulario
	//informacion del formulario
	
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellido'];
	$telefono = $_POST['telefono'];
	$titulo = $_POST['titulo'];
	$ciudad = $_POST['ciudad'];
	$sector = $_POST['sector'];
	$descripcion = $_POST['anuncio'];
	$servicio = htmlspecialchars($descripcion);
	$titulo = htmlspecialchars($titulo);
	if(get_magic_quotes_gpc()){
			$titulo = stripslashes($titulo);
			$servicio = stripslashes($servicio);
		}
	$servicio = mysql_real_escape_string($servicio);
	$titulo = mysql_real_escape_string($titulo);
	$servicio = ucfirst($servicio);
	$titulo = ucfirst($titulo);
	$ciudad = strtolower($ciudad);
	$ciudad = ucfirst($ciudad);
	$format = 'Y-m-d';
	$today = time();
	$date = date($format,$today);
	//conseguir la informacion binaria de la foto
	$thumbnail = getFoto($_FILES['picture']);
	$thumbnail = mysql_real_escape_string($thumbnail);
		if (empty($email) || empty($nombre) || empty($telefono) || empty($titulo) || empty($ciudad)){
			$mensaje = '<h2>Debe poner toda la informacion para poder cotizar</h2>';
			include("vistas/anuncios/anunciar.inc.php");
		//si ha entrado como usuario
		} 
		elseif(isset($usuarioid)){
			$mensaje = '<h2>Su Clasificado ha sido publicado</h2>';
			$clasificadoid = $meto->anunciar_servicio($titulo,$ciudad,$servicio,$thumbnail,$sector,$date,$usuarioid);
			$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
			if($sihayempresaid != 0) { 
				$meto->meter_datos(puntajes,$sihayempresaid,3,100);
				$mensaje .= '<h2>Ha sumado 100 puntos a su cuenta, felicitaciones</h2>';}
			include("vistas/anuncios/anunciar.inc.php");
		}else{
			//entrar a base de datos servicios
			$main->entrar();
			// registrelo como usuario
			$clave = explode("@", $email);
			$password = $clave[0];
			$usuarioid = $meto->meter_usuario($nombre,$apellidos,$ciudad,$email,$password);
			//enviarle un mensaje de que se ha registrado
			$meto->meter_subscriptor($usuarioid,$nombre,$apellidos,$ciudad,$email);
			$meto->actualizar_usuario_dato(telefono,$telefono,$usuarioid);
			$mailcontent = 'Gracias por registrarse con nosotros'."\t".$nombre."\t".'esta es su informacion para entrar a construcali.com'."\n".'Nombre de Usuario:'."\t".$email."\t".'Clave:'."\t".$password."\n";
			//headers
			$headers .= "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";

			$toaddress = 'construcali.publicidad@gmail.com';
			$subject =  'Nuevo Usuario';
			mail ($toaddress, $subject, $mailcontent,$headers);
			mail ($email, $subject, $mailcontent,$headers);
			//entrar a a la base de datos construcali
			$main->login();
			$mensaje = '<h2>Su Clasificado ha sido publicado</h2>';
			$mensaje .= '<h2> y se ha registrado como usuario, revise su email '.$email.'</h2>';
			$clasificadoid = $meto->anunciar_servicio($titulo,$ciudad,$servicio,$thumbnail,$sector,$date,$usuarioid);
			$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
				if($sihayempresaid != 0) { 
					$meto->meter_datos(puntajes,$sihayempresaid,3,100);
					$mensaje .= '<h2>Ha sumado 100 puntos a su cuenta, felicitaciones</h2>';}
			include("vistas/anuncios/anunciar.inc.php");
		}//closes else
	}//closes else if de anunciar servicios
?>
<!--End Main -->
<!-- Functions -->
<?php
	function getFoto($Original)
	{
		if(!$Original['name'])
		{
			//No image supplied, use default
			$TempName = "presentaciones/logoColconstruccion.png";
			$TempFile = fopen($TempName, "r");
			$thumbnail = fread($TempFile, fileSize($TempName));
		}
		else
		{
			//Get image
			$Picture = file_get_contents($Original['tmp_name']);
			
			//Create Image
			$SourceImage = imagecreatefromstring($Picture);
			if (!$SourceImage)
			{
				//Not a valid image
				echo "No ha subido una imagen valida\n";
				$TempName = "presentaciones/CasaGeneral.jpg";
				$TempFile =  fopen($TempName, "r");
				$thumbnail = fread($TempFile, filesize($TempName));
			}
			else
			{
				//Create Thumbnail
				$width = imagesx($SourceImage);
				$height = imagesy($SourceImage);
				$newThumb = imagecreatetruecolor(600, 480);
				
				//resize image to 80 x 60
				$result = imagecopyresampled($newThumb, $SourceImage, 0, 0, 0, 0, 600, 480, $width, $height);
				
				//move image to variable
				ob_start();
				imagejpeg($newThumb);
				$thumbnail = ob_get_contents();
				ob_end_clean();
			}
		}
		return $thumbnail;
	}		
?>


<!-- Start of page footer -->
<?php include("vistas/footer.html"); ?>
<!-- End of page footer -->

<!-- este codigo para cargar mas anuncios  -->
<script type="text/javascript" src="assets/js/cargarMasAnuncios.js"></script>