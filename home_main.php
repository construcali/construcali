<!-- Image Gradient -->
    <div class="hidden-sm hidden-xs interactive-slider-v2">
        <div class="container">
            <h1><?php echo(isset($mensaje_404)) ? $mensaje_404 : 'Bienvenido a Construcali.com'; ?></h1>
            <p>Registre su empresa y reciba cotizaciones</p>
        </div>
    </div>
    <!-- End Image Gradient -->
    <!-- login para celulares -->
    <div class="hidden-md hidden-lg interactive-slider-v2">
        <div class="container">
            <form action="inicio.php?content=verificar" method="post" id="sky-form2" class="sky-form">
            <header><?php echo(isset($mensaje_404)) ? $mensaje_404 : 'Bienvenido a Construcali.com'; ?></header>
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
                        </form>         
        </div>
    </div>
        <!-- Termina login para celulares -->

    <!--=== Content ===-->
    <div class="content-md">
        <div class="container">
            <!-- Service Box -->
            <div class="row text-center margin-bottom-60">
                <div class="col-md-4 md-margin-bottom-50">
                    <h1 class="title-v3-md margin-bottom-10">Elabora Presupuestos</h1>
                    <p>Encuentra bases de datos completas para hacer los presupuestos de tus proyectos</p>
                </div>
                <div class="col-md-4 flat-service md-margin-bottom-50">
                    <h2 class="title-v3-md margin-bottom-10">Realiza Cotizaciones</h2>
                    <p>Cotize con varias empresas sus proyectos y materiales. Reciba respuestas de empresas de su zona</p>
                </div>
                <div class="col-md-4 flat-service">
                    <h2 class="title-v3-md margin-bottom-10">Preguntele a la Comunidad</h2>
                    <p>Resuelve tus dudas acerca de tus proyectos. Preguntale a la comunidad </p>
                </div>
            </div>
            <!-- End Service Box -->
        </div><!--/container -->

        <div class="container">
            <div class="headline-center margin-bottom-60">
                <h2>Catalogos Recientes</h2>
                <p>Estas son algunas de las fotos de los ultimos catalogos subidos por empresas <a href="http://construcali.com/catalogos.php">Ver catalogos</a></p>
            </div><!--/end Headline Center-->

            <!-- Portfolio Box -->
            <ul class="list-unstyled row portfolio-box">
            <?php 
                foreach ($home_fotos as $home_foto) {
                $fotoid = $home_foto['fotoid'];
                $empresaid = $home_foto['empresaid'];
                $descripcion = $home_foto['descripcion'];
                $descripcion = htmlentities ($descripcion);
                $empresa = $main->con_casilla(empresa,companies,empresaid,$empresaid);
                $nombre_empresa = htmlentities($empresa);
                $catid = $main->con_casilla(clase,companies,empresaid,$empresaid);
                $categoria = $main->con_casilla(categoria,categorias,catid,$catid); 
            ?>
                <li class="col-sm-4 md-margin-bottom-50">
                    <a class="thumbnail fancybox" data-rel="gallery" title="<?php echo $descripcion; ?>" href="catalogos.php?content=estafoto&fotoid=<?php echo $fotoid; ?>">
                        <?php echo "<img class=\"full-width img-responsive\" src=\"showimage.php?id=$fotoid\" alt=\"$descripcion\">"; ?>
                        <span class="portfolio-box-in">
                            <i class="rounded-x icon-magnifier-add"></i>
                        </span>
                    </a>    
                    <div class="headline-left margin-bottom-10"><h3 class="headline-brd"><a href="http://construcali.com/empresas.php?content=estaempresa&id=<?php echo $empresaid; ?>"><? echo  $nombre_empresa; ?></a></h3></div>
                    <small class="project-tag"><i class="fa fa-tag"></i><a href="http://construcali.com/empresas.php?content=categorias&id=<?php echo $catid; ?>"><?php echo $categoria; ?></a>, <a href="http://construcali.com/empresas.php?content=estaempresa&id=<?php echo $empresaid; ?>">Catalogo</a></small>
                    <p><?php echo $descripcion; ?> </p>
                </li>
            <?php
                }
            ?>
                
            </ul>
            <!-- End Portfolio Box -->
        </div><!--/end container-->    

        <!-- Parallax Section bg-image-v1 imagen2index esta en custom.css -->
        <div class="imagen2index parallaxBg margin-bottom-60">
            <div class="container">
                <div class="headline-center headline-light">
                    <h2>Quieres Realizar algun proyecto o remodelacion?</h2>
                    <p>Recibe precios gratis de empresas en tu zona</p><br>
                    <a href="http://construcali.com/usuarios.php" type="button" class="btn-u btn-brd btn-brd-hover btn-u-light">Haga su cotizacion ahora</a>
                </div><!--/end Headline Center-->
            </div>
        </div>
        <!-- End Parallax Section -->

        <!-- Flat Background Block -->

        <!-- End Flat Background Block -->

        <div class="container">
            

            <div class="row margin-bottom-60">
                <div class="col-sm-12">
                    <iframe type="text/html" width="336" height="550" frameborder="0" allowfullscreen style="max-width:100%" src="https://read.amazon.com/kp/card?asin=B08T7X7Q5S&preview=inline&linkCode=kpe&ref_=cm_sw_r_kb_dp_PSGF95P8Y6GGKX0QFTX8" ></iframe>
                    <iframe type="text/html" width="336" height="550" frameborder="0" allowfullscreen style="max-width:100%" src="https://read.amazon.com/kp/card?asin=B08T7X7Q5S&preview=inline&linkCode=kpe&ref_=cm_sw_r_kb_dp_PSGF95P8Y6GGKX0QFTX8" ></iframe>
                </div>
            </div><!--/end row-->
        </div><!--/end container-->

        <!-- Flat Testimonials -->
      
        <!-- End Flat Testimonials -->

        <div class="container">
            <div class="headline-center margin-bottom-60">
                <h2>Servicios para su Empresa</h2>
                <p>Su empresa se beneficia subiendo su portafolio, creando un catalogo, publicando clasificados. Haga uso de nuestras bases de datos y elabore presupuestos. Ademas reciba cotizaciones y obtenga clientes para sus servicios y productos.<br /> <a href="usuarios.php?content=registrarse" type="button" class="btn-u text-uppercase">Crear una cuenta</a><a href="usuarios.php?content=registrarse" type="button" class="btn-u text-uppercase">Vincule su Empresa</a></p>
            </div><!--/end Headline Center-->

            <div class="row margin-bottom-40">
                <div class="col-md-4">
                    <div class="content-boxes-v5 margin-bottom-30">
                        <i class="rounded-x icon-layers"></i>
                        <div class="overflow-h">
                            <h3 class="no-top-space">Elabore Presupuestos</h3>
                            <p>Use nuestra completa bases de datos para elaborar presupuesos</p>
                        </div>    
                    </div>
                    <div class="content-boxes-v5 md-margin-bottom-30">
                        <i class="rounded-x icon-settings"></i>
                        <div class="overflow-h">
                            <h3 class="no-top-space">Reciba Cotizaciones</h3>
                            <p>Reciba cotizaciones de prospectos clientes y respondales directamente </p>
                        </div>    
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="content-boxes-v5 margin-bottom-30">
                        <i class="rounded-x icon-earphones-alt "></i>
                        <div class="overflow-h">
                            <h3 class="no-top-space">Campa&ntilde;as de Mercadeo</h3>
                            <p>Anuncie ofertas, productos, servicios y proyectos en nuestro boletin digital </p>
                        </div>    
                    </div>
                    <div class="content-boxes-v5 md-margin-bottom-30">
                        <i class="rounded-x icon-user "></i>
                        <div class="overflow-h">
                            <h3 class="no-top-space">Elabore Cotizaciones</h3>
                            <p>Cotize con varias empresas y reciba respuestas en su email. Ahorrese el trafico </p>
                        </div>    
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="content-boxes-v5 margin-bottom-30">
                        <i class="rounded-x icon-wrench"></i>
                        <div class="overflow-h">
                            <h3 class="no-top-space">Comparta sus Proyectos</h3>
                            <p>Suba el portafolio de su empresa y haga el catalogo de sus productos</p>
                        </div>    
                    </div>
                    <div class="content-boxes-v5 md-margin-bottom-30">
                        <i class="rounded-x icon-star"></i>
                        <div class="overflow-h">
                            <h3 class="no-top-space">Publique Clasificados</h3>
                            <p>Anuncie sus servicios, productos o los servicios y materiales que busca</p>
                        </div>    
                    </div>    
                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Content ===-->

    <!-- Image Mouse -->
   
    <!-- End Image Mouse -->