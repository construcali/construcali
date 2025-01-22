    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="catalogos.php">Catalogos</a></h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="biblioteca.php">Biblioteca</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
                <li><a href="portafolios.php">Portafolios</a></li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content"> 	
    	<div class="row portfolio-item margin-bottom-50"> 
            <!-- Carousel -->
            <div class="col-md-7">
                <div class="carousel slide carousel-v1" id="myCarousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <img alt="<?php echo $descripcion; ?>" src="<?php echo "showimage.php?id=$picid"; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Carousel -->

            <!-- Content Info -->        
            <div class="col-md-5">
            	<h2><a href="empresas.php?content=estaempresa&id=<?php echo $empresaid; ?>"><?php echo strip_tags($empresa[0]['empresa']); ?></a></h2>
                <p><?php echo strip_tags($descripcion); ?></p>
                <ul class="list-unstyled">
                	<li><i class="fa fa-user color-green"></i><?php echo ' '.$empresa[0]['contacto']; ?></li>
                	<li><i class="fa fa-phone color-green"></i><?php echo ' '.$empresa[0]['telefono']; ?></li>
                    <li><i class="fa fa-briefcase color-green"></i><a href="<?php echo "catalogos.php?content=estasfotos&fotoid={$picid}"; ?>" target="_blank"> Catalogo</a></li>
                	<li><i class="fa fa-link color-green"></i><a href="<?php echo $empresa[0]['url']; ?>" target="_blank"> Pagina Web</a></li>
                </ul>                 
                <!-- Contactar a la empresa -->
                <!-- Se usa el javascript en responderClasi.js -->
                <div class="row">  
                    <form action="empresas.php?content=cotizar" method="post" id="esteProducto" class="sky-form">
                                       
                            <div class="form-group">
                                <label class="label">Message</label>
                                <div class="col-sm-12">
                                    <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="4" name="message" id="message" class="form-control"></textarea>
                                </div>
                            </div>
                            <?php
                            echo "<input type=\"hidden\" name=\"empresaid\" id=\"empresaid\" value=\"$empresaid\">";
                            echo "<input type=\"hidden\" name=\"respondonid\" id=\"respondonid\" value=\"$usuarioid\" />"; //este es el usuario que contacta la empresa
                            ?>                       
                            <div class="col-sm-12">
                            <button type="submit" class="btn-u btn-u-large" id="responderBoton">Enviar mensaje</button>
                            </div>
                    </form>
                    <div class="col-sm-12 overflow-h" id="sky-form3-respuesta">
                                
                    </div>
                </div>    
            </div>
            <div class="col-md-5">
                <ul class="social-icons social-icons-color">
                    <li><a class="social_facebook" data-original-title="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url); ?>" target="_blank"></a></li>
                    <li><a class="social_linkedin" data-original-title="LinkedIn" href="http://www.linkedin.com/shareArticle?mini=True&url=<?php echo urlencode($url); ?>&title=<?php echo urlencode($titulo); ?>" target="_blank"></a></li>
                    <li><a class="social_twitter" data-original-title="Twitter" href="http://twitter.com/share?text=<?php echo $titulo; ?>&url=<?php echo urlencode($url); ?>" target="_blank"></a></li>
                </ul>
                <span><?php echo "<a href=\"anuncios.php?content=productos&sector=$sector\">$sector</a>"; ?></span>
            </div> 
            <!-- End Content Info -->        
        </div><!--/row-->

        <div class="margin-bottom-20 clearfix"></div>    

        <!-- Recent Works -->
        <!-- class="owl-carousel-v1 owl-work-v1 margin-bottom-40" -->
        
        <!-- End Recent Works -->
    </div><!--/container-->	 	
    <!--=== End Content Part ===-->