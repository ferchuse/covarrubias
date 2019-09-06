$(document).ready(function(){
	
	$('#btn_exel').prop('disabled',true);
	$('#btn_imprimir').prop('disabled',true);
	
	$( "#nombre_alumnos" ).autocomplete({
		source: "control/search_json.php?tabla=alumnos&campo=nombre_alumnos&valor=nombre_alumnos&etiqueta=nombre_alumnos",
		minLength : 1,
		autoFocus: true,
		select: function( event, ui ) {
			$("#id_alumnos").val(ui.item.extras.id_alumnos);
		}
	});
	
	
	
	$("#form_pagos").submit(function buscar_pagos(event){
		event.preventDefault(); //evita enviar el formulario
		var id_alumnos = $('#id_alumnos').val();
		var formulario = $(this);
		
		console.log("buscar_pagos");
		var $boton =formulario.find(":submit");
		var $icono = $boton.find(".fa");
		$boton.prop("disabled", true);
		$icono.toggleClass("fa-save fa-spinner fa-spin");
		$.ajax({
			url:'control/lista_alumnos_pagos.php',
			method: 'GET',
			data: {tabla:'pagos', id_alumnos: $('#id_alumnos').val()}
		}).done(function(respuesta){
			$('#lista_p').html(respuesta);
			
			$("#btn_exel").click(function(){
				$('#exportar_exel').tableExport({
					type:'excel',
					tableName:'Reporte', 
					ignoreColumn: [4],
					escape:'false'
				});
				
			});
			$('#btn_imprimir').click(function(){
					window.print();
				});
					
		}).always(function(){
				$boton.prop("disabled", false);
				$icono.toggleClass("fa-save fa-spinner fa-spin");
				
				$('#btn_exel').prop('disabled',false);
				$('#btn_imprimir').prop('disabled',false);
		});
		
	});
	
});