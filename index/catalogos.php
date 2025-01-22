
<?php
session_start();
?>

<!--Beginning Header -->
<?php
	include("modelos/class_paginas.php");
	include("modelos/class_buscados.php");

	$main = new pagina(); //class_paginas.php
	$busco = new buscado(); //class_buscados.php
	$main->login(); //entrar a base de datos
	$metaTitulo = 'Construcali.com - Empresas de construccion en Colombia';
	
	//saber si hay empresaid
	$loginid = $_SESSION['usuario'];
	$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$loginid);
	include("vistas/header.php");
?>
<!--End of page header -->

<!--Beginning Main -->
<?php
//puedo usar un switch structure
// if content == this do this
	if (!isset($_REQUEST['content']) || ($_REQUEST['content'] === 'catcontenido'))
	{	
        $sql = "SELECT DISTINCT empresaid FROM fotos";
		$query = mysql_query($sql);
        /* Apartir de aqui es la informacion que se necesita para la paginacion */
        $totrecords = mysql_num_rows($query);
        //trate de usar mysqli_num_rows y no funciono
		if(!isset($_GET['page']))
			$thispage = 1;
		else
			$thispage = $_GET['page'];
		$recordsperpage = 24;

		$offset = ($thispage-1)*$recordsperpage;
		$totpages = ceil($totrecords/$recordsperpage);
		# termina la paginacion
        $fotos = $main->con_info_distinta_desc(fotos,empresaid,fotoid,$offset,$recordsperpage);
        //var_dump($fotos);
		//organizar fotoid y empresaid en un array
		foreach($fotos as $fotos){
					$empresaid = $fotos['empresaid'];
                    $fotoid = $main->con_casilla(fotoid,fotos,empresaid,$empresaid);
                    $fotoArray[$fotoid] = $empresaid;
                    $fotoDesc[$fotoid] = $main->con_casilla(descripcion,fotos,empresaid,$empresaid);
                    $empresa = $main->con_casilla(empresa,companies,empresaid,$empresaid);
                    $fotoEmp[$fotoid] = $empresa; 
                }
		$categories = $main->get_categorias();
		//$departamentos = $main->con_tabla(departamentos);
		include("vistas/catalogos/catcontenido.inc.php");
	}
	else if ($_REQUEST['content'] === 'estecatalogo')
	{
	   // no se va a usar ma este modulo content = estecatalogo, 
	   // mirar que no hayan enlaces a este modulo y hacer de este moudulo un redirigir
	  // este modulo se usa como prueba para mirar como quedaria la pagina de inicio de catagalos.php (catalogacion.inc.php)
	    $totrecords = $main->contar_records(fotoid,fotos);
		if(!isset($_GET['page']))
			$thispage = 1;
		else
			$thispage = $_GET['page'];
		$recordsperpage = 24;

		$offset = ($thispage-1)*$recordsperpage;
		$totpages = ceil($totrecords/$recordsperpage);
		# termina la paginacion
		
		$photos = $main->con_info_desc(fotos,fotoid,$offset,$recordsperpage);
                
		$categories = $main->get_categorias();
	   
	   include("vistas/catalogos.inc.php");
	}
	else if($_REQUEST['content'] === 'estafoto')
	{
		$usuarioid = $_SESSION['usuario']; //revisar si hay session usuario
		//coge la fotoid para ver esa foto en grande como principal
		$picid = $_GET['fotoid'];
		 // coge la informacion de la foto con la id $picid
	    $esta_foto = $main->con_casilla(foto,fotos,fotoid,$picid);
	    $esta_foto_precio = $main->con_casilla(precio,fotos,fotoid,$picid);
	    $esta_foto_unidad = $main->con_casilla(unidad,fotos,fotoid,$picid);
		$descripcion = $main->con_casilla(descripcion,fotos,fotoid,$picid);
		$empresaid = $main->con_casilla(empresaid,fotos,fotoid,$picid);
		$empresa = $main->con_tabla_id(companies,empresaid,$empresaid);
	    $catid = $empresa[0]['clase'];
	    //consigue informacion de la empresa
	    $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
	    $url = $empresa[0]['url'];
	    //conseguir el servicio
        
        //revisar si la descripcion tiene las entidades html
        $check_entity = strpos($descripcion, '&lt;');
        if ($check_entity === false){
            $descripcion = strip_tags($descripcion);
        }else{
            $descripcion = html_entity_decode($descripcion);
        } 
        //revisar si la empresa tiene las entidades html
        $check_empresa = strpos($empresa[0]['empresa'], '&lt;');
        if ($check_empresa === false){
            $nombre_empresa = strip_tags($empresa[0]['empresa']);
        }else{
            $nombre_empresa = html_entity_decode($empresa[0]['empresa']);
        } 
      
	    //coge las fotos que ha subido esa empresa
	    $fotos = $main->con_tabla_id(fotos,empresaid,$empresaid);
	   
	    //formater al precio
	    $valor = $esta_foto_precio;
        settype($valor, "string");//now valor is an string
        $valoruno = substr($valor,0,-3);
        $valordos = substr($valor, -2);
        $valor = $valoruno.'.'.$valordos;
        $valor = number_format($valor, 3, '.', ','); 
	    include("vistas/catalogos/estafoto.inc.php"); 
	}else if($_REQUEST['content'] === 'estasfotos')
	{
		$usuarioid = $_SESSION['usuario']; //revisar si hay session usuario
		//coge la fotoid para ver esa foto en grande como principal
		$picid = $_GET['fotoid'];
		 // coge la informacion de la foto con la id $picid
	    $esta_foto = $main->con_casilla(foto,fotos,fotoid,$picid);
	    $esta_foto_precio = $main->con_casilla(precio,fotos,fotoid,$picid);
	    $esta_foto_unidad = $main->con_casilla(unidad,fotos,fotoid,$picid);
		$descripcion = $main->con_casilla(descripcion,fotos,fotoid,$picid);
		$empresaid = $main->con_casilla(empresaid,fotos,fotoid,$picid);
		$empresa = $main->con_tabla_id(companies,empresaid,$empresaid);
	    $catid = $empresa[0]['clase'];
	    //consigue informacion de la empresa
	    $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
	    $url = $empresa[0]['url'];
	    //conseguir el servicio
        
        //revisar si la descripcion tiene las entidades html
        $check_entity = strpos($descripcion, '&lt;');
        if ($check_entity === false){
            $descripcion = strip_tags($descripcion);
        }else{
            $descripcion = html_entity_decode($descripcion);
        } 
        //revisar si la empresa tiene las entidades html
        $check_empresa = strpos($empresa[0]['empresa'], '&lt;');
        if ($check_empresa === false){
            $nombre_empresa = strip_tags($empresa[0]['empresa']);
        }else{
            $nombre_empresa = html_entity_decode($empresa[0]['empresa']);
        } 
      
	    //coge las fotos que ha subido esa empresa
	    $fotos = $main->con_tabla_id(fotos,empresaid,$empresaid);
	   
	    //formater al precio
	    $valor = $esta_foto_precio;
        settype($valor, "string");//now valor is an string
        $valoruno = substr($valor,0,-3);
        $valordos = substr($valor, -2);
        $valor = $valoruno.'.'.$valordos;
        $valor = number_format($valor, 2, '.', ','); 
	    include("vistas/catalogos/estasfotos.inc.php"); 
	}
	else if($_REQUEST['content'] === 'estacategoria')
	{
		$catid = $_GET['categoria'];
		if(empty($catid)){$catid = $_POST['categoria'];}
		$categoria = $main->con_casilla(categoria,categorias,catid,$catid);
		//cuantas fotos  = -

		$fotos = array();
		$empresas = $main->con_tabla_id(companies,clase,$catid);
		foreach ($empresas as $empresa){
			$empresaid = $empresa['empresaid'];
			//coger un array de fotosid
			$fotoid = $main->con_casilla(fotoid,fotos,empresaid,$empresaid);
			
			//llenar los array con la informacion si la hay
			if (!empty($fotoid)){
				$catFotos[$fotoid] = $empresaid;
				$fotoDesc[$fotoid] = $empresa['decripcion'];
				$nombreempresa = $main->con_casilla(empresa,companies,empresaid,$empresaid);
                $fotoEmp[$fotoid] = $nombreempresa;
				//poner la fotoid en el array de fotos
				array_push($fotos, $fotoid); // poner las fotoids en el array de fotos
			}
		}
		//cuantas fotos en esa categoria
		$cuantas_fotos = count($fotos);
		//clear the arry fotos
		unset($fotos);	
		$categories = $main->get_categorias();
		//$departamentos = $main->con_tabla(departamentos);
		include("vistas/catalogos/estacategoria.inc.php");
	}
	else if($_REQUEST['content'] === 'estaciudad')
	{
		//este modulo ya no lo voy a usar, no estoy categorizando las empresas por ciudad
		$ciudadid = $_GET['ciudad'];
		echo $ciudadid;
		if(empty($ciudadid)){$catid = $_POST['categoria'];}
		$ciudad = $main->con_casilla(ciudad,departamentos,productoid,$ciudadid);
		$empresas = $main->con_empresa(companies,ciudad,$ciudad);
		foreach ($empresas as $empresa){
			$empresaid = $empresa['empresaid'];
			$fotoid = $main->con_casilla(fotoid,fotos,empresaid,$empresaid);
			if (!empty($fotoid)){
				$catFotos[$fotoid] = $empresaid;
				$fotoDesc[$fotoid] = $empresa['decripcion'];
				$nombreempresa = $main->con_casilla(empresa,companies,empresaid,$empresaid);
                $fotoEmp[$fotoid] = $nombreempresa;
				
			}
		}
		$categories = $main->get_categorias();
		$departamentos = $main->con_tabla(departamentos);
		include("vistas/estacategoria.inc.php");
	}elseif ($_REQUEST['content'] === 'catalogacion'){
		$totrecords = $main->contar_records(fotoid,fotos);
		if(!isset($_GET['page']))
			$thispage = 1;
		else
			$thispage = $_GET['page'];
		$recordsperpage = 24;

		$offset = ($thispage-1)*$recordsperpage;
		$totpages = ceil($totrecords/$recordsperpage);
		# termina la paginacion
		
		$photos = $main->con_info_desc(fotos,fotoid,$offset,$recordsperpage);
                
		$categories = $main->get_categorias();
		//$departamentos = $main->con_tabla(departamentos);
		
		include("vistas/catalogos/catalogacion.inc.php");
		
	}
	elseif ($_REQUEST['content'] === 'responder')
	{
		#coger la fotoid
		$fotoid = $_POST['photoid'];
		#coger la empresaid
		$empresaid = $_POST['empresaid'];
		$oferta = $_POST['oferta'];
		# revisar si la persona ha entrado como usuaria
		$usuarioid = $_SESSION['usuario'];
		if (empty($fotoid) || empty($empresaid) || empty($oferta) || empty($usuarioid)){
			$mensaje = 'Debe entrar como usuario y enviar un mensaje';
		}else{
			//coger la informacion de la empresa
			$empresa = $main->con_tabla_id(companies,empresaid,$empresaid);
			$catid = $empresa[0]['clase'];
			$categoria = $main->con_casilla(categoria,categorias,catid,$catid);
			//coge las fotos que ha subido esa empresa
			$fotos = $main->con_tabla_id(fotos,empresaid,$empresaid);
			$picid = $fotoid; // picid es la variabel que uso en estafoto.inc.php
		
			//descripcion de la foto
			$descripcion = $main->con_casilla(descripcion,fotos,fotoid,$fotoid);
			//email de la empresa que subio la foto
			$email = $main->con_casilla(email,companies,empresaid,$empresaid);
			//infomacion del que contesta
			$main->entrar();
			$nombre = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
			$telefono = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
			$ciudad = $main->con_casilla(ciudad,usuarios,usuarioid,$usuarioid);
			$correo = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);	
			
			$titulo = 'Me interesa un producto en su catalogo';

			// esta informacion no va en ninguna base de datos
			$oferta = mysql_real_escape_string($oferta);

			$direcion = 'construcali.publicidad@gmail.com';
			//enviar el mensaje y revisar si la pesona ha entrado o no 
			
			$mailcontent = 'Respuesta de: '.$nombre. "\n"
			              .'con el email: '.$correo. "\n"
			              .'acerca de la foto: '.$descripcion. "\n"
			              .'con la siguiente oferta: ' .$oferta. "\n";

			$contenido = 'Respuesta de: '.$nombre. "\n"
			              .'con el email: '.$correo. "\n"
			              .'desde la ciudad: '.$ciudad. "\n"
			              .'acerca de la foto '.$descripcion. "\n"
			              .'con el numero: '.$productoid. "\n"
			              .'puesto por el email '.$email. "\n"
			              .'Oferta: ' .$oferta. "\n";
			           
			
				mail($email, $titulo, $mailcontent);
				mail($direcion, $titulo, $contenido);
			

			$mensaje = 'Su respuesta ha sido enviada, gracias por su participacion';
			
		}

		include("vistas/estafoto.inc.php"); 
		
	}else if($_REQUEST['content'] === 'esteproducto'){
		$usuarioid = $_SESSION['usuario'];
		//coge la fotoid para ver esa foto en grande como principal
	   	$picid = $_GET['fotoid'];
	   	$descripcion = $main->con_casilla(descripcion,fotos,fotoid,$picid);
	   	//coger la empresaid con la fotoid
	    $empresaid = $main->con_casilla(empresaid,fotos,fotoid,$picid);
	    //$empresaid = $_GET['id'];
	    $empresa = $main->con_tabla_id(companies,empresaid,$empresaid);
	    $url = 'http://construcali.com/empresas.php?content=estasfotos&fotoid='.$picid;
		include("vistas/esteproducto.inc.php");
	}else if($_REQUEST['content'] === 'buscarproducto'){
		$buscar = $_POST['palabraClave'];
		$palabraClave = trim($buscar);
		//si no pone ningun termino
		if (empty($buscar)){
			$mensaje_resultado = 'la palabra'.$palabraClave.' no se ha encontrado, porfavor trate con otra palabra';
		}else{

			$buscarterminos = mysql_real_escape_string($palabraClave);
			$keywords = split(' ', $buscarterminos);
			$num_keywords = count($keywords);
			//cuando uso regex debo usar | para unir las varias palabras
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
			$photos = $busco->buscar_entabla(fotos,descripcion,$palabras_claves,fotoid,0,10);
			//conseguir categorias y departamentos
			$categories = $main->get_categorias();
			//$departamentos = $main->con_tabla(departamentos);
			if (empty($photos)){
					$mensaje_resultado = 'No se encontraron resultados para su busqueda '.$buscar;
				}else{
					$mensaje_resultado = 'Se encontraron los siguiente productos/servicios para '.$buscar;
				}
		}   
		include("vistas/catalogos/catalogacion.inc.php");
	}
?>
<!--End Main -->


<!-- Start of page footer -->
<?php 
include("vistas/footer.html");

function showimage($photoid){
	header("Content-type: image/jpg");
	$query = "SELECT foto FROM fotos WHERE fotoid = $photoid";
	$result = mysql_query($query) or die('no encontramos las fotos');
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$foto = $row['foto'];
	echo $foto;
}

?>
<!-- End of page footer -->

<!-- este codigo para cargar mas productos -->
<script type="text/javascript" src="assets/js/cargarMasCatalogos.js"></script>