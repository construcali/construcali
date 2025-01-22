    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- esta pagina la llaman en la linea 439 de usuarios.php -->
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Tablero</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=cotizacione">Mi Actividad</a></li>
            </ul>
        </div><!--/end container-->
</div>
<!--=== End Breadcrumbs ===-->
<!--=== Profile ===-->
    <div class="container content profile">	
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizacion"><i class="fa fa-cubes"></i> Cotizar</a>
                    </li>
                   
                    <?php
                     if (!empty($sihayempresaid)){
                    ?>
                    <li class="list-group-item"><a href="usuarios.php?content=empresa"><i class="fa fa-pencil"></i>Mi Empresa</a></li>
                    <li class="list-group-item"><a href="cotizaciones.php?content=cotizaciones"><i class="fa fa-cubes"></i>Cotizaciones</a></li>
                    <?php
                        }else{
                    ?> 
                    <li class="list-group-item"><a href="usuarios.php?content=empresa"><i class="fa fa-pencil"></i>Vincule su Empresa</a></li>         
                    <?php 
                           }
                    ?>
                    <li class="list-group-item">
                        <a href="foros.php"><i class="fa fa-users"></i> Foros</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Mis Cotizaciones</a>
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
            
            <!-- Profile Content -->
            <div class="col-md-9">
                <div class="profile-body">
                    <!-- div tab-v1,ul nav nav-tabs,li,div tab-content,div tab-pane -->
                    <div class="tab-v1">
                        <ul class="nav nav-justified nav-tabs">
                        <li class="active"><a href="#editar" data-toggle="tab">Editar</a></li>
                        <li><a href="#catalogos" data-toggle="tab">Catalogo</a></li>
                        <li><a href="#portafoliopdf" data-toggle="tab">Portafolio</a></li>
                        <li><a href="#cambiarLogo" data-toggle="tab">Logo</a></li>
                        <li><a href="#infocontacto" data-toggle="tab">Contacto</a></li>
                        </ul>
                        <div class="tab-content"> 
                        <!-- Aqui empieza empresa -->
                            <div class="tab-pane fade in active" id="editar">
                                <div class="row">
                                    <div class="col-md-12" id="fichaEmpresa">
                                        <?php
                                                echo "<h2 id=\"nombreEmpresa\">".htmlspecialchars($ficha['empresa'])."</h2>";
                                        ?>
                                        <span class="fa fa-pencil" style="cursor:pointer;cursor:hand" id="editarInfoNombreEmpresa"><b> Editar el Nombre de la Empresa</b></span>
                                        <hr>
                                                
                                    </div>
                                    <div class="col-md-12">
                                    <span class="fa fa-pencil" style="cursor:pointer;cursor:hand" id="editarInfoEmpresa"><b>Editar Mision, Servicio y Categoria</b></span> 
                                    </div>
                                    <form class="sky-form" id="actualizarMision">
                                    <div class="col-md-12 esconder" id="newCategory">
                                        <label class="select" for="nuevaCategoria">Nueva Categoria</label>
                                        <select class="custom-select" name="nuevaCategoria" id="nuevaCategoria">
                                        <option selected="" value="<?php echo $ficha['catid']; ?>"><?php echo $ficha['categoria']; ?></option>
                                        <?php
                                            foreach ($categorias as $categoria) {
                                                $catid = $categoria['catid'];
                                                $category = $categoria['categoria'];
                                                $catArray[$catid] = $category; 
                                            }
                                            asort($catArray);
                                                    foreach ($catArray as $catid => $category){
                                                    echo "<option value=\"$catid\">$category</option>";
                                                } //closes for each
                                        ?>
                                        </select> 
                                    </div>
                                   
                                    
                                    <div class="col-md-12" id="formServicio">

                                    <?php 
                                    echo "<span><strong>Categoria: </strong>".$ficha['categoria']."</span><hr>";
                                    ?>
                                        <?

                                        $esteServicio = html_entity_decode($ficha['servicio']);
                                        $esteServicio = ucfirst($esteServicio);
                                        echo "<p id=\"esteServicio\">".$esteServicio."</p>"; ?>
                                    </div>
                                    <div class="col-md-12" id="formMision">
                                        <?
                                        $estaMision = html_entity_decode($ficha['mision']);
                                        echo "<p id=\"estaMision\">".$estaMision."</p>"; ?>
                                    </div>
                                        <?php echo "<input type=\"hidden\" name=\"empresaid\" id=\"empresaid\" value=\"$sihayempresaid\">"; ?>
                                    
                                    </form>
                                    <div class="col-md-12">
                                         <span style="display:block;"><a style="align:left;" href="empresas.php?content=estaempresa&id=<?php echo $sihayempresaid; ?>">Perfil Empresarial</a></span>  
                                        <hr>
                                    </div>
                                </div><!-- end row-->    
                            <!-- end 2nd row -->
                            <!--End Skills-->            
                            </div>
                        <!--/Aqui termina empresa-->  

                        <!-- Aqui empieza catalogos <hr>  -->
                            <div class="tab-pane fade in" id="catalogos">
                                <div class="row">
                        <!-- Thumbnails v2 -->
                                    <div class="alert alert-warning fade in">
                                        <?php 
                                            if (empty($catalogoid))
                                                echo "<strong>Haga el catalogo</strong> de sus productos, maquinaria, servicios";
                                            else
                                                echo "<strong>Suba una foto</strong> de sus productos, maquinaria, servicios";
                                        ?>
                                    </div>
                                    <!-- El documento hacerCatalogo.js actualiza la foto de este formulario -->
                                    <div class="alert"  id="editarCatalogo">
                                    <img src="https://construcali.com/assets/img/spinner.gif" id="loading-img" style="display:none;" alt="Porfavor espere un momento"/> 

                                    <!-- nuevaFotoCatalogo esta en la linea 12 de hacerCatalogo.js -->       
                                    <form class="sky-form" id="nuevaFotoCatalogo" enctype="multipart/form-data" action="subirfoto.php" method="post">
                                        <label class="label">Titulo de la foto:</label>
                                        <label class="input">
                                        <input type="text" name="descripcion" id="descripcion" maxlength="100" autofocus>
                                        </label>
                                        <label class="label">Unidad:</label>
                                        <label class="select">
                                        
                                        <select class="form-select" name="unidad">
                                            <option selected>Unidad</option>
                                            <option value="Kilos">Kilos</option>
                                            <option value="Metro2">Metros Cuadrados</option>
                                            <option value="mL">Metros Lineales</option>
                                            <option value="m3">Metros Cubicos</option>
                                            <option value="Bultos">Bultos</option>
                                            <option value="Libras">Libras</option>
                                            <option value="cunetes">Cu&ntilde;etes</option>
                                            <option value="Rollos">Rollos</option>
                                            <option value="Galones">Galones</option>
                                            <option value="Pliegos">Pliegos</option>
                                            <option value="Hora">Hora</option>
                                            <option value="unidades">Unidades</option>
                                        </select>
                                        </label>
                                        <label class="precio">Precio:</label>
                                        <label class="input">
                                            <!-- cambiar la id de costo a precio para que funcione el formateo del numero como cifra precio -->
                                        <input type="text" name="precio" id="costo" maxlength="20">
                                        </label>
                                        <label class="label">Foto: Formato png o jpg preferiblemente</label>
                                        <label for="file" class="input input-file">
                                            <div class="button"><input type="file" name="foto" id="foto" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                        </label>
                                        <input type="hidden" name="empresaid" id="empresaid" value="<?php echo $sihayempresaid; ?>" >
                                        <button type="submit" id="submit-btn" class="btn-u">Subir Foto</button>
                                    </form>

                                    </div>
                                    <div id="esteCatalogo"></div>
                                    <div class="row" id="catalogo">
                                    <img src="https://construcali.com/assets/img/spinner.gif" id="cargando-img" style="display:none;" alt="Porfavor espere"/> 
                                    <?php
                                        foreach ($catalogos as $catafoto) {
                                            $fotoid = $catafoto['fotoid'];
                                            $fotodescripcion = $catafoto['descripcion'];
                                            $fotodescripcion = substr($fotodescripcion,0, 100);
                                            $fotodescripcion = trim($fotodescripcion);
                                            $fotodescripcion = nl2br($fotodescripcion);
                                            $fotodescripcion = html_entity_decode($fotodescripcion);
                                            $fotourl = $catafoto['foto'];
                                    ?>
                                        <div class="col-md-4" id="fotos">
                                            <div class="thumbnails thumbnail-style">
                                                <?php echo "<img class=\"img-responsive\" src=\"$fotourl\" alt=\"$fotodescripcion\" />"; ?>
                                                <div class="caption">
                                                    <p><?php echo $fotodescripcion; ?></p>
                                                    <p><?php echo "<a href=\"updatefoto.php?fotoid=$fotoid&empresaid=$sihayempresaid\" class=\"btn-u btn-u-xs\"> Editar <i class=\"fa fa-angle-right margin-left-5\"></i></a>"; ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    </div><!--/row-->
                                </div>
                            </div>
                            <!-- Termina catalogos -->
                            <!-- Aqui empieza portafolios -->
                            <div class="tab-pane fade in" id="portafoliopdf">
                                <div class="row">
                                    <div class="alert alert-warning fade in">
                                        <?php 
                                                    if (isset($mensajeportafolio))
                                                    echo "<strong>$mensajeportafolio</strong>"; ?>
                                                    <?php if (empty($portafolioid)): ?>
                                                        <strong>Suba su portafolio</strong> en formato pdf"
                                                    <?php endif;
                                                        if (!empty($portafolioid)): ?>
                                                        <strong id="borrarPortafolio" style="display:block">Borre su portafolio en formato pdf</strong>
                                                        <a style="display:none;" href="<?php echo $portafolioid; ?>" id="portafolioBorrado"> Confirmar </a>
                                                        
                                                    <?php endif; ?>

                                    </div>
                                    <div class="alert">
                                        <strong>Edite su portafolio</strong> en formato pdf
                                        <form class="sky-form" enctype="multipart/form-data" action="usuarios.php?content=subirportafolio" method="post" id="subirPortafolio">
                                            <label class="label">Formato pdf y menos de 5000 Kbytes</label>
                                            <label class="label">Nombre su archivo asi: nombredelaempresa (sin espacios)</label>
                                            <label for="file" class="input input-file">
                                                <div class="button"><input type="file" name="presentacion" id="nombrePortafolio" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                            </label>
                                            <input type="hidden" name="empresaid" value="<?php echo $sihayempresaid; ?>" >
                                            <button type="submit" class="btn-u">Subir</button>
                                        </form>
                                    </div> <!-- end class alert -->
                                </div>
                            </div>
                            <!-- Aqui termina portafolios -->
                            <!-- Aqui empieza el logo -->
                            <div class="tab-pane fade in" id="cambiarLogo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php 
                                        if (empty($logo))
                                            echo "<img class=\"img-responsive md-margin-bottom-10\" src=\"assets/img/team/LogoCasco.png\" alt=\"Logo de la empresa\">";
                                        else
                                            echo "<img class=\"img-responsive md-margin-bottom-10\" src=\"logo/$logo\" alt=\"Logo de la empresa\">";
                                        ?>  
                                        <form enctype="multipart/form-data" action="usuarios.php?content=editarlogo" method="post" id="editarLogo" class="sky-form">
                                            <h2>Cambie o Suba el logo de su Empresa</h2>
                                            <h4>Ponga logos solo en formato jpg o png</h4>
                                            <h4>Bajele el peso a los foto para que sea mas facil subirla</h4>
                                            <h4>Por favor suba fotos que sean de 200pxls de ancho por 200 pxls de alto o menos</h4>
                                                <?php
                                                    if (isset($mensaje))
                                                        echo $mensaje;
                                                ?>
                                            <section>
                                                <label for="file" class="input input-file">
                                                    <div class="button"><input type="file" name="logo" multiple onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" placeholder="Incluya la foto de su logo" readonly>
                                                </label>
                                            </section>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000"></input>
                                            <button type="submit" class="btn-u">Subir Logo</button>
                                            
                                        </form> 
                                    </div>
                                </div>
                            </div>
                            <!-- Aqui termina el logo -->

                            <!-- Aqui empieza catalogos <hr>  -->
                            <div class="tab-pane fade in" id="infocontacto">
                                <div class="row">
                                    <!--Social Icons v3-->
                                    <div class="col-sm-6 sm-margin-bottom-30">
                                        <div class="panel panel-profile">
                                            <div class="panel-heading overflow-h">
                                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-cloud"></i> Redes Sociales</h2>
                                                <span id="editarRedesSociales"><i class="fa fa-pencil pull-right"></i></span>
                                            </div>
                                            <div class="panel-body">
                                                 <ul class="list-unstyled social-contacts-v2" id="formRedesSociales">
                                                    <li><i class="rounded-x tw fa fa-twitter"></i><?php echo 'http://twitter.com/'.$twitter; ?></li>
                                                    <li><i class="rounded-x fb fa fa-facebook"></i><?php echo 'http://facebook.com/'.$facebook; ?></li>
                                                    <li><i class="rounded-x sk fa fa-linkedin"></i><?php echo 'http://linkedin.com/'.$linkedin; ?>
                                                    <li><i class="rounded-x gp fa fa-external-link"></i><?php echo $ficha['url']; ?></a></li>
                                                    <li><i class="rounded-x gm fa fa-envelope"></i> <?php echo $ficha['email']; ?></li>
                                                </ul>
                                            </div>
                                            <div class="alert" id="confirmacion">
                                                
                                            </div>       
                                        </div>
                                    </div>
                                <!--End Social Icons v3-->

                                <!--Skills-->
                                    <div class="col-sm-6 sm-margin-bottom-30">
                                        <div class="panel panel-profile">
                                            <div class="panel-heading overflow-h">
                                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-lightbulb-o"></i> Informacion de Contacto</h2> <!-- JavaScript esta en editarEmpresa.js -->
                                                <span id="editarInfoContacto"><i class="fa fa-pencil pull-right"></i></span>
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-unstyled social-contacts-v2" id="formInfoContacto">
                                                    <li><i class="rounded-x fa fa-user"></i><span id="empcontacto"><?php echo htmlspecialchars($ficha['contacto']); ?></span></li>
                                                    <li><i class="rounded-x fa fa-phone"></i><span id="emptelefono"><?php echo $ficha['telefono']; ?></span></li>
                                                    <li><i class="rounded-x wa fa fa-whatsapp"></i><span id="empwhatsapp"><?php echo $whatsapp; ?></span></li>
                                                    <li><i class="rounded-x fa fa-map-marker"></i><span id="empdirecion">  <?php echo $ficha['direcion']; ?></span></li>
                                                    <li><i class="rounded-x fa fa-globe"></i><span id="empciudad"><?php echo html_entity_decode($ficha['ciudad']); ?></span></li>
                                                    <li><i class="rounded-x fa fa-globe"></i><span id="empdepartamento"><?php echo $ficha['departamento']; ?></span> </li>
                                                </ul>
                                            </div>

                                        
                                        </div><!-- End panel panel-profile -->
                                    </div><!-- end class col-sm-6  -->
                                </div>
                            </div>
                            <!-- -->
                            
                    <!--Timeline-->
                    
                    <!--End Timeline--> 

                        </div><!-- End tab-content -->
                       
                    </div><!-- End tab-v1 -->            
                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>		
    <!--=== End Profile ===-->
    