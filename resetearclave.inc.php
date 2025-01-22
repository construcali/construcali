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
            
            <!-- Profile Content -->
            <div class="col-md-6">
                        <form action="usuarios.php?content=resetearclave" method="post" id="sky-form2" class="sky-form">
                            <header>Una vez reclame su nueva clave en su email, pongala en este formulario</header>
                            
                            <fieldset>                  
                                <section>
                                    <div class="row">
                                        <label class="label col col-4">E-mail</label>
                                        <div class="col col-8">
                                            <label class="input">
                                                <i class="icon-append fa fa-user"></i>
                                                <input type="email" name="email" id="email2">
                                            </label>
                                        </div>
                                    </div>
                                </section>
                                
                                <section>
                                    <div class="row">
                                        <label class="label col col-4">Clave</label>
                                        <div class="col col-8">
                                            <label class="input">
                                                <i class="icon-append fa fa-lock"></i>
                                                <input type="password" name="password1" id="password2">
                                            </label>
                                            <div class="note">Una vez entre por favor cambie su clave</div>
                                        </div>
                                    </div>
                                </section>
                                
                                <section>
                                    <div class="row">
                                        <div class="col col-4"></div>
                                        <div class="col col-8">
                                            <label class="checkbox"><input type="checkbox" name="remember" checked><i></i>Recordar sesion</label>
                                        </div>
                                    </div>
                                </section>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn-u">Acceder a mi cuenta</button>
                                <a href="usuarios.php?content=registrarse" class="btn-u btn-u-default">Crear una cuenta</a>
                            </footer>
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