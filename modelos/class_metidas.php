<?php
class metida extends pagina
{
	//Funciones para meter informacion a las bases de datos
	function registrar_cotizacion($usuarioid,$date,$estado,$catid,$ciudad){
		$query = "INSERT INTO cotizaciones (usuarioid, date, estado, catid, ciudad) VALUES ('$usuarioid', '$date', '$estado', '$catid', '$ciudad')";
		$result1 = mysql_query($query);
		//Coger Numero de Lista
		$query2 = "SELECT LAST_INSERT_ID() from cotizaciones";
		$result2 = mysql_query($query2);
		$row = mysql_fetch_array($result2);
		$ordenid = $row[0];
		return $ordenid;	
	}

	function meter_cotizacion($ordenid,$material,$cantidad,$unidad)
	{
		$query = "INSERT INTO cotizaciones_listas (ordenid, material, cantidad, unidades)"."VALUES ($ordenid, '$material', '$cantidad', '$unidad')";
		$result3 = mysql_query($query);
	}

	function registrar_orden($tabla,$usuarioid,$date,$estado,$catid,$ciudad){
		$query = "INSERT INTO $tabla (usuarioid, date, estado, catid, ciudad) VALUES ($usuarioid, '$date', $estado, $catid, '$ciudad')";
		$result = mysql_query($query);
		//coger el numero de la orden
		$query2 = "SELECT LAST_INSERT_ID() from $tabla";
		$result2 = mysql_query($query2);
		$row = mysql_fetch_array($result2);
		$ordenid = $row[0];
		return $ordenid;
	}

	function meter_orden($tabla,$ordenid,$servicio){
		$query = "INSERT INTO $tabla (ordenid, servicio)"."VALUES ($ordenid, '$servicio')";
		$result3 = mysql_query($query);
	}
	//meter la cotizacion de servicios en la tabla de anouncements
	function meter_proyecto($tabla,$titulo,$ciudad,$proyecto,$sector,$date,$usuarioid,$cotizacionid){
		$solicitud = "INSERT INTO $tabla (titulo, ciudad, anouncement, sector, date, usuarioid, cotizacionid)" . "VALUES ('$titulo', '$ciudad', '$proyecto', '$sector', '$date', $usuarioid, $cotizacionid)";

		$resultado = mysql_query($solicitud) or die('Disculpe, no pudimos publicar su clasificado en este momento');
	}
	//meter la cotizacion de servicios en la tabla de pedidos
	function meter_pedido($tabla,$titulo,$ciudad,$proyecto,$catid,$date,$usuarioid){
		$solicitud = "INSERT INTO $tabla (titulo, ciudad, anouncement, catid, date, usuarioid)" . "VALUES ('$titulo', '$ciudad', '$proyecto', '$catid', '$date', $usuarioid)";

		$resultado = mysql_query($solicitud) or die('Disculpe, no pudimos publicar su clasificado en este momento');

		//Coger Numero de Lista
		$query2 = "SELECT LAST_INSERT_ID() from $tabla";
		$result2 = mysql_query($query2);
		$row = mysql_fetch_array($result2);
		$ordenid = $row[0];
		return $ordenid;
	}
	//mete la cotizacion de materiales en la tabla de anuncios
	function meter_anuncio($titulo,$ciudad,$anuncio,$sector,$date,$usuarioid,$cotizacionid){
		$solicitud = "INSERT INTO anuncios (titulo, ciudad, anuncio, sector, date, usuarioid, cotizacionid)" . "VALUES ('$titulo', '$ciudad', '$anuncio', '$sector', '$date', '$usuarioid', '$cotizacionid')";

		$resultado = mysql_query($solicitud) or die('Disculpe, no pudimos publicar su clasificado en este momento');
	}

