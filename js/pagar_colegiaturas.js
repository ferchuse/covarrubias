

function  calcularDescuento(subtotal, porcentaje){
	var descuento = 0;
	if($("#aplica_beca").prop("checked")){
		
		return subtotal * porcentaje / 100;
	}
	else{
		return 0;
	}
	
}

function calcularRecargos(subtotal){
	
	return subtotal * .1;
	
}

function calculaTotal(event){
	console.log("event", event.target.id);
	// console.log(event);
	
	var subtotal = 0;
	var recargos = 0;
	var total = 0; 
	var importe = $(this).data("importe");
	// var descripcion = $(this).data("descripcion");
	var descuento_porc = 0;
	var descuento = 0;
	var porc_beca = Number($("#id_descuentos option:selected").data("porc_beca"));
	var seleccionados = $('.sumar_checked:checked');
	var cant_seleccionados = seleccionados.length;
	var tipo_descuento =$("#id_descuentos option:selected").data("tipo_descuento");
	var cantidad_descuentos = Number($("#id_descuentos option:selected").data("cantidad_descuentos"));
	
	
	
	
	
	switch(event.target.id){
		
		case 'descuento': 
		console.log("Calcular descuento por monto");
		descuento = Number($("#descuento").val());
		// descuento_porc_ = (descuento / subtotal) * 100; 
		// $("#descuento_porc").val(descuento_porc);
		
		break;
		case 'descuento_porc': 
		console.log("Se calcula el descuento en base al porcentaje");
		descuento_porc = Number($("#descuento_porc").val());
		descuento = calcularDescuento(subtotal, descuento_porc);
		$("#descuento").val(Number(descuento));
		
		break;
		
		case 'aplica_beca': 
		console.log("Cambio de Beca");
		if($("#aplica_beca").prop("checked")){
			
			descuento_porc = Number($("#descuento_porc").val());
			descuento = calcularDescuento(subtotal, descuento_porc);
			$("#descuento").val(Number(descuento));
			
		}
		else{
			$("#descuento").val((0));
			$("#descuento_porc").val((0));
			
		}
		break;
		case 'sumar_checked': 
		console.log("Selecciona Mes");
		
		break;
		
		default: 
		console.log("default");
		descuento_porc = Number($("#descuento_porc").val());
		descuento = calcularDescuento(subtotal, descuento_porc);
		$("#descuento").val(Number(descuento));
		
		break;
	}
	
	//Si se ha seleccionado al menos 1 mes desbloquear boton
	if(cant_seleccionados > 0){
		$("#btn_pagar").prop("disabled", false);
	}
	else{
		$("#btn_pagar").prop("disabled", true);
	}
	$(".sumar_checked").each(function(indice, elemento){
		
		if($(this).prop("checked")){
			console.log("habilita descripcion")
			$(this).closest("label").find(".importe").prop("disabled", false);
			$(this).closest("label").find(".descripcion").prop("disabled", false);
			// $(this).closest("label").find(".importe").val(importe);
			// $(this).closest("label").find(".descripcion").val(descripcion);
		}
		else{
			$(this).closest("label").find(".importe").prop("disabled", true);
			$(this).closest("label").find(".descripcion").prop("disabled", true);
		}
		
	})
	
	//Obtiene el subtotal sumando los importes y los recargos
	seleccionados.each(function(indice, elemento){
		var importe = Number($(this).closest("label").find(".importe").val());
		subtotal+= importe;
		if($(elemento).data('vencido') == 1){
			recargos+= importe * .1;
		}
		if($("#aplica_beca").prop("checked")){
			if(tipo_descuento == "Monto"){
				descuento+= importe - cantidad_descuentos;
			}
			else{
				descuento+= importe * porc_beca / 100;
			}
		}
		else{
			descuento=0;
			
		}
		
	});
	
	subtotal+= recargos;
	
	if(cant_seleccionados < 5 ){
		$("#descuento_desc").val("");
		$("#descuento_porc").val(porc_beca);
		
		console.log("No hay descuento")
	}
	else {
		if(cant_seleccionados >= 5 && cant_seleccionados < 10){
			$("#descuento_desc").val("Pago Semestral");
			$("#descuento_porc").val(porc_beca + 4 );
			console.log("Descuento Pago Semestral")
			}else{
			if(cant_seleccionados >= 10){
				$("#descuento_desc").val("Pago Anual");
				$("#descuento_porc").val(porc_beca + 8 );
				console.log("Descuento Pago Anual")
			}
		}
	}
	
	// porc_beca = Number($("#porc_beca").val());
	
	
	
	// descuento_beca = calcularDescuento(subtotal, Number($("#porc_beca").val()));
	
	// var descuento_total = descuento_beca + descuento;
	// var recargo = calcularRecargos(subtotal - descuento);
	total = subtotal - descuento + recargos;
	// console.log("porcentaje");
	// console.log(porcentaje);
	console.log("subtotal");
	console.log(subtotal);
	console.log("descuento");
	console.log(descuento);
	console.log("cant_seleccionados");
	console.log(cant_seleccionados);
	
	$("#subtotal").val(subtotal.toFixed(2));
	$('#descuento').val(descuento.toFixed(2));
	$('#recargos').val(recargos.toFixed(2));
	$('#total_costos').val(total.toFixed(2));
	
}

