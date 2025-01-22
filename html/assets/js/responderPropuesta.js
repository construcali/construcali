$(document).ready(function(){
        $('.respuestaCotizacion a').click(function(){
            var laxo = $(this).attr('href');
            var id = $(this).attr('id');
            $('#contestada'+id).show('slow');
            $('#contestada'+id).load(laxo);
            return false;
        });//end click
        
        $('.respuestaMateriales a').click(function(){
            var link = $(this).attr('href');
            var id = $(this).attr('id');
            $('#contestacion'+id).load(link);
            return false;
        });//end click
        
        $('.respuestaLista a').click(function(){
            var enlace = $(this).attr('href');
            var id  = $(this).attr('id');
            $('#lista'+id).load(enlace);
            return false;
        });//end click
        
        $('#responder a').click(function(){
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