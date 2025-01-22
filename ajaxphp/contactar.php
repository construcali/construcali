<?php
	session_start();
	include("../modelos/class_paginas.php");
	$main = new pagina();
	$usuarioid = $_SESSION['usuario'];
	// recibir el mensaje
	$motivo = $_POST['titulo'];
	$mensaje = $_POST['texto'];
	// conseguir la informacion del usuario
	$main->entrar();
	$nombre = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
	$correo = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
	// enviar correo
	$mailcontent = 'Mensaje enviado por '.$nombre.' con el correo '.$correo.' El motivo es: '.$motivo.'.  El mensaje es: '.$mensaje;
	mail('Rvelezpantoja@gmail.com','Mensaje para construcali',$mailcontent);
	mail('construcali.publicidad@gmail.com','Mensaje para construcali',$mailcontent);
	$aviso = 'Su mensaje se ha enviado exitosamente, muchas gracias!';
	echo $aviso;
?>