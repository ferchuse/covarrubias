var filtros = {};
function cuentaCheckbox(evnt){
	console.log("cuentaCheckbox");
	
	var total = $(evnt.data.clase).length;
	var cantidad = $(evnt.data.clase + ":checked").length;
	var $botones = $(evnt.data.botones);
	
	$.each($botones, function(index, element){
		$(element.id+" span").html("(" + cantidad +")" );
		if(cantidad >  0){
			$(element.id).prop("disabled", false);
		}
		else{
			$( element.id).prop("disabled", true);
		}
	});
	
	if(cantidad == total){ //si estan todos seleccionados activar el de todos
		$(".todos_checkbox").prop("checked", true);
	}
	else{
		$(".todos_checkbox").prop("checked", false);
	}
} 

function checkAll(evt){
	console.log("checkAll");
	
	if(evt.target.checked){
		$(evt.data.lista_checkbox).each(function(index){
			$(this).prop("checked",true); 
			// $(this).click();
		});
	}
	else{
		$(evt.data.lista_checkbox).each(function(index){
			$(this).prop("checked",false);
			// $(this).click();
		});
	}
	cuentaCheckbox({"data":{
		"clase": ".seleccionado",
		"botones": [{
			"id": "#btn_credenciales",
			"etiqueta": "Credenciales"
		},
		{
			"id": "#btn_cambioGrupo",
			"etiqueta": "Cambiar Grupo"
		}
		]
	}});
	
}


function contar_alumnos(){
	var cantidad_alumnos = $("#lista_alumnos tbody tr:visible").length;
	$("#cantidad_alumnos").html(cantidad_alumnos);
	console.log(cantidad_alumnos);
	
}

