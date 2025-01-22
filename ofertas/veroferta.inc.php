<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
 <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Clasificados</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="ofertas.php">Ofertas</a></li>
                <li><a href="usuarios.php">Tablero</a></li>
                <li><a href="home.php?content=logout"> Salir</a></li>
            </ul>
        </div>
    </div>
   <!--/breadcrumbs-->
<!--=== Job Description ===-->
<div class="job-description">
    <div class="container content">
          
        <!-- Left Inner -->
        <div class="left-inner">
        <div class="row">
            <div class="col-md-6 item active">
            <h3>
                 <?php 
                 echo $titulo;
                 ?>
            </h3>
            <?php
                 echo "<img src=\"{$url}\" width=\"550\" />"; 
            ?>
            </div>
            <div class="col-md-6 position-top">
                <ul class="social-icons social-icons-color">
                    <li><a class="social_facebook" data-original-title="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($oferta_url); ?>" target="_blank"></a></li>
                    <!-- <li><a class="social_googleplus" data-original-title="Google Plus" href="#"></a></li> -->
                    <li><a class="social_linkedin" data-original-title="LinkedIn" href="http://www.linkedin.com/shareArticle?mini=True&url=<?php echo urlencode($oferta_url); ?>&title=<?php echo urlencode($titulo); ?>" target="_blank"></a></li>
                    <li><a class="social_twitter" data-original-title="Twitter" href="http://twitter.com/share?text=<?php echo $titulo; ?>&url=<?php echo urlencode($oferta_url); ?>" target="_blank"></a></li>
                </ul>
                <a href="#"><i class="fa fa-print"></i></a>
            </div>    
            <div class="col-md-6 overflow-h">
                <p class="hex"><?php echo "Publicado por ".$empresa." el ".$fecha; ?></p>
                <p class="hex"><?php echo "Ciudad.: ".$ciudad." Telefono.: ".$telefono; ?></p>
                <div class="star-vote">
                    <span><?php echo "<a href=\"ofertas.php?content=estasofertas&catid=$catid\">$categoria</a>"; ?></span>
                </div>
                <p  class="hex"><?php echo $descripcion; ?></p>
            </div>    
        </div>
            <hr>
            <!-- id resPuesta se usa en responderClasi.js que llama a responder.php -->
            <h2>Su Respuesta</h2>
            <form action="responder.php" class="sky-form" method="post" id="resPuesta">
                    <section>
                        <label class="label">Debe haber ingresado como usuario para poder responder</label>
                            <label class="textarea">
                                <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="3" name="oferta" id="oferta" placeholder="Escriba su respuesta aqui"></textarea>
                            </label>
                    </section>
                    <?php
                     echo "<input type=\"hidden\" name=\"productoid\" id=\"productoid\" value=\"$productoid\" />";
                     echo "<input type=\"hidden\" name=\"email\" id=\"email\" value=\"$email\" />";   
                     echo "<input type=\"hidden\" name=\"titulo\" id=\"titulo\" value=\"$titulo\" />"; 
                    ?>
                    <button type="submit" class="btn-u btn-u-default">Responder</button>
            </form>
            <div class="overflow-h" id="sky-formRespuesta">
                                
            </div>     
            <hr>
        </div>
        <!-- End Left Inner -->
    </div>   
</div>    
<!--=== End Job Description ===-->