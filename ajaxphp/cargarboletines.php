<?php
session_start();
?>

<!--Beginning Header -->
<?php
	include("modelos/class_paginas.php");
	include("modelos/class_buscados.php");
	$main = new pagina();
	$main->login(); //entrar a base de datos

	// si se ha enviado la pagina desde cargarMasBoletines.js
	if (isset($_GET['page']))
	{	
		// setear recordsperpage y offset
	  	$thispage = (isset ($_GET['page'])) ? $_GET['page'] : 1 ;
		$recordsperpage = 10;
		$offset = ($thispage-1)*$recordsperpage;
		#encuentro los foros
		$foros = $main->con_info_desc(foros,hora,$offset,$recordsperpage);
		$i=0;
		$blogs = array();
		foreach($foros as $foro){
				$productoid = $foro['productoid'];
				$numerodecom = $main->contar_ids(productoid,comentarios,foroid,$productoid);
				$blogs[$i]['numcoment'] = $numerodecom;
				

                $blogs[$i]['productoid'] = $productoid;
                $blogs[$i]['fecha'] =  $main->get_fecha(foros,$productoid);
                $foristaid = $foro['usuarioid'];
                $blogs[$i]['usuarioid'] = $foristaid;
               
                $blogs[$i]['tema'] = $foro['tema'];
                $companyid = $main->con_casilla(empresaid,companies,usuarioid,$foristaid);
                $blogs[$i]['companyid'] = $companyid;
                	if (isset($companyid))
                		$blogs[$i]['logo'] = $main->con_casilla(foto,logos,empresaid,$companyid);
                $main->entrar();
                $blogs[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$foristaid);
                $main->login();
                $i=$i+1;
       			}
       	#termino de poblar el array de blogs
       	# empiezo a mostar todos los blogs
       			foreach($blogs as $blog){
                    $productoid = $blog['productoid'];
                                        
                    $usuarioid = $blog['usuarioid'];
                    $contacto = $blog['nombre'];
                    $fecha = $blog['fecha'];
                    $numcoment = $blog['numcoment'];
                                       
                    $logo = $blog['logo'];
                    $companyid = $blog['companyid'];
                    $tema = $blog['tema'];
                    
                    $servicio = substr($tema,0,300);
                    //revisar si servicio tiene codigos htmlentities o no
                    $check_entities = strpos($servicio, '&lt;');
                    // revisar si check_entities es verdad
                                     
                    if ($check_entities !== false){
                    // encontro &lt
                    $servicio = html_entity_decode($servicio);
                    }
                    else if (strstr($servicio, 'tilde;') || strstr($servicio, 'acute;')){
                    $servicio = $servicio;
                    }else {
                    $servicio = htmlentities(strip_tags($servicio));
                    // no encontro &Lt, derpronto tiene etiquesta <>
                    }
                    ?>
                        <div class="media media-v2">
                        <?php
                        if (empty($logo)){
                        ?>
                        <a class="pull-left" href="#">
                            <img class="media-object rounded-x" src="assets/img/team/LogoCasco.png" alt="">
                        </a>
                        <?php 
                        }else
                        {
                        ?>
                        <a class="pull-left" href="empresas.php?content=estaempresa&id=<?php echo $companyid; ?>">
                        <img class="media-object" width="128px" src="<?php echo "logo/$logo"; ?>" alt="Logo de la Empresa" />
                        </a>
                        <?php
                        }
                        ?>
                        <div class="media-body" id="<?php echo 'intercambio'.$productoid; ?>">
                                          
                        <h4 class="media-heading">
                        <strong><i class="fa fa-user"></i><?php echo $contacto; ?></strong><i class="fa fa-calendar"></i><?php echo $fecha; ?>
                                              
                        </h4>
                        <p>
                            <?php 
                                echo $servicio;
                                               
                            ?>
                                                
                        </p>
                                            
                        <ul class="list-inline results-list pull-left">
                                                <li><i class="fa fa-comments"></i> 
                                                    <?php echo $numcoment."<a href=\"foros.php?content=unforo&foroid=$productoid#comentarios\" id=\"$productoid\" class=\"numcoment\"> Comentarios</a>"; ?> 
                                                </li>
                                            </ul>
                                            <!-- Ir a la pagina del foro --->
                                            <ul class="list-inline results-list pull-right">
                                                <li><a href="foros.php?content=unforo&foroid=<?php echo $productoid; ?>"><i class="expand-list rounded-x fa fa-link"></i></a></li>
                                            </ul>
                                            <ul class="list-unstyled list-inline blog-tags">
                                                <li class="rectangulo">
                                                    <i class="expand-list rounded-x fa fa-reply"></i>
                                                    <?php echo "<a href=\"$productoid\">Responder</a>"; ?>
                                                </li>
                                            </ul> 
                                            <form action="foros.php?content=pubcomentario" class="sky-form resForo" method="post" id="comentar<?php echo $productoid; ?>">
                                            <!-- Esta clase esta en los archivos foros.js y mostrarRectangulo.js -->
                                            <section>
                                                <!-- label class="label">Debe haber ingresado como usuario para poder responder</label -->
                                                    <label class="textarea">
                                                        <i class="icon-append fa fa-comment"></i>
                                                            <textarea rows="3" name="oferta" id="oferta_<?php echo $productoid; ?>" placeholder="Escriba su respuesta aqui"></textarea>
                                                    </label>
                                            </section>
                                            <?php
                                            echo "<input type=\"hidden\" name=\"foroid\" value=\"$productoid\" id=\"foroid\">";  
                                            ?>
                                            <button type="submit" class="btn-u btn-u-default">Responder</button>
                                            </form>
                                            <!-- Aqui se pone la respuesta despues de enviar un comentario -->
                                            <div id="procesarComentario"></div>
                                            <!-- Aqui se cargan los comentarios -->
                                            <div class="media" id="comentarios<?php echo $productoid; ?>">
                                            </div>    
                                            <div class="clearfix"></div>
                                        </div>
                        </div>
    <?php
    	} // cierra foreach, terminoa de mostrar los blogs
	}else {
	   exit();
	}
?>

