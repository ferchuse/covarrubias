$(document).ready(function(){
	
	$('#form_nuevo_pago')[0].reset();
	
	function calcularRecargos(cantidad){
		var recargo = 0;
			if(!$('#recargo_costos').val() == ''){
				recargo = parseFloat($('#recargo_costos').val());
				recargo = cantidad * recargo/100;
				}
				return recargo;
	}
	function calcularDescuento(cantidad){
		console.log("calcularDescuento");
		var descuento = 0;
		var porcDesc = $('#descuento_costos option:selected').data('por_desc');
		console.log("porcDesc = " + porcDesc) ;
		if( porcDesc != ''){
			descuento = cantidad * (porcDesc/100);
		}
		return descuento;
	}
	function calculaTotal(){
		var cantidad = parseFloat($('#cantidad_costos').val());
		var total = cantidad;
		
		$('#total_costos').val(total);
		
		$('#form_nuevo_pago').find(":submit").prop("disabled", false);
	}
	
	
	
	function cambiarTipoPago(evnt){
		$("#datos_precio").removeClass('hidden');
		console.log("cambiarTipoPago");
		if($(this).val() == 0){
			
			$('#descripcion_pagos').prop("disabled", false);
			$('.show_colegiaturas').each(function(indice, elemento){
				$(elemento).removeClass('hidden');
				$(elemento).find('input').prop("disabled", false);
				$(elemento).find('select').prop("disabled", false);
			});
			$('.show_articulos').each(function(indice, elemento){
				$(elemento).addClass('hidden');
				$(elemento).find('input').prop("disabled", true);
				$(elemento).find('select').prop("disabled", true);
			});
			$("#meses").addClass('hidden');
		}
		else{
			$('#descripcion_pagos').prop("disabled", true);
			$('.show_colegiaturas').each(function(indice, elemento){
				$(elemento).addClass('hidden');
				$(elemento).find('input').prop("disabled", true);
				$(elemento).find('select').prop("disabled", true);
			});
			$('.show_articulos').each(function(indice, elemento){
				$(elemento).removeClass('hidden');
				$(elemento).find('input').prop("disabled", false);
				$(elemento).find('select').prop("disabled", false);
			});
		}
	}
	
	$( ".tipo_pago" ).click(cambiarTipoPago);	
	
	
	$( "#buscar_articulo" ).autocomplete({
			source: "control/search_json.php?tabla=articulos&campo=nombre_articulo&valor=nombre_articulo&extra_labels[]=descripcion_articulo",
			minLength : 2,
			autoFocus: true,
			select: function eligeArticulo( event, ui ) {
				$("#id_articulos").val(ui.item.extras.id_articulo);
				$("#id_articulos_span").html(ui.item.extras.id_articulo);
				$("#cantidad_costos").val(ui.item.extras.costo_articulo);
				
				calculaTotal();
				
			}
		});	
		
		
		
		
$( "#buscar_alumnos" ).autocomplete({
		source: "control/search_json.php?tabla=alumnos&campo=nombre_alumnos&valor=nombre_alumnos&etiqueta=nombre_alumnos",
		minLength : 1,
		autoFocus: true,
		select: function eligeAlumno( event, ui ) {
			
			$("#id_alumnos").val(ui.item.extras.id_alumnos);
			$("#id_alumnos_span").html(ui.item.extras.id_alumnos);
			$("#id_niveles").val(ui.item.extras.id_niveles);
			
			cargarConceptosPorNivel(ui.item.extras.id_grados);
		}
	});
	
	function cargarConceptosPorNivel(id_grados){
		$.ajax({
				"url": "control/get_options.php",
				"method": "GET",
				"data": {
					"formato": "html",
					"tabla": "costos",
					"id_col": "id_costos",
					"nombre_col": "concepto_costos",
					"campo_orden": "concepto_costos",
					"data_campos": ["usa_meses", "cantidad_costos"],
					"etiquetas": ["nombre_niveles"],
					"filtros": [{
							"campo": "id_grados",
							"operador": "=",
							"valor": id_grados
						},
						{
							"campo": "activo_niveles",
							"operador": "=",
							"valor": 1
						}
					],
					"joins": [{
							"tabla": "grados",
							"using": "id_niveles"
						},
						{
							"tabla": "niveles",
							"using": "id_niveles"
						}
					]

				}
			}).done(function (respuesta) {
					$("#id_costos").html(respuesta);
			});
	}

	
// $( "#id_alumnos" ).keypress(function(event){ solo activar esta funncion para buscar por numero de control
		// Keycode para enter es 13
		// if(event.which == 13){
			// var id_alumnos = $(this).val();
				// $.ajax({
					// url: 'control/buscar_normal.php',
					// method: 'POST',
					// dataType: 'JSON',
					// data: {tabla:'alumnos', campo:'id_alumnos', id_campo:id_alumnos}
				// }).done(function(respuesta){
					// if(respuesta.encontrado == 1){
						// $.each(respuesta["fila"], function(name, value){
								// $("#"+name).val(value);
						// });
						// cargarForm();
				// }
				// });
		// } 
// });


	function eligeConcepto(){
		console.log("eligeConcepto");
		var cantidad_costos = $('#id_costos ').find(":selected").data('cantidad_costos');
		var usa_meses = $('#id_costos option:selected').data("usa_meses");
		var descripcion_pagos = $('#id_costos option:selected').text();
		console.log("cantidad_costos");
		console.log(cantidad_costos);
		console.log("usa_meses");
		console.log(usa_meses);
		console.log("descripcion_pagos");
		console.log(descripcion_pagos);
		
		$('#cantidad_costos').val(cantidad_costos);
		$('#descripcion_pagos').val(descripcion_pagos.trim());
		
		if(usa_meses == 1){
			$('#meses').removeClass('hidden');
			$('#meses').prop("disabled", false);
			$('#mes_pagos').attr("required", false);
			$('#ciclo').addClass('hidden');
		}else{
			$('#meses').addClass('hidden');	 
			$('#meses').prop("disabled", true);
			$('#mes_pagos').attr("required", true);
			$('#ciclo').removeClass('hidden');
		}
		calculaTotal();
	}

	$('#id_costos').change(eligeConcepto);
	
		function cargarForm(tipo_pago){
			$('#id_niveles').prop("disabled", false);
			$('#id_niveles').prop("disabled", false);
			
			var dato = $('#id_niveles option:selected').val();
			$('#concepto_cantidad').show('<h4 class="text-center">Cargando...</h4>');
				
	}

	$('#id_niveles').change(function(){
			var costo = $('#id_niveles option:selected').data('costo');
			var periodo = $('#id_niveles option:selected').data('periodo');
			$('#total_costos').val(costo);
			$('#cantidad_costos').val(costo);
			if(periodo == 'MENSUAL'){
				$('#meses').removeClass('hidden');
				$('#ciclo').addClass('hidden');
			}else{
				$('#meses').addClass('hidden');	 
				$('#ciclo').removeClass('hidden');
			}
		});
		$('#descuento_costos').change(function(){
			calculaTotal();
		});
		 $('#recargo_costos').keyup(function(){
			calculaTotal();
		});
		
		
		
	$('#form_nuevo_pago').submit( function submitPago(event){
		event.preventDefault();
		var $formulario = $(this);
		var id_alumnos = $('#id_alumnos').val();
		var boton = $formulario.find(':submit');
		boton.prop('disabled',true);
		var icono = boton.find('.fa');
		icono.toggleClass('fa-money fa-spinner fa-spin fa-floppy-o');
		$.ajax({
			url: 'control/guardar_pago.php',
			method: 'POST',
			dataType: 'JSON',
			data: $formulario.serialize() + "&id_usuarios="+ $("#id_usuarios").val()
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
					alertify.success('Pago completado');
					window.location.href='imprimir_pago.php?folio_pago='+respuesta.folio_pago;
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		}).fail(function(){
			alertify.error("Ocurrio un error");
		}).always(function(){
			icono.toggleClass('fa-money fa-spinner fa-spin fa-floppy-o');
			boton.prop('disabled',false);
		});
	});
	
	$('#nuevo_id_niveles').change( function cargarGrados(){
		console.log("cargarGrados");
		var id_niveles = $(this).val();
		if( id_niveles == ""){
				$('#nuevo_id_grados').html("<option value=''> Escoge un nivel</option>");
		}
		else{ 
				$('#nuevo_id_grados').html("<option> Cargando</option>");
			$.ajax({
				url: 'control/get_options.php',
				method: 'GET',
				data: {"formato":"html",
					"tabla":"grados",
					"id_col":"id_grados",
					"nombre_col":"nombre_grados",
					"filtro_campo":"id_niveles",
					"filtro_valor":id_niveles,
					"campo_orden":"nombre_grados"
				}
		
			}).done(function(respuesta){
				$('#nuevo_id_grados').html(respuesta);
			});
		}
	});
	
	$('#nuevo_id_grados').change( function cargarGrados(){
		console.log("cargarGrados");
		var id_valor = $(this).val();
		var id_niveles = $('#nuevo_id_niveles').val();
		if( id_valor == ""){
				$('#nuevo_id_grupos').html("<option value=''> Escoge un nivel</option>");
		}
		else{ 
				$('#nuevo_id_grupos').html("<option> Cargando</option>");
			$.ajax({
				url: 'control/get_options.php',
				method: 'GET',
				data: {"formato":"html",
					"tabla":"grupos",
					"id_col":"id_grupos",
					"nombre_col":"nombre_grupos",
					"filtros": [{
							"campo": "id_grados",
							"operador": "=",
							"valor": id_valor
						},
						{
							"campo": "id_niveles",
							"operador": "=",
							"valor": id_niveles
						}],
					"campo_orden":"nombre_grupos"
				}
		
			}).done(function(respuesta){
				$('#nuevo_id_grupos').html(respuesta);
			});
		}
	});
	
	$("#form_nuevo_alumno").submit(function nuevoAlumno(evnt){
		evnt.preventDefault();
		var $formulario = $(this);
		var $modal = $formulario.find(".modal");
		var boton = $formulario.find(':submit');
		boton.prop('disabled',true);
		var icono = boton.find('.fa');
		icono.toggleClass('fa-spinner fa-spin fa-save');
		$.ajax({
			url: 'control/fila_insert.php',
			method: 'POST',
			data: {
				"tabla": "alumnos",
				"valores": $formulario.serializeArray()
			}
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				nuevo_id = respuesta.nuevo_id;	
				console.log("nuevo_id");
				console.log(nuevo_id);
				//insertar en inscripciones
				$.ajax({
					url: 'control/fila_insert.php',
					method: 'POST',
					data: {
						"tabla": "inscripciones",
						"valores": [
							{"name": "id_ciclos","value": $("#nuevo_id_ciclos").val()}, 
							{"name": "id_grupos","value": $("#nuevo_id_grupos").val()}, 
							{"name": "id_alumnos","value": nuevo_id}
						]
					}
					
				}).done(function(respuesta){
					var nombre_completo = $("#nombre_alumnos").val() +  $("#apellidop_alumnos").val()  + $("#apellidom_alumnos").val() ;
					console.log(nombre_completo);
					$("#buscar_alumnos").val(nombre_completo);
					$("#id_alumnos_span").html(nuevo_id);
					$("#id_alumnos").val(nuevo_id);
					$modal.modal("hide");
				});
				
			}else{
				alertify.error('Ha ocuurido un error');
				console.log(respuesta.mensaje);
			}
		}).fail(function(){
			alertify.error("Ocurrio un error");
		}).always(function(){
			icono.toggleClass('fa-spinner fa-spin fa-save');
			boton.prop('disabled',false);
		});
	});
	
	$(".ui-autocomplete-input").focus(function(e){
		
		$(this).select();
		
	});
	
});