$(document).ready(function(){
	console.log("ready()")
	
	dameFolioActual();
	
	$("#fecha_final").change(antiguedad);
	$('#form_conceptos').keydown(function(event){
		if(event.which == 13){
			return false;
		}
	});  
	
	$(".tipo_otro_pago").change(function(){
		console.log("change_  tipo_otro_pago");
		if($(this).val() == '002'){
			
			console.log("con subsidio")
			$(this).closest(".row").find(".subsidio_causado").prop("disabled", false);
		}
		else{
			console.log("sin subsdio")
			$(this).closest(".row").find(".subsidio_causado").prop("disabled", false);
		}
	});
	
	$(".id_percepcion, .id_deduccion, .tipo_otro_pago" ).change(function(){
		
		console.log("change Concepto()")
		var concepto = $(this).find("option:selected").text()
		console.log("selected", concepto);
		$(this).closest(".row").find(".concepto").val(concepto) 
		
	});
	
	$(".gravado, .excento, .importe_deduccion, .otro_pago" ).keyup(calculaTotal);
	
	$("#agregar_deduccion" ).click(function agregarConcepto(){
		$(".fila_deduccion:first").clone(true).appendTo("#div_deducciones");
		calculaTotal();
	}); 
	
	$("#agregar_percepcion" ).click(function agregarConcepto(){
		$(".fila_percepcion:first").clone(true).appendTo("#div_percepciones");
		calculaTotal();
	});
	
	$("#agregar_otros_pagos" ).click(function agregarConcepto(){
		$(".fila_otros_pagos:first").clone(true).appendTo("#div_otros_pagos");
		calculaTotal();
	});
	
	$('.btn_borrar').click( function borrarConcepto(){
		console.log("borrar");
		if($(this).closest(".contenedor").find(".row").length > 1){
			var boton = $(this);
			var fila = boton.closest('.row');
			
			fila.fadeOut(1000);
			fila.remove();
			calculaTotal();
		}
		else{
			alertify.error("Debe haber al menos un concepto");
		}
	});	
	
	$( "#check_agregar_conceptos" ).change( function activarConceptos(){
		var activar = $(this).prop("checked");
		$("#btn_facturar").prop("disabled", !activar );
		
		console.log("activar" + activar);
		$(".conceptos").each(function(index, element){
			$(element).prop("disabled", !activar );
			
		});	
	});	
	
	
	
	$( ".descuento" ).keyup( function calcularDescuento(){
		var descuento = Number($(this).val());
		var importe = Number($(this).closest(".row").find(".importe").val());
		var total = importe - descuento;
		
		
		$("#descuento").val(descuento);
		$("#total").val(total.toFixed(2));
		
	});
	
	$( "#nombre_empleados" ).autocomplete({
		source: "control/search_json.php?tabla=alumnos&campo=nombre_alumnos&valor=nombre_alumnos&etiqueta=nombre_alumnos",
		minLength : 2,
		autoFocus: true,
		select: function seleccionaAlumno( event, ui ) {
			
			$("#id_empleados").val(ui.item.extras.id_empleados);
			$("#curp_empleados").val(ui.item.extras.curp_empleados);
			$("#rfc_empleados").val(ui.item.extras.rfc_empleados);
			
			$("#nss").val(ui.item.extras.nss);
			
			
			
		}
	});	
	
	function validarPaso($paso){
		
		return true;
	}
	
	$("#id_empleados").keydown(buscarEmpleado);
	$("#id_empleados").blur(buscarEmpleado);
	
	
	function buscarEmpleado(event){
		console.log("buscarEmpleado");
		
		if(event.which == 13){
			console.log("Enter");
			$("#id_empleados").addClass("ui-autocomplete-loading");
			
			
			$.ajax({
				url: 'control/buscar_normal.php',
				method: 'POST',
				dataType: 'JSON',
				data: {
					campo: 'id_empleados',
					tabla: 'empleados',
					id_campo: $("#id_empleados").val()
				}
				}).done(function(respuesta) {
				if (respuesta.encontrado == 1) {
					$.each(respuesta["fila"], function(name, value) {
						$("#" + name).val(value);
					});
				}
				
				}).fail(function(xhr, error, errnum){
				alertify.error(error);
				
				}).always(function() {
				
				$("#id_empleados").removeClass("ui-autocomplete-loading");
				
			});
			
		}
		
		
	}
	
	
	$("#paso1 .next" ).click(  function guardarEmpleados(){
		var boton = $(this);
		var icono = $(this).find(".fa");
		
		if($("#rfc_empleados").val().trim() == ''){
			
			alertify.error("Ingresa el RFC");
			
			return false;
		}
		
		if($("#id_empleados").val() != ""){
			
			icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
			boton.prop('disabled',true);
			
			$.ajax({
				url: 'control/guardar_empleados.php',
				method: 'POST',
				data: {
					"tabla": "empleados",
					"valores": $("#form_empleados").serializeArray()
				}
				}).done(function(respuesta){
				if(respuesta["estatus"] == "success"){
					$("#id_clientes").val(respuesta["nuevo_id"]);	
					
					
					$("#tab_factura").tab("show");
					$('#tab_factura').closest("li").removeClass("disabled");
					
					
					
				}
				else{
					alertify.error('Error' + respuesta["mensaje"]);
					
				}
				}).fail(function(xhr, error, errnum){
				alertify.error("Error" + error);
				}).always(function(){
				icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
				boton.prop('disabled',false);
			});
			
		}
		else{
			
			alertify.error("Ingresa una clave ");
			
			
		}
		
		
	});
	
	$("#datos_factura .next" ).click(function(){
		
		
		//actualizar alumno
		$("#tab_conceptos").tab("show");
	});
	
	$(".anterior").click(function(){
		// var tabs = $(".nav-pills a");
		var index_activo = $(".nav-pills .active").index();
		
		var index_anterior = index_activo - 1;
		$(".nav-pills a").eq(index_anterior).tab("show");
		
		
		console.log("pils");
		console.log($(".nav-pills li"));
		
		console.log("index_activo");
		console.log(index_activo);	
		console.log("index_anterior");
		console.log(index_anterior);
	});
	
	// $(".siguiente").click(function(){
	// var index_activo = $(".nav-pills .active").index();
	
	// var index_siguiente = index_activo + 1;
	// $(".nav-pills a").eq(index_siguiente).tab("show");
	
	// });
	
	// $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	// e.target // newly activated tab
	// e.relatedTarget // previous active tab
	// })
	
	
	
	
	
	$('#form_conceptos').submit( facturar);
	
	
	$('#form_clientes').submit( function nuevoCliente(event){
		
		event.preventDefault();
		var $formulario = $(this);
		var $modal = $formulario.find(".modal");
		var boton = $formulario.find(':submit');
		boton.prop('disabled',true);
		var icono = boton.find('.fa');
		icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
		
		$.ajax({
			url: 'control/fila_insert.php',
			method: 'POST',
			data: {
				"tabla": "clientes",
				"valores": $formulario.serializeArray()
			}
			}).done(function(respuesta){
			if(respuesta["estatus"] == "success"){
				alertify.success('Cliente Guardado');
				$("#id_clientes").val(respuesta["nuevo_id"]);
				$("#rfc_clientes").val($("#nuevo_rfc").val());
				$("#razon_social_clientes").val($("#nuevo_razon_social").val());
				$("#correo_clientes").val($("#nuevo_correo").val());
				$modal.modal("hide");				
				}else{
				alertify.error('Error' + respuesta["mensaje"]);
				
			}
			}).fail(function(xhr, error, errnum){
			alertify.error("Error" + error);
			}).always(function(){
			icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
			boton.prop('disabled',false);
			$formulario[0].reset();
		});
		
	});
	
	function restarFolios(){
		
		return $.ajax({
			url: 'control/fila_update.php',
			method: 'POST',
			data: {
				"tabla" : "emisores",
				"id_campo" : "id_emisores",
				"id_valor" : 1,
				"valores" : [
					{
						"name" : "folios_restantes_emisores",
						"value" : 	$("#folios_restantes_emisores").val() - 1
					}
				]
				
			}
		});
	}
	
	function dameFolioActual(){
		$("#folio_actual").toggleClass("ui-autocomplete-loading");
		return $.ajax({
			url: 'control/fila_select.php',
			method: 'GET',
			data: {
				"tabla" : "emisores",
				"id_campo" : "id_emisores",
				"id_valor" : 1,
			}
			}).done(function(respuesta){
			var serie = extraerNumeros(respuesta["data"]["serie_actual_emisores"])
			$("#serie").val(serie.letras);
			$("#folio").val(serie.numeros);
			$("#folio_actual").val(serie.letras +serie.numeros );
			$("#folio_actual").toggleClass("ui-autocomplete-loading");
			
		}).fail().always();
	}
	
	
});


