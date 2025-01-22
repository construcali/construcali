/* Javascript para redirigir el enlace cuando da click en presupuesto
se usaba cuando el codigo de presupuesto estaba escrito usando codeigniter y 
guardado en la carpate de analisis
*/
 $(document).ready(function(){
    $('#presupuestoCode a').click(function(){
        var href = $(this).attr('href');
        var asociadoid = $(this).attr('id');
        var url = href+'/'+asociadoid;
        $(location).attr('href',url);
        return false;
    }); //end click
}); //end ready