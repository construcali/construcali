<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">

<!-- CSS Page Style -->
<link rel="stylesheet" href="assets/css/pages/profile.css">
<link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
<!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Recursos</h1>
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
            <h2><a href="blog_item_option1.html"><?php echo $titulo; ?></a></h2>
            <div class="blog-post-tags">
                <ul class="list-unstyled list-inline blog-info">
                    <li><i class="fa fa-calendar"></i> <?php echo $fecha; ?></li>
                    <li><i class="fa fa-pencil"></i> <?php echo $autor; ?></li>
                    <li><i class="fa fa-comments"></i> <a href="#">24 Comments</a></li>
                    <li><i class="fa fa-tags"></i> <?php echo $categoria; ?></li>
                </ul>                    
            </div>
            <p><?php echo $tema; ?></p>
        </div>
        <!--End Blog Post-->        

        <hr>

        <!-- Recent Comments -->
        <div class="media">
            <h3>Comments</h3>
            <a class="pull-left" href="#">
                <img class="media-object" src="assets/img/testimonials/img2.jpg" alt="" />
            </a>
            <div class="media-body">
                <h4 class="media-heading">Media heading <span>5 hours ago / <a href="#">Reply</a></span></h4>
                <p>Donec id erum quidem rerumd facilis est et expedita distinctio lorem ipsum dolorlit non mi portas sats eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna..</p>

                <hr>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="assets/img/testimonials/img5.jpg" alt="" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading <span>17 hours ago / <a href="#">Reply</a></span></h4>
                        <p>Donec id erum quidem rerumd facilis est et expedita distinctio lorem ipsum dolorlit non mi portas sats eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna..</p>
                    </div>
                </div>

                <hr>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="assets/img/testimonials/img1.jpg" alt="" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading <span>2 days ago / <a href="#">Reply</a></span></h4>
                        <p>Donec id erum quidem rerumd facilis est et expedita distinctio lorem ipsum dolorlit non mi portas sats eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna..</p>
                    </div>
                </div>
            </div>
        </div><!--/media-->

        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="assets/img/testimonials/img4.jpg" alt="" />
            </a>
            <div class="media-body">
                <h4 class="media-heading">Media heading <span>July 5,2013 / <a href="#">Reply</a></span></h4>
                <p>Donec id erum quidem rerumd facilis est et expedita distinctio lorem ipsum dolorlit non mi portas sats eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna..</p>
            </div>
        </div><!--/media-->
        <!-- End Recent Comments -->

        <hr>

        <!-- Comment Form -->
        <div class="post-comment">
            <h3>Leave a Comment</h3>
            <form>
                <label>Name</label>
                <div class="row margin-bottom-20">
                    <div class="col-md-7 col-md-offset-0">
                        <input type="text" class="form-control">
                    </div>                
                </div>
                
                <label>Email <span class="color-red">*</span></label>
                <div class="row margin-bottom-20">
                    <div class="col-md-7 col-md-offset-0">
                        <input type="text" class="form-control">
                    </div>                
                </div>
                
                <label>Message</label>
                <div class="row margin-bottom-20">
                    <div class="col-md-11 col-md-offset-0">
                        <textarea class="form-control" rows="8"></textarea>
                    </div>                
                </div>
                
                <p><button class="btn-u" type="submit">Send Message</button></p>
            </form>
        </div>
        <!-- End Comment Form -->
    </div><!--/container-->     
    <!--=== End Content Part ===-->