$(document).ready(function() {
	
	$('.todos_checkbox').change({"lista_checkbox": ".seleccionado" }, checkAll);
	
	// $('.filtro_texto').keyup(function(event){
	// filtros.push( {
	// "campo": $(this).data("campo"),
	// "operador": "=",
	// "valor": $(this).val()
	// });
	
	// cargarTabla(filtros);
	// });
	
	
	cargarTabla(filtros);
	//--------FILTRO--------
	function cargarTabla() {
		
		filtros.id_ciclos =$("#id_ciclos").val();
		filtros.estatus_alumnos =$("#estatus_alumnos").val();
		
		var cargador = "<tr><td class='text-center' colspan='5'><i class='fa fa-spinner fa-spin fa-3x'></i></td></tr>";
		$('#cuerpo').html(cargador);
		console.log(filtros);
		$.ajax({
			url: 'control/lista_alumnos.php',
			method: 'POST',
			data: {filtros : filtros}
			}).done(function(respuesta) {
			$('#cuerpo').html(respuesta);
			
			
			contar_alumnos();		
			
			$('.seleccionado').change(
			{
				"clase": ".seleccionado",
				"botones": [{
					"id": "#btn_credenciales",
					"etiqueta": "Credenciales"
				},
				{
					"id": "#btn_cambioGrupo",
					"etiqueta": "Cambiar Grupo"
				}
				]
			},
			cuentaCheckbox);
			
			//-----------------------BUSCAR-------------
			function buscar(filtro,table_id,indice) {
				// Declare variables 
				var  filter, table, tr, td, i;
				filter = filtro.toUpperCase();
				table = document.getElementById(table_id);
				tr = table.getElementsByTagName("tr");
				
				// Loop through all table rows, and hide those who don't match the search query
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[indice];
					if (td) {
						if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
							} else {
							tr[i].style.display = "none";
						}
					} 
				}
			}
			//SELECT NIVELES					
			$("#id_niveles").change(function filtro_buscar(){
				var indice = $(this).data("indice"),
				valor_filtro = $(this).val();
				
				buscar(valor_filtro,'lista_alumnos',indice);
				contar_alumnos();
			});
			
			$("#estatus_alumno").change(function filtro_buscar(){
				var indice = $(this).data("indice"),
				valor_filtro = $(this).val();
				
				buscar(valor_filtro,'lista_alumnos',indice);
				contar_alumnos();
			});	
			
			$("#id_grados").change(function filtro_buscar(){
				var indice = $(this).data("indice"),
				valor_filtro = $(this).val();
				
				buscar(valor_filtro,'lista_alumnos',indice);
				contar_alumnos();
			});
			
			$("#id_grupos").change(function filtro_buscar(){
				var indice = $(this).data("indice"),
				valor_filtro = $(this).val();
				
				buscar(valor_filtro,'lista_alumnos',indice);
				contar_alumnos();
			});
			
			
			$("#buscar_alumno").keyup( function filtro_buscar(){
				var indice = $(this).data("indice");
				var valor_filtro = $(this).val();
				
				buscar(valor_filtro,'lista_alumnos',indice);
				contar_alumnos();
			});
			
			
			//----------MODIFICAR ESTATUS--------
			
			$('.btn_baja').click(function btnBaja() {
				var boton = $(this);
				boton.prop('disabled', true);
				icono = boton.find(".fa");
				icono.toggleClass("fa-user-times fa-spinner fa-spin");
				var id_alumnos = boton.data('id_alumnos');
				var fila = boton.closest('tr');
				function baja(evet,value) {
					$.ajax({
						url: 'control/fila_update.php',
						method: 'POST',
						data:{
							tabla: 'alumnos',
							id_campo: 'id_alumnos',
							id_valor: id_alumnos,
							valores: [
								{
									name: 'motivoBaja_alumnos',
									value: value
								},
								{
									name: 'estatus_alumnos',
									value: 'BAJA'
								},
								{
									name: 'fechabaja_alumnos',
									value: Date.today().toString('dd/MM/yyyy')
								}
							]
						}
						}).done(function(respuesta){
						alertify.success("Se ha dado de baja correctamente"); 
						icono.toggleClass("fa-user-times fa-spinner fa-spin");
						boton.prop('disabled', false);
						cargarTabla(filtros);
					});
				}
				
				
				
				alertify.prompt('Confirmacion', '¿Deseas darlo de baja?','Escribe el motivo', baja, function() {
					icono.toggleClass("fa-user-times fa-spinner fa-spin fa-floppy-o");
					boton.prop('disabled', false);
				});
				
			});
			//----------MODIFICAR ESTATUS--------
			$('.btn_alta').click(function btnAlta() {
				var boton = $(this);
				boton.prop('disabled', true);
				icono = boton.find(".fa");
				icono.toggleClass("fa-user-plus fa-spinner fa-spin");
				var id_alumnos = boton.data('id_alumnos');
				var fila = boton.closest('tr');
				function alta(evet,value) {
					$.ajax({
						url: 'control/fila_update.php',
						method: 'POST',
						data:{
							tabla: 'alumnos',
							id_campo: 'id_alumnos',
							id_valor: id_alumnos,
							valores: [
								{
									name: 'motivoBaja_alumnos',
									value: ''
								},
								{
									name: 'estatus_alumnos',
									value: 'INSCRITO'
								}
							]
						}
						}).done(function(respuesta){
						alertify.success("Se ha dado de alta correctamente"); 
						icono.toggleClass("fa-user-times fa-spinner fa-spin");
						boton.prop('disabled', false);
						cargarTabla(filtros);
					});
				}
				
				
				
				alertify.confirm('Confirmacion','¿Desea darlo de alta?',alta, function() {
					icono.toggleClass("fa-user-plus fa-spinner fa-spin fa-floppy-o");
					boton.prop('disabled', false);
				});
				
			});
			
			
			//----------INSCRIBIR-------------
			$('.btn-inscribir').click(function() {
				var boton = $(this);
				var icono = boton.find('.fa');
				boton.prop('disabled', true);
				var id_alumno = $('#id_alumnos').val();
				
				$.ajax({
					url: 'control/inscribir_alumno.php',
					dataType: 'JSON',
					method: 'POST',
					data: {
						id_alumno: id_alumno
					}
					}).done(function(respuesta) {
					if (respuesta.estatusAlumno == 'success') {
						alertify.success("Se ha inscrito correctamente");
						location.reload('inscripciones.php');
						} else {
						alertify.success(respuesta.estatus);
					}
				});
				
			});
			
			//--------EDITAR------------
			$('.btn-editar').click(function(event) {
				event.preventDefault();
				
				var boton = $(this);
				boton.prop('disabled', true);
				var icono = boton.find('.fa');
				icono.toggleClass("fa-save fa-spinner fa-spin fa-floppy-o");
				
				$.ajax({
					url: 'control/alta_alumnos.php',
					method: 'POST',
					dataType: 'JSON',
					data: $('#form_alumno').serialize() + '&campo=EDITAR'
					}).done(function(respuesta) {
					if (respuesta.estatus == "success") {
						alertify.success(respuesta.mensaje);
						location.reload();
						} else {
						alertify.error('Error al modificar');
						console.log(respuesta.error);
					}
					icono.toggleClass("fa-save fa-spinner fa-spin fa-floppy-o");
				});
				
				
			});
			
			// Mostrar Modal Ciclo
			$('.btn_ciclo').click(function (){
				$("#nombre_alumnos").val($(this).data("nombre_alumnos"))
				$("#id_alumnos").val($(this).data("id_alumnos"))
				$("#ciclo_id_grados").val($(this).data("id_grados"))
				$("#ciclo_id_niveles").val($(this).data("id_niveles"))
				$("#grado_anterior").val($(this).data("grado_anterior"))
				$("#reinscripcion").val("NO");
				$("#modal_cambiar_ciclo .modal-title").text("Promover de Grado");
				
				$("#modal_cambiar_ciclo").modal("show");
			}) ; 
			
			$('.btn_reinscribir').click(function (){
				$("#nombre_alumnos").val($(this).data("nombre_alumnos"))
				$("#id_alumnos").val($(this).data("id_alumnos"))
				$("#ciclo_id_grados").val($(this).data("id_grados"))
				$("#ciclo_id_niveles").val($(this).data("id_niveles"))
				
				$("#grado_anterior").val($(this).data("grado_anterior"))
				$("#reinscripcion").val("SI");
				
				$("#modal_cambiar_ciclo .modal-title").text("Reinscribir Alumno");
				$("#modal_cambiar_ciclo").modal("show");
			}) ; 
			
			
			// $('.nombre_alumnos').click( function(){
			// console.log("animate");
			// $(this).closest("div").animate({
			// width: '40%'
			
			// }, 500);
			// });
		});
		
	} // Fin cargarTabla
	//-------------FILTROS------------------------------
	
	/*$('#id_select').change(function seleccionNiveles() {
		var niveles = $('#id_select option:selected').data('id_nivel');
		console.log(niveles);
		filtros['niveles'] = $('#id_select option:selected').data('id_nivel');
		filtros['id_grados'] = $('#id_select option:selected').val();
		
		cargarTabla(filtros);
		console.log(filtros);
    });
    $('#id_grupos').change(function seleccionGrupos() {
		var niveles_grupos = $('#id_grupos option:selected').data('id_gruposniveles');
		filtros.push({'id_gruposniveles' : $('#id_grupos option:selected').data('d_gruposniveles')});
		filtros['id_grupos'] = $(this).val();
		cargarTabla(filtros);
    });
		$('#id_niveles').change(function seleccionNivel(){
		filtros['id_niveles'] = $(this).val();
		cargarTabla(filtros);
		$.ajax({
		url: 'control/get_options.php',
		method: 'GET',
		data: {
		formato: 'html',
		tabla: 'grados',
		id_col: 'id_grados',
		nombre_col: 'nombre_grados',
		filtro_campo: 'id_niveles',
		filtro_valor: $('#id_niveles').val(),
		campo_orden: 'nombre_grados'
		}
		}).done(function(respuesta){
		$('#id_select').html("<option value=''>Todos</option>" + respuesta);
		
		$.ajax({
		url: 'control/get_options.php',
		method: 'GET',
		data:{
		formato: 'html',
		tabla: 'grupos',
		id_col: 'id_grupos',
		nombre_col: 'nombre_grupos',
		filtro_campo: 'id_niveles',
		filtro_valor: $('#id_niveles option:selected').val(),
		campo_orden: 'nombre_grupos'
		}
		}).done(function(res){
		$('#id_grupos').html("<option value=''>Todos</option>" + res);
		});
		});
	});*/
	
	$('#imprimir_documento').click(function(){
		$('#modal_alumno').print();
	});
	
	//importar a excel
	$('#btn_imprimirAlumnos').click(function(){
		$('#lista_alumnos').tableExport(
		{
			type:'excel',
			tableName:'Reporte de Alumnos', 
			ignoreColumn: [5,6],
			escape:'false'
		});
	});
	
	
	
	$("#id_ciclos").change(mostrar_ciclo)
	
	function mostrar_ciclo(event){
		console.log("mostrar_ciclo");
		
		cargarTabla();
	}
	$('#form_cambiar_ciclo').submit(guardar_ciclo);
	
	
	
}); // Fin document ready



