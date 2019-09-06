$(document).ready(function(){
	alertify.success("Versión 20/08/2018");
	console.log($('.nombre_autorizada'));
	$('#btn_imprimir').click(function(){
		print();
	});
	
	cargarDatos();
	
	  function cargarDatos() {

				var id_alumnos = $('#id_alumnos').val();
				$.ajax({
					url: 'control/busqueda_avanzada.php',
					method: 'POST',
					dataType: 'JSON',
					data: {
						tabla_principal: 'alumnos',
						joins: [{
							tabla: 'padres',
							using: 'id_alumnos'
						},
						{
							tabla: 'personas_autorizadas',
							using: 'id_alumnos'
						},
						{
							tabla: 'inscripciones',
							using: 'id_alumnos'
						},
						{
							tabla: 'madres',
							using: 'id_alumnos'
						}],
						filtros:[{
							campo: 'id_alumnos',
							operador: '=',
							valor: parseInt(id_alumnos)
						},
						{
							campo: 'activa',
							operador: '=',
							valor: 1
						}]
					}
				}).done(function(respuesta){
					console.log(respuesta);
					if(respuesta.encontrado == 1){
						$.each(respuesta["fila"][0], function(name, value){
							
								$("#"+name).val(value);
								
								switch(name){
									case 'fechanac_alumnos':
									
										var fecha = value;
										año = fecha.substring(0,4);
										mes = fecha.substring(5,7);
										dia = fecha.substring(8,10);
										
										$('#dia').val(dia);
										$('#mes').val(mes);
										$('#año').val(año);
									break;
									case "extranjero_alumnos":
										if(value == 'SI'){
											$('#extranjero_alumnosSI').attr('checked',true);
											
										}else{
											$('#extranjero_alumnosNO').attr('checked',true);
											
										}
									break;
									case "discapacidad_alumnos":
										if(value == 'SI'){
											$('#discapacidad_alumnosSI').attr('checked',true);
											
										}else{
											$('#discapacidad_alumnosNO').attr('checked',true);
										
										}
								}
								
						});
						$.each(respuesta['fila'],function(index,campos){
								$('.nombre_autorizada')[index].value=campos.nombre_autorizada;
								$('.parentesco_autorizada')[index].value=campos.parentesco_autorizada;
								console.log(campos);
								
						});
							
				}
				});
				

            }
			
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
	
	//--------EDITAR PREINSCRIPCION------
	$('#form_preinscripciones').submit(function(event){
		event.preventDefault();
		datos_formulario = $(this);
		var boton = datos_formulario.find(':submit');
		var icono = boton.find('.fa');
		boton.prop('disabled',true);
		icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		var id_grados = $('#id_grupos option:selected').data('id_grados');
		var datos = datos_formulario.serialize()+'&id_grados='+id_grados;
		
		$.ajax({
			url: 'control/editar_alumnos.php',
			method: 'POST',
			dataType: 'JSON',
			data: datos
		}).done(function(respuesta){
			if(respuesta.estatus == "success"){
				console.log(respuesta.ultimo);
				alertify.success("Editado correctamente");
				//location.reload('detalles_alumnos.php');
			}else{
				console.log(respuesta.mensaje);
			}
		}).fail(function(){
			alertify.error("Error");
		}).always(function(){
			boton.prop('disabled',false);
			icono.toggleClass('fa-save fa-spinner fa-spin fa-floppy-o');
		});
	});
});



});