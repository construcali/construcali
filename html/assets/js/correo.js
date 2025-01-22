 // usa con la pagina correo.inc.php
 // dentro de usuarios.php?content=correo, linea 749
 // se une en el footer en la linea 166
 
 $(document).ready(function(){
        $('#contactarConstrucali').submit(function(){
            var motivo = $('#motivo').val();
            var mensaje = $('#message').val();
            $('#botonContactar').attr('disabled',true);
            if (motivo == ''){
            	$('#contactarConstrucali').prepend('Por favor ponga un motivo para su mensaje');
                $('#botonContactar').attr('disabled',false);
            	return false;
            }else if(mensaje == ''){
            	$('#contactarConstrucali').prepend('Por favor ponga un mensaje');
                $('#botonContactar').attr('disabled',false);
            	return false;
            }else
            {	
                var sobre = {
                    titulo: motivo,
                    texto: mensaje
                }

            	$.post('ajaxphp/contactar.php',sobre, function(data,status){
                $('#contactarConstrucali').prepend('<i class="rounded-x fa fa-check"></i><h4>'+data+'</h4>');
                $('#botonContactar').attr('disabled',false);
                });
            return false;
            }
            //return false;
        });

        // contar caracteres en la caja de envio de correo empresarial
        // pagina correo.inc.php
        function contarCaracteres(){
            let textoEscrito = $('#correoEmpresas').val();
            //var mensajeCorreo = $('#mensajeCorreo').html();
            //console.log(mensajeCorreo);
            
            if (textoEscrito.length <= 20){
               
                $('#mensajeCorreo').html('<h5 style="color:red">Mensaje: Por favor escriba un texto de mas de 20 caracteres ('+ textoEscrito.length +' caracteres)</h5>');          
                 
            }else if ((textoEscrito.length > 20) && (textoEscrito.length < 500)){
                
                $('#mensajeCorreo').html('<h5>Mensaje: Escriba menos de 500 caracteres, ('+ textoEscrito.length +' caracteres)</h5>');
                
            }
            else if (textoEscrito.length > 500){
                
                $('#mensajeCorreo').html('<h5 style="color:red">Mensaje: Escriba menos de 500 caracteres, ('+ textoEscrito.length +' caracteres)</h5>');
                
            }
        }
        // activa la funcion de contactar caracteres en tablero.inc.php
        $('#correoEmpresas').keyup(contarCaracteres);

        // correo masivo empresaria - id = subiroferta
        $('#subirOferta').submit(function(){

            var titulo = $('#tituloCorreoEmpresas').val();
           
            var oferta = $('#correoEmpresas').val();
            if (titulo.length < 5){
                $('#tituloCorreoEmpresas').before('Ponga un titulo mas descriptivo');
                return false;
            }else if(oferta.length < 20){
                $('#mensajeCorreo').html('Describa mejor lo que ofrece');
                return false;
            }else if (oferta.length > 500){
                $('#mensajeCorreo').html('Describa su oferta en menos de 500 caracteres');
                return false;
            }
        }); //end submit

        // cuando el numero de subscriptores cambia, id=subscriptores
        $('#subscriptores').change(function(){
            var puntajeRequerido = $(this).val();
            var puntajeActual = $('#puntajeActual').attr('value');

            $('#puntajeActual').html('Requiere '+puntajeRequerido+' puntos, su puntaje es: '+puntajeActual);
        });

        // enviar correo a usuarios
        // $('#fotoCorreo').hide();

        $('#enviarFoto').click(function(){
            if($(this).prop('checked')){
                // alert('Selciono la casilla');
                $('#fotoCorreo').show();
            }else{
                // alert('No seleciono la casilla');
                $('#fotoCorreo').hide();
            }
        }); 

        $('#correoUsuarios').submit(function(){
        	var numeroUsuarios = $('#subscriptores').val();
        	var puntajeActual = $('#puntajeActual').attr('value');
            puntajeActual = Number(puntajeActual);
            var motivo = $('#tituloCorreoUsuarios').val();
            var oferta = $('#correoMasivo').val();
            $('#spinner').show();
            $('#botonCorreo').attr('disabled',true);
           
            
            if (motivo.length < 5){
                $('#tituloCorreoUsuarios').before('Ponga un titulo mas descriptivo');
                $('#botonCorreo').attr('disabled',false);
                return false;
            }else if (oferta.length < 20){
                $('#correoMasivoMensaje').html('Describa mejor lo que ofrece');
                $('#botonCorreo').attr('disabled',false);
                return false;
            }else if (oferta.length > 500){
                $('#correoMasivoMensaje').html('Escriba su oferta en menos de 500 caracteres');
                $('#botonCorreo').attr('disabled',false);
                return false;
            }else if (puntajeActual < numeroUsuarios){
        		$('#puntajeActual').html('<b>Requiere '+numeroUsuarios+' puntos para enviar este correo masivo</b>, su puntaje es '+puntajeActual);
        		$('#botonCorreo').attr('disabled',false);
                return false;
        	}else if ($('#enviarFoto').prop('checked')){
                $('#spinner').show();
            }
            else{

                $('#spinner').show();
                $('#botonCorreo').attr('disabled',true);

                var carta = {
                    titulo: motivo,
                    texto: oferta,
                    puntaje: puntajeActual,
                    receptores: numeroUsuarios
                }
                
                $.post('ajaxphp/correomasivo.php',carta, function(data){
                
                $('#botonCorreo').attr('disabled',false);
                $('#correoUsuarios').prepend('<h4><i class="rounded-x fa fa-check"></i>'+data+'</h4>');
                
                });

                $('#botonCorreo').attr('disabled',false);
                return false;
            }
        });

    });