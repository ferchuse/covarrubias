$(document).ready(function(){
//---------------LLAMAR AL MODAL-----------
	$('#btn-altaCarreras').click(function(){
		$('#form_nueva_carrera')[0].reset();
		$('#modal_nueva_carrera').modal("show");
		//$('#accion').val("INSERTAR");
	});
//---------------ENLISTAR-----------
	function listaCarrera(){
		return $.ajax({
			url: 'control/lista_carrera.php',
			method: 'POST',
			dataType: 'HTML',
		}).done(function(respuesta){
			$('#lista_carrera').html(respuesta);
			//--------EDITAR CARRERAS----------
			$('.btn_editar').click(function(){
				$('#form_nueva_carrera')[0].reset();
				console.log("h");
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
			
				//$('.modal-title').text('Editar Carrera');
				var id_carreras = boton.data('id_carreras');
				
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_carreras', tabla:'carreras', id_campo: id_carreras}
				}).done(function(respuesta){  
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"], function(name, value){
							
								$("#"+name).val(value);
						});
						$('#modal_nueva_carrera').modal('show');
				}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
				
			});
//------------ELIMINAR CARRERAS----------------------
$('.btn_eliminar').click(function(){
			var boton = $(this);
			var icono = boton.find('.fa');
			boton.prop('disabled',true);
			icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
			var fila = boton.closest('tr');
			var id_carreras = boton.data('id_carreras');
			var eliminar = function(){
			$.ajax({
				url: 'control/eliminar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {campo: 'id_carreras', tabla:'carreras', id_campo: id_carreras}
			
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
	listaCarrera();
	
//---------------AGREGAR CARRERAS-----------
$('#form_nueva_carrera').submit(function(event){
		event.preventDefault();
		var formulario = $(this);
		var boton = $(this).find(":submit");
		var icono = boton.find('.fa');
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		boton.prop('disabled',true);
		console.log(formulario.serializeArray());
		$.ajax({
			url: 'control/guardar_normal.php',
			method: 'POST',
			datatype: 'JSON',
			data: {tabla: 'carreras',
					   datos: formulario.serializeArray()
					   
				}
				
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correctamente');
				$('#modal_nueva_carrera').modal('hide');
				icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
				listaCarrera();
				boton.prop('disabled',false);
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		});
	});








});