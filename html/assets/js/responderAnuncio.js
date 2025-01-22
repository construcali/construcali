// este documento esta enlazado en la linea 219 de footer.html
// este documento se usa anuncios.inc.php, cotizaciones.inc.php, masanuncios.php y mascotizaciones.php
$(document).ready(function(){
        $('.resAnuncio').submit(function(){
            var formid = $(this).attr('id');
            
            var clasificadoid = formid.slice(8);
            // alert('la id del clasificado es' + clasificadoid);
            var respondonid = $('#respondonid'+clasificadoid).val();
            //Coger el mensaje, email y titulo
            var mensaje = $('#oferta_'+clasificadoid).val();
            var Email = $('#email'+clasificadoid).val();
            var Titulo = $('#titulo'+clasificadoid).val();
            //array de palabras no permitidas
            var terminosPublicidad = ['cialis','Propecia','coupons','Cialis','Viagra'];
            
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)/; //expresion regular de un email
            var urlRegex = /((\bhttps?:\/\/)|(\bwww\.))\S*/; // expression regular de una pagina web
            if (mensaje.length < 20){
                $(this).before('Por favor ponga una respuesta mas elaborada para el clasificado con la id' + clasificadoid);
                return false;
            }

            // alert (respondonid);
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
                    $('#comentar'+clasificadoid).prepend('Escriba un mensaje claro y preciso');
                    return false;
                }
            }

            if (mensaje.length > 500){
                $(this).before('Por favor ponga una respuesta mas compacta');
                return false;
            }
            var clasiData = {
                oferta: mensaje,
                productoid: clasificadoid,
                email: Email,
                titulo: Titulo
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
                alert('Por favor entre como usuario o usuaria para poder responder');
            }

            $('#formularioRespuesta'+data).html(newHTML);
        }

        //Enviar un mensaje desde una foto de su catalogo, estasfotos.inc.php
        $('#resEstasFotos').submit(function(){
             var respondonid = $('#respondonid').val();
             var factoryid = $('#empresaid').val();
             var picid = $('#picid').val();
             var mensaje = $('#oferta').val();

             //evaluar que haya un mensaje y un correo electronico
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)/; //expresion regular de un email
            if (mensaje.length < 20){
                $(this).before('Por favor envie un mensaje mas completo');
                return false;
            }
            //revisar si la persona ha entrado como usuaria
            if (respondonid == null || respondonid == undefined || respondonid.length == 0){
                if (mensaje.search(emailRegex) == -1){
                    $(this).before('Por favor ponga un correo electronico en su mensaje, para que le puedan contactar');
                    return false;   
                }
            }

            var fotoData = {
                oferta: mensaje,
                empresaid: factoryid,
                photoid: picid
            };

             // desactivar boton de submit id responderBoton
             $('#responderBoton').attr('disabled',true);
            
            $.post('catalogos.php?content=responder',fotoData,procesarFotoData);
            return false;
        }); //end submit
        //la funcion que procesa la respuesta a la foto
        function procesarFotoData(data,status){
            var newHTML;
            if (status = 'success'){
                newHTML = '<i class="rounded-x fa fa-check"></i>';
                newHTML += '<p>Se ha enviado su mensaje, gracias por su participacion</p>';
            }else
            {
                alert('Por favor entre como usuario o usuaria para poder responder');
            }

            $('#sky-formRespuesta').html(newHTML);
            $('#responderBoton').attr('disabled',false);
        }

});//end ready

//function que actualiza las redes sociales
    $(document).on('click','.resAnuncio',function(){
            var formid = $(this).attr('id');
            //alert(formid);
            var clasificadoid = formid.slice(8);
            
            var respondonid = $('#respondonid'+clasificadoid).val();
            //Coger el mensaje, email y titulo
            var mensaje = $('#oferta_'+clasificadoid).val();
            var Email = $('#email'+clasificadoid).val();
            var Titulo = $('#titulo'+clasificadoid).val();
            //array de palabras no permitidas
            var terminosPublicidad = ['cialis','Propecia','coupons','Cialis','Viagra'];
            
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)/; //expresion regular de un email
            var urlRegex = /((\bhttps?:\/\/)|(\bwww\.))\S*/; // expression regular de una pagina web
            if (mensaje.length < 20){
                $(this).before('Por favor ponga una respuesta mas elaborada');
                return false;
            }

            alert (respondonid);
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
                    $('#comentar'+clasificadoid).prepend('Escriba un mensaje claro y preciso');
                    return false;
                }
            }

            if (mensaje.length > 500){
                $(this).before('Por favor ponga una respuesta mas compacta');
                return false;
            }
            var clasiData = {
                oferta: mensaje,
                productoid: clasificadoid,
                email: Email,
                titulo: Titulo
            };
            $.post('responder.php',clasiData,procesarClasiData);
            return false;
        });