
<!--=== Breadcrumbs ===-->
     <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><a href="analisis.php">Cotizar</a></h1>
            <ul class="pull-right breadcrumb">
                <?php if (empty($usuarioid)) { ?>
                <li class="active"><a href="usuarios.php">Acceder</a></li>
                <li><a href="usuarios.php?content=registrarse">Registrarse</a></li>
                <?php 
                }else{
                ?>
                <li><a href="usuarios.php">Panel Usuario</a></li>
                <li><a href="analisis.php?content=lista">Editar Lista</a></li>
                <?php } ?>
                
                <li><a href="biblioteca.php">Biblioteca</a></li> 
            </ul>
        </div><!--/end container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">
        <form method="post" action="analisis.php?content=factura"> <!-- Empieza el formulario  -->
        <!--Invoice Header-->
        <div class="row invoice-header">
            <div class="col-xs-6" id="logo">
                <img src="<?php echo $logo; ?>" width="80" alt="Logo de la Empresa">
                <!-- You also can use a title instead of image
                <h2 class="pull-left">Product Invoice</h2>
                -->

            </div>
            <div class="col-xs-4 invoice-numb" id="invoice">
                <span>Fecha: <input type="text" name="fecha" value="<?php echo date("d,m,Y"); ?>"></span>
                <span>Numero de Factura: <input type="text" name="numero_factura" value="1233456789"></span>
            </div>
            
        </div>
        <!--End Invoice Header-->

        <!--Invoice Detials-->
        <div class="row invoice-info">
            <div class="col-xs-6">
                <div class="tag-box tag-box-v3">
                    <h2>Informacion del Cliente:</h2>
                    <ul class="list-unstyled" id="infoCliente">
                        <table class="table u-table--v2">
                        <tr><li><td><strong>Nombre: </strong></td><td><input type="text" size="40" name="nombre" value="<?php echo $contacto['nombre']; ?>"></td></li></tr>
                        <tr><li><td><strong>Apellidos: </strong></td><td><input type="text" size="40"  name="apellidos" value="<?php echo $contacto['apellidos']; ?>"></td></li></tr>
                        <tr><li><td><strong>Numero Telefonico: </strong></td><td><input type="text" size="40"  name="telefono" value="<?php echo $contacto['telefono']; ?>"></td></li></tr>
                        <tr><li><td><strong>Correo Electronico: </strong></td><td><input type="text" size="40"  name="email" value="<?php echo $contacto['email']; ?>"></td></li></tr>
                        </table>
                    </ul>
                </div>        
            </div>
            <div class="col-xs-6">
                <div class="tag-box tag-box-v3">
                    <h2>Direcion de Entrega:</h2>        
                    <ul class="list-unstyled" id="infoBanco">
                        <table class="table u-table--v2">
                        <tr><li><td><strong>Direcion: </strong></td><td><input type="text" size="40" name="direcion" value=""></td></li></tr>
                        <tr><li><td><strong>Barrio: </strong></td><td><input type="text" size="40" name="barrio" value=""></td></li></tr>
                        <tr><li><td><strong>Ciudad: </strong></td><td><input type="text" size="40" name="ciudad" value=""></td></li></tr>
                        <tr><li><td><strong>Departamento: </strong></td><td><input type="text" size="40" name="departamento" value=""></td></li></tr>
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
                <p><textarea cols="80" rows="1" name="mensaje_factura">Aqui puede poner un mensaje o instruciones relacionadas con la factura</textarea></p>
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
                    <?php $i=1; ?>
                    <?php foreach ($materiales as $material): ?>
                        <tr>
                            <td><input type="text" size="5" name="<?php echo 'cantidad'.$i; ?>" value="<?php echo $material['cantidad']; ?>"></td>
                            <td><input type="text" size="70" name="<?php echo 'material'.$i; ?>" value="<?php echo $material['nombre']; ?>"></td>
                            <td class="hidden-sm"><input type="text" size="10" name="<?php echo 'unidad'.$i; ?>" value="<?php echo $material['unidad']; ?>"></td>
                            <td><input type="text" size="10" name="<?php echo 'precio'.$i; ?>" value="$<?php echo number_format($material['precio'], 2, '.', ','); ?>"></td>
                            <td><input type="text" size="10" name="<?php echo 'subtotal'.$i; ?>" value="$<?php echo number_format($material['subtotal'], 2, '.', ','); ?>"></td>
                            
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    <?php echo "<input type=\"hidden\" value=\"$i\" name=\"counter\">"; ?>
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
                        <input type="text" size="60" name="compania_empresa" value="<?php echo $company['empresa']; ?>"> <br>
                        <input type="text" size="60" name="compania_direcion" value="<?php echo $company['direcion']; ?>"> <br>
                        <input type="text" size="60" name="compania_ciudad" value="<?php echo $company['ciudad']; ?>"> <br>
                        <input type="text" size="60" name="compania_telefono" value="<?php echo $company['telefono']; ?>"> <br>
                        <input type="text" size="60" name="compania_url" value="<?php echo $company['url']; ?>"> <br>
                        <input type="text" size="60" name="compania_email" value="<?php echo $company['email']; ?>">
                    </address>                
                </div>            
            </div>
            <div class="col-xs-6 text-right">
                <ul class="list-unstyled invoice-total-info">
                    <li id="amount"><strong>Valor de los Materiales: $</strong><input type="text" name="valor" value="<?php echo number_format($_SESSION['precio_total']); ?>"></li>
                    <li id="iva"><strong>Impuestos: (19%) $</strong><input type="text" name="iva" value="<?php echo number_format($iva); ?>"></li>
                    <li id="granTotal"><strong>Gran Total: $</strong><input type="text" name="total" value="<?php  echo number_format($precio_coniva); ?>"></li>
                </ul>        
                <button class="btn-u btn-md u-btn-primary g-mr-10 g-mb-15" name="guardar" value="factura" type="submit">Generar Factura</button>            
            </div>
        </div>
        </form><!--Termina el formulario-->
    </div><!--/container-->		
    <!--=== End Content Part ===-->