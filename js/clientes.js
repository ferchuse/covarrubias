var filtros = {};

$(document).ready(function(){
	
	cargarTabla(filtros);
	
	
	
	
	
	
	
	
	
	$( "#buscar_alumnos" ).autocomplete({
		source: "control/search_json.php?tabla=alumnos&campo=nombre_alumnos&valor=nombre_alumnos&etiqueta=nombre_alumnos",
		minLength : 1,
		autoFocus: true,
		select: function eligeAlumno( event, ui ) {
			
			var id_alumnos = ui.item.extras.id_alumnos;
			var id_clientes = $("#id_clientes_asignado").val();
			
			$( "#buscar_alumnos" ).prop("disabled", true);
			$( "#buscar_alumnos" ).addClass("ui-autocomplete-loading");
			
			$.ajax({
				url: 'control/fila_update.php',
				method: 'POST',
				data: {
					tabla: "alumnos",
					id_campo: "id_alumnos",
					id_valor: id_alumnos,
					valores:[
						{name: "id_clientes" , value: id_clientes},
						{name: "facturar" , value: 1}
					]
				}
				}).done(function(respuesta) {
				
				cargarAlumnosAsignados(id_clientes);
				cargarTabla(filtros);
				
				}).fail(function(xhr, error, errnum){
				alertify.error(error);
				
				}).always(function() {
				$( "#buscar_alumnos" ).prop("disabled", false);
				$( "#buscar_alumnos" ).removeClass("ui-autocomplete-loading");
				$( "#buscar_alumnos" ).val("");
				$( "#buscar_alumnos" ).focus();
				
				// boton.prop("disabled", false);
				// icono.toggleClass("fa-spinner fa-spin fa-users");
			});
			
		}
	});
	
	$("#btn_insert").click(function(){
		
		var $formulario = $('#form_edit');
		$formulario[0].reset();
		$formulario.find(".modal").modal("show");
		$formulario.find(".action").val("INSERT");
	});
	
	
	$('#form_edit').submit( function guardarClientes(event){
		event.preventDefault();
		var $formulario = $(this);
		var action = $formulario.find(".action").val();
		var $modal = $formulario.find(".modal");
		var boton = $formulario.find(':submit');
		var icono = boton.find('.fa');
		icono.toggleClass('fa-save fa-spinner fa-spin ');
		boton.prop('disabled',true);
		
		if(action == "INSERT"){
			$.ajax({
				url: 'control/fila_insert.php',
				method: 'POST',
				data: {
					"tabla": "clientes",
					"valores": $formulario.serializeArray()
				}
				}).done(function(respuesta){
				if(respuesta["estatus"] == "success"){
					cargarTabla(filtros);
					$modal.modal("hide");				
					}else{
					alertify.error('Error' + respuesta["mensaje"]);
					
				}
				}).fail(function(xhr, error, errnum){
				alertify.error("Error" + error);
				}).always(function(){
				icono.toggleClass('fa-save fa-spinner fa-spin ');
				boton.prop('disabled',false);
				$formulario[0].reset();
			});
			
		}
		else{
			$.ajax({
				url: 'control/fila_update.php',
				method: 'POST',
				data: {
					"tabla": "clientes",
					"valores": $formulario.serializeArray(),
					"id_campo": "id_clientes",
					"id_valor": $("#id_clientes").val()
				}
				}).done(function(respuesta){
				if(respuesta["estatus"] == "success"){
					cargarTabla(filtros);
					$modal.modal("hide");				
					}else{
					alertify.error('Error' + respuesta["mensaje"]);
					
				}
				}).fail(function(xhr, error, errnum){
				alertify.error("Error" + error);
				}).always(function(){
				icono.toggleClass('fa-save fa-spinner fa-spin ');
				boton.prop('disabled',false);
				$formulario[0].reset();
			});
			
		}
		
		
	});
});
function cargarAlumnosAsignados(id_clientes){
	
	return $.ajax({
		url: 'control/lista_alumnos_por_cliente.php',
		method: 'GET',
		data: {
			id_clientes: id_clientes
		}
		}).done(function(respuesta) {
		
		$('#lista_alumnos_por_cliente').html(respuesta);
		$('.btn_quitar_alumno').click(quitarAlumno);
		
		
		$('#modal_asignar_alumno').modal('hide');
		
		}).fail(function(xhr, error, errnum){
		alertify.error(error);
		
		}).always(function() {
		// boton.prop("disabled", false);
		// icono.toggleClass("fa-spinner fa-spin fa-users");
	});
	
}

