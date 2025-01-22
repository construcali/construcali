<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Presupuestos</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="presupuesto.php">Analisis Generales</a></li>
                <li><a href="analisis.php?content=lista">Ver Lista</a></li>
                <li><a href="analisis.php?content=factura&boton=editar">Editar Factura</a></li>
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
        <!-- El javascrip de esta tabla esta en incluirActividad.js -->
        <!-- Aqui ponemos los clasificados -->
        <div class="row job-content">
            <div class="col-md-9">
                <!-- Aqui empiezan los materiales -->
                <?php
                echo "<form action=\"analisis.php?content=presupuesto\" method=\"post\" id=\"nuevoForo\">\n";
                echo "<table class=\"table table-striped invoice-table\" id=\"tablero\">";
                echo "<tbody>";
                echo "<tr><td>INSUMOID</td><td>NOMBRE</td><td>U.M.</td><td>PRECIO</td><td>ACCION</td></tr>";
                $i = 1;
                foreach ($materiales as $material){
                    $insumoid = $material['insumoid'];
                    $nombre = $material['nombre'];
                    // para reemplazar ciertos simbolos por caracteres speciales
                    //$nombre = urlencode($nombre);
                    $nombre = htmlspecialchars($nombre);
                    $unidad = $material['unidad'];
                    $precio = $material['precio'];
                    $valor = $precio;
                    settype($valor, "string");//now valor is an string
                    $valoruno = substr($valor,0,-3);
                    $valordos = substr($valor, -2);
                    $valor = $valoruno.'.'.$valordos;
                    $valor = number_format($valor, 2, '.', ','); 
                    echo "<tr>";
                        echo "<td><a href=\"presupuesto?content=desglosado&id=$insumoid&claseid=$claseid\">$insumoid</a></td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$unidad</td>";
                        echo "<td>$$valor</td>";
                        echo "<td id=\"incluir{$insumoid}\"><a href=\"presupuesto.php?content=proyecto&analisisid=$insumoid\" id=\"$insumoid\" class=\"btn btn-u incluirActividad\">Incluir</button></td>";
                        echo "</tr>";
                        echo "<input type=\"hidden\" name=\"precio$i\" value=\"$precio\" id=\"precio{$insumoid}\">\n";
                        echo "<input type=\"hidden\" name=\"nombre$i\" value=\"$nombre\" id=\"nombre{$insumoid}\">\n";
                        echo "<input type=\"hidden\" name=\"unidad$i\" value=\"$unidad\" id=\"unidad{$insumoid}\">\n";
                        echo "<input type=\"hidden\" name=\"insumoid$i\" value=\"$insumoid\" id=\"insumoid{$insumoid}\">\n";
                        settype($precio, "string");//now precio is an string 
                        echo "<input type=\"hidden\" name=\"preciodummy\" id=\"precio_$i\" value=\"$precio\"></input>";
                        $counter = $i;
                        $i= $i+1;
                }

                        echo "<input type=\"hidden\" name=\"counter\" id=\"counter\" value=\"$counter\">\n";
                        echo "<input type=\"hidden\" name=\"claseid\" value=\"$claseid\">\n";
                        
                    echo "</tbody>";
                    echo "</table>\n";
                    echo "</form>";

                ?>
                <!-- Aqui terminan los materiales -->        
            </div>
            <!-- Productos en demanda -->
            <div class="col-md-3">
                <!-- Tabs Widget -->
                <div class="headline headline-md">
                    <?php
                        if (isset($_SESSION['presupuesto'])){
                            ?>
                            <a href="presupuesto.php?content=lista" class="btn-u btn-u-blue">Lista de Actividades</a>
                        <?php
                            }else{
                        ?>
                            <h2>Tablero</h2>
                        <?php  
                            }
                    ?>
                </div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Categorias</a></li>
                        <li><a data-toggle="tab" href="#home-2">Lista de Materiales</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                            <form action="presupuesto.php?content=articulos" method="post" class="sky-form" id="claseciudad">
                                <select name="id" class="form-control">
                                    <?php
                                        foreach ($etiquetas as $etiqueta){
                                            echo "<option value=\"{$etiqueta['catid']}\">{$etiqueta['categoria']}</option>";
                                        }
                                    ?>
                                </select>
                                <button type="submit" class="button btn-u btu-u-blue">Selecionar</button>
                            </form>
                            <h3>Categorias Relacionadas</h3>
                            <ul class="list-unstyled">
                            <?php
                               for($catid=$claseid;$catid<=$claseid+10;$catid++){
                                $category = $main->con_casilla(categoria,analisis_categorias,catid,$catid);
                                echo "<li><a href=\"presupuesto.php?content=articulos&id=$catid\">$category</a></li>";
                               }
                            ?> 
                            </ul>  
                                                 
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <ul class="list-unstyled">
                                    <?php 
                                    if (isset($usuarioid)){
                                        if ($_SESSION['carrito']){
                                         foreach ($articulos as $articulo) {
                                            echo '<li>'.$articulo['nombre'].' - '.$articulo['cantidad'].' '.$articulo['unidad'].'</li>';

                                            }
                                        ?>
                                <ul class="list-unstyled">
                                <?php
                                if (isset($_SESSION['valor_obra'])) {
                                    echo '<li>Total: '.number_format($_SESSION['valor_obra'],2).'</li>';
                                    echo '<li># de Articulos: '.$_SESSION['qty'].'</li>';
                                }
                                ?>  
                                </ul>
                                <?php
                                        }
                                    }else{
                                        echo 'Debe Entrar como usuario<br> para hacer una lista';
                                    }
                                    ?>
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

