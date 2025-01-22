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
                <!-- <img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/LogoCasco.png" alt=""> imagen anterior img1-md.jpg -->
                <h4><?php 
                        if (isset($nombreUsuario)){
                            echo 'Bienvenido '.$nombreUsuario;
                    }
                    ?>
                </h4>
                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <?php
                    if (!empty($sihayempresaid)){
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php?content=correo\"><i class=\"fa fa-envelope\"></i>Correo</a></li>";
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php?content=empresa\"><i class=\"fa fa-user\"></i>Empresa</a></li>";
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php?content=premio\"><i class=\"fa fa-briefcase\"></i>Premios</a></li>";
                           }else{
                    ?>         
                    <li class="list-group-item">
                    <?php 
                        echo "<a href=\"usuarios.php?content=empresa\"><i class=\"fa fa-user\"></i>Vincule su Empresa</a>";
                        }
                     ?>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=presupuestar"><i class="fa fa-cubes"></i> Presupuestar</a>
                    </li>                                       
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-cubes"></i> Cotizaciones</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=actividades"><i class="fa fa-file"></i> Anuncios</a>
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
                        <li class="active"><a href="#home" data-toggle="tab">Categorias</a></li>
                        <li><a href="analisis.php?content=lista">Ver Lista</a></li>
                        <li><a href="analisis.php?content=factura&boton=editar">Editar Factura</a></li>
                    </ul>                
                    <div class="tab-content"> <!-- Empieza categoria de presupuestar -->
                        <div class="tab-pane fade in active" id="home">
                            <div class="row job-content">
                                <div class="col-md-12">
                                        <!-- Aqui empiezan los materiales -->
                                   
                            <!--Invoice Table-->
                                    <div class="panel panel-default margin-bottom-40">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Precios de Materiales de Construccion en Colombia</h3>
                                        </div>
                                        <div class="panel-body">
                                            <p>Estos son precios de materiales de construccion para tomarlos como referencia. Colconstruccion.com no se hace responsable por ninguno de los precios aqui mencionados.<?php if (isset($mensaje)) echo $mensaje; ?></p>
                                        </div>
                                        <table class="table table-striped invoice-table">
                                            <tbody>
                                                <tr>
                                                <?php
                                                    $i=0;  
                                                    foreach ($categorias as $catid => $categoria) {
                                                    echo "<td><a href=\"analisis.php?content=articulos&id=$catid\">$categoria</a></td>";
                                                    if ($i==2 || $i==5 || $i==8 || $i==11){
                                                        echo "</tr><tr>";
                                                    }
                                                    $i=$i+1;
                                                    }
                                                ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Aqui terminan los materiales -->        
                                </div>
                                <!-- Productos en demanda -->
                            </div>
                        </div> <!-- Termina Categorias del presupuesto -->
                    </div>
                </div>
                <!-- End Tab v1 -->
                </div>
            </div>
            <!-- End Profile Content -->            
        </div>
    </div><!--/container-->    
    <!--=== End Profile ===-->