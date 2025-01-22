<!-- CSS para formatear el formulario de anuncios -->
<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<link rel="stylesheet" href="assets/css/pages/profile.css">
<!-- Termina CSS para formulario de anunciar -->
<!-- CSS Page Style - Para el formulario de buscar-->    
<link rel="stylesheet" href="assets/css/pages/page_search_inner.css">
<!-- css para esconder id = buscar donde van los materiales -->
<style type="text/css">
    #menuResultados {
        display: none;
    }

    #resultados{
        display: none;
    }
</style>
<!-- Termina css para id=buscar -->
<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Cotizar</h1>
            <ul class="pull-right breadcrumb">
                <?php if (empty($loginid)) { ?>
                <li><a href="usuarios.php">Acceder</a></li>
                <li><a href="usuarios.php?content=registrarse">Registrarse</a></li>
                <?php 
                }else{
                ?>
                <li><a href="usuarios.php">Panel Usuario</a></li>
                <li><a href="portafolios.php">Portafolios</a></li>
                <?php } ?>
                
                <li><a href="presupuesto.php">Analisis Generales</a></li>
            </ul>
        </div><!--/end container-->
    </div>
   <!--/breadcrumbs-->
   <!--=== Search Block Version 2 ===-->
    <div class="search-block-v2">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form method="post" action="buscararticulos.php" id="buscarArticulos">
                <div class="input-group">
                    <input type="text" class="form-control" name="articulo" id="articulo" placeholder="Que materiales, articulos busca?">
                    <span class="input-group-btn">
                        <button class="btn-u" type="button" id="buscoArticulos"><i class="fa fa-search"></i></button>
                    </span>
                </form>  
                </div>
            </div>
        </div>    
    </div>   
    <!--=== End Search Block Version 2 ===-->
    <!--=== Content ===-->
    <div class="container content">
        <!-- Begin Service Block -->
            <!-- Empieza Anunciarse-->            
            <div class="col-md-9">
                <div class="profile-body">
                    <!--Service Block v3-->
                    <!--/end row-->
                    <!--End Service Block v3-->
                    <!-- Tab v1 -->                
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li id="categoriasPrecios" class="active"><a href="#categoriasMateriales" data-toggle="tab">Categorias</a></li>
                        <li id="menuMateriales"><a href="#home" data-toggle="tab">Cotizar Insumos</a></li>
                        <li><a href="#profile" data-toggle="tab">Cotizar Proyectos</a></li>
                        <li id="menuResultados"><a href="#resultados" data-toggle="tab">Materiales Buscados</a></li>
                    </ul>                
                    <div class="tab-content">
                        <!-- Empieza tab-pane categoria de materiales -->
                        <div class="tab-pane fade in active" id="categoriasMateriales">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default margin-bottom-40">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Precios de Materiales de Construccion en Colombia</h3>
                                            </div>
                                            <div class="panel-body">
                                                <p>Estos son precios de materiales de construccion para tomarlos como referencia. Construcali.com no se hace responsable por ninguno de los precios aqui mencionados.<?php if (isset($mensaje)) echo $mensaje; ?></p>
                                            </div>
                                            <table class="table table-striped invoice-table">
                                                <tbody>
                                                    <tr>
                                                    <?php
                                                        $i=0;  
                                                        foreach ($secciones as $catid => $seccion) {
                                                        echo "<td><a href=\"analisis.php?content=articulos&id=$catid\">$seccion</a></td>";
                                                        if ($i==2 || $i==5 || $i==8 || $i==11){
                                                            echo "</tr><tr>";
                                                        }
                                                        $i=$i+1;
                                                        }
                                                    ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>       
                                    </div>
                                </div>
                        </div>
                        <!-- Aqui terminan las categorias de materiales -->
                        <!-- Empieza cotizar materiales -->
                        <div class="tab-pane fade in" id="home">
                            <div class="row">
                            <div class="col-md-12" id="confirmacion">
                            <?php
                            if (isset($mensaje)){echo $mensaje;}
                            ?>
                            </div>
                            <form method="post" action="usuarios.php?content=cotizacion" class="sky-form" id="cotizarSinUsuarioid">
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="titulo" placeholder="Ponga un titulo descriptivo" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-5">
                                    <section>
                                        <label class="label">Categoria</label>
                                        <label class="select">
                                            <select name="sector">
                                            <?php
                                                foreach ($categorias as $key => $value) {
                                                    $catid = $key;
                                                    $clase = $value;
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
                                            <select name="departamento" class="departamento">
                                            <?php
                                                foreach ($departamentos as $departamento) {
                                                    $provincia = $departamento['departamento'];
                                                    echo "<option value=\"$provincia\">$provincia</option>";
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
                                        <label class="label">Nombre</label>
                                        <label class="input">
                                            <input type="text" placeholder="Escriba su Nombre" value="<?php echo $nombre; ?>" name="nombre" id="nombre" class="contact">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Telefono</label>
                                        <label class="input">
                                            <input type="text" placeholder="Ej: 300 345 678" value="<?php echo $telefono; ?>" name="telefono" id="telefono" class="phone">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Email</label>
                                        <label class="input">
                                            <input type="text" placeholder="email@proveedor.com" value="<?php echo $email; ?>" name="email" id="email" class="email">
                                            
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
                                        <button type="submit" class="btn-u" id="botonCotizarMateriales">Cotizar</button>
                                    </div>
                                </div>   
                            </form>
                            </div>
                        </div>
                        <!-- Termina cotizar materiales -->
                        <!-- Empieza cotizar servicios -->
                        <div class="tab-pane fade in" id="profile">
                            <div class="row">
                                <form class="sky-form" method="post" action="anuncios.php?content=cotizar_servicios" id="serviciosSinId">
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="subjecto" placeholder="Ponga un titulo descriptivo" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-5">
                                    <section>
                                        <label class="label">Categoria</label>
                                        <label class="select">
                                            <select name="sector">
                                            <?php
                                                foreach ($categorias as $key => $value) {
                                                    $catid = $key;
                                                    $clase = $value;
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
                                            <select name="departamento" class="departamento">
                                            <?php
                                                foreach ($departamentos as $departamento) {
                                                    $provincia = $departamento['departamento'];
                                                    echo "<option value=\"$provincia\">$provincia</option>";
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
                                            <input type="text" class="ciudad" name="ciudad" id="city">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Nombre</label>
                                        <label class="input">
                                            <input type="text" placeholder="Escriba su Nombre" name="nombre" id="contacto" class="contact">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Telefono</label>
                                        <label class="input">
                                            <input type="text" placeholder="Ej: 300-345-678" name="telefono" id="telephone" class="phone">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Email</label>
                                        <label class="input">
                                            <input type="text" placeholder="email@proveedor.com" name="email" id="correo" class="email">
                                            
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
                        <!-- Termina cotizar materiales -->
                        <!-- Resultados de busqueda -->
                        <div class="tab-pane fade in" id="resultados">
                        </div>
                        <!-- Termina resultados de busqueda -->
                    </div>
                </div>
                </div>
            </div>
            <!-- Termina Anunciarse -->
        <!-- End Begin Service Block -->

        <!-- Job Content -->
            <!-- Empieza col-md-3 -->
            <div class="col-md-3">
                    <!-- Tabs Widget -->
                    <div class="headline headline-md">
                        <h2> De su Interes </h2>   
                    </div>
                    <div class="tab-v2 margin-bottom-40">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home-1">Categorias</a></li>
                            <li><a data-toggle="tab" href="#home-2">Bases de Datos</a></li>
                        </ul>                
                        <div class="tab-content">
                            <div id="home-1" class="tab-pane active">
                                <form action="analisis.php?content=articulos" method="post" class="sky-form" id="claseciudad">
                                    <select name="claseid" class="form-control">
                                        <?php
                                            foreach ($etiquetas as $key => $etiqueta){
                                                echo "<option value=\"{$etiqueta['catid']}\">{$etiqueta['categoria']}</option>";
                                            }
                                        ?>
                                    </select>
                                    <button type="submit" class="btn-u btn-u-green">Selecionar</button>
                                </form>                
                            </div>
                            <div id="home-2" class="tab-pane magazine-sb-categories">
                                <ul class="list-unstyled">
                                        <!-- <li>Otras bases de datos</li> -->
                                        <li><a href="presupuesto.php">Analisis Detallados</a></li>
                                </ul>                                               
                            </div>
                        </div>
                    </div>
            </div>  
            <!--=== Termina col-md-3 ===-->
            <!--/col-md-12-->
        <!-- Aqui termina row -->        
        <!-- Aqui terminan los clasificados -->
    </div>    
    <!--/container-->     
    <!--=== End Content ===-->
    <!--=== Footer Version 1 ===-->    
    <!--=== End Footer Version 1 ===-->
</div>

<!-- JS Global Compulsory -->			
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->