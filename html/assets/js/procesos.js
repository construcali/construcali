/*
* Aqui hay varios procesos de javascript
* hay que quitarlos del footer
* y dejarlos aqui sin las etiquetas de script
*/

    
    $(document).ready(function(){
        $('#nuevaOferta').hide(); 
        $('#hacerOferta').click(function(){
            $('#nuevaOferta').show('slow');
        });
        $('#hacerPublicacion').click(function(){
            $('#nuevaOferta').show('slow');
        });
        $('#confirmado').hide();
        $('#subaPortafolio').click(function(){
            $('#confirmado').show('slow');
            return false;
        });
        $('#editePortafolio').click(function(){
            $('#confirmado').show('slow');
            return false;
        });
        
        $('#hacerCatalogo').click(function(){
            $('#editarCatalogo').show('slow');
            return false;
        });
        $('#map').hide();
        $('#ubicar').click(
        function(){
        $('#map').show('slow');
        return false;
        }
        );//end click  
        }); 
    

<!-- incluir accounting.js para que formatee los numeros -->
<script type="text/javascript" src="assets/js/accounting.js"></script>
<!-- JavaScript para procesar formulario de entrada -->
    <script type="text/javascript">
    $(document).ready(function(){
        $('#sky-form2').submit(function(){
            var email = $('#email2').val();
            var password = $('#password2').val();
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+[-A-z0-9]+\.)+[A-z]{2,4}/;
            var testEmail = email.match(emailRegex);
            if(! testEmail){
                alert('Ponga un correo electronico valido');
                return false;
            }else if(password.length < 1){
                alert('Porfavor ponga una clave valida');
                return false;
            }
        });//end submit  
    });//end ready
    </script>
<!-- JavaScript para procesar la cotizacion -->
    <script type="text/javascript">
    $(document).ready(function(){
        $('#sky-form3').submit(function(){
            var mensaje = $('#message').val();
            var companyid = $('#empresaid').val();
            if (mensaje.length <= 10){
                alert('Por favor ponga un mensaje mas largo');
                return false;
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
            }else
            {
                newHTML = '<h2>No se ha podido enviar su mensaje</h2>';
                newHTML += '<p>Por favor intentelo mas tarde.</p>';
            }
            $('#sky-form3-respuesta').html(newHTML);
        }
    });//end ready
    </script>
<!--Termina Javascript para la cotizacion -->
<!-- Validar los formularios para las empresas -->
<script type="text/javascript" src="assets/js/validar.js"></script>
<!--Cambiar de pagina cuando se seleciona otra opcion -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#claseid').change(function(){
            $('#clasecat').submit();
        });
    });
</script>
<!--Cambiar de pagina cuando se seleciona otra ciudad -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#ciudad').change(function(){
            $('#claseciudad').submit();
        });
    });
</script>
<!-- Procesar la respuesta a un clasificado -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#resPuesta').submit(function(){
            var mensaje = $('#oferta').val();
            var clasificadoid = $('#productoid').val();
            var Email = $('#email').val();
            var Titulo = $('#titulo').val();
            if (mensaje.length < 40){
                alert('Por favor ponga una respuesta mas elaborada');
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
                newHTML += '<p>'+ data + '.</p>';
            }else
            {
                newHTML = '<h2>No se ha podido enviar su mensaje</h2>';
                newHTML += '<p>Por favor intentelo mas tarde.</p>';
            }
            $('#sky-formRespuesta').html(newHTML);
        }
    });//end ready
</script>
<!-- Asegurarse que ponen una ciudad a la hora de buscar (clacontenido.inc.php) -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#buscarTerminos').submit(function(){
            var city = $('#ciudadClave').val();
            if(city < 2){
                alert('Porfavor ponga una ciudad');
                return false;
            }
        });//end submit
    });//end ready
