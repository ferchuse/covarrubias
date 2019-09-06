$(document).ready(function(){
//---------------LLAMAR AL MODAL-----------
	$('#btn-altaMaterias').click(function(){
		$('#form_nuevo_materia')[0].reset();
		$('#modal_nuevo_materia').modal("show");
		//$('#accion').val("INSERTAR");
	});
//---------------ENLISTAR MATERIA-----------
	function listaMateria(){
		return $.ajax({
			url: 'control/lista_materias.php',
			method: 'POST',
			dataType: 'HTML',
		}).done(function(respuesta){
			$('#lista_materias').html(respuesta);
			//--------EDITAR MATERIA----------
			$('.btn_editar').click(function(){
				$('#form_nuevo_materia')[0].reset();
				console.log("h");
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
			
				//$('.modal-title').text('Editar materia');
				var id_materias = boton.data('id_materias');
				
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_materias', tabla:'materias', id_campo: id_materias}
				}).done(function(respuesta){  
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"], function(name, value){
							
								$("#"+name).val(value);
						});
						$('#modal_nuevo_materia').modal('show');
				}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
				
			});
//------------ELIMINAR MATERIA----------------------
$('.btn_eliminar').click(function(){
			var boton = $(this);
			var icono = boton.find('.fa');
			boton.prop('disabled',true);
			icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
			var fila = boton.closest('tr');
			var id_materias = boton.data('id_materias');
			var eliminar = function(){
			$.ajax({
				url: 'control/eliminar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {campo: 'id_materias', tabla:'materias', id_campo: id_materias}
			
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
	listaMateria();
	
//---------------AGREGAR MATERIA-----------
$('#form_nuevo_materia').submit(function(event){
		event.preventDefault();
		var formulario = $(this);
		var boton = $(this).find(":submit");
		var icono = boton.find('.fa');
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		boton.prop('disabled',true);
		
		$.ajax({
			url: 'control/guardar_normal.php',
			method: 'POST',
			datatype: 'JSON',
			data: {tabla: 'materias',
					   datos: formulario.serializeArray()
				}
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correctamente');
				$('#modal_nuevo_materia').modal('hide');
				icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
				listaMateria();
				boton.prop('disabled',false);
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		});
	});








});