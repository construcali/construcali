
<div class="wrapper">
<!--=== Content Part ===-->
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Empresas</h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="https://construcali.com/blogs.php">Blog</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
            </ul>
        </div><!--/end container-->
    </div>
   <!--/breadcrumbs-->
   <!--=== Search Block Version 2 ===-->
    <div class="search-block-v2">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form method="get" action="empresas.php" id="buscarTerminos">
                <div class="input-group">
                    <input type="hidden" name="content" value="buscarempresa">
                    <input type="text" class="form-control" name="palabraClave" id="palabraClave" placeholder="Buscar Empresas">
                    <span class="input-group-btn">
                        <button class="btn-u" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </form>
                </div>

                <div id="suggestions">
                    
                 </div>
                
                    
            </div>
        </div>    
    </div>  
    <!--=== End Search Block Version 2 ===-->

    <div class="container content">
        	
    	<div class="row">
        	<div class="col-md-9">
                

            	<div class="headline"><h2>Ultimas Empresas</h2></div>    
                <!-- Empieza el contenedor de empresas -->
                <div id="empresas">

                <!-- Clients Block-->
                <?php
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
                        echo "<a href=\"empresas.php?content=estaempresa&id=$empresaid\"><img src=\"https://construcali.com/logo/no-logo.png\" class=\"img-responsive hover-effect\" alt=\"Logo Empresarial\" />";
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
                        
                        echo "<a href=\"empresas.php?content=estaempresa&id=$empresaid&focus=1\"><button class=\"btn btn-md u-btn-outline-primary g-mr-10 g-mb-15\">Contactar</button></a>";
                        
                    echo "</div>";
                echo "</div>";
                echo "<hr>";
                }
                ?>
                </div>
                <!-- Termina el Contenedor de empresas-->
                <!-- buton temporal para cargar mas empresas -->
                <div id="masEmpresasBoton">
                    <button id="masEmpresas" data-pagina="1">Mas Empresas</button>
                </div>

                <div id="spinner">
                    <img src="/assets/img/spinner.gif" width="50" height="50" />
                </div>
                <!-- Pagination -->
                <div class="text-center">
                    <ul class="pagination">
                    <?php 
                        echo "<li><a href=\"empresas.php?page=$thispage\">&laquo;</a></li>";
                    if ($totpages > 1)
                        {
                            $bar = '';
                            for($page = 1; $page < $totpages; $page++)
                                {
                                    if($page == $thispage)
                                    { 
                                        $bar .= "<li><a href=\"empresas.php?page=$page\">$page</a></li>";
                                    }else
                                    {
                                $bar .= "<li><a href=\"empresas.php?page=$page\">$page</a></li>";
                                    }      
                                }
                        }
                                echo $bar;
                    if ($thispage < $totpages)
                    { 
                        $page = $totpages;
                        echo "<li><a href=\"empresas.php?page=$page\">&raquo;</a></li>";
                    } 
                    ?>
                     </ul>                                                            
                </div> 
                <!-- End Pagination -->
            </div><!--/col-md-9-->

        	<div class="col-md-3"><!-- Columna de 3 spacios -->
                
                <div class="headline headline-md">
                    <a class="btn-u btn-block btn-u-blue" href="https://construcali.com/usuarios.php">Cotizar</a>
                </div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Categorias</a></li>
                        <li><a data-toggle="tab" href="#home-2">Orden Alfabetico</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                             <ul class="list-unstyled">
                                 <?php
                                    foreach ($categories as $category){
                                    $catid = $category['catid'];
                                    $categoria = $category['categoria'];
                                    echo "<li><a href=\"empresas.php?content=categorias&id=$catid\">$categoria</a></li>";
                                    }
                                ?>  
                             </ul>                      
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                                <ul class="list-unstyled">
                                    <?php
                                        foreach ($listaAlfabetica as $letter){
    echo "<li><a href=\"empresas.php?content=listaalfabetica&letra=$letter\">$letter</a><li>";
                                       }
                                    ?>  
                                </ul>                       
                        </div>
                    </div>
                </div>  
            </div><!--/col-md-3-->
        </div><!--/row-->        
    </div><!--/container-->		
    <!--=== End Content Part ===-->
</div>