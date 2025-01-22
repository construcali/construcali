<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css"> 
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Foros</h1>
            <ul class="pull-right breadcrumb">
                <?php if (isset($loginid))
                {
                    ?>
                <li><a href="usuarios.php">Panel Usuario</a></li>
                <li><a href="foros.php">Foros</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <?php
                }else{
                    ?>
                <li><a href="anuncios.php?content=cotizar">Cotizar</a></li>
                <li><a href="foros.php">Foros</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <?php
                    }
                ?>
                
                
            </ul>
        </div>
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->
     <div class="container content">        
        <div class="row blog-page blog-item">
            <!-- Left Sidebar -->
            <div class="col-md-9 md-margin-bottom-60">
                <div class="post-comment">
                 <h3>Nuevo Tema</h3>
                    <form method="post" action="foros.php?content=addforo" id="nuevoForo" class="sky-form">
                    <div class="row margin-bottom-20">
                        <div class="col-md-6 col-md-offset-0">
                        <input type="text" name="titulo" id="tituloForo" placeholder="Titulo" class="form-control">
                        </div>                
                    </div>

                    <div class="row margin-bottom-20">
                        <label class="select">
                        <div class="col-md-6 col-md-offset-0">
                            <select name="categoria" id="categoria">
                                <option value="0" selected disabled>Categorias</option>
                                <?php
                                    foreach ($catnombres as $llave => $valor) {
                                    echo "<option value=\"$llave\">$valor</option>";
                                    }
                                ?>
                            </select>
                            <i></i>
                        </div>     
                        </label>
                    </div>

                    <label style="margin-top:1em" id="mensajeForo">Mensaje</label>
                    <div class="row margin-bottom-20">
                        <div class="col-md-11 col-md-offset-0">
                                <textarea class="form-control" name="mensaje" id="mensaje" rows="6"></textarea>
                                
                        </div>                
                    </div>
                    <p><button class="btn-u" type="submit">Publicar Tema</button></p>
                    </form>
                </div>
                <div id="procesarForo"></div>
            </div>
            <!-- Right Sidebar -->
            <div class="col-md-3 magazine-page">
                <!-- Search Bar -->
                <div class="headline headline-md"><a class="btn-u btn-block btn-u-green" href="usuarios.php">Panel Usuario</a> </div>        
                <div class="input-group margin-bottom-40">
                <form method="post" action="foros.php?content=buscar">
                    <input type="text" name="palabraClave" class="form-control" placeholder="Buscar">
                    <span class="input-group-btn">
                        <button class="btn-u" type="submit">Buscar en Foros</button>
                    </span>
                </form>    
                </div>
                <!-- End Search Bar -->

                <!-- Posts -->
                <!--/posts-->
                <!-- End Posts -->

                <!-- Tabs Widget -->
                <div class="headline headline-md"><h2>De Su Interes</h2></div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Nuestros Servicios</a></li>
                        <li><a data-toggle="tab" href="#home-2">Categorias</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                            <p><a href="anuncios.php?content=anunciar" class="btn-u btn-block">Vender</a></p>
                            <p><a href="anuncios.php?content=cotizar" class="btn-u btn-block">Cotizar</a></p>
                            <p><a href="usuarios.php?content=cotizaciones" class="btn-u btn-block">Correo</a></p>
                            <p><a href="foros.php?content=nuevoforo" class="btn-u btn-block">Nuevo Foro</a></p>                        
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <div class="row">
                                 <ul class="list-unstyled blog-tags margin-bottom-30">
                                    <?php
                                    foreach ($categorias as $key => $value) {
                                         echo "<li><a href=\"foros.php?content=estosforos&catid=$key\"><i class=\"fa fa-tags\"></i>$value</a></li>";
                                     } 
                                    ?>      
                                </ul>                      
                            </div>
                        </div>
                    </div>
                </div> 

                <!-- Photo Stream -->
            
                <!-- End Photo Stream -->

                <!-- Blog Tags -->
                
                
                <!-- End Blog Tags -->

                <!-- Blog Latest Tweets -->
                
                <!-- End Blog Latest Tweets -->
            </div>
            <!-- End Right Sidebar -->
        </div><!--/row-->        
    </div><!--/container-->         