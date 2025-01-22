/*
* JavaScript para validar el formulario de ofertas
* El formulario esta en la pagina de tablero.inc.php
* Linea 262
* este script es unido en el footer.html linea 199
* resOferta se llama en la pagina ofertas.inc.php
*/

$(document).ready(function(){
    
    $('#fotosOfertas img').click(function(){
        var imgPath = $(this).attr('src');
        var fotoid = $(this).attr('id');
        var newImage = ('<div class="row"><div class="col-md-12"><div class="thumbnails thumbnail-style"><img src="'+ imgPath +'" alt="foto de la oferta" width="100%"></div></div></div>');
        $(this).hide();
        $('#photo'+fotoid).prepend(newImage);     
    });//end toggle

    //cuanto alguien responde a una oferta
     $('.resOferta').submit(function(){
            var resOfertaId = $(this).attr('id');
            var productoid = resOfertaId.slice(8)
            var mensaje = $('#oferta_'+productoid).val();

            if (mensaje.length < 20){
                $(this).before('Por favor ponga una respuesta mas completa');
                return false;
            }

            if (mensaje.length > 500){
                $(this).before('Por favor ponga una respuesta mas compacta');
                return false;
            }
            var clasiData = {
                oferta: mensaje,
                productoid: clasificadoid
            };
            
            $.post('responder.php',clasiData,procesarClasiData);
            return false;
        });//end submit
        //la funcion que procesa la respuesta al clasificado
        function procesarClasiData(data,status){
           var newHTML;
            if (status = 'success'){
                newHTML = '<i class="rounded-x fa fa-check"></i>';
                newHTML += '<p>Se ha enviado su mensaje, gracias por su participacion</p>';
            }else
            {
                newHTML += '<p>data: '+data+'status: '+status+'</p>';
            }
            
            $('#sky-formRespuesta').html(newHTML);
        }

        // poner el punto decimal en la caja de cifra de preciosfunction ponerPunto(){
    
        function ponerPunto(){
            var cifra = $('#precio').val();
            if (cifra.indexOf('.') != -1){
                var pointLoc = cifra.indexOf('.');
                cifra.splice(pointLoc,4);
                alert(cifra);
            }
            cifra = +cifra;

            var cifraPunto = cifra.toFixed(2);
    
            $('#precio').val(cifraPunto);
        }

        
        function ponerDecimales(){
           // alert('Hola Amigos');
            var cifra = $('#precio').val();
            //var buscarPunto = cifra.indexOf('.'); // devuelve posicion
            //cifra.splice(buscarPunto,1);

            var cifraDecimal = cifra.split('');
            // si la cifra es de 4 digitos
            if (cifra.length == 4){
               cifraDecimal.splice(1,0,',');
               var precioDecimal = cifraDecimal.join('');
               $('#precio').val(precioDecimal);
               
            }else if (cifra.length == 5){
                cifraDecimal.splice(1,1);
                cifraDecimal.splice(2,0,',');
                var precioDecimal = cifraDecimal.join('');
                $('#precio').val(precioDecimal);
            }else if (cifra.length == 6 ){
                cifraDecimal.splice(1,1);
                cifraDecimal.splice(2,0,',');
                var precioDecimal = cifraDecimal.join('');
                $('#precio').val(precioDecimal);
            }else if (cifra.length == 7 ){
                cifraDecimal.splice(2,1);
                cifraDecimal.splice(3,0,',');
                var precioDecimal = cifraDecimal.join('');
                $('#precio').val(precioDecimal);
            }else if (cifra.length == 8 ){
                cifraDecimal.splice(3,1);
                cifraDecimal.splice(1,0,',');
                cifraDecimal.splice(5,0,',');
                var precioDecimal = cifraDecimal.join('');
                $('#precio').val(precioDecimal);
            }else if (cifra.length == 9){
                cifraDecimal.splice(3,1);
                cifraDecimal.splice(2,0,',');
                cifraDecimal.splice(6,0,',');
                var precioDecimal = cifraDecimal.join('');
                $('#precio').val(precioDecimal);
            }else if (cifra.length == 10 ){
                cifraDecimal.splice(1,1);
                cifraDecimal.splice(4,1);
                cifraDecimal.splice(2,0,',');
                cifraDecimal.splice(6,0,',');
                var precioDecimal = cifraDecimal.join('');
                $('#precio').val(precioDecimal);
            }else if (cifra.length == 11 ){
                cifraDecimal.splice(2,1);
                cifraDecimal.splice(6,1);
                cifraDecimal.splice(3,0,',');
                cifraDecimal.splice(6,0,',');
                var precioDecimal = cifraDecimal.join('');
                $('#precio').val(precioDecimal);
            }
            
        }

       // $('#precio').keyup(ponerDecimales);
            
}); //end ready  
