<?php
	session_start();
	include("../modelos/class_paginas.php");
	// include("../modelos/class_metidas.php");
	$main = new pagina();
	//$meto = new metida();
	$usuarioid = $_SESSION['usuario'];
	//conseguir la empresaid
	// recibir el mensaje
	$motivo = $_POST['titulo'];
	$mensaje = $_POST['texto'];
	$puntaje = $_POST['puntaje'];
	$receptores = $_POST['receptores'];
	
	// conectarse a la base de datos de construcali con mysqli
	$llave = $main->conectar();
	
	if ($llave == 0){
    	echo "No nos pudimos conectar a la base de datos";
	}else{
		// coger empresaid
		$pedido = "SELECT empresaid, empresa FROM companies WHERE usuarioid = $usuarioid";
		$resultado = mysqli_query($llave,$pedido);
		$renglon = mysqli_fetch_assoc($resultado);
		$empresaid = $renglon['empresaid'];
		$nombreEmpresa = $renglon['empresa'];
		// cuadrar headers
		$headers = "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";
		// conectarse a la base de datos de servicios con mysqli
		$link = $main->conexion();
		// cuadrar sql
		$sql = "SELECT nombre, apellidos, email FROM usuarios ORDER BY usuarioid ASC limit 0, $receptores";
		$result = mysqli_query($link,$sql);
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$email_usuario = $row['email'];
				$nombre_usuario = $row['nombre'];
				$apellidos_usuario = $row['apellidos'];
				// enviar correo
				$mailcontent = '<html><div style="width: 600"> Saludos '.$nombre_usuario.' '.$apellidos_usuario.'<br> El motivo es: '.$motivo.'<br>'.$mensaje.'<br /> Mensaje enviado por la empresa <a href="construcali.com/empresas.php?content=estaempresa&id='.$sihayempresaid.'">'.$nombreEmpresa.'</a></div></html>';
				mail($email_usuario,$motivo,$mailcontent,$headers);
				
			}
			// meter puntaje para quitar puntos
			$menospuntaje = -1 * abs($receptores);
			$productoid = intval(7);
			$stmt = mysqli_prepare($llave, "INSERT INTO puntajes (empresaid,productoid,puntos) VALUES(?,?,?)");
			mysqli_stmt_bind_param($stmt, 'iii' , $empresaid, $productoid, $menospuntaje);
			mysqli_stmt_execute($stmt);
			$rows = mysqli_stmt_affected_rows($stmt);
			mysqli_stmt_close($stmt);
			if ($rows > 0){
				$contenido_prueba = 'La empresa con la id '.$empresaid.' ha gastado '.$menospuntaje.' puntos';
				mail('construcali.publicidad@gmail.com',$motivo,$mailcontent,$headers);
				mail('construcali.publicidad@gmail.com',$motivo,$contenido_prueba,$headers);
			}else{
				$contenido_prueba = 'No se pudo meter los puntos de La empresa con la id '.$empresaid;
				mail('construcali.publicidad@gmail.com',$motivo,$contenido_prueba,$headers);
			}
			
			$aviso = 'Su correo masivo se ha enviado exitosamente, muchas gracias!';
			echo $aviso;
		}

	}
	
?>