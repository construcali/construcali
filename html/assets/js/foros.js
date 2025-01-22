//unido en el footer.html en la linea  332
//se usa en tablero.inc.php
//se usa en la pagina de inicio para usuarios con empresa, para mostrar los boletines
// se usa con las paginas unforo.inc.php y foroscontenido.inc.php
$(document).ready(function(){
        $('#nuevoForo').submit(function(){
            var argumento = $('#mensaje').val();
            //alert(argumento);
            $('#botonPublicarBoletin').attr('disabled',true);
            $('#botonPublicarBoletin').removeClass('btn-u');
            if (argumento.length < 10) {
                $('#mensaje').before('Por favor escriba una publicacion mas completa');
                return false;
            }else if(argumento.length > 300){
                $('#mensaje').before('Por favor explique su tema en menos palabras');
                return false;
            }else{
                var foroData = {
                    boletin: argumento
                };
                $.post('publicar.php',foroData,procesarForoData);
                return false;
            }
        });//end submit
        // funcion para procesar la publicacion de un boletin
        function procesarForoData(data,status){
            var newHTML;
            if(status == 'success'){
                newHTML = '<i class="rounded-x fa fa-check"></i>';
                newHTML += '<h4>'+data+'.</h4>';
            }else
            {
                newHTML = '<h2>No pudimos publicar su boletin</h2>';
                newHTML += '<p>Por favor intentelo mas tarde</p>';
            }
            $('#nuevoForo').append(newHTML);
            $('#botonPublicarBoletin').attr('disabled',false);
            $('#botonPublicarBoletin').addClass('btn-u');
        }
        //funcion para procesar un comenatario desde tablero.inc.php o panelusuario.inc.php
        $('.resForo').submit(function(){
            var resForoId = $(this).attr('id');
            var productoid = resForoId.slice(8)
            var comment = $('#oferta_'+productoid).val();
            //alert(comment);
            if(comment.length < 10){
                $('#oferta_'+productoid).after('Por favor ponga un comentario mas largo');
                return false;
            }else if(comment.length > 500){
                $('#oferta_'+productoid).before('Por favor haga un comentario mas breve');
                return false;
            }else
            {
                var commentData ={
                    comentario: comment,
                    foroid: productoid
                };
                $.post('ajaxphp/pubcomentario.php',commentData,procesarCommentData);
                return false;
            }
        }); //end submit        

        //funcion para cargar los comentarios
        $('.numcoment').toggle(
            function(){
                var comentarioid = $(this).attr('id');
                //alert('#comentarios'+comentarioid);
                //$('#comentarios'+comentarioid).load('foros.php?content=unforo&foroid='+comentarioid+'#paginaComentario');
                $('#comentarios'+comentarioid).load('vistas/foros/comentariosforos.php?foroid='+comentarioid);
                return false;
            },
            function(){
                var comentarioid = $(this).attr('id');
                $('#comentarios'+comentarioid).hide();
                return false;
            }
        );//end click

        //funcion para procesar un comentario en unforo.inc.php
        $('#nuevoComentario').submit(function(){
            var comment = $('#comentario').val();
            var productoid = $('#foroid').val();
            if(comment.length < 10){
                alert('el foroid es '+ productoid);
                $('#escribirComentario').append(' - Por favor ponga un comentario de mas de 10 caracteres');
                return false;
            }else if(comment.length > 300){
                alert('Por favor haga un comentario mas breve');
                return false;
            }else
            {
                var commentData ={
                    comentario: comment,
                    foroid: productoid
                };
                $.post('ajaxphp/pubcomentario.php',commentData,procesarCommentData);
                return false;
            }
        }); //end submit

        function procesarCommentData(data,status){
            var newHTML;
            if(status = 'success'){
                newHTML = '<i class="rounded-x fa fa-check"></i>';
                newHTML += '<p>Se ha publicado su comentario, gracias por participar</p>';
            }else
            {
                newHTML = '<p>No se pudo publicar su comentario, por favor intente mas tarde</p>';
            }
            $('#procesarComentario'+data).html(newHTML);
            $('#procesarComentario').html(newHTML);
        }

        // codigo para contar cuantos caracteres tiene el formulario de nuevoforo.inc.php
        function contarCaracteres(){
            let textoEscrito = $('#mensaje').val();
            var mensajeForo = $('#mensajeForo').html()
            console.log(mensajeForo);
            if (textoEscrito.length <= 20){
               
                $('#mensajeForo').html('<h5 style="color:red">Mensaje: Por favor escriba un texto de mas de 20 caracteres ('+ textoEscrito.length +' caracteres)</h5>');          
                 
            }else if ((textoEscrito.length > 20) && (textoEscrito.length < 300)){
                
                $('#mensajeForo').html('<h5>Mensaje: Escriba menos de 300 caracteres, ('+ textoEscrito.length +' caracteres)</h5>');
                
            }
            else if (textoEscrito.length > 300){
                
                $('#mensajeForo').html('<h5 style="color:red">Mensaje: Escriba menos de 300 caracteres, ('+ textoEscrito.length +' caracteres)</h5>');
                
            }
        }
        // activa la funcion de contactar caracteres en tablero.inc.php
        $('#mensaje').keyup(contarCaracteres);

}); //end document jquery