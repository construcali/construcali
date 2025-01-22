<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
 <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Clasificados</h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="biblioteca.php">Biblioteca</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
                <li><a href="portafolios.php">Portafolios</a></li>
            </ul>
        </div><!--/end container-->
    </div>
   <!--/breadcrumbs-->
<!--=== Job Description ===-->
<div class="job-description">
    <div class="container content">
          
        <!-- Left Inner -->
        <div class="left-inner">
        <div class="row">
            <div class="col-md-6 item active">
        <?php echo "<img src=\"showservicios.php?id=$productoid\" class=\"img-fluid img-responsive\" />"; ?>
            <h3><?php
                $titulo = $clasificado[0]['titulo'];
                $sector = $clasificado[0]['sector'];
                $ciudad = $clasificado[0]['ciudad'];
                $nombre = $clasificado[0]['nombre'];
                $telefono = $clasificado[0]['telefono'];
                $fecha = $clasificado[0]['fecha'];
                $anuncio = $clasificado[0]['servicio'];
                $email = $clasificado[0]['email'];
                 //usar htmlentities para que se vean bien las letras con tildes y enes
                        $titulo = htmlentities($titulo);
                        $ciudad = htmlentities($ciudad);
                        $anuncio = htmlentities($anuncio);
                        $nombre = htmlentities($nombre); 
                echo $titulo;
                ?>
            </h3>
            </div>
            <div class="col-md-6 position-top"> <!--  -->
                <ul class="social-icons social-icons-color">
                    <li><a class="social_facebook" data-original-title="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url); ?>" target="_blank"></a></li>
                    <li><a class="social_linkedin" data-original-title="LinkedIn" href="http://www.linkedin.com/shareArticle?mini=True&url=<?php echo urlencode($url); ?>&title=<?php echo urlencode($titulo); ?>" target="_blank"></a></li>
                    <li><a class="social_twitter" data-original-title="Twitter" href="http://twitter.com/share?text=<?php echo $titulo; ?>&url=<?php echo urlencode($url); ?>" target="_blank"></a></li>
                </ul>
            </div>    
            <div class="col-md-6 overflow-h">
                <p class="hex"><?php echo "Publicado por ".$nombre." el ".$fecha; ?></p>
                <p class="hex"><?php echo "Ciudad.: ".$ciudad." Telefono.: ".$telefono; ?></p>
                <div class="star-vote">
                    <span><?php echo "<a href=\"anuncios.php?content=servicios&sector=$sector\">$sector</a>"; ?></span>
                    <span><?php if (isset($hayempresaid)) { echo "<a href=\"empresas.php?content=estaempresa&id=$hayempresaid\"> $nombre_empresa </a>" ; } ?></span>
                </div>
                <hr>
                <h2>Anuncio</h2>
                <p><?php echo $anuncio ?></p>
                <hr>
                <h2>Su Respuesta</h2>
                <form action="responder.php" class="sky-form" method="post" id="resPuesta">
                        <section>
                            <!-- <label class="label">Debe haber ingresado como usuario para poder responder</label> -->
                                <label class="textarea">
                                    <i class="icon-append fa fa-comment"></i>
                                        <textarea rows="3" name="oferta" id="oferta" placeholder="Escriba su respuesta aqui"></textarea>
                                </label>
                        </section>
                        <?php
                         echo "<input type=\"hidden\" name=\"usuarioid\" id=\"respondonid\" value=\"$loginid\" />";
                         echo "<input type=\"hidden\" name=\"productoid\" id=\"productoid\" value=\"$productoid\" />";
                         echo "<input type=\"hidden\" name=\"email\" id=\"email\" value=\"$email\" />";   
                         echo "<input type=\"hidden\" name=\"titulo\" id=\"titulo\" value=\"$titulo\" />"; 
                        ?>
                        <button type="submit" class="btn-u btn-u-blue" id="botonResponderAnuncio">Responder</button>
                </form>
                <div class="overflow-h" id="sky-formRespuesta">
                                    
                </div>
            </div>    
        </div> <!-- end row -->
        </div>
        <!-- End Left Inner -->
    </div>   
</div>    
<!--=== End Job Description ===-->