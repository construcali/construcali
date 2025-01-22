<!-- CSS Page Style - Para el formulario de buscar-->    
<link rel="stylesheet" href="assets/css/pages/page_search_inner.css">

<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Clasificados</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php">Aceder</a></li>
                <li><a href="biblioteca.php">Recursos</a></li>
                <li class="active"><a href="portafolios.php">Portafolios</a></li>
            </ul>
        </div><!--/end container-->
    </div>
   <!--/breadcrumbs-->
   <!--=== Search Block Version 2 ===-->
    <div class="search-block-v2">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form method="post" action="anuncios.php?content=buscar" id="buscarTerminos">
                <div class="input-group">
                    <input type="text" class="form-control" name="palabraClave" id="palabraClave" placeholder="Que oficio, servicios? Que Productos, materiales?">
                    <span class="input-group-btn">
                        <button class="btn-u" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </form>  
                </div>
            </div>
        </div>    
    </div>   
    <!--=== End Search Block Version 2 ===-->
    <!--=== Content ===-->
    <div class="container content">
        <!-- Begin Service Block -->
        <div class="row job-content margin-bottom-40">
            <div class="col-md-9 col-sm-9">
                <?php if(isset($mensaje_resultado)) echo '<h2>'.$mensaje_resultado.'</h2>'; ?>
                <?php 
                foreach ($clasificados as $clasificado) {
                        $titulo = $clasificado['titulo'];
                        $ciudad = $clasificado['ciudad'];
                        $usuarioid = $clasificado['usuarioid'];
                        $anouncement = $clasificado['anouncement'];
                        $anouncement = substr($anouncement,0,400);
                        $sector = $clasificado['sector'];
                        $telefono = $clasificado['telefono'];
                        $nombre = $clasificado['nombre'];
                        $fecha = $clasificado['fecha'];
                        $productoid = $clasificado['productoid'];
                         //usar htmlentities para que se vean bien las letras con tildes y enes
                        $titulo = strip_tags($titulo);
                        $ciudad = htmlentities($ciudad);
                        $anouncement = strip_tags($anouncement);
                        $nombre = htmlentities($nombre); 
                ?>
                <div class="inner-results">
                    <?php echo "<h3><a href=\"anuncios.php?content=unproducto&id=$productoid\">$titulo</a></h3>"; ?>
                    <ul class="list-inline up-ul">
                        <li><a href="#"><?php echo $sector; ?></a></li>
                        <li><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><?php echo $telefono; ?></li>
                    </ul>
                    <p><?php echo $anouncement; ?></p>
                    <ul class="list-inline down-ul">
                        <li><?php echo $fecha.'- por '.$nombre ?></li>
                        <?php echo "<li><a href=\"anuncios.php?content=unproducto&id=$productoid\">Responder</a></li>"; ?>
                    </ul>    
                </div>
                <hr>
                <?php
                }
                ?>
            
                <?php 
                foreach ($serficados as $serficado) {
                        $titulo = $serficado['titulo'];
                        $ciudad = $serficado['ciudad'];
                        $usuarioid = $serficado['usuarioid'];
                        $anuncio = $serficado['servicio'];
                        $anuncio = substr($anuncio,0,400);
                        $sector = $serficado['sector'];
                        $telefono = $serficado['telefono'];
                        $nombre = $serficado['nombre'];
                        $fecha = $serficado['fecha'];
                        $productoid = $serficado['productoid']; 
                        //usar htmlentities para que se vean bien las letras con tildes y enes
                        $titulo = strip_tags($titulo);
                        $ciudad = htmlspecialchars($ciudad);
                        $anouncement = strip_tags($anuncio);
                        $nombre = htmlspecialchars($nombre);  
                ?>
                <div class="inner-results">
                    <h3><?php echo "<a href=\"anuncios.php?content=unservicio&id=$productoid\">$titulo </a>"; ?></h3>
                    <ul class="list-inline up-ul">
                        <li><a href="#"><?php echo $sector; ?></a></li>
                        <li><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><?php echo $telefono; ?></li>
                    </ul>
                    <p><?php echo $anuncio; ?></p>
                        <ul class="list-inline down-ul">
                            <li><?php echo $fecha.'- por '.$nombre ?></li>
                            <li><a href="anuncios.php?content=unservicio&id=$productoid">Responder</a></li>
                        </ul>         
                </div>
                <hr>
                <?php
                }
                ?>
                
            </div>
             <!-- Productos en demanda -->
            <div class="col-md-3">
                <!-- End Search Bar -->

                <!-- Posts -->
                <!--/posts-->
                <!-- End Posts -->

                <!-- Categorias -->
                <div class="headline headline-md">
                    <a class="btn-u btn-block btn-u-green" href="anuncios.php?content=anunciar">Anunciar</a>
                </div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1" >Servicios</a></li>
                        <li><a data-toggle="tab" href="#home-2">Productos</a></li> <!--  -->
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active magazine-sb-categories">
                                <ul class="list-unstyled">
                                    <?php
                                        foreach ($categories as $categorie){
                                        echo "<li><a href=\"anuncios.php?content=servicios&sector=$categorie\">$categorie</a></li>";
                                        }
                                    ?>  
                                </ul>                       
                        </div>
                        <div id="home-2" class="tab-pane">
                             <ul class="list-unstyled">
                                 <?php
                                    foreach ($categorias as $category){
                                        $category = htmlentities($category);
                                    echo "<li><a href=\"anuncios.php?content=productos&sector=$category\">$category</a></li>";
                                    }
                                ?>  
                             </ul>                      
                        </div>
                    </div>
                </div>    
            </div><!-- End Categorias -->  
        </div>
        <!-- End Begin Service Block -->

        <!-- Job Content -->
            
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

