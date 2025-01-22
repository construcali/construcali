/*
* JavaScript para borrar servicios
* JavaScript usado en la pagina de actividades.inc.php
* este script es unido en el footer.html linea 333
* este script se usa en la pagina de cotizaciones.inc.php
*/
    $(document).ready(function(){
        $('.borrarServicio a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(30);
             $('#borradoServicio'+id).load(url);
            return false;
        });//end click

        $('.borrarProducto a').click(function(){
            var url = $(this).attr('href');
            $('#borradoProducto').load(url);
            return false;
        });//end click

        $('.borrarPromocion a').click(function(){
            var url = $(this).attr('href');
            $('#borradaPromocion').load(url);
            return false;
        });//end click

        $('.borrarMateriales a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(29);
            $('#contestacion'+id).load(url);
            return false;
        });//end click
        //funcion para borrar cotizaciones de la tabla pedidos
        //se usa en cotizaciones.inc.php
        $('.borrarCotizacion a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(29);
            $('#borrarCotizacion'+id).load(url);
            return false;
        });//end click
        $('.borrarLista a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(25);
            $('#lista'+id).load(url);
            return false;
        });//end click
        $('.borrarCorreos a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(26);
            //alert(id);
            $('#contestacion'+id).load(url);
            return false;
        });//end click
        //script para borrar un foro, se usa en cotizaciones.inc.php
        $('.borrarForo a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(26);
            //alert(id);
            $.get('borrarforo.php','productoid='+id, function(data,status){
                $('#borradoForo'+id).html('<h4>Se ha borrado el foro con la id '+data+'</h4>');
            });
            return false;
        });//end click

        //script para borrar un comentario de los foros, se usa en cotizaciones.inc.php
        $('.borrarComentario a').click(function(){
            var id = $(this).attr('id');
            //var url = $(this).attr('href');
            //var id = url.slice(26);
            console.log(id);
            $.get('vistas/usuarios/borrarcomentario.php','comentarioid='+id, function(data,status){
                $('#borradoComentario'+data).html('<h4>Se ha borrado el comentario con la id '+data+'</h4>');
            });
            return false;
        });//end click

        //script para borrar una oferta, se usa en cotizaciones.inc.php
        $('.borrarOferta a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(36); 
            //alert(id);
            $.get('ajaxphp/borraroferta.php','productoid='+id, function(data,status){
                $('#borradaOferta'+id).html('<h4>Se ha borrado la oferta con la id '+data+'</h4>');
            });
            return false;
        });//end click

        // script para borrar una evaluacion, se usa en foroscontenido.inc.php
        $('.borrarEvaluacion a').click(function(){
            var id = $(this).attr('id');
            //alert(id);
            console.log('la id de la recomendacion es:'+id);
            $.get('borrarevaluacion.php','productoid='+id, function(data,status){
                $('#borrarEvaluacion'+id).html('<h4 style="margin-left:4px;">Se ha borrado la recomendacion con la id '+data+'</h4>');
            });
            return false;
        });//end click

    });//end ready