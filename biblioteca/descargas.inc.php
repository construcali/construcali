<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">

<!-- CSS Page Style -->
<link rel="stylesheet" href="assets/css/pages/profile.css">
<link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
<!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Biblioteca</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="biblioteca.php">Biblioteca</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
                <li><a href="portafolios.php">Portafolios</a></li>
            </ul>
        </div>
    </div>
<!--=== End Breadcrumbs ===-->
<!--=== Profile ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 magazine-page">
                <!-- Search Bar -->
                <div class="headline headline-md"><h2>Buscar</h2></div>            
                <div class="input-group margin-bottom-40">
                <form method="post" action="portafolios.php?content=buscar">
                    <input type="text" name="palabraClave" class="form-control" placeholder="Buscar">
                    <span class="input-group-btn">
                        <button type="submit" class="btn-u" type="button">Buscar</button>
                    </span>
                </form>    
                </div>
                <!-- End Search Bar -->

                <!-- Posts -->
                <!-- Blog large right sidebar item se uso como formato -->
                <!--/posts-->
                <!-- End Posts -->

                <!-- Tabs Widget -->
                <div class="headline headline-md"><h2>Filtros</h2></div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Categorias</a></li>
                        <li><a data-toggle="tab" href="#home-2">Enlaces</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                            <div class="row">
                                <ul class="list-unstyled col-xs-12">
                                <?php
                                    foreach ($categorias as $key => $value) {
                                         echo "<li><a href=\"biblioteca.php?content=estasdescargas&catid=$key\"><i class=\"fa fa-tags\"></i>$value</a></li>";
                                     } 
                                ?>      
                                </ul>
                            </div>                    
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <div class="row">
                                <ul class="list-unstyled col-xs-6">
                                    <li><a target="_blank" href="http://issuu.com/ximenavelez/docs/revista_colconstruccion">1ra Revista</a></li>
                                    <li><a target="_blank" href="http://issuu.com/ximenavelez/docs/colconstruccion_segunda_edici__n_-_/1?e=8415614/11091375">2da Revista</a></li>
                                    <li><a target ="_blank" href="https://issuu.com/colconstruccion/docs/colconstruccioned3-5_imprimir">3ra Revista</a></li>
                                    <li><a target="_blank" href="https://issuu.com/colconstruccion/docs/colconstruccion_ed4_lk_revista">4ta Revista</a></li>
                                    <li><a target="_blank"href="https://issuu.com/colconstruccion/docs/colconstruccion_ed5">5ta Revista</a></li>
                                    <li><a target="_blank" href="portafolios.php">Portafolios</a></li>
                                    
                                    
                                </ul>                        
                                <ul class="list-unstyled col-xs-6">
                                    <li><a target="_blank" href="http://andamioskay.jimdo.com/">Kayonsaa</a></li>
                                    <li><a target="_blank" href="http://enlacespuntoapunto.jimdo.com/">Punto a Punto</a></li>
                                    <li><a target="_blank" href="http://cromalux.jimdo.com/">Tito Pabon</a></li>
                                    <li><a target="_blank" href="https://es.jimdo.com/#ref=a506034">Jimdo.com</a></li>
                                    <li><a href="http://www.shareasale.com/r.cfm?b=499404&u=623714&m=37723&urllink=&afftrack=">Weebly</a></li>
                                    <li><a href="http://www.shopify.com/?ref=colconstruccion-com" target="_blank">Tienda virtual</a></li>
                                </ul>                        
                            </div>
                        </div>
                    </div>
                </div>            
                <!-- End Tabs Widget -->

                <!-- Photo Stream -->
                
                <!-- End Photo Stream -->

                <!-- Blog Tags -->
        
                
                <!-- End Blog Tags -->
                
            </div>
            <!--End Left Sidebar-->

            <!-- Profile Content -->                
            <div class="col-md-9 col-sm-12">
                       
                <div class="panel panel-green margin-bottom-40">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-tasks"></i> Enlaces de Interes</h3>
                        </div>
                                                     
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Descargar</th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($enlaces as $enlace) {
                                $productoid = $enlace['productoid'];
                                $nombre = $enlace['nombre'];
                                $nombre = nl2br($nombre);
                                $nombre = htmlentities($nombre);      
                                $catid = $enlace['catid'];
                                $url = $enlace['url'];
                                //$creditos = $enlace['creditos'];
                                $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
                            ?>
                                <tr>
                                    <td><?php echo "<a href=\"$url\" target=\"_blank\">{$nombre}</a>"; ?></td>
                                    
                                    <td><span class="label label-warning"><?php echo $categoria; ?></span></td>                          
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!--Pegination Centered-->
                    <div class="tag-box tag-box-v7 text-justify"> 
                        <div class="text-center">
                            <ul class="pagination">
                            <?php
                             if ($thispage > 1)
                                {
                                    $page = $thispage - 1 ;
                                    $prevpage = "<li class=\"active\"><a href=\"biblioteca.php?content=descargas&page=$page\">Anterior</a></li>";
                                }
                                else
                                {
                                    $prevpage = "<li><a href=\"#\">Anterior</a></li>";
                                }
                                
                            if ($totpages >1)
                                {
                                    $bar = '';
                                    for($page = 1; $page <= $totpages; $page++)
                                    {
                                        if ($page == $thispage)
                                        {
                                            $bar .= "<li><a href=\"#\">$page</a></li>";
                                        }
                                        else
                                        {
                                            $bar .= "<li><a href=\"biblioteca.php?content=descargas&page=$page\">$page</a></li>";
                                        }
                                    }
                                }
                                
                            if ($thispage < $totpages)
                             {
                                $page = $thispage + 1;
                                $nextpage = "<li><a href=\"biblioteca.php?content=descargas&page=$page\">Proxima</a></li>"; 
                             }else
                             {
                                $nextpage = "<li><a href=\"#\">Proxima</a></li>";
                             }
                                echo $prevpage . $bar . $nextpage;
                            ?>
                            </ul>                                                            
                        </div>
                    </div>
                    <!--End Pegination Centered-->
                
            </div>
            <!-- la Seccion de portafolios -->
            
            <!-- End Profile Content -->                
        </div>
    </div>      
    <!--=== End Profile ===-->