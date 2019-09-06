$(document).ready(function(){
	
	
	
	 var listarNiveles = function(){
		
		$.ajax({
			url: 'control/listar_niveles.php',
			method: 'POST',
			dataType: 'HTML',
		}).done(function(respuesta){
			$('#listar_niveles').html(respuesta);
			//----------EDITAR-----------
			$('.btn_editar').click(function(){
				$('#form_nuevo_nivel')[0].reset();
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
			
				$('.modal-title').text('Editar Nivel');
				var id_niveles = boton.data('id_niveles');
				
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_niveles', tabla:'niveles', id_campo: id_niveles}
				}).done(function(respuesta){  
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"], function(name, value){
							
							if(name == 'activo_niveles'){
								if(value == 1){									
									$('#activo_niveles').attr('checked',true);
								}else{
									$('#activo_niveles').attr('checked',false);
								}
							}else{
								$("#"+name).val(value);
							}
						});
						$('#modal_nuevo_nivel').modal('show');
				}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
			});
			//-------FIN DE EDITAR------------
	 
		//---------ELIMINAR------------
		$('.btn_eliminar').click(function(){
			var boton = $(this);
			var icono = boton.find('.fa');
			boton.prop('disabled',true);
			icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
			var fila = boton.closest('tr');
			var id_niveles = boton.data('id_niveles');
			var eliminar = function(){
			$.ajax({
				url: 'control/eliminar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {campo: 'id_niveles', tabla:'niveles', id_campo: id_niveles}
			
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
		//--------FIN DE ELIMINAR-------
		
		//-------DOCUMENTACION------
		
			//------LISTAR DOCUMENTACION------
			
				

				$('.btn_doc').click(function(){
					var boton = $(this);
					var icono = boton.find('.fa');
					var id_doc = boton.data('id_niveles');
					boton.prop('disabled',true);
					icono.toggleClass('fa-file-text fa-spinner fa-spin fa-floppy-o');
						
						var listarDoc = function(){
							$.ajax({
								url: 'control/lista_documentacion.php',
								method: 'POST',
								dataType: 'HTML',
								data:{id_niveles:id_doc}
							}).done(function(respuesta){
								$('#lista_doc').html(respuesta);
								$('#documentacion').modal('show');
								icono.toggleClass('fa-file-text fa-spinner fa-spin fa-floppy-o');
								boton.prop('disabled',false);
								
								//---AGREGAR DOUMENTO-----
									$('#btn_documento').click(function(){
										$('#form_nuevo_documento')[0].reset();
										var boton = $(this);
										var id_niveles = boton.data('id_niveles');
										$('.modal-title2').text('Nuevo Documento');
										$('#modal_nuevo_documento').modal('show');
										$('#id_niveles2').val(id_niveles); 
									});
									
									//-----LLAMAR DATOS------
											
											$('.btn_editar').click(function(){
												$('#form_nuevo_documento')[0].reset();
												var boton = $(this);
												var icono = boton.find('.fa');
												icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
												boton.prop('disabled',true);
												$('.modal-title2').text('Editar Documento');
												var id_documentacion = boton.data('id_documentacion');
												
												
												$.ajax({
													url: 'control/buscar_normal.php',
													method: 'POST',
													dataType: 'JSON',
													data:{campo: 'id_documentacion', tabla:'documentacion', id_campo: id_documentacion}
												}).done(function(respuesta){  
													if(respuesta.encontrado == 1){
														$.each(respuesta["fila"], function(name, value){
															
																$("#"+name).val(value);
														});
														$('#modal_nuevo_documento').modal('show');
												}
													icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
													boton.prop('disabled',false);
												});
											});
											//-----FIN DE LLAMAR DATOS------
											
											//---------ELIMINAR------------
											$('.btn_eliminar').click(function(){
												var boton = $(this);
												var icono = boton.find('.fa');
												boton.prop('disabled',true);
												icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
												var fila = boton.closest('tr');
												var id_documentacion = boton.data('id_documentacion');
												var eliminar = function(){
												$.ajax({
													url: 'control/eliminar_normal.php',
													method: 'POST',
													dataType: 'JSON',
													data: {campo: 'id_documentacion', tabla:'documentacion', id_campo: id_documentacion}
												
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
						listarDoc();
						//-------------AGREGAR DOCUMENTO-----------
						$('#form_nuevo_documento').submit(function(event){
									event.preventDefault();
									var formulario = $(this);
									var boton = formulario.find(':submit');
									boton.prop('disabled',true);
									var icono = boton.find('.fa');
									icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
									if($('#id_documentacion').val() != ''){
										var form = formulario.serializeArray();
										form.pop();
										console.log(form);
										console.log('lo quito');
									}else{
										var form = formulario.serializeArray()
									}
									
									$.ajax({
										url: 'control/guardar_normal.php',
										method: 'POST',
										datatype: 'JSON',
										data: {tabla: 'documentacion',
												   datos: form
											}
									}).done(function(respuesta){
										if(respuesta.estatus == 'success'){
											alertify.success('Se ha guardado correctamente');
											$('#modal_nuevo_documento').modal('hide');
											icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
											boton.prop('disabled',false);
											listarDoc();
											
											
											
										}else{
											alertify.error('Ha ocurido un error');
											console.log(respuesta.mensaje);
										}
										

									});
									
							});
							//-------------FIN DE AGREGAR DOCUMENTO-----------
						
				});
			
		//------FIN DE LA DOCUMENTACION------
		});
			
	};
	
	listarNiveles();
	
	$('#btn-niveles').click(function(){
		$('#form_nuevo_nivel')[0].reset();
		$('#modal_nuevo_nivel').modal('show');
		$('.modal-title').text('Nuevo Nivel');
	});
	
	//--------NUEVO NIVEL-------
	
	$('#form_nuevo_nivel').submit(function(event){
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
			data: {tabla: 'niveles',
					   datos: formulario.serializeArray()
				}
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correctamente');
				$('#modal_nuevo_nivel').modal('hide');
				icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
				listarNiveles();
				boton.prop('disabled',false);
			}else{
				alertify.error('Ha ocurido un error');
				console.log(respuesta.mensaje);
			}
			

		});
		
		
	});
	
	
	
	
});