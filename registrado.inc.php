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
                echo "<img class=\"img-responsive md-margin-bottom-10\" src=\"assets/img/team/LogoCasco.png\" alt=\"Logo de la empresa\">";
                   
                ?>   
                <hr>

                <!--Notification-->
               
                <!--End Notification-->

                <div class="margin-bottom-50"></div>

                <!--Datepicker-->
                
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->
            
            <!-- Profile Content -->
            <div class="col-md-9">
                 <!-- Reg-Form -->
                    <h2> Hola <?php echo $_COOKIE['name']; ?>, puede usar el formulario para vincular su empresa y activar su cuenta o vaya a su  <a href="https://<?php echo $domain; ?>">cuenta de email</a> y active su cuenta</h2>

                    <!-- Poner un formulario para vincular una empresa y poner un boton para continuar como usuario y validarse como usuario legitimo -->  
            </div>
             <!-- End Profile Content -->
            
            <!-- Formulario de Vincular Empresa -->
            <div class="col-md-9">
                <form action="inicio.php?content=nuevaempresa" method="post" id="registrarEmpresa" class="sky-form">
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
                                    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                                </label>
                            </section>
                        </div>
                        
                        <div class="row">
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-prepend fa fa-envelope"></i>
                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>">
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
                            <section class="col col-5">
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
                            
                            <section class="col col-4">
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
                                Servicios o Productos que su Empresa ofrece, un minimo 100 caracteres.
                                <textarea rows="3" name="servicio" id="servicio" placeholder="Servicios o Productos que ofrecen, un minimo de 100 caracteres"></textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'servicio' );
                                </script>
                            </label>
                        </section>

                        <section>
                            <label class="textarea">Mision y Vision de su Empresa, un minimo de 100 caracteres.
                                <textarea rows="3" name="mision" id="mision" placeholder="Mision y Vision de su empresa, un minimo de 100 caracteres"></textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'mision' );
                                </script>
                            </label>
                        </section>
                    </fieldset>
                    
                    <footer>
                        <!-- Aqui va la clave -->
                        <input type="hidden" name="llavedigital" value="<?php echo $password; ?>">
                        <!-- Aqui va el nombre del usuario o la usuaria -->
                        <input type="hidden" name="nombreusuario" value="<?php echo $nombre; ?>">
                         <!-- Aqui va el apellido del usuario o la usuaria -->
                        <input type="hidden" name="apellidousuario" value="<?php echo $apellidos; ?>">
                         <!-- Aqui va el email del usuario o la usuaria -->
                         <input type="hidden" name="emailusuario" value="<?php echo $email; ?>">
                        <button type="submit" class="btn-u">Vincular Empresa</button>
                    </footer>
                </form> 
            </div>
            <!-- Termina formulario de vincular Empresa -->
            <!-- End Profile Content -->
            
        </div>
    </div>      
    <!--=== End Profile ===-->