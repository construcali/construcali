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
                        <a href="foros.php"><i class="fa fa-users"></i> Foros</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Mi Actividad</a>
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

                <div class="margin-bottom-50"></div>

                <!--Datepicker-->
                                
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->
            
            <!-- Profile Content -->
            <div class="col-md-9 mb-margin-bottom-30">
                <div class="profile-body">
                    <!--Service Block v3-->
                    <!--/end row-->
                    <!--End Service Block v3-->
                    <!-- Tab v1 -->                
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Premios</a></li>
                        <li><a href="#profile" data-toggle="tab">Tabla de Puntos</a></li>
                        
                    </ul>       
                    <div class="tab-content"> <!-- cotizar materiales -->
                        <div class="tab-pane fade in active" id="home">
                            <table class="table table-bordered table-striped">
                                <thead>
                                                        <tr>
                                                            <th class="hidden-sm">Premio</th>
                                                            <th>Puntos</th>
                                                            <th>Su Puntaje: <?php echo $points; ?> puntos</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="td-width">
                                                                <h3><a href="#">Pagina de internet</a></h3>
                                                                <a href="http://es.jimdo.com/#ref=a506034" target="_blank"><span>crear pagina web gratuita con Jimdo</span></a>
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline s-icons">
                                                                    <li>
                                                                        1000 puntos
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <a href="usuarios.php?content=premios&premioid=11"><span class="label label-success">Reclamar Premio</span></a>
                                                                
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h3><a href="#">250 Tarjetas de presentacion</a></h3>
                                                                
                                                                
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline s-icons">
                                                                    <li>
                                                                         2000 puntos
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <a href="usuarios.php?content=premios&premioid=12"><span class="label label-success">Reclamar Premio</span></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h3><a href="#">Filtracion de Listas</a></h3>
                                                                
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline s-icons">
                                                                    <li>
                                                                        3000 puntos
                                                                    </li>
                                                                </ul>
                                                                
                                                            </td>
                                                            <td>
                                                                <a href="usuarios.php?content=premios&premioid=13"><span class="label label-success">Reclamar Premio</span></a>
                                                                
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h3><a href="#">Su foto en nuestra pagina de Inicio</a></h3>
                                                                
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline s-icons">
                                                                    <li>
                                                                        4000 puntos
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                
                                                            </td>
                                                            <td>
                                                                <a href="usuarios.php?content=premios&premioid=14"><span class="label label-success">Reclamar Premio</span></a>
                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                           
                        </div>
                        <div class="tab-pane fade in" id="profile"> <!-- empieza el otro cuadro-->
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="hidden-sm">Actividad</th>
                                            <th>Puntos</th>
                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="td-width">
                                                                <h3><a href="#">Crear Catalogo</a></h3>
                                                                <p>Por cada foto que suba de sus productos o trabajos recibira 100 puntos. Puede subir hasta 8 fotos</p>
                                                                <small class="hex">Estas fotos sirven para crear su pagina de internet si asi lo quiere</small>
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline s-icons">
                                                                    <li>
                                                                        800 puntos
                                                                    </li>
                                                                </ul>
                                                                <span><a href="http://es.jimdo.com/#ref=a506034" target="_blank">crear pagina web gratuita con Jimdo</a></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h3><a href="#">Subir el logo de su Empresa</a></h3>
                                                                <p>Suba el logo de su Empresa en Formato png o jpg y en lo posible de 200pxls X 200 pxls</p>
                                                                <small class="hex">Subir ofertas tambien le otorga puntos</small>
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline s-icons">
                                                                    <li>
                                                                        500 puntos
                                                                    </li>
                                                                    
                                                                </ul>
                                                                <span><a href="http://es.jimdo.com/#ref=a506034" target="_blank">crear pagina web gratuita con Jimdo</a></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h3><a href="#">Responda cotizaciones</a></h3>
                                                                <p>Responder cotizaciones ademas de ganarle clientes le otorga 200 puntos</p>
                                                                <small class="hex">Tambien puede reclamar otros 200 puntos haciendo propuestas a otras empresas</small>
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline s-icons">
                                                                    <li>
                                                                        200 puntos
                                                                    </li>
                                                                </ul>
                                                                <span><a href="http://es.jimdo.com/#ref=a506034" target="_blank">crear pagina web gratuita con Jimdo</a></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h3><a href="#">Poner Clasificados</a></h3>
                                                                <p>Poner clasificados le otorga 100 puntos</p>
                                                                <small class="hex">Cada vez que contacta otra empresa se cuenta como una propuesta</small>
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline s-icons">
                                                                    <li>
                                                                        100 puntos
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <span><a href="http://es.jimdo.com/#ref=a506034" target="_blank">crear pagina web gratuita con Jimdo</a></span>
                                                            </td>
                                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div><!--/col-md-9-->
        </div>
    </div>      
    <!--=== End Profile ===-->