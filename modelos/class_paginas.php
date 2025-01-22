<?php
class pagina{

// entrar a la base de datos de construcali con la extension MySQLi
function conectar(){
	$con = mysqli_connect("mysql","foj2kctnsmekfp6g_construcali","casaGrandeSur2EGNE2","foj2kctnsmekfp6g_construcali");

	// Check connection
	if (mysqli_connect_errno()) {
	  	return 0;
	}else{
		return $con;
	}
}

// entrar a la base de datos de servicios con la extension MySQLi
function conexion(){
	$con = mysqli_connect("mysql","foj2kctnsmekfp6g_construcali","casaGrandeSur2EGNE2","foj2kctnsmekfp6g_servicios");

	// Check connection
	if (mysqli_connect_errno()) {
	  	return 0;
	}else{
		return $con;
	}
}

// entrar a la bae de dato de informacion con la extension MySQLi
function conecto(){
	$con = mysqli_connect("mysql","foj2kctnsmekfp6g_construcali","casaGrandeSur2EGNE2","foj2kctnsmekfp6g_informacion");

	// Check connection
	if (mysqli_connect_errno()) {
	  	return 0;
	}else{
		return $con;
	}
}

//entra a la base de datos construcali, next password: casaGrandeSur2EGNE2
function login()
	{
		$con = mysql_connect("mysql", "foj2kctnsmekfp6g_construcali", "casaGrandeSur2EGNE2") or  die('Disculpe, no se pudo establecer conexion al servidor');
		mysql_select_db("foj2kctnsmekfp6g_construcali", $con) or die('Disculpe, no se pudo conectar a la base de datos');
	}
//entrar a la base de datos servicios
function entrar(){
		$con = mysql_connect("mysql", "foj2kctnsmekfp6g_construcali", "casaGrandeSur2EGNE2") or  die('Disculpe, no se pudo establecer conexion al servidor');
		mysql_select_db("foj2kctnsmekfp6g_servicios", $con) or die('Atencion, no pudimos conectarnos a la base de datos');
}
//entrar a la base de datos de informacion
function abrir()
	{
		$con = mysql_connect("mysql", "foj2kctnsmekfp6g_construcali", "casaGrandeSur2EGNE2") or  die('Disculpe, no se pudo establecer conexion al servidor');
		mysql_select_db("foj2kctnsmekfp6g_informacion", $con) or die('Atencion, no pudimos conectarnos a la base de datos');
	}
//verificar si el usuario esta registrado
function verificar_usuario($email,$password){
	$query = "SELECT usuarioid, nombre from usuarios where email = '$email' and password = PASSWORD('$password')";
	$result = mysql_query($query);
	$row = mysql_num_rows($result);
	if ($row > 0)
	{
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$usuarioid = $row['usuarioid'];
		$nombre = $row['nombre'];
		$_SESSION['usuario'] = $usuarioid;
		$_SESSION['nombre'] = $nombre;
		$_SESSION['usuario_email'] = $email;

		//crear registro de visita
		$query2Visita = "SELECT visita FROM visitas WHERE usuarioid = $usuarioid";
		$result2Visita = mysql_query($query2Visita);
		$row2Visita = mysql_fetch_array($result2Visita);
		if($row2Visita[0] > 0){
			$newVisita = $row2Visita[0] + 1;
			$query3Visita = "UPDATE visitas SET visita = $newVisita WHERE usuarioid = $usuarioid";
			$result3Visita = mysql_query($query3Visita);
		}else
		{
			$queryVisita = "INSERT INTO visitas (usuarioid, paginaid, visita) values ($usuarioid,2,1)";
			$resultVisita = mysql_query($queryVisita);
		}

		return $usuarioid;	
	}else
	{
		return false;
	}
}

function verificar_usuaria($connection,$email,$password){
	$query = "SELECT usuarioid, nombre from usuarios where email = ? and password = PASSWORD('$password')";
	$stmt = $connection->prepare($query);
	$stmt->bind_param('s',$email);
	$stmt->execute();
	$stmt->bind_result($usuarioid,$nombre);
	$found = $stmt->fetch();
	if ($found === true)
	{
		$_SESSION['usuario'] = $usuarioid;
		$_SESSION['nombre'] = $nombre;
		$_SESSION['usuario_email'] = $email;

		//crear registro de visita
		$query2Visita = "SELECT visita FROM visitas WHERE usuarioid = $usuarioid";
		$result2Visita = mysqli_query($connection,$query2Visita);
		$row2Visita = mysqli_fetch_array($connection,$result2Visita);
		if($row2Visita[0] > 0){
			$newVisita = $row2Visita[0] + 1;
			$query3Visita = "UPDATE visitas SET visita = $newVisita WHERE usuarioid = $usuarioid";
			$result3Visita = mysqli_query($connection,$query3Visita);
		}else
		{
			$queryVisita = "INSERT INTO visitas (usuarioid, paginaid, visita) values ($usuarioid,2,1)";
			$resultVisita = mysqli_query($connection,$queryVisita);
		}

		return $usuarioid;	
	}else
	{
		return 0;
	}
}

//revisar email
function revisar_email($email){
	$query = "SELECT * from usuarios where email = '$email'";
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
		if ($rows >= 1)
			return true;
		else
			return false;
}

//revisar si el email ya existe
	function existe_email($connection,$email){
		$query = "SELECT usuarioid from usuarios where email = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->bind_result($usuarioid);
		$found = $stmt->fetch();
		if ($found === true)
			return true;
		else
			return false;
	}

//revisar si el usuarioid ya existe
	function existe_usuario($connection,$subscriptorid){
		$query = "SELECT usuarioid from usuarios where usuarioid = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i', $subscriptorid);
		$stmt->execute();
		$stmt->bind_result($usuarioid);
		$found = $stmt->fetch();
		if ($found === true)
			return true;
		else
			return false;
	}

// revisar si existe el subscriptor
function verificar_subscriptor($connection,$subscriptorid)
		{
			$query = "SELECT usuarioid from subscriptores where usuarioid = ?";
			$stmt = $connection->prepare($query);
			$stmt->bind_param('i', $subscriptorid);
			$stmt->execute();
			$stmt->bind_result($usuarioid);
			$found = $stmt->fetch();
			if ($found === true)
				return true;
			else
				return false;
		}


//verificar temporal
function verificar_temporal($email,$password){
	$query = "SELECT email, clave from temporales where email = '$email' and clave = PASSWORD('$password')";
	$result = mysql_query($query);
	$row = mysql_num_rows($result);
	if ($row)
	{
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$email = $row['email'];
		$clave = $row['clave'];
		$query1 = "SELECT usuarioid, nombre FROM usuarios WHERE email ='$email'";
		$result1 = mysql_query($query1) or die('no pudimos encontrar su perfil de usuario');
		$row1 = mysql_fetch_array($result1, MYSQL_ASSOC);
		$usuarioid = $row1['usuarioid'];
		$nombre = $row1['nombre'];

		$_SESSION['usuario'] = $usuarioid;
		$_SESSION['nombre'] = $nombre;
		$_SESSION['usuario_email'] = $email;

		$query2= "UPDATE usuarios SET password = '$clave' WHERE usuarioid = $usuarioid";
		$result2 = mysql_query($query2);
		
		$query3 = "DELETE FROM temporales WHERE email = '$email'";
		$result3 = mysql_query($query3);
		
		return $usuarioid;	
	}else
	{
		return false;
	}
}	
//conseguir la categoria con la catid
function set_categoria($catid){
		$query2 ="SELECT categoria FROM categorias WHERE catid = $catid";
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_array($result2); 
		$clase = $row2['categoria'];
		return $clase;
}
//conseguir la informacion de las empresas
function mostrar_empresas($offset,$limit)
	{
		$query = "SELECT empresaid, empresa, ciudad, servicio, clase, telefono, url FROM companies ORDER BY empresaid desc limit $offset, $limit";
	   	$result = mysql_query($query) or die('Disculpe, estamos en mantenimiento');	
		$i = 0; //index - row
		$companias = array(); // guardar un arry multidimensional -index es row and column - renglon y columna
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$companias[$i]['empresaid'] = $row['empresaid'];
			$companias[$i]['empresa'] = $row['empresa'];
			$companias[$i]['ciudad'] = $row['ciudad'];
			$service = $row['servicio'];
			$service = nl2br($service);
			$service = strip_tags($service);
			$companias[$i]['servicio'] = substr($service,0,200);
			$catid = $row['clase'];
			$companias[$i]['telefono'] = $row['telefono'];
			$companias[$i]['url'] = $row['url'];
			
			$query2 ="SELECT categoria FROM categorias WHERE catid = $catid";
			$result2 = mysql_query($query2);
			$row2 = mysql_fetch_array($result2); 
			$clase = $row2['categoria'];
			$companias[$i]['categoria'] = $clase;
			$i = $i+1;
		}
		return $companias;
	}
	//conseguir las categorias sin contar cuantas empresas hay en cada categoria
