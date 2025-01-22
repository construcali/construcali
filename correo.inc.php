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
</style>
<!-- end CSS -->
<!-- JS 
este archivo usa el javascript de correo.js
-->
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">
                <a href="usuarios.php">Tablero</a>
            </h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=profesional">Mi Profesion</a></li>
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
            <div class="col-md-3 md-margin-bottom-40">  
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
                        <a href="foros.php"><i class="fa fa-user"></i> Foros</a>
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

                <!--Notification-->   
                <a href="home.php?content=logout" role="button" class="btn-u btn-u-default btn-u-sm btn-block">Salir</a>
                <!--End Notification-->

                <!--Datepicker-->
               
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9 profile">
                <div class="profile-body margin-bottom-20"> 
                    <!-- Aqui empieza correos, hay que poner data-toggle=tab en cada uno de los enlaces para que se vea la informacion de propuestas -->
                    <!-- Aqui empieza tab-v1 -->
                    <div class="tab-v1">
                        <?php if (isset($mensajeoferta)){ echo '<h2>'.$mensajeoferta.'</h2>'; } ?>
                        <ul class="nav nav-justified nav-tabs">
                            <li class="active"><a href="#propuestas" data-toggle="tab"> Buzon</a></li>
                            <li><a href="#nuevaoferta" data-toggle="tab"> Correo Empresarial</a></li>
                            <li><a href="#contactar" data-toggle="tab"> Contactanos</a></li>
                            <li><a href="#intercambios" data-toggle="tab"> Mensajes Enviados</a></li>

                        </ul> 
                        <div class="tab-content">
                            <!-- Empieza Propuestas Recibidas -->
                            <div class="tab-pane fade in active" id="propuestas">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php 
                                        if ($sihayempresaid != 0){
                                        ?>
                                        <div class="panel panel-profile">
                                            <div class="panel-body margin-bottom-50" id="comerciales">
                                                <!--/end media media v2-->
                                                <?php
                                                if ($cuantosIntercambios > 0){
                                                    $intercambios = $main->con_donde_order_limit(intercambios,companyid,$sihayempresaid,ordenid,0,10);
                                                        foreach ($intercambios as $intercambio) {
                                                            $ordenid = $intercambio['ordenid'];
                                                            $fecha = $main->con_fecha(intercambios,ordenid,$ordenid);
                                                            $userid = $intercambio['usuarioid'];
                                                            $cotizanteid = $intercambio['empresaid'];
                                                            $estado = $intercambio['status'];
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
                                                            <li><i class="fa fa-file"></i><?php echo $estado; ?></li>
                                                            <li><a href="empresas.php?content=estaempresa&id=<?php echo $cotizanteid; ?>"><?php echo $cotizante; ?></a></li>
                                                        </ul>
                                                        <ul class="list-inline pull-right">
                                                            <li><a href="<?php echo $ordenid; ?>"><i class="expand-list rounded-x fa fa-reply"></i></a></li>
                                                        </ul>
                                                        <ul class="list-inline borrarCorreos">
                                                        <li><i class="fa fa-eraser"></i><a href="<?php echo 'borrarcorreos.php?ordenid='.$ordenid; ?>">Borrar</a></li>
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
                                                }else{
                                                    echo '<h2> No hay correos en su buzon</h2>'; 
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
                            <!-- termina propuestas recibidas -->
                            
                            <!-- Empieza subir enviar correo masivo con foto, el nombre del id nuevaoferta debe ser todo minuscula-->
                            <div class="tab-pane fade in" id="nuevaoferta">
                                <div class="row">
                                    <div class="col-sm-12">
                                            <form enctype="multipart/form-data" action="usuarios.php?content=correo" method="post" class="sky-form" id="subirOferta">
                                                
                                                <fieldset>
                                                    <section>
                                                        <label class="label">Titulo</label>
                                                        <label class="input">
                                                            <input type="text" name="titulo" id="tituloCorreoEmpresas" maxlength="40">
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Enviar a Empresas en la Categoria de:</label>
                                                        <label class="select">
                                                            <select name="categoria">
                                                                <?php
                                                                    foreach ($categorias as $categoria)
                                                                    {
                                                                        $catid = $categoria['catid'];
                                                                        $category = $categoria['categoria'];
                                                                        $category = htmlentities($category);
                                                                        $catArray[$catid] = $category;    
                                                                    }
                                                                    asort($catArray);
                                                                    foreach ($catArray as $indicador => $valor){
                                                                    echo "<option value=\"$indicador\">$valor</option>";
                                                                } //closes for each
                                                                ?>
                                                            </select>
                                                            <i></i>
                                                        </label>
                                                    </section>
                                                    
                                                    <section>
                                                        <label class="label">Una Foto</label>
                                                        <label for="file" class="input input-file">
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                                            <div class="button"><input type="file" id="file" name="presentacion" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                                        </label>
                                                    </section>                  
                                                        
                                                    <section>
                                                        <label class="label" id="mensajeCorreo">Escriba un correo masivo de menos de 500 caracteres</label>
                                                        <label class="textarea">
                                                            <!-- <i class="icon-prepend fa fa-user"></i>
                                                            <i class="icon-append fa fa-asterisk"></i> -->
                                                            <textarea rows="3" name="correoEmpresas" id="correoEmpresas" placeholder="Describa productos o servicios, precios y duracion de la oferta"></textarea>
                                                              
                                                        </label>
                                                    </section>
                                                    <button type="submit" class="btn-u text-center">Enviar Correo Masivo Empresarial</button>
                                                </fieldset>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina enviar correo masivo con foto --> 
                            <!-- Empieza contactar a construcali.com -->
                            <div class="tab-pane fade in" id="contactar">
                            <!-- Formulario para contactar a construcali.com -->
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="headline"><h2>Formulario de Contacto</h2></div>
                                    <p>Contactenos acerca de nuestros servicios, si su empresa esta registrada tambien nos puede contactar a traves de este formulario para reclamar uno de los premios.</p><br />

                                    <form action="usuarios.php" method="post" id="contactarConstrucali" class="sky-form contact-style">
                                        <fieldset class="no-padding">
                                            
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
                                    </div><!--/col-sm-12-->
                                </div>
                            </div> 
                            <!-- cierra id=contactar -->
                            
                            <!-- empiezan propuestas enviadas, tab-pane fade in -->
                            <div class="tab-pane fade in" id="intercambios">
                                <div class="panel panel-profile">
                                    <div class="panel-body margin-bottom-50">
                                    <?php
                                        //echo $cuantosPedidos;
                                        if ($cuantosMensajes >= 1)
                                        {
                                            $mensajes = $main->con_donde_order_limit(intercambios,usuarioid,$usuarioid,ordenid,0,10);
                                            
                                            foreach ($mensajes as $mensaje) {
                                                $ordenid = $mensaje['ordenid'];
                                                $userid = $mensaje['usuarioid'];
                                                $remitenteid = $mensaje['empresaid'];
                                                $receptoraid = $mensaje['companyid'];
                                                $fecha = $main->con_fecha(intercambios,ordenid,$ordenid);
                                                $servicio = $main->con_casilla(servicio,intercambios_listas,ordenid,$ordenid);
                                                $main->login();
                                                $remitente = $main->con_casilla(empresa,companies,empresaid,$remitenteid);
                                                $receptora = $main->con_casilla(empresa,companies,empresaid,$receptoraid);
                                                $telefono = $main->con_casilla(telefono,companies,empresaid,$receptoraid);
                                                $contacto = $main->con_casilla(contacto,companies,empresaid,$receptoraid);
                                                $ciudad = $main->con_casilla(ciudad,companies,empresaid,$receptoraid);
                                                $catid = $main->con_casilla(clase,companies,empresaid,$receptoraid);
                                                $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
                                                $main->entrar();
                                        ?>
                                        <div class="media media-v2">
                                            <a class="pull-left" href="#">
                                                <img class="media-object rounded-x" src="assets/img/team/LogoCasco.png" alt="">
                                            </a>
                                            <div class="media-body" id="<?php echo 'intercambio'.$ordenid; ?>">
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
                                                <!-- Borrar mensaje de la tabla intercambios -->   
                                                <ul class="list-inline results-list pull-right" id="contestacion<?php echo $ordenid; ?>">
                                                    <li class="borrarCorreos"><a href="borrarcorreos.php?ordenid=<?php echo $ordenid; ?>"><i class="fa fa-eraser"></i>Borrar</a></li>
                                                </ul>
                                                    
                                                <div class="clearfix"></div>
                                                
                                                
                                            </div>
                                        </div>
                                        <?php
                                            } // cierra foreach
                                        } // cierra if
                                        ?>
                                    </div>
                                </div> 
                            </div>
                        <!-- termina propuestas enviadas -->
                        </div>
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