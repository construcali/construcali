<!-- Para formatear las fotos -->
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">    
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">
<!-- Par los formularios -->
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<!-- CSS Page Style - Para el formulario de buscar-->    
<link rel="stylesheet" href="assets/css/pages/page_search_inner.css">
<!--=== JavaScript ===-->
<!-- JS responderAnuncio.js se usa en anuncios.inc.php y en cotizaciones.inc.php 
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
<!-- este codigo esta en paginacion.js -->

<!--=== JavaScript ===-->
<!-- CSS -->
<style type="text/css">
    #spinner {
        display: none;
      }

    .resAnuncio {
        display: none;
    }
</style>
<!-- end CSS -->
<div class="wrapper">
    
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="anuncios.php">Clasificados</a></h1>
            <ul class="pull-right breadcrumb">
                 <?php if (empty($loginid)) { ?>
                <li><a href="usuarios.php">Acceder</a></li>
                <li><a href="usuarios.php?content=registrarse">Registrarse</a></li>
                <?php 
                }else{
                ?>
                <li><a href="usuarios.php">Panel Usuario</a></li>
                <li><a href="portafolios.php">Portafolios</a></li>
                <?php } ?>
                
                <li><a href="cotizaciones.php">Cotizaciones</a></li>
                
            </ul>
        </div>
    </div>
    <!--=== End Breadcrumbs ===-->
    <!--=== Search Block Version 2 ===-->
    <div class="search-block-v2">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form method="post" action="anuncios.php?content=buscar" id="buscarTerminos">
                <div class="input-group">
                    <input type="text" class="form-control" name="palabraClave" id="anuncioBuscado" placeholder="Que oficio, servicios? Que Productos, materiales?">
                    <span class="input-group-btn">
                        <button class="btn-u" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                </form>  
                <div class="row" id="suggestions">
                    
                 </div>
            </div>
        </div>    
    </div><!--/container-->     
    <!--=== End Search Block Version 2 ===-->
    
    <!--=== Content ===-->
    <div class="container content">
        <!-- Begin Service Block -->
        
        <!-- End Begin Service Block -->

        <!-- Job Content -->
        <div class="headline"><h2>Ultimos Anuncios</h2></div>
        
        <!-- Aqui ponemos los clasificados -->
        <div class="row job-content">
            <div class="col-md-9">
                <!-- Contenedor de los clasificados -->
                <div id="clasificados"> 
                <?php 
                foreach ($requeridas as $requerida) {
                        $titulo = $requerida['titulo']; //titulo del anuncio
                        $ciudad = $requerida['ciudad'];
                        //$ciudad = htmlentities($ciudad);
                        $email_anunciante = $requerida['email']; //titulo del cotizante
                        $anouncement = $requerida['anouncement'];
                        $anouncement = substr($anouncement,0,400);
                        // coger la foto, hay que incluir foto en conseguir_los_anuncios en class_paginas.php
                        //$foto = $requerida['photo'];
                        //$im_len = strlen($foto);
                        
                        $disciplina = $requerida['sector'];
                        $telefono = $requerida['telefono'];
                        $nombre = $requerida['nombre'];
                        
                        $fecha = $requerida['fecha'];
                        $productoid = $requerida['productoid'];
                        //empresaid de quien anuncio, si la hay
                        //revisar si hay empresa del userid
                        $sihaycompanyid = $requerida['companyid'];

                        $check_entities = strpos($titulo, '&lt;');
                        $check_ene = strpos($titulo, '&ntilde;');

                        if ($check_ene === true){
                            $titulo = $titulo;
                        }else{
                            $titulo = html_entity_decode($titulo);
                        }

                         // conseguir el whatsapp
                        $whatsapp = $main->con_casilla(whatsapp,redessociales,empresaid,$sihaycompanyid);
                        $whatsapp = trim($whatsapp);
                        // replace - for empty space
                        $forwhatsapp = str_replace('-', ' ', $whatsapp);
                        $wsnumber = explode(" ", $forwhatsapp);
                        $whatsapp = implode($wsnumber);
                        $whatsapp = substr($whatsapp,0, 10);
                        $whatsapp = '57'.$whatsapp;

                        // mensaje por whatsapp
                        $mensaje_contacto = 'He visto su clasificado '.$titulo.' en construcali.com y me gustaria mas informacion';

                ?>
                <div class="inner-results ultimos_servicios"> 
                    <!-- cbp-item graphic
                    # se usa el javascrip mostrarRectangulo.js cuando da click en Responder
                     -->
                    <?php 
                    if ($requerida['clase'] == 'labor'){
                    echo "<h3><a href=\"anuncios.php?content=unservicio&id=$productoid\">$titulo</a></h3>";
                     ?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><i class="fa fa-city"></i><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                        <li><i class="fa fa-whatsapp color-green"></i><?php echo "<a href=\"https://wa.me/{$whatsapp}\">".$telefono."</a>"; ?></li>
                        <?php
                        if (!empty($sihaycompanyid)){
                            $company = $main->con_casilla(empresa,companies,empresaid,$sihaycompanyid); 
                            echo "<li><a href=\"empresas.php?content=estaempresa&id={$sihaycompanyid}\">
                        $company</a></li>";
                        } 
                        ?>

                    </ul>
                    <div class="overflow-h">
                    <?php
                    echo "<a href=\"anuncios.php?content=unservicio&id=$productoid\">";
                    echo "<img src=\"showservicios.php?id=$productoid\" onerror=\"imgError(this);\" alt=\"$titulo\" width=\"550
                    \" height=\"300\" />";
                    echo "</a>";
                    ?>
                        <div class="overflow-a">
                            <p style="width:70%;margin-top:2%;"><?php echo $anouncement; ?></p>
                            <ul class="list-inline down-ul">
                                <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                                <li><a href="anuncios.php?content=servicios&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                                <li class="rectangulo"><i class="fa fa-reply"></i><?php echo "<a href=\"$productoid\">Responder</a>"; ?></li>
                                <li class="hidden-md hidden-lg"><i class="fa fa-whatsapp color-green"></i><a href="https://wa.me/<?php echo $whatsapp; ?>?text=<? echo urlencode($mensaje_contacto);?>">Contactar</a></li>
                            </ul>
                        </div>
                    <?php
                    }elseif ($requerida['clase'] == 'articulo'){
                    echo "<h3><a href=\"anuncios.php?content=unproducto&id=$productoid\">$titulo</a></h3>";
                     ?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><i class="fa fa-city"></i><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                        <li><i class="fa fa-whatsapp color-green"></i><?php echo "<a href=\"https://wa.me/{$whatsapp}\">".$telefono."</a>"; ?></li>
                        <?php 
                        if (!empty($sihaycompanyid)){
                            $company = $main->con_casilla(empresa,companies,empresaid,$sihaycompanyid); 
                            echo "<li><a href=\"empresas.php?content=estaempresa&id={$sihaycompanyid}\">
                        $company</a></li>";
                        }
                        ?>
                    </ul>
                    <div class="overflow-h">
                    <?php
                
                    echo "<a href=\"anuncios.php?content=unproducto&id=$productoid\">";
                    echo "<img src=\"showproductos.php?id=$productoid\" onerror=\"imgError(this);\" alt=\"<?php echo $titulo;?>\" width=\"550\" height=\"300\" />";
                    echo "</a>";
                    ?>
                        <div class="overflow-a">
                            <p style="width:70%;margin-top:2%"><?php echo $anouncement; ?></p>
                            <ul class="list-inline down-ul">
                                <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                                <li><a href="anuncios.php?content=productos&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                                <!-- JavaScript para este rectangulo es mostrarRectangulo.js -->
                                <li class="rectangulo"><i class="fa fa-reply"></i><?php echo "<a href=\"$productoid\">Responder</a>"; ?></li>
                                <li class="hidden-md hidden-lg"><i class="fa fa-whatsapp color-green"></i><a href="https://wa.me/<?php echo $whatsapp; ?>?text=<? echo urlencode($mensaje_contacto);?>">Contactar</a></li>
                            </ul>
                             </li>
                        </div>
                    <?php
                    } //cierra el if
                    ?>
                    </div> <!-- Cierra el div class= overflow -->
                    
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
                } //cierra el foreach
                ?> 
                </div>
                <!-- Cierra el contenedor de los clasificados -->
                <!-- buton temporal para cargar mas clasificados -->
                <div id="masAnunciosBoton">
                    <button id="masAnuncios" data-pagina="1">Mas Anuncios</button>
                </div>

                <div id="spinner">
                    <img src="/assets/img/spinner.gif" width="50" height="50" />
                </div>
                <!-- Paginacion -->
                <div class="text-left">
                    <ul class="pagination">
                    <?php
                    if ($thispage > 1)
                    {
                        $page = $thispage - 1 ;
                        $prevpage = "<li><a href=\"anuncios.php?page=$page\">Atras</a></li";
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
                                $bar .= "<li><a href=\"anuncios.php?page=$page\">$page</a></li>";
                            }
                        }
                    }
                    
                if ($thispage < $totpages)
                 {
                    $page = $thispage + 1;
                    $nextpage = "<li><a href=\"anuncios.php?page=$page\">Adelante</a></li>"; 
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
                <!-- Termina Paginacion --> 
            </div>
            <!-- Productos en demanda -->
            <div class="col-md-3">

                <!-- Categorias -->
                <div class="headline headline-md">
                    <?if (isset($loginid)){
                    ?>
                    <a class="btn-u btn-block btn-u-blue" href="https://construcali.com/usuarios.php?content=productos">Vender</a>
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

