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
                        <a href="usuarios.php?content=premio"><i class="fa fa-file"></i>Premios</a>
                    </li>                                                                                 
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ajustes"><i class="fa fa-cog"></i> Ajustes</a>
                    </li>   
                </ul>  
                <hr>

                <!--Notification-->
               
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
            <div class="col-md-9 mb-margin-bottom-30">
                <div class="headline"><h2>Ha solicitado <?php echo $subject; ?> exitosamente!</h2></div>
                <p>Su nuevo puntaje es <?php echo $newpoints; ?>. Usaremos la informacion provista en su perfil empresarial para hacer la pagina de internet, para hacer sus tarjetas de presentacion y enviarselas, para publicar su publicidad en la pagina y si tiene una lista que filtrar por favor enviela en formato excel a publicidad@construcali.com</p>
                <p>
                Use el formulario aqui abajo para suministrar cualquier otra informacion que considere pertinente respecto a su premio o si en cambio le gustaria un premio diferente, le contactaremos si es necesario, muchas gracias.     
                </p>
                <br />

                <form action="usuarios.php?content=contactar" method="post" class="sky-form contact-style">
                    <fieldset class="no-padding">
                        <label>Titulo del Mensaje <span class="color-red">*</span></label>
                        <div class="row sky-space-20">
                            <div class="col-md-7 col-md-offset-0">
                                <div>
                                    <input type="text" name="titulo" id="titulo" placeholder="<?php echo $subject; ?>" class="form-control">
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
                        
                        <p><button type="submit" class="btn-u">Enviar Mensaje</button></p>
                    </fieldset>

                    <div>
                        <?php
                            if (isset($aviso))
                                echo $aviso;
                        ?>
                    </div>
                </form>
            </div><!--/col-md-9-->
        </div>
    </div>      
    <!--=== End Profile ===-->