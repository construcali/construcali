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
	$metaTitulo = 'Colconstruccion - Empresas de construccion en Colombia';
	include("vistas/admin/adminheader.html");
	//conseguir las ultimas actualizaciones del portal
	//ultima empresa con pagina de internet a traves de colconstruccion.com
	$productoid = $main->con_max_id(productoid,paginas);
	$empresaid_pagina = $main->con_casilla(empresaid,paginas,productoid,$productoid);
	$url = $main->con_casilla(url,paginas,productoid,$productoid);
	$empresa_pagina = $main->con_casilla(empresa,companies,empresaid,$empresaid_pagina);
	//ultima empresa registrada
	$companyid = $main->con_max_id(empresaid,companies);
	$company = $main->con_casilla(empresa,companies,empresaid,$companyid);
	//ultima empresa con logo
	$factoriaid = $main->con_max_id(empresaid,logos);
	$factoria = $main->con_casilla(empresa,companies,empresaid,$factoriaid);
	//ultima empresa que ha creado un catalogo
	$fotoid = $main->con_max_id(fotoid,fotos);
	$factoryid = $main->con_casilla(empresaid,fotos,fotoid,$fotoid);
	$factory = $main->con_casilla(empresa,companies,empresaid,$factoryid);
	//conseguir ultimo clasificado de servicios ofrecidos
	$serviceid = $main->con_max_id(productoid,servicios);
	$encabezado = $main->con_casilla(titulo,servicios,productoid,$serviceid);
	$calendarday = $main->get_fecha(servicios,$serviceid);
	//conseguir ultimo claificado en productos ofrecidos
	$productoid = $main->con_max_id(productoid,productos);
	$enunciado = $main->con_casilla(titulo,productos,productoid,$productoid);
	$diacalendario = $main->get_fecha(productos,$productoid);
	//conseguir los ultimos portafolios subidos
	$portafolios = $main->con_info_desc(publicaciones,productoid,0,6);
	$ofertas = $main->con_info_desc(boletines,productoid,0,2);
	//conseguir las ultimas cotizacion de materiales
	$main->entrar();
	$cuadernos = $main->con_info_desc(pedidos,ordenid,0,3);
	$libros = $main->con_info_desc(cotizaciones,ordenid,0,3);
	$i=0;
	foreach ($cuadernos as $cuaderno) {
		$userid = $cuaderno['usuarioid'];
		$cuadernoid = $cuaderno['ordenid'];
		$cuadernos[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
		$cuadernos[$i]['nuevafecha'] = $main->con_fecha(pedidos,ordenid,$cuadernoid);
		$i=$i+1;
	}
	$j=0;
	foreach ($libros as $libro) {
		$profesorid = $libro['usuarioid'];
		$libroid = $libro['ordenid'];
		$libros[$j]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$profesorid);
		$libros[$j]['nuevafecha'] = $main->con_fecha(cotizaciones,ordenid,$libroid);
		$j=$j+1;
	}
	$main->login();
?>
<!--End of page header -->

