<?php
session_start();
?>

<?php
include("modelos/class_clasificado.php");
// id de usuario
$loginid = $_SESSION['usuario'];
// cargar el header
include("vistas/header.php");
//entrar a la base de datos de consrucali
$anuncio = new Clasificado();
$link = $anuncio->iniciar();

echo "Hola Amigos";

$numproductos = $anuncio->contar_records($link,productoid,productos);
echo 'Hay '.$numproductos.' clasificados';

// cargar el footer
include("vistas/footer.html"); 