</script>
<!-- Poner un nuevo tema en los foros -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#nuevoForo').submit(function(){
            var title = $('#titulo').val();
            var argumento = $('#mensaje').val();
            var catid = $('#categoria').val(); 
            if(title.length < 5){
                alert('Por favor ponga un titulo mas largo');
                return false;
            }else if (argumento.length < 10) {
                alert('Por favor explique mas el tema de su foro');
                return false;
            }else if(argumento.length > 5000){
                alert('Por favor explique su tema en menos palabras');
                return false;
            }else{
                var foroData ={
                    mensaje: argumento,
                    titulo: title,
                    categoria: catid
                };
                $.post('publicar.php',foroData,procesarForoData);
                return false;
            }
        });//end submit
        function procesarForoData(data,status){
            var newHTML;
            if(status = 'success'){
                newHTML = '<i class="rounded-x fa fa-check"></i>';
                newHTML += '<p>'+data+'.</p>';
            }else
            {
                newHTML = '<h2>No pudimos publicar su foro</h2>';
                newHTML += '<p>Por favor intentelo mas tarde</p>';
            }
            $('#procesarForo').html(newHTML);
        }
    });//end ready
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#nuevoComentario').submit(function(){
            var comment = $('#comentario').val();
            var productoid = $('#foroid').val();
            if(comment.length < 10){
                alert('Por favor ponga un comentario mas largo');
                return false;
            }else if(comment.length > 50000){
                alert('Por favor haga un comentario mas breve');
                return false;
            }else
            {
                var commentData ={
                    comentario: comment,
                    foroid: productoid
                };
                $.post('pubcomentario.php',commentData,procesarCommentData);
                return false;
            }
        }); //end submit
        function procesarCommentData(data,status){
            var newHTML;
            if(status = 'success'){
                newHTML = '<i class="rounded-x fa fa-check"></i>';
                newHTML += '<p>'+data+'.</p>';
            }else
            {
                newHTML = '<h2>No pudimos publicar su comentario ahora</h2>';
                newHTML += '<p>Por favor intentelo mas tarde</p>';
            }
            $('#procesarComentario').html(newHTML);
        }
    }); //end ready
