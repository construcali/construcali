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
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Mis Cotizaciones</a>
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
            <div class="col-md-9">
                <div class="profile-body margin-bottom-20">
                    <div class="tab-v1">
                        <ul class="nav nav-justified nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#perfil">Editar Perfil</a></li>
                            <li><a data-toggle="tab" href="#passwordTab">Cambiar Clave</a></li>
                            
                        </ul>          
                        <div class="tab-content">
                            <div id="perfil" class="profile-edit tab-pane fade in active">
                                <div class="row margin-bottom-40">
                                    <div class="col-md-6">
                                        <!-- Reg-Form -->
                                        <form action="usuarios.php?content=cambiarinfo" class="sky-form" id="cambiarInfo">
                                            <header id="infoCambiar">Cuenta: Cambie su informacion</header>
                                            
                                            <fieldset>

                                                <section>
                                                    <label class="input">
                                                        <i class="icon-append fa fa-envelope"></i>
                                                        <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                                                        <b class="tooltip tooltip-bottom-right">Necesario para verificar su cuenta</b>
                                                    </label>
                                                </section>

                                                <section>
                                                    <label class="input">
                                                        <i class="icon-append fa fa-phone"></i>
                                                        <input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
                                                        <b class="tooltip tooltip-bottom-right">Cambie su numero telefonico</b>
                                                    </label>
                                                </section>
                                                
                                            </fieldset>
                                                
                                            <fieldset>
                                                <div class="row">
                                                    <section class="col col-6">
                                                        <label class="input">
                                                            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                                                        </label>
                                                    </section>
                                                    <section class="col col-6">
                                                        <label class="input">
                                                            <input type="text" name="apellido" id="apellido" value="<?php echo $apellidos; ?>">
                                                        </label>
                                                    </section>
                                                </div>

                                                <section>
                                                    <label class="label">Departamento</label>
                                                        <label class="input" for="departamento">
                                                            <select class="form-control rounded-0" name="departamento" id="departamento">
                                                        <?php
                                                            foreach ($departamentos as $departamento) 
                                                                {
                                                                    $indice = $departamento['productoid'];
                                                                    $provincia = $departamento['departamento'];    
                                                                    $deptArray[$indice] = $provincia;
                                                                }   
                                                            asort($deptArray);
                                                            foreach ($deptArray as $llave => $actual){
                                                            if($llave == $departamentoid){
                                                                echo "<option value=\"$llave\" selected>$actual</option>";
                                                                }else{
                                                                echo "<option value=\"$llave\">$actual</option>";
                                                                }
                                                            } //closes for each
                                                        ?>   
                                                        
                                                            </select>
                                                        </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label">Ciudad</label>
                                                        <label class="input">
                                                            <input type="text" list="list" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>">
                                                            <datalist id="list">
                                                                <option value="Leticia"></option>
                                                                <option value="Medellin"></option>
                                                                <option value="Arauca"></option>
                                                                <option value="Barranquilla"></option>
                                                                <option value="Cartagena"></option>
                                                                <option value="Tunja"></option>
                                                                <option value="Manizales"></option>
                                                                <option value="Florencia"></option>
                                                                <option value="Yopal"></option>
                                                                <option value="Popayan"></option>
                                                                <option value="Valledupar"></option>
                                                                <option value="Quibdo"></option>
                                                                <option value="Monteria"></option>
                                                                <option value="Bogota"></option>
                                                                <option value="Puerto Inirida"></option>
                                                                <option value="San Jose del Guaviare"></option>
                                                                <option value="Neiva"></option>
                                                                <option value="Riohacha"></option>
                                                                <option value="Santa Marta"></option>
                                                                <option value="Villavicencio"></option>
                                                                <option value="Pasto"></option>
                                                                <option value="Cucuta"></option>
                                                                <option value="Mocoa"></option>
                                                                <option value="Armenia"></option>
                                                                <option value="Pereira"></option>
                                                                <option value="San Andres"></option>
                                                                <option value="Bucaramanga"></option>
                                                                <option value="Sincelejo"></option>
                                                                <option value="Ibague"></option>
                                                                <option value="Cali"></option>
                                                                <option value="Mitu"></option>
                                                                <option value="Puerto Carre&ntilde;o"></option>
                                                            </datalist>
                                                        </label>
                                                </section>
                                                
                                            </fieldset>
                                            <footer>
                                                <button type="submit" class="btn-u">Guardar</button>
                                            </footer>
                                        </form>         
                                        <!-- End Reg-Form -->
                                    </div>
                                    <!-- Foto de Perfil -->
                                    <div class="col-md-6">
                                        <?php if (isset($mensaje)) echo $mensaje; ?>
                                        <form enctype="multipart/form-data" action="subirfotoperfil.php" method="post" id="editarFotoPerfil" class="sky-form">
                                            <img src="http://construcali.com/empresas/images/ajax-loader.gif" id="cargando-img" style="display:none;" alt="Porfavor espere"/>
                                            <header id="infoCambiar">Foto de Usuario/Usuaria</header>
                                            <img class="img-responsive md-margin-bottom-10" src="<?php echo $imgsrc; ?>" alt="Foto de Perfil" id="fotoDePerfil">

                                            <section>
                                                    <label for="file" class="input input-file">
                                                        <div class="button"><input type="file" name="fotoperfil" id="fotoperfil" multiple onchange="this.parentNode.nextSibling.value = this.value">Buscar Foto</div><input type="text" placeholder="Incluya su Foto" readonly>
                                                    </label>
                                            </section>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000"></input>
                                            <input type="hidden" name="usuarioid" id="usuarioid" value="<?php echo $usuarioid; ?>"></input>
                                            <input type="submit" class="btn-u" id="submit-Foto" value="Subir Foto"></input>
                                            <?php
                                                if (strstr($imgsrc, 'fotosperfiles')){
                                            ?>
                                            <button class="btn-u" id="borrarFotoPerfil">Borrar Foto</button>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                        <div id="estaFotoPerfil">
                                        </div>
                                    </div>
                                    <!-- Termina foto de perfil -->
                                </div><!--/end row-->
                            </div>
                            <!-- termina perfil -->
                            <!-- Empieza clave -->
                            <div id="passwordTab" class="profile-edit tab-pane fade">
                                <div class="row margin-bottom-40">
                                    <div class="col-md-6">
                                        <form action="#" id="cambiarClave" class="sky-form">
                                                <header id="claveCambiar">Nueva Clave</header>
                                                <!-- js esta en editarUsuarioInfo.js -->
                                                <fieldset>                  
                                                    <section>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-lock"></i>
                                                            <input type="password" name="password" id="password" placeholder="Nueva clave" id="password">
                                                            <b class="tooltip tooltip-bottom-right">Nueva Clave</b>
                                                        </label>
                                                    </section>
                                                    
                                                    <section>
                                                        <label class="input">
                                                            <i class="icon-append fa fa-lock"></i>
                                                            <input type="password" name="repetida" id="repetida" placeholder="Confirme la nueva clave">
                                                            <b class="tooltip tooltip-bottom-right">Escriba la nueva clave de nuevo</b>
                                                        </label>
                                                    </section>
                                                    
                                                </fieldset>
                                                <footer>
                                                    <button type="submit" class="btn-u">Cambiar Clave</button>
                                                </footer>
                                        </form>                
                                    </div>
                                </div>
                            </div>
                            <!-- Termina clave -->
                        </div> <!-- termina tab-content -->
                    </div><!-- Termina tab-v1 -->
                </div><!-- Termina class-profile -->
            </div>
        </div>
    </div>