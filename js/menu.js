 function dameFolios(){
		console.log("dameFolios");
		return $.ajax({
			url: 'control/fila_select.php',
			method: 'GET',
			data: {
				"tabla" : "emisores",
				"id_campo" : "id_emisores",
				"id_valor" : 1,
				
				
			}
		});
	}


$(document).ready(function(){
	
	
/* $( "#buscar_cliente" ).autocomplete({
		source: "control/search_json.php?tabla=alumnos&campo=nombre_alumnos&valor=nombre_alumnos&etiqueta=nombre_alumnos",
		minLength : 1,
		autoFocus: true,
		select: function( event, ui ) {
			//$(this).closest("form").submit();
			$("#id_buscar_cliente").val(ui.item.extras.id_cliente);
		//	$("#num_expediente").val(ui.item.extras.num_exp);
		//	console.log(ui.item.extras.id_paciente);
			
		}
	});	
	 */
	 
	 // $.ajax({
			// url: 'control/checar_vencidos.php',
			// method: 'GET'
	 // }).done(function(respuesta){
		// console.log(respuesta);
	 // });
	 
		$("#span_folios_restantes").html("<i class='fa fa-spinner fa-spin'></i>");
		dameFolios().done(function(respuesta){
			 if(respuesta["encontrado"] == 1){
					
					$("#span_folios_restantes").html(respuesta["data"]["folios_restantes_emisores"]);
					$("#folios_restantes_emisores").val(respuesta["data"]["folios_restantes_emisores"]);
			}else{
				// alertify.error('Error' + respuesta["codigo_mf_texto"]);
				
			}
		}).fail(function(xhr, error, errnum){
			alertify.error("Error" + error);
		}).always(function(){
			//icono.toggleClass('fa-arrow-right fa-spinner fa-spin ');
			
			//boton.prop('disabled',false);
		});
		 
	 
	
});