function cargarTabla(filtros) {
	var cargador = "<tr><td class='text-center' colspan='5'><i class='fa fa-spinner fa-spin fa-3x'></i></td></tr>";
	$('#cuerpo').html(cargador);
	$.ajax({
		url: 'control/lista_clientes.php',
		method: 'GET',
		data: filtros
		}).done(function(respuesta) {
		$('#cuerpo').html(respuesta);
		
		$('.btn_eliminar').click(function() {
			var boton = $(this);
			boton.prop('disabled', true);
			icono = boton.find(".fa");
			icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
			var id_clientes = boton.data('id_value');
			var fila = boton.closest('tr');
			var elimina = function() {
				$.ajax({
					url: 'control/fila_delete.php',
					method: 'POST',
					dataType: 'JSON',
					data: {
						tabla: "clientes",
						id_campo: "id_clientes",
						id_valor: id_clientes
					}
					}).done(function(respuesta) {
					boton.prop('disabled', false);
					console.log(respuesta.mensaje);
					if (respuesta.estatus == "success") {
						fila.fadeOut(1000);
						icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
						console.log('se eliminino');
						} else {
						console.log(respuesta.error);
					}
				});
			};
			alertify.confirm('Confirmacion', '¿Desea eliminarlo?', elimina, function() {
				icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
				boton.prop('disabled', false);
			});
			
		});
		
		$('.btn_editar').click(function() {
			
			var boton = $(this);
			var id_value = boton.data('id_value');
			var icono = boton.find('.fa');
			var $formulario = $('#form_edit');
			
			boton.prop("disabled", true);
			icono.toggleClass("fa-spinner fa-spin fa-edit");
			$formulario.find(".action").val("update");
			
			
			$.ajax({
				url: 'control/buscar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {
					campo: 'id_clientes',
					tabla: 'clientes',
					id_campo: id_value
				}
				}).done(function(respuesta) {
				if (respuesta.encontrado == 1) {
					$.each(respuesta["fila"], function(name, value) {
						$("#" + name).val(value);
					});
				}
				$('#modal_edit').modal('show');
				}).fail(function(xhr, error, errnum){
				alertify.error(error);
				
				}).always(function() {
				boton.prop("disabled", false);
				icono.toggleClass("fa-spinner fa-spin fa-edit");
				
			});
			
		});
		
		
		$('.btn_alumnos').click(function() {
			
			var boton = $(this);
			var id_clientes = boton.data('id_value');
			var icono = boton.find('.fa');
			boton.prop("disabled", true);
			icono.toggleClass("fa-spinner fa-spin fa-users");
			
			$("#id_clientes_asignado").val(id_clientes);
			
			cargarAlumnosAsignados(id_clientes).always(function(respuesta){
				boton.prop("disabled", false);
				icono.toggleClass("fa-spinner fa-spin fa-users");
				$("#modal_alumnos_asignados").modal("show");
			});
			
			
		});
		
	});
}

function quitarAlumno(event){
	var $boton = $(this);
	var $icono = $boton.find(".fa");
	var id_alumno_asignado = $boton.data("id_valor");
	var $fila = $boton.closest("tr");
	
	
	$icono.toggleClass('fa-times fa-spinner fa-spin ');
	$boton.prop('disabled',true);
	
	$.ajax({
		url: 'control/fila_update.php',
		method: 'POST',
		data: {
			"tabla": "alumnos",
			"valores": [{name: "id_clientes", value:"0"}],
			"id_campo": "id_alumnos",
			"id_valor": id_alumno_asignado
		}
		}).done(function(respuesta){
		if(respuesta.estatus == "success"){
			$fila.fadeOut(1000);
			cargarTabla(filtros);
		}
		console.log(respuesta);
		}).fail(function(xhr, error, errnum){
		alertify.error("Error" + error);
		}).always(function(){
		$icono.toggleClass('fa-times fa-spinner fa-spin ');
		$boton.prop('disabled',false);
		
	});
	console.log("quitarAlumno");
	console.log(id_alumno_asignado);
	
}