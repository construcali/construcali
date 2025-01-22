<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Presupuestos</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="analisis.php">Analisis de Precios</a></li>
                <li><a href="presupuesto.php">Analisis Generales</a></li>
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
        <!-- Job Content -->
        <!-- Aqui ponemos los clasificados -->
        <div class="row job-content">
            <div class="col-md-9">
                    <!-- Aqui empiezan los materiales -->
               
        <!--Invoice Table-->
                <div class="panel panel-default margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title">Precios de Analisis Detallados Generales</h3>
                    </div>
                    <div class="panel-body">
                        <p>Estos son precios de referencia.<?php if (isset($mensaje)) echo $mensaje; ?></p>
                    </div>
                    <table class="table table-striped invoice-table">
                        <tbody>
                            <tr>
                            <?php
                                $i=0;  
                                foreach ($categorias as $catid => $categoria) {
                                echo "<td><a href=\"presupuesto.php?content=articulos&id=$catid\">$categoria</a></td>";
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
                        <li><a data-toggle="tab" href="#home-2">Bases de Datos</a></li>
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
                                <button type="submit" class="button btn-u btn-u-blue">Selecionar</button>
                            </form>
                                                  
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <ul class="list-unstyled">
                                    <!-- <li>Otras bases de datos</li> -->
                                    <li><a href="presupuesto.php?content=lista">Lista de Actividades</a></li>
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

