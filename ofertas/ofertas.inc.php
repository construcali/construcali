    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
    <link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Tablero</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="ofertas.php">Ofertas</a></li>
                <li><a href="usuarios.php">Tablero</a></li>
                <li><a href="home.php?content=logout"> Salir</a></li>
            </ul>
        </div><!--/end container-->
</div>
<!--=== End Breadcrumbs ===-->
<!--=== Profile ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <!-- <img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/LogoCasco.png" alt=""> imagen anterior img1-md.jpg -->
                <h4><?php 
                        if (isset($nombreUsuario)){
                            echo 'Bienvenido '.$nombreUsuario;
                    }
                    ?>
                </h4>
                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <?php
                     if (!empty($sihayempresaid)){
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php\"><i class=\"fa fa-bar-chart-o\"></i>Tablero</a></li>";
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php?content=empresa\"><i class=\"fa fa-pencil\"></i>Edite su Empresa</a></li>";

                           }else{
                    ?> 
                    <li class="list-group-item">
                    <?php 
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php\"><i class=\"fa fa-bar-chart-o\"></i>Tablero</a></li>";
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php?content=empresa\"><i class=\"fa fa-user\"></i>Vincule su Empresa</a></li>";
                           }
                    ?>
                    </li>
                    <!--
                    <li class="list-group-item">
                        <a href="usuarios.php?content=presupuestar"><i class="fa fa-cubes"></i> Presupuestar</a>
                    </li>
                    -->
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizacion"><i class="fa fa-cubes"></i> Cotizar</a>
                    </li>
                    <li  class="list-group-item">
                        <a href="usuarios.php?content=productos"><i class="fa fa-file"></i>Anunciar</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=correo"><i class="fa fa-envelope"></i> Correo</a>
                    </li>                                         
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Actividad</a>
                    </li>
                    <li  class="list-group-item">
                        <a href="usuarios.php?content=premio"><i class="fa fa-file"></i>Premios <?php if (isset($points))echo ' ('.$points.')'; ?></a>
                    </li>                                                                                 
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ajustes"><i class="fa fa-cog"></i> Ajustes</a>
                    </li>                  
                </ul>  

                <hr>
                <a href="home.php?content=logout" role="button" class="btn-u btn-u-default btn-u-sm btn-block">Salir</a>
            </div>
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9">
                <div class="profile-body">
                    <!--Service Block v3-->
                    <?php  if (isset($mensaje)) echo $mensaje; ?>
                    <!-- Tab v1 -->                
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#ofertas" data-toggle="tab">Ofertas</a></li>
                        <li><a href="#nuevaoferta" data-toggle="tab">Nueva oferta</a></li>
                        <li><a href="#venderProducto" data-toggle="tab">Vender</a></li>
                    </ul>                
                    <div class="tab-content"> 
                        <div class="tab-pane fade in active" id="ofertas"> <!-- Empieza ofertas -->
                             <div class="row">
                             <?php
                                foreach ($promociones as $promocion) {
                                    $empresaid = $promocion['empresaid'];
                                    $productoid = $promocion['productoid'];
                                    $descripcion = $promocion['descripcion'];
                                    $titulo = $promocion['titulo'];
                                    $catid = $promocion['categoria'];
                                    $precio = $promocion['precio'];
                                    $unidad = $promocion['unidad'];

                                    $url = $promocion['url'];
                                    $url = nl2br($url);
                                    //$titulo = substr($titulo,0,60);
                                    $titulo = trim($titulo);
                                    //$titulo = nl2br($titulo);
                                    $descripcion = substr($descripcion, 0,200);
                                    $descripcion = trim($descripcion);
                                    $descripcion = nl2br($descripcion);
                                    $fecha = $main->get_fecha(promociones,$productoid);
                                    $empresa = $main->con_casilla(empresa,companies,empresaid,$empresaid);
                                    $ciudad = $main->con_casilla(ciudad,companies,empresaid,$empresaid);
                                    //htmlentities
                                    //$titulo = htmlentities($titulo); esto se estaba tirando la presentacion del titulo
                                    //$descripcion = htmlentities($descripcion);
                                    $empresa = htmlentities($empresa);
                                    $ciudad = htmlentities($ciudad);
                                    #informacion del usuario
                                    $usuarioid = $promocion['usuarioid'];
                                    $main->entrar();
                                    $anunciante = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
                                    $main->login();
                                ?>
                                    <div class="col-md-6 sm-margin-bottom-20">
                                        <a href="ofertas.php?content=veroferta&ofertaid=<?php echo $productoid; ?>">
                                            <img class="full-width img-responsive" src="<?php echo $url; ?>" alt="Foto de la oferta" id="<?php echo $productoid; ?>">
                                        </a>
                                    </div>
                                    <!-- La otra columna de 6 spacios -->
                                    <div class="col-sm-6 sm-margin-bottom-20" id="<?php echo 'photo'.$productoid; ?>">
                                        <div class="profile-blog">
                                            <div class="name-location">
                                                <strong><a href="ofertas.php?content=veroferta&ofertaid=<?php echo $productoid; ?>"><?php echo $titulo; ?></a></strong>
                                            </div>
                                            <?php 
                                            if (!empty($unidad)){
                                            ?>
                                                <ul class="list-inline share-list">
                                                <li><i class="fa fa-cubes"></i><a href="#"><?php echo $unidad; ?></a></li>
                                                <li><i class="fa fa-dollar"></i><a href="#"><?php echo number_format($precio,0,',',','); ?></a></li>
                                                <li><i class="fa fa-user"></i><?php echo $anunciante; ?></li>
                                            </ul>
                                            <?php
                                            }
                                            ?>
                                            
                                            <div class="clearfix margin-bottom-20"></div>    
                                            <p><?php echo $descripcion; ?></p>
                                            <span><i class="fa fa-briefcase"></i><a href="<?php echo 'empresas.php?content=estaempresa&id='.$empresaid; ?>"><?php echo $empresa ?></a></span>
                                            <hr>
                                            <ul class="list-inline share-list">
                                                <li><i class="fa fa-calendar"></i><a href="#"><?php echo $fecha; ?></a></li>
                                                <li><i class="fa fa-map-marker"></i><a href="#"><?php echo $ciudad; ?></a></li>
                                                <li class="rectangulo"><i class="fa fa-reply"></i><a href="<?php echo $productoid; ?>">Responder</a></li>
                                            </ul>
                                            <!-- Aqui va la caja para responder la oferta -->
                                            <form action="foros.php?content=pubcomentario" class="sky-form resOferta" method="post" id="comentar<?php echo $productoid; ?>">
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
                                            <div id="sky-formRespuesta"></div>
                                        </div>
                                    </div>
                                <?php
                                echo "</div><div class=\"row margin-bottom-20\">";
                                }
                                ?>
                            </div>
                            <!-- End profile oferta -->
                            <!-- Paginacion-->
                            <div class="text-center">
                                <ul class="pagination">
                                    <?php 
                                        echo "<li><a href=\"ofertas.php?content=paginacion&page=$thispage\">&laquo;</a></li>";
                                    if ($totpages > 1)
                                        {
                                            $bar = '';
                                            for($page = 1; $page < $totpages; $page++)
                                                {
                                                    if($page == $thispage)
                                                    { 
                                                        $bar .= "<li><a href=\"ofertas.php?content=paginacion&page=$page\">$page</a></li>";
                                                    }else
                                                    {
                                                $bar .= "<li><a href=\"ofertas.php?content=paginacion&page=$page\">$page</a></li>";
                                                    }      
                                                }
                                        }
                                                echo $bar;
                                    if ($thispage < $totpages)
                                    { 
                                        $page = $totpages;
                                        echo "<li><a href=\"ofertas.php?content=paginacion&page=$page\">&raquo;</a></li>";
                                    } 
                                    ?>
                                </ul>                                                            
                            </div>
                        </div>
                        <!-- termina ofertas -->
                        <!-- nueva oferta  -->
                        <div class="tab-pane fade in" id="nuevaoferta">
                                <div class="row">
                                    <div class="col-sm-12">
                                            <form enctype="multipart/form-data" action="ofertas.php?content=subiroferta" method="post" class="sky-form" id="subirOferta">
                                                
                                                <fieldset>
                                                    <section>
                                                        <label class="label">Titulo</label>
                                                        <label class="input">
                                                            <input type="text" name="titulo" id="tituloCorreoEmpresas" maxlength="40">
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Enviar a Empresas en la Categoria de:</label>
                                                        <label class="select">
                                                            <select name="categoria">
                                                                <?php
                                                                    foreach ($categorias as $categoria)
                                                                    {
                                                                        $catid = $categoria['catid'];
                                                                        $category = $categoria['categoria'];
                                                                        $category = htmlentities($category);
                                                                        $catArray[$catid] = $category;    
                                                                    }
                                                                    asort($catArray);
                                                                    foreach ($catArray as $indicador => $valor){
                                                                    echo "<option value=\"$indicador\">$valor</option>";
                                                                } //closes for each
                                                                ?>
                                                            </select>
                                                            <i></i>
                                                        </label>
                                                    </section>
                                                    
                                                    <section>
                                                        <label class="label">Una Foto</label>
                                                        <label for="file" class="input input-file">
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                                            <div class="button"><input type="file" id="file" name="presentacion" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                                        </label>
                                                    </section>                  
                                                        
                                                    <section>
                                                        <label class="label" id="mensajeCorreo">Escriba un correo masivo de menos de 500 caracteres</label>
                                                        <label class="textarea">
                                                            <!-- <i class="icon-prepend fa fa-user"></i>
                                                            <i class="icon-append fa fa-asterisk"></i> -->
                                                            <textarea rows="3" name="oferta" id="oferta" placeholder="Describa productos o servicios, precios y duracion de la oferta"></textarea>
                                                              
                                                        </label>
                                                    </section>
                                                    <button type="submit" class="btn-u text-center">Enviar Correo Masivo Empresarial</button>
                                                </fieldset>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            <!-- termina nueva oferta -->
                            <!-- empiezaa Vender -->
                            <div class="tab-pane fade in" id="venderProducto">
                                <div class="row">
                                    <form class="sky-form" method="post" action="ofertas.php?content=vender" enctype="multipart/form-data" id="clasificadoProductos">
                                     <div class="col-md-12">
                                        <div class="col-md-6">
                                            <section>
                                                <label class="label">Titulo</label>
                                                <label class="input">
                                                    <input type="text" name="titulo" id="vender_titulo placeholder="Que Vende?" maxlength="150">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="col-md-3">
                                            <section>
                                                <label class="label">Unidad</label>
                                                <label class="select">
                                                    <select name="unidad">
                                                        <option value="un">Unidad(es)</option>
                                                        <option value="m">Metro</option>
                                                        <option value="ml">Metro Lineal</option>
                                                        <option value="m2">Metro Cuadrado</option>
                                                        <option value="m3">Metro Cubico</option>
                                                        <option value="lbs">Libra(s)</option>
                                                        <option value="kg">Kilogramo(s)</option>
                                                        <option value="toneladas">Toneladas</option>
                                                        <option value="bultos">Bultos</option>
                                                        <option value="rollos">Rollos</option>
                                                        <option value="galones">Galones</option>
                                                    </select>
                                                    <i></i>
                                                </label>
                                            </section>                          
                                        </div>
                                        <div class="col-md-3">
                                            <section>
                                                <label class="label">Precio</label>
                                                <label class="input">
                                                    <input type="text" name="precio" maxlength="11" size="15" id="precio">
                                                    
                                                </label>
                                            </section>                          
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-7">
                                            <section>
                                                <label class="label">Foto</label>
                                                     <label for="file" class="input input-file">
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                                            <div class="button"><input type="file" id="file" name="presentacion" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                                </label>
                                            </section>              
                                        </div>
                                        <div class="col-md-5">
                                            <section>
                                                <label class="label">Categoria</label>
                                                <label class="select">
                                                    <select name="categoria">
                                                                <?php
                                                                    foreach ($categorias as $categoria)
                                                                    {
                                                                        $catid = $categoria['catid'];
                                                                        $category = $categoria['categoria'];
                                                                        $category = htmlentities($category);
                                                                        $catArray[$catid] = $category;    
                                                                    }
                                                                    asort($catArray);
                                                                    foreach ($catArray as $indicador => $valor){
                                                                    echo "<option value=\"$indicador\">$valor</option>";
                                                                } //closes for each
                                                                ?>
                                                            </select>
                                                    <i></i>
                                                </label>
                                            </section>                              
                                        </div>
                                        
                                        <div class="col-md-12">
                                                
                                            <section>
                                                <label class="label" id="errorVender">Describa los materiales/productos/maquinaria que ofrece</label>
                                                <label class="textarea">
                                                    <textarea rows="3" name="oferta" id="vender_item"></textarea>
                                                </label>
                                            </section>
                                            <div>
                                            <button type="submit" class="btn-u" id="botonVenderProducto">Vender</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- termina Vender -->
                    </div>
                </div>
                <!-- End Tab v1 -->
                </div>
            </div>
            <!-- End Profile Content -->            
        </div>
    </div><!--/container-->    
    <!--=== End Profile ===-->