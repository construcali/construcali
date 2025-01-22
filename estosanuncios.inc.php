<!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Clasificados</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="cotizaciones.php?content=anouncements">Servicios en Demanda</a></li>
                <li><a href="cotizaciones.php?content=anuncios">Productos en Demanda</a></li>
                <?php
                if (empty($_SESSION['usuario'])) {
                    echo "<li class=\"active\"><a href=\"usuarios.php\">Ponga su Clasificado</a></li>";
                }else
                {
                    echo "<li class=\"active\"><a href=\"cotizaciones.php?content=anunciar\">Cotizar</a></li>";
                }
            ?>
                
            </ul>
        </div>
    </div>
    <!--=== End Breadcrumbs ===-->
    
    <!--=== Search Block Version 2 ===-->
    <div class="search-block-v2">
        <div class="container">
            <div class="col-md-6 col-md-offset-2">
                <h2><?php echo $sector; ?></h2>
            </div>
        </div>    
    </div><!--/container-->     
    <!--=== End Search Block Version 2 ===-->

    <!--=== Search Results ===-->
    <div class="container s-results margin-bottom-50">
        <div class="row">
            <div class="col-md-2 hidden-xs related-search">
                <div class="row">
                    <div class="col-md-12 col-sm-4">
                        <h3>Categorias</h3>
                        <ul class="list-unstyled">
                        <?php
                            foreach ($categorias as $category){
                            echo "<li><a href=\"cotizaciones.php?content=anuncios&sector=$category\">$category</a></li>";
                            }
                        ?>  
                        </ul>
                        <hr>
                    </div>       
                        
                    <div class="col-md-12 col-sm-4">
                        <h3>Otras ofertas</h3>
                        <ul class="list-unstyled blog-photos margin-bottom-30">
                             <?php
                            foreach ($fotos as $foto) {
                                $url = $foto['url'];
                                $companyid = $foto['empresaid'];
                                echo "<li><a href=\"empresas.php?content=estaempresa&id=$companyid\"><img src=\"$url\" alt=\"\" class=\"hover-effect\"></a></li>";
                            }
                            ?> 
                        </ul>
                    </div>
                </div>        
            </div><!--/col-md-2-->

            <div class="col-md-10">
                <span class="results-number">Se requieren estos productos</span>
                <!-- Begin Inner Results -->
                <?php 
                foreach ($clasificados as $clasificado) {
                        $titulo = $clasificado['titulo'];
                        $ciudad = $clasificado['ciudad'];
                        $usuarioid = $clasificado['usuarioid'];
                        $anuncio = $clasificado['anuncio'];
                        $anuncio = substr($anuncio,0,400);
                        $disciplina = $clasificado['sector'];
                        $telefono = $clasificado['telefono'];
                        $nombre = $clasificado['nombre'];
                        $fecha = $clasificado['fecha'];
                        $productoid = $clasificado['productoid'];  
                ?>
                <div class="inner-results">
                    <?php echo "<h3><a href=\"cotizaciones.php?content=unanuncio&id=$productoid\">$titulo</a></h3>"; ?>
                    <ul class="list-inline up-ul">
                        <li><a href="cotizaciones.php?content=anuncios&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                        <li><i class="fa fa-map-marker"></i><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                    </ul>
                    <p><?php echo $anuncio; ?></p>
                    <ul class="list-inline down-ul">
                        <li><i class="fa fa-calendar"></i><?php echo $fecha.'- por '.$nombre ?></li>
                        <li><?php echo "<a href=\"cotizaciones.php?content=unanuncio&id=$productoid\">Responder</a></li>"; ?>
                    </ul>    
                </div>
                <hr>
                <?php
                }
                ?>

                <div class="margin-bottom-30"></div>

                <div class="text-left">
                    <ul class="pagination">
                    <?php
                    if ($thispage > 1)
                    {
                        $page = $thispage - 1 ;
                        $prevpage = "<li><a href=\"cotizaciones.php?content=anuncios&sector=$sector&page=$page\">Atras</a></li";
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
                                $bar .= "<li><a href=\"cotizaciones.php?content=anuncios&sector=$sector&page=$page\">$page</a></li>";
                            }
                        }
                    }
                    
                if ($thispage < $totpages)
                 {
                    $page = $thispage + 1;
                    $nextpage = "<li><a href=\"cotizaciones.php?content=anuncios&sector=$sector&page=$page\">Adelante</a></li>"; 
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
            </div><!--/col-md-10-->
        </div>        
    </div><!--/container-->     
    <!--=== End Search Results ===-->