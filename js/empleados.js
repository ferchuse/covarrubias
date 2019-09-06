$(document).ready(function(){
	//---------------LLAMAR AL MODAL-----------
	$('.nuevo').click(function(){
		$('#form_edicion')[0].reset();
		$('#modal_edicion').modal("show");
		
	});
	
	$('#form_edicion').submit(guardarRegistro );
	
	
	listarRegistros();
});


//---------------ENLISTAR-----------
function listarRegistros(){
	return $.ajax({
		url: 'control/lista_empleados.php',
		method: 'POST',
		dataType: 'HTML',
		}).done(function(respuesta){
		$('#lista_registros').html(respuesta);
		
		//--------EDITAR GRUPO----------
		$('.btn_editar').click(cargarRegistro);
		$('.btn_eliminar').click(confirmaEliminar);
	});
}

function confirmaEliminar(){
	let boton = $(this);
	let id_registro = boton.data('id_registro');
	var fila = boton.closest('tr');
	
	alertify.confirm('Confirmacion', '¿Deseas eliminarlo?', eliminar , function(){
	});
	
	function eliminar(){
		$.ajax({
			url: 'control/fila_delete.php',
			method: 'POST',
			dataType: 'JSON',
			data: {
				tabla: 'empleados',
				id_campo: 'id_empleados',
				id_valor: id_registro
			}
			}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha eliminado correctamente');
				fila.fadeOut(1000);
				}else{
				alertify.error('Ocurrio un error');
			}
		});
	}
	
}

function cargarRegistro(){
	
	var boton = $(this);
	var icono = boton.find('.fa');
	var id_registro = boton.data('id_registro');
	
	icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
	boton.prop('disabled',true);
	$('#form_edicion')[0].reset();
	
	
	$.ajax({
		url: 'control/buscar_normal.php',
		method: 'POST',
		dataType: 'JSON',
		data:{campo: 'id_empleados', tabla:'empleados', id_campo: id_registro}
		}).done(function(respuesta){
		if(respuesta.encontrado == 1){
			$.each(respuesta["fila"], function(name, value){
				$("#"+name).val(value);
			});
			$('#modal_edicion').modal('show');
		}
		
		}).always(function(){
		
		icono.toggleClass('fa-pencil fa-spinner fa-spin ');
		boton.prop('disabled',false);
	});
	
}


function guardarRegistro(event){
	event.preventDefault();
	var boton = $(this).find(":submit");
	var icono = $(this).find(".fa");
	
	if($("#rfc_empleados").val().trim() == ''){
		
		alertify.error("Ingresa el RFC");
		
		return false;
	}
	
	if($("#id_empleados").val() != ""){
		
		icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
		boton.prop('disabled',true);
		
		$.ajax({
			url: 'control/guardar_empleados.php',
			method: 'POST',
			data: {
				"tabla": "empleados",
				"valores": $("#form_edicion").serializeArray()
			}
			}).done(function(respuesta){
			if(respuesta["estatus"] == "success"){
					$("#modal_edicion").modal("hide");
					listarRegistros();
			}
			else{
				alertify.error('Error' + respuesta["mensaje"]);
				
			}
			}).fail(function(xhr, error, errnum){
			alertify.error("Error" + error);
			}).always(function(){
			icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
			boton.prop('disabled',false);
		});
		
	}
	else{
		
		alertify.error("Ingresa una clave ");
		
		
	}
	
	
}