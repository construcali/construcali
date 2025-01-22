

<!--=== Footer Version 1 ===-->
    <div class="footer-v1">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- About -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <a href="http://play.google.com/store/apps/details?id=com.construcol.helloworld" target="_blank"><img id="logo-footer" class="footer-logo" src="assets/img/logocolconstruccion.png" width="150" heght="58"  alt="Logo de Colconstruccion"></a>
                        <p>Construcali.com es el directorio interactivo de la construccion en Colombia. <a href="http://construcali.com/usuarios.php?content=registrarse">Unete</a> a esta red de empresas!
                        Baje la applicacion movil <a href="http://play.google.com/store/apps/details?id=com.construcol.helloworld"" target="_blank">aqui</a> o dando click en el logo</p>    
                    </div><!--/col-md-3-->
                    <!-- End About -->

                    <!-- Latest -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="posts">
                            <div class="headline"><h2>Te apoyamos</h2></div>
                            <ul class="list-unstyled link-list">
                                <li><a href="biblioteca.php">Biblioteca</a><i class="fa fa-angle-right"></i></li>
                                <li><a href="portafolios.php">Portafolios</a><i class="fa fa-angle-right"></i></li>
                                <li><a href="biblioteca.php?content=formularios">Formularios</a><i class="fa fa-angle-right"></i></li>
                                <li><a href="biblioteca.php?content=enlaces">Recursos</a><i class="fa fa-angle-right"></i></li>
                                <li><a href="portafolios.php?content=boletines">Boletines</a><i class="fa fa-angle-right"></i></li>
                            </ul>
                        </div>
                    </div><!--/col-md-3-->  
                    <!-- End Latest --> 
                    
                    <!-- Link List -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="headline"><h2>Enlaces Importantes</h2></div>
                        <ul class="list-unstyled link-list">
                            <li><a href="inicio.php?content=precios#correoMasivo">Correos Masivos</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="inicio.php?content=precios#publicidadPortal">Publicidad en el Portal</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="inicio.php?content=precios#paginasWeb">Paginas Web</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="inicio.php?content=tienda">Tienda</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="inicio.php?content=precios#publicidadRevista">Publicidad en la Revista</a><i class="fa fa-angle-right"></i></li>
                        </ul>
                    </div><!--/col-md-3-->
                    <!-- End Link List -->                    

                    <!-- Address map-img address -->
                    <div class="col-md-3  md-margin-bottom-40">
                        <div class="headline"><h2>Empresas Destacadas</h2></div>
                        <ul class="list-unstyled link-list">                        
                        <?php 
                        foreach ($primeras_cinco as $key => $value) {
                        $primera_empresa = $main->con_casilla('empresa','companies','empresaid',$key);
                        $segunda_emrpesa = htmlspecialchars($segunda_empresa);
                        $segunda_empresa = html_entity_decode($primera_empresa);
                        echo "<li><a href=\"empresas.php?content=estaempresa&id=$key\" >{$segunda_empresa}</a></li>";
                        }
                        ?>
                        </ul>
                    </div><!--/col-md-3-->
                    <!-- End Address -->
                </div>
            </div> 
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">                     
                        <p>
                            Colconstruccion &copy; Todos los derechos reservados.
                           <a href="inicio.php?content=privacidad">Politica de Privacidad</a> | <a href="inicio.php?content=normasdeuso">Terminos de uso</a>
                        </p>
                    </div>

                    <!-- Social Links -->
                    <div class="col-md-6">
                        <ul class="footer-socials list-inline">
                            <li>
                                <a href="https://www.facebook.com/colconstruccion" target="_blank" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/watch?v=-kPBlhmHPyI&list=PLPm10ZLHqsPydYRAbQsV1V7scwdZNpRC4" target="_blank" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Youtube">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://linkedin.com/in/colconstruccion/en" target="_blank" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/Colconstruccion" target="_blank" class="tooltips" data-toggle="tooltip" data-placement="top" title=""data-original-title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Social Links -->
                </div>
            </div> 
        </div><!--/copyright-->
    </div>     
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->			
<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="assets/plugins/jquery.parallax.js"></script>
<script type="text/javascript" src="assets/plugins/parallax-slider/js/modernizr.js"></script>
<script type="text/javascript" src="assets/plugins/parallax-slider/js/jquery.cslider.js"></script>
<script type="text/javascript" src="assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/plugins/fancy-box.js"></script>
<script type="text/javascript" src="assets/js/plugins/owl-carousel.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      	App.init();
        App.initParallaxBg();
        FancyBox.initFancybox();
        OwlCarousel.initOwlCarousel();
        });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>      
<![endif]-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#presupuestoCode a').click(function(){
            var href = $(this).attr('href');
            var asociadoid = $(this).attr('id');
            //alert(asociadoid);
            $.post('http://construcali.com/analisis/index.php/articulos/main', 'usuarioid='+asociadoid);
            $(location).attr('href','http://construcali.com/analisis/index.php/articulos/main');
            //return false;
        }); //end click
    }); //end ready
</script>
</body>
</html>	