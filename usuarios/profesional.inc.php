    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Tablero</h1>
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
                <!-- <img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/LogoCasco.png" alt=""> imagen anterior img1-md.jpg -->
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
                    <li  class="list-group-item">
                        <a href="usuarios.php?content=productos"><i class="fa fa-file"></i>Anunciar</a>
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
                        <a href="usuarios.php?content=correo"><i class="fa fa-envelope"></i> Correo</a>
                    </li>                                         
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Actividad</a>
                    </li>
                    <li  class="list-group-item">
                        <a href="usuarios.php?content=premio"><i class="fa fa-file"></i>Premios <?php if (isset($points))echo ' ('.$points.')'; ?></a>
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
                    <?php  if (isset($mensaje)) echo $mensaje; ?>
                    <!-- Tab v1 -->                
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#editarCurriculum" data-toggle="tab">Editar Curriculum</a></li>
                        <li><a href="#curriculum" data-toggle="tab">Curriculum Profesional</a></li>
                    </ul>                
                    <div class="tab-content"> 
                        <div class="tab-pane fade in active" id="editarCurriculum"> <!-- Anunciar productos -->
                             <div class="row">
                             <form class="sky-form" method="post" action="usuarios.php?content=profesional" enctype="multipart/form-data" id="profesional">
                             <div class="col-md-12">
                                <div class="col-md-7">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="titulo" placeholder="Describa su Profesion" value="<?php echo $titulo; ?>" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-5">
                                    <section>
                                        <label class="label">Categoria</label>
                                        <label class="select">
                                            <select name="categoria">
                                            <?php
                                                foreach ($categorias as $categoria) {
                                                    $catid = $categoria['catid'];
                                                    $clase = $categoria['categoria'];
                                                    echo "<option value=\"$catid\">$clase</option>";
                                                }
                                            ?>
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>                              
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Curriculum Vitale (pdf)</label>
                                            <label for="file" class="input input-file">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
                                            <div class="button"><input type="file" id="file" name="presentacion" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                        </label>
                                    </section>     
                                    
                                    <div>
                                    <button type="submit" class="btn-u" id="botonPublicarPerfil"><?php echo $status; ?></button>
                                    </div>
                                </div>
                            </div>
                            </form>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="curriculum"> <!-- Anunciar Servicios -->
                            <div class="row">
                                <div class="col-md-12">
                                <h2><strong>Nombre:</strong>  <?php echo $nombre_profesional; ?></h2>
                                
                                <span><strong>Profesion:</strong> <?php echo $titulo; ?></span>
                                <span><strong>Categoria:</strong> <?php echo $categoria_profesional; ?></span>

                                <hr>
                                <p> <?php echo $estado; ?><a href="<?php echo $url_curriculum; ?>" target="_blank"> Curriculum Vitale (pdf) </a></p>
                                
                            </div>
                            </div>
                        </div>
                        <!-- Hacer Oferta -->
                        
                    </div>
                </div>
                <!-- End Tab v1 -->
                </div>
            </div>
            <!-- End Profile Content -->            
        </div>
    </div><!--/container-->    
    <!--=== End Profile ===-->