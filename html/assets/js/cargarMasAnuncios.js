
/*
este codigo se usa en la pagina de clasificados clacontenido.inc.php
para cargar mas clasificados cuando se baja en la pagina de clasificados a su final
Esta unido al final de la pagina de anuncios.php
*/  

var contenedor = $('#clasificados');

var cargando_anuncios = false;

function pegaraDiv(container,new_html){
    container.append(new_html);

}

function setearPaginaActual($page){
    console.log($page);
    $('#masAnuncios').attr('data-pagina',$page);
}

function desplazarReacion(){
    var contenedor_altura = contenedor.outerHeight();
    var actual_y = window.innerHeight + window.pageYOffset;
    console.log(actual_y + '/' + contenedor_altura);
    if(actual_y >= contenedor_altura){
        masAnuncios();
    }
}

function masAnuncios(){

    if (cargando_anuncios){ return; }
    cargando_anuncios = true;

    $('#spinner').show();
    $('#masAnuncios').hide();

    var pagina = parseInt($('#masAnuncios').attr('data-pagina'));
    var proxima_pagina = pagina + 1;

    //console.log('Di click en masAnuncios');   

    $.get('ajaxphp/masanuncios.php','page='+ proxima_pagina, function(data){
        console.log(data);
        // cambiar el numero de la pagina
        setearPaginaActual(proxima_pagina);
        // pegar los resultados a el ultimo resultado de la pagina
        pegaraDiv(contenedor,data);
        $('#spinner').hide();
        cargando_anuncios = false;
    });

}

$('#masAnuncios').click(masAnuncios);

// empezar la funcion cuando se baje al final de la pagina
window.onscroll = function(){
    desplazarReacion();
}

