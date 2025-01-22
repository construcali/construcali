    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
<!--=== Profile ===-->
    <div class="container content profile">
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/LogoCasco.png" alt=""><!-- imagen anterior img1-md.jpg -->

                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <li class="list-group-item">
                        <a href="usuarios.php"><i class="fa fa-bar-chart-o"></i> General</a>
                    </li>
                    <li class="list-group-item active">
                        <a href="usuarios.php?content=empresa"><i class="fa fa-user"></i> Empresa</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=pedidos"><i class="fa fa-group"></i> Proyectos</a>
                    </li>                                        
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-cubes"></i> Cotizaciones</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=actividades"><i class="fa fa-file"></i> Actividad</a>
                    </li>                                                                               
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ajustes"><i class="fa fa-cog"></i> Ajustes</a>
                    </li> 
                </ul>   

                <hr>

                <!--Notification-->
                <div class="panel-heading-v2 overflow-h">
                    <h2 class="heading-xs pull-left"><i class="fa fa-bell-o"></i>Notificaciones</h2>
                    <a href="#"><i class="fa fa-cog pull-right"></i></a>
                </div>
                <ul class="list-unstyled mCustomScrollbar margin-bottom-20" data-mcs-theme="minimal-dark">
                <?php 
                    foreach ($cuadernos as $cuaderno) {
                        $cuanombre = $cuaderno['nombre'];
                        $cotidia = $cuaderno['nuevafecha'];
                ?>
                    <li class="notification">
                        <i class="icon-custom icon-sm rounded-x icon-bg-red icon-line icon-envelope"></i>
                        <div class="overflow-h">
                           <?php echo "<span><strong>$cuanombre</strong> ha hecho una cotizacion</span>"; ?>
                           <?php echo "<small>$cotidia</small>"; ?>
                        </div>    
                    </li>
                <?php 
                }
                ?> 

                <?php
                    foreach ($libros as $libro) {
                        $libnombre = $libro['nombre'];
                        $libdia = $libro['nuevafecha'];
                ?>
                    <li class="notification">
                        <i class="icon-custom icon-sm rounded-x icon-bg-red icon-line icon-envelope"></i>
                        <div class="overflow-h">
                            <?php echo "<span><strong>$libnombre</strong> ha cotizado un nuevo trabajo.</span>"; ?>
                            <?php echo "<small>$libdia</small>"; ?>
                        </div>    
                    </li>
                <?php
                }
                ?>    
                </ul>    
                <a href="home.php?content=logout" role="button" class="btn-u btn-u-default btn-u-sm btn-block">Salir</a>
                <!--End Notification-->

                <div class="margin-bottom-50"></div>

                <!--Datepicker-->
                <form action="#" id="sky-form2" class="sky-form">
                    <div id="inline-start"></div>
                </form> 
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9">
                <div class="profile-body">
                    <!--Projects-->
                    <?php 
                        if ($sihayempresaid != 0){
                    ?>
                    
                    <!-- Cotizaciones Requeridas -->
                   
        
                    <!--/end media media v2--> 
                    <!-- Muestra las cotizaciones de materiales -->
                    
                    <!--/end media media v2-->

                    <!-- empiezan propuestas recibidas -->
                    <div class="panel panel-profile">
                        <div class="panel-body margin-bottom-50" id="comerciales">
                        <button type="button" class="btn-u btn-u-default btn-block">Propuestas Comerciales</button>
                            <!--/end media media v2-->
                            <?php
                            if ($cuantosIntercambios != 0){
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

                    <!-- termina propuestas recibidas -->
                    <?php
                    }
                    ?>

                    <!-- Empieza media block v2 las cotizaciones en pedidos y sus respuestas -->
                    
                    <!-- Termina media block v2  y poner las respuestas de pedidos_respuestas -->        
                          
                    <!-- Empieza cotizaciones hechas por la persona -->
                    <!--/end row-->
                    <!--End Projects-->

                    <!--Projects-->
                    <!--/end row-->
                    <!--End Projects-->

                    <!--Projects-->
                    <!--/end row-->
                    <!--End Projects-->
                    
                </div>
            </div>
            <!-- End Profile Content -->            
        </div>
    </div>
    <!--=== End Profile ===-->