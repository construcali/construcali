// js para las autosugerencias de las empresas
// que se muestran en la pagina empresas.inc.php
// sugerencias.js esta unido en el footer.html, linea 216
// sugerencias.js tambien esta unido en home_footer.html, linea 140

$(document).ready(function(){

// autosugerancias para empresas.php

	function listadeSugerencias(items){
		var nuevoHtml = '';

		for (i=0; i<items.length; i++){
			// <li><a href="empresas.php?content=estaempresa&id=$empresaid">Alpha</a></li>
			nuevoHtml += '<li>';
			nuevoHtml += '<a href="empresas.php?content=estaempresa&id='+items[i].empresaid+'" class="btn-u-green">';
			nuevoHtml += items[i].empresa;
			nuevoHtml += '</a>';
			nuevoHtml += '</li>'; 
		}

		return nuevoHtml;
	}

	function mostrarSugerencias(resultados){
		
		var lista_li = listadeSugerencias(resultados);
		//console.log(lista_li);
		$('#suggestions').html(lista_li);
		$('#suggestions').css('display','block');
	}

	function sugerencias(){
		var q = $('#palabraClave').val();
		// si son menos de 3 caracteres, no hacer nada
		if (q.length < 3){
			//console.log(q);
			$('#suggestions').hide();
			return;
		}
		$.get('sugerencias.php','terminos='+q,function(data){
			var resultados = JSON.parse(data);
			mostrarSugerencias(resultados);
			
		});
	}
		$('#palabraClave').keyup(sugerencias);

		// Autosugerencias de productos en la pagina de catalogacion.inc.php con el controlador catalogos.php
		function listadeProductos(items){
			var nuevoHtml = '';
			// catalogos.php?content=esteproducto&fotoid=1136
			for (i=0; i<items.length; i++){
				if (items[i].descripcion == null){
					console.log('descripcion es null');
				}else{
					// <li><a href="empresas.php?content=estaempresa&id=$empresaid">Alpha</a></li>
					nuevoHtml += '<li>';
					nuevoHtml += '<a href="catalogos.php?content=esteproducto&fotoid='+items[i].fotoid+'">';
					nuevoHtml += items[i].descripcion;
					nuevoHtml += '</a>';
					nuevoHtml += '</li>';
				} 
			}

			return nuevoHtml;

		}

		function mostrarProductos(resultados){
			var lista_li = listadeProductos(resultados);
			console.log(lista_li);
			$('#suggestions').html(lista_li);
			$('#suggestions').css('display','block');
		}

		function sugerirproductos(){
			var q = $('#productoBuscado').val();
			if (q.length < 3){
				//console.log(q);
				$('#suggestions').hide();
				return;
			}
			$.get('sugerirproductos.php','terminos='+q,function(data){
				var resultados = JSON.parse(data);
				mostrarProductos(resultados);
			});
		}
		$('#productoBuscado').keyup(sugerirproductos);


		// Autosugerencias de clasificados  en la pagina de clacontenido.inc.php con el controlador anuncios.php
		// autosugerencias de clasificados tambien en la pagina de home_main.inc.php
		function listadeAnuncios(items){
			var nuevoHtml = '';
			// catalogos.php?content=esteproducto&fotoid=1136
			for (i=0; i<items.length; i++){
				if (items[i].titulo == null){
					console.log('el titulo es null');
				}else{
					// anuncios.php?content=unproducto&id=418
					nuevoHtml += '<li>';
					nuevoHtml += '<a href="anuncios.php?content=unproducto&id='+items[i].productoid+'">';
					nuevoHtml += items[i].titulo;
					nuevoHtml += '</a>';
					nuevoHtml += '</li>';
				} 
			}

			return nuevoHtml;

		}

		function mostrarAnuncios(resultados){
			var lista_li = listadeAnuncios(resultados);
			console.log(lista_li);
			$('#suggestions').html(lista_li);
			$('#suggestions').css('display','block');
		}

		function sugerirAnuncios(){
			var q = $('#anuncioBuscado').val();
			if (q.length < 3){
				//console.log(q);
				$('#suggestions').hide();
				return;
			}
			$.get('sugeriranuncios.php','terminos='+q,function(data){
				var resultados = JSON.parse(data);
				mostrarAnuncios(resultados);
			});
		}
		$('#anuncioBuscado').keyup(sugerirAnuncios);

});