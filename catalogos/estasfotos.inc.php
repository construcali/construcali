<!-- CSS Implementing Plugins -->
<link rel="stylesheet" href="assets/plugins/animate.css">
<link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">

<!-- CSS Page Style -->    
<link rel="stylesheet" href="assets/css/pages/portfolio-v1.css">
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">    
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">
<!-- CSS Para el formulario de respuesta -->
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
 <!--=== Breadcrumbs ===-->
<!--=== Breadcrumbs v3 ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="catalogos.php">Productos</a></h1>
            <ul class="pull-right breadcrumb">
                 <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=cotizaciones">Mi Actividad</a></li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v3 ===-->

    <!--=== Container Part ===-->
    <div class="container content">
        
            <!-- Magazine Slider -->
            <div class="row portfolio-item margin-bottom-50">
                <!-- Carrusel -->
                <div class="col-md-7">
                    <div class="carousel slide carousel-v1" id="myCarousel">
                        <div class="carousel-inner">
                            <?php
                            $numFotos = count($fotos);
                            for ($i=0;$i<$numFotos;$i++){
                                 //conseguir el numero de casillas del array fotos
                                //hubiera podido haber usado foreach fotos as foto
                                $photoid = $fotos[$i]['fotoid'];
                                $url_foto = $fotos[$i]['foto'];
                                $fotoDescripcion = $fotos[$i]['descripcion'];
                                    if($i<1){
                                        echo "<div class=\"item active\">";
                                        echo "<img src=\"$esta_foto\" alt=\"$descripcion\">";
                                        echo "<div class=\"carousel-caption\"><p>$descripcion</p></div>";
                                        echo "</div>";
                                    }else
                                    {
                                        echo "<div class=\"item\">";
                                        echo "<img src=\"$url_foto\" alt=\"$fotoDescripcion\">";
                                        echo "<div class=\"carousel-caption\"><p>$fotoDescripcion</p></div>";
                                        echo "</div>";
                                    }
                                }
                            ?>
                        </div>
                    
                        <div class="carousel-arrow">
                            <a data-slide="prev" href="#myCarousel" class="left carousel-control">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a data-slide="next" href="#myCarousel" class="right carousel-control">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Termina Carrusel -->
                <!-- Content Info -->        
                <div class="col-md-5">
                    <h2><a href="empresas.php?content=estaempresa&id=<?php echo $empresaid; ?>"><?php echo $nombre_empresa; ?></a></h2>
                    <p><?php echo $descripcion; ?> </p>
                    
                    <ul class="list-unstyled">
                        <li><i class="fa fa-dollar color-green"></i> <?php echo $valor; ?></li>
                        <li><i class="fa fa-cubes color-green"></i> <?php echo $esta_foto_unidad; ?></li>
                        <li><i class="fa fa-tags color-green"></i> <?php echo "<a href=\"$url\" target=\"_blank\"> Pagina Web"; ?></a></li>
                    </ul>

                    <!-- Contactar a la empresa, resEstasFotos usa el archivo js de responderAnuncio.js -->
                
                    <h2>Su Mensaje</h2>
                 <?php 
                    if (isset($mensaje)) echo $mensaje;
                 ?>
                    <!-- ressponderAnuncio.js envia este formulario -->                 
                    <form action="catalogos.php?content=responder" id="resEstasFotos" class="sky-form" method="post">
                            <section>
                                <label class="label">Escribale directamente a la Empresa</label>
                                    <label class="textarea">
                                        <i class="icon-append fa fa-comment"></i>
                                            <textarea rows="3" name="oferta" id="oferta" placeholder="Escriba su respuesta aqui"></textarea>
                                    </label>
                            </section>
                            <?php
                             echo "<input type=\"hidden\" id=\"picid\" name=\"photoid\" value=\"$picid\" />"; 
                             echo "<input type=\"hidden\" id=\"empresaid\" name=\"empresaid\" value=\"$empresaid\" />"; 
                             if (isset($loginid)){
                                echo "<input type=\"hidden\" id=\"respondonid\" value=\"$loginid\">";
                             }
                            ?>
                            <button type="submit" class="btn-u btn-u-large" id="responderBoton">Responder</button>
                    </form>
                    <div class="overflow-h" id="sky-formRespuesta">
                                        
                    </div>  
                </div>
                <!-- End Content Info -->      
            </div>
            <!-- End Magazine Slider -->
            
             <div class="margin-bottom-20 clearfix"></div>  

            <!-- Recent Works -->
            <?php
            if ($numFotos >= 4){
            ?>
            <div class="owl-carousel-v1 owl-work-v1 margin-bottom-40">
                <div class="headline"><h2 class="pull-left">Otras Fotos</h2>
                    <div class="owl-navigation">
                        <div class="customNavigation">
                            <a class="owl-btn prev-v2"><i class="fa fa-angle-left"></i></a>
                            <a class="owl-btn next-v2"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div><!--/navigation-->
                </div>

                <div class="owl-recent-works-v1">
                    <?php
                    foreach ($fotos as $foto) {
                        $fotoid = $foto['fotoid'];
                        $fotoid_descripcion = $foto['descripcion'];
                        $check_descripcion = strpos($fotoid_descripcion, '&lt;');
                        if ($check_descripcion === false){
                            $fotoid_descripcion = htmlentities(strip_tags($fotoid_descripcion));
                        }else{
                            $fotoid_descripcion = html_entity_decode($fotoid_descripcion);
                        }
                    ?>
                    <div class="item">
                        <a href="catalogos.php?content=estasfotos&fotoid=<?php echo $fotoid; ?>">
                            <em class="overflow-hidden">
                            <?php
                            echo "<img src=\"showimage.php?id=$fotoid\" class=\"img-responsive\" alt=\"$fotoid_descripcion\">";
                    
                            ?>
                            </em>    
                            <span>
                                <strong><?php echo $fotoid_descripcion; ?></strong>
                                
                            </span>
                        </a>    
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>    
            <!-- End Recent Works --> 
        
    </div>    
    <!--=== End Container Part ===-->