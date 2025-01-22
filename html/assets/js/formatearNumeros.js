/* Javascript accounting.js esta en la linea 148 para formatear numeros, y
javascript formatearNumero.js esta la linea 195 del footer.html
 */
$(document).ready(function(){
    // cuando cambie el formualario de la nueva foto
    $('#nuevaFotoCatalogo').change(function(){
        var numero = $('#precio').val();
        numero = parseInt(numero);
        if (isNaN(numero)){
            numero = 0;
        }
        var numeroFormateado =  accounting.formatMoney(numero);
        $('#precio').val(numeroFormateado);
        console.log(numeroFormateado);
        console.log(numero);
        alert(costo);
        // escribir una linea con el precio sin formatear
        $('#nuevaFotoCatalogo').append('<input type="hidden" name="costo" value="'+numero+'">');
    });
});