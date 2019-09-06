$(document).ready(function(){
	
	//-------DIRECCIONAR A CURP------------
	$('.direccion_curp').on('click',function(event){
		event.preventDefault();
		window.open('https://consultas.curp.gob.mx/CurpSP/inicio2_2.jsp');
	});
	$('#parentesco_padres').change(function(){
		var dato = $( "#parentesco_padres option:selected" ).val();
		if(dato == "OTRO"){
		$('#desparentesco_padres').removeAttr("readonly");
		}else{
			$('#desparentesco_padres').attr("readonly","readonly");
		}
	});
	


	//--------CARGAR GRADOS DE NIVELES-----
	$('#id_niveles').change( function cargarGrados(){
		console.log("cargarGrados");
		var id_niveles = $(this).val();
		if( id_niveles == ""){
				$('#id_grados').html("<option value=''> Escoge un nivel</option>");
		}
		else{
				$('#id_grados').html("<option> Cargando</option>");
			$.ajax({
				url: 'control/get_options.php',
				method: 'GET',
				data: {"formato":"html",
					"tabla":"grados",
					"id_col":"id_grados",
					"nombre_col":"nombre_grados",
					"filtro_campo":"id_niveles",
					"filtro_valor":id_niveles,
					"campo_orden":"nombre_grados"
				}
		
			}).done(function(respuesta){
				$('#id_grados').html(respuesta);
				
				
				
			});
			
			//Cargar Costos o Planes de Pago
			$('#id_costos').html("<option> Cargando</option>");
			$.ajax({
				url: 'control/get_options.php',
				method: 'GET',
				data: {"formato":"html",
					"tabla":"costos",
					"id_col":"id_costos",
					"nombre_col":"concepto_costos",
					"campo_orden":"concepto_costos",
					"filtros": [{
							"campo": "usa_meses",
							"operador": "=",
							"valor": '1'
					},
					{
							"campo": "id_niveles",
							"operador": "=",
							"valor": id_niveles
					},
					{
							"campo": "costos_activo",
							"operador": "=",
							"valor": 1
					}]
				}
		
			}).done(function(respuesta){
				$('#id_costos').html(respuesta);
			});
			
			
			
		}
	});
	
	//CARGAR GRUPOS DE GRADOS
	$('#id_grados').change(function(){
		console.log("cargarGrados");
		var id_valor = $(this).val();
		var id_niveles = $('#id_niveles').val();
		if( id_valor == ""){
				$('#id_grupos').html("<option value=''> Escoge un nivel</option>");
		}
		else{ 
				$('#grupos').html("<option> Cargando</option>");
			$.ajax({
				url: 'control/get_options.php',
				method: 'GET',
				data: {"formato":"html",
					"tabla":"grupos",
					"id_col":"id_grupos",
					"nombre_col":"nombre_grupos",
					"filtros": [{
							"campo": "id_grados",
							"operador": "=",
							"valor": id_valor
						},
						{
							"campo": "id_niveles",
							"operador": "=",
							"valor": id_niveles
						}],
					"campo_orden":"nombre_grupos"
				}
		
			}).done(function(respuesta){
				$('#id_grupos').html(respuesta);
			});
		}
	});

	
	//--------ALTA DE PREINSCRIPCION------
	$('#form_preinscripciones').submit(function(event){
		event.preventDefault();
		datos_formulario = $(this);
		var boton = datos_formulario.find(':submit');
		var icono = boton.find('.fa');
		boton.prop('disabled',true);
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		
		var datos = datos_formulario.serialize();
		
		$.ajax({
			url: 'control/alta_alumnos.php',
			method: 'POST',
			dataType: 'JSON',
			data: datos
		}).done(function(respuesta){
			if(respuesta.estatusAlumno == "success"){
				console.log(respuesta.ultimo);
				alertify.success("Guardado correctamente");
				// $('#form_preinscripciones')[0].reset();
				window.location.href="alumnos.php?id_ciclos="+$("#id_ciclos").val();
			}else{
				console.log(respuesta);
			}
		}).fail(function(){
			alertify.error("Error");
		}).always(function(){
			boton.prop('disabled',false);
			icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		});
		
	});
});


