// este javascrip se usa para mostrar
// la caja de texto como respuesta a un clasificado
// a para poner un foro
// se usa en el documento clacontenido.inc.php
// esta unido al footer.html en la linea 184
// tambien se usa en las paginas foroscontenido.inc.php y panelusuario.inc.php
// tambien se usa en la pagina cotizaciones/anouncements.inc.php

$(document).ready(function(){
	$('.resAnuncio').hide();
	$('.resForo').hide();
	$('.resOferta').hide(); // se usa en ofertas.inc.php
	$('.rectangulo a').click(function(){
		var productoid = $(this).attr('href');
		//alert(productoid);
		$('#comentar'+productoid).show();
		//$('#comentar'+productoid).removeClass('resAnuncio');
		return false;
	});
	// esta funcion se usa en estosservicios.inc.php
	$('.resServicio a').click(function(){
		var productoid = $(this).attr('href');
		var servicioid = productoid.slice(42);
		//alert(servicioid);
		$('#comentar'+servicioid).show();
		//$('#comentar'+productoid).removeClass('resAnuncio');
		return false;
	});

});

$(document).on('click','.rectangulo a', function(){
		var productoid = $(this).attr('href');
		//alert(productoid);
		$('#comentar'+productoid).show();
		//$('#comentar'+productoid).removeClass('resAnuncio');
		return false;
});