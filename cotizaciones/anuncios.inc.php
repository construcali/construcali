<!-- JS se usa en anuncios.inc.php y en clacontenido.inc.php 
y unproducto.inc.php
-->
<script type="text/javascript">
    function imgError(image) {
    image.onerror = "";
    image.src = "/presentaciones/CasaGeneral.jpg";
    image.style.display = 'none';
    return true;
}
</script>
<!--=== JavaScript ===-->

<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="anuncios.php">Clasificados</a></h1>
            <ul class="pull-right breadcrumb">
                <li><a href="biblioteca.php">Biblioteca</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
                <li class="active"><a href="portafolios.php">Portafolios</a></li>
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
        <div class="headline"><h2>Ultimos Productos de <a href="empresas.php?content=estaempresa&id=<?php echo $companyid; ?>"><?php echo $company; ?></a></h2></div>
        
        <!-- Aqui ponemos los clasificados -->
        <div class="row job-content">
            <div class="col-md-9">
                <!-- Servicios en demanda -->
                
                <?php 
                foreach ($clasificados as $clasificado) {
                        $titulo = $clasificado['titulo'];
                        $ciudad = $clasificado['ciudad'];
                        //$userid = $clasificado['usuarioid'];
                        $anuncio = $clasificado['producto'];
                        $anuncio = substr($anuncio,0,400);
                        $disciplina = $clasificado['sector'];
                        $fecha = $clasificado['date'];
                        $productoid = $clasificado['productoid'];
                        //quitar etiquetas
                        $anuncio = strip_tags($anuncio,'<p><div>');
                          
                ?>
                <div class="inner-results ultimos_servicios">
                    <?php echo "<h3><a href=\"anuncios.php?content=unproducto&id=$productoid\">$titulo</a></h3>"; ?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><a href="anuncios.php?content=anuncios&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                        <li><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                    </ul>
                    <div class="overflow-h">
                    <?php
                    echo "<a href=\"anuncios.php?content=unproducto&id=$productoid\">";
                    echo "<img src=\"showproductos.php?id=$productoid\" onerror=\"imgError(this);\" alt=\"$titulo\" width=\"550\" height=\"300\" />";
                    echo "</a>";
                     ?>
                        <div class="overflow-a">
                            <p style="width:70%;margin-top:2%;"><?php echo $anuncio; ?></p>
                            <ul class="list-inline down-ul">
                                <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                                <li><i class="fa fa-reply"></i><?php echo "<a href=\"anuncios.php?content=unproducto&id=$productoid\">Responder</a>"; ?></li>
                            </ul>
                        </div>
                    </div>
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
                        $prevpage = "<li><a href=\"anuncios.php?content=anuncios&userid=$userid&page=$page\">Atras</a></li";
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
                                $bar .= "<li><a href=\"anuncios.php?content=anuncios&userid=$userid&page=$page\">$page</a></li>";
                            }
                        }
                    }
                    
                if ($thispage < $totpages)
                 {
                    $page = $thispage + 1;
                    $nextpage = "<li><a href=\"anuncios.php?content=anuncios&userid=$userid&page=$page\">Adelante</a></li>"; 
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
                <!-- Categorias -->
                <div class="headline headline-md"> 
                    <?if (isset($loginid)){
                    ?>
                    <a class="btn-u btn-block btn-u-blue" href="usuarios.php">Panel Usuario</a>
                    <?php 
                    }else{
                    ?>
                    <a class="btn-u btn-block btn-u-green" href="usuarios.php?content=registrarse">Registrate Gratis</a>
                    <?php
                    }
                    ?>
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

                <!-- End Categorias -->
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

