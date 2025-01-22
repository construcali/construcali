<link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
<link rel="stylesheet" href="assets/css/pages/profile.css">
<!--
<link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
-->
 <!-- CSS Page Style -->

<!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Correo Masivo</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="usuarios.php?content=cotizaciones">Panel Usuario</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
                <li><a href="foros.php">Foros</a></li>
            </ul>
        </div>
    </div>
<!--=== End Breadcrumbs ===-->
 <!--=== Profile ===-->

    <div class="container content profile">	
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 magazine-page">
                <div class="headline headline-md"><a class="btn-u btn-block btn-u-green" href="usuarios.php?content=cotizaciones">Panel Usuario</a> </div>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home-1">Nuestros Servicios</a></li>
                        <li><a data-toggle="tab" href="#home-2">Enlaces</a></li>
                    </ul>                
                    <div class="tab-content">
                        <div id="home-1" class="tab-pane active">
                            <p><a href="anuncios.php?content=anunciar" class="btn-u btn-block">Vender</a></p>
                            <p><a href="anuncios.php?content=cotizar" class="btn-u btn-block">Cotizar</a></p>
                            <p><a href="usuarios.php?content=cotizaciones" class="btn-u btn-block">Correo</a></p>
                            <p><a href="foros.php?content=nuevoforo" class="btn-u btn-block">Nuevo Foro</a></p>                        
                        </div>
                        <div id="home-2" class="tab-pane magazine-sb-categories">
                            <div class="row">
                                <ul class="list-unstyled col-xs-6">
                                    <li><a target="_blank" href="http://issuu.com/ximenavelez/docs/revista_colconstruccion">1ra Revista</a></li>
                                    <li><a target="_blank" href="http://issuu.com/ximenavelez/docs/colconstruccion_segunda_edici__n_-_/1?e=8415614/11091375">2da Revista</a></li>
                                    <li><a target ="_blank" href="https://issuu.com/colconstruccion/docs/colconstruccioned3-5_imprimir">3ra Revista</a></li>
                                    <li><a target="_blank"href="http://placaya.jimdo.com/">Placa Ya</a></li>
                                    <li><a target="_blank" href="http://constructoradcpmoya.jimdo.com/">Constructora</a></li>
                                    <li><a target="_blank" href="http://indimacol.jimdo.com/">Indimacol</a></li>
                                </ul>                        
                                <ul class="list-unstyled col-xs-6">
                                    <li><a target="_blank" href="http://andamioskay.jimdo.com/">Kayonsaa</a></li>
                                    <li><a target="_blank" href="http://enlacespuntoapunto.jimdo.com/">Punto a Punto</a></li>
                                    <li><a target="_blank" href="http://cromalux.jimdo.com/">Tito Pabon</a></li>
                                    <li><a target="_blank" href="http://tecnipinturas.jimdo.com/">Tecnipinturas</a></li>
                                    <li><a href="http://www.shareasale.com/r.cfm?b=499404&u=623714&m=37723&urllink=&afftrack=">Weebly</a></li>
                                    <li><a href="http://www.shopify.com/?ref=colconstruccion-com" target="_blank">Tienda virtual</a></li>
                                </ul>                        
                            </div>
                        </div>
                    </div>
                </div>  
                
            </div>
            <!--End Left Sidebar-->

            <!-- Profile Content -->            
            <div class="col-md-9 md-margin-bottom-60">
                <div class="profile">
                    <form enctype="multipart/form-data" action="ofertas.php?content=subiroferta" method="post" class="sky-form" id="subirOferta">
                        <fieldset>
                            <section>
                                <label class="label">Titulo</label>
                                <label class="input">
                                <input type="text" name="titulo" id="titulo" maxlength="40">
                                </label>
                            </section>
                            <section>
                            <label class="label">Enviar a Empresas en la Categoria de:</label>
                                <label class="select">
                                    <select name="categoria">
                                        <?php
                                            foreach ($categorias as $categoria)
                                                {
                                                    $catid = $categoria['catid'];
                                                    $category = $categoria['categoria'];
                                                    $category = htmlentities($category);
                                                    $catArray[$catid] = $category;    
                                                }
                                                    asort($catArray);
                                                    foreach ($catArray as $indicador => $valor){
                                                    echo "<option value=\"$indicador\">$valor</option>";
                                                } //closes for each
                                        ?>
                                    </select>
                                        <i></i>
                                    </label>
                            </section>
                            <section>
                                <label class="label">Una Foto</label>
                                <label for="file" class="input input-file">
                                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                                <div class="button"><input type="file" id="file" name="presentacion" onchange="this.parentNode.nextSibling.value = this.value">Buscar</div><input type="text" readonly>
                                </label>
                                </section>                  
                                <section>
                                <label class="label">Explique su oferta en menos de 200 caracteres</label>
                                <label class="textarea">
                                <!-- <i class="icon-prepend fa fa-user"></i>
                                <i class="icon-append fa fa-asterisk"></i> -->
                                <textarea rows="3" name="oferta" id="oferta" placeholder="Describa productos o servicios, precios y duracion de la oferta"></textarea>
                                <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'oferta' );
                                </script>
                                </label>
                            </section>    
                                                    
                            <button type="submit" class="btn-u text-center">Enviar Correo Masivo</button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- End Profile Content -->            
        </div><!--/end row-->
    </div>		
    <!--=== End Profile ===-->