<meta charset="ISO-8859-1">
<!-- Web Fonts -->
<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>
<?php
// paginacion.php se llama desde la paginacion de contenido.inc.php, a la que se llega desde
// empresas?content=indexpaginas
include("../../modelos/class_paginas.php");
$main = new pagina();
$main->login(); //entrar a base de datos
$thispage = $_GET['page'];
$recordsperpage = 22;
$totrecords = $main->contar_records(empresaid,companies);
$offset = ($thispage-1)*$recordsperpage;
$totpages = ceil($totrecords/$recordsperpage);
$companies = $main->mostrar_empresas($offset,$recordsperpage);

#mostrar empresas
foreach($companies as $compania)
            {
            $categoria = $compania['categoria'];
            $empresaid = $compania['empresaid']; 
            $nombre = $compania['empresa'];
            $nombre = trim($nombre);
            $nombre = strip_tags($nombre);
            $nombre = nl2br($nombre);
            //$empresa = wordwrap($nombre,28,"</h3><h3>",false);
            $empresa = html_entity_decode($nombre);
            $empresa = htmlentities($empresa);
            //para conseguir el logo
            $logo = $main->con_casilla(foto,logos,empresaid,$empresaid);
            $whatsapp = $main->con_casilla(whatsapp,redessociales,empresaid,$empresaid);
            $whatsapp = trim($whatsapp);
            $wsnumber = explode(" ", $whatsapp);
            $whatsapp = implode($wsnumber);
            if (empty($logo))
                $logo = 'LogoCasco.png';     
            echo "<div class=\"col-md-6 col-sm-6\">";
                echo "<div class=\"content-boxes-v3 margin-bottom-10 md-margin-bottom-20\">";
                    echo "<i><img src=\"logo/$logo\" alt=\"Logo Empresarial\" style=\"float:left\" width=\"50px\" height=\"45px\"></i>";
                    echo "<div class=\"content-boxes-in-v3\">";
                        echo "<h3><a href=\"empresas.php?content=estaempresa&id=$empresaid\">$empresa</a></h3>";
                        echo "<p>$categoria</p><h5><i class=\"fa fa-whatsapp color-green\"><a href=\"https://wa.me/{$whatsapp}\">{$whatsapp}</a></i></h5>";
                    echo "</div>";
                echo "</div>";
            echo "</div>"; 
            }
?>