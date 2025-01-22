    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
<!--=== Profile ===-->
    <div class="container content profile">
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <img class="img-responsive profile-img margin-bottom-20" src="assets/img/team/LogoCasco.png" alt=""><!-- imagen anterior img1-md.jpg -->

                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <li class="list-group-item">
                        <a href="usuarios.php"><i class="fa fa-bar-chart-o"></i> Panel Usuario</a>
                    </li>
                    <li class="list-group-item active">
                        <a href="administrador.php?content=correo"><i class="fa fa-user"></i> Correo</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ofertas"><i class="fa fa-group"></i> Ofertas</a>
                    </li>                                        
                    <li class="list-group-item">
                        <a href="usuarios.php?content=actividades"><i class="fa fa-cubes"></i> Cotizaciones</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=informacion"><i class="fa fa-comments"></i> Informacion</a>
                    </li>                                                                               
                    <li class="list-group-item">
                        <a href="usuarios.php?content=ajustes"><i class="fa fa-cog"></i> Ajustes</a>
                    </li> 
                </ul>   

                <hr>

                <!--Notification-->
                <div class="panel-heading-v2 overflow-h">
                    <h2 class="heading-xs pull-left"><i class="fa fa-bell-o"></i>Notificaciones</h2>
                    <a href="#"><i class="fa fa-cog pull-right"></i></a>
                </div>
                <ul class="list-unstyled mCustomScrollbar margin-bottom-20" data-mcs-theme="minimal-dark">
                <?php 
                    foreach ($cuadernos as $cuaderno) {
                        $cuanombre = $cuaderno['nombre'];
                        $cotidia = $cuaderno['nuevafecha'];
                ?>
                    <li class="notification">
                        <i class="icon-custom icon-sm rounded-x icon-bg-red icon-line icon-envelope"></i>
                        <div class="overflow-h">
                           <?php echo "<span><strong>$cuanombre</strong> ha hecho una cotizacion</span>"; ?>
                           <?php echo "<small>$cotidia</small>"; ?>
                        </div>    
                    </li>
                <?php 
                }
                ?> 

                <?php
                    foreach ($libros as $libro) {
                        $libnombre = $libro['nombre'];
                        $libdia = $libro['nuevafecha'];
                ?>
                    <li class="notification">
                        <i class="icon-custom icon-sm rounded-x icon-bg-red icon-line icon-envelope"></i>
                        <div class="overflow-h">
                            <?php echo "<span><strong>$libnombre</strong> ha cotizado un nuevo trabajo.</span>"; ?>
                            <?php echo "<small>$libdia</small>"; ?>
                        </div>    
                    </li>
                <?php
                }
                ?>    
                </ul>    
                <a href="home.php?content=logout" role="button" class="btn-u btn-u-default btn-u-sm btn-block">Salir</a>
                <!--End Notification-->

                <div class="margin-bottom-50"></div>

                <!--Datepicker-->
                <form action="#" id="sky-form2" class="sky-form">
                    <div id="inline-start"></div>
                </form> 
                <!--End Datepicker-->
            </div>
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9">
                <div class="profile-body">
                    <!--Service Block v3-->
                    <!--/end row-->
                    <!--End Service Block v3-->
                    <!-- Tab v1 -->                
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Cotizar Materiales</a></li>
                        <li><a href="#profile" data-toggle="tab">Cotizar Servicios</a></li>
                        <li><a href="#messages" data-toggle="tab">Anunciar Productos</a></li>
                        <li><a href="#settings" data-toggle="tab">Anunciar Servicios</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home">
                            <div class="row">
                            <div class="col-md-12">
                            <?php
                            if (isset($mensaje)){echo $mensaje;}
                            ?>
                            </div>
                            <form method="post" action="administrador.php?content=cotizacion"class="sky-form" id="materialesCotizacion">
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="titulo" placeholder="Ponga un titulo descriptivo" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Categoria</label>
                                        <label class="select">
                                            <select name="sector">
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
                                            <select name="capital">
                                            <?php
                                                foreach ($departamentos as $departamento) {
                                                    $capital = $departamento['ciudad'];
                                                    $provincia = $departamento['departamento'];
                                                    echo "<option value=\"$capital\">$provincia</option>";
                                                }
                                            ?>
                                                
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>              
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Ciudad</label>
                                        <label class="input">
                                            <input type="text" name="ciudad" id="ciudad" list="list">
                                            <datalist id="list">
                                                <option value="Leticia"></option>
                                                <option value="Medellin"></option>
                                                <option value="Arauca"></option>
                                                <option value="Barranquilla"></option>
                                                <option value="Cartagena"></option>
                                                <option value="Tunja"></option>
                                                <option value="Manizales"></option>
                                                <option value="Florencia"></option>
                                                <option value="Yopal"></option>
                                                <option value="Popayan"></option>
                                                <option value="Valledupar"></option>
                                                <option value="Quibdo"></option>
                                                <option value="Monteria"></option>
                                                <option value="Bogota"></option>
                                                <option value="Puerto Inirida"></option>
                                                <option value="San Jose del Guaviare"></option>
                                                <option value="Neiva"></option>
                                                <option value="Riohacha"></option>
                                                <option value="Santa Marta"></option>
                                                <option value="Villavicencio"></option>
                                                <option value="Pasto"></option>
                                                <option value="Cucuta"></option>
                                                <option value="Mocoa"></option>
                                                <option value="Armenia"></option>
                                                <option value="Pereira"></option>
                                                <option value="San Andres"></option>
                                                <option value="Bucaramanga"></option>
                                                <option value="Sincelejo"></option>
                                                <option value="Ibague"></option>
                                                <option value="Cali"></option>
                                                <option value="Mitu"></option>
                                                <option value="Puerto Carre&ntilde;o"></option>
                                            </datalist>
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-12">
                                    <div class="row"><!-- materiales -->
                                        <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo1" id="insumo" placeholder="Material ej: Bultos de cemento"></label></section>
                                        <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio1" id="cantidad1" placeholder="Cantidad ej: 20"></label></section>
                                        <section class="col-sm-4"><label class="select"><select name="unidad1">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                        <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                        <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                        <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                        <option name="pliegos">Pliegos</option></select><i></i></label></section>

                                        <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo2" id="insumo" placeholder="Material ej: Bultos de cemento"></label></section>
                                        <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio2" id="cantidad2" placeholder="Cantidad ej: 20"></label></section>
                                        <section class="col-sm-4"><label class="select"><select name="unidad2">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                        <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                        <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                        <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                        <option name="pliegos">Pliegos</option></select><i></i></label></section>

                                        <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo3" id="insumo" placeholder="Material ej: Bultos de cemento"></label></section>
                                        <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio3" id="cantidad3" placeholder="Cantidad ej: 20"></label></section>
                                        <section class="col-sm-4"><label class="select"><select name="unidad3">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                        <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                        <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                        <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                        <option name="pliegos">Pliegos</option></select><i></i></label></section>

                                        <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo4" id="insumo" placeholder="Material ej: Bultos de cemento"></label></section>
                                        <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio4" id="cantidad4" placeholder="Cantidad ej: 20"></label></section>
                                        <section class="col-sm-4"><label class="select"><select name="unidad4">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                        <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                        <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                        <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                        <option name="pliegos">Pliegos</option></select><i></i></label></section>

                                        <section class="col-sm-5"><label class="input"><input type="text" size="50" name="insumo5" id="insumo" placeholder="Material ej: Bultos de cemento"></label></section>
                                        <section class="col-sm-3"><label class="input"><input type="text" size="20" name="precio5" id="cantidad5" placeholder="Cantidad ej: 20"></label></section>
                                        <section class="col-sm-4"><label class="select"><select name="unidad5">Unidad<option name="Kilos">Kilos</option><option name="unidades">Unidades</option>
                                        <option name="ml">Metros Lineales</option><option name="m2">Metros2</option><option name="bultos">Bultos</option>
                                        <option name="m3">Metros Cubicos</option><option name="libras">Libras</option><option name="cunetes">Cu&ntilde;etes</option>
                                        <option name="rollos">Rollos</option><option name="toneladas">Toneladas</option><option name="galones">Galones</option>
                                        <option name="pliegos">Pliegos</option></select><i></i></label></section>
                                    </div><!-- end materiales -->
                                    <div>
                                        <button type="submit" class="btn-u">Cotizar</button>
                                    </div>
                                </div>   
                            </form>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="profile">
                            <div class="row">
                                <form class="sky-form" method="post" action="usuarios.php?content=servicios" id="serviciosCotizacion">
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="subjecto" placeholder="Ponga un titulo descriptivo" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Categoria</label>
                                        <label class="select">
                                            <select name="sector">
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
                                            <select name="capital">
                                            <?php
                                                foreach ($departamentos as $departamento) {
                                                    $capital = $departamento['ciudad'];
                                                    $provincia = $departamento['departamento'];
                                                    echo "<option value=\"$capital\">$provincia</option>";
                                                }
                                            ?>
                                                
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>              
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Ciudad</label>
                                        <label class="input">
                                            <input type="text" list="list" name="ciudad">
                                            <datalist id="list">
                                                <option value="Leticia"></option>
                                                <option value="Medellin"></option>
                                                <option value="Arauca"></option>
                                                <option value="Barranquilla"></option>
                                                <option value="Cartagena"></option>
                                                <option value="Tunja"></option>
                                                <option value="Manizales"></option>
                                                <option value="Florencia"></option>
                                                <option value="Yopal"></option>
                                                <option value="Popayan"></option>
                                                <option value="Valledupar"></option>
                                                <option value="Quibdo"></option>
                                                <option value="Monteria"></option>
                                                <option value="Bogota"></option>
                                                <option value="Puerto Inirida"></option>
                                                <option value="San Jose del Guaviare"></option>
                                                <option value="Neiva"></option>
                                                <option value="Riohacha"></option>
                                                <option value="Santa Marta"></option>
                                                <option value="Villavicencio"></option>
                                                <option value="Pasto"></option>
                                                <option value="Cucuta"></option>
                                                <option value="Mocoa"></option>
                                                <option value="Armenia"></option>
                                                <option value="Pereira"></option>
                                                <option value="San Andres"></option>
                                                <option value="Bucaramanga"></option>
                                                <option value="Sincelejo"></option>
                                                <option value="Ibague"></option>
                                                <option value="Cali"></option>
                                                <option value="Mitu"></option>
                                                <option value="Puerto Carre&ntilde;o"></option>
                                            </datalist>
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
                                    <button type="submit" class="btn-u">Cotizar</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="messages">
                             <div class="row">
                             <form class="sky-form" method="post" action="usuarios.php?content=productos" enctype="multipart/form-data" id="clasificadoProductos">
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="title" placeholder="Ponga un titulo descriptivo" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-4">
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
                                            <select name="capital">
                                            <?php
                                                foreach ($departamentos as $departamento) {
                                                    $capital = $departamento['ciudad'];
                                                    $provincia = $departamento['departamento'];
                                                    echo "<option value=\"$capital\">$provincia</option>";
                                                }
                                            ?>
                                                
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>              
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Ciudad</label>
                                        <label class="input">
                                            <input type="text" list="list" name="ciudad">
                                            <datalist id="list">
                                                <option value="Leticia"></option>
                                                <option value="Medellin"></option>
                                                <option value="Arauca"></option>
                                                <option value="Barranquilla"></option>
                                                <option value="Cartagena"></option>
                                                <option value="Tunja"></option>
                                                <option value="Manizales"></option>
                                                <option value="Florencia"></option>
                                                <option value="Yopal"></option>
                                                <option value="Popayan"></option>
                                                <option value="Valledupar"></option>
                                                <option value="Quibdo"></option>
                                                <option value="Monteria"></option>
                                                <option value="Bogota"></option>
                                                <option value="Puerto Inirida"></option>
                                                <option value="San Jose del Guaviare"></option>
                                                <option value="Neiva"></option>
                                                <option value="Riohacha"></option>
                                                <option value="Santa Marta"></option>
                                                <option value="Villavicencio"></option>
                                                <option value="Pasto"></option>
                                                <option value="Cucuta"></option>
                                                <option value="Mocoa"></option>
                                                <option value="Armenia"></option>
                                                <option value="Pereira"></option>
                                                <option value="San Andres"></option>
                                                <option value="Bucaramanga"></option>
                                                <option value="Sincelejo"></option>
                                                <option value="Ibague"></option>
                                                <option value="Cali"></option>
                                                <option value="Mitu"></option>
                                                <option value="Puerto Carre&ntilde;o"></option>
                                            </datalist>
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
                                        <label class="label">Describa los materiales/productos/maquinaria que ofrece</label>
                                        <label class="textarea">
                                            <textarea rows="3" name="productos" id="productos"></textarea>
                                        </label>
                                    </section>
                                    <div>
                                    <button type="submit" class="btn-u">Anunciar</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="settings">
                            <div class="row">
                                <form class="sky-form" method="post" action="usuarios.php?content=anuncios" enctype="multipart/form-data" id="clasificadoServicios">
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="tema" placeholder="Ponga un titulo descriptivo" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-4">
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
                                            <select name="capital">
                                            <?php
                                                foreach ($departamentos as $departamento) {
                                                    $capital = $departamento['ciudad'];
                                                    $provincia = $departamento['departamento'];
                                                    echo "<option value=\"$capital\">$provincia</option>";
                                                }
                                            ?>
                                                
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>              
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Ciudad</label>
                                        <label class="input">
                                            <input type="text" name="ciudad" list="list">
                                            <datalist id="list">
                                                <option value="Leticia"></option>
                                                <option value="Medellin"></option>
                                                <option value="Arauca"></option>
                                                <option value="Barranquilla"></option>
                                                <option value="Cartagena"></option>
                                                <option value="Tunja"></option>
                                                <option value="Manizales"></option>
                                                <option value="Florencia"></option>
                                                <option value="Yopal"></option>
                                                <option value="Popayan"></option>
                                                <option value="Valledupar"></option>
                                                <option value="Quibdo"></option>
                                                <option value="Monteria"></option>
                                                <option value="Bogota"></option>
                                                <option value="Puerto Inirida"></option>
                                                <option value="San Jose del Guaviare"></option>
                                                <option value="Neiva"></option>
                                                <option value="Riohacha"></option>
                                                <option value="Santa Marta"></option>
                                                <option value="Villavicencio"></option>
                                                <option value="Pasto"></option>
                                                <option value="Cucuta"></option>
                                                <option value="Mocoa"></option>
                                                <option value="Armenia"></option>
                                                <option value="Pereira"></option>
                                                <option value="San Andres"></option>
                                                <option value="Bucaramanga"></option>
                                                <option value="Sincelejo"></option>
                                                <option value="Ibague"></option>
                                                <option value="Cali"></option>
                                                <option value="Mitu"></option>
                                                <option value="Puerto Carre&ntilde;o"></option>
                                            </datalist>
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Foto</label>
                                            <label for="file" class="input input-file">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
                                            <div class="button"><input type="file" id="archivo" name="picture" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                        </label>
                                    </section>    
                                    <section>
                                        <label class="label">Describa los servicios que ofrece</label>
                                        <label class="textarea">
                                            <textarea rows="3" name="anuncio" id="anuncio"></textarea>
                                        </label>
                                    </section>
                                    <div>
                                    <button type="submit" class="btn-u">Anuciar Servicio</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab v1 -->

                    <!--Table Search v1-->
                    
                    <!--End Table Search v1-->

                    <!-- Begin Table Search v2 -->
                   
                    <!-- End Table Search v2 -->
                </div>
            </div>
            <!-- End Profile Content -->            
        </div>
    </div><!--/container-->    
    <!--=== End Profile ===-->