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
		$result_req = $main->conseguir_los_anuncios($offset,$recordsperpage);
		//contar los renglones de productos y servicios
		$requeridas = array();
		$i=0;
		while ($servicio = mysql_fetch_array($result_req,MYSQL_ASSOC)){
            $productoid = $servicio['productoid'];
            //de que tabla viene
            if ($servicio['tipo'] == 'articulo'){
            	$requeridas[$i]['anouncement'] = $main->con_casilla(producto,productos,productoid,$productoid);
            }
            elseif ($servicio['tipo'] == 'labor'){
            	$requeridas[$i]['anouncement'] = $main->con_casilla(servicio,servicios,productoid,$productoid);//el nombre de este index cambia en cada tabla
            }
            $requeridas[$i]['titulo'] = $servicio['titulo'];
            $requeridas[$i]['ciudad'] = $servicio['ciudad'];
            $requeridas[$i]['usuarioid'] = $servicio['usuarioid'];
            $requeridas[$i]['sector'] = $servicio['sector'];
            $requeridas[$i]['fecha'] = $servicio['date'];
            $requeridas[$i]['productoid'] = $servicio['productoid'];
            $requeridas[$i]['clase'] = $servicio['tipo'];
            //conseguir info de la empresa del userid si la hay
            $userid = $servicio['usuarioid'];
            $requeridas[$i]['companyid'] = $main->con_casilla(empresaid,companies,usuarioid,$userid); 
            $main->entrar();
                $requeridas[$i]['nombre'] = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
                $requeridas[$i]['telefono'] = $main->con_casilla(telefono,usuarios,usuarioid,$userid);
                $requeridas[$i]['email'] = $main->con_casilla(email,usuarios,usuarioid,$userid);
            $main->login(); //necesita otra ves entrar a la basde de datos donde esta productos y servicios
                $i++;
        }// cierra el while, termina la recopilacion de la base de datos
        ?>
    
            
                <?php 
                foreach ($requeridas as $requerida) {
                        $titulo = $requerida['titulo']; //titulo del anuncio
                        $ciudad = $requerida['ciudad'];
                        //$ciudad = htmlentities($ciudad);
                        $email_anunciante = $requerida['email']; //titulo del cotizante
                        $anouncement = $requerida['anouncement'];
                        $anouncement = substr($anouncement,0,400);
                        //Quitar UTF-8 del header, poner iso-8859-1, guardar y cargar la pagina
                        //uego quitarlo y poner otra vez UTF-8, guardar y cargar otra vez la pagina
                        
                        $disciplina = $requerida['sector'];
                        $telefono = $requerida['telefono'];
                        $nombre = $requerida['nombre'];
                        
                        $fecha = $requerida['fecha'];
                        $productoid = $requerida['productoid'];
                        //empresaid de quien anuncio, si la hay
                        //revisar si hay empresa del userid
                        $sihaycompanyid = $requerida['companyid'];

                        // revisar si el titulo tiene caracteres especiales
                        $check_entities = strpos($titulo, '&lt;');
                        $check_ene = strpos($titulo, '&ntilde;');

                        if ($check_ene === true){
                            $titulo = $titulo;
                        }else{
                            $titulo = html_entity_decode($titulo);
                        }

                         // conseguir el whatsapp
                        $whatsapp = $main->con_casilla(whatsapp,redessociales,empresaid,$sihaycompanyid);
                        $whatsapp = trim($whatsapp);
                        // replace - for empty space
                        $forwhatsapp = str_replace('-', ' ', $whatsapp);
                        $wsnumber = explode(" ", $forwhatsapp);
                        $whatsapp = implode($wsnumber);
                        $whatsapp = substr($whatsapp,0, 10);
                        $whatsapp = '57'.$whatsapp;

                        // mensaje por whatsapp
                        $mensaje_contacto = 'He visto su clasificado '.$titulo.' en construcali.com y me gustaria mas informacion';
                        
                ?>
                <div class="proximo-clasificado"> 
                    <?php 
                    if ($requerida['clase'] == 'labor'){
                    echo "<h3><a href=\"anuncios.php?content=unservicio&id=$productoid\">$titulo</a></h3>";
                     ?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><i class="fa fa-city"></i><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                        <li><i class="fa fa-whatsapp color-green"></i><?php echo "<a href=\"https://wa.me/+57 {$telefono}\">".$telefono."</a>"; ?></li>
                        <?php
                        if (!empty($sihaycompanyid)){
                            $company = $main->con_casilla(empresa,companies,empresaid,$sihaycompanyid); 
                            echo "<li><a href=\"empresas.php?content=estaempresa&id={$sihaycompanyid}\">
                        $company</a></li>";
                        } 
                        ?>

                    </ul>
                    <div class="overflow-h">
                    <?php
                    echo "<a href=\"anuncios.php?content=unservicio&id=$productoid\">";
                    echo "<img src=\"showservicios.php?id=$productoid\" onerror=\"imgError(this);\" alt=\"$titulo\" width=\"550
                    \" height=\"300\" />";
                    echo "</a>";
                    ?>
                        <div class="overflow-a">
                            <p style="width:70%;margin-top:2%;"><?php echo $anouncement; ?></p>
                            <ul class="list-inline down-ul">
                                <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                                <li><a href="anuncios.php?content=servicios&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                                <li class="rectangulo"><i class="fa fa-reply"></i><?php echo "<a href=\"$productoid\">Responder</a>"; ?></li>
                                <li class="hidden-md hidden-lg"><i class="fa fa-whatsapp color-green"></i><a href="https://wa.me/<?php echo $whatsapp; ?>?text=<? echo urlencode($mensaje_contacto);?>">Contactar</a></li>
                            </ul>
                        </div>
                    <?php
                    }elseif ($requerida['clase'] == 'articulo'){
                    echo "<h3><a href=\"anuncios.php?content=unproducto&id=$productoid\">$titulo</a></h3>";
                     ?>
                    <ul class="list-inline up-ul">
                        <li><i class="fa fa-user"></i><?php echo $nombre; ?></li>
                        <li><i class="fa fa-city"></i><?php echo $ciudad; ?></a></li>
                        <li><i class="fa fa-phone"></i><?php echo $telefono; ?></li>
                        <li><i class="fa fa-whatsapp color-green"></i><?php echo "<a href=\"https://wa.me/+57 {$telefono}\">".$telefono."</a>"; ?></li>
                        <?php 
                        if (!empty($sihaycompanyid)){
                            $company = $main->con_casilla(empresa,companies,empresaid,$sihaycompanyid); 
                            echo "<li><a href=\"empresas.php?content=estaempresa&id={$sihaycompanyid}\">
                        $company</a></li>";
                        }
                        ?>
                    </ul>
                    <div class="overflow-h">
                    <?php
                    echo "<a href=\"anuncios.php?content=unproducto&id=$productoid\">";
                    echo "<img src=\"showproductos.php?id=$productoid\" onerror=\"imgError(this);\" alt=\"<?php echo $titulo;?>\" width=\"550\" height=\"300\" />";
                    echo "</a>";
                    ?>
                        <div class="overflow-a">
                            <p style="width:70%;margin-top:2%"><?php echo $anouncement; ?></p>
                            <ul class="list-inline down-ul">
                                <li><i class="fa fa-calendar"></i><?php echo $fecha ?></li>
                                <li><a href="anuncios.php?content=productos&sector=<?php echo $disciplina; ?>"><?php echo $disciplina; ?></a></li>
                              
                                <li class="rectangulo"><i class="fa fa-reply"></i><?php echo "<a href=\"$productoid\">Responder</a>"; ?></li>
                                <li class="hidden-md hidden-lg"><i class="fa fa-whatsapp color-green"></i><a href="https://wa.me/<?php echo $whatsapp; ?>?text=<? echo urlencode($mensaje_contacto);?>">Contactar</a></li>
                            </ul>
                             </li>
                        </div>
                    <?php
                    } //cierra el if
                    ?>
                    </div> 
                    
                    <form action="responder.php" class="sky-form resAnuncio" method="post" id="comentar<?php echo $productoid; ?>">
                        
                    <section>
                        
                            <label class="textarea">
                                <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="3" name="oferta" id="oferta_<?php echo $productoid; ?>" placeholder="Escriba su respuesta aqui"></textarea>
                            </label>
                    </section>
                    <?php
                    echo "<input type=\"hidden\" name=\"usuarioid\" id=\"respondonid{$productoid}\" value=\"$usuarioid\" />";

                     echo "<input type=\"hidden\" name=\"email\" id=\"email{$productoid}\" value=\"$email_anunciante\" />";   
                     echo "<input type=\"hidden\" name=\"titulo\" id=\"titulo{$productoid}\" value=\"$titulo\" />"; 
                    ?>
                    <button type="submit" class="btn-u btn-u-green">Responder</button>
                    </form>
                    <div class="overflow-h" id="formularioRespuesta<?php echo $productoid; ?>">
                                
                    </div>       
                    
                    <hr> 
                </div>
                <?php
                } //cierra el foreach y id=mas-clasificados
                ?> 
    <?php
        }else{
            exit();
        }
    ?>
