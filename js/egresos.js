$(document).ready(function(){
//---------------LLAMAR AL MODAL-----------
	$('#btn-altaEgreso').click(function(){
		$('#form_nuevo_egreso')[0].reset();
		$('#modal_nuevo_egreso').modal("show");
		//$('#id_grados').prop("disabled", true);
		//$('#accion').val("INSERTAR");
	});
//---------------ENLISTAR-----------
	$('#btn_buscar').click(function(){
		var boton = $(this);
		var icono = boton.find('.fa');
		$('#listar_egresos').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
		var fecha_inicio = $('#fecha_inicio').val();
		listarEgresos(fecha_inicio);
	});
	function listarEgresos(fecha_inicio){
		return $.ajax({
			url: 'control/listar_egresos.php',
			method: 'POST',
			dataType: 'HTML',
			data:{fecha_inicio:fecha_inicio}
		}).done(function(respuesta){
			$('#listar_egresos').html(respuesta);
			
		//------------EDITAR EGRESOS----------------------
		$('.btn_editar').click(function(){
			$('#form_nuevo_egreso')[0].reset();
			var boton = $(this);
			var icono = boton.find('.fa');
			icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
			boton.prop('disabled',true);
			var id_egresos = boton.data('id_egreso');
			$.ajax({
				url: 'control/buscar_egresos.php',
				method: 'POST',
				dataType: 'JSON',
			    data:{id_egresos:id_egresos}
			}).done(function(respuesta){  
				if(respuesta.estatus == 'success'){
					$.each(respuesta["fila"], function(name, value){	
						
							$("#"+name).val(value);
					});
					$('#modal_nuevo_egreso').modal('show');
			}
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',false);
			});
		});
		//------------ELIMINAR EGRESOS----------------------
		$('.btn_eliminar').click(function(){
				var boton = $(this);
				var icono = boton.find('.fa');
				boton.prop('disabled',true);
				icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
				var fila = boton.closest('tr');
				var id_egreso = boton.data('id_egreso');
				var eliminar = function(){
				$.ajax({
					url: 'control/eliminar_egreso.php',
					method: 'POST',
					dataType: 'JSON',
					data: {id_egreso: id_egreso}
				
				}).done(function(respuesta){
					boton.prop('disabled',false);
					if(respuesta.estatus == "success"){
						alertify.success('Se ha eliminado');
					}else{
						console.log(respuesta.error);
					}
					}).always(function(){
						icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
						listarEgresos();
					});
				};
				
				
			alertify.confirm('Confirmacion', '¿Desea cancelar el egreso?', eliminar , function(){
						icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
						boton.prop('disabled',false);
				});
				
				
			});			
			});
			
			
		};
	listarEgresos();
	
//---------------AGREGAR EGRESOS-----------
$('#form_nuevo_egreso').submit(function(event){
		event.preventDefault();
		var formulario = $(this);
		var boton = $(this).find(":submit");
		var icono = boton.find('.fa');
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		boton.prop('disabled',true);
		
		$.ajax({
			url: 'control/guardar_egreso.php',
			method: 'POST',
			dataType: 'JSON',
			data:  formulario.serialize()
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correctamente');
				$('#modal_nuevo_egreso').modal('hide');
				
				listarEgresos();
				
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		}).always(function(){
			icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
			console.log('Se envia');
			boton.prop('disabled',false);
		});
	});

});