<!--Beginning Main -->
<?php
	if(!isset($_REQUEST['content']))
	{
		$adminid = $_SESSION['admin'];
		if(empty($adminid)){
			include("vistas/login.inc.php");
		}else
		{
			$main->entrar();
			$query = "SELECT ordenid from ordenes";
			$result = mysql_query($query);
			$totordenes = mysql_num_rows($result);
			$query = "SELECT ordenid from cotizaciones";
			$result = mysql_query($query);
			$totprecios = mysql_num_rows($result);
			$query = "SELECT ordenid from pedidos";
			$result = mysql_query($query);
			$totsinprecios = mysql_num_rows($result);
			$query = "SELECT ordenid from cotizaciones_respuestas";
			$result = mysql_query($query);
			$totsinrespuestas = mysql_num_rows($result);
			$query = "SELECT usuarioid from usuarios";
			$result = mysql_query($query);
			$totusuarios = mysql_num_rows($result);
			$query = "SELECT usuarioid from subscritores";
			$result = mysql_query($query);
			$totsubscriptores = mysql_num_rows($result);
			$main->login();
			$query = "SELECT distinct empresaid from puntajes ";
			$result = mysql_query($query);
			$totsinpuntajes = mysql_num_rows($result);
			$query = "SELECT productoid from anuncios";
			$result = mysql_query($query);
			$totanuncios = mysql_num_rows($result);
			$query = "SELECT productoid from anouncements";
			$result = mysql_query($query);
			$totanouncements = mysql_num_rows($result);
			$query = "SELECT empresaid from companies";
			$result = mysql_query($query);
			$totcompanies = mysql_num_rows($result);
			$query = "SELECT empresaid from logos";
			$result = mysql_query($query);
			$totlogos = mysql_num_rows($result);
			$pregunta = "SELECT distinct(empresaid) from fotos";
			$resultado = mysql_query($pregunta);
			$numero=mysql_num_rows($resultado);
			$query = "SELECT empresaid from empresas_int";
			$result = mysql_query($query);
			$totinternacionales = mysql_num_rows($result);
			$query = "SELECT productoid from boletines";
			$result = mysql_query($query);
			$totboletines = mysql_num_rows($result);
			$query = "SELECT productoid from portafolios";
			$result = mysql_query($query);
			$totportafolios = mysql_num_rows($result);
			$query = "SELECT empresaid from paginas";
			$result = mysql_query($query);
			$totpaginas = mysql_num_rows($result);
			$query = "SELECT empresaid from proveedores";
			$result = mysql_query($query);
			$totcatalogos = mysql_num_rows($result);
			$query = "SELECT empresaid from companies WHERE url = ' '";
			$result = mysql_query($query);
			$totsinpaginas = mysql_num_rows($result);
			//averigua las 40 empresas con mas puntos
			$empresaNombres = array();
			$query = "SELECT distinct empresaid FROM puntajes ORDER BY puntos desc limit 0,40";
			$result = mysql_query($query); 
			while ($row=mysql_fetch_array($result,MYSQL_ASSOC))
			{ 
				$empresaid = $row['empresaid'];
				$empresa = $main->con_casilla(empresa,companies,empresaid,$empresaid);
				$empresaNombres[$empresaid] = $empresa;  
			}
			
			
			include("vistas/admin/admincontenido.inc.php");
		}
	}else if($_REQUEST['content'] === 'correo')
	{
		$adminid = $_SESSION['admin'];
		if(empty($adminid)){
			include("vistas/login.inc.php");
		}else
		{
			$departamentos = $main->con_tabla(departamentos);
			$categorias = $main->con_tabla(categorias);
			include("vistas/admin/admincorreo.inc.php");
		}
	}elseif ($_REQUEST['content'] === 'cotizacion')
	{
		
		$departamentos = $main->con_tabla(departamentos);
		$categorias = $main->con_tabla(categorias);
		//procesar cotizacion de materiales
		$mensaje = '<h2>Su Cotizacion de Materiales se ha enviado</h2>';
		$usuarioid = $_SESSION['usuario'];
		$titulo = $_POST['titulo'];
		$catid = $_POST['sector'];
		$capital = $_POST['capital'];
		$ciudad = $_POST['ciudad'];
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
		//$cotizacionid = $meto->registrar_cotizacion($usuarioid,$date,$estado,$catid,$ciudad);
		//meter el numero de cotizacion y la lista de materiales
		for ($i=0; $i<=5; $i++){
			if ($stock[$i]){
					$output .= $stock[$i]. "\t" .'cantidad: '."\t" .$quantity[$i]. "\t" .'unidad: '."\t" .$unit[$i]. "\n";
					$item = $stock[$i];
					$qty = $quantity[$i]."\t".$unit[$i];
					//$meto->meter_cotizacion($cotizacionid,$item,$qty);
				}
			}		

	 	//enviar cotizacion a empresas
	 	$link = 'http://construcali.com/usuarios.php?content=actividades';	
		//$link2 = $cotizacionid.'"';
	 	$contenido = '<div>Lista enviada por un usuario de colconstruccion.com</div>'. "\n"
			 .'<div>Por favor responda a su mejor conveniencia</div>'."\n"
			 .'<div>desde la ciudad: '.$ciudad.'</div>'."\n"
			 .'<div>con el objectivo de cotizar</div>'."\n"
			 .'<div>material: ' .$output.'</div>'."\n"
			 .'Aproveche para promocionar su empresa'."\n"
			 .'<div>Por favor haga click en el siguiente <a href='.$link.'>enlace</a> para responder</div>'."\n"
			 .'Aproveche para promocionar su Empresa'."\n"
			 .'COLCONSTRUCCION.COM'."\n"
			 .'La Construccion a su Alcance';
		$main->login(); //entrar a base de datos de construcali	 
		$subject = strtolower($titulo);
		$subject = ucfirst($subject);
		$headers = "Reply-To: admin@construcali.com". "\r\n";
		$headers .= "CC: publicidad@construcali.com "."\r\n";
		$headers .= "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";
		//hacer funcion para que tambien filtre por ciudad
		$direciones = $main->con_donde_dos(email,proveedores,clase,$catid,ciudad,$ciudad);
		foreach ($direciones as $key => $carta) {
			mail($carta,$subject,$contenido,$headers);
		}
	 	//mostrar pagina de nuevo
		include("vistas/admin/admincontenido.inc.php");
	}
?>

<!-- Start of page footer -->
<?php include("vistas/footer.html"); ?>
<!-- End of page footer -->