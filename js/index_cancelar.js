$(document).ready(function(){
	
	
	$('.btn-cancelar').click(function cancelar(event) {
		event.preventDefault();
		var boton = $(this);
		boton.prop('disabled', true);
		icono = boton.find(".fa");
		
		var id_pagos = boton.data('id_pagos');
		var fila = boton.closest('tr');
		function cancelar(evet,value) {
			$.ajax({
				url: 'control/cancelar_pago.php',
				method: 'POST',
				data:{
					motivo: value,
					id_pagos: id_pagos,
					id_usuarios: $("#id_usuarios").val()
				}
				}).done(function(respuesta){
				alertify.success("Se ha cancelado el pago"); 
				window.location.reload();//cargar la paguina;
				icono.toggleClass("fa-times fa-spinner fa-spin");
				boton.prop('disabled', false);
			});
		}
		alertify.prompt('Confirmacion', '¿Deseas cancelarlo?','Escribe el motivo', cancelar, function () {
			// icono.toggleClass("fa-times fa-spinner fa-spin");
			boton.prop('disabled', false);
		});
		
	});
	$('.btn-cancela').click(function cancela(event) {
		event.preventDefault();
		var boton = $(this);
		boton.prop('disabled', true);
		icono = boton.find(".fa");
		
		var id_egresos = boton.data('id_egresos');
		var fila = boton.closest('tr');
		function cancela(evet,value) {
			$.ajax({
				url: 'control/fila_update.php',
				method: 'POST',
				data:{
					tabla: 'egresos',
					id_campo: 'id_egresos',
					id_valor: id_egresos,
					valores: [
						{
							name: 'motivoCancelacion_egresos',
							value: value
						},
						{
							name: 'estatus_egresos',
							value: 'CANCELADO'
						}
					]
				}
				}).done(function(respuesta){
				alertify.success("Se ha cancelado el egreso"); 
				window.location.reload();//cargar la paguina;
				icono.toggleClass("fa-times fa-spinner fa-spin");
				boton.prop('disabled', false);
			});
		}
		alertify.prompt('Confirmacion', '¿Deseas cancelarlo?','Escribe el motivo', cancela, function () {
			// icono.toggleClass("fa-times fa-spinner fa-spin");
			boton.prop('disabled', false);
		});
		
	});
	$('#btn_ingresos').click(function(){
		if($('#panel_ingresos').hasClass("hidden-print")){
			$('#panel_ingresos').removeClass("hidden-print");
			$('#panel_egresos').addClass("hidden-print");
			}else{
			$('#panel_egresos').addClass("hidden-print");
			window.print();
		}
		
	});
	$('#btn_egresos').click(function(){
		if($('#panel_egresos').hasClass("hidden-print")){
			$('#panel_egresos').removeClass("hidden-print");
			$('#panel_ingresos').addClass("hidden-print");
			}else{
			$('#panel_ingresos').addClass("hidden-print");
			window.print();
		}
	});
});