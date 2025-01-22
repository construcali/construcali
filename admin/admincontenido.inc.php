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
                    <li class="list-group-item active">
                        <a href="usuarios.php"><i class="fa fa-bar-chart-o"></i> Panel Usuario</a>
                    </li>
                    <li class="list-group-item">
                        <a href="administrador.php?content=correo"><i class="fa fa-user"></i> Correo</a>
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
                    <!--Service Block v3-->
                    <!--/end row-->
                    <!--End Service Block v3-->
                    <!-- Tab v1 -->                
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Estadistica General</a></li>
                        <li><a href="#profile" data-toggle="tab">Estadistica Empresas</a></li>
                        <li><a href="#messages" data-toggle="tab">Top 40 Empresas</a></li>
                        <li><a href="#settings" data-toggle="tab">Top 40 Empresas (puntos y alfabetico)</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <div class="row">
                            <div class="col-md-12">
                            <?php
                            echo "<h2>Estadistica de Ordenes</h2>\n";
                            echo "<table class=\"table table-hover\">\n";
                            echo "<tr><td><a href=\"http://www.construcali.com/admin/admin.php?content=showordenes\"> # Listas Hechas</a></td><td>$totordenes</td></tr>\n";
                            echo "<tr><td><a href=\"http://www.construcali.com/admin/admin.php?content=showcotizaciones\">Cotizaciones Enviadas</a></td><td>$totprecios</td></tr>\n";
                            echo "<tr><td><a href=\"http://www.construcali.com/admin/admin.php?content=showpedidos\">Servicios Pedidos</a></td><td>$totsinprecios</td></tr>\n";
                            echo "<tr><td><a href=\"admin.php?content=showclasificados\">Clasificados en Productos</a></td><td>$totanuncios</td></tr>\n";
                            echo "<tr><td><a href=\"admin.php?content=showclasificados\">Clasificados en Servicios</a></td><td>$totanouncements</td></tr>\n";
                            echo "<tr><td><a href=\"admin?content=cotizaciones_respuestas\">Respuestas a Cotizaciones</a></td><td>$totsinrespuestas</td></tr>\n";
                            echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=showusuarios\"># Usuarios</a></td><td>$totusuarios</td></tr>\n";
                            echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=showsubscritores\"># Subscritores</a></td><td>$totsubscriptores</td></tr>\n";
                            echo "</table>\n";
                            ?>
                            </div>
                            
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="profile">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    echo "<table class=\"table table-hover\">\n";
                                    echo "<tr><td><a href=\"admin.php?content=verpuntos\"># Empresas con Puntos</a></td><td>$totsinpuntajes</td></tr>\n";
                                    
                                    echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=showcompanies\"># Empresa Registradas</a></td><td>$totcompanies</td></tr>\n";
                                    echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=showcompaniaslogos\"># Empresas con Logo</a></td><td>$totlogos</td></tr>\n";
                                    echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=showcompaniascatalogos\"># Empresas con Catalogos</a></td><td>$numero</td></tr>";
                                    echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=showempresasint\"># Empresas Internacionales</a></td><td>$totinternacionales</td></tr>\n";
                                    echo "<tr><td><a href=\"http://www.construcali.com/admin/admin.php?content=showanouncements\"># Anuncios para boletin</a></td><td>$totboletines</td></tr>\n";
                                    echo "<tr><td><a href=\"http://www.construcali.com/admin/admin.php?content=showportafolios\"># Portafolios</a></td><td>$totportafolios</td></tr>\n";
                                    echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=showpaginas\"># Paginas de Internet</a></td><td>$totpaginas</td></tr>\n";
                                    echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=verprospectaspaginas\"># Empresas sin pagina</a></td><td>$totsinpaginas</td></tr>\n";
                                    echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=showprospectos\"># Empresas Prospectas</a></td><td>$totcatalogos</td></tr>\n";
                                    echo "<tr><td><a href=\"http://construcali.com/admin/admin.php?content=verpuntosurl\"># Empresas con Puntos en Orden</a></td><td>$totcatalogos</td></tr>\n";
                                    echo "</table>\n";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="messages">
                             <div class="row">
                                <div class="col-md-12">
                                <table class="table table-hover">
                                <tr><td>Empresa</td><td>puntaje</td><td>Email</td><td>Pagina web</td></tr>
                                <?php
                                    
                                    foreach ($empresaNombres as $empresaid => $empresa)
                                    {
                                        $puntaje = $main->puntaje_total($empresaid);
                                        $email_empresa = $main->con_casilla(email,companies,empresaid,$empresaid);
                                        $url_empresa = $main->con_casilla(url,companies,empresaid,$empresaid);
                                        $descripcion = $main->con_casilla(descripcion,prospectos,empresaid,$empresaid);
                                        echo "<tr><td><a href=\"http://construcali.com/empresas.php?content=estaempresa&id=$empresaid\" target=\"_blank\">$empresa</td><td><a href=\"admin.php?content=puntajeporempresa&amp;id=$empresaid\">$puntaje</a></td>
    <td><a href=\"http://construcali.com/empresas/index.php?content=verempresa&id=$empresaid\" target=\"_blank\">$email_empresa</td><td><a href=\"$url_empresa\" target=\"_blank\">pagina<a/></td></tr>";
    echo "<tr><td>$descripcion</td><td><a href=\"/admin/admin.php?content=updateproveedor&id=$empresaid\">Evaluar</a></td></tr>";
                                    }
                                ?>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="settings">
                            <div class="row">
                                <div class="col-md-12">
                                <table class="table table-hover">
                                <tr><td>Empresa</td><td>puntaje</td><td>Email</td><td>Pagina web</td></tr>
                                <?php
                                    asort($empresaNombres);
                                    foreach ($empresaNombres as $empresaid => $empresa)
                                    {
                                        $puntaje = $main->puntaje_total($empresaid);
                                        $email_empresa = $main->con_casilla(email,companies,empresaid,$empresaid);
                                        $url_empresa = $main->con_casilla(url,companies,empresaid,$empresaid);
                                        $descripcion = $main->con_casilla(descripcion,prospectos,empresaid,$empresaid);
                                        echo "<tr><td><a href=\"http://construcali.com/empresas.php?content=estaempresa&id=$empresaid\" target=\"_blank\">$empresa</td><td><a href=\"admin.php?content=puntajeporempresa&amp;id=$empresaid\">$puntaje</a></td>
    <td><a href=\"http://construcali.com/empresas/index.php?content=verempresa&id=$empresaid\" target=\"_blank\">$email_empresa</td><td><a href=\"$url_empresa\" target=\"_blank\">pagina<a/></td></tr>";
    echo "<tr><td>$descripcion</td><td><a href=\"/admin/admin.php?content=updateproveedor&id=$empresaid\">Evaluar</a></td></tr>";
                                    }
                                ?>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab v1 -->

                    <hr>

                    <div class="row margin-bottom-20">
                        <!--Profile Post-->
                        <div class="col-sm-6">
                            <div class="panel panel-profile no-bg">
                                <div class="panel-heading overflow-h">
                                    <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i>Notificaciones Generales</h2>
                                    <a href="#"><i class="fa fa-cog pull-right"></i></a>
                                </div>
                                <div id="scrollbar" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
                                    <div class="profile-post color-one">
                                        <span class="profile-post-numb">01</span>
                                        <div class="profile-post-in">
                                            <h3 class="heading-xs"><?php echo "<a href=\"empresas.php?content=estaempresa&id=$empresaid_pagina\" target=\"_blank\">$empresa_pagina</a></h3>"; ?>
                                            <p>Ha creado una pagina de internet a trav&eacute;s de nuestro directorio</p>
                                        </div>
                                    </div>
                                    <div class="profile-post color-two">
                                        <span class="profile-post-numb">02</span>
                                        <div class="profile-post-in">
                                            <h3 class="heading-xs"><?php echo "<a href=\"empresas.php?content=estaempresa&id=$companyid\">$company</a></h3>"; ?>
                                            <p>Se ha incorporado al directorio</p>
                                        </div>
                                    </div>
                                    <div class="profile-post color-three">
                                        <span class="profile-post-numb">03</span>
                                        <div class="profile-post-in">
                                            <h3 class="heading-xs"><?php echo "<a href=\"empresas.php?content=estaempresa&id=$factoriaid\">$factoria</a></h3>"; ?>
                                            <p>Ha subido un logo a su pagina</p>
                                        </div>
                                    </div>
                                    <div class="profile-post color-four">
                                        <span class="profile-post-numb">04</span>
                                        <div class="profile-post-in">
                                            <h3 class="heading-xs"><?php echo "<a href=\"empresas.php?content=estaempresa&id=$factoryid\">$factory</a></h3>"; ?>
                                            <p>Ha creado un catalogo</p>
                                        </div>
                                    </div>
                                    <div class="profile-post color-five">
                                        <span class="profile-post-numb">05</span>
                                        <div class="profile-post-in">
                                            <h3 class="heading-xs"><?php echo "<a href=\"anuncios.php?content=unservicio&id=$serviceid\">$encabezado</a></h3>"; ?>
                                            <p>Anuncio publicado el<?php echo $calendarday; ?></p>
                                        </div>
                                    </div>
                                    <div class="profile-post color-six">
                                        <span class="profile-post-numb">06</span>
                                        <div class="profile-post-in">
                                            <h3 class="heading-xs"><?php echo "<a href=\"anuncios.php?content=unproducto&id=$productoid\">$enunciado</a></h3>"; ?>
                                            <p>Clasificado puesto el <?php echo $diacalendario; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                        <!--End Profile Post-->

                        <!--Profile Event-->
                        <div class="col-sm-6 md-margin-bottom-20">
                            <div class="panel panel-profile no-bg">
                                <div class="panel-heading overflow-h">
                                    <h2 class="panel-title heading-sm pull-left"><i class="fa fa-briefcase"></i>Ultimos Portafolios</h2>
                                    <a href="#"><i class="fa fa-cog pull-right"></i></a>
                                </div>
                                <div id="scrollbar2" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
                                <?php 
                                    foreach ($portafolios as $portafolio) {
                                        $catid = $portafolio['catid'];
                                        $url = $portafolio['url'];
                                        $portatitulo = $portafolio['nombre'];
                                        $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
                                ?>
                                    <div class="profile-event">
                                        <div class="overflow-h">
                                           <?php 
                                            echo "<h3 class=\"heading-xs\"><a href=\"$url\" target=\"_blank\">$portatitulo</a></h3>"; 
                                            echo "<p>Portafolio en la categoria de $categoria</p>";
                                           ?>
                                        </div>    
                                    </div>
                                <?php
                                }
                                ?>           
                                </div>    
                            </div>
                        </div>
                        <!--End Profile Event-->
                    </div><!--/end row-->

                    <hr>
                    
                    <!--Profile Blog-->
                    <div class="panel panel-profile">
                        <div class="panel-heading overflow-h">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-tasks"></i>Ofertas Recientes</h2>
                            <a href="usuarios.php?content=ofertas" class="btn-u btn-brd btn-brd-hover btn-u-dark btn-u-xs pull-right">Ver Todas</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                            <?php foreach ($ofertas as $oferta) {
                                $estudianteid = $oferta['empresaid'];
                                $notaid = $oferta['productoid'];
                                $notas = $oferta['descripcion'];
                                $estudiante = $oferta['titulo'];
                                $salon = $oferta['categoria'];
                                $puesto = $oferta['url'];
                                $puesto = nl2br($puesto);    
                                $notas = substr($notas,0,100);
                                $notas = trim($notas);
                                $notas = nl2br($notas); 
                            ?>
                                <div class="col-sm-6">
                                    <div class="profile-blog blog-border">
                                        <?php echo "<img class=\"rounded-x\" src=\"$puesto\" alt=\"foto de oferta\">"; ?>
                                        <div class="name-location">
                                            <strong><?php echo "<a href=\"empresas.php?content=estaempresa&id=$estudianteid\">$estudiante</a>"; ?></strong>
                                            <span><i class="fa fa-briefcase"></i><?php echo $salon; ?></span>
                                        </div>
                                        <div class="clearfix margin-bottom-20"></div>    
                                        <p><?php echo $notas.'...'; ?></p>
                                        <hr>
                                    </div>
                                </div>        
                            <?php
                            }
                            ?>
                            </div>
                        </div>        
                    </div>
                    <!--End Profile Blog-->

                   
                        <!--Alert-->
                        
                        <!--End Alert-->
                        
                    <!--/end row-->        

                    <hr>

                    <!--Table Search v1-->
                    
                    <!--End Table Search v1-->

                    <!-- Begin Table Search v2 -->
                   
                    <!-- End Table Search v2 -->
                </div>
            </div>
            <!-- End Profile Content -->            
        </div>
    </div><!--/container-->    
    <!--=== End Profile ===-->