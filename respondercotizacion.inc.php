<div class="wrapper">
    <!--=== Header ===-->    
    
    <!--=== End Header ===-->

    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
    	<div class="container">
            <h1 class="pull-left">Cotizacion</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="./anuncios.php">Clasificados</a></li>
                <?php
                if (empty($_SESSION['usuario'])) {
                    echo "<li class=\"active\"><a href=\"usuarios.php\">Ponga su Clasificado</a></li>";
                }else
                {
                    echo "<li class=\"active\"><a href=\"anuncios.php?content=anunciar\">Anunciese Gratis</a></li>";
                }
            ?>
            </ul>
        </div><!--/container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">
        <!--Invoice Header-->
        <div class="row invoice-header">
            <div class="col-xs-6">
                 <!-- Tambien puede usar un titulo en vez de una imagen
                 <img src="assets/img/img.jpg" alt="">
                 -->
                <h2 class="pull-left">Respuesta a Cotizacion <?php echo $cotizacionid; ?></h2>
               
            </div>
            <div class="col-xs-6 invoice-numb">
                # de cotizacion: <span class="cotizacionid"><?php echo $cotizacionid; ?></span> 
                <span>fecha: <?php echo $fecha; ?></span>
            </div>
        </div>
        <!--End Invoice Header-->

        <!--Invoice Detials-->
        <div class="row invoice-info">
            <div class="col-xs-6">
                <div class="tag-box tag-box-v3">
                    <h2>Informacion del Cliente:</h2>
                    <ul class="list-unstyled">
                        <li><strong>Nombre:</strong><span id="clienteNombre"><?php echo $nombre; ?></span></li>
                        <li><strong>Apellidos:</strong><span id="clienteApellido"><?php echo $apellidos ?></span></li>
                        <li><strong>Ciudad:</strong><span id="clienteCiudad"><?php echo $ciudad ?></span></li>
                        <li><strong>Telefono:</strong><span id="clienteTelefono"><?php echo $telefono; ?></span></li>
                    </ul>
                </div>        
            </div>
            <div class="col-xs-6">
                <div class="tag-box tag-box-v3"> 
                    <h2 id="datosPago">Datos del Pago:</h2>        
                    <ul class="list-unstyled">
                        <li id="datosBanco"><strong>Nombre del Banco:</strong><a id="infoBanco"> Ej. Banco de Bogota</a></li>
                        <li id="datosCuenta"><strong>Numero de Cuenta:</strong><a id="infoCuenta"> 123456789012</a></li>
                        <li id="datosContacto"><strong>Nombre del Contacto</strong><a id="infoContacto"> Ej: Amanda Palacios</a></li>
                        <li id="datosNit"><strong>N.I.T #:</strong><a id="infoNit"> XXX.XXX.XXX - Y.</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--End Invoice Detials-->

        <!--Invoice Table-->
        <div class="panel panel-default margin-bottom-40">
            <div class="panel-heading">
                <h3 class="panel-title" id="cotiDatos">Datos de la Cotizacion</h3>
            </div>
            <div class="panel-body" id="cotiMensaje">
                <p id="cotizacionMensaje">Escriba aqui el mensaje que desee que el cotizante lea, este mensaje solo aparecera en el documento pdf o impreso. Por ejemplo: puede escribir algo asi como estos materiales ya tienen incluido el iva y se garantizan por una semana o un mes</p>
            </div>
            <form action="usuarios.php" method="post" id="materiales">
            <table class="table table-striped invoice-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Articulo</th>
                        <th class="hidden-sm">Descripcion</th>
                        <th>Cantidad</th>
                        <th>Costo Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
               
                <?php 
                $i = 1;
                foreach ($materiales as $material) {  ?>
                    <tr>
                        <td><?php echo $i;  ?></td>
                        <td id="<?php echo 'material'.$i ?>"><?php echo $material['material']; ?></td>
                        <td class="hidden-sm" id="<?php echo 'articulo'.$i; ?>"><span class="articulo" id="<?php echo $i; ?>">Puede Ampliar la descripcion del Articulo. Ej: Marca, Color, etc</span></td>
                        <td><span id="<?php echo 'cantidad'.$i; ?>"><?php echo $material['cantidad']; ?></span><?php echo $material['unidades']; ?></td>
                        <td><input type="text" name="<?php echo 'unitario'.$i; ?>" id="<?php echo 'unitario'.$i; ?>" value="$"></td>
                        <td><input type="text" name="<?php echo 'precio'.$i; ?>" id="<?php echo 'precio'.$i; ?>" value="$"></td>
                    </tr>
               <?php  $i++; } ?>
                <input type="hidden" name="ordenid" id="ordenid" value="<?php echo $cotizacionid; ?>">
                </tbody>
            </table>
            </form>
        </div>
        <!--End Invoice Table-->

        <!--Invoice Footer-->
        <div class="row">
            <div class="col-xs-6">
                <div class="tag-box tag-box-v3 no-margin-bottom">
                    <address class="no-margin-bottom">
                        <span id="companyNombre"><?php echo $company; ?></span> <br>
                        <span id="companyDirecion"><?php echo $direcion; ?></span> <br>
                        <span id="companyCity"><?php echo $city ?></span> <br>
                        <span id="companyTelefono"><?php echo $telephone; ?></span> <br>
                        <span id="companyEmail">Email: <?php echo $correo;?></span>
                        <span class="cotizacionid"></span>
                    </address>                
                </div>            
            </div>
            <div class="col-xs-6 text-right">
                <ul class="list-unstyled invoice-total-info" id="sumas">
                    <li><strong>Sub - Total:</strong> <input type="text" id="subTotal" name="subTotal" value="$"></li>
                    <li><strong>Descuento:</strong> <input type="text" id="descuento" name="descuento" value="$"></li>
                    <li><strong>IVA:</strong> <input type="text" id="iva" name="iva" value="%"></li>
                    <li><strong>Grand Total:</strong> <input type="text" id="total" name="total" value="$"></li>
                </ul>

                <button class="btn-u sm-margin-bottom-10" onclick="javascript:window.print();"><i class="fa fa-print"></i> Imprimir</button>            
                <button class="btn-u" id="responderCotizacion">Responder la Cotizacion</button>            
            </div>
        </div>
        <!--End Invoice Footer-->
    </div><!--/container-->		
    
</div><!--/wrapper-->

