<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Empresas</h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="https://construcali.com/blogs.php">Blog</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
            </ul>
        </div><!--/end container-->
    </div>
   <!--/breadcrumbs-->
        <!--/container-->
    <!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->
    <!--=== Content ===-->
    <div class="container content">
        <!-- Job Content -->
        <div class="headline"><h2>Categorias de Empresas</h2></div>
        <div class="row job-content margin-bottom-40">
            <?php
            foreach ($categories as $category){
            $catid = $category['catid']; 
            echo "<div class=\"col-md-3 col-sm-3 md-margin-bottom-40\">";
                echo "<ul class=\"list-unstyled categories\">";
                    echo "<li><a href=\"empresas.php?content=categorias&id=$catid\">".$category['categoria']."</a> <small class=\"hex\">(".$category['cantidad'].")</small></li>";
                echo "</ul>";
            echo "</div>";
            }
            ?>
        </div>        
        <!-- End Job Content -->
        <!--lista Alfabetica-->
        <div class="text-center">
                    <ul class="pagination">
    <?php 
    foreach ($listaAlfabetica as $letter)
    echo "<li><a href=\"empresas.php?content=listaalfabetica&letra=$letter\">$letter</a><li>";
    ?>
                    </ul>
        </div>
        <!-- end lista Alfabetica-->
        <!-- Top Categories -->
        <div class="headline"><h2>Ultimas Empresas</h2></div>  
        <div class="row category margin-bottom-20" id="listado">
            <!-- Info Blocks -->
            <?php
            foreach($companies as $compania)
            {
            $categoria = $compania['categoria'];
            $empresaid = $compania['empresaid']; 
            $empresa = $compania['empresa'];
            $empresa = trim($empresa);
            $empresa = strip_tags($empresa);
            $empresa = nl2br($empresa);
            //$empresa = wordwrap($empresa,26,"</h3><h3>",false);
            //para conseguir el logo
            $logo = $main->con_casilla(foto,logos,empresaid,$empresaid);
            //Formatera el numbero de Whatsapp
            $whatsapp = $main->con_casilla(whatsapp,redessociales,empresaid,$empresaid);
            $whatsapp = trim($whatsapp);
            $wsnumber = explode(" ", $whatsapp);
            $whatsapp = implode($wsnumber);
            if (empty($logo))
                $logo = 'LogoCasco.png';    
            echo "<div class=\"col-md-6 col-sm-6\">";
                echo "<div class=\"content-boxes-v3 margin-bottom-10 md-margin-bottom-20\">";
                    echo "<i><img src=\"logo/$logo\" alt=\"Logo Empresarial\" style=\"float:left\" width=\"50px\" height=\"45px\"></i>";
                    echo "<div class=\"content-boxes-in-v3\">";
                        echo "<h3><a href=\"empresas.php?content=estaempresa&id=$empresaid\">{$empresa}</a></h3>";
                        echo "<p>{$categoria}<p><h5><i class=\"fa fa-whatsapp color-green\"></i><a href=\"https://wa.me/{$whatsapp}\">{$whatsapp}</a></h5>";
                    echo "</div>";
                echo "</div>";
            echo "</div>"; 
            }
            ?>   
            <!-- End Info Blocks -->
            <!-- Info Blocks -->
            <!-- End Info Blocks -->
            
            <!-- id=linksContenido se llama desde el javascript paginacion.js --> 
            <!-- End Section-Block -->     
        </div>
        <!-- Paginacion-->
        <div class="text-center">
            <ul class="pagination" id="linksContenido">
            <?php 
                echo "<li><a href=\"vistas/empresas/paginacion.php?page=$thispage\">&laquo;</a></li>";
            if ($totpages > 1)
                {
                    $bar = '';
                    for($page = 1; $page < $totpages; $page++)
                        {
                            if($page == $thispage)
                            { 
                                $bar .= "<li><a href=\"vistas/empresas/paginacion.php?page=$page\">$page</a></li>";
                            }else
                            {
                        $bar .= "<li><a href=\"vistas/empresas/paginacion.php?page=$page\">$page</a></li>";
                            }      
                        }
                }
                        echo $bar;
            if ($thispage < $totpages)
            { 
                $page = $totpages;
                echo "<li><a href=\"vistas/empresas/paginacion.php?page=$page\">&raquo;</a></li>";
            } 
            ?>
             </ul>                                                            
        </div>     
        <!-- End Paginacion -->
        <!-- End Top Categories -->
    </div><!--/container-->     
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

