<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="analisis.php">Cotizar</a></h1>
            <ul class="pull-right breadcrumb">
                <?php if (empty($usuarioid)) { ?>
                <li class="active"><a href="usuarios.php">Acceder</a></li>
                <li><a href="usuarios.php?content=registrarse">Registrarse</a></li>
                <?php 
                }else{
                ?>
                <li><a href="usuarios.php">Panel Usuario</a></li>
                <li><a href="portafolios.php">Portafolios</a></li>
                <?php } ?>
                
                <li><a href="biblioteca.php">Biblioteca</a></li> 
            </ul>
        </div><!--/end container-->
    </div>
   <!--/breadcrumbs-->
        <!--/container-->
    <!--/breadcrumbs-->

    <!--=== Esta parte la guardamos para mas adelante buscar materiales o selecionar una base de datos de otros departamentos 
    <div class="job-img margin-top-5 margin-bottom-5"> 
        <div class="job-img-inputs">
            <div class="container">
                <div class="row">
                <form method="post" action="anuncios.php?content=buscar" id="buscarTerminos">
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            <input type="text" name="palabraClave" placeholder="Que oficio? Plomeros, Electricistas" class="form-control">
                        </div>
                    </div>    
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" name="ciudadClave" id="ciudadClave" placeholder="En donde? Barranquilla, Medellin,.." class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn-u btn-block btn-u-dark"> Buscar</button>
                    </div>
                </form>    
                </div>
            </div>    
        </div> 
    </div> 
    -->
    <!--=== Content ===-->
    <div class="container content">
        <!-- Begin Service Block -->
        <!-- End Begin Service Block -->
        <!-- el javascript para esta tabla y formulario esta en calculo.js -->
        <!-- Aqui ponelos la tabla de precios -->
        <div class="row job-content">
            <div class="col-md-9">
                <div class="profile-body">              
                    <div class="tab-v1">
                        <ul class="nav nav-tabs">
                            <li class="active" id="menuMateriales"><a href="#insumosMateriales" data-toggle="tab">Precios Insumos</a></li>
                            <li><a href="#categoriasMateriales" data-toggle="tab">Categorias</a></li>
                        </ul>
                        <div class="tab-content">
                            <!-- Aqui empiezan los precios de materiales -->
                            <div class="tab-pane fade in active" id="insumosMateriales">
                                <div class="row">
                                <!-- Aqui empiezan los materiales -->
                                <?php
                                if (isset($mensaje_resultado)) echo $mensaje_resultado;
                                        
                                echo "<form action=\"analisis.php?content=presupuesto\" method=\"post\" id=\"incluirArticulo\">\n";
                                echo "<table class=\"table table-striped invoice-table\" id=\"tablero\">";
                                echo "<tbody>";
                                echo "<tr colspan=\"4\"><a href=\"presupuesto?content=articulos&id=$catid\">$actividad</a> $actividad_unidad</tr>";
                                echo "<tr><td>ITEM NO</td><td>NOMBRE</td><td>U.M.</td><td>RENDIMIENTO</td><td>PRECIO</td><td>SUBTOTAL</td></tr>";
                                $i = 1;
                                $total = 0;
                                foreach ($materiales as $material){
                                    $articuloid = $material['articuloid'];
                                    $nombre = $main->con_casilla(nombre,articulos,insumoid,$articuloid);
                                    // para reemplazar ciertos simbolos por caracteres speciales
                                    $precio = $main->con_casilla(precio,articulos,insumoid,$articuloid);
                                    $nombre = htmlspecialchars($nombre);
                                    $unidad = $material['unidad'];
                                    $rendimiento = $material['cantidad'];
                                    $subtotal = $precio * $rendimiento;
                                    $total = $subtotal + $total;
                                    $valor = $precio;
                                    settype($valor, "string");//now valor is an string
                                    $valoruno = substr($valor,0,-3);
                                    $valordos = substr($valor, -2);
                                    $valor = $valoruno.'.'.$valordos;
                                    $valor = number_format($valor, 2, '.', ','); 
                                    $sub_total = number_format($subtotal, 2, '.', ',');
                                    $sub_total = '$'.$sub_total;
                                    echo "<tr>";
                                        echo "<td>$articuloid</td>";
                                        echo "<td>$nombre</td>";
                                        echo "<td>$unidad</td>";
                                        echo "<td>$rendimiento</td>";
                                        echo "<td>$valor</td>";
                                        echo "<td><input type=\"text\" name=\"cantidad$i\" class=\"qty\" id=\"cantidad_$i\" maxlength=\"15\" size=\"8\" value=\"$sub_total\" readonly=\"readonly\"></input></td>";
                                        echo "</tr>";
                                        echo "<input type=\"hidden\" name=\"nombre$i\" value=\"$nombre\">\n";
                                        echo "<input type=\"hidden\" name=\"unidad$i\" value=\"$unidad\">\n";
                                        echo "<input type=\"hidden\" name=\"rendimiento$i\" value=\"$rendimiento\">\n";
                                        echo "<input type=\"hidden\" name=\"insumoid$i\" id=\"insumoid_$i\" value=\"$articuloid\">\n"; 
                                        echo "<input type=\"hidden\" name=\"precio$i\" id=\"precio_$i\" value=\"$precio\"></input>";
                                        $counter = $i;
                                        $i= $i+1;
                                }
                                        $herramienta_menor = $actividad_precio - $total;
                                        $precio_menor = number_format($herramienta_menor, 2, '.', ',');
                                        $precio_menor = '$'.$precio_menor;
                                        echo "<tr><td>952</td><td>Herramienta Menor</td><td>%</td><td></td><td></td><td>$precio_menor</td></tr>";
                                        $total_total = number_format($actividad_precio, 2, '.', ',');
                                        $total_total = '$'.$actividad_precio;
                                        echo "<input type=\"hidden\" name=\"counter\" id=\"counter\" value=\"$counter\">\n";
                                        echo "<input type=\"hidden\" name=\"actividadid\" value=\"$actividadid\">\n";
                                        echo "<tr><td></td><td></td><td></td><td></td><td>Total</td><td><input type=\"text\" id=\"total\" name=\"total\" value=\"$total_total\" readonly =\"readonly\" size=\"10\"></td></tr>";
                                    echo "</tbody>";
                                    echo "</table>\n";
                                    echo "</form>";

                                ?>
                                <!-- Aqui terminan los materiales -->
                                </div> <!-- termina row -->
                            </div>
                            <!-- Termina tab-pane de los precios de materiales-->
                            <!-- Empieza tab-pane categoria de materiales -->
                            <div class="tab-pane fade in" id="categoriasMateriales">
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- Productos en demanda -->
            <div class="col-md-3">
                <!-- Tabs Widget -->
                <div class="headline headline-md">
                    <?php if(($_SESSION['cantidad']) > 0){
                    ?>
                    <a class="btn-u btn-block btn-u-blue" href="analisis.php?content=lista"><i class="fa fa-list"></i>Ver Lista</a>
                    <?php 
                    }else if (empty($usuarioid)){
                    ?>
                    <a class="btn-u btn-block btn-u-blue" href="usuarios.php"><i class="fa fa-user"></i>Iniciar Sesion</a>
                    <?php
                    }else{
                    ?>
                    <a class="btn-u btn-block btn-u-blue" href="usuarios.php">Panel Usuario</a>
                    <?php
                    }
                    ?>            
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
                                        foreach ($etiquetas as $etiqueta){
                                            echo "<option value=\"{$etiqueta['catid']}\">{$etiqueta['categoria']}</option>";
                                        }
                                    ?>
                                </select>
                                <button type="submit" class="btn-u btn-u-blue">Selecionar</button>
                            </form>
                            <h3>Categorias Relacionadas</h3>
                            <ul class="list-unstyled">
                            <?php
                               for($catid=$claseid;$catid<=$claseid+10;$catid++){
                                $category = $main->con_casilla(categoria,articulos_categorias,catid,$catid);
                                echo "<li><a href=\"analisis.php?content=articulos&id=$catid\">$category</a></li>";
                               }
                            ?> 
                            </ul>  
                                                 
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <ul class="list-unstyled">
                                    <!-- <li>Otras bases de datos</li> -->
                                    <li><a href="presupuesto.php">Analisis Detallados</a></li>
                            </ul>                                              
                        </div>
                    </div>
                </div> 

                <!-- Photo Stream -->
                
            </div>
        </div>
            <!-- Productos en oferta -->
        
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

