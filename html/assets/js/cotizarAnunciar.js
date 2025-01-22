//este documento es para hacer cotizaciones y publicar anuncios
// esta enlazadoal documento cotizar.inc.php y analisis.inc.php
// en el footer html
$(document).ready(function(){
        
        $('#materialesCotizacion').submit(function(){
            //obtener la cantidad de renglones
            var contador = $('#contador').val();
            var title = $('#titulo').val();
            var city = $('#ciudad').val();
            
            var phone = $('#telefono').val();
            var provincia = $('#departamento').val();
            var catid = $('#sector').val();

            //primer renglone, primeras dos casillas
            var insumo_1 = $('#insumo1').val();
            //var cantidad_1 = $('#cantidad1').val();

            $('#botonCotizarMateriales').attr('disabled', true);
            // desactivar el boton de enviar
            if(title.length < 5){
                $('span.error').remove();
                $('#titulo').after('<span class="error">Por favor ponga una descripcion mas larga</span>');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else if(city.length < 2){
                $('span.faltaciudad').remove();
                $('#ciudad').after('<span class="faltaciudad">Ponga una ciudad</span>');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else if(phone.length > 12){
                $('#telefono').after('Porfavor ponga un telefono valido en este formato ### ### ####');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else if (insumo_1.length < 1){
                $('span.faltaarticulo').remove();
                $('#insumo1').after('<span class="faltaarticulo">Ponga un articulo</span>');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else{
                // validar las casillas de materiales y cantidades
                var num = contador + 1;
                //for loop para revisar todos los valores del formulario
                for (var i=1; i<num; i++){
                    var item = $('#insumo'+i).val();
                    var qty = $('#cantidad'+i).val();  

                        //si no hay material
                        if(item.length > 1){
                            if(qty < 1){
                                $('span.faltacantidad').remove();
                                $('#cantidad'+i).after('<span class="faltacantidad">Ponga una cantidad</span>');
                                $('#botonCotizarMateriales').attr('disabled',false);
                                return false;
                            }
                        }else{
                            //enviar la lista si pasa todos los filtros

                            var cotiData = $(this).serialize();
                            $.post('ajaxphp/cotizarlista.php', cotiData, function(data, status){
                                var newMensaje;
                                if(status = 'success'){
                                        newMensaje = '<i class="rounded-x fa fa-check"></i>';
                                        newMensaje += '<p>Se ha enviado la cotizacion de materiales con el numero ';
                                        newMensaje += data + '</p>';
                                }else
                                {
                                        newMensaje ='<h2>No se pudo enviar la cotizacion de materiales</h2>';
                                        newMensaje += '<p>Por favor intentelo mas tarde</p>';
                                }
                                    $('#confirmacion').html(newMensaje);
                                    $('#botonCotizarMateriales').after(newMensaje);
                            });
                            $('#botonCotizarMateriales').attr('disabled',false);
                            return false;
                        }
                        //alert('esta es la vuelta numero '+ i); 
                    } //cierra el for loop
            }
            
        });//end submit

        //empiezar otro submit
        $('#serviciosCotizacion').submit(function(){
            
            var descripcion = $('#descripcion').val();
            var city = $('#city').val();
            
            // desactivar el boton de cotizar
            $('#botonCotizarServicios').attr('disabled', true);


            if(city.length < 2){
                $('span.faltaCiudad').remove();
                $('#city').after('<span class="faltaCiudad">Por favor ponga una ciudad</span>');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }else if(descripcion.length < 10){
                $('span.faltaDescripcion').remove();
                $('#descripcion').after('<span class="faltaDescripcion">Ponga una descripcion mas completa de lo que requiere</span>');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }else if (descripcion.length > 500){
                $('span.faltaDescripcion').remove();
                $('#descripcion').before('<span class="faltaDescripcion">Por favor explique su servicio con menos palabras</span>');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;   
            }else if (descripcion.indexOf('href') != -1){
                $(this).before('Escriba un mensaje sin enlaces a otras paginas web');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;   
            }else{
                var cotiData = $(this).serialize();
                $.post('ajaxphp/cotiservicios.php', cotiData, function(data){
                $('#botonCotizarServicios').after('<h2>'+data+'</h2>');
                });
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }
            
        });//end submit
        //empezar otro submit, paginas.: panelusuario.inc.php
        $('#clasificadoProductos').submit(function(){
            var title = $('#title').val();
            var descripcion = $('#productos').val();
            var municipio = $('#municipio').val();
            var phone = $('#telephone').val();
            var phoneRegex = /\(?(\d{3})\)?[ -.](\d{3}[ -.])(\d{4})/;
            $('#botonAnunciarProductos').attr('disabled', true);
            if(title.length < 5){
                $('#title').after('Por favor ponga un titulo mas descriptivo');
                $('#botonAnunciarProductos').attr('disabled', false);
                return false;
            }else if(municipio.length < 2){
                $('#municipio').after('Por favor ponga una ciudad');
                $('#botonAnunciarProductos').attr('disabled', false);
                return false;
            }else if(descripcion.length < 10){
                $('#productos').after('Por favor describa mas detalladamente lo que ofrece');
                $('#botonAnunciarProductos').attr('disabled', false);
                return false;
            }else if (phone.search(phoneRegex) == -1){
                $('#telephone').after('Ponga un numero telefonico valido');
                $('#botonAnunciarProductos').attr('disabled', false);
                return false;
            }
        });//end submit
        //empezar otro submit
        $("#clasificadoServicios").submit(function(){
            var title = $('#tema').val();
            var descripcion = $('#anuncio').val();
            var town = $('#town').val();
            var phone = $('#phone').val();
            var phoneRegex = /\(?(\d{3})\)?[ -.](\d{3}[ -.])(\d{4})/;
            $('#botonAnunciarServicios').attr('disabled', true);
            if(title.length < 5){
                $('#tema').after('Por favor ponga un titulo mas descriptivo');
                $('#botonAnunciarServicios').attr('disabled', false);
                return false;
            }else if(town.length < 2){
                $('#anuncio').after('Por favor ponga una ciudad');
                $('#botonAnunciarServicios').attr('disabled', false);
                return false;
            }else if(descripcion.length < 10){
                $('#town').after('Por favor describa mas detalladamente lo que ofrece');
                $('#botonAnunciarServicios').attr('disabled', false);
                return false;
            }else if (phone.search(phoneRegex) == -1){
                $('#phone').after('Ponga un numero telefonico valido');
                $('#botonAnunciarServicios').attr('disabled', false);
                return false;
            }else{
                // formato de telefono valido
            }
        });//end submit
        // empezar otro submit desde anuncios.php?content=cotizar
        // cuando no se ha entrado como usuarios
        $('#cotizarSinUsuarioid').submit(function(){
            var title = $('#titulo').val();
            var city = $('#ciudad').val();
            var qty = $('#cantidad1').val();
            var item = $('#insumo1').val();
            var phone = $('#telefono').val();
            var phoneRegex = /\(?(\d{3})\)?[ -.](\d{3}[ -.])(\d{4})/;
            var provincia = $('#departamento').val();
            var catid = $('#sector').val();
            // desactivar el boton de enviar
            $('#botonCotizarMateriales').attr('disabled', true);
            if(title.length < 5){
                $('#titulo').after('Por favor ponga un titulo mas descriptivo');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else if(city.length < 2){
                $('#ciudad').after('Ponga una ciudad');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else if(qty < 1){
                $('#cantidad1').after('Ponga una cantidad');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else if (item.length < 1){
                $('#insumo1').after('Ponga un articulo');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else if (phone.search(phoneRegex) == -1){
                $('#telefono').after('Ponga un telefono asi XXX XXX XXXX');
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }else{
                var cotiData = $(this).serialize();
                $.post('vistas/anuncios/cotizando.php', cotiData, function(data){
            
                    $('#confirmacion').html('<h2>'+data+'</h2>');
                    $('#botonCotizarMateriales').after('<h2>'+data+'</h2>');
                });
                $('#botonCotizarMateriales').attr('disabled',false);
                return false;
            }
        });//end submit

        // enviar cotizacion sin haber entrado como usuario desde cotizar.inc.php 
        $('#serviciosSinId').submit(function(){
            var title = $('#subjecto').val();
            var descripcion = $('#descripcion').val();
            var city = $('#city').val();
            var nombre = $('#contacto').val();
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)/; //expresion regular de un email
            var email = $('#correo').val();
            var phone = $('#telephone').val();
            var phoneRegex = /\(?(\d{3})\)?[ -.](\d{3}[ -.])(\d{4})/;
            // desactivar el boton de enviar
            $('#botonCotizarServicios').attr('disabled', true);

            if(title.length < 5){
                $('#subjecto').after('Por favor ponga un titulo mas largo');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }else if(city.length < 2){
                $('#city').after('Por favor ponga el nombre de una ciudad');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }else if(descripcion.length < 10){
                $('#descripcion').after('Ponga una descripcion mas extensa de lo que requiere');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }else if (descripcion.length > 500){
                $(this).before('Por favor explique su servicio con menos palabras');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;   
            }else if (descripcion.indexOf('href') != -1){
                $(this).before('Escriba un mensaje sin enlaces a otras paginas web');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;   
            }else if(nombre.length < 1){
                $('#contacto').after('Por favor ponga su nombre');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }else if(email.search(emailRegex) == -1){
                $('#correo').after('Por favor ponga un correo valido');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }else if (phone.search(phoneRegex) == -1){
                $('#telephone').after('Ponga un telefono asi XXX XXX XXXX');
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }else{
                var cotiData = $(this).serialize();
                $.post('vistas/anuncios/cotizar_servicios.php', cotiData, function(data){
                    $('#botonCotizarServicios').after('<h2>'+data+'</h2>');
                });
                $('#botonCotizarServicios').attr('disabled', false);
                return false;
            }
        });//end submit

        // contar los caracteres en la descripcion de anunciar productos y servicios en usuariosanunciar.inc.php
         function contarCaracteres(){
            let textoEscrito = $('#productos').val();
            //console.log(textoEscrito);
            if (textoEscrito.length <= 500){
                   $('#errorProductos').html('<h5>Porfavor escriba menos de 500 caracteres, ha escrito ('+ textoEscrito.length +' caracteres)</h5>' );
                 
            }else if (textoEscrito.length > 500){
                   $('#errorProductos').html('<h5 style="color:red">Por favor escriba un texto de menos de 500 caracteres. ('+ textoEscrito.length +' caracteres)</h5>' );
                 
            }
        }
        $('#productos').keyup(contarCaracteres);

        function contarLetras(){
            let textoEscrito = $('#anuncio').val();
            //console.log(textoEscrito);
            if (textoEscrito.length <= 500){
                   $('#errorAnuncio').html('<h5>Porfavor escriba menos de 500 caracteres, ha escrito ('+ textoEscrito.length +' caracteres)</h5>' );
                 
            }else if (textoEscrito.length > 500){
                   $('#errorAnuncio').html('<h5 style="color:red">Por favor escriba un texto de menos de 500 caracteres. ('+ textoEscrito.length +' caracteres)</h5>' );
                 
            }
        }
        $('#anuncio').keyup(contarLetras);

    });//end ready