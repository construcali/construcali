<?php
session_start();
?>

<?php
	include("../modelos/class_paginas.php");
	$main = new pagina();
	
	$main->login(); //entrar a base de datos 
    if (isset($_GET['page'])){
	//funcion que consigue los clasificados de las tablas de productos y servicios
	    $usuarioid = $_SESSION['usuario'];
		//conseguir la informacion de productos y servicios a la venta
	  	$thispage = (isset ($_GET['page'])) ? $_GET['page'] : 1 ;
		$recordsperpage = 15;
		$offset = ($thispage-1) * $recordsperpage;
		//consigue los clasificados de productos y servicios
        $result_req = $main->conseguir_las_cotizaciones($offset,$recordsperpage);
        // coger las cotizaciones del array $result_req
		$clasificados = array();
        $i=0;
        while ($servicio = mysql_fetch_array($result_req,MYSQL_ASSOC)){
            $productoid = $servicio['productoid'];
            //de que tabla viene
            if ($servicio['tipo'] == 'articulo'){
                $clasificados[$i]['clasificado'] = $main->con_casilla(anuncio,anuncios,productoid,$productoid);
            }
            elseif ($servicio['tipo'] == 'labor'){
                $clasificados[$i]['clasificado'] = $main->con_casilla(anouncement,anouncements,productoid,$productoid);//el nombre de este index cambia en cada tabla
            }
            $clasificados[$i]['titulo'] = $servicio['titulo'];
            $clasificados[$i]['ciudad'] = $servicio['ciudad'];
            $usuarioid = $servicio['usuarioid'];
            $clasificados[$i]['usuarioid'] = $usuarioid;
            //
            $clasificados[$i]['sector'] = $servicio['sector'];
            $clasificados[$i]['fecha'] = $servicio['date'];
            $clasificados[$i]['productoid'] = $productoid;
            $clasificados[$i]['clase'] = $servicio['tipo']; 
            $main->entrar();
                $clasificados[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$usuarioid);
                $clasificados[$i]['email'] = $main->con_casilla(email,usuarios,usuarioid,$usuarioid);
            $main->login();
                $i++;
        } 
        ?>
                <?php 
                foreach ($clasificados as $clasificado) {
                        $titulo = $clasificado['titulo'];
                        $ciudad = $clasificado['ciudad'];
                        $usuarioid = $clasificado['usuarioid'];
                        $descripcion = $clasificado['clasificado'];
                        $descripcion = substr($descripcion,0,400);
                        $disciplina = $clasificado['sector'];
                        $telefono = $clasificado['telefono'];
                        $nombre = $clasificado['nombre'];
                        $fecha = $clasificado['fecha'];
                        $productoid = $clasificado['productoid'];
                         //usar htmlentities para que se vean bien las letras con tildes y enes
                        $titulo = htmlentities($titulo);
                        $ciudad = htmlentities($ciudad);
                        $descripcion = htmlentities($descripcion);
                        //$descripcion = html_entity_decode($descripcion);
                        $nombre = htmlentities($nombre); 
                ?>
                 <div class="inner-results ultimos_servicios">
                    <?php
                    if ($clasificado['clase'] == 'labor'){
                    echo "<h3><a href=\"cotizaciones.php?content=unanouncement&id=$productoid\">$titulo</a></h3>"; ?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><a href="cotizaciones.php?content=anouncements&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                        <li><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                    </ul>
                    <p><?php echo $descripcion; ?></p>
                    <ul class="list-inline down-ul">
                        <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                        <!-- JavaScript para este rectangulo es mostrarRectangulo.js -->
                        <li class="rectangulo"><i class="fa fa-reply"></i><?php echo "<a href=\"$productoid\">Responder</a>"; ?></li>
                    </ul>
                    <hr>   
                </div>
                
                <?php
                }elseif ($clasificado['clase'] == 'articulo'){
                    echo "<h3><a href=\"cotizaciones.php?content=unanuncio&id=$productoid\">$titulo</a></h3>";?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><a href="cotizaciones.php?content=unanuncio&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                        <li><a href="#"><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                    </ul>
                    <p><?php echo $descripcion; ?></p>
                     <!--para responder cotizaciones usar la clase=responder_cotizacones y el codigo de javascript en footer.html linea 359  -->
                    <ul class="list-inline down-ul">
                        <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                        <!-- JavaScript para este rectangulo es mostrarRectangulo.js -->
                        <li class="rectangulo"><i class="fa fa-reply"></i><?php echo "<a href=\"$productoid\">Responder</a>"; ?></li>
                    </ul>
                    <hr> 
                    <!-- -->
                </div>
                <?php
                    }
                ?>
                <!-- Este es formulario de la respuesta para un aununcio -->
                    <form action="responder.php" class="sky-form resAnuncio" method="post" id="comentar<?php echo $productoid; ?>">
                        <!-- Esta id resAnuncio esta en el archivo responderAnuncio.js -->
                    <section>
                        <!-- label class="label">Debe haber ingresado como usuario para poder responder</label -->
                            <label class="textarea">
                                <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="3" name="oferta" id="oferta_<?php echo $productoid; ?>" placeholder="Escriba su respuesta aqui"></textarea>
                            </label>
                    </section>
                    <?php
                    echo "<input type=\"hidden\" name=\"usuarioid\" id=\"respondonid{$productoid}\" value=\"$loginid\" />";

                     echo "<input type=\"hidden\" name=\"email\" id=\"email{$productoid}\" value=\"$email_anunciante\" />";   
                     echo "<input type=\"hidden\" name=\"titulo\" id=\"titulo{$productoid}\" value=\"$titulo\" />"; 
                    ?>
                    <button type="submit" class="btn-u btn-u-green">Responder</button>
                    </form>
                    <div class="overflow-h" id="formularioRespuesta<?php echo $productoid; ?>">
                                
                    </div>       
                    <!-- Aqui se cierra el formulario de la respuesta para un anuncio -->  
                <?php
                } //cierra el foreach 
                ?> 
    <?php
        }else{
            exit();
        }
    ?>
