<?php
class buscado extends pagina
{
	function buscar_palabra($keyword,$tabla){
		//buscare en todas las cuatro tablas para anuncios
		$query = "SELECT * FROM $tabla WHERE titulo REGEXP '$keyword'";
		$result = mysql_query($query);
		$i=0;
		$resultados = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			foreach ($row as $key => $value){
				$resultados[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $resultados;
	}
	// buscar la palabra en el titulo o e texto del anuncio
	function encontrar_palabra($keyword,$tabla,$identificador){
		//buscare en todas las cuatro tablas para anuncios
		$query = "SELECT * FROM $tabla WHERE titulo REGEXP '$keyword' or $identificador REGEXP '$keyword'";
		$result = mysql_query($query);
		$i=0;
		$resultados = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			foreach ($row as $key => $value){
				$resultados[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $resultados;
	}
	//buscar la palabra en el titulo, el texto del anuncio y la ciudad
	function buscar_terminos($keyword,$tabla,$identificador,$terminosciudad){
		//buscare en todas las cuatro tablas para anuncios
		$query = "SELECT * FROM $tabla WHERE titulo REGEXP '$keyword' or $identificador REGEXP '$keyword' and ciudad REGEXP '$terminosciudad'";
		$result = mysql_query($query);
		$i=0;
		$resultados = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			foreach ($row as $key => $value){
				$resultados[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $resultados;
	}
	//buscar las palabras en el titulo, el texto del anuncio y la ciudad ordenando los resultados en orden descendente
	function encontrar_terminos($keyword,$tabla,$identificador,$terminosciudad,$offset,$records){
		//buscare en todas las cuatro tablas para anuncios
		$query = "SELECT * FROM $tabla WHERE titulo REGEXP '$keyword' or $identificador REGEXP '$keyword' and ciudad REGEXP '$terminosciudad' ORDER BY productoid DESC LIMIT $offset, $records";
		$result = mysql_query($query);
		$i=0;
		$resultados = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			foreach ($row as $key => $value){
				$resultados[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $resultados;
	}
	//buscar las palabras con los terminos que se le envian a la funcion
	function buscar_entabla_or_limit($tabla,$identificador1,$identificador2,$keyword,$ordenador,$offset,$records){
		//buscare en todas las cuatro tablas para anuncios
		$query = "SELECT * FROM $tabla WHERE $identificador1 REGEXP '$keyword' or $identificador2 REGEXP '$keyword' ORDER BY $ordenador DESC LIMIT $offset, $records";
		$result = mysql_query($query);
		$i=0;
		$resultados = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			foreach ($row as $key => $value){
				$resultados[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $resultados;
	}
	//buscar las palabras en una solo columna de la tabla
	function buscar_entabla($tabla,$identificador1,$keyword,$ordenador,$offset,$records){
		//buscare en todas las cuatro tablas para anuncios
		$query = "SELECT * FROM $tabla WHERE $identificador1 REGEXP '$keyword' ORDER BY $ordenador DESC LIMIT $offset, $records";
		$result = mysql_query($query);
		$i=0;
		$resultados = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			foreach ($row as $key => $value){
				$resultados[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $resultados;
	}
	// selecionar dos columnas de la tabla donde se encuentren estas palabras en una sola columna de la tabla
	function buscar_entabla_dos($tabla,$selecion1,$selecion2,$identificador1,$keyword,$ordenador,$offset,$records){
		//buscare en todas las cuatro tablas para anuncios
		$query = "SELECT $selecion1, $selecion2 FROM $tabla WHERE $identificador1 REGEXP '$keyword' ORDER BY $ordenador DESC LIMIT $offset, $records";
		$result = mysql_query($query);
		$i=0;
		$resultados = array();
		while($row = mysql_fetch_array($result,MYSQL_ASSOC))
		{
			foreach ($row as $key => $value){
				$resultados[$i][$key] = $value;
			}
			$i = $i+1;
		}
		return $resultados;
	}

	//buscar los portafolios de empresas con portafolios
	function buscar_portafolios($keyword,$connection,$offset,$records){
		$respuestas = array();
		$sql = "SELECT companies.empresaid, companies.empresa, companies.clase, portafolios.url FROM companies, portafolios WHERE companies.empresa REGEXP ? AND companies.empresaid = portafolios.empresaid ORDER BY companies.empresaid DESC LIMIT $offset,$records";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param('s',$keyword);
		$stmt->execute();
		$stmt->bind_result($empresaid, $empresa, $clase, $url);
		$i = 0;
		while($stmt->fetch())
		{
			$respuestas[$i]['empresaid'] = $empresaid;
			$respuestas[$i]['empresa'] = $empresa;
			$respuestas[$i]['categoria'] = $clase;
			$respuestas[$i]['url'] = $url;
			$i=$i+1;
		}
		return $respuestas;
	}

	//buscar los enlaces en la pagina de favoritos
	function buscar_enlaces($connection,$keyword,$offset,$records){
		$respuestas = array();
		$sql = "SELECT productoid, nombre, catid, url FROM favoritos WHERE nombre REGEXP ? ORDER BY productoid DESC LIMIT $offset, $records";
		$stmt = $connection->prepare($sql);
		$stmt->bind_param('s',$keyword);

		$stmt->execute();
		$stmt->bind_result($productoid, $nombre, $catid, $url);
		

    	$i = 0;
		while($stmt->fetch())
		{
			$respuestas[$i]['productoid'] = $productoid;
			$respuestas[$i]['nombre'] = $nombre;
			$respuestas[$i]['categoria'] = $catid;
			$respuestas[$i]['url'] = $url;
			$i=$i+1;
		}
		return $respuestas;

	}
}
?>