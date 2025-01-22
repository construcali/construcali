<?php
class Clasificado{
	
// entrar a la base de datos de construcali con la extension MySQLi
function iniciar(){
	$con = mysqli_connect("mysql","construcali","velez","casaGrandeSur2EGNE2");

// Check connection
	if (mysqli_connect_errno()) {
	  echo "No se pudo conectar a MySQL: " . mysqli_connect_error();
	  exit();
	}

	return $con;
}

//contar ids sin una restrincion
	function contar_records($con,$productoid,$tabla){
		$pregunta = "SELECT $productoid from $tabla";
		$resultado = mysqli_query($con,$pregunta);
		$renglones = mysqli_num_rows($resultado);
		return $renglones;
		mysqli_free_result($resultado);
		mysqli_close($con);
	}

}
?>