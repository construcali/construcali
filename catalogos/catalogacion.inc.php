<!-- Para formatear las fotos -->
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">    
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">
<!-- CSS Page Style - Para el formulario de buscar-->    
<link rel="stylesheet" href="assets/css/pages/page_search_inner.css">
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
                <form method="post" action="catalogos.php?content=buscarproducto" id="buscarTerminos">
                <div class="input-group">
                    <input type="text" class="form-control" name="palabraClave" id="productoBuscado" placeholder="Que productos, maquinas, materiales, herramientas busca?">
                    <span class="input-group-btn">
                        <button class="btn-u" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </form>  
                </div>
                <div class="row" id="suggestions">
                    
                 </div>
            </div>
        </div>    
    </div>
    <!--=== End Search Block Version 2 ===-->
  
    <!--=== Cube-Portfdlio ===-->
    <div class="cube-portfolio container margin-bottom-60">
        <div class="headline"><h2><?php if(isset($mensaje_resultado)) echo '<h2>'.$mensaje_resultado.'</h2>'; ?></h2></div>
        <div class="row">
            <div class="col-md-9"><!-- Empieza columna de 9 espacios -->
                <div id="grid-container" class="cbp-l-grid-agency"> 
                    
                    <?php
                    foreach ($photos as $photo)
                        {
                                 
                            $photoid = $photo['fotoid'];
                            $value = $photo['empresaid'];
                            $fotoid_descripcion = $photo['descripcion'];
                            
                            //$nombre_empresa = $main->con_casilla(empresa,companies,empresaid,$value);
                            //$nombre_empresa = html_entity_decode($nombre_empresa);
                            // revisar si la descripcion tiene caracteres htmlentities
                            
                            if (strpos($fotoid_descripcion, '&lt')){
                                $fotoid_descripcion = htmlentities(strip_tags($fotoid_descripcion));
                            }else if(strpos($fotoid_descripcion, 'acute')){
                                $fotoid_descripcion = $fotoid_descripcion;
                            }
                            else{
                                $fotoid_descripcion = html_entity_decode($fotoid_descripcion);
                            }
                            $descripcion = (strlen($fotoid_descripcion) > 20) ? substr($fotoid_descripcion, 0, 20).'...' : $fotoid_descripcion;
                        ?>
                                <div class="cbp-item graphic">
                                    <div class="cbp-caption margin-bottom-20">
                                        <div class="cbp-caption-defaultWrap">
                                            <img src="<?php echo "showimage.php?id=$photoid"; ?>" alt="<?php echo $descripcion; ?>">
                                        </div>
                                        <div class="cbp-caption-activeWrap">
                                            <div class="cbp-l-caption-alignCenter">
                                                <div class="cbp-l-caption-body">
                                                    <ul class="link-captions no-bottom-space">
                                                        <li><a href="catalogos.php?content=estafoto&fotoid=<?php echo $photoid; ?>"><i class="rounded-x fa fa-link"></i></a></li>
                                                        <li><a href="<?php echo "showimage.php?id=$photoid"; ?>" class="cbp-lightbox" data-title="<?php echo $descripcion; ?>"><i class="rounded-x fa fa-search"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cbp-title-dark">
                                        <div class="cbp-l-grid-agency-title"><?php echo $descripcion; ?></div>
                                        
                                        <div class="cbp-l-grid-agency-desc"><a class="btn-u" href="catalogos.php?content=esteproducto&fotoid=<?php echo $photoid; ?>"><i class="fa"></i> Me interesa</a></div>
                                    </div>
                                </div>
                    <?php                
                        }
                    ?>
                   
                </div><!--/end Grid Container-->

                <!-- buton temporal para cargar mas clasificados 
                <div id="masAnunciosBoton">
                    <button id="masProductos" data-pagina="1">Mas Productos</button>
                </div>
                -->
                
                <!-- Paginacion-->
                <div class="text-center">
                    <ul class="pagination">
                    <?php 
                        echo "<li><a href=\"catalogos.php?content=catalogacion&page=$thispage\">&laquo;</a></li>";
                    if ($totpages > 1)
                        {
                            $bar = '';
                            for($page = 1; $page < $totpages; $page++)
                                {
                                    if($page == $thispage)
                                    { 
                                        $bar .= "<li><a href=\"catalogos.php?content=catalogacion&page=$page\">$page</a></li>";
                                    }else
                                    {
                                $bar .= "<li><a href=\"catalogos.php?content=catalogacion&page=$page\">$page</a></li>";
                                    }      
                                }
                        }
                                echo $bar;
                    if ($thispage < $totpages)
                    { 
                        $page = $totpages;
                        echo "<li><a href=\"catalogos.php?content=catalogacion&page=$page\">&raquo;</a></li>";
                    } 
                    ?>
                     </ul>                                                            
                </div><!-- End Paginacion -->
            </div> <!-- Termina columna de 9 espacios -->
            <div class="col-md-3"><!-- Columna de 3 spacios -->
                <div class="headline headline-md"><!-- <h2>Filtros</h2> -->
                    <a class="btn-u btn-block btn-u-blue" href="usuarios.php">Cotizar</a>
                </div>
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
    <!--=== End Cube-Portfdlio ===-->