	function anunciar_producto($titulo,$deptid,$ciudad,$producto,$thumbnail,$sector,$date,$usuarioid){
		$query = "INSERT INTO productos (titulo, deptid, ciudad, producto, foto, sector, date, usuarioid)" . "VALUES ('$titulo', $deptid, '$ciudad', '$producto', '$thumbnail', '$sector', '$date', $usuarioid)";
		$result = mysql_query($query);
		//coger el numero del clasificado
		$query2 = "SELECT LAST_INSERT_ID() FROM productos";
		$result2 = mysql_query($query2);
		$row = mysql_fetch_array($result2);
		$clasificadoid = $row[0];
		return $clasificadoid;
	}
	//esta entra las funciones que se usa es para actualizar los puntos de una empresa.
	function meter_datos($table,$value1,$value2,$value3){
			$insert = "INSERT INTO $table values ($value1,$value2,$value3)";
			$resultado = mysql_query($insert);
		}

	function anunciar_servicio($titulo,$deptid,$ciudad,$servicio,$thumbnail,$sector,$date,$usuarioid){
		$query = "INSERT INTO servicios (titulo, ciudad, servicio, foto, sector, date, usuarioid)" . "VALUES ('$titulo', '$ciudad', '$servicio', '$thumbnail', '$sector', '$date', $usuarioid)";
		$result = mysql_query($query);
		//coger el numero del clasificado
		$query2 = "SELECT LAST_INSERT_ID() FROM servicios";
		$result2 = mysql_query($query2);
		$row = mysql_fetch_array($result2);
		$clasificadoid = $row[0];
		return $clasificadoid;
	}

	function meter_redes($empresaid,$facebook,$twitter,$linkedin){
		$query = "INSERT INTO redessociales (empresaid,facebook,twitter,linkedin)" . "VALUES ($empresaid,'$facebook','$twitter','$linkedin')";
		$resultado = mysql_query($query);
	}

	function meter_whatsapp($empresaid,$whatsapp){
		$query = "INSERT INTO redessociales (empresaid, whatsapp) VALUES ('$empresaid', '$whatsapp')";
		$resultado = mysql_query($query);
	}

	function meter_foto($empresaid,$descripcion,$precio,$unidad,$url){
		$query5 = "INSERT INTO fotos (empresaid, descripcion, precio, unidad, foto) " . " VALUES ('$empresaid', '$descripcion', '$precio', '$unidad', '$url')" ;
		$result5 = mysql_query($query5);
	}

	function meter_precios($respuestaid,$nombre,$cantidad,$valor,$subtotal,$unidades){
		$pedido = "INSERT INTO cotizaciones_precios (respuestaid, nombre, cantidad, precio, subtotal, unidades) VALUES($respuestaid,'$nombre','$cantidad','$valor','$subtotal','$unidades')";
		$resultado = mysql_query($pedido);
	}


	function meter_usuario($nombre,$apellidos,$ciudad,$email,$password){
		$query = "INSERT INTO usuarios (nombre, apellidos, ciudad, email, password) VALUES ('$nombre', '$apellidos','$ciudad', '$email', PASSWORD('$password'))";
		$result = mysql_query($query); 
		if ($result)
			{
				$query = "SELECT LAST_INSERT_ID() from usuarios";
				$result = mysql_query($query);
				$row =  mysql_fetch_array($result);
				$_SESSION['usuario'] = $row[0];
				$_SESSION['nombre'] = $nombre;
				//asignarle el numbero de usuario a una variable
				$usuarioid = $row[0];
				return $usuarioid;
			}
			else
			{
				return false;
			}
	}

	//meter usuarios con prepared statements
	function meter_usuaria($connection,$nombre,$apellidos,$ciudad,$email,$password){
		$query = "INSERT INTO usuarios (nombre, apellidos, ciudad, email, password) VALUES (?, ?, ?, ?, PASSWORD('$password'))";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ssss',$nombre,$apellidos,$ciudad,$email);
		$stmt->execute();
		$rows = $stmt->affected_rows;
		if ($rows > 0)
			{
				$result = $connection->query("SELECT LAST_INSERT_ID() from usuarios");
				$row =  $result->fetch_row();
				$_SESSION['usuario'] = $row[0];
				$_SESSION['nombre'] = $nombre;
				//asignarle el numbero de usuario a una variable
				$usuarioid = $row[0];
				return $usuarioid;
			}
			else
			{
				return false;
			}
	}

