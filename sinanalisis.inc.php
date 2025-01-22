<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Presupuestos</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="analisis.php?content=editar">Editar Lista</a></li>
                <li><a href="analisis.php?content=factura">Editar Factura</a></li>
                <li><a href="analisis.php?content=lista">Ver Factura</a></li>
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
        <!-- Job Content -->
        <!-- Aqui ponemos los clasificados -->
        <div class="row job-content">
            <div class="col-md-9">
                    <!-- Aqui empiezan los materiales -->
               
        <!--Invoice Table-->
                <div class="panel panel-default margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title">Precios de Materiales de Construccion en Colombia <span>(Por favor entre como usuario)</span></h3>
                    </div>
                    <div class="panel-body">
                        <p>Estos son precios de materiales de construccion para tomarlos como referencia. Dentro de cada categoria hay mas categorias relacionadas a la primera para facilitar la busqueda de materiales. Colconstruccion.com no se hace responsable por ninguno de los precios aqui mencionados.</p>
                    </div>
                    <table class="table table-striped invoice-table">
                        <tbody>
                            <tr>
                            <?php
                                $i=0;  
                                foreach ($categorias as $catid => $categoria) {
                                echo "<td><a href=\"#\">$categoria</a></td>";
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
                <!-- Aqui terminan los materiales -->        
            </div>
            <!-- Productos en demanda -->
            <div class="col-md-3">
                <!-- End Search Bar -->

                <!-- Posts -->
                <!--/posts-->
                <!-- End Posts -->

                <!-- Tabs Widget -->
                <div class="headline headline-md"><h2>Tablero</h2></div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Categorias</a></li>
                        <li><a data-toggle="tab" href="#home-2">Lista de Materiales</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                            <form action="analisis.php" method="post" class="sky-form" id="claseciudad">
                                <select name="claseid" class="form-control">
                                    <?php
                                        foreach ($etiquetas as $etiqueta){
                                            echo "<option value=\"{$etiqueta['catid']}\">{$etiqueta['categoria']}</option>";
                                        }
                                    ?>
                                </select>
                                <button type="submit" class="button">Selecionar</button>
                            </form>                      
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <ul class="list-unstyled">
                                     
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

