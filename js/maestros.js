$(document).ready(function(){
	
//--------CAMBIAR EL NIVEL DEL MAESTRO--------------
	$('#nivel_maestro').change(function(){
		var dato = $( "#nivel_maestro option:selected" ).val();
		if(dato != "NORMALISTA" && "SELECCIONE"){
		$('#descarrera_maestro').removeAttr("readonly");
		console.log("si");
		}else{
			$('#descarrera_maestro').attr("readonly","readonly");
			console.log("no");
		}
	});
	
	
//---------------MODAL PARA ALTA MAESTROS-----------
	$('#btn-altaMaestros').click(function(){
		$('#form_nuevo_maestro')[0].reset();
		$('#modal_nuevo_maestro').modal('show');
	});
	
	
	
function cargarListaMateriasMaestros(id_maestros, boton, icono){
	$.ajax({
		url: 'control/lista_maestro_materia.php',
		method: 'POST',
		dataType: 'HTML',
		data:{"id_maestros": id_maestros}
	}).done(
			function(respuesta){
				if(icono){
					icono.toggleClass('fa-file-text fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
					
				}
				$('#lista_materiamaestro').html(respuesta);
				
			//--------LLAMAR DATOS DE MATERIAS DE MAESTROS ---------
						$('.btn_editar_materia').click(function(){
								$('#form_nuevo_maestromateria')[0].reset();
								var boton = $(this);
								var icono = boton.find('.fa');
								icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
								boton.prop('disabled',true);
								$('.modal-title2').text('Editar Materia');
								var id_materiasmaestros = boton.data('id_materiasmaestros');
								
								
								$.ajax({
									url: 'control/buscar_normal.php',
									method: 'POST',
									dataType: 'JSON',
									data:{campo: 'id_materiasmaestros', tabla:'materias_maestros', id_campo: id_materiasmaestros}
								}).done(function(respuesta){  
									if(respuesta.encontrado == 1){
										$.each(respuesta["fila"], function(name, value){
												if(name == 'id_maestros'){
												
												$("#"+name+'2').val(value);
												}else{
												$("#"+name).val(value);
												}
												
												
										});
										$('#modal_nuevo_maestromateria').modal('show');
								}
									icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
									boton.prop('disabled',false);
								});
							});
			//-----FIN DE LLAMAR DATOS DE MATERIAS DE MAESTROS------
			
			
			//---------ELEIMINAR MATERIA DE MAESTRO------------
							$('.btn_eliminar_materia').click(function(){
								var boton = $(this);
								var icono = boton.find('.fa');
								boton.prop('disabled',true);
								icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
								var fila = boton.closest('tr');
								var id_materiasmaestros = boton.data('id_materiasmaestros');
								var eliminar = function(){
								$.ajax({
									url: 'control/eliminar_normal.php',
									method: 'POST',
									dataType: 'JSON',
									data: {campo: 'id_materiasmaestros', tabla:'materias_maestros', id_campo: id_materiasmaestros}
								
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
				//-------FIN DE ELEIMINAR MATERIA DE MAESTRO----------
		
		});
	}
	
//---------------ENLISTAR MAESTROS-----------
	function listaMaestro(){
		$.ajax({
			url: 'control/lista_maestros.php',
			method: 'POST',
			dataType: 'HTML'
		}).done(function(respuesta){
				$('#lista_maestros').html(respuesta);
				
				//--------LLAMAR MAESTRO----------
			$('.btn_editar_maestro').click(function(){
				$('#form_nuevo_maestro')[0].reset();
				console.log("Editar");
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
				$('.modal-title').text('Editar Maestro');
				var id_maestros = boton.data('id_maestros');
				
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_maestros', tabla:'maestros', id_campo: id_maestros}
				}).done(function(respuesta){  
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"], function(name, value){		
								$("#"+name).val(value);
								switch(name){
									case "dcurp_maestros":
									if(value == "1"){
									$('#dcurp_maestros').prop("checked",true);
									}
									break;
									
									case "dacta_maestros":
									if(value == "1"){
									$('#dacta_maestros').prop("checked",true);
									}
									break;
									case "dcelula_maestros":
									if(value == "1"){
									$('#dcelula_maestros').prop("checked",true);
									}
									break;
									case "dcomprobante_maestro":
									if(value == "1"){
									$('#dcomprobante_maestro').prop("checked",true);
									}
									break;
								}
						});
						$('#modal_nuevo_maestro').modal('show');
				}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
			});
			//--------FIN DE LLAMAR MAESTRO----------
			
			//------------ELIMINAR MAESTRO----------------------
			$('.btn_eliminar_maestro').click( function confirmaEliminarMaestro(){
					var boton = $(this);
					var icono = boton.find('.fa');
					boton.prop('disabled',true);
					icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
					var fila = boton.closest('tr');
					var id_maestros = boton.data('id_maestros');
					function eliminarMaestro(){
						$.ajax({
							url: 'control/eliminar_relacion.php',
							method: 'POST',
							dataType: 'JSON',
							data: {id_campo: id_maestros}
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
					}
						alertify.confirm('Confirmacion', '¿Desea eliminarlo?', eliminarMaestro , function(){
							icono.toggleClass("fa-trash fa-spinner fa-spin fa-floppy-o");
							boton.prop('disabled',false);
					});
			
			
			});
			//----------FIN DE ELIMINAR MAESTRO----------
			
			//---------------MODAL MATERIAS && MAESTROS-----------	
				$('.btn_materias').click( function (){
					$('#lista_materiamaestro').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
					var boton = $(this);
					var icono = boton.find('.fa');
					var id_maestros = boton.data('id_maestros');
					console.log(id_maestros);
					boton.prop('disabled',true);
					icono.toggleClass('fa-file-text fa-spinner fa-spin fa-floppy-o');
					$("#btn_maestromateria").data('id_maestros', id_maestros);
				
					
					cargarListaMateriasMaestros(id_maestros, boton, icono);
					
					$('#maestromateria').modal('show');
					
				});
				
		});			
	};

	//--------MOSTRAR MODAL ALTA MATERIAS DE MAESTROS---------
	$('#btn_maestromateria').click(function(){
		$('#form_nuevo_maestromateria')[0].reset();
		//console.log(id_maestros);
		$('#id_maestros2').val($("#btn_maestromateria").data('id_maestros'));
		$('.modal-title2').text('Nueva Materia');
		$('#modal_nuevo_maestromateria').modal('show');
	});
	
	
	listaMaestro();
	
	$('#form_nuevo_maestromateria').submit(function(event){
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
				data: {tabla: 'materias_maestros',
							 datos: formulario.serializeArray()
					}
			}).done(function(respuesta){
				if(respuesta.estatus == 'success'){
					alertify.success('Se ha agregado correctamente');
					$('#modal_nuevo_maestro').modal('hide');
					icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
					//listaMaestro();
					boton.prop('disabled',false);
					var id_maestros = $("#btn_maestromateria").data('id_maestros')
					cargarListaMateriasMaestros(id_maestros);
					$('#modal_nuevo_maestromateria').modal('hide');
				}else{
					alertify.error('Ha ocuurido un error');
					console.log(respuesta.mensaje);
				}
			});
		});
	
	//---------------AGREGAR MAESTROS-----------
		$('#form_nuevo_maestro').submit(function(event){
			event.preventDefault();
			var formulario = $(this);
			var boton = $(this).find(":submit");
			var icono = boton.find('.fa');
			icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
			boton.prop('disabled',true);
			//console.log(formulario.serializeArray());
			$.ajax({
				url: 'control/guardar_normal.php',
				method: 'POST',
				datatype: 'JSON',
				data: {tabla: 'maestros',
						   datos: formulario.serializeArray()
					}
			}).done(function(respuesta){
				if(respuesta.estatus == 'success'){
					alertify.success('Se ha agregado correctamente');
					$('#modal_nuevo_maestro').modal('hide');
					icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
					listaMaestro();
					boton.prop('disabled',false);
				}else{
					alertify.error('Ha ocuurido un error');
					console.log(respuesta.mensaje);
				}
			});
		});
	//-------------FIN DE AGREGAR MAESTROS---------

});