function guardar_ciclo(event){
	event.preventDefault();
	console.log("cambiar_ciclo()");
	$button = $(this).find(":submit");
	$button.prop("disabled",true);
	
	
	$.ajax({
		"url": "control/cambiar_ciclo.php",
		"dataType": "JSON",
		"data": {
			"id_alumnos": $("#id_alumnos").val(),
			"id_ciclos": $("#ciclo_id_ciclos").val(),
			"reinscripcion": $("#reinscripcion").val(),
			"id_grupos": $("#ciclo_id_grupos").val(),
			"id_plan": $("#id_plan").val(),
			"id_grados": $("#ciclo_id_grupos option:selected").data("id_grados"),
			"id_niveles": $("#ciclo_id_grupos option:selected").data("id_niveles")
			
		}
		}).done(after_cambiar_ciclo).always(function(){
		$button.prop("disabled",false);
		
	});
	
}

function after_cambiar_ciclo (respuesta){ 
	if (respuesta.estatus_insc=="success" &&respuesta.estatus_plan=="success")
	{
		//cargarTabla();
		alertify.success ("Guardado correctamente");
		
		$("#modal_cambiar_ciclo").modal("hide");
	}
	else 
	alertify.error("Ocurrio un Error");
	
	$("#btn_guardar_ciclo").prop("disabled",false);	
	
}