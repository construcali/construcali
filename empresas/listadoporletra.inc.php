<!-- CSS Page Style - Para el formulario de buscar-->    
<link rel="stylesheet" href="assets/css/pages/page_search_inner.css">

<div class="wrapper">    
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="empresas.php">Empresas</a></h1>
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
                <form method="post" action="empresas.php?content=buscarempresa" id="buscarTerminos">
                <div class="input-group">
                    <input type="text" class="form-control" name="palabraClave" id="palabraClave" placeholder="Buscar Empresas">
                    <span class="input-group-btn">
                        <button class="btn-u" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </form>  
                </div>
            </div>
        </div>    
    </div>  
    <!--=== End Search Block Version 2 ===-->
   
<!--=== Content Part ===-->
    <div class="container content">		
    	<div class="row">
        	<div class="col-md-9">
            	<div class="headline">
                <?php if ($cuantas_empresas == 0){
                    $mensaje_resultado = '<h2>No se encontraron Empresas por la letra '.$letter.'</h2>';
                    echo $mensaje_resultado;
                 }else{
                    echo "<h2>Empresas por la letra ".$letter."</h2>";
                 } 
                 ?>
                
                </div>

                <!-- Clients Block-->
                <?php
                foreach ($companies as $compania){
                $url = htmlspecialchars($compania['url']);
                $empresaid = htmlspecialchars($compania['empresaid']);
                //revisar si la empresa tiene un logo y whatsapp
                $logo = $main->con_casilla(foto,logos,empresaid,$empresaid);
                $whatsapp = $main->con_casilla(whatsapp,redessociales,empresaid,$empresaid);
                //revisar si hay portafolio
                $portafolio = $main->con_casilla(url,portafolios,empresaid,$empresaid);
                //revisar si hay catalogo
                $fotoid = $main->con_casilla(fotoid,fotos,empresaid,$empresaid);
                $textoservicio = trim($compania['servicio']);
                $textoservicio = substr($textoservicio,0,200);
                $textoservicio = html_entity_decode($textoservicio);
                //$textoservicio = htmlspecialchars($textoservicio);
                //busca la etiqueta <b> y <strong> y cerrarlas si se encuentran
                $pos = strpos($textoservicio, '<b>');
                if ($pos !== false)
                    $textoservicio = $textoservicio.'</b>';
                $pos = strpos($textoservicio, '<strong>');
                if ($pos !== false)
                    $textoservicio = $textoservicio.'</strong>';  
                echo "<div class=\"row clients-page\">";
                    echo "<div class=\"col-md-2\">";
                    if(empty($logo))
                        echo "<a href=\"empresas.php?content=estaempresa&id=$empresaid\"><img src=\"https://construcali.com/logo/no-logo.png\" class=\"img-responsive hover-effect\" alt=\"Logo Empresarial\" />";
                    else
                        echo "<img src=\"logo/$logo\" alt=\"Logo Empresarial\" width=\"100%\">";
                    echo "</div>";
                    echo "<div class=\"col-md-10\">";
                        echo "<h3><a href=\"empresas.php?content=estaempresa&id=$empresaid\">".htmlentities($compania['empresa'])."</a></h3>";
                        echo "<ul class=\"list-inline\">";
                            echo "<li><i class=\"fa fa-map-marker color-green\"></i>".htmlentities($compania['ciudad'])."</li>";
                            if (($url != 'http://'))
                            {echo "<li><i class=\"fa fa-globe color-green\"></i><a class=\"linked\" href=\"$url\" target=\"_blank\">Pagina Web</a></li>";}
                            echo "<li><i class=\"fa fa-whatsapp color-green\"></i>".htmlspecialchars($whatsapp)."</li>";
                            echo "<li><i class=\"fa fa-phone\"></i>".htmlspecialchars($compania['telefono'])."</li>";
                    if (!empty($portafolio)){
                                echo "<li><i class=\"fa fa-briefcase color-green\"></i><a class=\"linked\" href=\"$portafolio\" target=\"_blank\">Portafolio PDF</a></li>";
                                }
                    if (!empty($fotoid)){
                                echo "<li><i class=\"fa fa-book color-green\"></i><a class=\"linked\" href=\"catalogos.php?content=estecatalogo&empresaid=$empresaid\" target=\"_blank\">Catalogo</a></li>";
                                }
                        echo "</ul>";
                        echo "<p>".htmlentities(strip_tags($textoservicio))."...</p>";
                        echo "<a href=\"empresas.php?content=estaempresa&id=$empresaid&focus=1\" ><button class=\"btn btn-md u-btn-outline-primary g-mr-10 g-mb-15\">Contactar</button></a>";
                    echo "</div>";
                echo "</div>";
                echo "<hr>";
                }
                ?>
                <!-- End Clients Block-->

                <!-- Clients Block-->
                
                <!-- End Clients Block-->

                <!-- Clients Block-->
                
                <!-- End Clients Block-->

                <!-- Clients Block-->
               
                <!-- End Clients Block-->

                <!-- Pagination -->
                <div class="text-center md-margin-bottom-30">
                <?php
                    if ($thispage > 1)
                    {
                        $page = $thispage - 1 ;
                        $prevpage = "<li><a href=\"empresas.php?content=listaalfabetica&letra=$letter&page=$page\">Atras</a></li";
                    }
                    else
                    {
                        $prevpage = "<li><a>Anterior</a></li>";
                    }
                    
                if ($totpages >1)
                    {
                        $bar = '';
                        for($page = 1; $page <= $totpages; $page++)
                        {
                            if ($page == $thispage)
                            {
                                $bar .= "<li><a>$page</a></li>";
                            }
                            else
                            {
                                $bar .= "<li><a href=\"empresas.php?content=listaalfabetica&letra=$letter&page=$page\">$page</a></li>";
                            }
                        }
                    }
                    
                if ($thispage < $totpages)
                 {
                    $page = $thispage + 1;
                    $nextpage = "<li><a href=\"empresas.php?content=listaalfabetica&letra=$letter&page=$page\">Adelante</a></li>"; 
                 }else
                 {
                    $nextpage = "<li><a>Proxima</a></li>";
                 }
                   
                    echo "<ul class=\"pagination\">";
                    echo $prevpage;
                    echo $bar;
                    echo $nextpage;
                    echo "</ul>";
                ?>                                                           
                </div>
                <!-- End Pagination -->
            </div><!--/col-md-9-->

        	<div class="col-md-3"><!-- Columna de 3 spacios -->
                <div class="headline headline-md"><h2>Filtros</h2></div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Categorias</a></li>
                        <li><a data-toggle="tab" href="#home-2">Orden Alfabetico</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                             <ul class="list-unstyled">
                                 <?php
                                    foreach ($categories as $category){
                                    $catid = $category['catid'];
                                    $categoria = $category['categoria'];
                                    echo "<li><a href=\"empresas.php?content=categorias&id=$catid\">$categoria</a></li>";
                                    }
                                ?>  
                             </ul>                      
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                                <ul class="list-unstyled">
                                    <?php
                                        foreach ($listaAlfabetica as $letter){
    echo "<li><a href=\"empresas.php?content=listaalfabetica&letra=$letter\">$letter</a><li>";
                                       }
                                    ?>  
                                </ul>                       
                        </div>
                    </div>
                </div>  
            </div><!--/col-md-3-->
        </div><!--/row-->        
    </div><!--/container-->		
    <!--=== End Content Part ===-->
</div>