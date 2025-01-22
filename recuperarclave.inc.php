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
                <img class="img-responsive md-margin-bottom-10" src="assets/img/team/LogoCasco.png" alt="Logo de la empresa">
            </div>
            <!--End Left Sidebar-->
            
            <!-- Profile Content -->
            <div class="col-md-6">        
                <form action="usuarios.php?content=regenerarclave" method="post" id="pongaEmail" class="sky-form">
                            <h2 class="heading-sm">
                            <i class="icon-custom icon-sm icon-bg-blue fa fa-bullhorn"></i>
                            <small>Ponga su email y reviselo</small>
                            </h2>
                            <p>
                            Despues de poner la clave, vaya a su correo electronico, lea las instruciones y de click en el enlace que recibira en su email departe de construcali.com
                            </p>
                            
                            <fieldset>                  
                                <section>
                                    <label class="label">E-mail</label>
                                    <label class="input">
                                        <i class="icon-append icon-user"></i>
                                        <input type="email" name="email" id="email3" placeholder="ponga su email para recuperar su clave">
                                    </label>
                                </section>
                            </fieldset>
                            
                            <footer>
                                <button type="submit" name="submit" class="button">Recuperar Clave</button>
                            </footer>
                </form>
            </div>
            <!-- End Profile Content -->
            <div class="col-md-3">
                <!-- <form action="#" id="sky-form2" class="sky-form">
                    <div id="inline-start"></div>
                </form> --> 
            </div>
        </div>
    </div>      
    <!--=== End Profile ===-->