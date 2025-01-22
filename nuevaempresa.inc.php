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
                        echo "<img class=\"img-responsive md-margin-bottom-10\" src=\"assets/img/logocolconstruccion.png\" alt=\"Logo de la empresa\">";
                    else
                        echo "<img class=\"img-responsive md-margin-bottom-10\" src=\"logo/$logo\" alt=\"Logo de la empresa\">";
                ?>       

                <div class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                   <h2>Si ya ha vinculado su empresa o tiene una cuenta de usuario por favor <a href="usuarios.php">acceda</a> como usuario y luego vincula su empresa</h2>
                </div>   
                <hr>

                <!--Notification-->
                <div class="panel-heading-v2 overflow-h">
                   <!--  <h2 class="heading-xs pull-left"><i class="fa fa-bell-o"></i>Descargas</h2> -->
                </div>
                <ul class="list-unstyled mCustomScrollbar margin-bottom-20" data-mcs-theme="minimal-dark">
                    <!-- <li><a href="<?php echo $descargue; ?>">Curso de Costos y Presupuestos</a></li> -->
                    <!-- <li>con 2000 puntos reclama un aviso aqui</li> -->
                </ul>    
                
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
                <form action="index.php?content=nuevaempresa" method="post" id="nuevaEmpresa" class="sky-form">
                    <header>Nueva Empresa</header>
                    <div class="note">
                    <?php
                        if (isset($mensaje))
                            echo $mensaje;
                    ?>
                    </div>
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
                                    <select name="provincia">
                                    <?php
                                        foreach ($departamentos as $departamento) 
                                            {
                                                $indice = $departamento['productoid'];
                                                $provincia = $departamento['departamento'];    
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
                                        <label class="input">
                                            <input type="text" list="list" name="ciudad" id="ciudad" placeholder="ciudad">

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
                            <label class="textarea">
                                <h4 id="errorServicios">Productos y/o Servicios que ofrece su Empresa</h4>
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
                        <button type="submit" class="btn-u">Vincular Empresa</button>
                    </footer>
                </form> 
            </div>
            <!-- End Profile Content -->
        </div>
    </div>      
    <!--=== End Profile ===-->