<?php
session_start();
include("modelos/class_paginas.php");
include("modelos/class_metidas.php");
$main = new pagina();
$meto = new metida();
$main->entrar();
$usuarioid = $_SESSION['usuario'];
$email = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
$password1 = $_POST['password1'];
$password = $_POST['password'];
//$respuestaid = $meto->verificar_usuario($email,$password1);
if ($password1 == $password){
	$estadoid = $meto->actualizar_clave($usuarioid,$password);
	return 'success';
}else
{
	return false;
}

?>