<!--=== Job Description ===-->
    <div class="job-description">
        <!--=== Breadcrumbs ===-->
        <div class="breadcrumbs">
            <div class="container">
                <h1 class="pull-left"><a href="empresas.php">Empresas</a></h1>
                <ul class="pull-right breadcrumb">
                    <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                    <li><a href="https://construcali.com/blogs.php">Blog</a></li>
                    <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
                </ul>
            </div><!--/end container-->
        </div>
       <!--/breadcrumbs-->
        <div class="container content">  
            <div class="row">
                <!-- Left Inner -->
                <div class="col-md-7">
                    <div class="left-inner">
                        <?php 
                            if(empty($logo))
                                echo "<img src=\"https://construcali.com/logo/no-logo.png\" alt=\"No Logo\" width=\"80%\">";
                            else
                                echo "<img src=\"logo/$logo\" alt=\"Logo Empresarial\" width=\"80%\">";
                            echo "<h3>".$empresa."</h3>"; 
                            echo "<i class=\"position-top fa fa-home\"></i>".$direcion.", ".$ciudad.", ".$compania['departamento'];
                        ?>
                        
                        <div class="overflow-h">
                           <?php
                            
                            echo "<ul class=\"list-inline\">";
                            echo "<li><i class=\"fa fa-globe color-green\"></i><a class=\"linked\" href=\"$paginaweb\" target=\"_blank\">Pagina web</a></li>";
                            echo "<li><i class=\"fa fa-phone\"></i>".$compania['telefono']."</li>";
                            echo "<li class=\"hidden-md hidden-lg\"><i class=\"fa fa-whatsapp color-green\"></i><a href=\"https://wa.me/{$whatsapp}\">".$whatsapp."</a></li>";
                            echo "<li><i class=\"fa fa-briefcase color-green\"></i><a href=\"empresas.php?content=categorias&id=$catid\">".$compania['categoria']."</a></li>";
                            echo "<li><i class=\"fa fa-user\"></i>".$contacto."</li>";
                            echo "</ul>";
                            ?> 
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo urlencode($url); ?>&layout=button_count&size=small&mobile_iframe=true&width=100&height=20&appId" width="100" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                            
                            <a class="social_linkedin" data-original-title="LinkedIn" href="http://www.linkedin.com/shareArticle?mini=True&url=<?php echo urlencode($url); ?>&title=<?php echo urlencode($titulo); ?>" target="_blank"><button style="font-size:24px">Linked <i class="fa fa-linkedin"></i></button></a>

                            <a href="https://wa.me/<?php echo $whatsapp; ?>?text=<? echo urlencode($mensaje_contacto);?>" class="btn-u btn-u-green hidden-md hidden-lg">Contactar</a>
                                
                            </ul>

                            <a href="https://construcali.com/empresas.php?content=nuevarecomendacion&empresaid=<?php echo $empresaid; ?>"><button class="btn btn-md">Recomendar Empresa</button></a>

                            <a href="https://construcali.com/empresas.php?content=recomendaciones&empresaid=<?php echo $empresaid; ?>"><button class="btn btn-md">Recomendaciones</button></a>

                        </div>    
                         
                        <hr>

                        <h2>Mision</h2>
                        <p>
                        <?php
                        $mision = $compania['mision'];
                        //$check_tildes = strpos($mision, 'tilde;');
                        $check_entities = strpos($mision, '&lt;');
                        // si se encuentran &lt primero
                        if ($check_entities !== false){
                             // encontro &lt
                            $mision = html_entity_decode($mision);
                            //$mision = strip_tags($mision); 
                            echo $mision;
                            // html_entity_decode convierte codigo a etiquetas
                            //que el navegador usa para formatear la pagina
                        }
                        else if (strstr($mision, 'tilde;') || strstr($mision, 'acute;')){
                            echo $mision;
                        }
                        else {
                            $mision = htmlentities(strip_tags($mision));
                            // no encontro &Lt, deberia de quitarle htmlentities
                            echo $mision;
                        }
                        
                        ?>
                        </p>

                        <hr>

                        <h2>Descripcion</h2>
                        <p>
                        <?php
                        $servicio = $compania['servicio'];
                        $check_entities = strpos($servicio, '&lt;');
                        // si se encuentra &lt primero
                        if ($check_entities !== false){
                            $servicio = html_entity_decode($servicio);
                            $servicio = ucfirst($servicio);
                            echo $servicio;
                        }
                        else if (strstr($servicio, 'tilde;') || strstr($servicio, 'acute;')){
                            echo $servicio;
                        }
                        else {
                            $servicio = htmlentities(strip_tags($servicio));
                            $servicio = ucfirst($servicio);
                            echo $servicio;
                        }
                        ?>       
                        </p>

                        <hr>
                    </div>
                </div>
                <!-- End Left Inner -->
                
                <!-- Right Inner -->
                <div class="col-md-5"> 
                    <div class="right-inner">
                        <h3>Catalogo</h3>
                        <div class="row"><!-- Begin pictures -->
                            
                            <?php
                            foreach ($photos as $photo){
                                $descripcion = $photo['descripcion'];
                                $fotoid = $photo['fotoid'];
                                $url_foto = $photo['foto'];
                                //aun cuando son el mismo codigo
                                echo "<div class=\"col-sm-4\">";  
                                echo "<a href=\"https://construcali.com/catalogos.php?content=estafoto&fotoid=$fotoid\"><img src=\"$url_foto\" width=\"100\" height=\"120\" alt=\"$descripcion\"></a>";
                                echo "</div>";   
                            }
                            ?>    
                        </div>           
                        <div class="overflow-h">
                            <ul class="social-icons">
                                <li><a class="social_facebook" data-original-title="Facebook" href="<?php echo $facebook; ?>" target="_blank"></a></li>
                                <li><a class="social_linkedin" data-original-title="Linkedin" href="<?php echo $linkedin ?>" target="_blank"></a></li>
                                <li><a class="social_twitter" data-original-title="Twitter" href="<?php echo $twitter ?>" target="_blank"></a></li>
                            </ul>
                          
                        </div> 
                        <hr>

                        <ul class="list-unstyled save-job">
                            
                            <?php
                             if(!empty($portafolio)){
                                echo "<li><i class=\"fa fa-download\"></i>";
                                echo "<a href=\"$portafolio\" alt=\"portafolio de la empresa\" target=\"_blank\">Portafolio (pdf)</a></li>";
                                }    
                            ?>
                            
                        </ul>    

                        <hr> 
                        <!-- Contacts -->
                        <header>Contactar <?php if (isset($mensaje_enviado)) echo $mensaje_enviado; ?></header>
                        <form action="empresas.php?content=cotizar" method="post" id="contactarEmpresa" class="sky-form">
                        <div class="row">                 
                            
                            <div class="form-group">
                                <label class="label">Message</label>
                                <div class="col-sm-12">
                                    <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="4" name="message" id="message" class="form-control" <?php if ($focus == 1) echo 'autofocus'; ?>></textarea>
                                </div>
                            </div>
                            <?php
                            echo "<input type=\"hidden\" name=\"empresaid\" id=\"empresaid\" value=\"$empresaid\">"; //esta es la empresa a la que se contacta

                            echo "<input type=\"hidden\" name=\"respondonid\" id=\"respondonid\" value=\"$usuarioid\" />"; //este es el usuario que contacta la empresa
                            ?>                       
                            <div class="col-sm-12">
                            <button type="submit" class="btn-u btn-u-green">Enviar mensaje</button>
                            </div>
                        </form>
                            <div class="col-sm-12 overflow-h" id="contactarEmpresa-respuesta">
                                
                            </div>
                        </div>    
                         
                        <hr>
                        <!-- End Contact -->     

                        <h3>Informacion</h3>
                        <div class="row">
                            <!-- Begin Overview -->
                            <div class="col-sm-6">
                                <div class="overview">
                                    <i class="fa fa-briefcase"></i>
                                    <div class="overflow-h">
                                        <?php 
                                        echo "<small>".$compania['contacto']."</small>";
                                        ?>
                                        <div class="progress progress-u progress-xxs">
                                            <div style="width: 92%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="92" role="progressbar" class="progress-bar progress-bar-u">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- End Overview -->

                            <!-- Begin Overview -->
                            <div class="col-sm-6">
                                <div class="overview">
                                    <i class="fa fa-phone"></i>
                                    <div class="overflow-h">
                                        <?php 
                                        echo "<small>".$compania['telefono']."</small>";
                                        ?>
                                        <div class="progress progress-u progress-xxs">
                                            <div style="width: 77%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-u">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- End Overview -->
                        </div>

                        <div class="row margin-bottom-20">
                            <!-- Begin Overview -->
                            <div class="col-sm-6">
                                <div class="overview">
                                    <i class="fa fa-globe"></i>
                                    <div class="overflow-h">
                                        <?php
                                        $url = $compania['url'];
                                        echo "<small><a href=\"$url\" target=\"_blank\">Pagina web</a></small>";
                                        ?>
                                        <div class="progress progress-u progress-xxs">
                                            <div style="width: 88%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="88" role="progressbar" class="progress-bar progress-bar-u">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- End Overview -->
                            
                            <!-- Begin Overview -->
                            <div class="col-sm-6">
                                <div class="overview">
                                    <i class="fa fa-map-marker"></i>
                                    <div class="overflow-h">
                                        <?php
                                        $calle = trim($compania['direcion']); 
                                        $calle = str_replace(' ', '+', $calle);
                                        $calle = str_replace('#', '%23', $calle);
                                        $calle = str_replace('|', '%7C', $calle);
                                        $calle = str_replace(',', '%2C', $calle);
                                        $address = $calle."%2C+".$compania['ciudad']."%2C+".$compania['departamento'].'%2C+Colombia';
                                        echo "<small><a href=\"https://www.google.com/maps/search/?api=1&query={$address}\" target=\"_blank\">".$compania['direcion'].", ".$compania['ciudad'].", ".$compania['departamento']."</a></small>";
                                        ?>    
                                        <div class="progress progress-u progress-xxs">
                                            <div style="width: 76%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="76" role="progressbar" class="progress-bar progress-bar-u">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- End Overview -->
                        </div>

                        <!-- Pie Chart Progress Bar - Direcion     
                        <div class="row margin-bottom-20">
                            <div class="col-sm-12">
                                <div id="map">
                    
                                </div>
                            </div>
                        </div>    
                        End Pie Chart Progress Bar -->
                        <hr> 
                        <!-- <a href="#"><button type="button" class="btn-u btn-block">Seguir esta Empresa</button></a> -->
                    </div>   
                </div>
                <!-- End Right Inner -->
            </div>    
        </div>   
    </div>   
    <!--=== End Job Description ===-->