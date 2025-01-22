<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Clasificados</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="https://construcali.com/anuncios.php?content=cotizar">Cotizar</a></li>
                <li><a href="foros.php">Foros</a></li>
                <li class="active"><a href="ofertas.php">Ofertas</a></li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--/breadcrumbs-->
        <!--/container-->
    <!--/breadcrumbs-->
    <!--=== End Breadcrumbs - html esta en recortes.php linea 88 ===-->
        
    <!--=== End Job Img ===-->
    <!--=== Content ===-->
    <div class="container content">
        <!-- Begin Service Block -->
        
        <!-- End Begin Service Block -->

        <!-- Job Content -->
        <div class="headline"><h2>Ultimas Cotizaciones</h2></div>
        
        <!-- Aqui ponemos los clasificados -->
        <div class="row job-content">
            <div class="col-md-9">
                <!-- Servicios en demanda -->
                
                <?php 
                foreach ($clasificados as $clasificado) {
                        $titulo = $clasificado['titulo'];
                        $ciudad = $clasificado['ciudad'];
                        $usuarioid = $clasificado['usuarioid'];
                        $descripcion = $clasificado['clasificado'];
                        $descripcion = substr($descripcion,0,400);
                        $disciplina = $clasificado['sector'];
                        $telefono = $clasificado['telefono'];
                        $nombre = $clasificado['nombre'];
                        $fecha = $clasificado['fecha'];
                        $productoid = $clasificado['productoid'];
                         //usar htmlentities para que se vean bien las letras con tildes y enes
                        $titulo = htmlentities($titulo);
                        $ciudad = htmlentities($ciudad);
                        $descripcion = htmlentities($descripcion);
                        //$descripcion = html_entity_decode($descripcion);
                        $nombre = htmlentities($nombre); 
                ?>
                <div class="inner-results ultimos_servicios">
                    <?php
                    if ($clasificado['clase'] == 'labor'){
                    echo "<h3><a href=\"cotizaciones.php?content=unanouncement&id=$productoid\">$titulo</a></h3>"; ?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><a href="cotizaciones.php?content=anouncements&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                        <li><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                    </ul>
                    <p><?php echo $descripcion; ?></p>
                    <ul class="list-inline down-ul">
                        <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                        <li><i class="fa fa-reply"></i><?php echo "<a href=\"cotizaciones.php?content=unanouncement&id=$productoid\">Responder</a>"; ?></li>
                    </ul>
                    <hr>   
                </div>
                
                <?php
                }elseif ($clasificado['clase'] == 'articulo'){
                    echo "<h3><a href=\"cotizaciones.php?content=unanuncio&id=$productoid\">$titulo</a></h3>";?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><a href="cotizaciones.php?content=unanuncio&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                        <li><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                    </ul>
                    <p><?php echo $descripcion; ?></p>
                     <!--para responder cotizaciones usar la clase=responder_cotizacones y el codigo de javascript en footer.html linea 359  -->
                    <ul class="list-inline down-ul">
                        <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                        <li><i class="fa fa-reply"></i><?php echo "<a href=\"cotizaciones.php?content=unanuncio&id=$productoid\">Responder</a>"; ?></li>
                    </ul>
                    <hr> 
                    <!-- -->
                </div>
                <?php
                    }
                }
                ?>
            
                <!-- Paginacion -->
                <div class="text-left">
                    <ul class="pagination">
                    <?php
                    if ($thispage > 1)
                    {
                        $page = $thispage - 1 ;
                        $prevpage = "<li><a href=\"cotizaciones.php?page=$page\">Atras</a></li";
                    }
                    else
                    {
                        $prevpage = "<li><a>Anterior</a></li>";
                    }
                    
                if ($totpages >1)
                    {
                        $bar = '';
                        for($page = 1; $page <= $totpages; $page++)
                        {
                            if ($page == $thispage)
                            {
                                $bar .= "<li><a>$page</a></li>";
                            }
                            else
                            {
                                $bar .= "<li><a href=\"cotizaciones.php?page=$page\">$page</a></li>";
                            }
                        }
                    }
                    
                if ($thispage < $totpages)
                 {
                    $page = $thispage + 1;
                    $nextpage = "<li><a href=\"cotizaciones.php?page=$page\">Adelante</a></li>"; 
                 }else
                 {
                    $nextpage = "<li><a>Proxima</a></li>";
                 }
                    echo $prevpage;
                    echo $bar;
                    echo $nextpage;
                ?>                 
                    </ul>                                                            
                </div>
                
                <!-- Termina Paginacion -->               
            </div>
            <!-- Productos en demanda -->
            <div class="col-md-3">
                <!-- End Search Bar -->

                <!-- Posts -->
                <!--/posts-->
                <!-- End Posts -->

                <!-- Tabs Widget -->
                <div class="headline headline-md"><a class="btn-u btn-block btn-u-green" href="anuncios.php?content=cotizar">Cotizar</a></div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1" id="u_servicios">Servicios</a></li>
                        <li><a data-toggle="tab" href="#home-2" id="u_productos">Materiales</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                            <ul class="list-unstyled">
                                <?php
                                    foreach ($categorias as $category){
                                        echo "<li><a href=\"cotizaciones.php?content=anouncements&sector=$category\">$category</a></li>";
                                    }
                                ?>
                            </ul>                      
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <ul class="list-unstyled">
                                    <?php
                                        foreach ($categories as $categorie){
                                        echo "<li><a href=\"cotizaciones.php?content=anuncios&sector=$categorie\">$categorie</a></li>";
                                        }
                                    ?>  
                            </ul>                                              
                        </div>
                    </div>
                </div> 

                <!-- Photo Stream -->
                
            </div>
        </div>
            <!-- Productos en oferta -->
        
            <!--/col-md-12-->
        <!-- Aqui termina row -->        
        <!-- Aqui terminan los clasificados -->
    </div>    
    <!--/container-->     
    <!--=== End Content ===-->
    <!--=== Footer Version 1 ===-->    
    <!--=== End Footer Version 1 ===-->
</div>

<!-- JS Global Compulsory -->			
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

