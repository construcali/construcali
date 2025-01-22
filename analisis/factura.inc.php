<!--=== Breadcrumbs ===-->
     <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Presupuestos</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="analisis.php">Categorias</a></li>
                <li><a href="analisis.php?content=lista">Ver Lista</a></li>
                <li><a href="analisis.php?content=factura&boton=editar">Editar Factura</a></li>
            </ul>
        </div><!--/end container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content" id="html2pdf">
        <!-- Empieza la factura  -->
        <!--Invoice Header-->
        <div class="row invoice-header">
            <div class="col-xs-6" id="logo">
                <img src="<?php echo $logo; ?>" width="100" alt="Logo de la Empresa">
                <!-- You also can use a title instead of image
                <h2 class="pull-left">Product Invoice</h2>
                -->
            </div>
            <div class="col-xs-4 invoice-numb" id="invoice">
                <span>Fecha: <?php echo $fecha; ?></span>
                <span>Numero de Factura: <?php echo $numero_factura; ?></span>
            </div>
            
        </div>
        <!--End Invoice Header-->

        <!--Invoice Detials-->
        <div class="row invoice-info">
            <div class="col-xs-6">
                <div class="tag-box tag-box-v3">
                    <h2>Informacion del Cliente:</h2>
                    <ul class="list-unstyled" id="infoCliente">
                        <table class="table table-bordered u-table--v2">
                        <tr><li><td><strong>Nombre: </strong></td><td><?php echo $nombre; ?></td></li></tr>
                        <tr><li><td><strong>Apellidos:</strong></td><td><?php echo $apellidos; ?></td></li></tr>
                        <tr><li><td><strong>Telefono:</strong></td><td><?php echo $telefono; ?></td></li></tr>
                        <tr><li><td><strong>Email:</strong></td><td><?php echo $email; ?></td></li></tr>
                        </table>
                    </ul>
                </div>        
            </div>
            <div class="col-xs-6">
                <div class="tag-box tag-box-v3">
                    <h2>Direcion de Entrega:</h2>        
                    <ul class="list-unstyled" id="infoBanco">
                        <table class="table invoice-table">
                        <tr><li><td><strong>Direcion: </strong></td><td><?php echo $direcion; ?></td></li></tr>
                        <tr><li><td><strong>Barrio: </strong></td><td><?php echo $barrio; ?></td></li></tr>
                        <tr><li><td><strong>Ciudad: </strong></td><td><?php echo $ciudad; ?></td></li></tr>
                        <tr><li><td><strong>Departamento: </strong></td><td><?php echo $departamento; ?></td></li></tr>
                        </table>
                    </ul>
                </div>
            </div>
        </div>
        <!--End Invoice Detials-->

        <!--Invoice Table-->
        <div class="panel panel-default margin-bottom-40">
            <div class="panel-heading">
                <h3 class="panel-title">Su lista de materiales</h3>
            </div>
            <div class="panel-body">
                <p><?php echo $mensaje_factura; ?></p>
            </div>
            <!-- <form> -->
                <table class="table table-striped invoice-table">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Articulo</th>
                            <th class="hidden-sm">Unidades</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php for($k=0; $k<$counter; $k++){ ?>
                        <tr>
                            <td><?php echo $quantity[$k]; ?></td>
                            <td><?php echo $stock[$k]; ?></td>
                            <td class="hidden-sm"><?php echo $unit[$k]; ?></td>
                            <td><?php echo $precio[$k]; ?></td>
                            <td><?php echo $subtotal[$k]; ?></td>
                            
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <!-- </form> -->
        </div>
        <!--End Invoice Table-->

        <!--Invoice Footer-->
        <div class="row">
            <div class="col-xs-6">
                <div class="tag-box tag-box-v3 no-margin-bottom">
                    <address class="no-margin-bottom" id="infoEmpresa">
                        <?php echo $compani_empresa; ?> <br>
                        <?php echo $compania_direcion; ?> <br>
                        <?php echo $compania_ciudad; ?><br>
                        <?php echo 'Telefono.:'. $compania_telefono; ?> <br>
                        Email: <?php echo $compania_email; ?> <br>
                        Pagina Web: <?php echo $compania_url; ?>
                    </address>                
                </div>            
            </div>
            <div class="col-xs-6 text-right">
                <ul class="list-unstyled invoice-total-info">
                    <li id="amount"><strong>Valor de los Materiales: $</strong><?php echo $valor; ?></li>
                    <li id="iva"><strong>Impuestos:</strong><?php echo $iva; ?></li>
                    <li id="granTotal"><strong>Gran Total: $</strong><?php echo $total; ?></li>
                </ul>
                <button class="btn-u sm-margin-bottom-10" onclick="javascript:window.print();"><i class="fa fa-print"></i>Imprimir</button>                    
            </div>
        </div>
        <!--Termina la factura -->
    </div><!--/container-->		
    <!--=== End Content Part ===-->