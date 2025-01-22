    <!-- CSS Page Style - Para el formulario de buscar-->    
    <link rel="stylesheet" href="assets/css/pages/page_search_inner.css">
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="empresas.php">Empresas</a></h1>
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
                </div>
                </form>
                
                    <div id="suggestions" class="row">
                        <div class="col-md-12">
                          <span class="media-body align-self-center"><a href="search.php?q=alpha">Alpha</a> </span>
                        </div>
                        <div class="col-md-12 align-self-center">
                          <span class="media-body align-self-center"><a href="search.php?q=alpha">Beta</a> </span>
                        </div>
                        <div class="col-md-12 align-self-center">
                          <span class="media-body align-self-center"><a href="search.php?q=alpha">Gamma.</a> </span>
                        </div>
                        <div class="col-md-12 align-self-center">
                          <span class="media-body align-self-center"><a href="search.php?q=alpha">Delta</a> </span>
                        </div>
                    </div>
            </div>
        </div>    
    </div>  
    <!--=== End Search Block Version 2 ===-->
    <!--=== Content Part ===-->
    <div class="container content">		
    	<div class="row">
        	<div class="col-md-9">
            	<div class="headline">
                <?php if ($cuantas_empresas == 0){
                    $mensaje_resultado = '<h2>No se encontro la empresa con '.$buscar.'</h2>';
                    echo $mensaje_resultado;
                 }else{
                    echo '<h2>Se encontraron los resultados para la empresa '.$buscar.'</h2>';
                 } ?>
                </div>

                <!-- Clients Block-->
                <?php
                if (isset($companies)){
                foreach ($companies as $compania){
                $url = $compania['url'];
                $empresaid = $compania['empresaid'];
                //revisar si la empresa tiene un logo
                $logo = $main->con_casilla(foto,logos,empresaid,$empresaid);
                // se ha encargado de selecionar cuantas palabras
                $service = $main->con_casilla(servicio,companies,empresaid,$empresaid);
                $textoservicio = substr($service,0,400);
                //revisar si el texto tiene entidades html o codigos que representan etiquetas
                $check_entities = strpos($textoservicio, '&lt;');
                $check_ene = strpos($textoservicio, '&ntilde;');

                if ($check_entities ===  false){
                    $textoservicio = htmlentities($textoservicio);
                }elseif ($check_ene === true){
                    $textoservicio = $textoservicio;
                }else{
                    $textoservicio = html_entity_decode($textoservicio);
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
                        echo "<img src=\"assets/img/clients2/LogoCascoRojo.jpg\" class=\"img-responsive hover-effect\" alt=\"Logo de Casco Rojo General\" />";
                    else
                        echo "<img src=\"logo/$logo\" alt=\"Logo Empresarial\" width=\"100%\">";
                    echo "</div>";
                    echo "<div class=\"col-md-10\">";
                        echo "<h3><a href=\"empresas.php?content=estaempresa&id=$empresaid\">".htmlentities($compania['empresa'])."</a></h3>";
                        echo "<ul class=\"list-inline\">";
                            echo "<li><i class=\"fa fa-map-marker color-green\"></i>".htmlentities($compania['ciudad'])."</li>";
                            echo "<li><i class=\"fa fa-globe color-green\"></i><a class=\"linked\" href=\"$url\" target=\"_blank\">".$compania['url']."</a></li>";
                            echo "<li><i class=\"fa fa-phone\"></i>".$compania['telefono']."</li>";
                        echo "</ul>";
                        echo "<p>".strip_tags($textoservicio)."...</p>";
                        echo "<p><a href=\"empresas.php?content=estaempresa&id=$empresaid\">Ver mas</a></p>";
                    echo "</div>";
                    echo "</div>";
                    }
                }
                    ?>
                <!-- End Clients Block-->

                <!-- Clients Block-->
                
                <!-- End Clients Block-->

                <!-- Clients Block-->
                
                <!-- End Clients Block-->

                <!-- Clients Block-->
               
                <!-- End Clients Block-->

                <!-- Pagination -->
                
                <!-- End Pagination -->
            </div><!--/col-md-9-->

        	<div class="col-md-3"><!-- Empieza col-md-3 -->
                <div class="headline headline-md">
                    <a class="btn-u btn-block btn-u-blue" href="portafolios.php">Portafolios</a>
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