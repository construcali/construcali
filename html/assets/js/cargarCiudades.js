// funcion para cargars ciudades cuando se selecione un departamento
// se usa en la pagina cotizacion.inc.php
// se enlace en el footer.html

$(document).ready(function(){
	$('#cualDepartamento').change(function(){
		//obtener el departamento
		var deptid = $(this).val();
		// alert(deptid);
		var meses = ['Departamento' ,'Antioquia' , 'Atlantico', 'Arauca', 'Amazonas', 'Caldas', 'Risaralda', 'Bolivar', 'Cordoba', 'SanAndres', 
		'Sucre', 'Boyaca', 'Casanare', 'Caqueta', 'Cauca', 'Choco', 'Guania', 'Guaviare', 'Narino', 'Putumayo', 'Quindio', 'Valle', 
		'Vaupes', 'Cundinamarca', 'Meta', 'Vichada', 'Cesar', 'Guajira', 'Magdalena', 'Santander', 'NorteSantander', 'Huila', 'Tolima'];
		var estado = meses[deptid];
		var url = 'https://construcali.com/vistas/departamentos/'+estado+'.html';
		// alert (url);
		$('#city').load(url);	
	}); //end change

	//segundo formulario dentro de cotizacion.inc.php, esta vez para cotizar materiales

	$('#departamento').change(function(){
		//obtener el departamento
		var deptid = $(this).val();
		// alert(deptid);
		var meses = ['Departamento' ,'Antioquia' , 'Atlantico', 'Arauca', 'Amazonas', 'Caldas', 'Risaralda', 'Bolivar', 'Cordoba', 'SanAndres', 
		'Sucre', 'Boyaca', 'Casanare', 'Caqueta', 'Cauca', 'Choco', 'Guania', 'Guaviare', 'Narino', 'Putumayo', 'Quindio', 'Valle', 
		'Vaupes', 'Cundinamarca', 'Meta', 'Vichada', 'Cesar', 'Guajira', 'Magdalena', 'Santander', 'NorteSantander', 'Huila', 'Tolima'];
		var estado = meses[deptid];
		var url = 'https://construcali.com/vistas/departamentos/'+estado+'.html';
		// alert (url);
		$('#ciudad').load(url);	
	}); //end change

}); //end ready