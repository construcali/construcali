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

    <!--=== Cube-Portfdlio ===-->
    <div class="cube-portfolio container margin-bottom-60">
        <div class="headline">



            <?php 
            if ($cuantas_fotos == 0){
            $mensaje_resultado = '<h2>No se encontraron catalogos en esta categoria.:'.$categoria.'</h2>';
            echo $mensaje_resultado;
            }else { ?>
                <h2> Ultimos Productos en <?php echo $categoria; ?> </h2>
            <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-9"><!-- Empieza columna de 9 espacios -->
                <div id="grid-container" class="cbp-l-grid-agency">
                    <?php
                    //$i=1;
                    foreach ($catFotos as $photoid => $value){
                            $nombre_empresa = $fotoEmp[$photoid];
                            $descripcion = $fotoDesc[$photoid];
                            if (empty($descripcion))
                                $descripcion = 'Foto del Catalogo';
                            echo "<div class=\"cbp-item graphic\">";
                            echo "<div class=\"cbp-caption margin-bottom-20\">";
                                echo "<div class=\"cbp-caption-defaultWrap\">";
                                    echo "<img src=\"showimage.php?id=$photoid\" alt=\"\">";
                                echo "</div>";
                                echo "<div class=\"cbp-caption-activeWrap\">";
                                    echo "<div class=\"cbp-l-caption-alignCenter\">";
                                        echo "<div class=\"cbp-l-caption-body\">";
                                            echo "<ul class=\"link-captions no-bottom-space\">";
                                                echo "<li><a href=\"catalogos.php?content=estasfotos&fotoid=$photoid\"><i class=\"rounded-x fa fa-link\"></i></a></li>";
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
                            //$i++;
                        }   
                    ?>
                </div><!--/end Grid Container-->
            </div><!-- Cierra columna de 9 espacios -->
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
        </div><!-- Termina row -->
    </div>    
    <!--=== End Cube-Portfdlio ===-->