	//meter subscriptor con prepared stateements
	function meter_subscriptor($connection,$nombre,$apellidos,$ciudad,$email,$password){
		$query = "INSERT INTO subscriptores (nombre, apellidos, ciudad, email, password) VALUES (?, ?, ?, ?, PASSWORD('$password'))";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ssss',$nombre,$apellidos,$ciudad,$email);
		$stmt->execute();
		$rows = $stmt->affected_rows;
		if ($rows > 0)
			{
				$result = $connection->query("SELECT LAST_INSERT_ID() from subscriptores");
				$row =  $result->fetch_row();
				$_SESSION['usuario'] = $row[0];
				$_SESSION['nombre'] = $nombre;
				//asignarle el numbero de usuario a una variable
				$usuarioid = $row[0];
				return $usuarioid;
			}
			else
			{
				return false;
			}
	}

	function copiar_subscriptor($connection,$subscriptorid){
		$query = "INSERT INTO usuarios SELECT * FROM subscriptores WHERE usuarioid = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i', $subscriptorid);
		$stmt->execute();
		return $subscriptorid;
	}

	function meter_empresa($empresa,$usuarioid,$nombre,$email,$clase,$tipo,$telefono,$ciudad,$servicio,$mision,$url,$direcion){
		//tipo es el departamento del pais
		$query = "INSERT INTO companies (empresa, usuarioid, contacto, email, clase, tipo, telefono, ciudad, servicio, mision, url, direcion)" . "VALUES ('$empresa', '$usuarioid', '$nombre', '$email', '$clase', '$tipo', '$telefono', '$ciudad', '$servicio', '$mision', '$url', '$direcion')";
		$result = mysql_query($query);
		if ($result)
			{
				$pedido = "SELECT LAST_INSERT_ID() from companies";
				$resultado = mysql_query($pedido);
				$row =  mysql_fetch_array($resultado);
				$_SESSION['empresaid'] = $row[0];
				$sihayempresaid = $row[0];
				return $sihayempresaid;
			}
			else
			{
				return false;
			} 
	}

	function meter_temporal($email,$password){
		$query = "INSERT INTO temporales VALUES('$email',PASSWORD('$password'))";
		$result = mysql_query($query);
	}

	//funciones para meter y actualizar logos

	function meter_logo($sihayempresaid,$logoname,$logotype){
		$query = "INSERT INTO logos (empresaid, foto, tipo) VALUES ($sihayempresaid, '$logoname', '$logotype')";
		$result = mysql_query($query) or die('no pudimos subir su logo');
	}

	function subir_oferta($usuarioid,$empresaid,$url,$titulo,$descripcion,$categoria,$date,$unidad,$precio){
		$query = "INSERT INTO promociones (usuarioid, empresaid, url, titulo, descripcion, categoria, date, unidad, precio) VALUES ('$usuarioid', '$empresaid', '$url', '$titulo', '$descripcion', '$categoria', '$date', '$unidad', '$precio' )";
		$result = mysql_query($query);
	}

	// funciones para meter datos en general, usando identificadores de columnas
	function meter_dos_general($tabla,$casilla1,$casilla2,$value1,$value2){
		$query = "INSERT INTO $tabla ($casilla1, $casilla2) VALUES ('$value1', '$value2')";
		$result3 = mysql_query($query);
	}

	// funciones para meter datos en general, usando identificadores de columnas
	function meter_cuatro_general($tabla,$casilla1,$casilla2,$casilla3,$casilla4,$value1,$value2,$value3,$value4){
		$query = "INSERT INTO $tabla ($casilla1, $casilla2, $casilla3, $casilla4) VALUES ('$value1', '$value2', '$value3', '$value4')";
		$result3 = mysql_query($query);
	}

	// funcion para meter los datos en la tabla de articulos de la base de datos de informacion
	function meter_articulo($conn,$nombre,$unidad,$precio,$catid){
		$sql = "INSERT INTO articulos (nombre, unidad, precio, catid) VALUES ('$nombre', '$unidad', '$precio', '$catid')";

		if (mysqli_query($conn, $sql)) {
  			return true;
		} else {
  			return false;
		}
	}

