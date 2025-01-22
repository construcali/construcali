// se usa en la pagina vistas/detallados.inc.php
// cuando dan click en el boton incluir, esta unida en footer, linea  222
$(document).ready(function(){
	function incluirActividad(){
		
		//coger la info
		var insumoid = $(this).attr('id');
		var nombre = $('#nombre'+insumoid).val();
		var unidad = $('#unidad' + insumoid).val();
		var precio = $('#precio' + insumoid).val();
		// por alguno motivo este console no muestra el valor de nombre, precio y unidad pero el codigo si funciona
		 // console.log(unidad);
		 // console.log(insumoid);
		 // console.log(nombre);
		 // console.log(precio);
		//hacer json
		var insumo = {
			materialid: insumoid,
			material: nombre,
			medida: unidad,
			costo: precio
		}
		
		// enviar la info al servidor
		// 01/20/21 canbirar incluirarticulo por incluiractividad
		$.post('ajaxphp/incluiractividad.php',insumo,function(data){
			if(data == 'true'){
				var nuevoHTML = '<a href="presupuesto.php?content=lista" class="btn">';
				nuevoHTML += '<i class="fa fa-list"></i>Incluido</a>'
				$('#'+ insumoid).html(nuevoHTML);
			}else{
				var nuevoHTML = '<a href="presupuesto.php?content=lista" class="btn-u-blue">';
				nuevoHTML += '<i class="fa fa-check"></i>Presupuesto</a>'
				$('#'+ insumoid).removeClass('btn-u');
				$('#'+ insumoid).removeClass('incluirActividad');
				$('#incluir'+ insumoid).html(nuevoHTML);
				
			}
		});
		// no siga el enlace
		return false;
	}

	$('.incluirActividad').click(incluirActividad);
});
