<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<link rel="stylesheet" href="assets/css/pages/profile.css">
 <!-- CSS Page Style -->
<link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
<!-- CSS -->
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
                <li><a href="https://construcali.com/blogs.php">Blog</a></li>
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
                <div class="col-sm-8 col-md-8 profile">
                    <div class="panel panel-profile">
                    <div class="headline"><h2>Recomendaciones de</h2> <?php echo "<h2><a href=\"empresas.php?content=estaempresa&id=$empresaid\">".$empresa[0]['empresa']."</a></h2>"; ?>
                    </div>
                    <?php 
                        if (isset($mensaje)) echo $mensaje;
                     ?>
                    <div class="panel-body">
                    
                     <?php 
                        foreach ($recomendaciones as $recomendacion){
                            $productoid = $recomendacion['productoid'];
                            $evaluacion = $recomendacion['evaluacion'];
                            $calificacion = $recomendacion['calificacion'];
                            $foristaid = $recomendacion['usuarioid'];
                            $nombre = $main->con_casilla(nombre,usuarios,usuarioid,$foristaid);                        
                            // conseguir fecha y formatearla
                            $fecha = $recomendacion['fecha'];
                            $posteada = $main->formatear_fecha($fecha);
                            // conseguir foto de usuari@
                            $imgsrc = $main->con_casilla(foto,usuarios_fotos,usuarioid,$foristaid);
                            if (empty($imgsrc))
                                $imgsrc = 'assets/img/team/img1-md.jpg';
                            else
                                $imgsrc = 'fotosperfiles/'.$imgsrc;
                    ?>
                    <div class="row">
                        <?php 
                            for ($i=1; $i <= 5; $i++) { 
                            ?>
                            <label style="float:left">
                                <span class="fa strella">
                                <?php
                                 if ($calificacion >= $i) {
                                    echo '&#9733';
                                 }else{
                                    echo '&nbsp';
                                 }

                                ?>
                                </span>
                            </label>
                        <?php
                            }
                        ?>   
                            
                    </div>
                    <div class="media media-v2">
                        <a class="pull-left">
                        <img class="media-object" width="128px" src="<?php echo $imgsrc; ?>" alt="Foto de perfil" />
                        </a>
                        <div class="media-body">    
                        <h4 class="media-heading">
                            <i class="fa fa-user"></i><strong><?php echo $nombre.' '.$calificacion; ?></strong><i class="fa fa-calendar"><?php echo $posteada; ?></i></h4>
                            <p><?php echo html_entity_decode($recomendacion['evaluacion'], ENT_NOQUOTES); ?></p>
                            <!--
                            <ul class="list-unstyled list-inline blog-tags">
                                <li class="rectangulo">
                                    <i class="expand-list rounded-x fa fa-reply"></i>
                                    <?php echo "<a href=\"$productoid\">Responder</a>"; ?>
                                </li>
                            </ul>
                            --> 
                        </div>
                    </div>
                    <?php
                        }
                     ?>
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