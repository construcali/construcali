
/*
este codigo se usa en la pagina de productos catalogacion.inc.php
para cargar mas clasificados cuando se baja en la pagina de productos a su final
Esta unido al final de la pagina de catalogos.php
*/  

var contenedor = $('#catalogos');

var cargando_productos = false;

function pegaraDiv(container,new_html){
        //var items = $(new_html+' .cbp-item');
        //console.log(items.length);
        container.append(new_html);
        //container.after(new_html);
}

function setearPaginaActual($page){
    console.log($page);
    $('#masProductos').attr('data-pagina',$page);
}

function desplazarReacion(){
    var contenedor_altura = contenedor.outerHeight();
    var actual_y = window.innerHeight + window.pageYOffset;
    console.log(actual_y + '/' + contenedor_altura);
    if(actual_y >= contenedor_altura){
        masProductos();
    }
}

function masProductos(){

    if (cargando_productos){ return; }
    cargando_productos = true;

    $('#spinner').show();
    $('#masProductos').hide();

    var pagina = parseInt($('#masProductos').attr('data-pagina'));
    var proxima_pagina = pagina + 1;

    //console.log('Di click en masProductos');   

    $.get('productos.php','page='+ proxima_pagina, function(data){
        console.log(data);
        // cambiar el numero de la pagina
        setearPaginaActual(proxima_pagina);
        // pegar los resultados a el ultimo resultado de la pagina
        pegaraDiv(contenedor,data);
        $('#spinner').hide();
        cargando_productos = false;
    });

}

$('#masProductos').click(masProductos);


// empezar la funcion cuando se baje al final de la pagina
window.onscroll = function(){
   desplazarReacion();
}

