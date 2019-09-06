$(document).ready(function(){
//---------------LLAMAR AL MODAL-----------
	$('#btn_nuevoCosto').click(function(){
		$('#form_nuevo_costo')[0].reset();
		$('#modal_nuevo_costo').modal("show");
	});	
	
	function activaMeses(event){
		// console.log("event");
		// console.log(event);
		// console.log("event.data");
		// console.log(event.data);
		// if(event.data.usa_meses){
			// console.log("usa_meses");
			// $("#usa_meses").prop("checked", true);
			// $("#div_usa_meses").find("input:checkbox").each(function(elemnt){
				// $(this).prop("disabled", false);
			// });
		// }
		// else{
			// console.log("no usa_meses");
			// $("#usa_meses").prop("checked", false);
			// $("#div_usa_meses").find("input:checkbox").each(function(elemnt){
				// $(this).prop("disabled", true);
			// });
		// }
	}
	
	 $('#usa_meses').change({"usa_meses": $("#usa_meses").prop("checked")}, activaMeses);
//---------------ENLISTAR MATERIA-----------
	function listaCosto(){
		return $.ajax({
			url: 'control/lista_costos.php',
			method: 'POST',
			dataType: 'HTML',
		}).done(function(respuesta){
			$('#lista_costos').html(respuesta);
			//--------EDITAR MATERIA----------
			$('.btn_editar').click(function(){
				$('#form_nuevo_costo')[0].reset();
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
				var id_costos = boton.data('id_costos');
				
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_costos', tabla:'costos', id_campo: id_costos}
				}).done(function(respuesta){  
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"], function(name, value){
							
								$("#"+name).val(value);
								if(name == "usa_meses" ){
									
									
								}
								
						});
						$('#modal_nuevo_costo').modal('show');
				}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
				
			});
			
		$('.btn_eliminar').click(function(){
			var boton = $(this);
			var icono = boton.find('.fa');
			boton.prop('disabled',true);
			icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
			var fila = boton.closest('tr');
			var id_costos = boton.data('id_costos');
			var eliminar = function(){
			$.ajax({
				url: 'control/eliminar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {campo: 'id_costos', tabla:'costos', id_campo: id_costos}
			
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
	listaCosto();
	
//---------------AGREGAR MATERIA-----------
$('#form_nuevo_costo').submit(function(event){
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
			data: {tabla: 'costos',
					   datos: formulario.serializeArray()
				}
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correctamente');
				$('#modal_nuevo_costo').modal('hide');
				icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
				listaCosto();
				boton.prop('disabled',false);
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		});
	});








});