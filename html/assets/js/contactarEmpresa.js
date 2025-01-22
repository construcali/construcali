/*Javascript para contactar una empresa
Se usa en la pagina de estaempresa.inc.php
con la id sky-form3 y va al archivo cotizar.php
Este archivo esta unido o se llama desde la pagina footer.html, linea 177
*/

$(document).ready(function(){
        $('#contactarEmpresa').submit(function(){
        	var mensaje = $('#message').val();
        	var respondonid = $('#respondonid').val(); //mirar si quien contesta ha entrado
            var companyid = $('#empresaid').val();
        	var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)/; //expresion regular de un email
            var urlRegex = /((\bhttps?:\/\/)|(\bwww\.))\S*/; // expression regular de una pagina web
            //coger el boton que envia el mensaje a la empresa
            $('#contactarEmpresa button').attr('disabled', true);
            $('#contactarEmpresa button').removeClass('btn-u-green');
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
                    $(this).before('Por favor escriba un correo electronico en su mensaje al que le puedan contactar');
                    return false;   
                }

                if (mensaje.search(urlRegex) == -1){
                    $(this).before('Debe vicularse como usuario para poder poner una pagina web en el mensaje');
                    
                    return false;   
                }

                if (mensaje.indexOf('href') != -1){
                    $(this).before('Escriba un mensaje sin enlaces a otras paginas web');
                    return false;   
                }
            }

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
            }else{
                newHTML = '<h2>No se ha podido enviar su mensaje</h2>';
                newHTML += '<p>Por favor intentelo mas tarde.</p>';
            }
            $('#contactarEmpresa-respuesta').html(newHTML);
            $('#contactarEmpresa button').attr('disabled', false);
            $('#contactarEmpresa button').addClass('btn-u-green');
        }
    });//end ready