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
           
                <?php 
                    if (empty($logo))
                        echo "<img class=\"img-responsive md-margin-bottom-10\" src=\"assets/img/team/LogoCasco.png\" alt=\"Logo de la empresa\">";
                    else
                        echo "<img class=\"img-responsive md-margin-bottom-10\" src=\"logo/$logo\" alt=\"Logo de la empresa\">";
                ?>       

                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <li class="list-group-item">
                        <a href="usuarios.php"><i class="fa fa-bar-chart-o"></i> General</a>
                    </li>
                    <li class="list-group-item active">
                        <a href="usuarios.php?content=empresa"><i class="fa fa-user"></i> Empresa</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ofertas"><i class="fa fa-group"></i> Ofertas</a>
                    </li>                                        
                    <li class="list-group-item">
                        <a href="usuarios.php?content=actividades"><i class="fa fa-cubes"></i> Cotizaciones</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=informacion"><i class="fa fa-comments"></i> Informacion</a>
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
                        <img class="rounded-x" src="assets/img/testimonials/img6.jpg" alt="">
                        <div class="overflow-h">
                            <?php echo "<span><strong>$libnombre</strong> ha cotizado un nuevo trabajo.</span>"; ?>
                            <?php echo "<small>$libdia</small>"; ?>
                        </div>    
                    </li>
                <?php
                }
                ?>    
                </ul>    
                <button type="button" class="btn-u btn-u-default btn-u-sm btn-block">Ver Mas</button>
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
                <form enctype="multipart/form-data" action="usuarios.php?content=editarlogo" method="post" id="editarLogo" class="sky-form">
                    <header>Logo de su Empresa</header>
                    <h4>Ponga logos solo en formato jpg o png</h4>
                    <h4>Bajele el peso a los foto para que sea mas facil subirla</h4>
                    <h4>Por favor suba fotos que sean de 200pxls de ancho por 200 pxls de alto o menos</h4>
                        <?php
                            if (isset($mensaje))
                                echo $mensaje;
                        ?>
                    <section>
                        <label for="file" class="input input-file">
                            <div class="button"><input type="file" name="logo" multiple onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" placeholder="Incluya la foto de su logo" readonly>
                        </label>
                    </section>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000"></input>
                    <footer>
                        <button type="submit" class="btn-u">Subir Logo</button>
                    </footer>
                </form> 
            </div>
            <!-- End Profile Content -->
        </div>
    </div>      
    <!--=== End Profile ===-->