</script>
<script type="text/javascript">
    //Poner clasificados y hacer cotizaciones
    $(document).ready(function(){
        $('#materialesCotizacion').submit(function(){
            var title = $('#titulo').val();
            var ciudad = $('#ciudad').val();
            var qty = $('#cantidad1').val();
            var phone = $('#telefono').val();
            var phoneRegex = /\(?(\d{3})\)?[ -.](\d{3}[ -.])(\d{4})/;
            //var telefono = phone.match(phoneRegex);
            if(title.length < 5){
                alert('Por favor ponga un titulo mas descriptivo');
                return false;
            }else if(ciudad.length < 2){
                alert('Por favor ponga una ciudad');
                return false;
            }else if(qty < 1){
                alert('Por favor ponga un articulo para cotizar');
                return false;
            }else if (phone.search(phoneRegex) == -1){
                alert('Ponga un numero telefonico valido');
                return false;
            }else{
                // formato de telefono valido
            }
        });//end submit
        //empiezar otro submit
        $('#serviciosCotizacion').submit(function(){
            var title = $('#subjecto').val();
            var descripcion = $('#descripcion').val();
            var city = $('#city').val();
            if(title.length < 5){
                alert('Por favor ponga un titulo mas descriptivo');
                return false;
            }else if(city.length < 2){
                alert('Por favor ponga una ciudad');
                return false;
            }else if(descripcion.length < 10){
                alert('Por una mayor descripcion de lo que requiere');
                return false;
            }
        });//end submit
        //empezar otro submit
        $('#clasificadoProductos').submit(function(){
            var title = $('#title').val();
            var descripcion = $('#productos').val();
            var municipio = $('#municipio').val();
            var phone = $('#telephone').val();
            var phoneRegex = /\(?(\d{3})\)?[ -.](\d{3}[ -.])(\d{4})/;
            if(title.length < 5){
                alert('Por favor ponga un titulo mas descriptivo');
                return false;
            }else if(municipio.length < 2){
                alert('Por favor ponga una ciudad');
                return false;
            }else if(descripcion.length < 10){
                alert('Por favor describa mas detalladamente lo que ofrece');
                return false;
            }else if (phone.search(phoneRegex) == -1){
                alert('Ponga un numero telefonico valido');
                return false;
            }else{
                // formato de telefono valido
            }
        });//end submit
        //empezar otro submit
        $("#clasificadoServicios").submit(function(){
            var title = $('#tema').val();
            var descripcion = $('#anuncio').val();
            var town = $('#town').val();
            var phone = $('#phone').val();
            var phoneRegex = /\(?(\d{3})\)?[ -.](\d{3}[ -.])(\d{4})/;
            if(title.length < 5){
                alert('Por favor ponga un titulo mas descriptivo');
                return false;
            }else if(town.length < 2){
                alert('Por favor ponga una ciudad');
                return false;
            }else if(descripcion.length < 10){
                alert('Por favor describa mas detalladamente lo que ofrece');
                return false;
            }else if (phone.search(phoneRegex) == -1){
                alert('Ponga un numero telefonico valido');
                return false;
            }else{
                // formato de telefono valido
            }
        });//end submit
    });//end ready
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //Modificar el cuadro con la informacion de las redes sociales
        $('#editarRedesSociales').click(function(){
            var redesSociales = '<li><i class="rounded-x tw fa fa-twitter"></i><input type="text" name="twitter" id="twitter" size="40" maxlength="100" placeholder="@colconstruccion"></li>';
            redesSociales += '<li><i class="rounded-x fa fa-facebook"></i><input type="text" name="facebook" id="facebook" size="40" maxlength="100" placeholder="colconstruccion"></li>';
            redesSociales += '<li><i class="rounded-x fa fa-linkedin"></i><input type="text" name="linkedin" id="linkedin" size="40" maxlength="100" placeholder="colconstruccion"></li>';
            redesSociales += '<li><i class="rounded-x fa fa-external-link"></i><input type="text" placeholder="http://arquiplac.co" name="paginaweb" id="paginaweb" size="40" maxlength="100" placeholder="colconstruccion.com"></li>';
            redesSociales += '<li><i class="rounded-x fa fa-envelope"></i><input type="text" name="email" id="email" size="40" maxlength="100" placeholder="publicidad@colconstruccion.com"></li>';
            redesSociales += '<a href="#" class="btn-u btn-u-default" id="actualizarRedes">Actualizar</a>';
            $('#formRedesSociales').html(redesSociales);
            return false;
        });//end click
        //modificar info de contacto de la empresa
        $('#editarInfoContacto').click(function(){
            var infoContacto = '<li><i class="rounded-x tw fa fa-user"></i><input type="text" name="contacto" id="contacto" size="40" maxlength="100" placeholder="Nombre del contacto"></li>';
            infoContacto += '<li><i class="rounded-x fa fa-phone"></i><input type="text" name="telefono" id="telefono" size="40" maxlength="100" placeholder="347 300 6552"></li>';
            infoContacto += '<li><i class="fa fa-map-marker"></i><input type="text" name="direcion" id="direcion" size="40" maxlength="100" placeholder="101-10 Calle 34"></li>';
            infoContacto += '<li><i class="rounded-x fa fa-globe"></i><input type="text" name="ciudad" id="ciudad" size="40" maxlength="100" placeholder="Cartagena"></li>';
            infoContacto += '<a href="#" class="btn-u btn-u-default" id="actualizarContacto">Actualizar</a>';
            $('#formInfoContacto').html(infoContacto);
            return false;
        });//end click
        //modificar info de mision y servicio de la empresa
        //de aqui va a linea 607
        $('#editarInfoEmpresa').click(function(){
            $('#newCategory').removeClass('esconder');
            var currentMision = $('#estaMision').html();
            var currentServicio = $('#esteServicio').html();
            var infoMisionyVision = '<section><label class="label">Mision y Vision</label><label class="textarea"><i class="icon-append fa fa-comment"></i><textarea rows="4" cols="40" name="mision" id="mision">'+currentMision+'</textarea></label></section>';
            var infoServicio = '<section><label class="label">Descripcion de servicios o productos</label><label class="textarea"><i class="icon-append fa fa-comment"></i><textarea rows="4" cols="40" name="servicio" id="servicio">'+currentServicio+'</textarea></label></section>';
            $('#formServicio').html(infoServicio);
            $('#formMision').html(infoMisionyVision);
            $('#formMision').after('<div class="col-md-12"><button class="button" id="actualizarMision">Actualizar</button></div>');
        }); //end click 
    });//end ready
    //function que actualiza las redes sociales
    $(document).on('click','#actualizarRedes',function(){
        var twitter = $('#twitter').val();
        var facebook = $('#facebook').val();
        var linkedin = $('#linkedin').val();
        var paginaweb = $('#paginaweb').val();
        var webRegex = /((\bhttps?:\/\/)|(\bwww\.))\S*/;
        var testWeb = paginaweb.match(webRegex);
        var email = $('#email').val();
        var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/;
        var testEmail = email.match(emailRegex);

        if(! testEmail){
            alert('Ponga un correo electronico valido');
            return false;
        }else if(! testWeb){
            alert('Ponga una pagina correcta, copie la del navegador si es necesario');
            return false;
        }
        else{

        var redData = {
            tw: twitter,
            fb: facebook,
            linked: linkedin,
            paginared: paginaweb,
            ecorreo: email,
            content: 'editarRedes'
        };

            
        //Mostrar la informacion subida
        var netSocial = '<li><i class="rounded-x tw fa fa-twitter"></i> <a href="http://twitter.com/'+twitter+'">'+twitter+'</a></li>';
        netSocial += '<li><i class="rounded-x fb fa fa-facebook"></i> <a href="http://facebook.com/'+facebook+'">'+facebook+'</a></li>';
        netSocial += '<li><i class="rounded-x sk fa fa-linkedin"></i> <a href="http://linkedin.com/'+linkedin+'">'+linkedin+'</a></li>';
        netSocial += '<li><i class="rounded-x gp fa fa-external-link"></i><a href="'+paginaweb+'" target="_blank">'+paginaweb+'</a></li>';   
        netSocial += '<li><i class="rounded-x gm fa fa-envelope"></i>'+email+'</li>';
        $('#formRedesSociales').html(netSocial);
        //la variable content debe ir en la variable redData porque estoy usando el methodo post
        $.post('usuarios.php', redData, function(status){
            var newMensaje;
            if(status = 'success'){
                newMensaje = '<i class="rounded-x fa fa-check"></i>';
                newMensaje += '<p>Se ha actualizado la informacion de su empresa</p>';
            }else
            {
                newMensaje ='<h2>No se pudo actualizar la informacion de su empresa</h2>';
                newMensaje += '<p>Por favor intentelo mas tarde</p>';
            }
            $('#confirmacion').html(newMensaje);
        });
        //alert(paginaweb);
        return false;
    }//closes else
    });//end on
    //nuevo on para info de contacto
    $(document).on('click','#actualizarContacto',function(){
        var contacto = $('#contacto').val();
        var telefono = $('#telefono').val();
        var direcion = $('#direcion').val();
        var ciudad = $('#ciudad').val();
        var telRegex = /\(?(\d{3})\)?[ -.](\d{3})[ -.](\d{4})/;
        var testTel = telefono.match(telRegex);
        var conRegex = /[\w]/;
        var testContacto = contacto.match(conRegex);
        var testCiudad = ciudad.match(conRegex);
        var dirRegex = /[-#\w.]/;
        var testDirecion = direcion.match(dirRegex);
        if (! testTel){
            alert('Ponga un telefono mobil como este ejemplo 123 456 7899');
            return false;
        }else if (! testContacto) {
            alert('Ponga un nombre del contacto valido');
            return false;
        }else if (! testCiudad){
            alert('Ponga un ciudad valida');
            return false;
        }else if (! testDirecion) {
            alert('Ponga una direcion correcta');
            return false;
        }else
        {
            //alert(direcion);
            var contactoData = {
                contact: contacto,
                tel: telefono,
                address: direcion,
                city: ciudad,
                content: 'editarContacto'
            };
            //mostrar informacion actualizada
            //Mostrar la informacion subida
            var infoEmpresa = '<li><i class="rounded-x fa fa-user"></i>'+contacto+'</li>';
            infoEmpresa += '<li><i class="rounded-x fa fa-phone"></i>'+telefono+'</li>';
            infoEmpresa += '<li><i class="rounded-x fa fa-map-marker"></i>'+direcion+'</li>';
            infoEmpresa += '<li><i class="rounded-x fa fa-globe"></i>'+ciudad+'</li>';
            $('#formInfoContacto').html(infoEmpresa);
            $.post('usuarios.php',contactoData,function(status){
                var newMensaje;
                if(status = 'success'){
                    newMensaje = '<i class="rounded-x fa fa-check"></i>';
                    newMensaje += '<p>Se ha actualizado la informacion de su empresa</p>';
                }else
                {
                    newMensaje ='<h2>No se pudo actualizar la informacion de su empresa</h2>';
                    newMensaje += '<p>Por favor intentelo mas tarde</p>';
                }
                $('#confirmado').html(newMensaje);
            });//end function that processes call back
            return false
        }//cierra else
    });//end on
    //nuevo on para actualizar mision, vision y descripcion de la empresa
    // viene de linea 483
    $(document).on('click','#actualizarMision',function(){
        var empresaid = $('#empresaid').val();
        var mision = $('#mision').val();
        var servicio = $('#servicio').val();
        var catid = $('#nuevaCategoria').val();
        var misionRegex = /[-\w.]/;
        var testMision = mision.match(misionRegex);
        var testServicio = servicio.match(misionRegex);
        if (! testMision){
            alert('Formatee correctamente su descripcion');
            return false;
        }else if(! testServicio){
            alert('Formatee correctamente su servicio');
            return false;
        }else{
            var misionData = {
                mission: mision,
                service: servicio,
                factoryid: empresaid,
                newCatId: catid,
                content: 'editarMision'
            };
            $('#formServicio').html('<p>'+servicio+'</p>');
            $('#formMision').html('<p>'+mision+'</p>');
            //alert(empresaid);
            $.post('usuarios.php',misionData,function(data){
                var newMensaje;
                if(data = 'exito'){
                    newMensaje = '<i class="rounded-x fa fa-check"></i>';
                    newMensaje += '<p>Se ha incorporado la nueva mision, vision y descripcion</p>';
                }else
                {
                    newMensaje ='<h2>No se pudo actualizar la informacion de su empresa</h2>';
                    newMensaje += '<p>Por favor intentelo mas tarde</p>';
                }
                $('#actualizarMision').after(newMensaje);
                $('#actualizarMision').hide();
            });//end function that process call back status from server function that updates mision y vision
            return false;
        }
    }); //end on
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#subirOferta').submit(function(){
        var titulo = $('#titulo').val();
        var oferta = $('#oferta').val();
        if (titulo.length < 5){
            alert('Ponga un titulo mas descriptivo');
            return false;
        }else if(oferta.length < 100){
            alert('Describa mejor lo que ofrece');
            return false;
        }else if (oferta.length > 200){
            alert('Describa su oferta en menos de 200 caracteres');
            return false;
        }
    }); //end submit
    $('#fotosOfertas img').click(function(){
        var imgPath = $(this).attr('src');
        var fotoid = $(this).attr('id');
        var newImage = $('<div class="row"><div class="col-md-12"><div class="thumbnails thumbnail-style"><img src="'+ imgPath +'" alt="foto de la oferta" width="100%"></div></div></div>');
        newImage.hide();
        $('#photo'+fotoid).prepend(newImage);
        newImage.fadeIn(2000,function(){
            $(this).remove();
        })//end fadein      
    });//end click
}); //end ready    
</script>
<!-- JS para subir las fotos -->
<script type="text/javascript" src="http://construcali.com/assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
<script type="text/javascript" src="http://construcali.com/assets/js/hacerCatalogo.js"></script>
<!-- JS para cargar respuestas a cotizaciones -->
<script type="text/javascript">
    $(document).ready(function(){
        $('.respuestaCotizacion a').click(function(){
            var laxo = $(this).attr('href');
            var id = $(this).attr('id');
            $('#contestada'+id).show('slow');
            $('#contestada'+id).load(laxo);
            return false;
        });//end click
        $('.borrarCotizacion a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(29);
            $('#contestada'+id).show('slow');
            $('#constestada'+id).load(url);
            return false;
        });//end click
        $('.respuestaMateriales a').click(function(){
            var link = $(this).attr('href');
            var id = $(this).attr('id');
            $('#contestacion'+id).load(link);
            return false;
        });//end click
        $('.borrarMateriales a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(29);
            $('#contestacion'+id).load(url);
            return false;
        });//end click
        $('.borrarCorreos a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(26);
            alert(id);
            $('#contestacion'+id).load(url);
            return false;
        });//end click
        $('.respuestaLista a').click(function(){
            var enlace = $(this).attr('href');
            var id  = $(this).attr('id');
            $('#lista'+id).load(enlace);
            return false;
        });//end click
        $('.borrarLista a').click(function(){
            var url = $(this).attr('href');
            var id = url.slice(25);
            $('#lista'+id).load(url);
            return false;
        });//end click
        $('#pedidos a').click(function(){
            var ordenid = $(this).attr('href');
            $('#respuesta'+ordenid).show('slow');
            return false;
        }); //end click
        $('#pedidos form').submit(function(){
            var ordenid = $(this).attr('id');
            var acambio = $('#acambiode'+ordenid).val();
            var pedidoData = {
                pedidoid: ordenid,
                respuesta: acambio,
                content: 'procesarPedido'
            };
            $.post('usuarios.php',pedidoData,function(data,status){
                if (status == 'success'){
                    $('#label'+ordenid).html('<h4>Su respuesta ha sido enviada</h4>');
                }else{
                    $('#label'+ordenid).html('<h4>Su respuesta no ha podido ser enviada</h4>');
                }
            });
            $('#acambiode'+ordenid).attr('disabled',true);
            return false;
        }); //end submit
        $('#comerciales a').click(function(){
            var ordenid = $(this).attr('href');
            $('#respuesta'+ordenid).show('slow');
            return false;
        }); //end click
        $('#comerciales form').submit(function(){
            var ordenid = $(this).attr('id');
            var acambio = $('#acambiode'+ordenid).val();
            var pedidoData = {
                pedidoid: ordenid,
                respuesta: acambio,
                content: 'procesarComercial'
            };
            $.post('usuarios.php',pedidoData,function(data,status){
                if (status == 'success'){
                    $('#respuesta'+ordenid).html('<h4>Su respuesta a la propuesta ha sido enviada</h4>');
                }else{
                    $('#respuesta'+ordenid).html('<h4>Su respuesta a la propuesta no ha podido ser enviada</h4>');
                }
            });
            $('#acambiode'+ordenid).attr('disabled',true);
            return false;
        }); //end submit
        // el id de materiales esta en la pagina de actividades.in.php en la linea 157
        // aqui se carga el documento contestadas.php + la ordenid
        $('.responderUnitarios').click(function(){
            var vinculo = $(this).attr('href');
            console.info(vinculo);
            var ordenid = vinculo.slice(24);
            $('#material'+ordenid).load(vinculo);
            return false;
        });//end click
        $('#generarClave').click(function(){
            $('#pongaEmail').show('slow');
            return false;
        });//end click
        $('#cerrarClave').click(function(){
            $('#pongaEmail').hide('slow');
            return false;
        });//end click
        $('#pongaEmail').submit(function(){
            var email = $('#email3').val();
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+[-A-z0-9]+\.)+[A-z]{2,4}/;
            var testEmail = email.match(emailRegex);
            if(! testEmail){
                alert('Por favor ponga un email correcto');
                return false;
            }
        });//end submit
        $('#cambiarInfo').submit(function(){
            var correo = $('#email').val();
            var tel = $('#telefono').val();
            var contacto = $('#nombre').val();
            var lastname = $('#apellido').val();
            var city = $('#ciudad').val();
            var provincia = $("#departamento").val();
            //probar la informacion
            var telRegex = /\(?(\d{3})\)?[ -.](\d{3})[ -.](\d{4})/;
            var testTel = tel.match(telRegex);
            var conRegex = /[\w]/;
            var testContacto = contacto.match(conRegex);
            var testLastName = lastname.match(conRegex)
            var testCiudad = city.match(conRegex);
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+[-A-z0-9]+\.)+[A-z]{2,4}/;
            var testEmail = correo.match(emailRegex);
            if(! testContacto){
                alert('Ponga su nombre correcto');
                return false;
            }else if(! testLastName){
                alert('Ponga su apellido correcto');
                return false;
            }else if(! testCiudad){
                alert("Ponga una ciudad correcta");
                return false;
            }else if (! testEmail){
                alert('Ponga un email correcto');
                return false;
            }else if(! testTel){
                alert('Ponga un numero telefonico con el formato ### ### ####');
                return false;
            }else{
                var infoData = {
                    email: correo,
                    telefono: tel,
                    nombre: contacto,
                    apellido: lastname,
                    departamento: provincia,
                    ciudad: city
                };
                $.post('cambiarinfo.php',infoData,function(data,status){
                    if (status == 'success'){
                        $('#infoCambiar').prepend('<h4>Su informacion ha cambiado</h4>');
                        $('#cambiarInfo :input').attr('disabled',true);
                    }else{
                        $('#$infoCambiar').prepend('<h4>No se ha podid0 actualizar su informacion');
                    }

                });
                return false;
            }
        });//end submit
        $('#cambiarClave').submit(function(){
            var contraSena = $('#clave').val();
            var nuevaClave = $('#password').val();
            var repetidaClave = $('#repetida').val();
            if (nuevaClave.indexOf(' ') != -1){
                alert('Ponga una clave sin espacios');
                return false;
            }else if(contraSena.length == 0){
                alert('Por favor ponga su clave antigua');
                return false;
            }else if(repetidaClave.length < 6){
                alert('La nueva clave debe tener mas de 6 caracteres');
                return false;
            }else if(nuevaClave != repetidaClave){
                alert('Las dos nuevas claves no coinciden');
                return false;
            }else{
                var claveData = {
                    password: nuevaClave,
                    password1: contraSena
                };
                $.post('cambiarclave.php',claveData,function(data,status){
                    if (status == 'success'){
                        $('#claveCambiar').prepend('<h4>Su clave ha cambiado</h4>');
                        $('#cambiarClave :input').attr('disabled',true);
                    }else{
                        $('#$claveCambiar').prepend('<h4>No se ha podido actualizar su informacion');
                    }
                });
                return false;
            }
        });//end cambiar clave
        $('#registrarUsuario').submit(function(){
           var nombre = $('#nombre').val();
           var apellido = $('#apellido').val();
           var email = $('#email').val();
           var password = $('#password').val();
           var password1 = $('#password1').val();
           var conRegex = /[\w]/;
           var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+[-A-z0-9]+\.)+[A-z]{2,4}/;
           var testContacto = nombre.match(conRegex);
           var testLastName = apellido.match(conRegex);
           var testEmail = email.match(emailRegex);
           if(nombre.length == 0){
            alert('Ponga su nombre');
            return false;
           }
           else if(apellido.length == 0){
            alert('Ponga su apellido');
            return false;
           }
           else if (email.length == 0){
            alert('Ponga su correo electronico');
            return false;
           }
           else if(password.length < 6){
            alert('Por favor ponga una clave mayor de 6 caracteres');
            return false;
           }
           else if(password != password1){
            alert('Sus dos claves deben coincidir');
            return false; 
           }else if(! testContacto){
            alert('Ponga su nombre correcto');
            return false;
           }else if(! testLastName){
            alert('Ponga su apellido correcto');
            return false;
           }else if(! testEmail){
            alert('Ponga su correo electronico correcto');
            return false;
           }
        }); //end submit
        $('#registrarEmpresa').submit(function(){
            var empresa = $('#empresa').val();
            var nombre = $('#nombre').val();
            var email = $('#email').val();
            var telefono = $('#telefono').val();
            var ciudad = $('#ciudad').val();
            var servicio = $('#servicio').val();
            var mision = $('#mision').val();
            var conRegex = /[\w]/;
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+[-A-z0-9]+\.)+[A-z]{2,4}/;
            var telRegex = /\(?(\d{3})\)?[ -.](\d{3})[ -.](\d{4})/;
            var testTel = telefono.match(telRegex);
            var testContacto = nombre.match(conRegex);
            var testCiudad = ciudad.match(conRegex);            
            var testEmail = email.match(emailRegex);

            if(! testContacto){
                alert('Por favor ponga el nombre del contacto en la empresa');
                return false;
            }else if(! testTel){
                alert('Ponga su numero telefonico como el siguiente ejemplo.: 123 456 7899');
                return false;
            }else if(! testEmail){
                alert('Por favor ponga su correo electronico correcto');
                return false;
            }else if (! testCiudad){
                alert('Por favor ponga la ciudad donde se ubica la empresa');
                return false;
            }else if(empresa.length == 0){
                alert('Por favor ponga el nombre de su Empresa');
                return false;
            }else if(servicio.length <=100 || servicio.length > 2000){
                alert('Por favor explique los servicios de su empresa en mas de 100 caracteres y en menos de 2000');
                return false;
            }else if(mision.length <= 100 || mision.length > 2000){
                alert('Por favor explique la mision de su empresa en mas de 100 caracteres y en menos de 2000');
                return false;
            }
        });
    });//end ready
    //vamos a crear un on para procesar el formulario que contesta las cotizaciones de materiales
    //el id de materiales esta en la pagina de actividades.inc.php linea 157
    $(document).on('submit','#actividadesMateriales form',function(){
        var sumaUnitarios = 0;
        var j=1;
        var temporal = '';
        var renglones = $('#actividadesMateriales tr').length;
        var numArticulos = renglones - 1;
        for (var i=0; i<numArticulos;i++){
            temporal = $('#unitario'+j).val();
            unitario = accounting.unformat(temporal);
            sumaUnitarios = unitario + sumaUnitarios;
            j++;
            console.log(sumaUnitarios);
        }
        if (sumaUnitarios <= 0){
            console.log('Porfavor ponga un valor para responder la cotizacion');
            return false;
        }else{
        var formData = $(this).serialize();
        $.post('contestar.php',formData,function(data){
        $('#material'+data).html('<h4>Su Respuesta a la cotizacion de materiales ha sido enviada</h4>');
        });//end post  
    return false;
    } 
    }); //end on
