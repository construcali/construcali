// este javscript se usa en vistas/analisis.inc.php
// este javascrip se usa en vistas/analisis/precios.inc.php

$(document).ready(function(){
    function buscarArticulos(){
        var articuloBuscado = $('#articulo').val();
        if (articuloBuscado.length < 1){
        $('#buscarArticulos').before('<h3>Ponga un articulo para buscar</h3>');
        return false;
        }else{
            //coger los valores
            var formData = $('#buscarArticulos').serialize();
            // apredi que buscararticulos.php no puede tener comentarios, se tira la informacion
            // que envia de vuelta
            $.post('buscararticulos.php',formData,mostrarResultados);

            function mostrarResultados(data, status){
                if (status == 'success'){
                    $('#categoriasMateriales').removeClass('active');
                    $('#categoriasPrecios').removeClass('active');
                    
                    $('#menuResultados').show();
                    $('#resultados').show();
                    $('#menuMateriales').removeClass('active');
                    $('#home').removeClass('active');

                    $('#menuResultados').addClass('active');
                    $('#resultados').addClass('active');
                    $('#resultados').html('<div>'+data+'</div>');
                    //console.log('esta es la data.:'+data);
                    //convertir data a JSON, JSON.parse
                    var material = JSON.parse(data);
                     //crear una variable vacia
                    var infoHTML = ''
                    //coger cada array
                    $.each(material,function(insumo,insumoInfo){
                        var printPrecio = accounting.formatNumber(insumoInfo.precio);
                        printPrecio = '$'+ printPrecio;
                        infoHTML += '<tr><td>NOMBRE</td><td>U.M.</td><td>PRECIO</td><td>LISTA</td></tr>';
                        infoHTML += '<td id="nombre'+ insumoInfo.insumoid +'">'+ insumoInfo.nombre +'</td>';
                        infoHTML += '<td id="unidad'+ insumoInfo.insumoid +'">' + insumoInfo.unidad +'</td>';
                        infoHTML += '<td id="precio' + insumoInfo.insumoid +'">' + printPrecio +'</td>';
                        infoHTML += '<td id="incluir' + insumoInfo.insumoid +'"><button class="btn-u insumoClass" id="'+ insumoInfo.insumoid +'"><i class="fa fa-list"></i> Incluir</button></td></tr>';
                        //console.log('esta es el insumoid.:'+insumoInfo.insumoid);
                        //console.log('este es el nombre otra vez.:'+insumoInfo.nombre);
                    }); //end of each
                
                    // poner el HTML en #resultados
                    $('#resultados').html('<table class="table table-striped invoice-table">'+infoHTML+'</table>');
                   
                    
                }else{
                    $('#buscarArticulos').before('<h3>No hubo respuesta del servidor</h3>');
                }
            }
        }
    } // cierra la funcion buscarArticulos
    $('#buscoArticulos').click(buscarArticulos);
    
    // si el formulario es enviado, submitted
    $('#buscarArticulos').submit(function(){
        var articuloBuscado = $('#articulo').val();
        if (articuloBuscado.length < 1){
        $('#buscarArticulos').before('<h3>Ponga el articulo o material que requiere </h3>');
        return false;
        }else{
            //coger los valores
            var formData = $('#buscarArticulos').serialize();
            // apredi que buscararticulos.php no puede tener comentarios, se tira la informacion
            // que envia de vuelta
            $.post('buscararticulos.php',formData,mostrarMateriales);
             //ya que es un submit
            return false;
            function mostrarMateriales(data, status){
                if (status == 'success'){
                    $('#menuResultados').show();
                    $('#resultados').show();
                    $('#menuMateriales').removeClass('active');
                    $('#home').removeClass('active');
                    $('#menuResultados').addClass('active');
                    $('#resultados').addClass('active');
                    $('#resultados').html('<div>'+data+'</div>');
                    //console.log('esta es la data.:'+data);
                    //convertir data a JSON, JSON.parse
                    var material = JSON.parse(data);
                     //crear una variable vacia
                    var infoHTML = ''
                    //coger cada array
                    $.each(material,function(insumo,insumoInfo){
                        var printPrecio = accounting.formatNumber(insumoInfo.precio);
                        printPrecio = '$'+ printPrecio;
                        infoHTML += '<tr><td>NOMBRE</td><td>U.M.</td><td>PRECIO</td><td>LISTA</td></tr>';
                        infoHTML += '<td id="nombre'+ insumoInfo.insumoid +'">'+ insumoInfo.nombre +'</td>';
                        infoHTML += '<td id="unidad'+ insumoInfo.insumoid +'">' + insumoInfo.unidad +'</td>';
                        infoHTML += '<td id="precio' + insumoInfo.insumoid +'">' + printPrecio +'</td>';
                        infoHTML += '<td id="incluir' + insumoInfo.insumoid +'"><button class="btn-u insumoClass" id="'+ insumoInfo.insumoid +'"><i class="fa fa-list"></i> Incluir</button></td></tr>';
                        //console.log('esta es el insumoid.:'+insumoInfo.insumoid);
                        //console.log('este es el nombre otra vez.:'+insumoInfo.nombre);
                    }); //end of each
                
                    // poner el HTML en #resultados
                    $('#resultados').html('<table class="table table-striped invoice-table">'+infoHTML+'</table>');
                }else{
                    $('#buscarArticulos').before('<h3>No hubo respuesta del servidor</h3>');
                }
            }
        } // termina el else
    }); // termina funcion anonima   
});//end ready