function extraerNumeros(string){
	var $numeros = "";
	var $letras = "";
	var serie = {};
	
	for(i = 0; i < string.length ; i++){
		if(!isNaN(string[i])){
			$numeros+= string[i];
		}
		else{
			$letras+= string[i];
		}
		
	}
	
	serie["letras"] = $letras;
	serie["numeros"] = $numeros;
	console.log(serie);
	return serie;
}



function facturar(event){
	event.preventDefault();
	
	var termina_facturar = $.Deferred;
	
	$boton = $("#btn_facturar");
	$icono = $boton.find('.fa');
	
	$boton.prop('disabled',true);	
	$icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
	
	$("#mensaje_error").text("");
	$("#mensaje_error").hide();
	
	//timbrado
	$.ajax({
		url: 'facturacion/timbrar_nomina.php',
		dataType: 'JSON',
		method: 'POST',
		data: 		
		$('#form_empleados').serialize() + "&"+
		$('#form_nomina').serialize() + "&"+
		$('#form_conceptos').serialize() 
		
		}).done(function(respuesta){
		if(respuesta["timbrado"]["codigo_mf_numero"] == 0){
			// descontarTimbre();
			alertify.success("Timbrado Correctamente, generando PDF");
			//generar pdf
			$.ajax({
				url: 'facturacion/generar_pdf_nomina.php',
				dataType: 'JSON',
				method: 'GET',
				data: 
				{
					id_nominas :respuesta["id_nominas"],
					folio_nomina : $("#folio_nomina").val()
					
				}
				}).done(function(respuesta){
				console.log(respuesta);
				$boton.prop('disabled',false);
				$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
				alertify.success("PDF Guardado");
				alertify.success("Enviando Correo");
				
				$.ajax({
					url: 'facturacion/enviar_factura.php',
					method: 'GET',
					data: 
					{
						url_pdf :respuesta["url_pdf"],
						url_xml :respuesta["url_xml"],
						correo :$("#correo_empleados").val()
						
					}
					
					}).done(function(respuesta){
					console.log(respuesta);
					alertify.success("Correo Enviado");
				
					window.location.href = "nominas.php";
				
					
					
					}).fail(function(xhr, error, errnum){
					alertify.error("Ocurrio un Error");
					
					}).always(function(){
					$boton.prop('disabled',false);
					$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
					// alertify.success("Factura Enviada Correctamente");
					// window.location.href = "facturas.php";
					
				});
				
				
				}).fail(function(xhr, error, errnum){
				alertify.error("Error" + error);
				$boton.prop('disabled',false);
				$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
				}).always(function(){
				
			});
			
		}
		else{
			
			$("#mensaje_error").show();
			$("#mensaje_error").text('Error' + respuesta["timbrado"]["codigo_mf_texto"]);
			alertify.error('Error' + respuesta["timbrado"]["codigo_mf_texto"]);
			$boton.prop('disabled',false);
			$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
		}
		}).fail(function(xhr, error, errnum){
		alertify.error("Error" + error);
		$boton.prop('disabled',false);
		$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
		}).always(function(){
		// icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
		// boton.prop('disabled',false);
		
	});
	
	
	return termina_facturar;
}


