
/*
este codigo se usa en la pagina de uusarios con empresa tablero.inc.php
para cargar mas boletines de la tabla de foros cuando se baja en la pagina de tablero.inc.php a su final
Esta unido al final de la pagina de usuarios.php
Esta unido al final de la pagina de inicio.php 
*/  

var contenedor = $('#boletines');

var cargando_anuncios = false;

function pegaraDiv(container,new_html){
    container.append(new_html);

}

function setearPaginaActual($page){
    console.log($page);
    $('#masBoletines').attr('data-pagina',$page);
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
    $('#masBoletines').hide();

    var pagina = parseInt($('#masBoletines').attr('data-pagina'));
    var proxima_pagina = pagina + 1;

    //console.log('Di click en masAnuncios');   

    $.get('ajaxphp/cargarboletines.php','page='+ proxima_pagina, function(data){
        console.log(data);
        // cambiar el numero de la pagina
        setearPaginaActual(proxima_pagina);
        // pegar los resultados a el ultimo resultado de la pagina
        pegaraDiv(contenedor,data);
        $('#spinner').hide();
        cargando_anuncios = false;
    });

}

$('#masBoletines').click(masAnuncios);

// empezar la funcion cuando se baje al final de la pagina
window.onscroll = function(){
    desplazarReacion();
}

