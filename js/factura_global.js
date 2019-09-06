


$(document).ready(function(){
	
	
	dameFolioActual();
	
	
	$('#form_factura').submit( facturar);
	
	
	$('#form_fechas').submit(buscarPagos );
	$('#buscar_fechas').click();
});

function buscarPagos(event){
	
	event.preventDefault(); 
	var $formulario = $(this);
	var $modal = $formulario.find(".modal");
	var boton = $formulario.find(':submit');
	boton.prop('disabled',true);
	var icono = boton.find('.fa');
	icono.toggleClass('fa-search fa-spinner fa-spin ');
	
	$.ajax({
		url: 'control/lista_factura_global.php',
		method: 'GET',
		data: $formulario.serialize()
		
		}).done(function(respuesta){
		$("#lista_pagos").html(respuesta);
		}).fail(function(xhr, error, errnum){
		alertify.error("Error" + error);
		}).always(function(){
		icono.toggleClass('fa-search fa-spinner fa-spin ');
		boton.prop('disabled',false);
		
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
		
		}).fail(function(xhr, error, ernum){
		
		
	}).always();
}

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
	
	//Timbrado
	
	$("#mensaje_timbrado").toggleClass('hidden');	
	
	$.ajax({
		url: 'facturacion/facturar_global.php',
		method: 'POST',
		data: 
		$('#form_factura').serialize() + "&" + $('#form_fechas').serialize()
		
		}).done(function(respuesta){
		if(respuesta["timbrado"]["codigo_mf_numero"] == 0){
			
			$("#mensaje_timbrado").find(".fa").toggleClass('fa-spinner fa-spin fa-check');	
			$("#mensaje_pdf").toggleClass('hidden');	
			
			//generar pdf
			$.ajax({
				url: 'facturacion/generar_pdf.php',
				method: 'GET',
				data: 
				{id_facturas :respuesta["id_facturas"]}
				
				}).done(function(respuesta){
				console.log(respuesta);
				
				//enviar_factura
				// if($("#enviar_correo").prop("checked")){
				$("#mensaje_pdf").find(".fa").toggleClass('fa-spinner fa-spin fa-check');	
				$("#mensaje_correo").toggleClass('hidden');	
				
				window.location.href = "facturas.php";
				$boton.prop('disabled',false);
				$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
				
				
				
				}).fail(function(xhr, error, errnum){
				alertify.error("Error" + error);
				$boton.prop('disabled',false);
				$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
				}).always(function(){
				
			});
			
			}else{
			$("#mensaje_error").removeClass("hidden");
			$("#mensaje_error").html(respuesta["timbrado"]["codigo_mf_texto"]) ;
			$("#mensaje_timbrado").toggleClass('alert-success alert-danger');	
			$("#mensaje_timbrado").find(".fa").toggleClass('fa-spinner fa-spin fa-times');	
			
		}
		}).fail(function(xhr, error, errnum){
		alertify.error("Error" + error);
		$boton.prop('disabled',false);
		$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
		}).always(function(){
		$boton.prop('disabled',false);
		$icono.toggleClass('fa-arrow-right fa-spinner fa-spin');
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
	
}




