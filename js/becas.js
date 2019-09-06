$(document).ready(function(){
	//MODAL
	$('#btn-altaBecas').click(function(){
		$('#form_nuevo_beca')[0].reset();
		$('#modal_nuevo_beca').modal('show');
		console.log("modal_alta_beca");
	});
	//FIN DEL MODAL
	//GUARDAR CICLO ESCOLAR
	$('#form_nuevo_beca').submit(function guardar_beca(event){
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
			data:{tabla: 'descuentos', datos: formulario.serializeArray()}
			}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				alertify.success('Se ha agregado correcta');
				$('#modal_nuevo_beca').modal('hide');
				listarBecas();
				}else{
				alertify.error('Ha ocurrido un error');
				console.log(respuesta.mensaje);
			}
			}).always(function(){
       			
			
			icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
			boton.prop('disabled',false);
		});
		
	});
	//FIN DE GUARDAR CICLO ESCOLAR
	//ENLISTADO 
	function listarBecas(){
		return $.ajax({
			url: 'control/listar_becas.php',
			method: 'POST',
			dataType: 'HTML',
			}).done(function(respuesta){
			$('#listar_becas').html(respuesta);
			
			//--------EDITAR BECAS----------
			$('.btn_editar').click(function(){
				$('#form_nuevo_beca')[0].reset();
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
				var id_descuentos = boton.data('id_descuentos');
				$.ajax({
					url: 'control/buscar_normal.php',
					method: 'POST',
					dataType: 'JSON',
					data:{campo: 'id_descuentos', tabla:'descuentos', id_campo: id_descuentos}
					}).done(function(respuesta){  
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"], function(name, value){	
							
							$("#"+name).val(value);
						});
						$('#modal_nuevo_beca').modal('show');
					}
					icono.toggleClass('fa-pencil fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
				});
				
			});
			
			//ELIMINAR
			$('.btn_eliminar').click(function(){
				var boton = $(this);
				var icono = boton.find('.fa');
				boton.prop('disabled',true);
				icono.toggleClass('fa-trash fa-spinner fa-spin fa-floppy-o');
				var fila = boton.closest('tr');
				var id_descuentos = boton.data('id_descuentos');
				var eliminar = function(){
					$.ajax({
						url: 'control/eliminar_normal.php',
						method: 'POST',
						dataType: 'JSON',
						data: {campo: 'id_descuentos', tabla:'descuentos', id_campo: id_descuentos}
						
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
	listarBecas();
	//FIN DEL ENLISTADO
	
	$('#btn-calcBecas').click(function(){
		$('#modal_calcular_beca').modal('show');
		$('#beca')[0].reset();
	});
	$('#cant_pagar').keyup(function(){
		var cantidadPagar = $(this).val();
		var costoPagar = $('#costo_pagar').val();
		$('#porc_pagar').val(calcularBeca(cantidadPagar,costoPagar)+'%');
	});
	$('#cant_pagar').change(function(){
		var cantidadPagar = $(this).val();
		var costoPagar = $('#costo_pagar').val();
		$('#porc_pagar').val(calcularBeca(cantidadPagar,costoPagar)+'%');
	});
	
	function calcularBeca(cantidad,costo){
		var resultado = 100-(cantidad * 100)/costo;
		
		return Math.round(resultado);
	}
});