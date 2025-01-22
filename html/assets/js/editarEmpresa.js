 /*
* JavaScript para editar la informacion de la empresa
* JavaScript usado en la pagina de empresa.inc.php
* en la seccion de editar linea 115
* este script es unido en el footer.html linea 430
* CKEditor esta unido en header.php
*/
 $(document).ready(function(){
        //Modificar el cuadro con la informacion de las redes sociales
        $('#editarRedesSociales').click(function(){
            var redesSociales = '<li><i class="rounded-x tw fa fa-twitter"></i><input type="text" name="twitter" id="twitter" size="40" maxlength="100" placeholder="@colconstruccion"></li>';
            redesSociales += '<li><i class="rounded-x fa fa-facebook"></i><input type="text" name="facebook" id="facebook" size="40" maxlength="100" placeholder="colconstruccion"></li>';
            redesSociales += '<li><i class="rounded-x fa fa-linkedin"></i><input type="text" name="linkedin" id="linkedin" size="40" maxlength="100" placeholder="colconstruccion"></li>';
            redesSociales += '<li><i class="rounded-x fa fa-external-link"></i><input type="text" placeholder="http://arquiplac.co" name="paginaweb" id="paginaweb" size="40" maxlength="100" placeholder="colconstruccion.com"></li>';
            redesSociales += '<li><i class="rounded-x fa fa-envelope"></i><input type="text" name="email" id="email" size="40" maxlength="100" placeholder="publicidad@colconstruccion.com"></li>';
            redesSociales += '<button class="btn-u btn-u-green" id="actualizarRedes">Actualizar</button>';
            $('#formRedesSociales').html(redesSociales);
            return false;
        });//end click
        //modificar info de contacto de la empresa
         //actualizarContacto esta en este mismo archivo en la linea 105
        $('#editarInfoContacto').click(function(){
            //conseguir la info que ya esta en el formulario
            var empcontacto = $('#empcontacto').html();
            var emptelefono = $('#emptelefono').html();
            var empdirecion = $('#empdirecion').html();
            var empciudad = $('#empciudad').html();
            var empwhatsapp = $('#empwhatsapp').html();
            var empdepartamento = $('#empdepartamento').html();
            //poner la informacion en el formulario a editar
            var infoContacto = '<li><i class="rounded-x tw fa fa-user"></i><input type="text" name="contacto" id="contacto" size="40" maxlength="100" value="'+empcontacto+'"></li>';
            infoContacto += '<li><i class="rounded-x fa fa-phone"></i><input type="text" name="telefono" id="telefono" size="40" maxlength="20" value="'+emptelefono+'"></li>';
            infoContacto += '<li><i class="rounded-x fa fa-whatsapp"></i><input type="text" name="whatsapp" id="whatsapp" size="40" maxlength="20" value="'+empwhatsapp+'"></li>';
            infoContacto += '<li><i class="fa fa-map-marker"></i><input type="text" name="departamento" id="departamento" size="40" maxlength="100" value="'+empdirecion+'"></li>';
            infoContacto += '<li><i class="rounded-x fa fa-globe"></i><input type="text" name="ciudad" id="ciudad" size="40" maxlength="100" value="'+empciudad+'"></li>';
            infoContacto += '<li><i class="fa fa-map-marker"></i><input type="text" name="direcion" id="direcion" size="40" maxlength="100" value="'+empdirecion+'"></li>';
            infoContacto += '<button href="#" class="btn-u btn-u-default" id="actualizarContacto">Actualizar</button>';
            $('#formInfoContacto').html(infoContacto);
            return false;
        });//end click
       
        //modificar info de mision y servicio de la empresa
        //de aqui va a linea 607
        $('#editarInfoEmpresa').click(function(){
            $('#newCategory').removeClass('esconder');
            var currentMision = $('#formMision').html();
            var currentServicio = $('#formServicio').html();
            var infoMisionyVision = '<section><label class="label">Mision y Vision</label><label class="textarea"><i class="icon-append fa fa-comment"></i><textarea rows="4" cols="40" name="mision" id="mision">'+currentMision+'</textarea></label></section>';
            var infoServicio = '<section><label class="label">Descripcion de servicios o productos</label><label class="textarea"><i class="icon-append fa fa-comment"></i><textarea rows="4" cols="40" name="servicio" id="servicio">'+currentServicio+'</textarea></label></section>';
            $('#formServicio').html(infoServicio);
            $('#formMision').html(infoMisionyVision);
            $('#formMision').after('<div class="col-md-12"><button class="button" type="submit">Actualizar</button></div>');     
            CKEDITOR.replace( 'servicio' );
            CKEDITOR.replace( 'mision' );
        }); //end click 

    });//end ready
    
    //function que actualiza las redes sociales
    $(document).on('click','#actualizarRedes',function(){
        var twitter = $('#twitter').val();
        var facebook = $('#facebook').val();
        var linkedin = $('#linkedin').val();
        var paginaweb = $('#paginaweb').val();
        var webRegex = /((\bwww\.))\S*/;
        var testWeb = paginaweb.match(webRegex);
        var email = $('#email').val();
        var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/;
        var testEmail = email.match(emailRegex);

        if(! testEmail){
            alert('Ponga un correo electronico valido');
            return false;
        }else if(! testWeb){
            $('#confirmacion').html('Ponga una pagina web correcta, copiela y peguela del navegador');
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
        var whatsapp = $('#whatsapp').val();
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
                wassap: whatsapp,
                content: 'editarContacto'
            };
            //mostrar informacion actualizada
            //Mostrar la informacion subida
            //la funcion editarContacto esta en la linea 526 de usuarios.php
            var infoEmpresa = '<li><i class="rounded-x fa fa-user"></i>'+contacto+'</li>';
            infoEmpresa += '<li><i class="rounded-x fa fa-phone"></i>'+telefono+'</li>';
            infoEmpresa += '<li><i class="rounded-x fa fa-whatsapp"></i>'+whatsapp+'</li>';
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
    $(document).on('submit','#actualizarMision',function(){
        var empresaid = $('#empresaid').val();
        var mision = $('#mision').val();
        var servicio = $('#servicio').val();
        var catid = $('#nuevaCategoria').val();
        var misionRegex = /[\w]/;
        var testMision = mision.match(misionRegex);
        var testServicio = servicio.match(misionRegex);
        if (! testMision){
            alert('Formatee correctamente su mision y vision');
            alert(mision);
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
            $('#fichaEmpresa').after('<div class="col-md-12"><p id="esteServicio">'+servicio+'</p></div><div class="col-md-12"><p id="estaMision">' +mision+'</p></div>');
        
            //alert(empresaid);
            $.post('usuarios.php',misionData,function(data){
                var newMensaje;
                if(data = 'exito'){
                    newMensaje = '<div class="col-md-12"><i class="rounded-x fa fa-check"></i>';
                    newMensaje += '<p>Se ha incorporado la nueva mision, vision y descripcion</p></div>';
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