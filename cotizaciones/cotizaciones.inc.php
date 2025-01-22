<!-- Par los formularios -->
<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<!-- CSS Page Style -->
<link rel="stylesheet" href="assets/css/pages/profile.css">
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
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Clasificados</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=cotizaciones">Mi Actividad</a></li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--/breadcrumbs-->
        <!--/container-->
    <!--/breadcrumbs-->
    <!--=== End Breadcrumbs - html esta en recortes.php linea 88 ===-->
        
    <!--=== End Job Img ===-->
    <!--=== Content ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <!-- <img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/LogoCasco.png" alt=""> imagen anterior img1-md.jpg -->
                <h4><?php 
                        if (isset($nombreUsuario)){
                            echo 'Bienvenido '.$nombreUsuario;
                    }
                    ?>
                </h4>
                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                   
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizacion"><i class="fa fa-cubes"></i> Cotizar</a>
                    </li>
                    
                    <?php
                     if (!empty($sihayempresaid)){
                    ?>
                    <li class="list-group-item"><a href="usuarios.php?content=empresa"><i class="fa fa-pencil"></i>Mi Empresa</a></li>
                    <li class="list-group-item"><a href="cotizaciones.php"><i class="fa fa-cubes"></i>Cotizaciones</a></li>
                    <?php
                        }else{
                    ?> 
                    <li class="list-group-item"><a href="usuarios.php?content=empresa"><i class="fa fa-pencil"></i>Vincule su Empresa</a></li>         
                    <?php 
                           }
                    ?>
                
                    <li class="list-group-item">
                        <a href="foros.php"><i class="fa fa-users"></i> Foros</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Mi Actividad</a>
                    </li>
                    
                                                                                                   
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ajustes"><i class="fa fa-cog"></i> Ajustes</a>
                    </li>                                                                      
                </ul>   

                <hr>
                <a href="home.php?content=logout" role="button" class="btn-u btn-u-default btn-u-sm btn-block">Salir</a>
            </div>
            <!--End Left Sidebar-->
            <!-- Profile Content -->            
            <div class="col-md-9">
                <div class="profile-body">
                <!-- Aqui empieza tab-v1 -->
                <div class="tab-v1">
                    <!-- menu -->
                    <ul class="nav nav-justified nav-tabs">
                        <li class="active"><a href="#ultimas_cotizaciones" data-toggle="tab">Cotizaciones</a></li>
                        <li><a href="#cotizacionMateriales" data-toggle="tab">Materiales Cotizados</a></li>
                        <li><a href="#proyectos" data-toggle="tab">Proyectos Cotizados</a></li>
                    </ul>      
                    <!-- termina el menu -->

                    <!-- Aqui empieza tab-content y tab-content fade in id -->
                    <div class="tab-content">
                        <!-- Empiezan Cotizaciones recibidas -->
                        <div class="tab-pane fade in active" id="ultimas_cotizaciones">
                        <div class="panel panel-profile">
                            <div class="panel-body margin-bottom-50" id="cotizaciones">
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
                                    $email_anunciante = $clasificado['email'];
                                     //usar htmlentities para que se vean bien las letras con tildes y enes
                                    $titulo = htmlentities($titulo);
                                    $ciudad = htmlentities($ciudad);
                                    $descripcion = htmlentities($descripcion);
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
                                    <!-- JavaScript para este rectangulo es mostrarRectangulo.js -->
                                    <li class="rectangulo"><i class="fa fa-reply"></i><?php echo "<a href=\"$productoid\">Responder</a>"; ?></li>
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
                                    <!-- JavaScript para este rectangulo es mostrarRectangulo.js -->
                                    <li class="rectangulo"><i class="fa fa-reply"></i><?php echo "<a href=\"$productoid\">Responder</a>"; ?></li>
                                </ul>
                                <hr> 
                                <!-- -->
                            </div>
                            <?php
                                }
                            ?>
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
                                <button type="submit" class="btn-u btn-u-green">Responder</button>
                                </form>
                                <div class="overflow-h" id="formularioRespuesta<?php echo $productoid; ?>">
                                            
                                </div>       
                                <!-- Aqui se cierra el formulario de la respuesta para un anuncio -->  
                            <?php
                            } // cierra for each
                            ?>
                            </div>
                            <!-- cierra el contenedor de las cotizaciones -->
                            <!-- buton temporal para cargar mas clasificados -->
                            <div id="masAnunciosBoton">
                                <button id="masCotizaciones" data-pagina="1">Mas Anuncios</button>
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
                        </div>
                        <!-- Termina Paginacion -->
                        </div>
                        <!-- Empieza cotizaciones de materiales hechas por la persona -->
                        <div class="tab-pane fade in" id="cotizacionMateriales">
                        <div class="panel panel-profile">
                            <div class="panel-body margin-bottom-50">
                            
                            <?php 
                                //echo $cuantasCotizaciones;
                                if($cuantasCotizaciones >= 1){
                                $cotizaciones = $main->con_info_desc(cotizaciones,ordenid,0,10);
                                foreach($cotizaciones as $cotizacion){
                                    $ordenid = $cotizacion['ordenid'];
                                    $titulo = 'Cotizacion #'.$ordenid;
                                    $ciudad = $cotizacion['ciudad'];
                                    //coger id del anunciante
                                    $anuncianteid = $cotizacion['usuarioid'];
                                    $email_anunciante = $main->con_casilla(email,usuarios,usuarioid,$anuncianteid);
                                    $fecha = $main->con_fecha(cotizaciones,ordenid,$ordenid);
                                    $catid = $cotizacion['catid'];
                                    $cuantasRespuestas = $main->contar_ids(respuestaid,cotizaciones_respuestas,ordenid,$ordenid);
                                    $cotizacionesListas = $main->con_tabla_id(cotizaciones_listas,ordenid,$ordenid);
                                    $main->login();
                                    $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
                                    $main->entrar();
                            ?>
                                <div class="col-sm-12">   
                                    <div class="projects">
                                        <h2><?php echo 'Cotizacion # '.$ordenid; ?></h2>
                                        <ul class="list-unstyled list-inline blog-info-v2">
                                            <li><i class="fa fa-briefcase"></i><a class="color-green" href="#"><?php echo $categoria; ?></a></li>
                                            <li><i class="fa fa-clock-o"></i><?php echo $fecha; ?></li>
                                            <li><i class="fa fa-globe"></i><?php echo $ciudad; ?></li>
                                        
                                        </ul>
                                        <hr>
                                        
                                        <?php 
                                        foreach ($cotizacionesListas as $cotizacionLista) {
                                        ?>
                                        <ul class="list-inline blog-info-v2">
                                            <li>
                                                <strong><?php echo htmlentities($cotizacionLista['material']); ?></strong>
                                            </li>
                                            <li>
                                                <strong><?php echo $cotizacionLista['cantidad']; ?></strong>
                                            </li>
                                            <li>
                                                <strong><?php echo $cotizacionLista['unidades']; ?></strong>
                                            </li>
                                        </ul>
                                        <?php
                                        }
                                        ?>
                                        
                                        <hr>
                                        <ul class="list-inline blog-info-v2 respuestaMateriales">
                                            
                                            <li class="rectangulo"><i class="fa fa-reply"></i><a href="<?php echo $ordenid; ?>">Responder</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Este es formulario de la respuesta para un aununcio -->
                                    <form action="responder.php" class="sky-form resAnuncio" method="post" id="comentar<?php echo $ordenid; ?>">
                                        <!-- Esta id resAnuncio esta en el archivo responderAnuncio.js -->
                                    <section>
                                        <!-- label class="label">Debe haber ingresado como usuario para poder responder</label -->
                                            <label class="textarea">
                                                <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" name="oferta" id="oferta_<?php echo $ordenid; ?>" placeholder="Escriba su respuesta aqui"></textarea>
                                            </label>
                                    </section>
                                    <?php
                                    echo "<input type=\"hidden\" name=\"usuarioid\" id=\"respondonid{$ordenid}\" value=\"$loginid\" />";

                                     echo "<input type=\"hidden\" name=\"email\" id=\"email{$ordenid}\" value=\"$email_anunciante\" />";   
                                     echo "<input type=\"hidden\" name=\"titulo\" id=\"titulo{$ordenid}\" value=\"$titulo\" />"; 
                                    ?>
                                    <button type="submit" class="btn-u btn-u-blue">Responder</button>
                                    </form>
                                    <div class="overflow-h" id="formularioRespuesta<?php echo $ordenid; ?>">
                                                
                                    </div>       
                                    <!-- Aqui se cierra el formulario de la respuesta para un anuncio -->    
                                    <div class="progress progress-u progress-xxs">
                                            <div class="progress-bar progress-bar-u" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                            </div>
                                    </div> 
                                </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>    
                        </div>        
                        </div><!--/end row-->
                        <!-- Termina cotizaciones de materiales hechas por las personas -->
                        
                        <!-- empieza cotizaciones de proyectos hechas por las persona-->
                        <div class="tab-pane fade in" id="proyectos"><!-- cotizaciones de proyectos -->
                        <div class="panel panel-profile">
                            <div class="panel-body margin-bottom-50">
                            <?php
                                if (empty($cuantosPedidos)){
                                    echo "<h2>No hay cotizaciones de proyectos suyas todavia</h2>";
                                }elseif ($cuantosPedidos >= 1){
                                    $pedidos = $main->con_info_desc(pedidos,ordenid,0,10);
                                    
                                    foreach ($pedidos as $pedido) {
                                        $ordenid = $pedido['ordenid'];
                                        $userid = $pedido['usuarioid'];
                                        $ciudad = $pedido['ciudad'];
                                        $catid = $pedido['catid'];
                                        $titulo = $pedido['titulo'];
                                        $email_anunciante = $main->con_casilla(email,usuarios,usuarioid,$userid);
                                        $fecha = $main->con_fecha(pedidos,ordenid,$ordenid);
                                        $servicio = $main->con_casilla(anouncement,pedidos,ordenid,$ordenid);
                                        $servicio = htmlentities($servicio);
                                        $contacto = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
                                        $telefono = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
                                        $main->login();
                                        $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
                                        $main->entrar();
                                ?>
                                <div class="media media-v2">
                                    
                                    <div class="media-body" id="<?php echo 'servicio'.$ordenid; ?>">
                                        <h4 class="media-heading">
                                            <strong><i class="fa fa-user"></i><?php echo $contacto; ?></strong><i class="fa fa-phone"></i><?php echo $telefono; ?>
                                            <i class="fa fa-calendar"></i><?php echo $fecha; ?>
                                        </h4>
                                        <p><?php echo $servicio; ?></p>
                                        <ul class="list-inline results-list pull-left">
                                            <li><i class="fa fa-globe"></i><?php echo $ciudad; ?></li>
                                        </ul>
                                        <ul class="list-inline results-list pull-left">
                                            <li><i class="fa fa-briefcase"></i><?php echo $categoria; ?></li>
                                        </ul> 
                                        <ul class="list-inline results-list pull-right" id="borrarCotizacion<?php echo $ordenid; ?>">
                                            <li class="rectangulo"><a href="<?php echo $ordenid; ?>"><i class="fa fa-reply"></i>Responder</a></li>
                                        </ul>
                                             
                                        <div class="clearfix"></div>
                                        
                                        
                                    </div>
                                     <!-- Este es formulario de la respuesta para un aununcio -->
                                    <form action="responder.php" class="sky-form resAnuncio" method="post" id="comentar<?php echo $ordenid; ?>">
                                        <!-- Esta id resAnuncio esta en el archivo responderAnuncio.js -->
                                    <section>
                                        <!-- label class="label">Debe haber ingresado como usuario para poder responder</label -->
                                            <label class="textarea">
                                                <i class="icon-append fa fa-comment"></i>
                                                    <textarea rows="3" name="oferta" id="oferta_<?php echo $ordenid; ?>" placeholder="Escriba su respuesta aqui"></textarea>
                                            </label>
                                    </section>
                                    <?php
                                    echo "<input type=\"hidden\" name=\"usuarioid\" id=\"respondonid{$ordenid}\" value=\"$loginid\" />";

                                     echo "<input type=\"hidden\" name=\"email\" id=\"email{$ordenid}\" value=\"$email_anunciante\" />";   
                                     echo "<input type=\"hidden\" name=\"titulo\" id=\"titulo{$ordenid}\" value=\"$titulo\" />"; 
                                    ?>
                                    <button type="submit" class="btn-u btn-u-blue">Responder</button>
                                    </form>
                                    <div class="overflow-h" id="formularioRespuesta<?php echo $ordenid; ?>">
                                                
                                    </div>       
                                    <!-- Aqui se cierra el formulario de la respuesta para un anuncio -->
                                </div>
                                <?php
                                    } // cierra foreach
                                } // cierra if
                                ?>
                            </div>
                        </div>
                        </div>
                        <!-- Termina cotizaciones de proyectos hechas por la persona, end tab pane fade in--> 
                    </div>
                    <!-- Cierra tab-content -->
                </div>    
                <!-- Cierra tab-v1 -->        
                   
                </div>
            </div>
            <!-- End Profile Content -->  
        </div>

       
        
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