function get_categorias()
	{
		$query = "SELECT * FROM categorias ORDER BY categoria asc";
		$result = mysql_query($query) or die('Disculpe no encontramos las categorias de la empresa');
		$i=0;
		$categories = array();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$categories[$i]['catid'] = $row['catid'];
			$categories[$i]['categoria'] = $row['categoria'];
			$i = $i+1;
		}
		return $categories;
	}
	//conseguir las categorias y contar cuantas empresa hay en cada categoria
function contar_categorias()
	{
		$query = "SELECT * FROM categorias ORDER BY categoria asc";
		$result = mysql_query($query) or die('Disculpe no encontramos las categorias de la empresa');
		$i=0;
		$categories = array();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$claseid = $row['catid'];
			$categories[$i]['catid'] = $row['catid'];
			$categories[$i]['categoria'] = $row['categoria'];
			$query2 = "SELECT empresaid FROM companies WHERE clase = $claseid";
			$result2 = mysql_query($query2);
			$totcategories = mysql_num_rows($result2);
			$categories[$i]['cantidad'] = $totcategories;
			$i = $i+1;
		}
		return $categories;
	}
	//conseguir la informacion de las empresas en una categoria especifica
	function con_empresas_cat($offset,$limit,$catid)
	{
		$query = "SELECT empresaid, empresa, ciudad, servicio, clase, telefono, url, email, contacto FROM companies WHERE clase = $catid ORDER BY empresaid desc limit $offset, $limit";
	   	$result = mysql_query($query) or die('Disculpe, estamos en mantenimiento');	
		$i = 0; //index - row
		$companias = array(); // guardar un arry multidimensional -index es row and column - renglon y columna
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$companias[$i]['empresaid'] = $row['empresaid'];
			$companias[$i]['empresa'] = $row['empresa'];
			$companias[$i]['ciudad'] = $row['ciudad'];
			$service = $row['servicio'];
			$service = nl2br($service);
			$service = strip_tags($service);
			$companias[$i]['servicio'] = substr($service,0,200);
			$catid = $row['clase'];
			$companias[$i]['telefono'] = $row['telefono'];
			$companias[$i]['url'] = $row['url'];
			$companias[$i]['email'] = $row['email'];
			$companias[$i]['contacto'] = $row['contacto'];
			$i = $i+1;
		}
		return $companias;
	}
	//conseguir la informacion de una empresa especifica
	function con_empresa_id($empresaid)
	{
		$query = "SELECT email, telefono, empresa, ciudad, url, servicio, contacto, mision, direcion, clase, tipo FROM companies WHERE empresaid = $empresaid";
	   	$result = mysql_query($query) or die('Disculpe, no encontramos la empresa especifica');	
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$compania['email'] = $row['email'];
			$compania['telefono'] = $row['telefono'];
			$compania['empresa'] = $row['empresa'];
			$compania['ciudad'] = $row['ciudad'];
			$compania['url'] = $row['url'];
			//conseguir el departamento de la empresa
			$departamentoid = $row['tipo']; // este es el numero para el departamento del pais
			$query1 = "SELECT departamento FROM departamentos WHERE productoid = $departamentoid";
			$result1 = mysql_query($query1);
			$row1 = mysql_fetch_array($result1);
			$compania['departamento'] = $row1['departamento'];
			//conseguir el servicio, mision, contacto, direcion y categoria de la empresa
			$servicio = $row['servicio'];
			$servicio = strtolower($servicio);
			$servicio = ucfirst($servicio);
			$compania['servicio'] = $servicio;
			$compania['contacto'] = $row['contacto'];
			$mision = $row['mision'];
			$mision = strtolower($mision);
			$mision = ucfirst($mision);
			$compania['mision'] = $mision;
			$direcion = $row['direcion'];
				$direcion_array = explode(' ',$direcion);
				$numero = count($direcion_array);
				$name = array();
				for ($i=0; $i<$numero; $i++){
					$name[$i] = strtolower($direcion_array[$i]);
					$name[$i] = ucfirst($name[$i]);
				}
				$address = implode(' ', $name);
			$compania['direcion'] = $address;
			//conseguir la categoria de la empresa
			$catid = $row['clase'];
			$compania['catid'] = $catid;
			$query2 ="SELECT categoria FROM categorias WHERE catid = $catid";
			$result2 = mysql_query($query2);
			$row2 = mysql_fetch_array($result2); 
			$clase = $row2['categoria'];
			$compania['categoria'] = $clase;
		}
		return $compania;
	}
	//conseguir las fotoid de la tabla fotos para una empresaid
	function con_fotoid($empresaid){
		$query = "SELECT fotoid, descripcion, foto FROM fotos WHERE empresaid = $empresaid ORDER BY fotoid DESC LIMIT 0,9";
   		$result = mysql_query($query);
   		$i = 0;//index
   		$photos = array();
   		while ($row=mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$photos[$i]['fotoid'] = $row['fotoid'];
			$photos[$i]['descripcion'] = $row['descripcion'];
			$photos[$i]['foto'] = $row['foto'];
			$i=$i+1;
		}
		return $photos;	
	}
	//conseguir la casilla de una tabla
	function con_casilla($casilla,$tabla,$id,$numeroid){
		$query = "SELECT $casilla FROM $tabla WHERE $id = $numeroid";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$info = $row[$casilla];
		return $info;
	}
	//conseguir la casilla de una tabla con mysqli
	function con_casilla_sqli($conn,$casilla,$tabla,$id,$numeroid){
		$sql = "SELECT $casilla FROM $tabla WHERE $id = $numeroid";
		if ($result = mysqli_query($conn, $sql)) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  			$info = $row[$casilla];
			return $info;
		} else {
  			return false;
		}
	}
	//conseguir varios arrays de una tabla
	function con_tabla($tabla){
		$respuestas = array();
		$query = "SELECT * FROM $tabla";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir dos valores de una tabla
	function con_dos_tabla($primero,$segundo,$tabla){
		$respuestas = array();
		$query = "SELECT $primero, $segundo FROM $tabla";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$catid = $row[$primero];
			$categoria = $row[$segundo];
			$respuestas[$catid] = $categoria;
		}
		return $respuestas;
	}
	// conseguir una tabla de dos x dos
	function con_matrix_dos($primero,$segundo,$tabla){
		$query = "SELECT $primero, $segundo FROM $tabla ORDER BY $segundo ASC";
		$result = mysql_query($query) or die('Disculpe no encontramos las categorias de la empresa');
		$i=0;
		$categories = array();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$categories[$i][$primero] = $row[$primero];
			$categories[$i][$segundo] = $row[$segundo];
			$i = $i+1;
		}
		return $categories;
	}
	// conseguir una tabla de dos x dos
	function con_matrix_tres($primero,$segundo,$tercero,$tabla){
		$query = "SELECT $primero, $segundo, $tercero FROM $tabla ORDER BY $primero ASC";
		$result = mysql_query($query) or die('Disculpe no encontramos las categorias de la empresa');
		$i=0;
		$categories = array();
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$categories[$i][$primero] = $row[$primero];
			$categories[$i][$segundo] = $row[$segundo];
			$categories[$i][$tercero] = $row[$tercero];
			$i = $i+1;
		}
		return $categories;
	}
	//conseguir un array de una tabla
	function con_tabla_unarray($tabla){
		$respuestas = array();
		$query = "SELECT * FROM $tabla";
		$result = mysql_query($query);
		$rows = mysql_fetch_array($result, MYSQL_ASSOC);
		foreach ($rows as $row) {
			foreach ($row as $key => $value) {
				$respuestas[$key] = $value;
			}
		}
		return $respuestas;
	}
	//Poner el comienzo de cada nombre o palabra en mayuscula
	function nombre_formateado($nombre){
		$nombre_array = explode(' ',$nombre);
		$numero_de_nombres = count($nombre_array);
		$name = array();
		
		for ($i=0; $i<$numero_de_nombres; $i++)
		{
			$name[$i] = strtolower($nombre_array[$i]);
			$name[$i] = ucfirst($name[$i]);
			//echo $name[$i];
		}	
		
		$sustantivo = implode(' ', $name);
		return $sustantivo;
	}
	//conseguir cuantas empresas hay en una categoria
	function contar_empresas($catid){
		$pregunta = "SELECT count(empresaid) from companies WHERE clase = $catid";
		$resultado = mysql_query($pregunta);
		$numero = mysql_fetch_array($resultado);
		return $numero[0];
	}
	//contar ids sin una restrincion
	function contar_records($productoid,$tabla){
		$pregunta = "SELECT count($productoid) from $tabla";
		$resultado = mysql_query($pregunta);
		$numero = mysql_fetch_array($resultado);
		return $numero[0];
	}
	//contar ids de columna que empieze con una letra
	function contar_records_like($productoid,$tabla,$identificador,$letra){
		$pregunta = "SELECT count($productoid) FROM $tabla WHERE $identificador LIKE '$letra%'";
		$resultado = mysql_query($pregunta);
		$numero=mysql_fetch_array($resultado);
		return $numero[0];
	}
	//conseguir cuantos productos ids hay en una tabla para una categoria
	function contar_ids($productoid,$tabla,$identificador,$selecionador){
		$pregunta = "SELECT count($productoid) from $tabla WHERE $identificador = '$selecionador'";
		$resultado = mysql_query($pregunta);
		$numero = mysql_fetch_array($resultado);
		return $numero[0];
	}
	//conseguir varios arrays de una tabla con limites
	function con_tabla_limit($tabla,$offset,$recordsperpage){
		$respuestas = array();
		$query = "SELECT * FROM $tabla LIMIT $offset, $recordsperpage";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir varios arrays de una tabla con un id
	function con_tabla_id($tabla,$id,$numeroid){
		$query = "SELECT * FROM $tabla WHERE $id = '$numeroid'";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir un array unidimensional de un tabla con una id
	function con_tabla_unid($tabla,$id,$numeroid){
		$query = "SELECT * FROM $tabla WHERE $id = '$numeroid'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		foreach ($row as $key => $value) {
			$respuestas[$key] = $value;
		}
		return $respuestas;
	}
	// conseguir un array unidimensional de una tabla con una id usando sqli
	function con_tabla_unid_sqli($conn,$tabla,$id,$numeroid){
		$sql = "SELECT * FROM $tabla WHERE $id = $numeroid";
		if ($result = mysqli_query($conn, $sql)) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			foreach ($row as $key => $value){
				$respuestas[$key] = $value;
			}
			return $respuestas;
		}else {
  			return false;
		}
	}

	//conseguir informacion de las empresas o cualquier tabla con un nombre de casilla
	//esta es la misma funcion que con_tabla_id, mas ya estoy usando las dos funciones en el portal jeje
	function con_empresa($tabla,$identificador,$selecionador){
		$query = "SELECT * FROM $tabla WHERE $identificador = '$selecionador'";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir todas las mismas casillas de una tabla
	function get_casillas($casilla,$tabla){
		$query = "SELECT $casilla FROM $tabla";
		$result = mysql_query($query);
		$i=0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{	
			$sector[$i] = $row[$casilla];
			$i=$i+1;
		}
		$respuestas = array_unique($sector);
		asort($respuestas);
		return $respuestas;	
	}

	//conseguir todas las mismas casillas de una tabla
	function get_casillas_sqli($con,$casilla,$tabla){
		$query = "SELECT $casilla FROM $tabla";
		$result = mysqli_query($con,$query);
		$i=0;
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{	
			$sector[$i] = $row[$casilla];
			$i=$i+1;
		}
		$respuestas = array_unique($sector);
		asort($respuestas);
		return $respuestas;	
	}

	//conseguir todas las casillas de una tabla con la misma id
	function get_casillas_id($casilla,$tabla,$identificador,$productoid){
		$respuestas = array();
		$query = "SELECT $casilla FROM $tabla WHERE $identificador = $productoid";
		$result = mysql_query($query);
		$i=0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$correos[$i] = $row[$casilla];
			$i=$i+1; 
		}
		return $correos;
	}

	// conseguir la informacion y ordenarla en orden descendiente sin limites
	function con_tabla_ordenada($tabla,$identificador){
		$respuestas = array();
		$query = "SELECT * FROM $tabla ORDER BY $identificador ASC";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir la informacion de y ordenarla en orden descendiente
	function con_info_desc($tabla,$identificador,$offset,$recordsperpage){
		$respuestas = array();
		$query = "SELECT * FROM $tabla ORDER BY $identificador DESC LIMIT $offset, $recordsperpage";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir informacion sin repetir un parametro (select distinct)
	function con_info_distinta_desc($tabla,$identificador,$orderid,$offset,$recordsperpage){
		$respuestas = array();
		$query = "SELECT DISTINCT $identificador FROM $tabla ORDER BY $orderid DESC LIMIT $offset, $recordsperpage";
		$result = mysql_query($query);
		//$respuestas = mysql_fetch_array($result, MYSQL_ASSOC);
		$i = 0;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i++;
		}

		return $respuestas;
	}
	//conseguir la informacion filtrada por una casilla y ordenarla en orden descendiente
	function con_donde_orden($tabla,$identificador,$selecionador,$ordenador){
		$respuestas = array();
		$query = "SELECT * FROM $tabla WHERE $identificador = '$selecionador' ORDER BY $ordenador DESC";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir la informacion filtrada por una casilla, ordenarla en orden descendiente y darle un limite
	function con_donde_order_limit($tabla,$identificador,$selecionador,$ordenador,$offset,$recordsperpage){
		$respuestas = array();
		$query = "SELECT * FROM $tabla WHERE $identificador = '$selecionador' ORDER BY $ordenador DESC LIMIT $offset,$recordsperpage";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir informacion de dos tablas
	function con_estos_portafolios($id,$offset,$recordsperpage){
		$respuestas = array();
		$query = "SELECT companies.empresaid, companies.empresa, portafolios.url FROM companies, portafolios WHERE companies.clase = $id and companies.empresaid = portafolios.empresaid ORDER BY companies.empresa DESC LIMIT $offset,$recordsperpage";
		$result = mysql_query($query) or die('No encontramos el termino que busca');
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row  as $key => $value){
				$respuestas[$i][$key] = $value;
			}
			$i=$i+1;
		}
		return $respuestas;
	}
	//conseguir la informacion que empiece por una letra filtrada por una casilla, ordenarla en forma descendiente y darle un limite
	function con_donde_order_limit_like($tabla,$identificador,$selecionador,$ordenador,$offset,$recordsperpage){
	$respuestas = array();
	$query = "SELECT * FROM $tabla WHERE $identificador LIKE '$selecionador%' ORDER BY $ordenador DESC LIMIT $offset,$recordsperpage";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
	//conseguir informacion de tabla filtrada por dos casillas, esta funcion es usada en el controlador de administrador
	function con_donde_dos($casilla,$tabla,$casillauna,$iduna,$casillados,$iddos){
		$respuestas = array();
		$query = "SELECT $casilla FROM $tabla WHERE $casillauna = $iduna AND $casillados = $iddos";
		$result = mysql_query($query);
		$i=0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$correos[$i] = $row[$casilla];
			$i=$i+1; 
		}
		return $correos;	
	}

	//conseguir la maxima id de una tabla
	function con_max_id($identificador,$tabla){
		$query = "SELECT max($identificador) FROM $tabla";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$id = $row[0];
		return $id;
	}
	
	//buscar palabra arbitraria
	function consigue_palabra_arbitraria($min, $max){
			$palabra = '';
			$diccionario = 'wordlist.txt';
			$fp = @fopen($diccionario, 'r');
			if (!$fp)
				return false;
			$size = filesize($diccionario);
			
			srand ((double) microtime() * 1000000);
			$rand_location = rand(0, $size);
			fseek($fp, $rand_location);
			
			while (strlen($palabra)< $min || strlen($palabra)>$max || strstr($palabra, " ' "))
			 {
			 	if (feof($fp))
					fseek($fp, 0);
				$palabra = fgets($fp, 80);
			 }
			 $palabra = trim($palabra);
			 return $palabra;
		}
	//conseguir puntaje de la empresa
	function puntaje_total($empresaid){
			$puntaje = 0;
			$query1 = "SELECT puntos FROM puntajes WHERE empresaid = $empresaid";
			$result1 = mysql_query($query1);
			while ($row1 = mysql_fetch_array($result1,MYSQL_ASSOC)){
			$puntos = $row1['puntos'];
			$puntaje += $puntos;
			}
			return $puntaje;
		}//end function
	//conseguir la fecha de la tabla
	function get_fecha($table, $productoid){
			$query = "SELECT date_format(date, '%d %m %Y') as fecha from $table where productoid = $productoid";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$fecha = $row['fecha'];
			$fecha_array = explode(' ', $fecha);
			$dia = $fecha_array[0];
			$mes = $fecha_array[1];
			$year = $fecha_array[2];
			
			switch($mes)
			{
				case '01' :
				$month = 'Enero';
				break;
				case '02' :
				$month = 'Febrero';
				break;
				case '03' :
				$month = 'Marzo';
				break;
				case '04' :
				$month = 'Abril';
				break;
				case '05' :
				$month = 'Mayo';
				break;
				case '06' :
				$month = 'Junio';
				break;
				case '07' :
				$month = 'Julio';
				break;
				case '08' :
				$month = 'Agosto';
				break;
				case '09' :
				$month = 'Septiembre';
				break;
				case '10' :
				$month = 'Octubre';
				break;
				case '11' :
				$month = 'Noviembre';
				break;
				case '12' :
				$month = 'Diciembre';
				break;
			}
			
			$nueva_fecha = $dia.' de '.$month.' del '.$year;
			return $nueva_fecha;
	}
	//conseguir la fecha de la tabla mandando el identificador
	//conseguir la fecha de la tabla
	function con_fecha($table, $identificador, $productoid){
			$query = "SELECT date_format(date, '%d %m %Y') as fecha from $table where $identificador = $productoid";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$fecha = $row['fecha'];
			$fecha_array = explode(' ', $fecha);
			$dia = $fecha_array[0];
			$mes = $fecha_array[1];
			$year = $fecha_array[2];
			
			switch($mes)
			{
				case '01' :
				$month = 'Enero';
				break;
				case '02' :
				$month = 'Febrero';
				break;
				case '03' :
				$month = 'Marzo';
				break;
				case '04' :
				$month = 'Abril';
				break;
				case '05' :
				$month = 'Mayo';
				break;
				case '06' :
				$month = 'Junio';
				break;
				case '07' :
				$month = 'Julio';
				break;
				case '08' :
				$month = 'Agosto';
				break;
				case '09' :
				$month = 'Septiembre';
				break;
				case '10' :
				$month = 'Octubre';
				break;
				case '11' :
				$month = 'Noviembre';
				break;
				case '12' :
				$month = 'Diciembre';
				break;
			}
			
			$nueva_fecha = $dia.' de '.$month.' del '.$year;
			return $nueva_fecha;
	}
	//formatera la fecha
	function formatear_fecha($fecha){
			$fecha_array = explode('-', $fecha);
			$year = $fecha_array[0];
			$mes = $fecha_array[1];
			$dia = $fecha_array[2];
			
			switch($mes)
			{
				case '01' :
				$month = 'Enero';
				break;
				case '02' :
				$month = 'Febrero';
				break;
				case '03' :
				$month = 'Marzo';
				break;
				case '04' :
				$month = 'Abril';
				break;
				case '05' :
				$month = 'Mayo';
				break;
				case '06' :
				$month = 'Junio';
				break;
				case '07' :
				$month = 'Julio';
				break;
				case '08' :
				$month = 'Agosto';
				break;
				case '09' :
				$month = 'Septiembre';
				break;
				case '10' :
				$month = 'Octubre';
				break;
				case '11' :
				$month = 'Noviembre';
				break;
				case '12' :
				$month = 'Diciembre';
				break;
			}
			
			$nueva_fecha = $dia.' de '.$month.' del '.$year;
			return $nueva_fecha;
	}
	//unir las dos tablas de productos y servicios
	function conseguir_los_anuncios($offset,$recordsperpage){
		$query_req = "SELECT 'articulo' As tipo, productoid, titulo, ciudad, sector, date, usuarioid FROM productos UNION SELECT 'labor', productoid, titulo, ciudad, sector, date, usuarioid FROM servicios ORDER BY date DESC LIMIT $offset,$recordsperpage";
		$resultados = mysql_query($query_req);
		return $resultados;
	}
	//unir las dos tablas anuncios y anouncements
	function conseguir_las_cotizaciones($offset,$recordsperpage){
		$query_req = "SELECT 'articulo' As tipo, productoid, titulo, ciudad, sector, date, usuarioid FROM anuncios UNION SELECT 'labor', productoid, titulo, ciudad, sector, date, usuarioid FROM anouncements ORDER BY date DESC LIMIT $offset,$recordsperpage";
		$resultados = mysql_query($query_req);
		return $resultados;
	}
	// conseguir la informacion de una columna donde una columna no este vacia
	//conseguir la informacion de y ordenarla en orden descendiente
	function con_info_nonull_desc($tabla,$columna,$identificador,$records){
		$respuestas = array();
		$query = "SELECT * FROM $tabla WHERE length($columna) > 1 ORDER BY $identificador DESC LIMIT $records";
		$result = mysql_query($query);
		$i = 0;
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			foreach ($row as $key => $value) {
				$respuestas[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $respuestas;
	}
}