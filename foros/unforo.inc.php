    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="usuarios.php">Tablero</a></h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=cotizaciones">Mi Actividad</a></li>
            </ul>
        </div>
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">     
        <div class="row blog-page blog-item">
            <!-- Left Sidebar -->
            <div class="col-md-9 md-margin-bottom-60">
            <?php
                $titulo = $foro['titulo'];
                $foristaid = $foro['usuarioid'];
                $fecha = $main->get_fecha(foros,$foroid);
                $numcoment = $main->contar_ids(productoid,comentarios,foroid,$foroid);
                $categoria = $main->con_casilla(categoria,categorias,catid,$foro['catid']);
                $companyid = $main->con_casilla(empresaid,companies,usuarioid,$foristaid);
                $logo = $main->con_casilla(foto,logos,empresaid,$companyid);
                $texto = $foro['tema'];

                // revisar si el titulo tiene caracteres especiales
                if (strstr($titulo, '&lt;')){
                    // encontro &lt
                    $titulo = html_entity_decode($titulo);
                }
                else if (strstr($titulo, 'tilde;') || strstr($titulo, 'acute;')){
                    //$titulo = $titulo;
                    $titulo = html_entity_decode($titulo, ENT_NOQUOTES);
                }else {
                    $titulo = htmlentities(strip_tags($titulo));
                    // no encontro &Lt, derpronto tiene etiquesta 
                }
                // revisar si el texto tiene caracteres htmlentities
                if (strstr($texto, '&lt;')){
                    // encontro &lt
                    $texto = html_entity_decode($texto);
                }
                else if (strstr($texto, 'tilde;') || strstr($texto, 'acute;')){
                    $texto = $texto;
                }else {
                    $texto = htmlentities(strip_tags($texto));
                    // no encontro &Lt, derpronto tiene etiquesta <>
                }

                $main->entrar(); // entrar a servicios
                $nombre = $main->con_casilla(nombre,usuarios,usuarioid,$foristaid);
            ?>
                <!--Blog Post-->        
                <div class="blog margin-bottom-10">
                    <div class="media media-v2">
                         <?php
                        if (empty($logo)){
                            $imgsrc = $main->con_casilla(foto,usuarios_fotos,usuarioid,$foristaid);
                            $pic = (empty($imgsrc)) ? 'assets/img/team/avatar-super-simple.jpg' : 'fotosperfiles/'.$imgsrc; 
                        ?>
                        <a class="pull-left">
                            <img class="media-object" width="128" src="<?php echo $pic; ?>" alt="Logo de la empresa" />
                        </a>
                        <?php
                        }else{
                        ?>
                        <a class="pull-left" href="empresas.php?content=estaempresa&id=<?php echo $companyid; ?>">
                            <img class="media-object" width="128px" src="<?php echo "logo/$logo"; ?>" alt="Logo de la Empresa" />
                        </a>
                        <?php
                            }
                        ?>
                        <div class="media-body" style="text-align:justify">
                            <h4 class="media-heading"><?php echo $titulo; ?> </h4>
                            <p><?php echo $texto; ?></p>
                            <div class="blog-post-tags">
                                <ul class="list-unstyled list-inline blog-info">
                                    <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                                    <li><i class="fa fa-pencil"></i><?php echo $nombre ?></li>
                                    <li><i class="fa fa-comments"></i><?php echo $numcoment ?><a href="#"class="numcoment" id="<?php echo $foroid; ?>"> Comentarios</a></li>
                                    <li>
                                    <i class="fa fa-reply"></i>
                                    <?php echo "<a href=\"#escribirComentario\">Responder</a>"; ?>
                                    </li>
                                </ul>
                                <ul class="list-unstyled list-inline blog-tags">
                                    <li>
                                        <i class="fa fa-tags"></i> 
                                        <a href="#"><?php echo $categoria; ?></a> 
                                    </li>
                                </ul>                                                
                            </div>
                            <!-- Recent Comments
                    hay otra id de de comentario, singular sin s mas abajo en la caja de texto para poner un comentario"
                     -->
                            <div class="media media-v2" id="paginaComentario">
                            <h3 id="comentarios">Comentarios</h3>
                            <?php 
                            foreach($respuestas as $respuesta){
                                $nombre = $respuesta['forista'];
                                $fecha = $respuesta['fecha'];
                                $logo = $respuesta['logo'];
                                $companyid = $respuesta['companyid'];
                                $foristaid = $respuesta['foristaid'];
                            ?>
                            
                                <?php
                                    if (empty($logo)){
                                        $imgsrc = $main->con_casilla(foto,usuarios_fotos,usuarioid,$foristaid);
                                        $pic = (empty($imgsrc)) ? 'assets/img/team/avatar-super-simple.jpg' : 'fotosperfiles/'.$imgsrc;

                                    ?>
                                    <a class="pull-left">
                                        <img class="media-object" width="128px" src="<?php echo $pic; ?>" alt="foto de perfil" />
                                    </a>
                                    <?php 
                                        }else
                                        {
                                    ?>
                                    <a class="pull-left" href="empresas.php?content=estaempresa&id=<?php echo $companyid; ?>">
                                        <img class="media-object" width="128px" src="<?php echo "logo/$logo"; ?>" alt="Foto de perfil" />
                                    </a>
                                    <?php
                                        }
                                    ?>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo "Publicado por ".$nombre."\t"; ?><span><?php echo $fecha; ?> <a href="#escribirComentario">Contestar</a></span></h4>
                                    <p><?php echo html_entity_decode($respuesta['comentario'], ENT_NOQUOTES); ?></p>
                                </div>
                            <hr>
                            <?php
                            }
                            ?>
                            </div>
                            <!-- Empezar Comentarios -->
                            <div class="media" id="comentarios<?php echo $foroid; ?>">
                            </div>
                            <!--Terminar comentarios-->
                            <!-- Comment Form -->
                            <div class="post-comment">
                                <h3><a name="paginaComentario" id="escribirComentario">Nuevo Comentario</a></h3>
                                <form method="post" action="foros.php?content=pubcomentario" id="nuevoComentario">
                                    <label>Mensaje</label>
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-11 col-md-offset-0">
                                            <textarea class="form-control" name="comentario" id="comentario" rows="8"></textarea>
                                           
                                        </div>                
                                    </div>
                                    <?php echo "<input type=\"hidden\" name=\"foroid\" value=\"$foroid\" id=\"foroid\">"; ?>
                                    <p><button class="btn-u" type="submit">Publicar Comentario</button></p>
                                </form>
                            </div>
                            <div id="procesarComentario">
                            </div>
                            <!-- End Comment Form -->  
                        </div>
                    </div><!--/media-->
                   
                    
                </div>
                       

                <hr>
                <!-- Recent Comments -->
            </div>
            <!-- End Left Sidebar -->

            <!-- Right Sidebar -->
            <div class="col-md-3 magazine-page">
                <!-- Search Bar -->
                <div class="headline headline-md"><a class="btn-u btn-block btn-u-green" href="usuarios.php">Tablero</a> </div>
                            
                <!-- End Search Bar -->

                <!-- Posts -->
                <!--/posts-->
                <!-- End Posts -->

                <!-- Tabs Widget -->
                <div class="headline headline-md"><h2>De Su Interes</h2></div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Nuestros Servicios</a></li>
                        <li><a data-toggle="tab" href="#home-2">Enlaces</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                            <p><a href="foros.php" class="btn-u btn-block">Foros</a></p>
                            <p><a id="<?php echo $foroid; ?>" class="btn-u btn-block numcoment">Cargar Comentarios</a></p>
                            <p><a href="foros.php" class="btn-u btn-block">Nuevo Foro</a></p>                        
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <div class="row">
                                <ul class="list-unstyled col-xs-6">
                                    <li><a target="_blank" href="http://issuu.com/ximenavelez/docs/revista_colconstruccion">1ra Revista</a></li>
                                    <li><a target="_blank" href="http://issuu.com/ximenavelez/docs/colconstruccion_segunda_edici__n_-_/1?e=8415614/11091375">2da Revista</a></li>
                                    <li><a target ="_blank" href="https://issuu.com/colconstruccion/docs/colconstruccioned3-5_imprimir">3ra Revista</a></li>
                                    <li><a target="_blank"href="http://placaya.jimdo.com/">Placa Ya</a></li>
                                    <li><a target="_blank" href="http://constructoradcpmoya.jimdo.com/">Constructora</a></li>
                                    <li><a target="_blank" href="http://indimacol.jimdo.com/">Indimacol</a></li>
                                </ul>                        
                                <ul class="list-unstyled col-xs-6">
                                    <li><a target="_blank" href="http://andamioskay.jimdo.com/">Kayonsaa</a></li>
                                    <li><a target="_blank" href="http://enlacespuntoapunto.jimdo.com/">Punto a Punto</a></li>
                                    <li><a target="_blank" href="http://cromalux.jimdo.com/">Tito Pabon</a></li>
                                    <li><a target="_blank" href="http://tecnipinturas.jimdo.com/">Tecnipinturas</a></li>
                                    <li><a href="http://www.shareasale.com/r.cfm?b=499404&u=623714&m=37723&urllink=&afftrack=">Weebly</a></li>
                                    <li><a href="http://www.shopify.com/?ref=colconstruccion-com" target="_blank">Tienda virtual</a></li>
                                </ul>                        
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- End Tabs Widget -->

            </div>
            <!-- End Right Sidebar -->
        </div><!--/row-->        
    </div><!--/container-->     
    <!--=== End Content Part ===-->