<!DOCTYPE html lang="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <!--<![endif]-->
<html lang="es">  
<head>
    <!-- Google Analytics -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134524780-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-134524780-1');
    </script>

    <title><?php echo $metaTitulo; ?></title>    

    <!-- Meta, charset used before ISO-8859-1  <meta charset="utf-8">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="directorio de la construccion en Colombia">
    <meta name="author" content="construcali.com">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- El folder de css esta localizado en Documents\Bootstrap\BootStrapTemplate\WorkingTemplateUnify\HTML\assets\css -->

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="assets/css/headers/header-default.css">
    <link rel="stylesheet" href="assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">

     <!-- CSS Page Style -->    
    <link rel="stylesheet" href="assets/css/pages/page_invoice.css">   

    <!-- CSS Theme -->    
    <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- CSS Page Style - Para el formulario de buscar-->    
    <link rel="stylesheet" href="assets/css/pages/page_search_inner.css">
    <!-- CSS usado para las sugerencias cuando se busca algo --> 
    <link rel="stylesheet" href="assets/css/buscar.css">

    <!-- ckeditor -->
    <!-- este enlace va a la version mas sencia, la otra version es Ckeditor/ckeditor.js -->    
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    
</head>	

<body>

<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <?php
            if (empty($loginid)){
            ?>
            <a class="logo" href="http://construcali.com/"><!-- El logo era logocolconstruccion.png -->
                <img src="assets/img/logocolconstruccion.png" width="85" height="32" alt="Logo">
            </a>
            <?php
            }else
            {
            ?>
            <a class="logo" href="http://construcali.com/usuarios.php">
                <!-- El logo era logocolconstruccion.png -->
                <img src="assets/img/logocolconstruccion.png" width="85" height="32" alt="Logo">
            </a>
            <?php
            }
            ?>            
            <!-- End Logo -->
            
            <!-- Topbar -->
            <div class="topbar hidden-xs hidden-sm">
                <ul class="loginbar pull-right">
                    <?php
                    if (!empty($loginid)){
                    ?>
                    <li class="hoverSelector"><a href="usuarios.php">Tablero</a></li>
                    <?php
                    }else
                    {
                    ?>
                    <li class="hoverSelector">
                        Construcali.com
                    </li>
                    <?php
                    }
                    ?>
                    <li class="topbar-devider"></li>   
                    <?php
                        if (isset($sihayempresaid))
                        {
                    ?>
                     <li><a href="empresas.php?content=estaempresa&id=<?php echo $sihayempresaid; ?>" class="btn-u btn-brd btn-brd-hover btn-u-light margin-right-5">Perfil Empresarial</a></li>
                    <?php
                        }elseif(empty($loginid)){
                    ?>
                     <li><a href="usuarios.php" class="btn-u btn-brd btn-brd-hover btn-u-light margin-right-5">Accede</a></li>
                    <?php
                        }else{
                    ?>
                    <li><a href="usuarios.php?content=ajustes" class="btn-u btn-brd btn-brd-hover btn-u-light margin-right-5">Ajustes</a></li>
                    <?php
                    }
                    ?>                     
                    <li class="topbar-devider"></li>   
                    <?php 
                        if (empty($loginid))
                        {
                    ?>   
                        <lli><a href="usuarios.php?content=registrarse" class="btn u-btn-primary g-rounded-50 g-mr-10 g-mb-15">Registrat&eacute;</a></lli>
                         
                    <?php
                        }else
                        {
                    ?>
                        <li><a href="home.php?content=logout">Cerrar Sesion</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <!-- End Topbar -->

            <!-- Toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!-- End Toggle -->
        </div><!--/end container-->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
            <div class="container">
                <ul class="nav navbar-nav">
                    <!-- Cotizar 
                    <li>
                        <a href="anuncios.php?content=cotizar">
                            Cotizar
                        </a>
                    </li>
                    End Cotizar -->
                    <!-- Empresas -->
                    <li>
                        <a href="empresas.php">
                            Empresas
                        </a>
                    </li>
                    <!-- End Empresas -->
                    <!-- Categorias -->                        
                    <li>
                        <a href="analisis.php">
                            Presupuestos
                        </a>
                    </li>
                    <!-- End Categorias -->
                    <!-- Portafolios --> 
                    <li>
                        <a href="https://construcali.com/cotizaciones.php">
                            Cotizar
                        </a>
                    </li> 
                    <!-- Portafoliios -->
                    <!-- Home -->
                    <li>
                        <a href="inicio.php?content=tienda">
                            Libros
                        </a>
                    </li>
                    <!-- End Home --> 
                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!--=== End Header ===-->

    