<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
 <!-- CSS Page Style -->
<link rel="stylesheet" href="assets/css/pages/profile.css">
<!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Clasificados</h1>
            <ul class="pull-right breadcrumb">
                <?php if (!isset($sihayempresaid))
                {
                    ?>
                <li><a href="usuarios.php">Cotizar</a></li>
                <li><a href="foros.php">Foros</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <?php
                }else{
                    ?>
                <li><a href="anuncios.php?content=cotizar">Cotizar</a></li>
                <li><a href="foros.php">Foros</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <?php
                    }
                ?>
                
            </ul>
        </div><!--/end container-->
    </div>
    <!--/breadcrumbs-->
 <!--=== Profile ===-->
 <!-- esta clase profile no deja que las categorias tengan cierta distacia del borde
 sin embargo se necesita para que se vean bien las descripciones de las ofertas -->
    <div class="cube-portfolio container content">	
    	<div class="row">
           <!--Left Sidebar-->
            
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9 profile">
                <div class="profile-body margin-bottom-20"> 
                    <!-- id=fotosOfertas se usa en el documento subirOferta.js y se pone dentro el div   de aca arriba -->
                    <div class="row margin-bottom-20">
                    <?php
                    $j = 0;
                    foreach ($promociones as $promocion) {
                        $empresaid = $promocion['empresaid'];
                        $productoid = $promocion['productoid'];
                        $descripcion = $promocion['descripcion'];
                        $titulo = $promocion['titulo'];
                        $categoria = $promocion['categoria'];
                        $url = $promocion['url'];
                        $url = nl2br($url);
                        $titulo = substr($titulo,0,40);
                        $titulo = trim($titulo);
                        $titulo = nl2br($titulo);
                        $descripcion = substr($descripcion, 0,200);
                        $descripcion = trim($descripcion);
                        $descripcion = nl2br($descripcion);
                        $fecha = $main->get_fecha(boletines,$productoid);
                        $empresa = $main->con_casilla(empresa,companies,empresaid,$empresaid);
                        $ciudad = $main->con_casilla(ciudad,companies,empresaid,$empresaid);
                    ?>
                        <div class="col-md-6 sm-margin-bottom-20">
                            <a href="ofertas.php?content=veroferta&ofertaid=<?php echo $productoid; ?>">
                                <img class="full-width img-responsive" src="<?php echo $url; ?>" alt="Foto de la oferta" id="<?php echo $productoid; ?>">
                            </a>
                        </div>
                        <!-- La otra columna de 6 spacios -->
                        <div class="col-sm-6 sm-margin-bottom-20" id="<?php echo 'photo'.$productoid; ?>">
                            <div class="profile-blog">
                                <div class="name-location">
                                    <strong><a href="ofertas.php?content=veroferta&ofertaid=<?php echo $productoid; ?>"><?php echo $titulo; ?></a></strong>
                                    <span><i class="fa fa-briefcase"></i><a href="<?php echo 'empresas.php?content=estaempresa&id='.$empresaid; ?>"><?php echo $empresa ?></a></span>
                                </div>
                                <div class="clearfix margin-bottom-20"></div>    
                                <p><?php echo $descripcion; ?></p>
                                <hr>
                                <ul class="list-inline share-list">
                                    <li><i class="fa fa-calendar"></i><a href="#"><?php echo $fecha; ?></a></li>
                                    <li><i class="fa fa-map-marker"></i><a href="#"><?php echo $ciudad; ?></a></li>
                                    <li><i class="fa fa-share"></i><a href="<?php echo 'empresas.php?content=estaempresa&id='.$empresaid ?>">Contactar</a></li>
                                </ul>
                            </div>
                        </div>
                    <?php
                    echo "</div><div class=\"row margin-bottom-20\">";
                    }
                    ?>
                    </div>
                    <!-- End profile oferta -->
                    <!-- Paginacion-->
                    <div class="text-center">
                        <ul class="pagination">
                        <?php 
                            echo "<li><a href=\"ofertas.php?content=estasofertas&page=$thispage\">&laquo;</a></li>";
                        if ($totpages > 1)
                            {
                                $bar = '';
                                for($page = 1; $page < $totpages; $page++)
                                    {
                                        if($page == $thispage)
                                        { 
                                            $bar .= "<li><a href=\"ofertas.php?content=estasofertas&page=$page\">$page</a></li>";
                                        }else
                                        {
                                    $bar .= "<li><a href=\"ofertas.php?content=estasofertas&page=$page\">$page</a></li>";
                                        }      
                                    }
                            }
                                    echo $bar;
                        if ($thispage < $totpages)
                        { 
                            $page = $totpages;
                            echo "<li><a href=\"ofertas.php?content=estasofertas&page=$page\">&raquo;</a></li>";
                        } 
                        ?>
                         </ul>                                                            
                    </div>     
                    <!-- End Paginacion -->
                </div>
                
            </div>
            <!-- End Profile Content -->
            <!-- Empieza Columna de 3 espacios -->
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
                                    foreach ($categorias as $category){
                                        $categoria = $main->con_casilla(categoria,categorias,catid,$category);
                                    echo "<li><a href=\"ofertas.php?content=estasofertas&catid=$category\">$categoria</a></li>";
                                    }
                                ?>  
                             </ul>                      
                        </div>
                        
                    </div>
                </div>  
            </div><!-- Termina columna de 3 espacios -->
            <!-- Termina columna de 3 espacios -->            
        </div><!--/end row-->
    </div>		
    <!--=== End Profile ===-->