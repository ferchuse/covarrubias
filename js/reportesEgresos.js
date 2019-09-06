$(document).ready(function(){
	
			
			//--------BOTON DE BUSCAR-------
			$('#form_reporte').submit(function(event){
				
				event.preventDefault();
		
				$('#reportes').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
				var boton = $(this);
				var icono = boton.find('.fa');
				icono.toggleClass('fa-search fa-spinner fa-spin fa-floppy-o');
				boton.prop('disabled',true);
				var desde = $('#desde_fecha').val();
				var hasta = $('#hasta_fecha').val();
				$.ajax({
					url: 'control/reportesEgresos.php',
					method: 'POST',
					dataType: 'HTML',
					data: {desde:desde, hasta:hasta}
				}).done(function(respuesta){
					icono.toggleClass('fa-search fa-spinner fa-spin fa-floppy-o');
					boton.prop('disabled',false);
					$('#reportes').html(respuesta);
				});
	});
			
		
});