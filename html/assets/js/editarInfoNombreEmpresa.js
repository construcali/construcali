//cambiar el nombre de la empresa
$(document).ready(function(){
	$('#editarInfoNombreEmpresa').click(function(){
		var nombreEmpresa = $('#nombreEmpresa').html();
		var infoNombreEmpresa = '<input type="text" name="nuevoNombreEmpresa" id="nuevoNombreEmpresa" size="40" maxlength="100" value="'+nombreEmpresa+'">';
		$('#fichaEmpresa').html(infoNombreEmpresa);
		$('#fichaEmpresa').append('<button class="button" id="actualizarNombreEmpresa">Actualizar</button>');
	});//end click
});

//funcion que actualiza el nombre de la empresa
$(document).on('click','#actualizarNombreEmpresa',function(){
	var nuevaEmpresa = $('#nuevoNombreEmpresa').val();
	var empresaid = $('#empresaid').val();
	//alert(empresaid);
	//alert(nuevaEmpresa)
	var empresaData = {
                nuevoNombreEmpresa: nuevaEmpresa,
                factoryid: empresaid
            };

	if (nuevaEmpresa.length > 0){
		//cambiar el nombre de la empresa
		$.post('nombreempresa.php',empresaData, procesarNombreEmpresa);
	}else
	{
		alert('Por favor ponga un nuevo nombre para su Empresa');
	}

	function procesarNombreEmpresa(data,status){
		var newMensaje;
            if(status = 'success'){
                newMensaje = '<i class="rounded-x fa fa-check"></i>';
                newMensaje += '<p>Se ha actualizado el nombre de su empresa a ' +data+'</p>';
            }else
            {
                newMensaje ='<h2>No se pudo actualizar el nombre de su empresa</h2>';
                newMensaje += '<p>Por favor intentelo mas tarde</p>';
            }
            $('#fichaEmpresa').html(newMensaje);
	}
}); //end on