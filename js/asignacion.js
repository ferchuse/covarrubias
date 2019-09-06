$(document).ready(function(){
	var filtros = {};
	cargarTabla(filtros);
	
	function cargarTabla(filtros){
		var cargador = "<tr><td class='text-center' colspan='5'><i class='fa fa-spinner fa-spin fa-3x'></i></td></tr>";
		
		$('#cuerpo').html(cargador);
		$.ajax({
			url: 'control/lista_asignacio.php',
			method: 'GET',
			data: filtros
		}).done(function(respuesta){
			$('#cuerpo').html(respuesta);
			
			
			$('#btn_Agrupo').click(function(){
				var boton = $(this);
				var icono = boton.find('fa');
				boton.prop(true);
				var id_alumno = boton.data('id_alumnos');
				console.log(id_alumno);
				$('#modal_nueva_asignacion').modal('show');
			});
		});
	} 

	//--------------------------------------------------
	$('#id_niveles').change(function seleccionNiveles(){
		filtros['id_niveles'] = $(this).val();
		cargarTabla(filtros);
		$.ajax({
			url: 'control/get_options.php',
			method: 'GET',
			data:{
				formato: 'html',
				tabla: 'grados',
				id_col: 'id_niveles',
				nombre_col: 'nombre_grados',
				filtro_campo: 'id_niveles',
				filtro_valor: $('#id_niveles').val(),
				campo_orden: 'nombre_grados'
			}
		}).done(function(respuesta){
			$('#id_grados').html("<option value=''>Seleciona un grado</option>" + respuesta);
		});
	});
	$('#id_grados').change(function seleccionGrupos(){
		filtros['id_grados'] = $(this).val();
		cargarTabla(filtros);
	});
	//--------------------------------------------------
	$('#btn_uno').click(function btn_uno(){
		$('#c1').removeClass("active");
		$('#c2').addClass("active");
	});
	$('#btn_tres').click(function btn_dos(){
		$('#c2').removeClass("active");
		$('#c1').addClass("active");
	});
	$('#btn_dos').click(function btn_dos(){
		$('#c2').removeClass("active");
		$('#c3').addClass("active");
	});
	$('#btn_cuatro').click(function btn_cuatro(){
		$('#c3').removeClass("active");
		$('#c2').addClass("active");
	});
	//------------------------------------------------------
	function selectAll(){
		if($('#todos_checkbox').prop("checked")){
			$('.seleccion').each(function(index){
				$(this).prop("checked",true);
			});
		}else{
		$('.seleccion').each(function(index){
				$(this).prop("checked",false);
				
			});
		}
	}
	
	$('.seleccion').click(function(event){
			console.log($(this).val());
	});
	$('#todos_checkbox').click(selectAll);
	//-------------------------------------------
	$('#form_nueva_asignacion').submit(function evio_formulario(event){
		event.preventDefault();
		data = $('#form_todo').serialize();
		data += "&" + $(this).serialize();
		console.log(data);
		$.ajax({
			url: 'control/guardar_asignacion.php',
			method: 'POST',
			data:data
		}).done(function(respuesta){
			if(respuesta.estatus == 'success'){
				console.log(respuesta);
				alertify.success("Guardado correctamente");
				$('#modal_nueva_asignacion').modal('hide');
				cargarTabla(filtros);
			}else{
				alertify.error('Ha ocurrido un error');
			}
		});
	});
	//-----------------------------------------
	$('#btn_uno').prop('disabled',true);
	$('#id_niveles').change(function boton_1(){
		var valor = $('#id_niveles option:selected').val();
		
		habilitar(valor);
	});
	function habilitar(value){
		if(value ==  "" ){
			$('#btn_uno').prop('disabled',true);
		}else if(value != ""){
			$('#btn_uno').prop('disabled',false);
		}
	}
	//----------------------------------------
	$('#btn_dos').prop('disabled',true);
	$('#id_grados').change(function boton_2(){
		var valor = $('#id_niveles option:selected').val();
		habilitar2(valor);
	});
	function habilitar2(value){
		if(value == ""){
			$('#btn_dos').prop('disabled',true);
		}else if (value != ""){
			$('#btn_dos').prop('disabled',false);
		}
	}
	
});