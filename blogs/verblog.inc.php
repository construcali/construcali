<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">

<!-- CSS Page Style -->
<link rel="stylesheet" href="assets/css/pages/profile.css">
<link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
<!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="blogs.php">Blog</h1>
            <ul class="pull-right breadcrumb">
                <li class="active"><a href="inicio.php?content=tienda">Tienda</a></li>
                <li><a href="inicio.php?content=tutoriales">Tutoriales</a></li>
                <li><a href="biblioteca.php?content=enlaces">Recursos</a></li>
            </ul>
        </div>
    </div>
<!--=== End Breadcrumbs ===-->
<!--=== Content Part ===-->
    <div class="container content blog-page blog-item">     
        <!--Blog Post-->        
        <div class="blog margin-bottom-40">
            <div class="blog-img">
                <img class="img-responsive full-width" src="<?php echo $url; ?>"  alt="<?php echo $titulo; ?>">
            </div>
            <h2><a href="blogs.php?content=vervlog&blogid=<?php echo $blogid; ?>"><?php echo $titulo; ?></a></h2>
            <div class="blog-post-tags">
                <ul class="list-unstyled list-inline blog-info">
                    <li><i class="fa fa-calendar"></i> <?php echo $fecha; ?></li>
                    <li><i class="fa fa-pencil"></i> <?php echo $autor; ?></li>
                    <!-- <li><i class="fa fa-comments"></i> <a href="#">24 Comments</a></li> -->
                    <li><i class="fa fa-tags"></i> <?php echo $categoria; ?></li>
                    <li><iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo urlencode($enlace); ?>&layout=button_count&size=small&mobile_iframe=true&width=100&height=20&appId" width="100" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe></li>
                    <!-- <li><a data-original-title="LinkedIn" href="http://www.linkedin.com/shareArticle?mini=True&url=<?php echo urlencode($url); ?>&title=<?php echo urlencode($titulo); ?>" target="_blank">Compartir en LinkedIn</a></li> -->
                </ul>                    
            </div>
            <p><?php echo $tema; ?></p>
        </div>
        <!--End Blog Post-->        

        <hr>

        <!-- Recent Comments -->
        
        <!-- End Recent Comments -->

        

        <!-- Comment Form -->
        
        <!-- End Comment Form -->
    </div><!--/container-->     
    <!--=== End Content Part ===-->