// script para validar los datos de la pagina profesional.inc.php
// se usa en profesional.inc.php
// hay que unirlo en footer.html, todavia no se ha unido

$(document).ready(function(){
         //empezar otro submit, paginas.: panelusuario.inc.php
        $('#profesional').submit(function(){
            var title = $('#titulo').val();
           
            $('#botonPublicarPerfil').attr('disabled', true);
            if(title.length < 5){
                $('#titulo').after('Por favor ponga un titulo mas descriptivo');
                $('#botonPublicarPerfil').attr('disabled', false);
                return false;
            }else if(title.length > 50){
                $('#titulo').after('Por favor ponga un titulo mas concreto');
                $('#botonPublicarPerfil').attr('disabled', false);
                return false;
            }
        });//end submit
    });//end ready