	//Hacer Calculos
	// Since I declare the variables here
	// these array variables can be accessed from anywhere
	// and their values can be overwritten inside other function
	// la variable contador me dice cuantos renglones hay en la tabla
	$(document).ready(function(){
	var contador = 0;
	
	var productos = [];
	var multiplo = 1;
	$('#tablero :text').change(function(){
	var Total = 0;
	contador = $('#counter').val();
	var num = contador+1;
	for (var i=1; i<num; i++){
	var cantidad = $('#cantidad_'+i).val();
	if (cantidad.indexOf('.') != -1){
			multiplo = 100;
		}
		cantidad = cantidad * multiplo;
		//cantidad = parseInt(cantidad);
		if (isNaN(cantidad))
			{cantidad = 0;}
		
		//alert(cantidad);
		var precio = $('#precio_'+i).val();
		precio = parseInt(precio);
		if (isNaN(precio))
			{precio = 0;}
		var pesos = precio * 1;
		var sub = cantidad * pesos;
		sub = sub / multiplo;
		//alert('precio es'+' '+pesos);
		//alert('cantidad es'+' '+cantidad);
		Total = Total + sub;
		productos.push(Total);//poner en array los totales
		var printCost = accounting.formatNumber(Total);
		printCost = '$' + printCost;
		$('#total').val(printCost);

	}//end for
	//El total debe de ir arriba despues de onchange
	});//end change
	//start submit
	$('#incluirArticulo').submit(function(){
	        var qty = $('#total').val();
	        altqty = qty.slice(1);
	        var replaceRegex = /\,/g;
	        altqty = altqty.replace(replaceRegex, '0');
	        $('#botonIncluirArticulo').attr('disabled', true);
           	if (qty == 0){
           		var newHTML = '<h2>Por favor ponga una cantidad para subir a su lista de materiales</h2>';
           		$('#incluirArticulo').after(newHTML);
           		$('#botonIncluirArticulo').attr('disabled', false);
           		return false;
           	}else if (isNaN(altqty)){
           		var newHTML = '<h2>Por favor ponga una cantidad para incorporar a su lista de materiales</h2>';
           		$('#botonIncluirArticulo').append(newHTML);
           		$('#botonIncluirArticulo').attr('disabled', false);
           		return false;
           	}else{
           		var articuloData = $(this).serialize();
           		$.post('ajaxphp/incluirarticulos.php', articuloData, function(data){
           			if (data == 'false'){
           				$('#incluirArticulo').after('<h2>Porfavor Inicie Sesion para hacer un presupuesto</h2>');
           			}else{
	           			$('#incluirArticulo').after('<h2>'+data+'</h2>');
	           			$('#botonIncluirArticulo').after('<i class="fa fa-check"></i>');
	           			$('#botonIncluirArticulo').attr('disabled', false);
	           		}
           		});
           		return false;
           	}
        });//end submit		
	//end submit
	});//end ready