function calculaTotal(event){
	console.log("calculaTotal()");
	
	var total_percepciones = 0;
	var total_deducciones = 0;
	var total_gravado = 0;
	var total_excento = 0;
	var total_otros_pagos = 0;
	var subtotal = 0;
	var total = 0; 
	
	
	$('.gravado').each(function(indice, elemento){
		total_gravado+= Number($(elemento).val());
	});
	$('.excento').each(function(indice, elemento){
		total_excento+= Number($(elemento).val());
	});
	$('.importe_deduccion').each(function(indice, elemento){
		total_deducciones+= Number($(elemento).val());
	}); 
	$('.otro_pago').each(function(indice, elemento){
		total_otros_pagos+= Number($(elemento).val());
	}); 
	
	total_percepciones = total_excento + total_gravado;
	
	
	subtotal = total_percepciones  + total_otros_pagos;
	descuento = total_deducciones;
	total = subtotal - descuento;
	
	
	$("#total_gravado").val(total_gravado.toFixed(2));
	$("#total_excento").val(total_excento.toFixed(2));
	$("#total_percepciones").val(total_percepciones.toFixed(2));
	$("#total_deducciones").val(total_deducciones.toFixed(2));
	$("#total_otros_pagos").val(total_otros_pagos);
	$(".importe").val(subtotal.toFixed(2));
	$(".precio_unitario").val(subtotal.toFixed(2));
	$(".descuento").val(descuento.toFixed(2));
	
	$("#subtotal").val(subtotal.toFixed(2));
	$("#descuento").val(descuento.toFixed(2));
	$("#total_descuento").val(descuento.toFixed(2));
	$("#total").val(total.toFixed(2));
	
}


