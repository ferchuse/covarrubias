$(document).ready(function() {
	var filtros = $("#form_filtros").serialize();
	cargarTabla(filtros);
	
	
	$(".filtro").change(function(){
		filtros = $("#form_filtros").serialize();
		cargarTabla(filtros);
		
	});
	
	function buscarCliente(event) {
		console.log("buscarCliente()");
		var value = $(this).val().toLowerCase();
		$("#lista_facturas tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	}
	//--------FILTRO--------
	function cargarTabla(filtros) {
		var cargador = "<tr><td class='text-center' colspan='5'><i class='fa fa-spinner fa-spin fa-3x'></i></td></tr>";
		$('#lista_facturas').html(cargador);
		$.ajax({
			url: 'control/lista_facturas.php',
			method: 'GET',
			data: filtros
			}).done(function(respuesta) {
			$('#lista_facturas').html(respuesta); 
			
			$("#buscar_cliente").keyup(buscarCliente);
			
			$('.btn_cancelar').click(function confirmaCancelacion() {
				var boton = $(this);
				boton.prop('disabled', true);
				icono = boton.find(".fa");
				icono.toggleClass("fa-times fa-spinner fa-spin ");
				var folio_facturas = boton.data('folio_facturas');
				var id_facturas = boton.data('id_facturas');
				var fila = boton.closest('tr');
				function cancelarFactura(evet,value) {
					$.ajax({
						url: 'facturacion/cancelar_factura.php',
						method: 'POST',
						data:{
							
							motivo_cancelacion: value,
							folio_facturas: folio_facturas,
							id_facturas: id_facturas
						}
						}).done(function(respuesta){
						alertify.success("CFDI Cancelado correctamente"); 
						
						cargarTabla(filtros);
						}).fail(function(xhr, error,errnum ){
						alertify.error("Ocurrio un error" + error);
						}).always(function(){
						icono.toggleClass("fa-times fa-spinner fa-spin ");
						boton.prop('disabled', false);
					});
				}
				
				alertify.prompt('Confirmacion', '¿Deseas Cancelar esta factura?','Escribe el motivo', cancelarFactura, function() {
					icono.toggleClass("fa-times fa-spinner fa-spin");
					boton.prop('disabled', false);
				});
			});
			
			$('.btn_correo').click(function modal_correo() {
				$("#correo").val($(this).data("correo"));
				$("#url_xml").val($(this).data("url_xml"));
				$("#url_pdf").val($(this).data("url_pdf"));
				
				$("#modal_correo").modal("show");
				
			});
		});
	}
	
	
	$(".exportar").click(function(){
		
		$('#tabla_reporte').tableExport(
		{
			type:'excel',
			tableName:'Reporte', 
			ignoreColumn: [5],
			escape:'false'
		});
	});
	
	
	//-------------FILTROS------------------------------
	
	$('#id_select').change(function seleccionNiveles() {
		var niveles = $('#id_select option:selected').data('id_nivel');
		console.log(niveles);
		filtros['niveles'] = $('#id_select option:selected').data('id_nivel');
		filtros['id_grados'] = $('#id_select option:selected').val();
		
		cargarTabla(filtros);
		console.log(filtros);
	});
	$('#id_grupos').change(function seleccionGrupos() {
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
				id_col: 'id_niveles',
				nombre_col: 'nombre_grados',
				filtro_campo: 'id_niveles',
				filtro_valor: $('#id_niveles').val(),
				campo_orden: 'nombre_grados'
			}
			}).done(function(respuesta){
			$('#id_select').html("<option value=''>Todos</option>" + respuesta);
		});
		$.ajax({
			url: 'control/get_options.php',
			method: 'GET',
			data:{
				formato: 'html',
				tabla: 'grupos',
				id_col: 'id_niveles',
				nombre_col: 'nombre_grupos',
				filtro_campo: 'id_niveles',
				filtro_valor: $('#id_niveles').val(),
				campo_orden: 'nombre_grupos'
			}
			}).done(function(res){
			$('#id_grupos').html("<option value=''>Todos</option>" + res);
		});
	});
	
	
	$("#form_correo").submit( function(event){
		
		var boton = $(this).find(":submit");
		var icono = boton.find(".fa");
		
		event.preventDefault();
		icono.toggleClass("fa-envelope fa-spinner fa-spin");
		boton.prop('disabled', true);
		
		$.ajax({
			url: 'facturacion/enviar_factura.php',
			method: 'GET',
			data:$("#form_correo").serialize()
			}).done(function(respuesta){
			alertify.success("Se ha enviado correctamente"); 
			$("#modal_correo").modal("hide");
			}).fail(function(xhr, error, errnum){
			alertify.error("Ocurrió un error, intenta nuevamente"+ error); 
			}).always(function(){
			icono.toggleClass("fa-envelope fa-spinner fa-spin");
			boton.prop('disabled', false);
		});
		
	});
});