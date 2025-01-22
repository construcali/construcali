// script para validar la entrada a construcali.com
// se usa en login.inc.php
// esta unido en la linea

$(document).ready(function(){
        $('#sky-form2').submit(function(){
            var email = $('#email2').val();
            var password = $('#password2').val();
            var emailRegex = /[-\w.]+@([A-z0-9][-A-z0-9]+[-A-z0-9]+\.)+[A-z]{2,4}/;
            var testEmail = email.match(emailRegex);
            if(! testEmail){
                $('#email1').prepend('<h3>Ponga un correo electronico valido</h3>');
                return false;
            }else if(password.length < 1){
                $('#password1').prepend('<h3>Porfavor ponga una clave valida</h3>');
                return false;
            }
        });//end submit  
    });//end ready