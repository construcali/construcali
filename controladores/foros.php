<?php
session_start();
?>

<!--Beginning Header -->
<?php 
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->login(); //entrar a base de datos construcali
	$metaTitulo = 'Directorio de la construccion en Colombia - Empresas de construccion en Colombia';
	//saber si hay empresaid
	$loginid = $_SESSION['usuario'];
	$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
	
	include("vistas/header.php");
?>
<!--End of page header -->
<!-- index 
	#linea 55 - content = registrarse
	#linea 99 -  content = unforo
-->

<!--Beginning Main -->
<?php
	if(!isset($_REQUEST['content']))
	{
		
		# para saber como hacer la paginacion de los foros, mirar a foros.php
		//conseguir los ultimos 10 foro
		$foros = $main->con_info_desc(foros,hora,0,10);
		$i=0;
		$blogs = array();
		foreach($foros as $foro){
					$productoid = $foro['productoid'];
					$numerodecom = $main->contar_ids(productoid,comentarios,foroid,$productoid);
					$blogs[$i]['numcoment'] = $numerodecom;
					$blogs[$i]['catid'] = $foro['catid'];
					$blogs[$i]['categoria'] = $main->con_casilla(categoria,categorias,catid,$foro['catid']);
	                $blogs[$i]['productoid'] = $productoid;
	                $blogs[$i]['fecha'] =  $main->get_fecha(foros,$productoid);
	                $usuarioid = $foro['usuarioid'];
	                $blogs[$i]['usuarioid'] = $usuarioid;
	                $blogs[$i]['titulo'] = $foro['titulo'];
	                $blogs[$i]['tema'] = $foro['tema'];
	                $companyid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
	                $blogs[$i]['companyid'] = $companyid;
	                	if (isset($companyid))
	                		$blogs[$i]['logo'] = $main->con_casilla(foto,logos,empresaid,$companyid);
	                $main->entrar();
	                $blogs[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
	                $blogs[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
	                $blogs[$i]['ciudad'] = $main->con_casilla(ciudad,usuarios,usuarioid,$usuarioid);
	                $main->login();
	                $i=$i+1;
	       		}
	    #conseguir los foros que el usuario ha publicado
	    #sobre escribo usuarioid porque es distinto al encontrado en la seccion de blogs
	    $usuarioid = $_SESSION['usuario'];
		$cuantosForos = $main->contar_ids(productoid,foros,usuarioid,$usuarioid);
		//$misForos = $main->con_donde_order_limit(foros,usuarioid,$usuarioid,productoid,0,10);
		$misForos = $main->con_donde_order_limit(foros,usuarioid,$usuarioid,productoid,0,$cuantosForos);
		// conseguir los comentarios que el usuario ha puesto
		$cuantosComentarios = $main->contar_ids(productoid,comentarios,usuarioid,$usuarioid);
		// conseguir los comentarios que ha hecho en los foros
		$misComentarios = $main->con_donde_order_limit(comentarios,usuarioid,$usuarioid,productoid,0,$cuantosComentarios);
	    //pagina de inicio para usuario con o sin empresa	
		if(empty($loginid)){
			include("vistas/login.inc.php");
		}elseif (isset($loginid)){
			$usuarioid = $_SESSION['usuario'];
			$departamentos = $main->con_dos_tabla(productoid,departamento,departamentos);
			asort($departamentos);
			$categorias = $main->get_categorias();
			
			$main->entrar(); //entrar a base de datos de servicios
			$contacto = $main->con_tabla_unid(usuarios,usuarioid,$usuarioid);
			$ciudad = $contacto['ciudad'];
			$telephone = $contacto['telefono'];
			// coger las recomendaciones
			$recomendaciones = $main->con_donde_orden(evaluaciones,usuarioid,$usuarioid,fecha);
			if (empty($recomendaciones)){
		    	$mensaje = "No hay recomendaciones todavia de esta Empresa";
		    }
			// entrar a base de datos de construcali.com
			$main->login();
			include("vistas/foros/foroscontenido.inc.php");
		}else{
			
			include("vistas/login.inc.php");
		}
	}else if($_REQUEST['content'] === 'registrarse')
	{
		$usuarioid = $_SESSION['usuario'];
		if(empty($usuarioid)){
			include("vistas/registrarse.inc.php");
		}else
		{
			$departamentos = $main->con_tabla(departamentos);
			$categorias = $main->con_tabla(categorias);
			include("vistas/cotizacion.inc.php");
		}
	}else if ($_REQUEST['content'] === 'unforo') {
		$foroid = $_GET['foroid'];
		$foro = $main->con_tabla_unid(foros,productoid,$foroid);
		include("vistas/foros/unforo.inc.php");
	}

?>

<!-- Start of page footer -->
<?php include("vistas/footer.html"); ?>
<!-- End of page footer -->
<!-- este codigo para cargar mas boletines de la tabla foros  -->
<script type="text/javascript" src="assets/js/cargarMasBoletines.js"></script>