</script>
<!-- redirige el enlace de presupuestos a un url con el id -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#presupuestoCode a').click(function(){
            var href = $(this).attr('href');
            var asociadoid = $(this).attr('id');
            var url = href+'/'+asociadoid;
            $(location).attr('href',url);
            return false;
        }); //end click
    }); //end ready
</script>
<!-- poner las siguientes 15 empresas en el div #listado -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#linksContenido a').click(function(){
            var url = $(this).attr('href');
            $('#listado').load(url);
            return false;
        });
        $('#linksContenido li').click(function(){
            $(this).addClass('active');
        });
    });
</script>
<!-- Poner la ciudad en el formulario de cotizacion cuando escoja un departamento -->
<script type="text/javascript">
    $(document).ready(function(){
        $('.departamento').change(function(){
            if($(this).val() == 'Amazonas'){
                $('.ciudad').val('Leticia');
            }
            if($(this).val() == 'Antioquia'){
                $('.ciudad').val('Medellin');
            }
            if($(this).val() == 'Arauca'){
                $('.ciudad').val('Arauca');
            }
            if($(this).val() == 'Atlantico'){
                $('.ciudad').val('Barranquilla');
            }
            if($(this).val() == 'Bolivar'){
                $('.ciudad').val('Cartagena');
            }
            if($(this).val() == 'Boyaca'){
                $('.ciudad').val('Tunja');
            }
            if($(this).val() == 'Caldas'){
                $('.ciudad').val('Manizales');
            }
            if($(this).val() == 'Caqueta'){
                $('.ciudad').val('Florencia');
            }
            if($(this).val() == 'Casanare'){
                $('.ciudad').val('Yopal');
            }
            if($(this).val() == 'Cauca'){
                $('.ciudad').val('Popayan');
            }
            if($(this).val() == 'Cesar'){
                $('.ciudad').val('Valledupar');
            }
            if($(this).val() == 'Choco'){
                $('.ciudad').val('Quibdo');
            }
            if($(this).val() == 'Cordoba'){
                $('.ciudad').val('Monteria');
            }
            if($(this).val() == 'Cundinamarca'){
                $('.ciudad').val('Bogota');
            }
            if($(this).val() == 'Guajira'){
                $('.ciudad').val('Riohacha');
            }
            if($(this).val() == 'Guania'){
                $('.ciudad').val('Inirida');
            }
            if($(this).val() == 'Guaviare'){
                $('.ciudad').val('San Jose del Guaviare');
            }
            if($(this).val() == 'Huila'){
                $('.ciudad').val('Neiva');
            }
            if($(this).val() == 'Magdalena'){
                $('.ciudad').val('Santa Marta');
            }
            if($(this).val() == 'Meta'){
                $('.ciudad').val('Villavicencio');
            }
            if($(this).val() == 'Nariño'){
                $('.ciudad').val('Pasto');
            }
            if($(this).val() == 'Norte de Santander'){
                $('.ciudad').val('Cucuta');
            }
            if($(this).val() == 'Putumayo'){
                $('.ciudad').val('Mocoa');
            }
            if($(this).val() == 'Quindio'){
                $('.ciudad').val('Armenia');
            }
            if($(this).val() == 'Risaralda'){
                $('.ciudad').val('Pereira');
            }
            if($(this).val() == 'San Andres y Providencia'){
                $('.ciudad').val('San Andres');
            }
            if($(this).val() == 'Santander'){
                $('.ciudad').val('Bucaramanga');
            }
            if($(this).val() == 'Sucre'){
                $('.ciudad').val('Sincelejo');
            }
            if($(this).val() == 'Tolima'){
                $('.ciudad').val('Ibague');
            }
            if($(this).val() == 'Valle del Cauca'){
                $('.ciudad').val('Cali');
            }
            if($(this).val() == 'Vaupes'){
                $('.ciudad').val('Mitu');
            }
            if($(this).val() == 'Vichada'){
                $('.ciudad').val('Puerto Carreño');
            }
        });
    });
