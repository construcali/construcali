    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Tablero</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=profesional">Mi Profesion</a></li>
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
                    <li  class="list-group-item">
                        <a href="usuarios.php?content=productos"><i class="fa fa-file"></i>Anunciar</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizacion"><i class="fa fa-cubes"></i> Cotizar</a>
                    </li>
                    <li class="list-group-item">
                        <a href="usuarios.php?content=correo"><i class="fa fa-envelope"></i> Correo</a>
                    </li> 
                    <?php
                     if (!empty($sihayempresaid)){
                    ?>
                    <li class="list-group-item"><a href="usuarios.php?content=empresa"><i class="fa fa-pencil"></i>Mi Empresa</a></li>
                    <li class="list-group-item"><a href="cotizaciones.php"><i class="fa fa-cubes"></i>Cotizaciones</a></li>
                    <?php
                        }else{
                    ?> 
                    <li class="list-group-item"><a href="usuarios.php?content=empresa"><i class="fa fa-pencil"></i>Vincule su Empresa</a></li>         
                    <?php 
                           }
                    ?>
                    
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Mi Actividad</a>
                    </li>
                    <li class="list-group-item">
                        <a href="foros.php"><i class="fa fa-globe"></i> Foros</a>
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
            <div class="col-md-9 profile">
                <div class="profile-body margin-bottom-20"> 
                    <!-- Aqui empieza correos, hay que poner data-toggle=tab en cada uno de los enlaces para que se vea la informacion de propuestas -->
                    <!-- Aqui empieza tab-v1 -->
                    <div class="tab-v1">
                        <ul class="nav nav-justified nav-tabs">
                            <li class="active"><a href="#anuncioproducto" data-toggle="tab">Anunciar</a></li>
                            <li><a href="#venderProducto" data-toggle="tab">Vender</a></li>
                        </ul> 
                        <div class="tab-content">
                            
                            <!--- Empieza anunciar un producto. Js.: cotizarAnunciar.js -->
                            <div class="tab-pane fade in active" id="anuncioproducto">
                                <div class="row">
                                    <form class="sky-form" method="post" action="usuarios.php?content=productos" enctype="multipart/form-data" id="clasificadoProductos">
                                     <div class="col-md-12">
                                        <div class="col-md-8">
                                            <section>
                                                <label class="label">Titulo</label>
                                                <label class="input">
                                                    <input type="text" name="titulo" id="title" placeholder="Que Ofrece?" maxlength="150">
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
                                                    <input type="text" name="ciudad" value="<?php echo $ciudad; ?>" class="ciudad" id="municipio">
                                                    
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
                            
                            <!-- Termina enviar lista de materiales -->
                            <!-- empiezaa Vender -->
                            <div class="tab-pane fade in" id="venderProducto">
                                <div class="row">
                                    <form class="sky-form" method="post" action="ofertas.php?content=vender" enctype="multipart/form-data" id="clasificadoProductos">
                                     <div class="col-md-12">
                                        <div class="col-md-6">
                                            <section>
                                                <label class="label">Titulo</label>
                                                <label class="input">
                                                    <input type="text" name="titulo" placeholder="Que Vende?" id="vender_titulo placeholder=" maxlength="150">
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
                                                                    foreach ($etiquetas as $key => $etiqueta)
                                                                    {
                                                                        $catid = $etiqueta['catid'];
                                                                        $category = $etiqueta['categoria'];
                                                                        $category = htmlentities($category);
                                                                        echo "<option value=\"$catid\">$category</option>";
                                                                         
                                                                    }
                                                                   
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
                    <!-- Aqui termina Tab V1 -->
                    <!-- termina correos -->
                    
                    <!-- Paginacion-->
                    
                    <!-- End Paginacion -->
                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div><!--/container-->    
    <!--=== End Profile ===-->