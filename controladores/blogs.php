<?php
session_start();
?>

<!--Beginning Header -->
<?php 
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	include("modelos/class_buscados.php");
	$main = new pagina();
	$meto = new metida();
	$busco = new buscado();
	$main->login(); //entrar a base de datos construcali
	
	$metaTitulo = 'Construcali.com - Empresas de construccion en Colombia';
	//saber si hay empresaid
	$loginid = $_SESSION['usuario'];
	$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
	include("vistas/header.php");
?>
<!-- end of Header -->
<?php 
	if(!isset($_REQUEST['content'])){
		// cuantos blogs en la tabla de blogs
		$totrecords = $main->contar_records(productoid,blogs);
		//seccion de enlaces interesantes
		if (!isset ($_GET['page']))
			$thispage = 1;
   		else
			$thispage = $_GET['page'];

		$recordsperpage = 20;
    	$offset = ($thispage-1) * $recordsperpage;
    	$totpages = ceil($totrecords / $recordsperpage);
    	//conseguir los enlaces
		$enlaces = $main->con_info_desc(blogs,productoid,$offset,$recordsperpage);
		
		//categorias de la tabla categorias en base de datos construcali.com
		$categories = $main->get_categorias();
		
		include("vistas/blogs/vlogs.inc.php");
		
		
	}else if ($_REQUEST['content'] === 'vervlog'){
		$blogid = $_GET['blogid'];
		// consegeguir la informacion de un blog
		$autorid = $main->con_casilla(usuarioid,blogs,productoid,$blogid);
		$titulo = $main->con_casilla(titulo,blogs,productoid,$blogid);
		$tema =  $main->con_casilla(tema,blogs,productoid,$blogid);
		$fecha = $main->get_fecha(blogs,$blogid);
		$catid = $main->con_casilla(catid,blogs,productoid,$blogid);
		$categoria = $main->con_casilla(categoria,categorias,catid,$catid);
		$url = $main->con_casilla(url,blogs,productoid,$blogid);
		//enlace a la pagina del blog
		$enlace = 'https://construcali.com/blogs.php?content=vervlog&blogid='.$blogid;
		// entrar a base de datos de servicios
		$main->entrar();
		$autor = $main->con_casilla(nombre,usuarios,usuarioid,$autorid);
		
		include("vistas/blogs/verblog.inc.php");
		
	}else if ($_REQUEST['content'] === 'enlaces'){
		//favoritos es la tabla para los enlaces informativos
		$totrecords = $main->contar_records(productoid,favoritos);
		//seccion de enlaces interesantes
		if (!isset ($_GET['page']))
			$thispage = 1;
   		else
			$thispage = $_GET['page'];

		$recordsperpage = 20;
    	$offset = ($thispage-1) * $recordsperpage;
    	$totpages = ceil($totrecords / $recordsperpage);
    	//conseguir los enlaces
		$enlaces = $main->con_info_desc(favoritos,productoid,$offset,$recordsperpage);
		
		//categorias de portafolios
		$categories = $main->get_casillas(clase,companies);
		$categorias = array();
			foreach ($categories as $categorie) {
       				$catid = $categorie;
       				$categorias[$categorie] = $main->con_casilla(categoria,categorias,catid,$catid);
       			}

		
		include("vistas/biblioteca/enlaces.inc.php");
			
	}else if ($_REQUEST['content'] === 'estosenlaces'){
		$catid = $_GET['catid'];
		$categoria = $main->con_casilla(categoria,categorias,catid,$catid);
		$totrecords = $main->contar_records(productoid,favoritos);
		//seccion de enlaces interesantes
		if (!isset ($_GET['page']))
			$thispage = 1;
   		else
			$thispage = $_GET['page'];

		$recordsperpage = 20;
    	$offset = ($thispage-1) * $recordsperpage;
    	$totpages = ceil($totrecords / $recordsperpage);
    	//conseguir los enlaces
		$enlaces = $main->con_donde_order_limit(favoritos,catid,$catid,productoid,$offset,$recordsperpage);
		//conseguir las categorias de los foros
		$categories = $main->get_casillas(clase,companies);
		$categorias = array();
			foreach ($categories as $categorie) {
       				$catid = $categorie;
       				$categorias[$categorie] = $main->con_casilla(categoria,categorias,catid,$catid);
       			}
       	
		include("vistas/biblioteca/enlaces.inc.php");
		
	}else if ($_REQUEST['content'] === 'buscar'){
		
			//conseguir terminos para buscar en foros
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

		//sqli entrar a bd construcali
		$connection = $main->conectar();
		$foros = $busco->buscar_enlaces($connection,$palabras_claves,0,10);

		$enlaces = array();
	    $id=0;
	    foreach ($foros as $foro) {
			$enlaces[$id]['productoid'] = $foro['productoid'];
			$enlaces[$id]['nombre'] = $foro['nombre'];
			$enlaces[$id]['catid'] = $foro['categoria'];
			$enlaces[$id]['url'] = $foro['url'];
	   		$id = $id+1;
		}

		//categorias de portafolios
		$categories = $main->get_casillas_sqli($connection,clase,companies);
		$categorias = array();
			foreach ($categories as $categorie) {
       				$catid = $categorie;
       				$categorias[$categorie] = $main->con_casilla_sqli($connection,categoria,categorias,catid,$catid);
       			}

		include("vistas/biblioteca/enlaces.inc.php");
			
	}
	include("vistas/footer.html");
?>