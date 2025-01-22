<!-- Para formatear las fotos -->
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">    
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">

 <!--=== Breadcrumbs v3 ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Catalogos</h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="https://construcali.com/blogs.php">Blog</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v3 ===-->
    <!--=== Search Block Version 2 ===-->
    <div class="search-block-v2">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form method="post" action="catalogos.php"> <!-- usando el metodo post -->
                <div class="input-group">
                    <input type="hidden" name="content" value="buscarproducto">
                    <input type="text" class="form-control" name="palabraClave" placeholder="Buscar Productos">
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

    <!--=== Cube-Portfdlio ===-->
    <div class="cube-portfolio container margin-bottom-60">
        <div class="headline"><h2>Ultimos Catalogos</h2></div>
        <div class="row">
            <div class="col-md-9"><!-- Empieza columna de 9 espacios -->
                <div id="grid-container" class="cbp-l-grid-agency"> <!-- previous id= grid-container -->
                    <?php
                    foreach ($fotoArray as $photoid => $value)
                        {
                            $nombre_empresa = $fotoEmp[$photoid];
                            $descripcion = $fotoDesc[$photoid];
                            // revisar si la descripcion tiene caracteres htmlentities
                            if (strstr($descripcion, '&lt;')){
                                $descripcion = html_entity_decode($descripcion);
                                }else if (strstr($descripcion, 'tilde;') || strstr($descripcion, 'acute;')){
                                    $descripcion = $descripcion;
                                }else{
                                    $descripcion = htmlentities(strip_tags($descripcion));
                                }
                                if (empty($descripcion))
                                    $descripcion = 'Foto del Catalogo';
                                echo "<div class=\"cbp-item graphic\">";
                                echo "<div class=\"cbp-caption margin-bottom-20\">";
                                    echo "<div class=\"cbp-caption-defaultWrap\">";
                                    ?>
                        <img src="<?php echo "showimage.php?id=$photoid"; ?>" alt="<?php echo $descripcion; ?>">
                                    <?php
                                    echo "</div>";
                                    echo "<div class=\"cbp-caption-activeWrap\">";
                                        echo "<div class=\"cbp-l-caption-alignCenter\">";
                                            echo "<div class=\"cbp-l-caption-body\">";
                                                echo "<ul class=\"link-captions no-bottom-space\">";
                                                    echo "<li><a href=\"catalogos.php?content=estafoto&fotoid=$photoid\"><i class=\"rounded-x fa fa-link\"></i></a></li>";
                                                    echo "<li><a href=\"showimage.php?id=$photoid\" class=\"cbp-lightbox\" data-title=\"$descripcion\"><i class=\"rounded-x fa fa-search\"></i></a></li>";
                                                echo "</ul>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class=\"cbp-title-dark\">";
                                    echo "<div class=\"cbp-l-grid-agency-title\">$descripcion</div>";
                                    echo "<div class=\"cbp-l-grid-agency-desc\"><a href=\"empresas.php?content=estaempresa&id=$value\">$nombre_empresa</a></div>";
                                echo "</div>";
                                echo "</div>";
                        }
                    ?>
                </div><!--/end Grid Container-->
                <!-- Paginacion-->
                <div class="text-center">
                    <ul class="pagination">
                    <?php 
                        echo "<li><a href=\"catalogos.php?content=catcontenido&page=$thispage\">&laquo;</a></li>";
                    if ($totpages > 1)
                        {
                            $bar = '';
                            for($page = 1; $page < $totpages; $page++)
                                {
                                    if($page == $thispage)
                                    { 
                                        $bar .= "<li><a href=\"catalogos.php?content=catcontenido&page=$page\">$page</a></li>";
                                    }else
                                    {
                                $bar .= "<li><a href=\"catalogos.php?content=catcontenido&page=$page\">$page</a></li>";
                                    }      
                                }
                        }
                                echo $bar;
                    if ($thispage < $totpages)
                    { 
                        $page = $totpages;
                        echo "<li><a href=\"catalogos.php?content=catcontenido&page=$page\">&raquo;</a></li>";
                    } 
                    ?>
                     </ul>                                                            
                </div>     
        <!-- End Paginacion -->
            </div>    
    <!--=== End Cube-Portfdlio ===-->
            <div class="col-md-3"><!-- Columna de 3 spacios -->
                <div class="headline headline-md"><h2>Filtros</h2></div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Categorias</a></li>
                        
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                             <ul class="list-unstyled">
                                 <?php
                                    foreach ($categories as $category){
                                    $catid = $category['catid'];
                                    $categoria = $category['categoria'];
                                    echo "<li><a href=\"catalogos.php?content=estacategoria&categoria=$catid\">$categoria</a></li>";
                                    }
                                ?>  
                             </ul>                      
                        </div>
                        
                    </div>
                </div>  
            </div><!-- Termina columna de 3 espacios -->
        </div><!-- End Row -->
    </div>   