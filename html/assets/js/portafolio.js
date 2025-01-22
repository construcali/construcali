/*
* JavaScript para subir un portafolio
* JavaScript usado en la pagina de empresa.inc.php y tablero.inc.php
* javaScript para borrar el portafolio
* este script es unido en el footer.html linea 155

*/
$(document).ready(function(){

	$('#subirPortafolio').submit(function(){
		 if ($('#nombrePortafolio')[0].files.length === 0) { 
                $('#subirPortafolio').before('Por favor ponga un archivo');
                return false;
            } 
		
	});

	$('#borrarPortafolio').click(function(){
		$('#portafolioBorrado').css('display','block');
	});

	$('#portafolioBorrado').click(function(){
		var portafolioid = $(this).attr('href');
		$.get('ajaxphp/borrarportafolio.php','productoid='+portafolioid,function(data, status){
			var newHTML;
			if (status == 'success'){
				newHTML = '<h2> El portafolio en formato pdf de su empresa se ha borrado </h2';
			}else{
				newHTML = '<h2> No se pudo borrar su portafolio pdf, por favor intentelo mas tarde</h2>';
			}
			$('#borrarPortafolio').html(newHTML);
			$('#portafolioBorrado').html('Gracias por Participar');
		});
		return false;
	});
});