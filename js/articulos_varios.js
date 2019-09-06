$(document).ready(function(){
//MODAL
	$('#btn-altaArticulos').click(function(){
		$('#form_nuevo_articulo')[0].reset();
		$('#modal_nuevo_articulo').modal('show');
	});
//FIN DEL MODAL
//GUARDAR CICLO ESCOLAR
	$('#form_nuevo_articulo').submit(function guardar_beca(event){
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
			data:{tabla: 'articulos', datos: formulario.serializeArray()}
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correcta');
				$('#modal_nuevo_articulo').modal('hide');
				icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',false);
				listarBecas();
			}else{
				alertify.error('Ha ocurrido un error');
				console.log(respuesta.mensaje);
			}
		});
	
	});
//FIN DE GUARDAR CICLO ESCOLAR
//ENLISTADO 
	function listarBecas(){
		return $.ajax({
			url: 'control/listar_articulos.php',
			method: 'POST',
			dataType: 'HTML',
		}).done(function(respuesta){
			$('#listar_articulos').html(respuesta);
			
			//--------EDITAR BECAS----------
			$('.btn_editar').click(function(){
				$('#form_nuevo_articulo')[0].reset();
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
				var id_articulo = boton.data('id_articulo');
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_articulo', tabla:'articulos', id_campo: id_articulo}
				}).done(function(respuesta){  
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"], function(name, value){	
							
								$("#"+name).val(value);
						});
						$('#modal_nuevo_articulo').modal('show');
				}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
				
			});
			
			//ELIMINAR
	$('.btn_eliminar').click(function(){
			var boton = $(this);
			var icono = boton.find('.fa');
			boton.prop('disabled',true);
			icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
			var fila = boton.closest('tr');
			var id_articulo = boton.data('id_articulo');
			var eliminar = function(){
			$.ajax({
				url: 'control/eliminar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {campo: 'id_articulo', tabla:'articulos', id_campo: id_articulo}
			
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
//FIN DE ELIMINAR

		});
		
	};
	listarBecas();
//FIN DEL ENLISTADO


});