$(document).ready(function(){
	
	
	dameFolioActual();
	
	$("#agregar_concepto" ).click(function agregarConcepto(){
		
		$(".fila_concepto").clone(true).appendTo("#div_conceptos");
		
	});
	
	
	$('.clave_unidad').change( function setNombreUnidad(event){
		var $nombre_unidad = $(this).find("option:selected").text(); 
		$(this).closest(".row").find(".nombre_unidades").val($nombre_unidad);
		console.log("$nombre_unidad" + $nombre_unidad);
	});
	
	$('.btn_borrar').click( function borrarConcepto(){
		console.log("borrar");
		if($("#div_conceptos .row").length > 1){
			var boton = $(this);
			var icono = boton.find('.fa');
			
			var fila = boton.closest('.row');
			
			
			fila.fadeOut(1000);
			fila.remove();
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
	
	$( ".precio_unitario" ).keyup( function calcularImporte(){
		var precio_unitario = Number($(this).val());
		var cantidad = Number($(this).closest(".row").find(".cantidad").val());
		var importe = precio_unitario * cantidad;
		
		console.log("precio_unitario: " + precio_unitario);
		console.log("cantidad: " + cantidad);
		console.log("importe: " + importe);
		
		$(this).closest(".row").find(".importe").val(importe.toFixed(2));
		$("#subtotal").val(importe.toFixed(2));
		$("#total").val(importe.toFixed(2));
		
	});
	
	$( ".descuento" ).keyup( function calcularDescuento(){
		var descuento = Number($(this).val());
		var importe = Number($(this).closest(".row").find(".importe").val());
		var total = importe - descuento;
		
		
		$("#descuento").val(descuento);
		$("#total").val(total.toFixed(2));
		
	});
	
	$( "#nombre_alumnos" ).autocomplete({
		source: "control/search_json.php?tabla=alumnos&campo=nombre_alumnos&valor=nombre_alumnos&etiqueta=nombre_alumnos",
		minLength : 2,
		autoFocus: true,
		select: function seleccionaAlumno( event, ui ) {
			
			$("#curp").val(ui.item.extras.curp_alumnos);
			$("#id_alumnos").val(ui.item.extras.id_alumnos);
			var id_alumnos = ui.item.extras.id_alumnos;
			
			//se busca el nivel en el que esta inscrito actualmente
			$.ajax({
				url: "control/busqueda_avanzada.php",
				method: "POST",
				data:{  
					tabla_principal: "inscripciones",
					joins:[
						{tabla: "grupos" , using : "id_grupos"},
						{tabla: "niveles" , using : "id_niveles"},
						{tabla: "grados" , using : "id_grados"},
						{tabla: "alumnos" , using : "id_alumnos"},
						{tabla: "clientes" , using : "id_clientes"}
					],
					filtros:[ 
						{campo:"id_alumnos" ,  operador:"=" , valor:id_alumnos},
						{campo:"activa" ,  operador:"=" , valor:1}
					]
					
				}
				
				}).done( function afterCargarNiveles(respuesta){
				
				$("#paso1 .next" ).prop("disabled", false);
				$("#nivel").val(respuesta.fila[0].nombre_grados + " " + respuesta.fila[0].nombre_niveles);
				$("#id_clientes").val(respuesta.fila[0].id_clientes);
				$("#razon_social_clientes").val(respuesta.fila[0].razon_social_clientes);
				$("#rfc_clientes").val(respuesta.fila[0].rfc_clientes);
				$("#correo_clientes").val(respuesta.fila[0].correo_clientes);
				
				if(!respuesta.fila[0].id_clientes){
					console.log("No hay datos de facturacion");
					
				}
				$(".nav-pills .active").next().removeClass("disabled");
				
				$.ajax({
					url: "control/lista_pagos_facturar.php",
					method: "GET",
					data: {id_alumnos : id_alumnos}
					
					}).done( function afterCargarPagos(respuesta){
					$("#pagos_facturar").html(respuesta);
					
					$( ".sumar_checked" ).change(calculaTotal);	
					
				});
			});
			
			
		}
	});	
	
	function validarPaso($paso){
		
		return true;
	}
	
	$("#paso1 .next" ).click(function(){
		
		if($("#curp").val().trim() == ''){
			// $("#curp").prev().append("<span class='text-danger'>Ingresa una CURP</span>");
			// console.log("completar campos");
			alertify.error("Ingresa la CURP");
			
			
			return false;
		}
		
		//actualizar alumno
		$("#tab_cliente").tab("show");
	});
	
	
	$("#datos_cliente .next" ).click(  function clienteNext(){
		var boton = $(this);
		var icono = $(this).find(".fa");
		
		if($("#rfc_clientes").val().trim() == ''){
			
			alertify.error("Ingresa el RFC");
			
			return false;
		}
		//Si no existe cliente insertar sino actualizar
		icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
		boton.prop('disabled',true);
		if($("#id_clientes").val() == ""){
			
			$.ajax({
				url: 'control/fila_insert.php',
				method: 'POST',
				data: {
					"tabla": "clientes",
					"valores": [
						{name: "razon_social_clientes", value: $("#razon_social_clientes").val()},
						{name: "rfc_clientes", value: $("#rfc_clientes").val()},
						{name: "correo_clientes", value: $("#correo_clientes").val()}
					]
				}
				}).done(function(respuesta){
				if(respuesta["estatus"] == "success"){
					$("#id_clientes").val(respuesta["nuevo_id"]);	
					actualizaClienteAlumno(respuesta["nuevo_id"], $("#id_alumnos").val()).done(function(respuesta){
						if(respuesta.estatus == "success"){
							$("#tab_factura").tab("show");
							$('#tab_factura').closest("li").removeClass("disabled");
						}
						}).fail(function(xhr, error, errnum){
						
						
						}).always(function(){
						icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
						boton.prop('disabled',false);
						
					});
					}else{
					alertify.error('Error' + respuesta["mensaje"]);
					
				}
				}).fail(function(xhr, error, errnum){
				alertify.error("Error" + error);
				}).always(function(){
				
			});
			
		}
		else{
			
			actualizaClienteAlumno($("#id_clientes").val(), $("#id_alumnos").val()).done(function(respuesta){
				if(respuesta.estatus == "success"){
					$("#tab_factura").tab("show");
					$('#tab_factura').closest("li").removeClass("disabled");
				}
				}).fail(function(xhr, error, errnum){
				
				
				}).always(function(){
				icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
				boton.prop('disabled',false);
			});
			
			
			// $.ajax({
			// url: 'control/fila_update.php',
			// method: 'POST',
			// data: {
			// "tabla": "clientes",
			// "valores": $formulario.serializeArray(),
			// "id_campo": "id_clientes",
			// "id_valor": $("#id_clientes").val()
			// }
			// }).done(function(respuesta){
			// if(respuesta["estatus"] == "success"){
			// $("#tab_factura").tab("show");			
			// }else{
			// alertify.error('Error' + respuesta["mensaje"]);
			
			// }
			// }).fail(function(xhr, error, errnum){
			// alertify.error("Error" + error);
			// }).always(function(){
			// icono.toggleClass('fa-save fa-spinner fa-spin ');
			// boton.prop('disabled',false);
			// $formulario[0].reset();
			// });
			
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
	
	$("#razon_social_clientes" ).autocomplete({
		source: "control/search_json.php?tabla=clientes&campo=razon_social_clientes&valor=razon_social_clientes&etiqueta=razon_social_clientes",
		minLength : 2,
		autoFocus: true,
		select: function( event, ui ) {
			$("#id_clientes").val(ui.item.extras.id_clientes);
			
			$.each(ui.item.extras, function(key, value){
				$("#" + key).val(value);
			});
		}
	});
	
	
	
	
	$('#form_factura').submit( facturar);
	
	
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
	// console.log("event");
	// console.log(event);
	// console.log("********");
	var termina_facturar = $.Deferred;
	
	$boton = $("#btn_facturar");
	$icono = $boton.find('.fa');
	
	$boton.prop('disabled',true);	
	$icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
	
	//timbrado
	$.ajax({
		url: 'facturacion/facturar.php',
		method: 'POST',
		data: 
		$('#form_factura').serialize()
		
		}).done(function(respuesta){
		if(respuesta["timbrado"]["codigo_mf_numero"] == 0){
			
			//generar pdf
			$.ajax({
				url: 'facturacion/generar_pdf.php',
				method: 'GET',
				data: 
				{id_facturas :respuesta["id_facturas"]}
				
				}).done(function(respuesta){
				console.log(respuesta);
				
				
				$.ajax({
					url: 'facturacion/enviar_factura.php',
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
					alertify.error("Error" + error);
					
					}).always(function(){
					$boton.prop('disabled',false);
					$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
					alertify.success("Factura Enviada Correctamente");
					window.location.href = "facturas.php";
					
				});
				
				
				}).fail(function(xhr, error, errnum){
				alertify.error("Error" + error);
				$boton.prop('disabled',false);
				$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
				}).always(function(){
				
			});
			
			}else{
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
	
	var subtotal = 0;
	var descuento_total = 0;
	var recargos = 0;
	var total = 0; 
	
	var importe = $(this).data("importe");
	var descripcion = $(this).data("descripcion");
	var descuento = $(this).data("descuento");
	var recargos = $(this).data("recargos");
	
	
	if($(this).prop("checked")){
		$(this).closest("label").find(".importe").prop("disabled", false);
		$(this).closest("label").find(".descripcion").prop("disabled", false);
		$(this).closest("label").find(".descuento").prop("disabled", false);
		$(this).closest("label").find(".recargos").prop("disabled", false);
		
		$(this).closest("label").find(".importe").val(importe);
		$(this).closest("label").find(".descripcion").val(descripcion);
		$(this).closest("label").find(".descuento").val(descuento);
		$(this).closest("label").find(".recargos").val(recargos);
	}
	else{
		$(this).closest("label").find(".importe").prop("disabled", true);
		$(this).closest("label").find(".descripcion").prop("disabled", true);
		$(this).closest("label").find(".descuento").prop("disabled", true);
		$(this).closest("label").find(".recargos").prop("disabled", true);
	}
	
	$('.sumar_checked:checked').each(function(indice, elemento){
		// var importe = Number($(elemento).data('importe'));
		subtotal+= Number($(elemento).data('importe'));
		descuento_total += Number($(elemento).data('descuento'));
		
	});
	
	if($('.sumar_checked:checked').length == 0){
		$("#btn_facturar").prop("disabled", true);
	}
	else{
		$("#btn_facturar").prop("disabled", false);
	}
	
	var total = subtotal - descuento_total;
	// console.log("porcentaje");
	// console.log(porcentaje);
	// console.log("subtotal");
	// console.log(subtotal);
	// console.log("descuento");
	// console.log(descuento);
	// console.log("recargo");
	// console.log(recargos);
	
	//$("#subtotal").val(subtotal.toFixed(2));
	//$('#descuento').val(descuento_total.toFixed(2));
	//$('#total').val(total.toFixed(2));
	
	// $('#form_nuevo_pago').find(":submit").prop("disabled", false);
}

function actualizaClienteAlumno(id_clientes, id_alumnos){
	console.log("actualizaClienteAlumno"+ id_clientes + "" +id_alumnos );
	return $.ajax({
		url: 'control/fila_update.php',
		method: 'POST',
		data: {
			"tabla": "alumnos",
			"valores": [
				{name: "id_clientes", value: id_clientes}
			],
			"id_campo": "id_alumnos",
			"id_valor": id_alumnos
		}
	});
}


