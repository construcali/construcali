// este javascript se usa para empresas, clasificados y catalogos
// no se usa para cotizar.inc.php

$(document).ready(function(){
        $('#buscarTerminos').submit(function(){
            // var city = $('#ciudadClave').val();
            var palabra = $('#palabraClave').val();
            if(palabra < 2){
            	$('#buscarTerminos').prepend('Porfavor ponga un termino a buscar de mas de 2 caracteres');
            	return false;
            }else if (palabra > 255){
                $('#buscarTerminos').prepend('Porfavor ponga una descripcion menor a 255 caracteres');
            }
        });//end submit
    });//end ready