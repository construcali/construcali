    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
    <!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">
                <?php
                    if (isset($mensaje_temporal)){ echo $mensaje_temporal;
                    }else{ echo 'tablero'; } 
                ?>
            </h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=premio">Premios</a></li>
                <li><a href="foros.php"> Foros</a></li>
                <li><a href="ofertas.php"> Ofertas</a></li>
            </ul>
        </div><!--/end container-->
    </div>
<!--=== End Breadcrumbs ===-->
<!--=== Profile ===-->
    <div class="container content profile">
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                
                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <li class="list-group-item">
                        <a href="usuarios.php"><i class="fa fa-user"></i> <?php if (empty($sihayempresaid)) echo 'Panel Usuario'; else echo 'Tablero'; ?></a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=empresa"><i class="fa fa-envelope"></i><?php if (empty($sihayempresaid)) echo 'Vincule su empresa'; else echo 'Edite su Empresa'; ?></a>
                    </li>
                    <!--
                    <li class="list-group-item">
                        <a href="usuarios.php?content=presupuestar"><i class="fa fa-cubes"></i> Presupuestar</a>
                    </li>
                    -->
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizacion"><i class="fa fa-cubes"></i> Cotizar</a>
                    </li>                                        
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-envelope"></i> Correo</a>
                    </li>
                    
                    <li  class="list-group-item">
                        <a href="usuarios.php?content=documentos"><i class="fa fa-file"></i>Documentos</a>
                    </li>                                                                                 
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ajustes"><i class="fa fa-cog"></i> Ajustes</a>
                    </li>                                                                     
                </ul>  
                <hr>

                <!--Notification-->   
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
                <!-- tab v1 -->
                    <div class="tab-v1">
                        <div class="tab-content">
                         <!-- Empieza subir portafolio  -->
                                <div class="row">
                                    <div class="alert alert-warning fade in">
                                        <?php 
                                                    if (isset($mensajeportafolio))
                                                    echo "<strong>$mensajeportafolio</strong>"; 
                                        ?>
                                                    
                                    </div>
                                    <div>
                                        <!-- subir el documento a la tabla de publicaciones -->
                                        <form class="sky-form" enctype="multipart/form-data" action="usuarios.php?content=documentos" method="post">
                                            <label class="label">Formato pdf y menos de 5000 Kbytes</label>
                                            <label class="label">Nombre su archivo asi: nombredelaempresa (sin espacios)</label>
                                            <label class="label">Solo suba documentos de interes a la comunidad</label>
                                            <label for="file" class="input input-file">
                                                <div class="button"><input type="file" name="presentacion" id="nombrePortafolio" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                            </label>
                                            <input type="hidden" name="empresaid" value="<?php echo $sihayempresaid; ?>" >
                                            <button type="submit" class="btn-u">Subir</button>
                                        </form>
                                    </div> <!-- end class alert -->
                                </div>
                            <!-- Termina subir portafolio -->
                        </div>
                    </div>
                <!-- End Profile Content -->            
                </div>
            </div>
        </div>
    </div>
    <!--=== End Profile ===-->