function validaFecha(event){
	
	console.log("validaFecha");
	
	var fecha_actual = new Date();
	var fecha_pago = new Date($(this).val());
	
	mes_actual = fecha_actual.getMonth();
	mes_pago = fecha_pago.getMonth();
	
	console.log("mes_actual", mes_actual);
	console.log("mes_pago", mes_pago);
	
	if(mes_pago < mes_actual){
		
		alertify.error("La fecha debe ser del mes en curso");
		$(this).val(fecha_actual.toString('yyyy-MM-dd'));
		return false;
	}
}

$(document).ready(function(){
	console.log("ready");
	$( "#fecha_pagado" ).change(validaFecha);	
	$( ".sumar_checked" ).change(calculaTotal);	
	$( "#descuento" ).keyup(calculaTotal);	
	$( "#descuento_porc" ).keyup(calculaTotal);	
	$( "#aplica_beca" ).change(calculaTotal);	
	$( ".importe" ).keyup(calculaTotal);	
	
	
	$('#form_nuevo_pago').submit( function guardarPago(event){
		
		console.log("submitPago");
		event.preventDefault();
		
		if($('.sumar_checked:checked').length == 0 ){
			alertify.error("Elige al menos una opción");
			return false;
		}
		
		var $formulario = $(this);
		var id_alumnos = $('#id_alumnos').val();
		var boton = $formulario.find(':submit');
		boton.prop('disabled',true);
		var icono = boton.find('.fa');
		icono.toggleClass('fa-money fa-spinner fa-spin fa-floppy-o');
		$.ajax({
			url: 'control/guardar_pago_colegiaturas.php',
			method: 'POST',
			dataType: 'JSON',
			data: $formulario.serialize() + "&id_usuarios="+ $("#id_usuarios").val()
			}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Pago completado');
				window.location.href='imprimir_pago.php?folio_pago='+respuesta.id_pagos;
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
	
	
	
	$(".ui-autocomplete-input").focus(function(e){
		
		$(this).select();
		
	});
	
	$('#id_plan').change( function(){
		function cambiarPlan(){
			
			var id_plan = $('#id_plan option:selected').val();
			
			
			$.ajax({
				url: 'control/editar_planpagos.php',
				method: 'POST',
				dataType: 'JSON',
				data:{'id_alumnos': $("#id_alumnos").val(), 'id_plan':id_plan}
				}).done(function(respuesta){
				console.log(respuesta.estatus);
				cargarMeses();
				
			});
		}
		alertify.confirm('Confirmacion', 'Todos los pagos realizados anteriormente se eliminaran, ¿Desea cambiar el plan de pago?', cambiarPlan , function(){
			
		});
	});
	
	$('#id_descuentos').change(function(){
		function cambiarDescuento(){
			var costo_descuento = $('#id_descuentos option:selected').data('porc_beca'),
			id_descuento = $('#id_descuentos option:selected').val(),
			id_alumnos = parseInt($('#id_alumnos_span').text());
			console.log(id_alumnos);
			
			$.ajax({
				url: 'control/fila_update.php',
				method: 'POST',
				data:{
					tabla: 'alumnos',
					id_campo: 'id_alumnos',
					id_valor: id_alumnos,
					valores: [
						{
							name: 'id_descuentos',
							value: id_descuento
						}]
				}
				}).done(function(respuesta){
				if(respuesta.estatus == 'success'){
					alertify.success("Se ha cambiado"); 
					$('#descuento_porc').val(costo_descuento);
					
					}else{
					alertify.error('Ocurrio un error, intentelo mas tarde.');
				}
			});
		}
		alertify.confirm('Confirmacion', '¿Desea asignar una beca?', cambiarDescuento , function(){
			
		});
	});
	
	$('#id_ciclos').change(cargarMeses);
	
});


function cargarMeses(){
	console.log("cargarMeses()")
	$('#listarMeses').html("<div class='text-center'><i class='fa spinner_meses fa-spinner fa-spin fa-3x'></i></div>");
	
	$.ajax({
		url: 'control/lista_meses.php',
		method: 'POST',
		dataType: 'HTML',
		data: {
			id_alumnos: $("#id_alumnos").val(),
			id_ciclos: $("#id_ciclos").val()
		}
		}).done(function(respuesta){
		$('#listarMeses').html(respuesta);
		$( ".sumar_checked" ).change(calculaTotal);	
		$( ".importe" ).keyup(calculaTotal);	
		
	});
	
}