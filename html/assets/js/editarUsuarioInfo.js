 /*
* JavaScript para editar la informacion del usuario
* JavaScript usado en la pagina de ajustes.inc.php
* este script es unido en el footer.html linea 198
* Usa los documentos cambiarinfo.php y fotoperfil.php para la parte del servidor
* CKEditor esta unido en header.php
*/
 $(document).ready(function(){
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
            //alert(provincia);
            //alert(city);
            if(! testContacto){
                alert('Ponga su nombre bien porfavor');
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
                alert('Ponga un numero telefonico con el formato 123 345 6789');
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
                        $('#infoCambiar').prepend('<h4>Se ha cambiado su informacion</h4>');
                        $('#cambiarInfo :input').attr('disabled',true);
                    }else{
                        $('#infoCambiar').prepend('<h4>No se ha podid0 actualizar su informacion');
                    }

                });
                return false;
            }
        });//end submit

        //funcion para cambiar o subir la foto de perfi

        var options = {
           //target: '#estaFotoPerfil',
            beforeSubmit: beforeSubmit,
            success: despuesSubmit,
            resetForm: true
        };

        $('#editarFotoPerfil').submit(function(){
            console.log('la respuesta del servidor va al target');
            $(this).ajaxSubmit(options);
            return false;
        });//end submit 

        // funcion para borrar la foto
        //este es para borrar las fotos
    $('#borrarFotoPerfil').click(function(){
        
        //var formData = $(this).serialize();
        var id = $('#usuarioid').val();
        
        var data ={
            usuarioid: id,
            boton: 'borrarFotoDePerfil'
        };
        
        $.post('subirfotoperfil.php',data,function(data){
            
            $("#estaFotoPerfil").html('<h3>'+data+'</h3>');
            $('#fotoDePerfil').attr('src','assets/img/team/img1-md.jpg');
            
        });
        
        $('#borrarFotoPerfil').attr('disabled',true);
        $('#borrarFotoPerfil').addClass('btn-u-default');
        
        return false;//stop the submit  
    }); //end click
        //termina funcion para borrar la foto
        // script para revisar informacion de nuevo usuario
        $('#nuevoUsuarioInfo').submit(function(){
           var nombre = $('#nombre').val();
           var apellido = $('#apellido').val();
           var email = $('#email').val();
           var password = $('#password').val();
           //var password1 = $('#password1').val();
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
            else if(! testContacto){
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
        // se termina escript para revisar la informacion de nuevo usuario
        // empieza script de cambiar clave
         $('#cambiarClave').submit(function(){
            //alert('Hola');
            var nuevaClave = $('#password').val();
            var repetidaClave = $('#repetida').val();
            if (nuevaClave.indexOf(' ') != -1){
                alert('Ponga una clave sin espacios');
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
                    password1: repetidaClave
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
        // termina script de cambiar clave
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
 });
        
       
        function beforeSubmit()
        {
           $('#cargando-img').show();
           $('#submit-Foto').hide();
           $('#borrarFotoPerfil').hide();
        }

        function despuesSubmit(){
            $('#estaFotoPerfil').before('<h3>Se ha editado su foto de perfil</h2>');
            $('#cargando-img').hide();
            $('#fotoDePerfil').hide();
            $('#estaFotoPerfil').load('vistas/usuarios/fotodeperfil.php');
        }
        