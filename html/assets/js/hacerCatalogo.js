// este js usa el plugin de ajaxSubmit que esta unido en la linea 186 del footer.html como jquery.form.min.js 

$(document).ready(function(){

	var options = {
		target: '#esteCatalogo',
		beforeSubmit: beforeSubmit,
		success: afterSuccess,
		resetForm: true
	};

	$('#nuevaFotoCatalogo').submit(function(){
		var descripcion = $('#descripcion').val();
		var empresaid = $('#empresaid').val();
		if(descripcion.length < 2 || descripcion.length > 50){
			$('#descripcion').after('Ponga un titulo eficaz');
			return false;
		}else if(empresaid == 0 || empresaid == ' '){
			$('#empresaid').after('Porfavor refresque la pagina e intentelo de nuevo');
			return false;
		}else
		{
		$(this).ajaxSubmit(options);
		return false;
		}
	});//end submit	

	//Este es para editar las fotos dando click en el catalogo
	$('#fotos a').live("click",function(){
		var url = $(this).attr('href');
		$('#catalogo').load(url);
		return false;
	});//end click


	//este es para borrar las fotos
	$('#borrarFoto').live("click",function(){
		
		//var formData = $(this).serialize();
		var id = $('#photoid').val();
		var companyid = $('#factoryid').val();
		var borrar = $('#borrarFoto').val();
		
		var data ={
			fotoid2: id,
			empresaid2: companyid,
			boton: borrar
		};
		
		$.post('actualizarfoto.php',data,function(data){
			
			$("#esteCatalogo").html('<h3>'+data+'</h3>');
			$('#catalogo').load('fotossubidas.php');
			
		});
		
		$('#borrarFoto').attr('disabled',true);
		$('#borrarFoto').addClass('btn-u-default');
		
		return false;//stop the submit	
	});//end submit

	var opciones = {
	target: '#esteCatalogo',
	beforeSubmit: antesSubmit,
	success: despuesSuccess
	};

	$('#cambiarfoto').live("submit",function(){
		var descripcion3 = $('#descripcion3').val();
		if(descripcion3.length < 5 || descripcion3.length > 50){
			alert('Ponga un titulo eficaz');
			return false;
		}else
		{
		$(this).ajaxSubmit(opciones);
		return false;
		}	
	});
});//end ready


function beforeSubmit()
{
	  //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#foto').val()) //check empty input filed
		{
			$("#esteCatalogo").html("Por favor suba una foto");
			return false
		}
		
		var fsize = $('#foto')[0].files[0].size; //get file size
		var ftype = $('#foto')[0].files[0].type; // get file type
		

		//allow only valid image file types 
		switch(ftype)
        {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
            default:
                $("#esteCatalogo").html("<b>"+ftype+"</b> Tipo de documento sin apoyo!");
				return false
        }
		
		//Allowed file size is less than 1 MB (1048576)
		if(fsize>1048576) 
		{
			$("#esteCatalogo").html("<b>"+bytesToSize(fsize) +"</b> El archivo de la imagen es muy grande! <br />Porfavor reduzca el tamano de la imagen usando un editor de imagenes.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //showing loading button
		$("#esteCatalogo").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#esteCatalogo").html("Porfavor actualize su navegador, porque a su actual navegador le faltan algunas herramientas que necesitamos!");
		return false;
	}
}

function afterSuccess(){
	$("#esteCatalogo").html('<h3 style="margin-bottom:1em">Su foto ha subido, gracias</h3>');
	$('#submit-btn').show(); //show submit button
	$('#loading-img').hide(); //hide loading button
	$('#catalogo').load('fotossubidas.php');
}

function antesSubmit(){
	$('#cargando-img').show(); //showing loading button
	//$("#esteCatalogo").html(""); comentado 11/19/23
}

function despuesSuccess(){
	$("#esteCatalogo").html('<h3 style="margin-bottom:1em">Ha actualizado la foto de su catalogo, gracias</h3>');
	$('#catalogo').load('fotossubidas.php');
	$('#cargando-img').hide();
}