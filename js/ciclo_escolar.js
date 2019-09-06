$(document).ready(function(){
//MODAL DE CICLO ESCOLAR	
	$('#btn-altaCiclo').click(function(){
		$('#form_nuevo_ciclo')[0].reset();
		$('#modal_nuevo_ciclo').modal('show');
		console.log("modal_alta_ciclo");
	});
//FIN DEL MODAL DE CICLO ESCOLAR
//GUARDAR CICLO ESCOLAR
	$('#form_nuevo_ciclo').submit(function guardar_ciclo(event){
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
			data:{tabla: 'ciclo_escolar', datos: formulario.serializeArray()}
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correcta');
				$('#modal_nuevo_ciclo').modal('hide');
				icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',false);
				listarCiclos();
			}else{
				alertify.error('Ha ocurrido un error');
				console.log(respuesta.mensaje);
			}
		});
	
	});
//FIN DE GUARDAR CICLO ESCOLAR
//ENLISTADO 
	function listarCiclos(){
		return $.ajax({
			url: 'control/lista_ciclo.php',
			method: 'POST',
			dataType: 'HTML',
		}).done(function(respuesta){
			$('#listar_ciclo').html(respuesta);
			
			//ELIMINAR
	$('.btn_eliminar').click(function(){
			var boton = $(this);
			var icono = boton.find('.fa');
			boton.prop('disabled',true);
			icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
			var fila = boton.closest('tr');
			var id_ciclos = boton.data('id_ciclos');
			var eliminar = function(){
			$.ajax({
				url: 'control/eliminar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {campo: 'id_ciclos', tabla:'ciclo_escolar', id_campo: id_ciclos}
			
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
	listarCiclos();
//FIN DEL ENLISTADO








});



	