	// funcion para calificar empresas y recomendarlas en la tabla de evaluaciones
	function calificar($connection,$evaluacion,$calificacion,$usuarioid,$empresaid,$date){
		$query = "INSERT INTO evaluaciones (evaluacion, calificacion, usuarioid, empresaid, fecha) VALUES (?, ?, ?, ?, ?)";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('siiis', $evaluacion, $calificacion, $usuarioid, $empresaid, $date);
		$stmt->execute();
		$rows = $stmt->affected_rows;
		if ($rows > 0){
			return true;
		}else{
			return false;
		}
	}

	// Funcion para subir portafolio en formato pdf a la tabla de portafolios
	function subir_portafolio($empresaid,$url){
		$query = "INSERT INTO portafolios (empresaid, url) VALUES ('$empresaid', '$url')";
		$result = mysql_query($query);
	}

	function subir_publicaciones($compania,$catid,$url){
		$pedido = "INSERT INTO publicaciones (nombre, catid, url) VALUES ('$compania', '$catid', '$url')";
		$resultado = mysql_query($pedido);
	}

	// Funciones para actualizar informacion 
	function update_redes($empresaid,$identificador,$redsocial){
		$query2 = "UPDATE redessociales SET $identificador = '$redsocial' WHERE empresaid = $empresaid";
		$result2 = mysql_query($query2);
	}

	function update_empresaid($tabla,$empresaid,$identificador,$informacion){
		$query3 = "UPDATE $tabla SET $identificador = '$informacion' WHERE empresaid = $empresaid";
		$result3 = mysql_query($query3);
	}

	// Funcion para editar el portafolio en formato pdf en la tabla de portafolios
	function update_portafolio($url,$empresaid){
		$query4 = "UPDATE portafolios SET url='$url' WHERE empresaid=$empresaid";
		$result = mysql_query($query4);
	}

	// funcion para actualizar una casilla con una id de identificador en una tabla
	// Funcion para editar la foto de la tabla de usuarios_perfiles
	function update_tabla_una($tabla,$casilla1,$casilla2,$value1,$value2){
		$query4 = "UPDATE $tabla SET $casilla2 = '$value2' WHERE $casilla1 = $value1";
		$result = mysql_query($query4);
	}

	function update_foto($descripcion,$foto,$fotoid){
		$query = "UPDATE fotos SET descripcion = '$descripcion', foto = '$foto' WHERE fotoid = $fotoid";
		$result = mysql_query($query);
	}

	function update_foto_descripcion($descripcion,$fotoid){
		$query = "UPDATE fotos SET descripcion = '$descripcion' WHERE fotoid = $fotoid";
		$result = mysql_query($query);
	}
	//actualizar el puntaje de una empresa
	function update_puntaje($sihayempresaid,$nuevopuntaje,$premioid,$fecha){
		$query2 = "INSERT INTO puntaje (empresaid, premioid, puntos, date)" . "VALUES ($sihayempresaid, $premioid, $nuevopuntaje, '$fecha')";
		$result2 = mysql_query($query2);		
	}

	// Funciones para borrar informacion de bases de datos
	function borrar_puntajes($productoid,$empresaid){
		$query6 = "DELETE FROM puntajes WHERE productoid = $productoid and empresaid = $empresaid limit 1"; 
		$result6 = mysql_query($query6);
	}

	function borrar_fotos($fotoid){
		$query7 = "DELETE FROM fotos WHERE fotoid = $fotoid";
		$result7 = mysql_query($query7);
	}

	function borrar_pedidos($ordenid){
		$query = "DELETE FROM pedidos WHERE ordenid = $ordenid";
		$result = mysql_query($query);
		$query1 = "DELETE FROM pedidos_respuestas WHERE ordenid = $ordenid";
		$result1 = mysql_query($query1);
		$query2 = "DELETE FROM pedidos_listas WHERE ordenid = $ordenid";
		$result2 = mysql_query($query2);
	}

