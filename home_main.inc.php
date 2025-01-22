<!--=== JavaScript ===-->
<script type="text/javascript">
    function imgError(image) {
    image.onerror = "";
    image.src = "/presentaciones/CasaGeneral.jpg";
    image.style.display = 'none';
    return true;
}
</script>
<!--=== JavaScript ===-->
<!-- CSS Styles -->
<style>
.no_imagen {
        display: none;
    }
</style>

<!-- Close CSS Styles -->
    <!-- Image Gradient -->
    
    <div class="hidden-sm hidden-xs interactive-slider-v2">
        <div class="container">
            <h1>COTICE SUS PROYECTOS Y MATERIALES</h1>
            <p>Registre su empresa y reciba cotizaciones</p>
        </div>
    </div>
   
    <!-- End Image Gradient -->
    <!-- login para celulares -->
    <div class="hidden-md hidden-lg interactive-slider-v2">
        <div class="container">
            <form action="inicio.php?content=verificar" method="post" id="sky-form2" class="sky-form">
            <header>Bienvenido a Construcali.com</header>
                            <fieldset>                  
                                <section>
                                    <div class="row">
                                        <label class="label col col-4">E-mail</label>
                                        <div class="col col-12">
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
                                        <div class="col col-12">
                                            <label class="input">
                                                <i class="icon-append fa fa-lock"></i>
                                                <input type="password" name="password1" id="password2">
                                            </label>
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

                            <section>
                                    <div class="row">
                                        <div class="col col-4"></div>
                                        <div class="note col col-8">
                                            <i class="icon-custom icon-sm icon-bg-blue fa fa-bullhorn"></i>
                                            <a href="usuarios.php?content=regenerarclave" class="btn-u" id="generarClave">Generar nueva clave</a>
                                        </div>
                                    </div>
                            </section>
                        </form>         
        </div>
    </div>
    <!-- Termina login para celulares -->

    <!--=== End Content ===-->

    <!-- Image Mouse -->
   
    <!-- End Image Mouse -->