$(document).ready(function(){
	
	listarRegistros();
	
	
});

function listarRegistros(){
	return $.ajax({
		url: 'tablas/becados.php',
		method: 'POST',
		dataType: 'HTML',
		}).done(function(respuesta){
		$('#lista_registros').html(respuesta);
		
		
	});
	
}