	function borrar_materiales($ordenid){
		$query = "DELETE FROM cotizaciones WHERE ordenid = $ordenid";
		$result = mysql_query($query);
		$query1 = "DELETE FROM cotizaciones_listas WHERE ordenid = $ordenid";
		$result1 = mysql_query($query1);
		$query2 = "DELETE FROM cotizaciones_respuestas WHERE ordenid = $ordenid";
		$result2 = mysql_query($query2);
	}

	function borrar_correos($ordenid){
		$query = "DELETE FROM intercambios WHERE ordenid = $ordenid";
		$result = mysql_query($query);
		$query1 = "DELETE FROM intercambios_listas WHERE ordenid = $ordenid";
		$result1 = mysql_query($query1);
	}

	function borrar_cotizaciones_precios($respuestaid){
		$query = "DELETE FROM cotizaciones_precios WHERE respuestaid = $respuestaid";
		$result = mysql_query($query);
	}

	function borrar_listas($ordenid){
		$query = "DELETE FROM ordenes WHERE ordenid = $ordenid";
		$result = mysql_query($query);
		$query1 = "DELETE FROM ordenes_insumos WHERE ordenid = $ordenid";
		$result1 = mysql_query($query1);
	}

	function borrar_servicio($ordenid){
		$query = "DELETE FROM servicios WHERE productoid = $ordenid";
		$result = mysql_query($query);
	}

	function borrar_producto($ordenid){
		$query = "DELETE FROM productos WHERE productoid = $ordenid";
		$result = mysql_query($query);
	}

	function borrar_promocion($ordenid){
		$query = "DELETE FROM promociones WHERE productoid = $ordenid";
		$result = mysql_query($query);
	}

	//borrar usuario de la tabla de subscriptores con mysqli y dictados preparados
	function borrar_usuario($connection,$subscriptorid){
		$query = "DELETE FROM subscriptores WHERE usuarioid = ? LIMIT 1";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i', $subscriptorid);
		$stmt->execute();
		$deleted =  $stmt->affected_rows;
		if ($deleted == 1)
			return true;
		else
			return false;
	}

	//borrar el renglon de una tabla
	function borrar_renglon($tabla,$productoid,$ordenid){
		$query = "DELETE FROM $tabla WHERE $productoid = $ordenid";
		$result = mysql_query($query);
	}

	//borrar la casilla de una tabla
	function borrar_casilla($tabla,$casilla,$productoid,$ordenid){
		$query = "DELETE $casilla FROM $tabla WHERE $productoid = $ordenid";
		$result = mysql_query($query);
	}

	// Funciones para responder
	function responder_pedido($ordenid,$userid,$empresaid,$output,$date){
		$query = "INSERT INTO pedidos_respuestas (ordenid, usuarioid, companyid, respuesta, date) VALUES ($ordenid, $userid, $empresaid, '$output', '$date')";
		$result = mysql_query($query);
	}

	function responder_cotizacion($ordenid,$userid,$companyid,$date){
		$query = "INSERT INTO cotizaciones_respuestas (ordenid, usuarioid, companyid, date) VALUES ($ordenid, $userid, $companyid, '$date')";
		$result = mysql_query($query);
		$query1 = "SELECT LAST_INSERT_ID() from cotizaciones_respuestas";
		$result1 = mysql_query($query1);
		$row =  mysql_fetch_array($result1);
		$respuestaid = $row[0];
		return $respuestaid; 
	}

	// actualizar toda la informacion de un usuario
	function actualizar_usuario($nombre,$apellidos,$telefono,$ciudad,$email,$usuarioid,$departamentoid){
		$query = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', telefono='$telefono', ciudad='$ciudad', email='$email', deparid = '$departamentoid' WHERE usuarioid = $usuarioid";
		$result = mysql_query($query);
	}
	//actualizar solamente una informacion de un usuario
	function actualizar_usuario_dato($estacasilla,$estedato,$usuarioid){
		$query = "UPDATE usuarios SET $estacasilla = '$estedato' WHERE usuarioid = $usuarioid";
		$result = mysql_query($query);
	}

	//verificar si el usuario esta registrado
	function verificar_usuario($email,$password1){
		$query = "SELECT usuarioid, nombre from usuarios where email = '$email' and password = PASSWORD('$password1')";
		$result = mysql_query($query);
		$row = mysql_num_rows($result);
		if ($row)
		{
			return true;	
		}else
		{
			return false;
		}
	}

