
<?php
session_start();
?>

<!--Beginning Header -->
<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->login(); //entrar a base de datos
	$metaTitulo = 'Construcali.com - Empresas de construccion en Colombia';
	
	//saber si hay empresaid
	$loginid = $_SESSION['usuario'];
	$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
	include("vistas/header.php");
?>
<!--End of page header -->
<!-- 
content = nuevaoferta linea 50
content= subiroferta linea 132

-->
<!--Beginning Main -->
<?php
			
	if (!isset($_REQUEST['content']) || $_REQUEST['content'] === 'paginacion')
	{	
		$usuarioid = $_SESSION['usuario'];
		#hacer la paginacion
		$totrecords = $main->contar_records(productoid,promociones);
		if(!isset($_GET['page']))
			$thispage = 1;
		else
			$thispage = $_GET['page'];
		$recordsperpage = 10;

		$offset = ($thispage-1)*$recordsperpage;
		$totpages = ceil($totrecords/$recordsperpage);
		#termina paginacion
		$promociones = $main->con_info_desc(promociones,productoid,$offset,$recordsperpage);
		$sihayempresaid = $_SESSION['empresaid'];
		#conseguir las categorias de las ofertas
		//$categorias = $main->get_casillas(categoria,promociones);
		$departamentos = $main->con_tabla(departamentos);
		$categorias = $main->con_tabla(categorias);
		if (isset($usuarioid)){
			
			include("vistas/ofertas/ofertas.inc.php");
		}else{
			include("vistas/login.inc.php");
		}
	}elseif ($_REQUEST['content'] === 'nuevaoferta') 
	{
		$usuarioid = $_SESSION['usuario'];
		if(empty($usuarioid)){
			mail('construcali.publicidad@gmail.com', 'Click en el enlace de publicar oferta', ' Alguien dio click en publique su oferta');
			include("vistas/login.inc.php");
		}else
		{
			#conseguir las categorias de las ofertas
			$categorias = $main->get_categorias();
			$promociones = $main->con_info_desc(promociones,productoid,0,10);
			$sihayempresaid = $_SESSION['empresaid'];
			if (isset($sihayempresaid)){
				include("vistas/ofertas/nuevaoferta.inc.php");
			}else
			{
				include("vistas/newcompany.inc.php");
			}
		}
	}elseif ($_REQUEST['content'] === 'veroferta')
	{
		#coger el productoid de la oferta
		$boletinid = $_GET['ofertaid'];
		$promocion = $main->con_tabla_unid(promociones,productoid,$boletinid);
		$sihayempresaid = $_SESSION['empresaid'];
		$oferta_url = 'http://construcali.com/ofertas.php?content=veroferta&ofertaid='.$boletinid;
		//conseguir la informacion
		$empresaid = $promocion['empresaid'];
        $productoid = $promocion['productoid'];
        $descripcion = $promocion['descripcion'];
        $titulo = $promocion['titulo'];
        $catid = $promocion['categoria'];
        $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
        $url = $promocion['url'];
        //$url = nl2br($url);
        $titulo = substr($titulo,0,40);
        $titulo = trim($titulo);
        $titulo = nl2br($titulo);
        $descripcion = trim($descripcion);
        //$descripcion = nl2br($descripcion);
        //revisar si hay entidades html en el titulo
        $check_entities = strpos($titulo, '&lt;');
        if ($check_entities === false){
            $titulo = htmlentities(strip_tags($titulo));
            $titulo = ucfirst($titulo);
        }else{
            $titulo = html_entity_decode($titulo);
            $titulo = ucfirst($titulo);
        }
        //revisar si la descripcion tiene las entidades html
        $check_entity = strpos($descripcion, '&lt;');
        $check_tildes = strpos($descripcion, 'acute;');
        if ($check_tildes === true){
        	$descripcion = html_entity_decode($descripcion);
        }
        elseif ($check_entity === false){
            $descripcion = htmlentities(strip_tags($descripcion));
        }else{
            $descripcion = html_entity_decode($descripcion);
        } 
        
        $fecha = $main->get_fecha(boletines,$productoid);
        $empresa = $main->con_casilla(empresa,companies,empresaid,$empresaid);
        $ciudad = $main->con_casilla(ciudad,companies,empresaid,$empresaid);
        $telefono = $main->con_casilla(telefono,companies,empresaid,$empresaid);
		include("vistas/ofertas/veroferta.inc.php");
	}elseif ($_REQUEST['content'] === 'estasofertas')
	{
		#conseguir la categoria
		$catid = $_GET['catid'];
		#hacer la paginacion
		$totrecords = $main->contar_ids(productoid,promociones,categoria,$catid);
		if(!isset($_GET['page']))
			$thispage = 1;
		else
			$thispage = $_GET['page'];
		$recordsperpage = 10;

		$offset = ($thispage-1)*$recordsperpage;
		$totpages = ceil($totrecords/$recordsperpage);
		#termina paginacion
		$promociones = $main->con_donde_order_limit(promociones,categoria,$catid,productoid,$offset,$recordsperpage);
		$sihayempresaid = $_SESSION['empresaid'];
		#conseguir las categorias de las ofertas
		$categorias = $main->get_casillas(categoria,promociones);
		include("vistas/ofertas/estasofertas.inc.php");
	}else if($_REQUEST['content'] === 'subiroferta')
	{
		$usuarioid = $_SESSION['usuario'];
		//$sihayempresaid = $_SESSION['empresaid']; ya la cuadre arriba
		if(empty($usuarioid)){
			include("vistas/login.inc.php");
		}else if(empty($sihayempresaid)){
			include("vistas/nuevaempresa.inc.php");
		}else{
			//en este else se sube la oferta  y se envia
			//cojo las ultimas 10 promociones
			$promociones = $main->con_info_desc(promociones,productoid,0,10);

			if ($_FILES['presentacion']['error'] > 0)
			{
				echo 'El problema es: ';
				switch ($_FILES['presentacion']['error'])
				{
					case 1:
						$mensajeoferta = 'El Documento excedio el maximo peso permitido'; 
						break;
					case 2: 
						$mensajeoferta = 'El Documento excedio el maximo peso para un documento'; 
						break;
					case 3:
						$mensajeoferta = 'El documento solo subio parcialmente';
						break;
					case 4: 
						$mensajeoferta = 'No subio ningun documento';
						break;
				}
				include("vistas/ofertas/ofertas.inc.php");
			}
			
			if (($_FILES['presentacion']['type'] == 'application/octet-stream')||($_FILES['presentacion']['type'] == 'text/plain')||($_FILES['presentacion']['type'] == 'application/x-httpd-php'))
			{
				$mensajeoferta = 'El Documento no es una foto';
				include("vistas/ofertas/ofertas.inc.php");
			}else
			{
			$usuarioid = $_SESSION['usuario'];
			// Donde Pondremos las presentaciones
			$fotoName = $_FILES['presentacion']['name'];
			$fotoName = trim($fotoName);
			$fotoName = str_replace(' ', '_', $fotoName);
			$almacen = '/presentaciones/'.$fotoName;
			
				if (is_uploaded_file($_FILES['presentacion']['tmp_name']))
				{
					if(move_uploaded_file($_FILES['presentacion']['tmp_name'], $almacen))
					{
						$mensajeoferta = 'Ha subido la oferta exitosamente';
						$descripcion = $_POST['oferta'];
						$titulo = $_POST['titulo'];
						$categoria = $_POST['categoria']; //Aqui coge un numero
						if (get_magic_quotes_runtime()){
							$titulo = stripslashes($titulo);
							$descripcion = stripslashes($descripcion);
						}
						$titulo = mysql_real_escape_string($titulo);
						$descripcion = mysql_real_escape_string($descripcion);
						$factoriaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
						$estaempresa = $main->con_casilla(empresa,companies,empresaid,$factoriaid);
						$url = 'http://construcali.com'.$almacen;
						$format = 'Y-m-d';
						$today = time();
						$date = date($format, $today);
						//la categoria se mete como numero
						//Meter informacionen en la tabla donde subo las ofertas, promociones 
						//$meto debe ser un objeto que se declara arriba
						$meto->subir_oferta($factoriaid,$url,$titulo,$descripcion,$categoria,$date);
						
						//consigo el nombre de la empresa que contesta
						$compania = $main->con_casilla(empresa,companies,empresaid,$sihayempresaid);
						//enviarle la oferta a las empresas
						//poner el enlace de html
						$mensaje = '<html><div>'.$descripcion.'</div><div><img src='.$url.'></div></html>';
						//cuadrar los headers
						//$headers = "Reply-To: construcali.publicidad@gmail.com". "\r\n";
						$headers = "CC: construcali.publicidad@gmail.com "."\r\n";
						$headers .= "MIME-Version: 1.0"."\r\n";
						$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";

						$alemail = 'construcali.publicidad@gmail.com';
						
						$i = 1; //contador para la variable email
							
							$query = "SELECT * FROM companies WHERE clase = '$categoria'";
							$result = mysql_query($query) or die('Disculpe, estamos en mantenimiento');
							while($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{
							$email_.$i = $row['email'];
							$contacto = $row['contacto'];
							$empresa = $row['empresa'];
							
							$contenido = $empresa."\n<br>"
							.'Saludos'."\t".$contacto."<br>"
							."\n"
							.$mensaje . "\n <br>"
							.'Mensaje enviado por la empresa '.$compania ."<br>"
						 	.'WWW.CONSTRUCALI.COM'."\n<br>"
						 	.'La Construccion a su Alcance';
							
							mail($email_.$i, $titulo, $contenido, $headers);
							$i=$i+1;
							}
							$subject = 'Nueva oferta de la empresa '.$compania;
							mail($alemail, $subject, $contenido, $headers);		 
						//termina de enviarle la oferta a las empresas
						#conseguir las categorias de las ofertas
						$categorias = $main->get_casillas(categoria,promociones);
						include("vistas/ofertas/ofertas.inc.php");
					}else
					{
						$mensajeoferta = 'El problema es: no se pudo mover el documento a'.$almacen;
						include("vistas/ofertas/ofertas.inc.php");
					}
					}
				else
				{
						$mensajeoferta = 'El problema es: que es posible que haya habido un ataque de archivo: ';
						include("vistas/ofertas/ofertas.inc.php");
				}
			}
		}
	}else if($_REQUEST['content'] === 'vender')
	{
		$usuarioid = $_SESSION['usuario'];
		//$sihayempresaid = $_SESSION['empresaid']; ya la cuadre arriba
		if(empty($usuarioid)){
			include("vistas/login.inc.php");
		}else if($usuarioid != 0){
			//en este else se sube la oferta  y se envia
			//cojo las ultimas 10 promociones
			$promociones = $main->con_info_desc(promociones,productoid,0,10);

			if ($_FILES['presentacion']['error'] > 0)
			{
				echo 'El problema es: ';
				switch ($_FILES['presentacion']['error'])
				{
					case 1:
						$mensajeoferta = 'El Documento excedio el maximo peso permitido'; 
						break;
					case 2: 
						$mensajeoferta = 'El Documento excedio el maximo peso para un documento'; 
						break;
					case 3:
						$mensajeoferta = 'El documento solo subio parcialmente';
						break;
					case 4: 
						$mensajeoferta = 'No subio ningun documento';
						break;
				}
				include("vistas/ofertas/ofertas.inc.php");
			}
			
			if (($_FILES['presentacion']['type'] == 'application/octet-stream')||($_FILES['presentacion']['type'] == 'text/plain')||($_FILES['presentacion']['type'] == 'application/x-httpd-php'))
			{
				$mensajeoferta = 'El Documento no es una foto';
				include("vistas/ofertas/ofertas.inc.php");
			}else
			{
			//conseguir la informacion binaria de la foto
			$thumbnail = getFoto($_FILES['presentacion']);
			$thumbnail = mysql_real_escape_string($thumbnail);
			// mover el archivo de la foto al servidor
			$fotoName = $_FILES['presentacion']['name'];
			$fotoName = trim($fotoName);
			$fotoName = str_replace(' ', '_', $fotoName);
			$almacen = '/presentaciones/'.$fotoName;
			
				if (is_uploaded_file($_FILES['presentacion']['tmp_name']))
				{
					if(move_uploaded_file($_FILES['presentacion']['tmp_name'], $almacen))
					{
						$mensajeoferta = 'Ha subido la oferta exitosamente';
						$descripcion = $_POST['oferta'];
						$titulo = $_POST['titulo'];
						$categoria = $_POST['categoria']; //Aqui coge un numero de articulos categoria
						$titulo = mysql_real_escape_string($titulo);
						$descripcion = mysql_real_escape_string($descripcion);
						$factoriaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);
						$estaempresa = $main->con_casilla(empresa,companies,empresaid,$factoriaid);
						$url = 'http://construcali.com'.$almacen;
						$format = 'Y-m-d';
						$today = time();
						$date = date($format, $today);
						 
						// consigo el precio y la unida
						$precio = $_POST['precio'];
						$unidad = $_POST['unidad'];

						//entro  a la base de datos de informacion 
						//meter en tabla articulos de la bae de datos informacion
						$conn = $main->conecto(); // coge la entrada $con a la base de datos
						$meto->meter_articulo($conn,$titulo,$unidad,$precio,$categoria);

						// cojo la categoria de la base de datos de construcali o la categoria de las empresas
						$empcatid = $main->con_casilla_sqli($conn,empid,articulos_categorias,catid,$categoria);

						
						$main->entrar();
						$deparid = $main->con_casilla(deparid,usuarios,usuarioid,$usuarioid);
						$ciudad = $main->con_casilla(ciudad,usuarios,usuarioid,$usuarioid);
						
						// entrar a base de datos de construcali
						$main->login();
						//consigo el nombre de la empresa que contesta
						$compania = $main->con_casilla(empresa,companies,empresaid,$sihayempresaid);
						// conigo alguna informacion del usuario
						$categoria_empresa =  $main->con_casilla(categoria,categorias,catid,$empcatid); // coger el nombre de la categoria
						$clasificadoid = $meto->anunciar_producto($titulo,$deparid,$ciudad,$descripcion,$thumbnail,$categoria_empresa,$date,$usuarioid);

						// subir la oferta
						if (isset($sihayempresaid))
							$meto->subir_oferta($usuarioid,$factoriaid,$url,$titulo,$descripcion,$empcatid,$date,$unidad,$precio);
						#conseguir las categorias de las ofertas
						$categorias = $main->get_casillas(categoria,promociones);

						//enviarle la oferta a las empresas
						//poner el enlace de html
						$mensaje = '<html><div>'.$descripcion.'</div><div><img src='.$url.'></div><div>categoria:'.$categoria.' '.$empcatid.'</html>';
						//cuadrar los headers
						//$headers = "Reply-To: construcali.publicidad@gmail.com". "\r\n";
						$headers = "CC: construcali.publicidad@gmail.com "."\r\n";
						$headers .= "MIME-Version: 1.0"."\r\n";
						$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";

						$alemail = 'construcali.publicidad@gmail.com';
						
					
							$subject = 'Nueva oferta de la empresa '.$compania;
							mail($alemail, $subject, $contenido, $headers);		 
						//termina de enviarle la oferta a las empresas
						
						include("vistas/ofertas/ofertas.inc.php");
					}else
					{
						$mensajeoferta = 'El problema es: no se pudo mover el documento a'.$almacen;
						include("vistas/ofertas/ofertas.inc.php");
					}
					}
				else
				{
						$mensajeoferta = 'El problema es: que es posible que haya habido un ataque de archivo: ';
						include("vistas/ofertas/ofertas.inc.php");
				}
			}
		}
	}
?>

<!-- End Main -->
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
	