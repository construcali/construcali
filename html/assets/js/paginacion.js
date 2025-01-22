/*
Esta es la pagina de las empresas en la vista contenido.inc.php
este script esta unido en el footer.html en la linea 213
id="linksContenido"
*/

	$(document).ready(function(){
        $('#linksContenido a').click(function(){
            var url = $(this).attr('href');
            console.log(url);
            $('#listado').load(url);
            return false;
        });
    });

