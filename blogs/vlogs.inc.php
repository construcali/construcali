<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">

<!-- CSS Page Style -->
<link rel="stylesheet" href="assets/css/pages/profile.css">
<link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
<!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Blogs</h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="https://construcali.com/blogs.php">Blog</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
            </ul>
        </div>
    </div>
<!--=== End Breadcrumbs ===-->
<!--=== Profile ===-->
    <div class="container content blog-page">
        <div class="row">
           <!-- la Seccion de blogs -->
            <div class="container content-md">
                 <!--=== Blog Posts ===-->
                    <?php 
                        foreach ($enlaces as $enlace) {
                            $productoid = $enlace['productoid'];
                            $titulo = $enlace['titulo'];      
                            $catid = $enlace['catid'];
                            $url = $enlace['url'];
                            $categoria = $main->con_casilla(categoria,categorias,catid,$catid);
                            $fecha = $enlace['date'];
                            $vlog = $enlace['tema'];
                            $tema = substr($vlog,0,500);
                            $autorid = $enlace['usuarioid'];
                            $main->entrar();
                            $autor = $main->con_casilla(nombre,usuarios,usuarioid,$autorid);
                            $main->login();
                    ?>
                    <!-- News v3 -->
                    <div class="row margin-bottom-20">
                        <div class="col-sm-5 sm-margin-bottom-20">
                            <img class="img-responsive" src="<?php echo $url; ?>" alt="">
                        </div>
                        <div class="col-sm-7">
                            <div class="news-v3">
                                <ul class="list-inline posted-info">
                                    <li><?php echo $autor; ?></li>
                                    <li>En <a href="#"><?php echo $categoria; ?></a></li>
                                    <li><?php echo $fecha; ?></li>
                                </ul>
                                <h2><a href="blogs.php?content=vervlog&blogid=<?php echo $productoid; ?>"><?php echo $titulo; ?></a></h2>
                                <p><?php echo $tema; ?>...</div></p> <!-- como se corta el texto del blog entonces no se trae o no se pone el div que cierra, entonce hay que ponerlo -->
                                <!-- <ul class="post-shares">
                                    <li>
                                        <a href="#">
                                            <i class="rounded-x icon-speech"></i>
                                            <span>5</span>
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="rounded-x icon-share"></i></a></li>
                                    <li><a href="#"><i class="rounded-x icon-heart"></i></a></li>
                                </ul>-->
                            </div>
                        </div>
                    </div><!--/end row-->
                    <!-- End News v3 -->

                    <div class="clearfix margin-bottom-20"><hr></div>
                    <?php
                        }
                    ?>
                <!-- Pager v3 -->
                    <div>

                        <ul class="pager pager-v3 pager-md no-margin-bottom">
                                <?php
                                 if ($thispage > 1)
                                    {
                                        $page = $thispage - 1 ;
                                        $prevpage = "<li class=\"previous\"><a href=\"blogs.php?page=$page\">&larr; Anterior</a></li>";
                                    }
                                    else
                                    {
                                        $prevpage = "<li><a href=\"#\">&larr; Anterior</a></li>";
                                    }
                                    
                                if ($totpages >1)
                                    {
                                        $bar = '';
                                        for($page = 1; $page <= $totpages; $page++)
                                        {
                                            if ($page == $thispage)
                                            {
                                                $bar .= "<li class=\"page-amount\"><a href=\"#\">$page of $totpages</a></li>";
                                            }
                                            else
                                            {
                                                $bar .= "<li class=\"page-amount\"><a href=\"blogs.php?page=$page\">$page</a></li>";
                                            }
                                        }
                                    }
                                    
                                if ($thispage < $totpages)
                                 {
                                    $page = $thispage + 1;
                                    $nextpage = "<li class=\"next\"><a href=\"blogs.php?page=$page\">Proxima &rarr;</a></li>"; 
                                 }else
                                 {
                                    $nextpage = "<li class=\"next\"><a href=\"#\">Proxima &rarr;</a></li>";
                                 }
                                    echo $prevpage;
                                    echo $bar;
                                    echo $nextpage;
                                ?>
                        </ul> 
                        <!-- <ul class="pager pager-v3 pager-md no-margin-bottom">
                            <li class="previous"><a href="#">&larr; Older</a></li>
                            <li class="page-amount">1 of 7</li>
                            <li class="next"><a href="#">Newer &rarr;</a></li>
                        </ul> -->
                    </div>
                    <!-- End Pager v3 -->
                <!--/end container-->
            </div>
            <!--=== End Blog Posts ===-->

        </div>
    </div>
      
    <!--=== End Profile ===-->