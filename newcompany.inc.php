<!-- Javascript : registrarEmpresa.js -->
<!-- vinculado en footer.html linea 210 -->
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
                    <li class="list-group-item"><a href="cotizaciones.php"><i class="fa fa-cubes"></i>Cotizaciones</a></li>
                    <?php
                        }else{
                    ?> 
                    <li class="list-group-item"><a href="usuarios.php?content=empresa"><i class="fa fa-pencil"></i>Vincule su Empresa</a></li>         
                    <?php 
                           }
                    ?>
                    <li class="list-group-item">
                        <a href="foros.php"><i class="fa fa-user"></i> Foros</a>
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

                

                <!--Datepicker-->
                
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->
            
            <!-- Empieza Vincular Empresa class=col-md-9  usa el javascript registrarEmpresa.js-->
            <div class="col-md-9">
                <form action="usuarios.php?content=empresa" method="post" id="registrarEmpresa" class="sky-form">
                    <header>Nueva Empresa
                    <?php
                        if (isset($mensaje_resultado))
                            echo $mensaje_resultado;
                    ?>
                    </header>
                    <fieldset>                  
                        <div class="row">
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-prepend fa fa-desktop"></i>
                                    <input type="text" name="empresa" id="empresa" placeholder="Nombre de la empresa">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-prepend fa fa-user"></i>
                                    <input type="text" name="nombre" id="nombre" placeholder="Nombre del contacto">
                                </label>
                            </section>
                        </div>
                        
                        <div class="row">
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-prepend fa fa-envelope"></i>
                                    <input type="email" name="email" id="email" placeholder="Correo electronico empresarial">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-prepend fa fa-phone"></i>
                                    <input type="tel" name="telefono" id="telefono" placeholder="Telefono">
                                </label>
                            </section>
                        </div>
                    </fieldset>
                    
                    <fieldset>

                        <div class="row">
                            <section class="col col-4">
                                <label class="select">
                                    <select name="provincia" id="departamento">
                                        <option>Selecione un Departamento</option>
                                    <?php
                                        foreach ($departamentos as $departamento) 
                                            {
                                                $indice = $departamento['productoid'];
                                                $provincia = $departamento['departamento'];
                                                //$provincia = htmlentities($provincia);    
                                                $deptArray[$indice] = $provincia;
                                            }   
                                        asort($deptArray);
                                        foreach ($deptArray as $llave => $actual){
                                        echo "<option value=\"$llave\">$actual</option>";
                                        } //closes for each
                                    ?>   
                                    </select>
                                    <i></i>
                                </label>
                            </section>
                            
                            <section class="col col-3">
                                        <label class="select">
                                            <select list="list" name="ciudad" id="ciudad" placeholder="ciudad">
                                                <?php
                                                        if (isset($ciudad)){
                                                    ?>
                                                        <option><?php echo $ciudad; ?></option>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <option>Selecione una Ciudad</option>
                                                    <?php
                                                        }
                                                    ?>

                                            </select>
                                        </label>
                            </section>
                            
                            <section class="col col-5">
                                <label class="select">
                                    <select name="categoria">
                                        <?php
                                            foreach ($categorias as $categoria)
                                            {
                                                $catid = $categoria['catid'];
                                                $category = $categoria['categoria'];
                                                $category = htmlentities($category);
                                                $catArray[$catid] = $category;    
                                            }
                                            asort($catArray);
                                            foreach ($catArray as $indicador => $valor){
                                            echo "<option value=\"$indicador\">$valor</option>";
                                        } //closes for each
                                        ?>
                                    </select>
                                    <i></i>
                                </label>
                            </section>
                        </div>

                        <section>
                            <label for="direcion" class="input">
                                <input type="text" name="direcion" id="direcion" placeholder="Direcion Ej: Calle 34 and Cra 22 - No ponga la ciudad">
                            </label>
                        </section>

                        <section>
                            <label for="url" class="input">
                                <input type="text" name="url" id="url" placeholder="Pagina de internet">
                            </label>
                        </section>
                        
                        <section>
                            <label class="textarea"><h4 id="errorServicios">Productos y/o Servicios que ofrece su Empresa</h4>
                                <textarea rows="3" name="servicio" id="servicio" placeholder="Servicios o Productos que ofrecen, un minimo de 100 caracteres"></textarea>
                                
                            </label>
                        </section>

                        <section>
                            <label class="textarea"><h4 id="errorMision">Mision y Vision de su Empresa, un minimo de 50 caracteres</h4>
                                <textarea rows="3" name="mision" id="mision" placeholder="Mision y Vision de su empresa, un minimo de 100 caracteres"></textarea>
                            </label>
                        </section>
                    </fieldset>
                    
                    <footer>
                        <button type="submit" class="btn-u">Registrar Empresa</button>
                    </footer>
                </form> 
            </div>
            <!-- Termina Vncular Empresa -->
        </div>
    </div>      
    <!--=== End Profile ===-->