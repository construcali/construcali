
/*
este codigo se usa en la pagina de empresas empresas.inc.php
para cargar mas empresas cuando se baja en la pagina de empresas.inc.php a su final
Esta unido al final de la pagina de empresas.php
*/  

var contenedor = $('#empresas');

var cargando_empresas = false;

function pegaraDiv(container,new_html){
    container.append(new_html);

}

function setearPaginaActual($page){
    console.log($page);
    $('#masEmpresas').attr('data-pagina',$page);
}

function desplazarReacion(){
    var contenedor_altura = contenedor.outerHeight();
    var actual_y = window.innerHeight + window.pageYOffset;
    console.log(actual_y + '/' + contenedor_altura);
    if(actual_y >= contenedor_altura){
        masEmpresas();
    }
}

function masEmpresas(){

    if (cargando_empresas){ return; }
    cargando_empresas = true;

    $('#spinner').show();
    $('#masEmpresasBoton').hide();

    var pagina = parseInt($('#masEmpresas').attr('data-pagina'));
    var proxima_pagina = pagina + 1;

    //console.log('Di click en masAnuncios');   

    $.get('ajaxphp/masempresas.php','page='+ proxima_pagina, function(data){
        console.log(data);
        // cambiar el numero de la pagina
        setearPaginaActual(proxima_pagina);
        // pegar los resultados a el ultimo resultado de la pagina
        pegaraDiv(contenedor,data);
        $('#spinner').hide();
        cargando_empresas = false;
    });

}

$('#masEmpresas').click(masEmpresas);

// empezar la funcion cuando se baje al final de la pagina
window.onscroll = function(){
    desplazarReacion();
}

