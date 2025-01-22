/*
JavasScript para registrar una empresa 
se usa en la pagina de newcompanyinc.php
y en nuevaempresa.inc.php
este escript esta unido en la pagina footer.html, linea 329
*/

 $(document).ready(function(){ 

 	//Registrar empresa cuando la persona ha entrado como usuario o usuaria - newcompany.inc.php
 	$('#registrarEmpresa').submit(function(){
            var empresa = $('#empresa').val();
            var nombre = $('#nombre').val();
            var email = $('#email').val();
            var telefono = $('#telefono').val();
            var ciudad = $('#ciudad').val();
            var productos = $('#servicio').val();
            var mision = $('#mision').val();
            var conRegex = /[\w]/;
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+[-A-z0-9]+\.)+[A-z]{2,4}/;
            //var telRegex = /\(?(\d{3})\)?[ -.](\d{3})[ -.](\d{4})/;
            //var testTel = telefono.match(telRegex);
            var testContacto = nombre.match(conRegex);
            var testCiudad = ciudad.match(conRegex);            
            var testEmail = email.match(emailRegex);
            // revision de valores
            if(! testContacto){
                $('#nombre').after('Por favor ponga el nombre del contacto en la empresa');
                return false;
            }else if(phone.length < 1 || phone.length > 12){
                $('#telefono').after('Escriba su telefono asi: 123 456 7899 o asi 123-456-7899');
                return false;
            }else if(! testEmail){
                $('#email').after('Por favor ponga su correo electronico correcto');
                return false;
            }else if (! testCiudad){
                $('#ciudad').after('Por favor ponga la ciudad donde se ubica la empresa');
                return false;
            }else if(empresa.length == 0){
                $('#empresa').after('Por favor ponga el nombre de su Empresa');
                return false;
            }else if(productos.length < 50){
                console.log(productos);
                $('#errorServicios').html('Porfavor ponga por lo menos 50 caracteres, ha puesto '+productos.length+' caracteres');
                return false;
            }else if(productos.length >2000){
                console.log(productos);
                $('#errorServicios').html('Porfavor use maximo 2000 caracteres, gracias, ha puesto '+productos.length+' caracteres');
                return false;
            }else if(mision.length > 2000){
                console.log(mision);
                $('#errorMision').html('Por favor utilize menos de 2000 caracteres, ha puesto '+mision.length+' caracteres');
                return false;
            }
        });

        //registrar empresa desde formulario donde la persona no ha entrado como usuario o usuaria - nuevaempresa.inc.php
        $('#nuevaEmpresa').submit(function(){
            var empresa = $('#empresa').val();
            var nombre = $('#nombre').val();
            var email = $('#email').val();
            var telefono = $('#telefono').val();
            var ciudad = $('#ciudad').val();
            var servicio = $('#servicio').val();
            var mision = $('#mision').val();
            var conRegex = /[\w]/;
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+[-A-z0-9]+\.)+[A-z]{2,4}/;
            //var telRegex = /\(?(\d{3})\)?[ -.](\d{3})[ -.](\d{4})/;
            //var testTel = telefono.match(telRegex);
            var testContacto = nombre.match(conRegex);
            var testCiudad = ciudad.match(conRegex);            
            var testEmail = email.match(emailRegex);

            if(! testContacto){
                $('#nombre').after('Por favor ponga el nombre del contacto en la empresa');
                return false;
            }else if(phone.length < 1 || phone.length > 12){
                var telefonoNuevo = telefono.split('');
                telefonoNuevo.splice(2,0,' ');
                telefonoNuevo.splice(7,0,' ');
                telefonoNuevo.join('');
                $('#telefono').val(telefonoNuevo);
                $('#telefono').after('Escriba su telefono asi: 123 456 7899');
                return false;
            }else if(! testEmail){
                $('#email').after('Por favor ponga su correo electronico correcto');
                return false;
            }else if (! testCiudad){
                $('#ciudad').after('Por favor ponga la ciudad donde se ubica la empresa');
                return false;
            }else if(empresa.length == 0){
                $('#empresa').after('Por favor ponga el nombre de su Empresa');
                return false;
            }else if(servicio.length < 50 || servicio.length > 2000){
                console.log(servicio);
                $('#errorServicios').html('Porfavor use entre 50 y 2000 caracteres, gracias, ha puesto '+servicio.length+' caracteres');
                return false;
            }else if(mision.length < 50 || mision.length > 2000){
                console.log(mision);
                $('#errorMision').html('Por favor utilize entre 50 y 2000 caracteres, ha puesto '+mision.length+' caracteres');
                return false;
            }
        }); 

        // codigo para contar los caracteres en el textarea de servicios y mision
         function contarCaracteres(){
            let textoEscrito = $('#servicio').val();
            //console.log(textoEscrito);
            if (textoEscrito.length <= 100){
                   $('#errorServicios').html('<h5 style="color:red">Por favor escriba un texto de mas de 100 caracteres. ('+ textoEscrito.length +' caracteres)</h5>' );
                 
            }else if (textoEscrito.length > 100){
                
                $('#errorServicios').html('<h5>Por favor, escriba menos de 500 caracteres, ('+ textoEscrito.length +' caracteres)</h5>');
                
            }
        }
        $('#servicio').keyup(contarCaracteres);

         function contarLetras(){
            let textoEscrito = $('#mision').val();
            //console.log(textoEscrito);
            if (textoEscrito.length <= 100){
                   $('#errorMision').html('<h5 style="color:red">Por favor escriba un texto de mas de 100 caracteres. ('+ textoEscrito.length +' caracteres)</h5>' );
                 
            }else if (textoEscrito.length > 100){
                
                $('#errorMision').html('<h5>Por favor, escriba menos de 500 caracteres, ('+ textoEscrito.length +' caracteres)</h5>');
                
            }
        }
        $('#mision').keyup(contarLetras);		
 });//end ready