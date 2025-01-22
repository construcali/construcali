<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<link rel="stylesheet" href="assets/css/pages/profile.css">
 <!-- CSS Page Style -->
<link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
<!-- CSS -->
<style type="text/css">
    #spinner {
        display: none;
      }

    .resForo {
        display: none;
    }
</style>
<!-- end CSS -->
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Tablero</h1>
            <ul class="pull-right breadcrumb">
                <?php
                    if (isset($_SESSION['empresaid'])){ 
                ?>
                    <li><a href="https://construcali.com/usuarios.php?content=correo">Correo</a></li>
                    <li><a href="ofertas.php"> Ofertas</a></li>
                    <li><a href="cotizaciones.php"> Cotizaciones</a></li>
                <?php
                    }else{
                ?>
                <li><a href="ofertas.php"> Ofertas</a></li>
                <li><a href="cotizaciones.php"> Cotizaciones</a></li>
                <li><a href="usuarios.php?content=profesional">Perfil Profesional</a></li>
          <?php } ?>
            </ul>
        </div><!--/end container-->
    </div>
<!--=== End Breadcrumbs ===-->
 <!--=== Profile ===-->
 <!-- esta clase profile no deja que las categorias tengan cierta distacia del borde
 sin embargo se necesita para que se vean bien las descripciones de las ofertas -->
    <div class="container content profile">	
    	<div class="row">
            <!--Left Sidebar-->
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">  

                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <li class="list-group-item">
                        <a href="usuarios.php?content=correo"><i class="fa fa-envelope"></i> Correo</a>
                    </li> 
                    <?php
                     if (!empty($sihayempresaid)){
                                
                                echo "<li class=\"list-group-item\"><a href=\"usuarios.php?content=empresa\"><i class=\"fa fa-pencil\"></i>Edite su Empresa</a></li>";

                           }else{
                    ?> 
                    <li class="list-group-item">
                    <?php 
                                echo "<a href=\"usuarios.php?content=empresa\"><i class=\"fa fa-user\"></i>Vincule su Empresa</a>";
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

                <!-- Notification -->
                <a href="home.php?content=logout" role="button" class="btn-u btn-u-default btn-u-sm btn-block">Salir</a>
                 
                <!--End Notification-->

                <!--Datepicker-->
               
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9 profile">
                <div class="profile-body margin-bottom-20"> 
                    <!-- Aqui empieza correos, hay que poner data-toggle=tab en cada uno de los enlaces para que se vea la informacion de propuestas -->
                    <!-- Aqui empieza tab-v1 -->
                    <div class="tab-v1">
                        <ul class="nav nav-justified nav-tabs">
                            <li class="active"><a href="#foros" data-toggle="tab">Foros</a></li>
                            <li><a href="#cotizar" data-toggle="tab">Cotizar</a></li>
                            <li><a href="#anuncioproducto" data-toggle="tab">Anunciar</a></li>
                            <li><a href="#presupuestar" data-toggle="tab">Cotizar Lista</a></li>
                        </ul> 
                        <div class="tab-content">
                             <!-- empiezan foros -->
                            <div class="tab-pane fade in active" id="foros">
                            <div class="panel panel-profile"> <!-- id boletines, cargarMasBoletines.js, linea 8 -->
                               
                                <!-- ultimos 10 foros -->
                                <div class="panel-body margin-bottom-50" id="boletines">
                                    <div class="headline"><h2>Boletines</h2></div>
                                    <!-- formulario de publicacion de un boletin -->
                            
                                    <form enctype="multipart/form-data" action="usuarios.php" id="nuevoForo" method="post" class="sky-form">
                                     <section>
                                            <label class="label" id="mensajeForo">Crear publicacion de menos de 300 caracteres</label>
                                                <label class="textarea">
                                                            <!-- <i class="icon-prepend fa fa-user"></i>
                                                            <i class="icon-append fa fa-asterisk"></i> -->
                                                    <textarea rows="3" name="mensaje" id="mensaje" placeholder="Describa productos o servicios, precios y lugar"></textarea>
                                                              
                                                </label>
                                    </section>    
                                    <button type="submit" id="botonPublicarBoletin" class="btn-u text-center">Publicar</button>
                                    </form>
                                    <div id="procesarForo"></div>
                                    
                                    <!-- se termina formulario de publicacion de un boletin -->  
                                <?php foreach($blogs as $blog){
                                        $productoid = $blog['productoid'];
                                        
                                        $usuarioid = $blog['usuarioid'];
                                        $contacto = $blog['nombre'];
                                        $fecha = $blog['fecha'];
                                        $numcoment = $blog['numcoment'];
                                        $categoria = $blog['categoria'];
                                        $catid = $blog['catid'];
                                        $logo = $blog['logo'];
                                        $companyid = $blog['companyid'];
                                        //$telefono = $blog['telefono']; asunto de privacidad
                                        //$ciudad = $blog['ciudad']; innecesario
                                        // revisar si titulo tiene codigos htmlentities o no

                                        $tema = $blog['tema'];
                                        $largo_tema = strlen($tema);
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
                                                if ($largo_tema > 300) echo '... <a href="foros.php?content=unforo&foroid='.$productoid.'">Ver mas</a>'; 
                                            ?>
                                                
                                            </p>
                                            
                                            <ul class="list-inline results-list pull-left">
                                                <li><i class="fa fa-comments"></i> 
                                                    <?php echo $numcoment."<a href=\"foros.php?content=unforo&foroid=$productoid#comentarios\" id=\"$productoid\" class=\"numcoment\"> Comentarios</a>"; ?> 
                                                </li>
                                            </ul>
                                            <!--
                                            <ul class="list-inline results-list pull-right">
                                                <li><a ><i class="expand-list rounded-x fa fa-reply"></i></a></li>
                                            </ul>
                                            -->
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
                                        } // cierra foreach
                                    ?>
                                </div>
                            </div>
                            <!-- cierra id=boletines, buton temporal para cargar mas boletines -->
                            <div id="masBoletinesBoton">
                                <button id="masBoletines" data-pagina="1">Mas Anuncios</button>
                            </div>
                            <div id="spinner">
                                <img src="/assets/img/spinner.gif" width="50" height="50" />
                            </div> 
                            </div>
                            <!-- terminan foros -->
                            <!-- empieza cotizar  -->
                            <div class="tab-pane fade in" id="cotizar"> <!-- cotizar un servicio -->
                                <div class="row">
                                    <form class="sky-form" method="post" action="usuarios.php?content=servicios" id="serviciosCotizacion">
                                    <div class="col-md-12">
                                        <section>
                                            <label class="label">Titulo</label>
                                            <label class="input">
                                                <input type="text" name="titulo" id="subjecto" placeholder="Ejemplo: Construccion de un 2do piso" maxlength="150">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="col-md-5">
                                        <section>
                                            <label class="label">Categoria</label>
                                                <label class="select">
                                                    <select name="sector">
                                                        <?php
                                                            foreach ($categorias as $categoria) {
                                                                //$catid = $categoria['catid'];
                                                                $clase = $categoria['categoria'];
                                                                echo "<option value=\"$clase\">$clase</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                <i></i>
                                            </label>
                                        </section>                               
                                    </div>
                                    <div class="col-md-4">
                                        <section>
                                            <label class="label">Departamento</label>
                                            <label class="select">
                                                <select name="departamento">
                                                    <?php
                                                        foreach ($departamentos as $deptid => $departamento) {
                                                            
                                                            echo "<option value=\"$deptid\" estado=\"$departamento\">$departamento</option>";
                                                        }
                                                    ?>
                                                        
                                                    </select>
                                                <i></i>
                                            </label>
                                        </section>              
                                    </div>
                                    <div class="col-md-3">
                                        <section>
                                            <label class="label">Ciudad</label>
                                            <label class="input">
                                                <input type="text" name="ciudad" class="ciudad" id="city" value="<?php echo $city; ?>" >
                                                
                                            </label>
                                        </section>                          
                                    </div>
                                    <div class="col-md-12">
                                        <section>
                                            <label class="label">Describa el servicio o la obra que necesita</label>
                                            <label class="textarea">
                                                <textarea rows="3" name="descripcion" id="descripcion"></textarea>
                                            </label>
                                        </section>
                                        <div>
                                        <button type="submit" class="btn-u" id="botonCotizarServicios">Cotizar</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                            <!-- termina cotizar -->
                            <!--- Empieza anunciar un producto. Js.: cotizarAnunciar.js -->
                            <div class="tab-pane fade in" id="anuncioproducto">
                                <div class="row">
                                    <form class="sky-form" method="post" action="usuarios.php?content=productos" enctype="multipart/form-data" id="clasificadoProductos">
                                     <div class="col-md-12">
                                        <div class="col-md-8">
                                            <section>
                                                <label class="label">Titulo</label>
                                                <label class="input">
                                                    <input type="text" name="titulo" id="title" placeholder="Que Vende?" maxlength="150">
                                                </label>
                                            </section>
                                        </div>
                                        <div class="col-md-4">
                                            <section>
                                                <label class="label">Telefono</label>
                                                <label class="input">
                                                    <input type="text" value="<?php echo $telephone; ?>" name="telephone" id="telephone" class="phone">
                                                    
                                                </label>
                                            </section>                          
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-5">
                                            <section>
                                                <label class="label">Categoria</label>
                                                <label class="select">
                                                    <select name="sector">
                                                    <?php
                                                        foreach ($categorias as $categoria) {
                                                            //$catid = $categoria['catid'];
                                                            $clase = $categoria['categoria'];
                                                            echo "<option value=\"$clase\">$clase</option>";
                                                        }
                                                    ?>
                                                    </select>
                                                    <i></i>
                                                </label>
                                            </section>                              
                                        </div>
                                        <div class="col-md-4">
                                            <section>
                                                <label class="label">Departamento</label>
                                                <label class="select">
                                                    <select name="departamento">
                                                    <?php
                                                        foreach ($departamentos as $deptid => $departamento) {

                                                            echo "<option value=\"$deptid\" estado=\"$departamento\">$departamento</option>";
                                                        }
                                                    ?>
                                                        
                                                    </select>
                                                    <i></i>
                                                </label>
                                            </section>              
                                        </div>
                                        <div class="col-md-3">
                                            <section>
                                                <label class="label">Ciudad</label>
                                                <label class="input">
                                                    <input type="text" name="ciudad" value="<?php echo $city; ?>" class="ciudad" id="municipio">
                                                    
                                                </label>
                                            </section>                          
                                        </div>
                                        <div class="col-md-12">
                                            <section>
                                                <label class="label">Foto</label>
                                                    <label for="file" class="input input-file">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
                                                    <div class="button"><input type="file" id="file" name="picture" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                                </label>
                                            </section>     
                                            <section>
                                                <label class="label" id="errorProductos">Describa los materiales/productos/maquinaria que ofrece</label>
                                                <label class="textarea">
                                                    <textarea rows="3" name="productos" id="productos"></textarea>
                                                </label>
                                            </section>
                                            <div>
                                            <button type="submit" class="btn-u" id="botonAnunciarProductos">Anunciar</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Termina anunciar un producto -->
                            <!-- Empieza Cotizar Lista de Materiales-->
                            <div class="tab-pane fade in active" id="presupuestar">
                                <div class="row">
                                <div class="col-md-12" id="confirmacion">
                                <?php
                                if (isset($mensaje)){echo $mensaje;}
                                ?>
                                </div>
                                <form method="post" action="usuarios.php?content=cotizacion"class="sky-form" id="materialesCotizacion">
                                    <div class="col-md-12">
                                        <section>
                                            <label class="label">Titulo</label>
                                            <label class="input">
                                                <input type="text" name="titulo" id="titulo" placeholder="Ejemplo: Requiero remodelar la cocina" maxlength="150">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="col-md-5">
                                        <section>
                                            <label class="label">Categoria</label>
                                            <label class="select">
                                                <select name="sector" id="sector">
                                                <?php
                                                    foreach ($categorias as $categoria) {
                                                        $catid = $categoria['catid'];
                                                        $clase = $categoria['categoria'];
                                                        echo "<option value=\"$catid\">$clase</option>";
                                                    }
                                                ?>
                                                </select>
                                                <i></i>
                                            </label>
                                        </section>                              
                                    </div>
                                    <div class="col-md-4">
                                        <section>
                                            <label class="label">Departamento</label>
                                            <label class="select">
                                                <select name="departamento">
                                                    <?php
                                                        foreach ($departamentos as $deptid => $departamento) {
                                                            
                                                            echo "<option value=\"$deptid\" estado=\"$departamento\">$departamento</option>";
                                                        }
                                                    ?>
                                                        
                                                    </select>
                                                <i></i>
                                            </label>
                                        </section>              
                                    </div>
                                    <div class="col-md-3">
                                        <section>
                                            <label class="label">Ciudad</label>
                                            <label class="input">
                                                <input type="text" value="<?php echo $ciudad; ?>" name="ciudad" id="ciudad" class="ciudad">
                                            </label>
                                        </section>                          
                                    </div>
                                    <div class="col-md-4">
                                        <section>
                                            <label class="label">Telefono</label>
                                            <label class="input">
                                                <input type="text" placeholder="Ejemplo: 300-345-678" value="<?php echo $telefono; ?>" name="telefono" id="telefono" class="phone">
                                                
                                            </label>
                                        </section>                          
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row"><!-- materiales -->
                                            <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo1" id="insumo1" placeholder="Material ej: Bultos de cemento"></label></section>
                                            <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio1" id="cantidad1" placeholder="Cantidad ej: 20"></label></section>
                                            <section class="col-sm-4"><label class="select"><select name="unidad1">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                            <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                            <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                            <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                            <option name="pliegos">Pliegos</option></select><i></i></label></section>

                                            <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo2" id="insumo2" placeholder="Material ej: Bultos de cemento"></label></section>
                                            <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio2" id="cantidad2" placeholder="Cantidad ej: 20"></label></section>
                                            <section class="col-sm-4"><label class="select"><select name="unidad2">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                            <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                            <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                            <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                            <option name="pliegos">Pliegos</option></select><i></i></label></section>

                                            <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo3" id="insumo3" placeholder="Material ej: Bultos de cemento"></label></section>
                                            <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio3" id="cantidad3" placeholder="Cantidad ej: 20"></label></section>
                                            <section class="col-sm-4"><label class="select"><select name="unidad3">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                            <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                            <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                            <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                            <option name="pliegos">Pliegos</option></select><i></i></label></section>

                                            <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo4" id="insumo4" placeholder="Material ej: Bultos de cemento"></label></section>
                                            <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio4" id="cantidad4" placeholder="Cantidad ej: 20"></label></section>
                                            <section class="col-sm-4"><label class="select"><select name="unidad4">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                            <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                            <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                            <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                            <option name="pliegos">Pliegos</option></select><i></i></label></section>

                                            <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo5" id="insumo5" placeholder="Material ej: Bultos de cemento"></label></section>
                                            <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio5" id="cantidad5" placeholder="Cantidad ej: 20"></label></section>
                                            <section class="col-sm-4"><label class="select"><select name="unidad5">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                            <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                            <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                            <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                            <option name="pliegos">Pliegos</option></select><i></i></label></section>
                                        </div><!-- end materiales -->
                                        <div>
                                            <button type="submit" id="botonCotizarMateriales" class="btn-u">Cotizar</button>
                                        </div>
                                    </div>   
                                </form>
                                </div>
                            </div>
                            <!-- Termina enviar lista de materiales -->
                            
                            <!-- Aqui empieza anunciar un servicio -->
                            
                            <!-- Aqui termina anunciar un servicio --> 
                        </div>
                    </div>
                    <!-- Aqui termina Tab V1 -->
                    <!-- termina correos -->
                    
                    <!-- Paginacion-->
                    
                    <!-- End Paginacion -->
                </div>
                
            </div>
                      
        </div><!--/end row-->
    </div>		
    <!--=== End Profile ===-->