/* Javascript para calificar con estrellas a una empresa
esta unida en el footer en la linea 219
mirar ejemplo de responderAnuncio.js para hacer este ajax 
*/
 $(document).ready(function(){
    $('.strella').click(function(){
      var estrellaId = $(this).attr('id');
      var calificacion = estrellaId.slice(-1);
        console.log('la id de esta estrella es ' + estrellaId);
        // selescionamos cada estrella con la clase star
        $('.strella').each(function(){
          var estaId = $(this).attr('id');
          var j = estaId.slice(-1);
          if (j <= calificacion){
             $('#star'+j).html('&#9733');
             console.log('esta es la estrella ' + j );
          }else{
             $('#star'+j).html('&#9734');
             console.log('esta es la estrella ' + j );
          }
        });
    });

    //revisar el formulario de evaluar una empresa en nuevarecomendacion.inc.php
    $('#calificarEmpresa').submit(function(){
        var respondonid = $('#respondonid').val();
        var factoryid = $('#empresaid').val();
        var empresa = $('#empresa').val();
        var mensaje = $('#recomendacion').val();
    
        if (mensaje.length < 20){
            $('#aviso').remove();
            $(this).before('<div id="aviso">Por favor envie un mensaje mas completo</div>');
            return false;
        }
        //revisar si la persona ha entrado como usuaria
        if (respondonid == null || respondonid == undefined || respondonid.length == 0){
                $(this).before('Debe entrar como usuari@ para poder calificar una empresa');
                return false;   
            }
    });
}); //end ready