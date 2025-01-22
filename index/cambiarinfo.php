<?php
#este documento se usa en ajustes.inc.php
session_start();
include("modelos/class_paginas.php");
include("modelos/class_metidas.php");
$main = new pagina();
$meto = new metida();
$main->entrar();
$usuarioid = $_SESSION['usuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$ciudad = $_POST['ciudad'];
$ciudad = trim($ciudad);
$ciudad = strtolower($ciudad);
$ciudad = ucfirst($ciudad);
$departamentoid = $_POST['departamento'];
$meto->actualizar_usuario($nombre,$apellidos,$telefono,$ciudad,$email,$usuarioid,$departamentoid);
return true;
?>