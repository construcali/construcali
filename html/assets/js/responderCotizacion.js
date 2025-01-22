$(document).ready(function(){
	$('#infoBanco').click(function(){
		var banco = $('#infoBanco').html();
		var datosBanco = '<strong>Nombre del Banco:</strong><input type="text" name="banco" id="banco" placeholder="'+banco+'"><i class="icon-sm rounded-x fa fa-check" id="siBanco">';
		$('#datosBanco').html(datosBanco);
	}); // end click
	$('#infoCuenta').click(function(){
		var cuenta = $('#infoCuenta').html();
		var datosCuenta = '<strong>Numero de Cuenta: </strong><input type="text" name="cuenta" id="cuenta" placeholder="'+cuenta+'"><i class="icon-sm rounded-x fa fa-check" id="siCuenta">';
		$('#datosCuenta').html(datosCuenta);
	}); //end click
	$('#infoContacto').click(function(){
		var contacto = $('#infoContacto').html();
		var datosContacto = '<strong>Nombre del Contacto: </strong><input type="text" name="contacto" id="contacto" placeholder="'+contacto+'"><i class="icon-sm rounded-x fa fa-check" id="siContacto">';
		$('#datosContacto').html(datosContacto);
	}); //end click
	$('#infoNit').click(function(){
		var nit = $('#infoNit').html();
		var datosNit = '<strong>N.I.T #: </strong><input type="text" name="nit" id="nit" placeholder="'+nit+'"><i class="icon-sm rounded-x fa fa-check" id="siNit">';
		$('#datosNit').html(datosNit);
	}); //end click
	$(document).on('click','#siBanco',function(){
		var nuevoBanco = $('#banco').val();
		//console.info('El nuevo Banco es: '+nuevoBanco);
		$('#datosBanco').html('<strong>Nombre del Banco: </strong><a id="infoBanco">'+nuevoBanco+'</a>');
	});
	$(document).on('click','#siCuenta',function(){
		var nuevaCuenta = $('#cuenta').val();
		$('#datosCuenta').html('<strong>Numero de la Cuenta: </strong><a id="infoCuenta">'+nuevaCuenta+'</a>');
	});
	$(document).on('click','#siContacto',function(){
		var nuevoContacto = $('#contacto').val();
		$('#datosContacto').html('<strong>Nombre del Banco: </strong><a id="infoContacto">'+nuevoContacto+'</a>');
	});
	$(document).on('click','#siNit',function(){
		var nuevoNit = $('#nit').val();
		$('#datosNit').html('<strong>N.I.T #: </strong><a id="infoNit">'+nuevoNit+'</a>');
	});
	//Mensaje que la empresa quiera enviar a cotizante
	$('#cotizacionMensaje').click(function(){
		$('#cotiMensaje').html('<textarea class="form-control" rows="7" id="cotizaMensaje" autofocus></textarea>');
		$('#cotiMensaje').append('<i class="icon-sm rounded-x fa fa-check" id="siCotiDatos">');
	}); //end click
	$(document).on('click','#siCotiDatos',function(){
		var nuevoCotiMensaje = $('#cotizaMensaje').val();
		$('#cotiMensaje').html('<p id="cotizacionMensaje">'+nuevoCotiMensaje+'</p>');
	});//end onclick

	$('.articulo').click(function(){
			var id = $(this).attr('id');
			//console.info('esta es la id'+ id);
			$('#articulo'+id).html('<input type="text" class="form-control" id="nuevoArticulo'+id+'" placeholder="Su Descripcion"><i class="chulo icon-sm rounded-x fa fa-check" id="si'+id+'">');
		});
	$(document).on('click','.chulo',function(){
		var chuloid = $(this).attr('id');
		var laid = chuloid.slice(2);
		//console.log('la id' + laid);
		var nuevaDescripcion = $('#nuevoArticulo'+laid).val();
		$('#articulo'+laid).html(nuevaDescripcion);
	}); // en click

	$('#materiales :text').change(function(){
		//Cambiar la descripcion de algun articulo
		var renglones = $('tr').length;
		var subTotal = 0;
		//console.log('hay estos renglones:'+renglones);
		for(i=1;i<renglones;i++){
			//var precioTotal = $('#precioTotal'+i).val();
			var precioUnitario = $('#unitario'+i).val();
			precioUnitario = precioUnitario.slice(1);
			precioUnitario = precioUnitario*1;
			var cantidad = $('#cantidad'+i).html();
			cantidad = cantidad * 1;
			var precioTotal = cantidad * precioUnitario;
			var printTotal = accounting.formatNumber(precioTotal);
			$('#precio'+i).val('$'+printTotal);
			//precioTotal = precioTotal.slice(1);
			//precioTotal = precioTotal * 1;
			subTotal = precioTotal + subTotal;
			var printSubTotal = accounting.formatNumber(subTotal);
			//console.log('este es el subtotal'+precioTotal);
		}
		console.info('este es el total'+printSubTotal);
		$('#subTotal').val('$'+printSubTotal);
		$('#subTotal').attr('disabled', true);
		$('#total').attr('disabled', true);
		var descuento = $('#descuento').val();
		descuento = descuento.slice(1);
		descuento = descuento * 1;
		//menos el decuento
		subTotal = subTotal - descuento; //aqui se le quita el descuento
		var iva = $("#iva").val();
		iva = iva.slice(1);
		var factorIva = iva / 100 ;
		var precioIva = subTotal * factorIva;
		var total = subTotal + precioIva;
		var printGrandTotal = accounting.formatNumber(total);
		$('#total').val('$'+printGrandTotal);
		//var tds = $('.articulo').size();
		//console.info('hay estas casillas con articulos:'+tds);
	}); //end change

	//cuando cambie el texto en la seccion ul de sumas
	$('#sumas :text').change(function(){
		var subTotal = $('#subTotal').val();
		subTotal = subTotal.slice(1);
		subTotal = accounting.unformat(subTotal);
		var descuento = $('#descuento').val();
		descuento = descuento.slice(1);
		descuento = descuento * 1;
		console.log('este es el subtotal: '+subTotal);
		//aqui se le quita el descuento
		subTotal = subTotal - descuento; //menos el descuento
		console.info('esta es el subtotal menos el descuento:'+subTotal);
		var iva = $("#iva").val();
		iva = iva.slice(1);
		iva = iva * 1;
		var factorIva = iva / 100 ;
		var precioIva = subTotal * factorIva;
		var total = subTotal + precioIva;
		var printDescuento = accounting.formatNumber(descuento);
		var printGrandTotal = accounting.formatNumber(total);
		$('#descuento').val('$'+printDescuento);
		console.log(printDescuento);
		$('#total').val('$'+printGrandTotal);
	});// end change for sumas
	// Este es plan A para responder una cotizacion de materiales
	$('#responderCotizacion').click(function(){
		//Declarar los arrays para precios unitarios y subtotales.
		//var unitarios = [];
		var sumaUnitarios = 0;
		var j=1;
		var temporal = '';
		var renglones = $('tr').length;
		var numArticulos = renglones - 1;
		
		for (var i=0; i<numArticulos;i++){
			temporal = $('#unitario'+j).val();
			unitario = accounting.unformat(temporal);
			sumaUnitarios = unitario + sumaUnitarios;
			j++;
			console.log(sumaUnitarios);
		}
		if (sumaUnitarios <= 0){
			$('.cotizacionid').html('<h4>Porfavor ponga un valor para responder la cotizacion</h4');
			return false;
		}else{
		var dataSubtotales = $('#materiales').serialize();
		console.info(dataSubtotales);
		$.post('contestar.php',dataSubtotales,function(data){
			$('.cotizacionid').html('<h4>Su respuesta a la cotizacion #'+data+' de materiales ha sido enviada exitosamente</h4');
		}); //se envia esta informacion a contestar.php cuando se hace click en #responderCotizacion
		return false;
		} 
	});
	/* Este es plan B para responder una cotizacion de materiales
	//cuando se responda una cotizacion
	$('#responderCotizacion').click(function(){
		var nombreCliente = $('#clienteNombre').html();
		var apellidosCliente = $('#clienteApellido').html();
		var ciudadCliente = $('#clienteCiudad').html();
		var telefonoCliente = $('#clienteTelefono').html();
		console.log('Esta es la ciudad:' + ciudadCliente);
		var bancoInfo = $('#infoBanco').html();
		var cuentaInfo = $('#infoCuenta').html();
		var contactoInfo = $('#infoContacto').html();
		var nitInfo = $('#infoNit').html();
		console.log('esta es el contacto:' + contactoInfo);
		var nombreCompany = $('#companyNombre').html();
		var direcionCompany = $('#companyDirecion').html();
		var cityCompany = $('#companyCity').html();
		var telefonoCompany = $('#companyTelefono').html();
		var emailCompany = $('#companyEmail').html();
		console.log('Este es el nombre de la Empresa: '+nombreCompany);
		var mensajeCotizacion = $('#cotizacionMensaje').html();
		console.info(mensajeCotizacion);
		var renglones = $('tr').length;
		var numArticulos = renglones - 1;
		//Declarar los arrays para descripciones, articulos, cantidades, precios unitarios y subtotales.
		var materiales = [];
		var descripciones = [];
		var cantidades = [];
		var unitarios = [];
		var subtotales = [];
		var j=1;
		var temporal = '';
		console.info('Numero de Articulos: '+numArticulos);
		
		for (var i=0; i<numArticulos;i++){
			materiales[i] = $('#material'+j).html();
			descripciones[i] = $('#articulo'+j).html();
			cantidades[i] = $('#cantidad'+j).html();
			temporal = $('#precioUnitario'+j).val();
			unitarios[i] = accounting.unformat(temporal);
			subtotales[i] = $('#precioTotal'+j).val();
			j++;
			//console.log('material:'+materiales[i]+'descripcion:'+descripciones[i]+'cantidad:'+cantidades[i]+'precio: '+unitarios[i]+'subtotales'+subtotales[i]);
		}
		
		var cotizacionid = $('#cotizacionid').html();

		var dataSubtotales = {
			ordenid : cotizacionid,
			unitario1: unitarios[0],
			precio1: subtotales[0],
			unitario2: unitarios[1],
			precio2: subtotales[1],
			unitario3: unitarios[2],
			precio3: subtotales[2],
			unitario4: unitarios[3],
			precio4: subtotales[3],
			unitario5: unitarios[4],
			precio5: subtotales[4]
		};
		
		console.info(dataSubtotales);
		$.post('contestar.php',dataSubtotales,function(data){
			$('#cotizacionid').html('<h4>Su respuesta a la cotizacion #'+data+' de materiales ha sido enviada exitosamente</h4');
		}); //se envia esta informacion a contestar.php cuando se hace click en #responderCotizacion
		//toda la otra informacion que se cogio no se esta mandando al documento contestar.php, solo los precios.
		
		var subtotal = $('#subTotal').val();
		var rebaja = $('#descuento').val();
		var impuesto = $('#iva').val();
		var sumaTotal = $('#total').val();
		console.info(subtotal);
		console.info(rebaja);
		console.info(impuesto);
		console.info(sumaTotal);
	}); */

});//endready