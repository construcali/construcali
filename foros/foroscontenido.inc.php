<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<link rel="stylesheet" href="assets/css/pages/profile.css">
 <!-- CSS Page Style -->
<link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
<!-- CSS -->
<style type="text/css">
    #spinner {
        display: none;
      }

    .resForo {
        display: none;
    }
</style>
<!-- end CSS -->
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="usuarios.php">Tablero</a></h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=cotizaciones">Mi Actividad</a></li>
            </ul>
        </div><!--/end container-->
    </div>
<!--=== End Breadcrumbs ===-->
 <!--=== Profile ===-->
 <!-- esta clase profile no deja que las categorias tengan cierta distacia del borde
 sin embargo se necesita para que se vean bien las descripciones de las ofertas -->
    <div class="container content profile"> 
        <div class="row">
            <!--Left Sidebar-->
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">  
                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizacion"><i class="fa fa-cubes"></i> Cotizar</a>
                    </li>
                    
                    <?php
                     if (!empty($sihayempresaid)){
                    ?>
                    <li class="list-group-item"><a href="usuarios.php?content=empresa"><i class="fa fa-pencil"></i>Mi Empresa</a></li>
                    <li class="list-group-item"><a href="cotizaciones.php?content=cotizaciones"><i class="fa fa-cubes"></i>Cotizaciones</a></li>
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
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Mis Cotizaciones</a>
                    </li>
                                                                                                  
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ajustes"><i class="fa fa-cog"></i> Ajustes</a>
                    </li>                                                                      
                </ul>
                <hr>

                <!-- Notification -->
                <a href="home.php?content=logout" role="button" class="btn-u btn-u-default btn-u-sm btn-block">Salir</a>
                 
                <!--End Notification-->

                <!--Datepicker-->
               
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9 profile">
                <div class="profile-body margin-bottom-20"> 
                    <!-- Aqui empieza correos, hay que poner data-toggle=tab en cada uno de los enlaces para que se vea la informacion de propuestas -->
                    <!-- Aqui empieza tab-v1 -->
                    <div class="tab-v1">
                        <ul class="nav nav-justified nav-tabs">
                            <li class="active"><a href="#foros" data-toggle="tab">Foros</a></li>
                            <li><a href="#misForos" data-toggle="tab">Mis Foros</a></li>
                            <li><a href="#misComentarios" data-toggle="tab">Mis Comentarios</a></li>
                            <li><a href="#recomendaciones" data-toggle="tab">Mis Recomendaciones</a></li>
                        </ul> 
                        <div class="tab-content">
                            
                            <!-- empiezan foros -->
                            <div class="tab-pane fade in active" id="foros">
                            <div class="panel panel-profile"> <!-- id boletines, cargarMasBoletines.js, linea 8 -->
                               
                                <!-- ultimos 10 foros -->
                                <div class="panel-body margin-bottom-50" id="boletines">
                                    <div class="headline"><h2>Boletines</h2></div>
                                    <!-- formulario de publicacion de un boletin -->
                            
                                    <form enctype="multipart/form-data" action="usuarios.php" id="nuevoForo" method="post" class="sky-form">
                                     <section>
                                            <label class="label" id="mensajeForo">Crear publicacion de menos de 300 caracteres</label>
                                                <label class="textarea">
                                                            <!-- <i class="icon-prepend fa fa-user"></i>
                                                            <i class="icon-append fa fa-asterisk"></i> -->
                                                    <textarea rows="3" name="mensaje" id="mensaje" placeholder="Describa productos o servicios, precios y lugar" autofocus></textarea>
                                                              
                                                </label>
                                    </section>    
                                    <button type="submit" id="botonPublicarBoletin" class="btn-u text-center">Publicar</button>
                                    </form>
                                    <div id="procesarForo"></div>
                                    
                                    <!-- se termina formulario de publicacion de un boletin -->  
                                <?php foreach($blogs as $blog){
                                        $productoid = $blog['productoid'];
                                        
                                        $usuarioid = $blog['usuarioid'];
                                        $contacto = $blog['nombre'];
                                        $fecha = $blog['fecha'];
                                        $numcoment = $blog['numcoment'];
                                        $categoria = $blog['categoria'];
                                        $catid = $blog['catid'];
                                        $logo = $blog['logo'];
                                        $companyid = $blog['companyid'];
                                        //$telefono = $blog['telefono']; asunto de privacidad
                                        //$ciudad = $blog['ciudad']; innecesario
                                        // revisar si titulo tiene codigos htmlentities o no

                                        $tema = $blog['tema'];
                                        $largo_tema = strlen($tema);
                                        $servicio = substr($tema,0,300);
                                        //revisar si servicio tiene codigos htmlentities o no
                                        $check_entities = strpos($servicio, '&lt;');
                                        // revisar si check_entities es verdad
                                        
                                        if ($check_entities !== false){
                                            // encontro &lt
                                            $servicio = html_entity_decode($servicio);
                                        }
                                        else if (strstr($servicio, 'tilde;') || strstr($servicio, 'acute;')){
                                            $servicio = $servicio;
                                        }else {
                                            $servicio = htmlentities(strip_tags($servicio));
                                            // no encontro &Lt, derpronto tiene etiquesta <>
                                        }
                                    ?>
                                    <div class="media media-v2">
                                    <?php
                                        if (empty($logo)){
                                    ?>
                                    <a class="pull-left" href="#">
                                        <img class="media-object rounded-x" width="128px" src="assets/img/team/LogoCasco.png" alt="">
                                    </a>
                                    <?php 
                                        }else
                                        {
                                    ?>
                                    <a class="pull-left" href="empresas.php?content=estaempresa&id=<?php echo $companyid; ?>">
                                        <img class="media-object" width="128px" src="<?php echo "logo/$logo"; ?>" alt="Logo de la Empresa" />
                                    </a>
                                    <?php
                                        }
                                    ?>
                                        <div class="media-body" id="<?php echo 'intercambio'.$productoid; ?>">
                                            
                                            <h4 class="media-heading">
                                                
                                                <strong><i class="fa fa-user"></i><?php echo $contacto; ?></strong><i class="fa fa-calendar"></i><?php echo $fecha; ?>
                                                
                                            </h4>
                                            <p>
                                            <?php 
                                                echo $servicio;
                                                if ($largo_tema > 300) echo '... <a href="foros.php?content=unforo&foroid='.$productoid.'">Ver mas</a>'; 
                                            ?>
                                                
                                            </p>
                                            <!-- el javascript foros.js carga los comentarios cuando se da click en el enlace con la clase numcoment, foros.js esta unido en la linea 181 de footer.html -->
                                            <ul class="list-inline results-list pull-left">
                                                <li><i class="fa fa-comments"></i> 
                                                    <?php echo $numcoment."<a href=\"foros.php?content=unforo&foroid=$productoid#comentarios\" id=\"$productoid\" class=\"numcoment\"> Comentarios</a>"; ?> 
                                                </li>
                                            </ul>
                                            <!-- Ir a la pagina del foro --->
                                            <ul class="list-inline results-list pull-right">
                                                <li><a href="foros.php?content=unforo&foroid=<?php echo $productoid; ?>"><i class="expand-list rounded-x fa fa-link"></i></a></li>
                                            </ul>
                                            
                                            <ul class="list-unstyled list-inline blog-tags">
                                                <li class="rectangulo">
                                                    <i class="expand-list rounded-x fa fa-reply"></i>
                                                    <?php echo "<a href=\"$productoid\">Responder</a>"; ?>
                                                </li>
                                            </ul> 
                                            <form action="foros.php?content=pubcomentario" class="sky-form resForo" method="post" id="comentar<?php echo $productoid; ?>">
                                            <!-- Esta clase esta en los archivos foros.js y mostrarRectangulo.js -->
                                            <section>
                                                <!-- label class="label">Debe haber ingresado como usuario para poder responder</label -->
                                                    <label class="textarea">
                                                        <i class="icon-append fa fa-comment"></i>
                                                            <textarea rows="3" name="oferta" id="oferta_<?php echo $productoid; ?>" placeholder="Escriba su respuesta aqui"></textarea>
                                                    </label>
                                            </section>
                                            <?php
                                            echo "<input type=\"hidden\" name=\"foroid\" value=\"$productoid\" id=\"foroid\">";  
                                            ?>
                                            <button type="submit" class="btn-u btn-u-blue">Responder</button>
                                            </form>
                                            <!-- Aqui se pone la respuesta despues de enviar un comentario -->
                                            <div id="procesarComentario<?php echo $productoid; ?>"></div>
                                            <!-- Aqui se cargan los comentarios -->
                                            <div class="media" id="comentarios<?php echo $productoid; ?>">
                                            </div>    
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <?php
                                        } // cierra foreach
                                    ?>
                                </div>
                            </div>
                            <!-- cierra id=boletines, buton temporal para cargar mas boletines -->
                            <div id="masBoletinesBoton">
                                <button id="masBoletines" data-pagina="1">Mas Anuncios</button>
                            </div>
                            <div id="spinner">
                                <img src="/assets/img/spinner.gif" width="50" height="50" />
                            </div> 
                            </div>
                            <!-- terminan foros -->
                            <!-- Empieza Foros publicadaos por la persona, tab-pane fade in -->
                            <div class="tab-pane fade in" id="misForos">
                                <?php
                                if (empty($cuantosForos)){
                                ?>
                                <div>
                                <button type="button" class="btn-u btn-u-default btn-u-sm btn-block">No hay foros publicados por usted todavia</button>
                                </div>
                                <?php
                                }else{
                                //$main->login();// para entrar a la $tabla que es productos o servicios
                                //echo $cuantosForos.' foros publicados';

                                foreach ($misForos as $misForo) {
                                        $productoid = $misForo['productoid'];
                                        $titulo = $misForo['titulo'];
                                        $servicio = $misForo['tema'];
                                        $fecha = $main->get_fecha(foros,$productoid);
                                        //$hora = $misForo['hora'];
                                        $catid = $misForo['catid'];
                                        $sector = $main->con_casilla(categoria,categorias,catid,$catid);
                             //despues se crea una funcion y tabla que guarde respuestas si empiezan a responder.
                            ?>
                                <div class="media media-v2">
                                    <a class="pull-left" href="#">
                                        <img class="media-object rounded-x" src="assets/img/team/LogoCasco.png" alt="">
                                    </a>
                                    <div class="media-body" id="<?php echo "borradoForo{$productoid}"; ?>">
                                        <h4 class="media-heading">
                                            <strong><i class="fa fa-user"></i><?php echo $titulo.' Anuncio # '.$productoid; ?></strong>
                                        </h4>
                                        <p><?php echo $servicio; ?></p>
                                        <ul class="list-inline results-list pull-left borrarForo">
                                            <li><i class="fa fa-calendar"></i><?php echo $fecha; ?></li>
                                            <li><i class="fa fa-eraser"></i><a href="<?php echo 'borrarforo.php?productoid='.$productoid; ?>">Borrar</a></li>
                                        </ul>    
                                        <ul class="list-inline pull-right">
                                            <li><i class="expand-list rounded-x fa fa-briefcase"></i><?php echo $sector ?></li>
                                        </ul>
                                        <!--
                                        Aqui va la id para llamar la funcion que revise que respuestas han 
                                        habido al anuncio. -->
                                        
                                    </div>
                                    
                                </div>
                            <?php
                                } //closes for each
                            } //closes else
                            ?>
                            </div>
                            <!-- Termina foros publicados por la persona -->
                            <!-- Empiezan los Comentarios publicadaos por la persona, tab-pane fade in -->
                            <div class="tab-pane fade in" id="misComentarios">
                                <?php
                                if (empty($cuantosComentarios)){
                                ?>
                                <div>
                                <button type="button" class="btn-u btn-u-default btn-u-sm btn-block">No hay Comentarios publicados por usted todavia </button>
                                </div>
                                <?php
                                }else{
                                //$main->login();// para entrar a la $tabla que es productos o servicios
                                //echo $cuantosForos.' foros publicados';

                                foreach ($misComentarios as $misComentario) {
                                        $comentarioid = $misComentario['productoid'];
                                        $foroid = $misComentario['foroid'];
                                        $titulo = $main->con_casilla(titulo,foros,productoid,$foroid);
                                        $comentario = $misComentario['comentario'];
                                        $fecha = $main->get_fecha(comentarios,$comentarioid);
                                        //$hora = $misComentario['hora']
                             //despues se crea una funcion y tabla que guarde respuestas si empiezan a responder.
                            ?>
                                <div class="media media-v2">
                                    <a class="pull-left" href="#">
                                        <img class="media-object rounded-x" src="assets/img/team/LogoCasco.png" alt="">
                                    </a>
                                    <!-- respuesta desde borrarcomentario.php y borrar.js -->
                                    <div class="media-body" id="<?php echo "borradoComentario{$comentarioid}"; ?>">
                                        <h4 class="media-heading">
                                            <strong><i class="fa fa-user"></i><?php echo $titulo.' Foro # '.$foroid; ?></strong>
                                        </h4>
                                        <p><?php echo $comentario; ?></p>
                                        <ul class="list-inline results-list pull-left borrarComentario">
                                            <li><i class="fa fa-calendar"></i><?php echo $fecha; ?></li>
                                            <li><i class="fa fa-eraser"></i><a href="<?php echo 'vistas/usuarios/borrarcomentario.php?comentarioid='.$comentarioid; ?>" id="<?php echo $comentarioid; ?>">Borrar</a></li>
                                        </ul>    
                                        
                                        
                                        
                                    </div>
                                    
                                </div>
                            <?php
                                } //closes for each
                            } //closes else
                            ?>
                            </div>
                        <!-- Terminan los comentarios publicados por la persona --> 
                        <!-- empiezan recomendaciones -->
                            <div class="tab-pane fade in" id="recomendaciones">
                                <div class="panel panel-profile">
                                    <!-- las recomendaciones del usuario $usuarioid -->
                                    <?php 
                                        if (isset($mensaje)) echo $mensaje;
                                    ?>
                                    <div class="panel-body margin-bottom-50">
                                     <?php 
                                        foreach ($recomendaciones as $recomendacion){
                                            $productoid = $recomendacion['productoid'];
                                            $evaluacion = $recomendacion['evaluacion'];
                                            $calificacion = $recomendacion['calificacion'];
                                            $foristaid = $recomendacion['usuarioid'];                        
                                            // conseguir fecha y formatearla
                                            $fecha = $recomendacion['fecha'];
                                            $posteada = $main->formatear_fecha($fecha);
                                            // conseguir nombre de la empresa
                                            $companyid = $recomendacion['empresaid'];
                                            $compania = $main->con_casilla(empresa,companies,empresaid,$companyid);
                                    ?>
                                    <div class="media media-v2">
                                        <div class="media-body">
                                        <div class="row" style="margin-left:2px">
                                        <?php 
                                            for ($i=1; $i <= 5; $i++) { 
                                            ?>
                                            <label style="float:left">
                                                <span class="fa strella">
                                                <?php
                                                 if ($calificacion >= $i) {
                                                    echo '&#9733';
                                                 }else{
                                                    echo '&nbsp';
                                                 }

                                                ?>
                                                </span>
                                            </label>
                                        <?php
                                            }
                                        ?>   
                                            
                                        </div>    
                                        <h4 class="media-heading">
                                            <i class="fa fa-briefcase"><?php echo $compania; ?></i>
                                            <i class="fa fa-calendar"><?php echo $posteada; ?></i></h4>
                                            <p><?php echo html_entity_decode($recomendacion['evaluacion'], ENT_NOQUOTES); ?></p>
                                        
                                            <ul class="list-unstyled list-inline" id="borrarEvaluacion<?php echo $productoid; ?>">
                                                <li class="borrarEvaluacion"><i class="fa fa-eraser"></i><a href="#" id="<?php echo $productoid; ?>">Borrar</a></li>
                                            </ul>
                                             
                                        </div>
                                    </div>
                                    <?php
                                        }
                                     ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Terminan las recomendaciones -->
                        </div><!-- Termina tab-content-->
                    </div>
                    <!-- Aqui termina Tab V1 -->
                    <!-- termina correos -->
                    
                    <!-- Paginacion-->
                    
                    <!-- End Paginacion -->
                </div>
                
            </div>
                      
        </div><!--/end row-->
    </div>      
    <!--=== End Profile ===-->