</script>
<!-- javascript para reclamar revista-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#secionDirecion').hide();
        $('#reclameBoton').click(function(){
            $('#secionDirecion').show('2000');
            $('#reclameBoton').hide();
        });
        $('#reclamarRevista').click(function(){
            $('#reclamoRevista').html('<p class="col-sm-8" >Su revista sera enviada a la direcion que tenemos de su Empresa en un par de semanas, por favor edite la direcion de su empresa si esta desactualizada.</p>');
            var fabrica = $(this).attr('href');
            $.get('revistas.php', 'factoria='+fabrica);
        });
        $('#nuevaRevista').submit(function(){
            if($('#nuevaDirecion').val() == ''){
                alert('Por favor ponga una direcion valida.');
                return false;
            }else if ($('#nuevaCiudad').val() == ''){
                alert('Por favor ponga la ciudad y el departamento');
                return false;
            }else{
                var direcion = $('#nuevaDirecion').val();
                var municipio = $('#nuevaCiudad').val();
                $('#revistaReclamada').html('<p class="col-sm-8" >Su revista sera enviada a la direcion subministrada en las proximas semanas, muchas gracias.</p>');
                $.post('revistas.php', 'nuevaDirecion='+direcion+','+municipio);
            }        
        });
    });
</script>
<!-- End javaScript para reclamar revista-->
<!-- JavaScript para responder cotizacions -->
<script type="text/javascript" src="assets/js/responderCotizacion.js"></script>
</body>
</html>