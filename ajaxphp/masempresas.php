<?php
session_start();
?>

<?php
	include("../modelos/class_paginas.php");
	$main = new pagina();	
	$main->login(); //entrar a base de datos 
    if (isset($_GET['page'])){
    	$usuarioid = $_SESSION['usuario'];
		$sihayempresaid = $main->con_casilla(empresaid,companies,usuarioid,$usuarioid);

		#hacer la paginacion
		$totrecords = $main->contar_records(empresaid,companies);
		$thispage = (isset ($_GET['page'])) ? $_GET['page'] : 1 ;
		$recordsperpage = 24;
		$offset = ($thispage-1)*$recordsperpage;
		# cosigue las empresas
		$companies = $main->mostrar_empresas($offset,$recordsperpage);
		# mostrar las empresas
		foreach ($companies as $compania){
                $url = $compania['url'];
                $empresaid = $compania['empresaid'];
                //revisar si la empresa tiene un logo y whatsapp
                $logo = $main->con_casilla(foto,logos,empresaid,$empresaid);
                //conseguir whatsapp
                $whatsapp = $main->con_casilla(whatsapp,redessociales,empresaid,$empresaid);
                $whatsapp = trim($whatsapp);
                // replace - for empty space
                $forwhatsapp = str_replace('-', ' ', $whatsapp);
                $wsnumber = explode(" ", $forwhatsapp);
                $whatsapp = implode($wsnumber);
                $whatsapp = substr($whatsapp,0, 10);
                $whatsapp = '57'.$whatsapp;

                // mensaje por whatsapp
                $mensaje_contacto = 'He visto su empresa '.$compania['empresa'].' en construcali.com y me gustaria mas informacion';
                $mensaje_contacto = urlencode($mensaje_contacto);
                //revisar si hay portafolio
                $portafolio = $main->con_casilla(url,portafolios,empresaid,$empresaid);
                //revisar si hay catalogo
                $fotoid = $main->con_casilla(fotoid,fotos,empresaid,$empresaid);
                // acomodar el texto, ya la funcion con_empresas_cat en el modelo class_paginas
                // se ha encargado de selecionar cuantas palabras
                $ciudadempresa = $compania['ciudad'];
                $textoservicio = trim($compania['servicio']);
                // revisar si la empresa tiene entidades html o codigos que representan etiquestas
                $empresa = trim($compania['empresa']);
                if (strstr($empresa, '&lt;')){
                    $empresa = html_entity_decode($empresa);
                }else if (strstr($empresa, 'tilde;') || strstr($empresa, 'acute;')){
                    $empresa = $empresa;
                }else{
                    $empresa = strip_tags($empresa);
                }
                //revisar si el texto tiene entidades html o codigos que representan etiquetas
                $check_entities = strpos($textoservicio, '&lt;');
               
                // revisar si check_entities es verdad
                if ($check_entities !== false){
                    // encontro &lt
                    $textoservicio = html_entity_decode($textoservicio);
                }
                else if (strstr($textoservicio, 'tilde;') || strstr($textoservicio, 'acute;')){
                    $textoservicio = $textoservicio;
                }else {
                    $textoservicio = htmlentities(strip_tags($textoservicio));
                    // no encontro &Lt, derpronto tiene etiquesta <>
                }
            

                $pos = strpos($textoservicio, '<b>');
                if ($pos !== false)
                    $textoservicio = $textoservicio.'</b>'; 
                $pos = strpos($textoservicio, '<strong>');
                if ($pos !== false)
                    $textoservicio = $textoservicio.'</strong>'; 
                echo "<div class=\"row clients-page\">";
                    echo "<div class=\"col-md-2\">";
                    if(empty($logo))
                        echo "<a href=\"empresas.php?content=estaempresa&id=$empresaid\"><img src=\"http://construcali.com/logo/Logo_Col_Construccion.jpg\" class=\"img-responsive hover-effect\" alt=\"Logo Empresarial\" />";
                    else
                        echo "<a href=\"empresas.php?content=estaempresa&id=$empresaid\"><img src=\"logo/$logo\" alt=\"Logo Empresarial\" width=\"100%\"></a>";
                    echo "</div>";
                    echo "<div class=\"col-md-10\">";
                        echo "<h3><a href=\"empresas.php?content=estaempresa&id=$empresaid\">".$empresa."</a></h3>";
                        echo "<ul class=\"list-inline\">";
                            echo "<li><i class=\"fa fa-map-marker color-green\"></i>".$ciudadempresa."</li>";
                            if (($url != 'http://'))
                            {echo "<li><i class=\"fa fa-globe color-green\"></i><a class=\"linked\" href=\"$url\" target=\"_blank\">Pagina Web</a></li>";}
                            echo "<li class=\"hidden-md hidden-lg\"><i class=\"fa fa-whatsapp color-green\"></i><a href=\"https://wa.me/{$whatsapp}?text=$mensaje_contacto\">Contactar</a></li>";
                            echo "<li><i class=\"fa fa-phone\"></i>".$compania['telefono']."</li>";
                            if (!empty($portafolio)){
                                echo "<li><i class=\"fa fa-briefcase color-green\"></i><a class=\"linked\" href=\"$portafolio\" target=\"_blank\">Portafolio PDF</a></li>";
                                }
                            if (!empty($fotoid)){
                                echo "<li><i class=\"fa fa-book color-green\"></i><a class=\"linked\" href=\"catalogos.php?content=estasfotos&fotoid=$fotoid\" target=\"_blank\">Catalogo</a></li>";
                                }
                        echo "</ul>";
                        echo "<p>".strip_tags($textoservicio)."...<a href=\"empresas.php?content=estaempresa&id=$empresaid\">Ver mas</a></p>";
                        
                        echo "<button class=\"btn btn-md u-btn-outline-primary g-mr-10 g-mb-15\"><a href=\"empresas.php?content=estaempresa&id=$empresaid&focus=1\" >Contactar</a></button>";
                        
                    echo "</div>";
                echo "</div>";
            echo "<hr>";
        }
    }else{
        exit();
    }
?>