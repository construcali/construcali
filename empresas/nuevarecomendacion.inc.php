<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">    
<link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">
<!-- CSS Para el formulario de respuesta -->
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<!-- el JS que se usa es calificar.js, unido en la linea 219 del footer.html -->
<!-- CSS para las estrellas de recomendacion -->
<style type="text/css">
    .estrellas input{
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .estrellas {
        user-select: none;
    }

    .estrellas input: checked + span{
        background-color: #ff9800;
    }

    .strella {
        font-size: 3rem;
        color:  #ff9800;
        border: none;
    }
</style>


 <!--=== Breadcrumbs ===-->
<!--=== Breadcrumbs v3 ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Empresas</h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="inicio.php?content=tutoriales">Tutoriales</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v3 ===-->

    <!--=== Container Part ===-->
    <div class="container">
        <div class="content">
            <!-- Magazine Slider -->
            
            <!-- End Magazine Slider -->

            <div class="row margin-bottom-10">
                <div class="col-sm-8">
                    <div class="headline"><?php echo "<h2><a href=\"empresas.php?content=estaempresa&id=$empresaid\">".$empresa[0]['empresa']."</a></h2>"; ?>
                    </div>
                    <div class="left-inner">
                    <h2>Su Recomendacion</h2>
                     <?php 
                        if (isset($mensaje)) echo $mensaje;
                     ?>
                    <form action="empresas.php?content=nuevarecomendacion" id="calificarEmpresa" class="sky-form" method="post">
                        <div class='estrellas'>
                            <label style="float:left">
                                <input type="checkbox" name="calificacion" value="1">
                                <span class="fa strella" id="star1">&#9734</span>
                            </label>
                            <label style="float:left">
                                <input type="checkbox" name="calificacion" value="2">
                                <span class="fa strella" id="star2">&#9734</span>
                            </label>
                            <label style="float:left">
                                <input type="checkbox" name="calificacion" value="3">
                                <span class="fa strella" id="star3">&#9734</span>
                            </label>
                            <label style="float:left">
                                <input type="checkbox" name="calificacion" value="4">
                                <span class="fa strella" id="star4">&#9734</span>
                            </label>
                            <label style="float:none">
                                <input type="checkbox" name="calificacion" value="5">
                                <span class="fa strella" id="star5">&#9734</span>
                            </label>
                        </div>
                            <section>
                                <label class="label">Debe haber ingresado como usuarie para poder recomendar</label>
                                    <label class="textarea">
                                        <i class="icon-append fa fa-comment"></i>
                                            <textarea rows="3" name="recomendacion" id="recomendacion" placeholder="Escriba su recomendacion aqui"></textarea>
                                    </label>
                            </section>
                            <input type="hidden" id="empresaid" name="empresaid" value="<?php echo $empresaid; ?>">
                            
                            <input type="hidden" id="respondonid" name="respondonid" value="<?php echo $loginid; ?>">
                            <button type="submit" class="btn-u btn-u-default">Enviar</button>
                    </form>
                    <div class="overflow-h" id="sky-formRespuesta">
                                        
                    </div>     
                    </div>
                    
                </div>
                <div class="col-sm-4">
                    <div class="headline"><h2>Informacion</h2></div>
                    <ul class="list-unstyled project-details">
                        <li><strong>Contacto:</strong><?php echo $empresa[0]['contacto']; ?></li>
                        <li><strong>Telefono:</strong> <?php echo $empresa[0]['telefono']; ?></li>
                        <li><strong>Categoria:</strong> <a href="#"><?php echo $categoria; ?></a></li>
                        <li><strong>Website:</strong><?php echo "<a href=\"$url\" target=\"_blank\">".$empresa[0]['url']; ?></a></li>
                    </ul>
                    <ul class="social-icons social-icons-color">
                    <li><a class="social_facebook" data-original-title="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($thisurl); ?>" target="_blank"></a></li>
                    <!-- <li><a class="social_googleplus" data-original-title="Google Plus" href="#"></a></li> -->
                    <li><a class="social_linkedin" data-original-title="LinkedIn" href="http://www.linkedin.com/shareArticle?mini=True&url=<?php echo urlencode($thisurl); ?>&title=<?php echo urlencode($titulo); ?>" target="_blank"></a></li>
                    <li><a class="social_twitter" data-original-title="Twitter" href="http://twitter.com/share?text=<?php echo $titulo; ?>&url=<?php echo urlencode($thisurl); ?>" target="_blank"></a></li>
                </ul>
                </div>
            </div>        
            
            <div class="container-content">
                
            </div>    
        </div>
    </div>    
    <!--=== End Container Part ===-->