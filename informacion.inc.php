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
                    <li class="list-group-item">
                        <a href="usuarios.php?content=empresa"><i class="fa fa-user"></i> Empresa</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ofertas"><i class="fa fa-group"></i> Ofertas</a>
                    </li>                                        
                    <li class="list-group-item">
                        <a href="usuarios.php?content=actividades"><i class="fa fa-cubes"></i> Cotizaciones</a>
                    </li>
                    <li class="list-group-item active">
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
                       
                    <div class="panel panel-green margin-bottom-40">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-tasks"></i> Precios de Referencia</h3>
                        </div>
                        <div class="panel-body">
                            <p>Estos son algunos de los precios ingresados recientemente a nuestra base de datos. Estos precios no compromete en forma a alguna a ninguna de nuestras empresas afiliadas o a colconstruccion.com.</p>
                        </div>                                      
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th class="hidden-sm">Unidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($insumos as $insumo) {
                                $respuestaid = $insumo['respuestaid'];
                                $nombre = $insumo['nombre'];
                                $nombre = nl2br($nombre);
                                $precio = $insumo['precio'];
                                if (empty($precio))
                                    $precio = 'precio';
                                $precio = number_format($precio, 2, '.', ',');         
                                $cantidad = $insumo['cantidad'];
                                $unidad = $insumo['unidades'];
                                //$unidades = explode(" ",$cantidad);
                                //$unidad = trim($unidad);
                                //$unidad = strval($unidad);
                                if(empty($unidad))
                                    $unidad = 'unidad';
                                //$date = $insumo['fecha'];
                                $date = $main->con_casilla(date,cotizaciones_respuestas,respuestaid,$respuestaid);

                                $fecha = $main->formatear_fecha($date);
                            ?>
                                <tr>
                                    <td><?php echo $nombre; ?></td>
                                    <td class="hidden-sm"><?php echo $unidad; ?></td>
                                    <td><?php echo "$".$precio; ?></td>
                                    <td><span class="label label-warning"><?php echo $fecha; ?></span></td>                          
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Pegination Centered-->
                    <div class="tag-box tag-box-v7 text-justify"> 
                        <div class="text-center">
                            <ul class="pagination">
                            <?php
                             if ($thispage > 1)
                                {
                                    $page = $thispage - 1 ;
                                    $prevpage = "<li class=\"active\"><a href=\"usuarios.php?content=informacion&page=$page\">Anterior</a></li>";
                                }
                                else
                                {
                                    $prevpage = "<li><a href=\"#\">Anterior</a></li>";
                                }
                                
                            if ($totpages >1)
                                {
                                    $bar = '';
                                    for($page = 1; $page <= $totpages; $page++)
                                    {
                                        if ($page == $thispage)
                                        {
                                            $bar .= "<li><a href=\"#\">$page</a></li>";
                                        }
                                        else
                                        {
                                            $bar .= "<li><a href=\"usuarios.php?content=informacion&page=$page\">$page</a></li>";
                                        }
                                    }
                                }
                                
                            if ($thispage < $totpages)
                             {
                                $page = $thispage + 1;
                                $nextpage = "<li><a href=\"usuarios.php?content=informacion&page=$page\">Proxima</a></li>"; 
                             }else
                             {
                                $nextpage = "<li><a>Proxima</a></li>";
                             }
                                echo $prevpage . $bar . $nextpage;
                            ?>
                            </ul>                                                            
                        </div>
                    </div>
                    <!--End Pegination Centered-->
                </div>
            </div>
            <!-- End Profile Content -->                
        </div>
    </div>      
    <!--=== End Profile ===-->