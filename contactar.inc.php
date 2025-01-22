    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Tablero</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=profesional">Mi Profesion</a></li>
            </ul>
        </div><!--/end container-->
</div>
<!--=== End Breadcrumbs ===-->
<!--=== Profile ===-->
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
                    <li  class="list-group-item">
                        <a href="usuarios.php?content=productos"><i class="fa fa-file"></i>Anunciar</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizacion"><i class="fa fa-cubes"></i> Cotizar</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=correo"><i class="fa fa-envelope"></i> Correo</a>
                    </li> 
                    <?php
                     if (!empty($sihayempresaid)){
                                
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php?content=empresa\"><i class=\"fa fa-pencil\"></i>Mi Empresa</a></li>";

                           }else{
                    ?> 
                    <li class="list-group-item">
                    <?php 
                                echo "<a href=\"usuarios.php?content=empresa\"><i class=\"fa fa-user\"></i>Vincule su Empresa</a>";
                           }
                    ?>
                    </li>
                
                    <li class="list-group-item">
                        <a href="foros.php"><i class="fa fa-cubes"></i> Foros</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Mi Actividad</a>
                    </li>
                    <li class="list-group-item">
                        <a href="foros.php"><i class="fa fa-globe"></i> Foros</a>
                    </li>
                    <li  class="list-group-item">
                        <a href="usuarios.php?content=premio"><i class="fa fa-file"></i>Premios <?php if (isset($points))echo ' ('.$points.')'; ?></a>
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
                    <!--Service Block v3-->
                    <!--/end row-->
                    <!--End Service Block v3-->
                    <!-- Tab v1 -->                
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#contactar" data-toggle="tab">Contactar</a></li>
                        <?php if (isset($sihayempresaid)){
                        ?>
                        <li><a href="#propuestas" data-toggle="tab">Mensajes Recibidos</a></li>
                        <?php
                        }
                        ?>
                        
                    </ul>                
                    <div class="tab-content">
                        <!-- formulario de contacto -->
                        <div class="tab-pane fade in active" id="contactar">
                            <!-- Formulario para contactar a construcali.com -->
                            <div class="col-md-9 mb-margin-bottom-30">
                                <div class="headline"><h2>Formulario de Contacto</h2></div>
                                <p>Contactenos acerca de nuestros servicios, si su empresa esta registrada tambien nos puede contactar a traves de este formulario para reclamar uno de los premios.</p><br />

                                <form action="usuarios.php" method="post" id="contactarConstrucali" class="sky-form contact-style">
                                    <fieldset class="no-padding">
                                        <label>Titulo del Mensaje <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="titulo" id="titulo" placeholder="ej: pagina web" class="form-control">
                                                </div>
                                            </div>                
                                        </div>
                                        
                                        <label>Motivo del Mensaje <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-7 col-md-offset-0">
                                                <div>
                                                    <input type="text" name="motivo" id="motivo" placeholder="ej: Reclamar pagina web con mis puntos" class="form-control">
                                                </div>
                                            </div>                
                                        </div>
                                        
                                        <label>Mensaje <span class="color-red">*</span></label>
                                        <div class="row sky-space-20">
                                            <div class="col-md-11 col-md-offset-0">
                                                <div>
                                                    <textarea rows="8" name="message" id="message" class="form-control"></textarea>
                                                </div>
                                            </div>                
                                        </div>
                                        
                                        <p><button type="submit" class="btn-u" id="botonContactar">Enviar Mensaje</button></p>
                                    </fieldset>

                                    <div>
                                        <?php
                                            if (isset($aviso))
                                                echo $aviso;
                                        ?>
                                    </div>
                                </form>
                            </div><!--/col-md-9-->
                        </div> <!-- cierra id=contactar -->
                        <!-- empieza propuestas -->
                        <!-- Aqui empieza mensajes recibidos -->
                        <?php 
                                if ($sihayempresaid != 0){
                        ?>
                        <div class="tab-pane fade in" id="propuestas">
                            <div class="row">
                                <div class="col-sm-12">
                                
                                        <div class="panel panel-profile">
                                            <div class="panel-body margin-bottom-50" id="comerciales">
                                                <!--/end media media v2-->
                                                <?php
                                                if ($cuantosMensajes > 0){
                                                    $mensajes = $main->con_donde_order_limit(intercambios,companyid,$sihayempresaid,ordenid,0,10);
                                                        foreach ($mensajes as $mensaje) {
                                                            $ordenid = $mensaje['ordenid'];
                                                            $fecha = $main->con_fecha(intercambios,ordenid,$ordenid);
                                                            $userid = $mensaje['usuarioid'];
                                                            $cotizanteid = $mensaje['empresaid'];
                                                            $estado = $mensaje['status'];
                                                            $contacto = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
                                                            $telefono = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
                                                            $servicio = $main->con_casilla(servicio,intercambios_listas,ordenid,$ordenid);
                                                            $main->login();
                                                            if ($cotizanteid != 1)
                                                                $cotizante = $main->con_casilla(empresa,companies,empresaid,$cotizanteid);
                                                            $main->entrar();
                                                
                                                ?> 
                                                <div class="media media-v2 margin-bottom-20">
                                                    <a class="pull-left" href="#">
                                                        <img class="media-object rounded-x" src="assets/img/team/LogoCasco.png" alt="Logo Casquito Amarillo">
                                                    </a>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <strong><i class="fa fa-user"></i><?php echo $contacto; ?></strong><i class="fa fa-phone"></i><?php echo $telefono; ?>
                                                            <small><?php echo $fecha; ?></small>
                                                        </h4>
                                                        <p><?php echo $servicio; ?></p>
                                                        <ul class="list-inline results-list pull-left">
                                                            <li><a href="empresas.php?content=estaempresa&id=<?php echo $cotizanteid; ?>"><?php echo $cotizante; ?></a></li>
                                                             <li class="borrarCorreos"><i class="fa fa-eraser"></i><a href="<?php echo 'borrarcorreos.php?ordenid='.$ordenid; ?>">Borrar</a></li>
                                                        </ul>
                                                        <!-- Javscript es posible que este en footer.html, linea 238 -->
                                                        <ul class="list-inline pull-right">
                                                            <li><a href="<?php echo $ordenid; ?>"><i class="expand-list rounded-x fa fa-reply"></i></a></li>
                                                        </ul>
                                                        
                                                        <div id="<?php echo "contestacion{$ordenid}"; ?>">
                                                        </div>   

                                                        <div class="clearfix"></div>
                                                        
                                                        <div class="media media-v2" style="display:none" id="<?php echo "respuesta".$ordenid; ?>">
                                                            <a class="pull-left" href="#">
                                                                <img class="media-object rounded-x" src="assets/img/team/LogoCasco.png" alt="logo casquito amarillo">
                                                            </a>
                                                            <form action="usuarios.php?content=procesarComercial" method="post" class="sky-form" id="<?php echo $ordenid; ?>">
                                                            <div class="media-body">
                                                                <section>
                                                                    <label class="label" id="<?php echo 'label'.$ordenid; ?>">Respuesta</label>
                                                                    <label class="textarea">
                                                                        <textarea rows="3" name="acambiode" id="<?php echo 'acambiode'.$ordenid; ?>" ></textarea>
                                                                    </label>
                                                                </section>
                                                                <button type="submit" class="btn-u">Responder</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>    
                                                </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <!--/end media media v2-->
                                                
                                            </div>
                                        </div> 

                                        
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                        </div>
                        <!-- termina mensajes recibidos -->
                        <!-- Cierra propuestas -->
                    </div>      
                    <!--=== Cierra tab-content ===-->
                </div> <!-- Cierra tab-v1 -->
                </div><!-- Cierra profile-body -->
            </div> <!-- Cierra Col-md-9 -->
        </div> <!-- Cierra Row -->
    </div> <!-- Cierra Container-profile -->