	function actualizar_clave($usuarioid,$password){
		$query = "UPDATE usuarios SET password = password('$password') WHERE usuarioid = $usuarioid";
		$result = mysql_query($query);
			if ($result)
				return true;
			else
				return false;
	}

	function actualizar_logo($sihayempresaid,$logoname,$logotype){
		$query = "UPDATE logos set foto = '$logoname', tipo = '$logotype' where empresaid = $sihayempresaid";
		$result = mysql_query($query) or die('no pudimos editar el logo');
	}	
	//Despues de aqui pongo las funciones para el carrito de articulos
	//sumo todos los precios de los articulos en el carrito
	function calcular_total($carrito){
		$total = 0.0;
		if(is_array($carrito))
		{
			foreach ($carrito as $insumoid => $cantidad) {
				$query = "SELECT precio FROM articulos WHERE insumoid = '$insumoid'";
				$result = mysql_query($query) or die('no pudimos encontar el articulo');
				if ($result)
				{
					$row = mysql_fetch_array($result,MYSQL_ASSOC);
					$precio = $row['precio'];
					$total += $precio * $cantidad;
				}
			}
		}
		return $total;
	}
	//contar los articulos en el carrito
	function contar_articulos($carrito){
		$items = 0;
		if (is_array($carrito))
		{
			$items = count($carrito);
		}
		return $items;
	}
	//hacer el listado en el carrito
	function hacer_lista($carrito){
		$i = 0;
		foreach ($carrito as $insumoid => $cantidad) {
			$query = "SELECT * FROM articulos WHERE insumoid = '$insumoid'";
			$result = mysql_query($query) or die('no pudimos encontar el articulo');
				if ($result)
				{
					$row = mysql_fetch_array($result,MYSQL_ASSOC);
					$listado[$i]['insumoid'] = $insumoid;
					$listado[$i]['cantidad'] = $cantidad;
					$precio = $row['precio'];
					$nombre = $row['nombre'];
					$nombre = htmlspecialchars($nombre);
					$listado[$i]['precio'] = $row['precio'];
					$listado[$i]['unidad'] = $row['unidad'];
					$listado[$i]['nombre'] = $nombre;
					$listado[$i]['subtotal'] = $precio * $cantidad;
					$i=$i+1;
				}
		}
		return $listado;
	}

	// calcular el valor total en la lista de actividades de analisis unitarios $session['preupuesto']
	//sumo todos los precios de los articulos en el carrito
	function calcular_valor_total($carrito){
		$total = 0.0;
		if(is_array($carrito))
		{
			foreach ($carrito as $insumoid => $cantidad) {
				$query = "SELECT precio FROM analisis WHERE insumoid = '$insumoid'";
				$result = mysql_query($query) or die('no pudimos encontrar el precio de la actividad');
				if ($result)
				{
					$row = mysql_fetch_array($result,MYSQL_ASSOC);
					$precio = $row['precio'];
					$total += $precio * $cantidad;
				}
			}
		}
		return $total;
	}

	//hacer el listado en el carrito
	function hacer_lista_tabla($carrito){
		$i = 0;
		foreach ($carrito as $insumoid => $cantidad) {
			$query = "SELECT * FROM analisis WHERE insumoid = '$insumoid'";
			$result = mysql_query($query) or die('no pudimos encontrar la actividad');
				if ($result)
				{
					$row = mysql_fetch_array($result,MYSQL_ASSOC);
					$listado[$i]['insumoid'] = $insumoid;
					$listado[$i]['cantidad'] = $cantidad;
					$precio = $row['precio'];
					$nombre = $row['nombre'];
					$nombre = htmlspecialchars($nombre);
					$listado[$i]['precio'] = $row['precio'];
					$listado[$i]['unidad'] = $row['unidad'];
					$listado[$i]['nombre'] = $nombre;
					$listado[$i]['subtotal'] = $precio * $cantidad;
					$i=$i+1;
				}
		}
		return $listado;
	}
}
?>