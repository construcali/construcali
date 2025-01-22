    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
    <!-- Script for Recaptcha Checkbox -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <hr>

                <!--Notification-->
               
                <!--End Notification-->

                <div class="margin-bottom-50"></div>

                <!--Datepicker-->
                
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->
            
            <!-- Profile Content - JS editarUsuarioInfo.js revisa la info de este formulario -->
            <div class="col-md-6">
                 <!-- Reg-Form -->
                    <form action="inicio.php?content=registrarusuario" method="post" class="sky-form" id="nuevoUsuarioInfo">
                        <header>Crear una cuenta</header>

                       
                            
                        <fieldset>                  
                            <div class="row">
                                <?php
                                    if (isset($mensaje))
                                        echo $mensaje;
                                ?>
                                <section class="col col-6">
                                    <label class="input">
                                        <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="input">
                                        <input type="text" name="apellido" id="apellido" placeholder="Apellido">
                                    </label>
                                </section>
                            </div>
                                
                            <section>
                                <label class="input">
                                    <i class="icon-append fa fa-envelope"></i>
                                    <input type="email" name="email" id="email" placeholder="Correo Electronico">
                                    <b class="tooltip tooltip-bottom-right">Se necesita para verificar su cuenta</b>
                                </label>
                            </section>
                                
                            <section>
                                <label class="input">
                                    <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="password" id="password" placeholder="Escriba una clave">
                                    <b class="tooltip tooltip-bottom-right">Ponga una clave mayor de 6 caracteres</b>
                                </label>
                            </section>
                                
                             <!-- Caja de Captcha, no soy un robot -->
                        <div class="g-recaptcha" data-sitekey="6Ldkg8UUAAAAAFQ8JQHwQsWVwVwt67kl9-Wu3Rjq"></div>
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn-u">Crear cuenta</button>
                        </footer>
                        <fieldset>
                            <div class="row content-boxes-v2">
                                <section class="col col-12">
                                    <label><i class="icon-custom icon-sm icon-bg-blue fa fa-bullhorn"></i> 
                                    <span>Haciendo click en "Crear cuenta" acepta los terminos de uso y politicas de privacidad</span></label>
                                </section>
                            </div>

                            <div class="row content-boxes-v2">
                                <section class="col col-12">
                                    <label><i class="icon-custom icon-sm icon-bg-red fa fa-bullhorn"></i> 
                                    <span>Para registrar su empresa, debe crear una cuenta primero como usuario</span></label>
                                </section>
                            </div>

                        </fieldset>
                    </form>
            </div>
            <!-- End Profile Content -->
            <div class="col-md-3">
                <form action="#" id="sky-form2" class="sky-form">
                    <div id="inline-start"></div>
                </form> 
            </div>
        </div>
    </div>      
    <!--=== End Profile ===-->