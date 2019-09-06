$(document).ready(function(){
//---------------LLAMAR AL MODAL-----------
	$('#btn-altaGrupos').click(function(){
		$('#form_nuevo_grupo')[0].reset();
		$('#modal_nuevo_grupo').modal("show");
		$('#id_grados').prop("disabled", true);
		//$('#accion').val("INSERTAR");
	});
	
	//---------------llamar Grados por nivel-----------
	$('#id_niveles').change(function cargarGradosNivel(){
		$('#id_grados').prop("disabled", false);
		$('#id_grados').html("<option>Cargando...</option>");
		$.ajax({
			"url": "control/get_options.php",
			"method": "GET",
			"data": {
					"formato": "html",
					"tabla": "grados",
					"id_col": "id_grados",
					"nombre_col": "nombre_grados",
					"filtro_campo": "id_niveles",
					"filtro_valor": $('#id_niveles').val(),
					"campo_orden": "id_grados"
					
			}
		}).done(function(respuesta){
			$('#id_grados').html(respuesta);
		}).fail(function(xhr, error, errnum){
			alertify.error("Ocurrio un error cargarGradosNivel()");
		});
	
	});
//---------------ENLISTAR-----------
	function listarGrupos(){
		return $.ajax({
			url: 'control/lista_grupos.php',
			method: 'POST',
			dataType: 'HTML',
		}).done(function(respuesta){
			$('#listar_grupos').html(respuesta);
			
			//--------EDITAR GRUPO----------
			$('.btn_editar').click(function(){
				$('#form_nuevo_grupo')[0].reset();
				console.log("h");
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
				var id_aulas = boton.data('id_grupos');
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_grupos', tabla:'grupos', id_campo: id_aulas}
				}).done(function(respuesta){
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"], function(name, value){
							
								$("#"+name).val(value);
						});
						$('#modal_nuevo_grupo').modal('show');
				}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
				
			});
//------------ELIMINAR GRUPO----------------------
$('.btn_eliminar').click(function(){
			var boton = $(this);
			var icono = boton.find('.fa');
			boton.prop('disabled',true);
			icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
			var fila = boton.closest('tr');
			var id_valor = boton.data('id_grupos');
			var eliminar = function(){
			$.ajax({
				url: 'control/eliminar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {campo: 'id_grupos', tabla:'grupos', id_campo: id_valor}
			
			}).done(function(respuesta){
				boton.prop('disabled',false);
				if(respuesta.estatus == "success"){
					fila.fadeOut(1000);
					icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
					alertify.success('Se ha eliminado');
				}else{
					console.log(respuesta.error);
				}
				});
			};
			
			
		alertify.confirm('Confirmacion', '¿Desea eliminarlo?', eliminar , function(){
					icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
					boton.prop('disabled',false);
			});
			
			
		});			
		});
		
		
	};
	listarGrupos();
	
//---------------AGREGAR GRUPOS-----------
$('#form_nuevo_grupo').submit(function(event){
		event.preventDefault();
		var formulario = $(this);
		var boton = $(this).find(":submit");
		var icono = boton.find('.fa');
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		boton.prop('disabled',true);
		
		$.ajax({
			url: 'control/guardar_normal.php',
			method: 'POST',
			dataType: 'JSON',
			data: {tabla: 'grupos',
					   datos: formulario.serializeArray()
				}
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correctamente');
				$('#modal_nuevo_grupo').modal('hide');
				
				listarGrupos();
				
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		}).always(function(){
			icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
			boton.prop('disabled',false);
		});
	});








});