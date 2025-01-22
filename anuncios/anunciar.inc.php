<!-- CSS para formatear el formulario de anuncios -->
<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<link rel="stylesheet" href="assets/css/pages/profile.css">
<!-- Termina CSS para formulario de anunciar -->
<div class="wrapper">
    <!--=== Header ===-->    
    <!--=== End Header ===-->
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Cotizar</h1>
            <ul class="pull-right breadcrumb">
                <?php if (empty($loginid)) { ?>
                <li><a href="usuarios.php">Acceder</a></li>
                <li><a href="usuarios.php?content=registrarse">Registrarse</a></li>
                <?php 
                }else{
                ?>
                <li><a href="usuarios.php">Panel Usuario</a></li>
                <li><a href="portafolios.php">Portafolios</a></li>
                <?php } ?>
                
                <li><a href="biblioteca.php">Biblioteca</a></li>
            </ul>
        </div><!--/end container-->
    </div>
   <!--/breadcrumbs-->
        <!--/container-->
    <!--/breadcrumbs-->
   
    <!--=== Content ===-->
    <div class="container content">
        <!-- Begin Service Block -->
            <!-- Empieza Anunciarse-->            
            <div class="col-md-9">
                <div class="profile-body">
                    <!--Service Block v3-->
                    <!--/end row-->
                    <!--End Service Block v3-->
                    <!-- Tab v1 -->                
                <div class="tab-v1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#messages" data-toggle="tab">Anunciar</a></li>
                    </ul>                
                    <div class="tab-content">
                    <?php
                    if (empty($usuarioid)){
                    ?>
                        <div class="tab-pane fade in active" id="messages">
                            <div class="row">
                            <div class="col-md-12">
                            <?php
                            if (isset($mensaje)){echo $mensaje;}
                            ?>
                            </div>
                            <form class="sky-form" method="post" action="anuncios.php?content=anunciar_productos" enctype="multipart/form-data" id="clasificadoProductos">
                                <div class="col-md-8">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="title" placeholder="Ponga un titulo descriptivo" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Telefono</label>
                                        <label class="input">
                                            <input type="text" placeholder="Ej: 300 345 678" name="telefono" id="telefono" class="phone">
                                            
                                        </label>
                                    </section>                          
                                </div>
                            
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Nombre</label>
                                        <label class="input">
                                            <input type="text" placeholder="Escriba su Nombre" name="nombre" id="nombre" class="contact">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Apellido</label>
                                        <label class="input">
                                            <input type="text" placeholder="Apellido" name="apellido" id="apellido" class="contact">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Email</label>
                                        <label class="input">
                                            <input type="text" placeholder="email@proveedor.com" name="email" id="email" class="email">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Categoria</label>
                                        <label class="select">
                                            <select name="sector">
                                            <?php
                                                foreach ($categorias as $categoria) {
                                                    //$catid = $categoria['catid'];
                                                    $clase = $categoria['categoria'];
                                                    echo "<option value=\"$clase\">$clase</option>";
                                                }
                                            ?>
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>                              
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Departamento</label>
                                        <label class="select">
                                            <select name="departamento" class="departamento">
                                            <?php
                                                foreach ($departamentos as $departamento) {
                                                    $provincia = $departamento['departamento'];
                                                    echo "<option value=\"$provincia\">$provincia</option>";
                                                }
                                            ?>
                                                
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>              
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Ciudad</label>
                                        <label class="input">
                                            <input type="text" class="ciudad" name="ciudad" id="municipio">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Foto</label>
                                            <label for="file" class="input input-file">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
                                            <div class="button"><input type="file" id="file" name="picture" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                        </label>
                                    </section>     
                                    <section>
                                        <label class="label">Describa los materiales/productos/maquinaria que ofrece</label>
                                        <label class="textarea">
                                            <textarea rows="3" name="productos" id="productos"></textarea>
                                        </label>
                                    </section>
                                    <div>
                                    <button type="submit" class="btn-u">Anunciar</button>
                                    </div>
                                </div>
                            
                            </form>
                            </div>
                        </div>
                        <?php
                            }else{

                        ?>
                        <!--  Formulario si ha entrado como usuarioa -->
                        <div class="tab-pane fade in active" id="messages">
                            <div class="row">
                            <div class="col-md-12">
                            <?php
                            if (isset($mensaje)){echo $mensaje;}
                            ?>
                            </div>
                            <form class="sky-form" method="post" action="usuarios.php?content=productos" enctype="multipart/form-data" id="clasificadoProductos">
                             <div class="col-md-12">
                                <div class="col-md-8">
                                    <section>
                                        <label class="label">Titulo</label>
                                        <label class="input">
                                            <input type="text" name="titulo" id="title" placeholder="Que Vende?" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Telefono</label>
                                        <label class="input">
                                            <input type="text" value="<?php echo $telephone; ?>" name="telephone" id="telephone" class="phone">
                                            
                                        </label>
                                    </section>                          
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <section>
                                        <label class="label">Categoria</label>
                                        <label class="select">
                                            <select name="sector">
                                            <?php
                                                foreach ($categorias as $categoria) {
                                                    //$catid = $categoria['catid'];
                                                    $clase = $categoria['categoria'];
                                                    echo "<option value=\"$clase\">$clase</option>";
                                                }
                                            ?>
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>                              
                                </div>
                                <div class="col-md-4">
                                    <section>
                                        <label class="label">Departamento</label>
                                        <label class="select">
                                            <select name="departamento" class="departamento">
                                            <?php
                                                foreach ($departamentos as $departamento) {
                                                    $provincia = $departamento['departamento'];
                                                    echo "<option value=\"$provincia\">$provincia</option>";
                                                }
                                            ?>
                                                
                                            </select>
                                            <i></i>
                                        </label>
                                    </section>              
                                </div>
                                <div class="col-md-3">
                                    <section>
                                        <label class="label">Ciudad</label>
                                        <label class="input">
                                            <input type="text" name="ciudad" value="<?php echo $city; ?>" class="ciudad" id="municipio">
                                            
                                        </label>
                                    </section>                          
                                </div>
                                <div class="col-md-12">
                                    <section>
                                        <label class="label">Foto</label>
                                            <label for="file" class="input input-file">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
                                            <div class="button"><input type="file" id="file" name="picture" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                        </label>
                                    </section>     
                                    <section>
                                        <label class="label" id="errorProductos">Describa los materiales/productos/maquinaria que ofrece</label>
                                        <label class="textarea">
                                            <textarea rows="3" name="productos" id="productos"></textarea>
                                        </label>
                                    </section>
                                    <div>
                                    <button type="submit" class="btn-u" id="botonAnunciarProductos">Anunciar</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                </div>
            </div>
            <!-- Termina Anunciarse -->
        <!-- End Begin Service Block -->

        <!-- Job Content -->
            <!-- Right Sidebar -->
            <div class="col-md-3 magazine-page">
                <!-- Search Bar -->
               
                <!-- End Search Bar -->

                <!-- Posts -->
                <!--/posts-->
                <!-- End Posts -->

                <!-- Tabs Widget -->
                <div class="headline headline-md"><h2>De Su Interes</h2></div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Categorias</a></li>
                        <li><a data-toggle="tab" href="#home-2">Enlaces</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                            <ul class="list-unstyled">
                                 <?php
                                    foreach ($categories as $category){
                                        $category = htmlentities($category);
                                    echo "<li><a href=\"anuncios.php?content=productos&sector=$category\">$category</a></li>";
                                    }
                                ?>  
                             </ul>                          
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <div class="row">
                                <ul class="list-unstyled col-xs-6">
                                    <li><a target="_blank" href="http://issuu.com/ximenavelez/docs/revista_colconstruccion">1ra Revista</a></li>
                                    <li><a target="_blank" href="http://issuu.com/ximenavelez/docs/colconstruccion_segunda_edici__n_-_/1?e=8415614/11091375">2da Revista</a></li>
                                    <li><a target ="_blank" href="https://issuu.com/colconstruccion/docs/colconstruccioned3-5_imprimir">3ra Revista</a></li>
                                    <li><a target ="_blank"href="http://www.casadeplastico.org/">Ecoplasso</a></li>
                                    <li><a target="_blank"href="http://placaya.jimdo.com/">Placa Ya</a></li>
                                    
                                    <li><a href="portafolios.php?content=descargas">Biblioteca</a></li>
                                </ul>                        
                                <ul class="list-unstyled col-xs-6">
                                    <li><a href="catalogos.php?content=catcontenido">Catalogos</a></li>
                                    <li><a href="portafolios.php">Portafolios</a></li>
                                    <li><a href="biblioteca.php">Recursos</a></li>
                                    <li><a href="inicio.php?content=precios">Servicios</a></li>
                                    <li><a target="_blank" href="http://constructoradcpmoya.jimdo.com/">Constructora</a></li>
                                    <li><a href="portafolios.php?content=boletines">Boletines</a></li>
                                </ul>                        
                            </div>
                        </div>
                    </div>
                </div> 

                <!-- Photo Stream -->
            
                <!-- End Photo Stream -->

                <!-- Blog Tags -->
                
                <!-- End Blog Tags -->

                <!-- Blog Latest Tweets -->
                
                <!-- End Blog Latest Tweets -->
            </div>
            <!-- End Right Sidebar -->
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