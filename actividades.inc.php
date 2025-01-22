    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
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
    <div class="container content profile">
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
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
                        <a href="usuarios.php?content=cotizaciones?"><i class="fa fa-dashboard"></i> Mis Cotizaciones</a>
                    </li>
                                                                                                
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ajustes"><i class="fa fa-cog"></i> Ajustes</a>
                    </li>                                  
                </ul>  

                <hr>

                <a href="home.php?content=logout" role="button" class="btn-u btn-u-default btn-u-sm btn-block">Salir</a>
                
                <!--End Notification-->

                <!-- <div class="margin-bottom-50"></div> -->

                <!--Datepicker
                <form action="#" id="sky-form2" class="sky-form">
                    <div id="inline-start"></div>
                </form> 
               End Datepicker -->
            </div>
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9">
                <div class="profile-body">
                <!-- Aqui empieza tab-v1 -->
                <div class="tab-v1">
                    <!-- menu -->
                    <ul class="nav nav-justified nav-tabs">
                        <li class="active"><a href="#cotizacionMateriales" data-toggle="tab">Materiales Cotizados</a></li>
                        <li><a href="#proyectos" data-toggle="tab">Proyectos Cotizados</a></li>
                    </ul>      
                    <!-- termina el menu -->

                    <!-- Aqui empieza tab-content y tab-content fade in id -->
                    <div class="tab-content">
                         <!-- Empieza cotizaciones de materiales hechas por la persona -->
                        <div class="tab-pane fade in active" id="cotizacionMateriales">
                            
                            <?php 
                                //echo $cuantasCotizaciones;
                                if($cuantasCotizaciones >= 1){
                                $cotizaciones = $main->con_donde_order_limit(cotizaciones,usuarioid,$usuarioid,ordenid,0,10);
                                foreach($cotizaciones as $cotizacion){
                                    $ordenid = $cotizacion['ordenid'];
                                    $ciudad = $cotizacion['ciudad'];
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
                                            <li>
                                                <i class="fa fa-eye"></i>
                                                <a href="<?php echo "contestaciones.php?ordenid=".$ordenid; ?>" id="<?php echo $ordenid; ?>"><strong><?php echo $cuantasRespuestas; ?></strong>
                                                <span>Respuestas</span></a>
                                            </li>
                                            <li class="borrarMateriales"><i class="fa fa-eraser"></i><a href="<?php echo 'borrarmateriales.php?ordenid='.$ordenid; ?>">Borrar</a>
                                            </li>
                                        </ul>
                                        
    
                                    </div>
                                    <div id="<?php echo "contestacion{$ordenid}"; ?>">
                                    </div>    
                                    <div class="progress progress-u progress-xxs">
                                            <div class="progress-bar progress-bar-u" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                            </div>
                                    </div> 
                                </div>
                                <?php
                                    }
                                }
                                ?>

                                
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
                                    $pedidos = $main->con_donde_order_limit(pedidos,usuarioid,$usuarioid,ordenid,0,10);
                                    
                                    foreach ($pedidos as $pedido) {
                                        $ordenid = $pedido['ordenid'];
                                        $userid = $pedido['usuarioid'];
                                        $ciudad = $pedido['ciudad'];
                                        $catid = $pedido['catid'];
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
                                            <li class="borrarCotizacion"><a href="<?php echo 'borrarcotizacion.php?ordenid='.$ordenid; ?>"><i class="fa fa-eraser"></i>Borrar</a></li>
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
                        <!-- Termina cotizaciones de proyectos hechas por la persona, end tab pane fade in-->
                        
                        <!-- Empiezan los Comentarios publicadaos por la persona, tab-pane fade in -->
                        
                        <!-- Terminan los comentarios publicados por la persona -->
                    </div>
                    <!-- Cierra tab-content -->
                </div>    
                <!-- Cierra tab-v1 -->        
                   
                </div>
            </div>
            <!-- End Profile Content -->            
        </div>
    </div>
    <!--=== End Profile ===-->