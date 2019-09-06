$(document).ready(function(){
	
	$('#btn_exportar').prop('disabled',true);
	
	// $('#form_reporte').submit();
			
	$('#form_reporte').submit(function(event){
			
		event.preventDefault();

		$('#reportes').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
		var boton = $(this).find(":submit");
		var icono = boton.find('.fa');
		filtros = $(this).serialize();
		
		icono.toggleClass('fa-search fa-spinner fa-spin fa-floppy-o');
		boton.prop('disabled',true);
		
		$.ajax({
			url: 'control/reporte_colegiaturas.php',
			method: 'POST',
			dataType: 'HTML',
			data: filtros
		}).done(function(respuesta){
			icono.toggleClass('fa-search fa-spinner fa-spin fa-floppy-o');
			boton.prop('disabled',false);
			$('#reportes').html(respuesta);
			
			$("#btn_exportar").click(function(){

				$('#reportes_pagos').tableExport(
				{
					type:'excel',
					tableName:'Reporte', 
					ignoreColumn: [3],
					escape:'false'
				});
			});
		}).always(function(){
			$('#btn_exportar').prop('disabled',false);
		});
	});
});
