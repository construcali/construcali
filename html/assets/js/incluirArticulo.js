// se usa en la pagina vistas/analisis/precios.inc.php
// se usa en la pagina de vistas/analisis.inc.php
// cuando dan click en el boton incluirArticulo, creado por el js buscarArticulo.js

$(document).on('click','.insumoClass',function(){
		//alert('la clase es incluirArticulo');
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
		$.post('incluirarticulo.php',insumo,function(data){
			if(data == 'true'){
				var nuevoHTML = '<a href="analisis.php?content=lista" class="btn-u-default">';
				nuevoHTML += '<i class="fa fa-list"></i>Incluido</a>'
				$('#incluir'+ insumoid).html(nuevoHTML);
			}else{
				var nuevoHTML = '<a href="analisis.php?content=lista" class="btn-u-default">';
				nuevoHTML += '<i class="fa fa-list"></i>Ir a Lista</a>'
				$('#incluir'+ insumoid).html(nuevoHTML);
				
			}
		});
		// no siga el enlace
		return false;
	});	