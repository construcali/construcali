// este documento esta enlazado en la linea 219 de footer.html
// la funcion de #resPuesta se usa en un unservicios.inc.php , unproducto.inc.php, unanouncement.js
$(document).ready(function(){
        $('#resPuesta').submit(function(){

            var mensaje = $('#oferta').val();
            var clasificadoid = $('#productoid').val();
            var Email = $('#email').val();
            var Titulo = $('#titulo').val();
            var respondonid = $('#respondonid').val();

            //array de palabras no permitidas
            var terminosPublicidad = ['cialis','Propecia','coupons','Cialis','Viagra','Prozac','Prescription'];

            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)/; //expresion regular de un email
            var urlRegex = /((\bhttps?:\/\/)|(\bwww\.))\S*/; // expression regular de una pagina web
            $('#botonResponderAnuncio').attr('disabled', true);


            if (mensaje.length < 20){
                $(this).before('Por favor ponga una respuesta mas completa');
                $('#botonResponderAnuncio').attr('disabled', false);
                return false;
            }

            //revisar si la persona ha entrado como usuaria
            if (respondonid == null || respondonid == undefined || respondonid.length == 0){
                if (mensaje.search(emailRegex) == -1){
                    $(this).before('Por favor ponga un correo electronico en su mensaje, para que le puedan contactar');
                    $('#botonResponderAnuncio').attr('disabled', false);
                    return false;   
                }

                if (mensaje.search(urlRegex) != -1){
                    $(this).before('Debe vicularse como usuario para poder poner una pagina web en el mensaje');
                    $('#botonResponderAnuncio').attr('disabled', false);
                    return false;   
                }

                if (mensaje.indexOf('href') != -1){
                    $(this).before('Escriba un mensaje sin enlaces a otras paginas web');
                    $('#botonResponderAnuncio').attr('disabled', false);
                    return false;   
                }
            }

            //revisar que las palabras del array terminosPublicidad no esten en la busqueda
            for (var i=0; i<terminosPublicidad.length; i++){
                if (mensaje.indexOf(terminosPublicidad[i]) != -1 ){
                    $('#resPuesta').prepend('Escriba un mensaje claro y preciso, revise su ortografia');
                    $('#botonResponderAnuncio').attr('disabled', false);
                    return false;
                }
            }

            if (mensaje.length > 500){
                $(this).before('Por favor ponga una respuesta mas compacta');
                $('#botonResponderAnuncio').attr('disabled', false);
                return false;
            }
            var clasiData = {
                oferta: mensaje,
                productoid: clasificadoid,
                email: Email,
                titulo: Titulo
            };
            $.post('responder.php',clasiData,procesarClasiData);
            $('#botonResponderAnuncio').attr('disabled', false);
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

        //esta informacion se usa en esteproducto.inc.php
        $('#esteProducto').submit(function(){
            var mensaje = $('#message').val();
            var respondonid = $('#respondonid').val(); //mirar si quien contesta ha entrado
            var companyid = $('#empresaid').val();
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)/; //expresion regular de un email
            var urlRegex = /((\bhttps?:\/\/)|(\bwww\.))\S*/; // expression regular de una pagina web


            //array de palabras no permitidas
            var terminosPublicidad = ['cialis','Propecia','coupons','Cialis','Viagra','Prozac','Prescription'];
            //revisar numero de letras del mensaje
            if (mensaje.length < 20){
                $(this).before('Por favor ponga una respuesta mas completa');
                return false;
            }

            if (mensaje.length > 500){
                $(this).before('Por favor escriba un mensaje mas conciso');
                return false;
            }
            //revisar que la persona no ponga una direcion de pagina web y qure ponga un email
            //revisar si la persona ha entrado como usuaria
            if (respondonid == null || respondonid == undefined || respondonid.length == 0){
                if (mensaje.search(emailRegex) == -1){
                    $(this).before('Por favor ponga un correo electronico en su mensaje, para que le puedan contactar');
                    return false;   
                }

                if (mensaje.search(urlRegex) != -1){
                    $(this).before('Debe vicularse como usuario para poder poner una pagina web en el mensaje');
                    return false;   
                }

                if (mensaje.indexOf('href') != -1){
                    $(this).before('Escriba un mensaje sin enlaces a otras paginas web');
                    return false;   
                }
            }

            //revisar que las palabras del array terminosPublicidad no esten en la busqueda
            for (var i=0; i<terminosPublicidad.length; i++){
                if (mensaje.indexOf(terminosPublicidad[i]) != -1 ){
                    $('#esteProducto').prepend('Escriba un mensaje claro y preciso, revise su ortografia');
                    return false;
                }
            }

             // desactivar boton de submit id responderBoton
            $('#responderBoton').attr('disabled',true);

            var data = {
                message:mensaje,
                empresaid:companyid
            };
            $.post('cotizar.php',data,proRespuesta);
            return false;
        });//end submit
        //la funcion que procesa la respuesta
        function proRespuesta(data, status){
                var newHTML;
                if (status = 'success'){
                    newHTML = '<i class="rounded-x fa fa-check"></i>';
                    newHTML += '<p>'+ data + '.</p>';
                }else
                {
                    newHTML = '<h2>No se ha podido enviar su mensaje</h2>';
                    newHTML += '<p>Por favor intentelo mas tarde.</p>';
                }
                $('#sky-form3-respuesta').html(newHTML);
                $('#responderBoton').attr('disabled',false);
            }
});//end ready