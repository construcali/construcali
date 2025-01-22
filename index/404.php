<?php

include("modelos/class_paginas.php");

//Crear Objectos
$main = new pagina();

$main->login(); //entrar a base de datos construcali
$metaTitulo = 'construcali.com - Directorio Empresas de construccion en Colombia';
$home_fotos = $main->con_info_desc(fotos,fotoid,0,3);
$mensaje_404 = 'No se ha encontrado la pagina que busca';
include("vistas/home_header.html");
		include("vistas/home_main.php");
		include("vistas/home_footer.html");

?>