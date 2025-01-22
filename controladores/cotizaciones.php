<?php
session_start();
?>

<!--Beginning Header -->
<?php
	include("modelos/class_paginas.php");
	include("modelos/class_buscados.php");
	$main = new pagina();
	$busco = new buscado();
	$main->login(); //entrar a base de datos
	//saber si hay empresaid
	$loginid = $_SESSION['usuario'];
	$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
	
	if (empty($loginid))
		include("vistas/header.php");
	else
		include("vistas/header_adentro.php");
?>
<!--End of page header -->

<!--Beginning Main -->
<?php
//puedo usar un switch structure
// if content == this do this
	if (!isset($_REQUEST['content']))
	{	
		if(empty($loginid)){
			include("vistas/login.inc.php");
		}elseif ($loginid != 0){
			$nombreUsuario = $_SESSION['nombre'];
			$main->login();
			$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
			if ($sihayempresaid != 0)
				$_SESSION['empresaid'] = $sihayempresaid;
			//conseguir categorias y departamento para todo mundo
			$categorias = $main->get_categorias();
			//$departamentos = $main->con_tabla(departamentos);
			$departamentos = $main->con_dos_tabla(productoid,departamento,departamentos);
			asort($departamentos);
			//revisar si ha puesto articulos en su lista
			if (isset($_SESSION['carrito'])){
			
				$main->abrir();
				//conseguir ciertas categorias de los materiales de construccion
				$categories = array (1,3,7,14,20,27,31,39,46,50,56,61,70,72,75);
				foreach ($categories as $catid){
					$secciones[$catid] = $main->con_casilla(categoria,articulos_categorias,catid,$catid); 
				}
				//conseguir las categorias de los materiales de construccion
				$etiquetas = $main->con_tabla(articulos_categorias);
				$_SESSION['precio_total'] = $meto->calcular_total($_SESSION['carrito']);
				$_SESSION['cantidad'] = $meto->contar_articulos($_SESSION['carrito']);
				$materiales = $meto->hacer_lista($_SESSION['carrito']);
				include("vistas/analisis/lista.inc.php");
			}elseif (isset($sihayempresaid)){
				
				#informacion de la empresa
				$ficha = $main->con_empresa_id($sihayempresaid);
				//Cuantos puntos tiene la empresa
				$points = $main->puntaje_total($sihayempresaid);
				//Averiguar si ha hecho catalogo o portafolio
				$portafolioid = $main->con_casilla(productoid,portafolios,empresaid,$sihayempresaid);
				if ($portafolioid != 0)
					$urlportafolio = $main->con_casilla(url,portafolios,empresaid,$sihayempresaid); 
				$catalogoid = $main->con_casilla(fotoid,fotos,empresaid,$sihayempresaid);
				if ($catalogoid != 0)
					$catalogos = $main->con_fotoid($sihayempresaid);
				//conseguir informacion de usuario para actualizar ciudad y telefono
				$main->entrar(); //entrar a base de datos de servicios
				$contacto = $main->con_tabla_unid(usuarios,usuarioid,$usuarioid);
				$ciudad = $contacto['ciudad'];
				$telephone = $contacto['telefono'];
				$deparid = $contacto['deparid'];
				
				//conseguir las categorias de los materiales de construccion
				$main->abrir();
				$etiquetas = $main->con_tabla_ordenada(articulos_categorias,categoria);
				include("vistas/cotizacion.inc.php");
			}elseif (isset($loginid)){
			#si no hay empresaid
				$usuarioid = $_SESSION['usuario'];
			//conseguir informacion de usuario para actualizar ciudad y telefono
				$main->entrar(); //entrar a base de datos de servicios
				$ciudad = $main->con_casilla(ciudad,usuarios,usuarioid,$usuarioid);
				$telefono = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
				$contacto = $main->con_tabla_unid(usuarios,usuarioid,$usuarioid);
				$deparid = $contacto['deparid'];
				$nombreUsuario = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
				//conseguir las categorias de los materiales de construccion
				$main->abrir();
				$etiquetas = $main->con_tabla_ordenada(articulos_categorias,categoria);
				include("vistas/cotizacion.inc.php");
			}
			#footer esta afuera y sirve para los tres casos anteriores
		
		}
	}else if ($_REQUEST['content'] === 'cotizaciones'){ // aqui para las cotizaciones
		if(empty($loginid)){
			include("vistas/login.inc.php");
		}elseif (isset($sihayempresaid)){
			$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
			//categoria de la empresa
			$catid = $main->con_casilla(clase,companies,empresaid,$sihayempresaid);
			//conseguir las categorias que se hayan usado en la tabla de anouncements
			$categorias = $main->get_casillas(sector,anouncements);
			//conseguir las categorias que se hayan usado en la tabla de anuncios
			$categories = $main->get_casillas(sector,anuncios);
			//conseguir la informacion de productos y servicios a la venta
			if (!isset ($_GET['page']))
		   	  $thispage = 1;
	   	   	else
		      $thispage = $_GET['page'];
			$recordsperpage = 15;
			$offset = ($thispage-1) * $recordsperpage;
			//consigue los clasificados de productos y servicios
			$result_req = $main->conseguir_las_cotizaciones($offset,$recordsperpage);
			//contar los renglones de productos y servicios
			$productos_records = $main->contar_records(productoid,anuncios);
			$servicios_records = $main->contar_records(productoid,anouncements);
			$totrecords = $productos_records + $servicios_records;
		    $totpages = ceil($totrecords/$recordsperpage); 
				
			$clasificados = array();
		   	$i=0;
		   	while ($servicio = mysql_fetch_array($result_req,MYSQL_ASSOC)){
	            $productoid = $servicio['productoid'];
	            //de que tabla viene
	            if ($servicio['tipo'] == 'articulo'){
	            	$clasificados[$i]['clasificado'] = $main->con_casilla(anuncio,anuncios,productoid,$productoid);
	            }
	            elseif ($servicio['tipo'] == 'labor'){
	            	$clasificados[$i]['clasificado'] = $main->con_casilla(anouncement,anouncements,productoid,$productoid);//el nombre de este index cambia en cada tabla
	            }
	            $clasificados[$i]['titulo'] = $servicio['titulo'];
	            $clasificados[$i]['ciudad'] = $servicio['ciudad'];
	            $usuarioid = $servicio['usuarioid'];
	            $clasificados[$i]['usuarioid'] = $usuarioid;
	            //
	            $clasificados[$i]['sector'] = $servicio['sector'];
	            $clasificados[$i]['fecha'] = $servicio['date'];
	            $clasificados[$i]['productoid'] = $productoid;
	            $clasificados[$i]['clase'] = $servicio['tipo']; 
	            $main->entrar();
	                $clasificados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
	                $clasificados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
	                $clasificados[$i]['email'] = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
	            $main->login();
	                $i++;
	        } 
	        #entro a la base de datos de servicios
			$main->entrar(); 
			//cuantas cotizaciones de la categoria de la empresa
			$cuantasCotizaciones = $main->contar_records(ordenid,cotizaciones);
			//la tabla de pedidos reemplaza a anouncements
			//cuantos anouncements donde usuarioid = $usuarioid
			$cuantosPedidos = $main->contar_records(ordenid,pedidos);
			include("vistas/cotizaciones/cotizaciones.inc.php");
		}elseif (isset($loginid)){
				$departamentos = $main->con_tabla(departamentos);
				$categorias = $main->con_tabla(categorias);
				//coger info del cotizante
				$main->entrar();
				$ciudad = $main->con_casilla(ciudad,usuarios,usuarioid,$loginid);
				$telefono = $main->con_casilla(telefono,usuarios,usuarioid,$loginid);
				include("vistas/cotizaciones/cotizacion.inc.php");
		}
	}else if ($_REQUEST['content'] === 'anouncements')
	{
	   $sector = $_GET['sector'];
	   //funcion para hacer la paginacion
	   if (!isset ($_GET['page']))
	   	 $thispage = 1;
   	   else
	     $thispage = $_GET['page'];
	   $recordsperpage = 15;
	   $offset = ($thispage-1) * $recordsperpage;
	   if (empty($sector))
	   	$totrecords = $main->contar_records(productoid,anouncements);
	   else
	   	$totrecords = $main->contar_ids(productoid,anouncements,sector,$sector);
	   $totpages = ceil($totrecords/$recordsperpage); 	
	   if (empty($sector))
	   	$anouncements = $main->con_info_desc(anouncements,date,$offset,$recordsperpage); 
	   else
	   	$anouncements = $main->con_donde_order_limit(anouncements,sector,$sector,date,$offset,$recordsperpage);
	   $clasificados = array();
	   $i=0;
	   foreach ($anouncements as $anouncement) {
	   			$productoid = $anouncement['productoid'];
                $clasificados[$i]['titulo'] = $anouncement['titulo'];
                $clasificados[$i]['ciudad'] = $anouncement['ciudad'];
                $usuarioid = $anouncement['usuarioid'];
                $clasificados[$i]['usuarioid'] = $usuarioid;
                $clasificados[$i]['anouncement'] = $anouncement['anouncement'];//el nombre de este index cambia en cada tabla
                $clasificados[$i]['sector'] = $anouncement['sector'];
                $clasificados[$i]['fecha'] = $main->get_fecha(anouncements,$productoid);
                $clasificados[$i]['productoid'] = $productoid;
                $main->entrar();
                $clasificados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['email'] = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
                $main->login();
                $i++;
            }     
	   //conseguir las categorias que se hayan usado en la tabla de anouncements
		$categorias = $main->get_casillas(sector,anouncements);
		//conseguir las categorias que se hayan usado en la tabla de anuncios
		$categories = $main->get_casillas(sector,anuncios);
	   //$fotos = $main->con_info_desc(boletines,productoid,0,8); 
	   include("vistas/cotizaciones/anouncements.inc.php");
	}
	else if($_REQUEST['content'] === 'anuncios')
	{
	   $sector = $_GET['sector'];
	   //funcion para hacer la paginacion
	   if (!isset ($_GET['page']))
	   	 $thispage = 1;
   	   else
	     $thispage = $_GET['page'];
	   $recordsperpage = 15;
	   $offset = ($thispage-1) * $recordsperpage;
	   if (empty($sector))
	   	 $totrecords = $main->contar_records(productoid,anuncios);
	   else
	   	 $totrecords = $main->contar_ids(productoid,anuncios,sector,$sector);
	   $totpages = ceil($totrecords/$recordsperpage); 
	   //conseguir informacion de anuncios
	   if (empty($sector))
	   	$anouncements = $main->con_info_desc(anuncios,date,$offset,$recordsperpage);
	   else
	   	$anouncements = $main->con_donde_order_limit(anuncios,sector,$sector,date,$offset,$recordsperpage);
	   $clasificados = array();
	   $i=0;
	   foreach ($anouncements as $anouncement) {
	   			$productoid = $anouncement['productoid'];
                $clasificados[$i]['titulo'] = $anouncement['titulo'];
                $clasificados[$i]['ciudad'] = $anouncement['ciudad'];
                $usuarioid = $anouncement['usuarioid'];
                $clasificados[$i]['usuarioid'] = $usuarioid;
                $clasificados[$i]['anuncio'] = $anouncement['anuncio'];
                $clasificados[$i]['sector'] = $anouncement['sector'];
                $clasificados[$i]['fecha'] = $main->get_fecha(anuncios,$productoid);
                $clasificados[$i]['productoid'] = $productoid;
                $main->entrar();
                $clasificados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
                $main->login();
                $i++;
            }     
	  	//conseguir las categorias que se hayan usado en la tabla de anouncements
		$categorias = $main->get_casillas(sector,anouncements);
		//conseguir las categorias que se hayan usado en la tabla de anuncios
		$categories = $main->get_casillas(sector,anuncios); 
	   include("vistas/cotizaciones/anuncios.inc.php"); 
	}
	else if($_REQUEST['content'] === 'unanuncio')
	{
		$productoid = $_GET['id'];
		$clasificado = $main->con_tabla_id(anuncios,productoid,$productoid);
		$usuarioid = $clasificado[0]['usuarioid'];
		$clasificado[0]['fecha'] = $main->get_fecha(anuncios,$productoid);
		$main->entrar();
		$clasificado[0]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
		$clasificado[0]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
		$clasificado[0]['email'] = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
		$url = 'http://construcali.com/cotizaciones.php?content=unanuncio&id='.$productoid;
		include('vistas/anuncios/unanuncio.inc.php');
	}
	else if($_REQUEST['content'] === 'unanouncement')
	{
		$productoid = $_GET['id'];
		$clasificado = $main->con_tabla_id(anouncements,productoid,$productoid);
		$usuarioid = $clasificado[0]['usuarioid'];
		$clasificado[0]['fecha'] = $main->get_fecha(anouncements,$productoid);
		$main->entrar();
		$clasificado[0]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
		$clasificado[0]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
		$url = 'http://construcali.com/cotizaciones.php?content=unanouncement&id='.$productoid;
		include('vistas/cotizaciones/unanouncement.inc.php');
	}
	else if($_REQUEST['content'] === 'buscar')
	{
		$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
		$categorias = $main->get_casillas(sector,anouncements);
		$categories = $main->get_casillas(sector,anuncios);
		//coger la ciudad
		$ciudad = $_POST['ciudadClave'];
		if(get_magic_quotes_gpc()){
			$ciudad = stripslashes($ciudad);
		}
		$terminosciudad = mysql_real_escape_string($ciudad);
		$terminosciudad = trim($terminosciudad);
		$terminosciudad = strtolower($terminosciudad);
		$terminosciudad = ucfirst($terminosciudad);
		//coger la palabra que se busca
		$keywords = split(' ', $_POST['palabraClave']);
		$num_keywords = count($keywords);
		for($i=0; $i<$num_keywords; $i++)
		{
			if ($i)
			{
				$palabras_claves .= "|".$keywords[$i];
			}
			else
			{
				$palabras_claves .= $keywords[$i];
			}
		}
		$anouncements = $busco->encontrar_terminos($palabras_claves,anouncements,anouncement,$terminosciudad,0,15);
		$clasificados = array();
	    $i=0;
	    foreach ($anouncements as $anouncement) {
	   			$productoid = $anouncement['productoid'];
                $clasificados[$i]['titulo'] = $anouncement['titulo'];
                $clasificados[$i]['ciudad'] = $anouncement['ciudad'];
                $usuarioid = $anouncement['usuarioid'];
                $clasificados[$i]['usuarioid'] = $usuarioid;
                $clasificados[$i]['anouncement'] = $anouncement['anouncement'];//el nombre de este index cambia en cada tabla
                $clasificados[$i]['sector'] = $anouncement['sector'];
                $clasificados[$i]['fecha'] = $main->get_fecha(anouncements,$productoid);
                $clasificados[$i]['productoid'] = $productoid;
                $main->entrar();
                $clasificados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['email'] = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
                $main->login();
                $i++;
            }
        
            include("vistas/anuncios/rescontenido.inc.php");
	}else if ($_REQUEST['content'] === 'anunciar'){
		if (isset($_SESSION['usuario'])){
			$departamentos = $main->con_tabla(departamentos);
			$categorias = $main->con_tabla(categorias);
			mail('publicidad@construcali.com', 'Click en el enlace de cotizar', ' Alguien dio click en cotizar materiales y servicios');
			include("vistas/anuncios/anunciar.inc.php");
		}else{
			include("vistas/login.inc.php");
		}
	}else if ($_REQUEST['content'] === 'vender'){
		// coger las variables
		$titulo = $_POST['titulo'];
		$unidad = $_POST['unidad'];
		$precio = $_POST['precio'];
		$catid = $_POST['categoria'];
		$descripcion = $_POST['vender_item'];
		// coger mas informacion con esta informacion preliminar
		$categoria = $main->con_casilla(categoria,categorias,usuarioid,$loginid);
		$deptid = $main->con_casilla(deparid,usuarios,usuarioid,$logindid);
		$ciudad = $main->con_casilla(ciudad,usuarios,usuarioid,$loginid);
 	}
?>
<!--End Main -->

<!-- Start of page footer -->
<?php include("vistas/footer.html"); ?>
<!-- End of page footer -->
<!-- este codigo para cargar mas cotizaciones  -->
<script type="text/javascript" src="assets/js/cargarMasCotizaciones.js"></script>