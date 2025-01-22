<div class="content">
<div class="row">
<div class="col-sm-3">
<img src="assets/img/PlanodeCasa.jpg" alt="lote">
</div>
<div class="col-sm-9">
<?php 
	echo "<table class=\"table\">";
	echo "<tr><td>Actividad</td><td>Area</td><td>Precio Unitario</td><td>Valor Subtotal</td></tr>";
	for ($i=0;$i<sizeof($actividadesids);$i++){ 
	echo "<tr><td>$nombre[$i]</td><td>$volumen[$i] $unidad[$i]</td>";
	$subtotal = $precio[$i];
	$subtotal = number_format($subtotal);
	echo "<td>$".$subtotal."</td>";

	$suma = $total[$i];
	$suma = number_format($suma);
	$resultado = $resultado + $total[$i];
	echo "<td>$".$suma."</td></tr>";
	}
	echo "</table>";
	$valorObra = $resultado + $bano;
	$valorObra = number_format($valorObra);
	$obraTotal = number_format($resultado);
	$bano = number_format($bano);
	echo "<h5>Precio parcial de la obra es $". $obraTotal."</h5>";
	echo "<h5>El precio del ba&#241;o es $".$bano."</h5>";
	echo "<h5>Un precio base para considerar esta obra es de $".$valorObra."</h5>";
?>
	<div class="row">
	<div class="col-sm-6">
	<a href="print.php" target="_blank"><button class="btn btn-primary">Imprimir Casa</button></a>	
	</div>
	<div class="col-sm-6">
	<a href="index.php?content=analisis"><button class="btn btn-primary">Seguir con Presupuesto</button></a>
	</div>
	</div>
</div>
</div>
</div>