function descontarTimbre(){
	
	$.ajax({
		url: 'funciones/descontar_timbre.php',
		method: 'GET'
		}).done(function(respuesta){
		console.log(respuesta);
		
		
		
		}).fail(function(xhr, error, errnum){
		
		}).always(function(){
		
	});
	
}

function folio_nomina(){
	
	$.ajax({
		url: 'funciones/dame_folio.php',
		method: 'GET',
		data: 
		{
			url_pdf :respuesta["url_pdf"],
			url_xml :respuesta["url_xml"],
			correo :respuesta["datos_factura"]["correo_clientes"]
			
		}
		
		}).done(function(respuesta){
		console.log(respuesta);
		
		
		
		}).fail(function(xhr, error, errnum){
		alertify.error("Ocurrio un Error");
		
		}).always(function(){
		
	});
	
}
function antiguedad(){
	console.log("antiguedad");
	var fecha_inicial = new Date($("#fecha_inicio_laboral").val());
	var fecha_final = new Date($("#fecha_final").val());
	// var fecha_inicial = new Date('2009-08-24');
	// var fecha_final = new Date('2018-10-31');
	console.log("fecha_final", fecha_final);
	milliseconds = Math.abs(fecha_final-fecha_inicial);
	
	dias = (milliseconds + (1000*60*60*24))/ (1000*60*60*24);
	semanas = (milliseconds + (1000*60*60*24))/ (1000*60*60*24*7);
	
	console.log("Semanas", "P"+ Math.floor(semanas)+ "W");
	console.log("Dias", ""+ dias);
	console.log("typeof", ""+ typeof(dias));
	
	if($("#tipo_contrato").val() == '09'){
		$("#antiguedad").val("");
	}
	else{
		$("#antiguedad").val("P"+ Math.floor(semanas) + "W");
	}
	
}


