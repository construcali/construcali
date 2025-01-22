    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Panel Usuario</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=empresa"> Mi Empresa</a></li>
                <li><a href="usuarios.php?content=ajustes">Mi Perfil</a></li>
                <li><a href="usuarios.php?content=cotizaciones">Mi Actividad</a></li>
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
                  
                        if (isset($loginid)){
                            echo 'Bienvenido '.$_SESSION['nombre'].'<br />Que va a cotizar hoy?';
                    }
                    ?>
                </h4>
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
                        <a href="foros.php"><i class="fa fa-user"></i> Foros</a>
                    </li>
                    
                    <li class="list-group-item">
                        <a href="usuarios.php?content=cotizaciones"><i class="fa fa-dashboard"></i> Mis Cotizaciones</a>
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
                            <li class="active"><a href="#cotizar" data-toggle="tab">Cotizar Proyecto</a></li>
                            <li><a href="#presupuestar" data-toggle="tab">Cotizar Materiales</a></li>
                        </ul> 
                        <div class="tab-content">
                            <!-- empieza cotizar  -->
                            <div class="tab-pane fade in active" id="cotizar"> <!-- cotizar un servicio -->
                                <div class="row">
                                    <div class="col-md-12" id="confirmacion">
                                    <?php
                                    if (isset($confirmacion)){echo $confirmacion;}
                                    ?>
                                    </div>
                                    <form enctype="multipart/form-data" class="sky-form" method="post" action="usuarios.php?content=servicios" id="serviciosCotizacion">
                                    
                                    <div class="col-md-5">
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
                                                <select name="departamento" id="cualDepartamento">
                                                    <option>Selecione un Departamento</option>
                                                    <?php
                                                        foreach ($departamentos as $deptid => $departamento) {
                                                            if ($deparid == $deptid){
                                                                echo "<option value=\"$deptid\" estado=\"$departamento\" selected>$departamento</option>";
                                                            }else{
                                                                echo "<option value=\"$deptid\" estado=\"$departamento\">$departamento</option>";
                                                            }
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
                                            <label class="select" id="cualCiudad">
                                                <select name="ciudad" class="ciudad" id="city">
                                                    
                                                    <?php
                                                        if (isset($ciudad)){
                                                    ?>
                                                        <option><?php echo $ciudad; ?></option>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <option>Selecione una Ciudad</option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </label>
                                        </section>                          
                                    </div>

                                    <div class="col-md-12">
                                    <label class="g-font-weight-700 g-mb-20">Quiere enviar una foto?</label> Si
                                        <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" name="enviarFoto" value="sillevafoto" id="enviarFoto">
                                        No
                                        <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox" checked name="NoEnviarFoto" value="nollevafoto" id="enviarFoto">
                                        <section id="fotoCorreo" style="display:none;">
                                            <label class="label">Una Foto</label>
                                            <label for="file" class="input input-file">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                            <div class="button"><input type="file" name="fotocotizacion" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
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
                            
                            <!-- Termina anunciar un producto -->
                            <!-- Empieza Cotizar Lista de Materiales-->
                            <div class="tab-pane fade in" id="presupuestar">
                                <div class="row">
                                <div class="col-md-12" id="confirmacion">
                                <?php
                                if (isset($mensaje)){echo $mensaje;}
                                ?>
                                </div>
                                <form method="post" action="usuarios.php?content=cotizacion"class="sky-form" id="materialesCotizacion">
                                    
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
                                                <select name="departamento" id="departamento">
                                                    <option>Selecione un Departamento</option>
                                                    <?php
                                                        foreach ($departamentos as $deptid => $departamento) {

                                                            if ($deparid == $deptid){
                                                                echo "<option value=\"$deptid\" estado=\"$departamento\"  selected>$departamento</option>";
                                                            }else{ 
                                                                echo "<option value=\"$deptid\" estado=\"$departamento\" >$departamento</option>";
                                                            }
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
                                            <label class="select">
                                                <select value="<?php echo $ciudad; ?>" name="ciudad" id="ciudad" class="ciudad">
                                                    <?php
                                                        if (isset($ciudad)){
                                                    ?>
                                                        <option><?php echo $ciudad; ?></option>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <option>Selecione una Ciudad</option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </label>
                                        </section>                          
                                    </div>
                                    <div class="col-md-4">
                                        <section>
                                            <label class="label">Telefono</label>
                                            <label class="input">
                                                <input type="text" placeholder="Ejemplo: 300-345-6789" value="<?php echo $telefono; ?>" name="telefono" id="telefono" class="phone">
                                                
                                            </label>
                                        </section>                          
                                    </div>

                                    <div class="col-md-12">
                                        <section class="col-sm-5">
                                            <label class="label">Material</label>
                                            
                                        </section>

                                        <section class="col-sm-3">
                                            <label class="label">Cantidad</label>
                                            
                                        </section>

                                        <section class="col-sm-4">
                                            <label class="label">Unidad</label>
                                            
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
                                            <button type="submit" id="botonCotizarMateriales" class="btn-u">Cotizar Lista</button>
                                        </div>
                                    </div>
                                    <!-- contador de renglones -->
                                    <input type="hidden" name="contador" id="contador" value="5">   
                                </form>
                                </div>
                            </div>
                            <!-- Termina enviar lista de materiales -->
                            <!-- empiezaa Vender -->
                           
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