<!-- Style sheets for the forms -->
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">

<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Cotizaciones</h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="inicio.php?content=tutoriales">Tutoriales</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
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
                        $anouncement = $clasificado['anouncement'];
                        $anouncement = substr($anouncement,0,400);
                        $disciplina = $clasificado['sector'];
                        $telefono = $clasificado['telefono'];
                        $nombre = $clasificado['nombre'];
                        $fecha = $clasificado['fecha'];
                        $productoid = $clasificado['productoid'];
                         //usar htmlentities para que se vean bien las letras con tildes y enes
                        $titulo = htmlentities($titulo);
                        $ciudad = htmlentities($ciudad);
                        $anouncement = htmlentities($anouncement);
                        $nombre = htmlentities($nombre); 
                ?>
                <div class="inner-results ultimos_servicios">
                    <?php echo "<h3><a href=\"cotizaciones.php?content=unanouncement&id=$productoid\">$titulo</a></h3>"; ?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><a href="cotizaciones.php?content=anouncements&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                        <li><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                    </ul>
                    <p><?php echo $anouncement; ?></p>
                    <ul class="list-inline down-ul">
                        <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                        <li class="resServicio"><i class="fa fa-reply"></i><?php echo "<a href=\"cotizaciones.php?content=unanouncement&id=$productoid\">Responder</a>"; ?></li>
                    </ul>

                    <!-- Este es formulario de la respuesta para un aununcio -->
                    <form action="responder.php" class="sky-form resAnuncio" method="post" id="comentar<?php echo $productoid; ?>">
                        <!-- Esta id resAnuncio esta en el archivo responderAnuncio.js -->
                    <section>
                        <!-- label class="label">Debe haber ingresado como usuario para poder responder</label -->
                            <label class="textarea">
                                <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="3" name="oferta" id="oferta_<?php echo $productoid; ?>" placeholder="Escriba su respuesta aqui"></textarea>
                            </label>
                    </section>
                    <?php
                    echo "<input type=\"hidden\" name=\"usuarioid\" id=\"respondonid{$productoid}\" value=\"$loginid\" />";

                     echo "<input type=\"hidden\" name=\"email\" id=\"email{$productoid}\" value=\"$email_anunciante\" />";   
                     echo "<input type=\"hidden\" name=\"titulo\" id=\"titulo{$productoid}\" value=\"$titulo\" />"; 
                    ?>
                    <button type="submit" class="btn-u btn-u-blue">Responder</button>
                    </form>
                    <div class="overflow-h" id="formularioRespuesta<?php echo $productoid; ?>">
                                
                    </div>       
                    <!-- Aqui se cierra el formulario de la respuesta para un anuncio -->  
                    <hr>   
                </div>
                
                <?php
                }
                ?>
            
                <!-- Mas Clasificados -->
                
                <!-- Paginacion -->
                <div class="text-left">
                    <ul class="pagination">
                        <?php
                    if ($thispage > 1)
                    {
                        $page = $thispage - 1 ;
                        $prevpage = "<li><a href=\"cotizaciones.php?content=anouncements&sector=$sector&page=$page\">Atras</a></li";
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
                                $bar .= "<li><a href=\"cotizaciones.php?content=anouncements&sector=$sector&page=$page\">$page</a></li>";
                            }
                        }
                    }
                    
                if ($thispage < $totpages)
                 {
                    $page = $thispage + 1;
                    $nextpage = "<li><a href=\"cotizaciones.php?content=anouncements&sector=$sector&page=$page\">Adelante</a></li>"; 
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
                <!-- Mas Clasificados -->               
            </div>
            <!-- Productos en demanda -->
            <div class="col-md-3">
                <!-- End Search Bar -->

                <!-- Posts -->
                <!--/posts-->
                <!-- End Posts -->

                <!-- Tabs Widget -->
                <div class="headline headline-md">
                <a class="btn-u btn-block btn-u-green" href="anuncios.php?content=cotizar">Cotizar</a></div>
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

