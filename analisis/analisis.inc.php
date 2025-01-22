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
            <h1 class="pull-left"><a href="analisis.php">Analisis</a></h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="https://construcali.com/blogs.php">Blog</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
                
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
        <!-- Empieza contenedor de col-md-9 -->          
        <div class="col-md-9">
            <div class="profile-body">              
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li id="categoriasPrecios" class="active"><a href="#categoriasMateriales" data-toggle="tab">Materiales</a></li>
                        <li><a href="#analisis_detallados" data-toggle="tab">Analisis Detallados Generales</a></li>
                        
                        <li id="menuResultados"><a href="#resultados" data-toggle="tab">Materiales Buscados</a></li>
                    </ul>                
                    <div class="tab-content">
                        <!-- Empieza tab-pane categoria de materiales, usa el javascript de buscarArticulos.js -->
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
                        <!-- Empiezan las categorias de analisis_categorias -->
                        <div class="tab-pane fade in" id="analisis_detallados">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default margin-bottom-40">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Precios de Analisis Detallados Generales</h3>
                                            </div>
                                            <div class="panel-body">
                                                <p>Estos son precios de Analisis Detallados Generales para tomarlos
                                                como referencia en Colombia</p>
                                            </div>
                                            <table class="table table-striped invoice-table">
                                                <tbody>
                                                    <tr>
                                                    <?php
                                                        $i=0;  
                                                        foreach ($divisiones as $sectorid => $division) {
                                                        echo "<td><a href=\"presupuesto.php?content=articulos&id=$sectorid\">$division</a></td>";
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
                        <!-- Terminan las categorias de analisis_categorias -->
                        
                        <!-- Resultados de busqueda, para incluir articulo, usa el javascript de incluirArticulo.js -->
                        <div class="tab-pane fade in" id="resultados">
                        </div>
                        <!-- Termina resultados de busqueda -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Termina container col-md-9 -->
        <!-- Empieza col-md-3 -->
        <div class="col-md-3">
                <!-- Tabs Widget -->
                <div class="headline headline-md">
                    <?php if(($_SESSION['cantidad']) > 0){
                    ?>
                    <a class="btn-u btn-block btn-u-blue" href="analisis.php?content=lista"><i class="fa fa-list"></i>Ver Lista</a>
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
                                <button type="submit" class="btn-u btn-u-default">Selecionar</button>
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
    </div>    
    <!--/container-->     
    
    <!--=== Footer Version 1 ===-->    
    <!--=== End Footer Version 1 ===-->
</div>

<!-- JS Global Compulsory -->			
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

