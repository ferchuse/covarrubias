<?php
	include("login/login_success.php");
	include("funciones/generar_select.php");
	include("funciones/dame_folio.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "facturas";
	
	
	$folio_anterior = dame_folio($link, "nominas", "folio_nomina");
	
	// echo var_dump($folio_anterior);
	if($folio_anterior["num_rows"] == 0){
		$folio_nuevo= 	"999";
	}
	else{
		$folio_nuevo =  $folio_anterior["folio"];
		
		$folio_nuevo++;
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nueva Nómina</title>
		<?php include("styles.php");?>
		
	</head>
	<body>
		
		
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 ">
					<ul class="nav nav-pills nav-justified">
						<li class="active">
							<a data-toggle="tab" id="tab_alumno" href="#paso1">1- Empleado</a>
						</li>
						<li class="disabled">
							<a class=""  data-toggle="tab" id="tab_factura" href="#datos_factura">2-Datos del Pago</a>
						</li>
						<li class="disabled">
							<a class="" data-toggle="tab" id="tab_conceptos" href="#datos_conceptos">3-Conceptos</a>
						</li>
					</ul>
					<div class="tab-content"> 
						<div class="tab-pane fade in active" id="paso1">
							<div class="panel panel-primary ">
								<div class="panel-body">
									<form id="form_empleados" class="was-validated">
										<div class="row">
											<div class=" col-sm-6">
												
												
												<div class="form-group ">
													<label for="">Num Empleado *</label>
													<input id="id_empleados"  type="text" name="id_empleados" class="form-control" placeholder="captura y presiona enter para buscar" autofocus="on">
												</div>
												<div class="form-group">
													<label for="">Nombre del Empleado *</label>
													<input id="nombre_empleados" placeholder="Escribe para Buscar" type="text" name="nombre_empleados" class="form-control"  value="">
												</div>
												<div class="form-group">
													<label for="">RFC</label>
													<input type="text" name="rfc_empleados" id="rfc_empleados" class="form-control" value="">
												</div>
												<div class="form-group">
													<label for="">CURP: *</label>
													<input  requiredd type="text" id="curp_empleados" name="curp_empleados" class="form-control" value="">
												</div>
												<div class="form-group">
													<label for="">NSS: *</label>
													<input  class="form-control"  id="nss" requiredd name="nss" value="">
												</div>
												<div class="form-group">
													<label for="">Correo: *</label>
													<input  class="form-control"  id="correo_empleados" requiredd name="correo_empleados" value="">
												</div>
											</div>
											<div class=" col-sm-6" >
												<div class="form-group">
													<label for="">Tipo de Contrato</label>
													<select id="tipo_contrato" name="tipo_contrato" class="form-control">
														<option value="">Seleccione...</option>
														<option selected value="01">01	Contrato de trabajo por tiempo indeterminado</option>
														<option value="02">02	Contrato de trabajo para obra determinada</option>
														<option  value="03">03	Contrato de trabajo por tiempo determinado</option>
														<option value="04">04	Contrato de trabajo por temporada</option>
														<option value="05">05	Contrato de trabajo sujeto a prueba</option>
														<option value="06">06	Contrato de trabajo con capacitación inicial</option>
														<option value="07">07	Modalidad de contratación por pago de hora laborada</option>
														<option value="08">08	Modalidad de trabajo por comisión laboral</option>
														<option value="09">09	Modalidades de contratación donde no existe relación de trabajo</option>
														<option value="10">10	Jubilación, pensión, retiro.</option>
														<option  value="99">99	Otro contrato</option>
													</select>
												</div>
												<div class="form-group">
													<label for="">Tipo de Régimen</label>
													<select id="tipo_regimen" name="tipo_regimen" class="form-control">
														<option value="">Seleccione...</option>
														<option value="02">02	Sueldos</option>
														<option value="03">03	Jubilados</option>
														<option  value="04">04	Pensionados</option>
														<option value="09">09	Asimilados Honorarios</option>
														<option value="13">13 Indemnización o Separación</option>
														
													</select>
												</div>
												<div class="form-group">
													<label for="">Salario base cotización: *</label>
													<input  class="form-control" type="number" step="any" id="salario_base" requiredd name="salario_base" >
												</div>
												<div class="form-group">
													<label for=""> Salario diario integrado: *</label>
													<input  class="form-control" type="number" step="any" id="salario_diario" requiredd name="salario_diario"  >
												</div>
												
												<div class="form-group">
													<label for=""> Fecha de Inicio Relación Laboral: </label>
													<input  class="form-control" type="date" id="fecha_inicio_laboral" requiredd name="fecha_inicio_laboral" value="" >
												</div>
												<div class="form-group">
													<label for=""> Antigüedad: </label>
													<input  class="form-control" type="text" id="antiguedad" placeholder="SE CALCULARÁ AL ELEGIR FECHA DE PAGO" name="antiguedad" value="" >
												</div>
												<div class="form-group">
													<label for=""> Riesgo: </label>
													<select id="riesgo" name="riesgo" class="form-control">
														<option value="">Seleccione</option>
														<option selected value="1">Clase I</option>
														<option value="2">Clase II</option>
														<option value="3">Clase III</option>
														<option value="4">Clase IV</option>
														<option value="5">Clase V</option>
														<option value="99">99	No aplica</option>
													</select>
												</div>
												<div class="form-group">
													<label for="">Periodicidad</label>
													<select id="periodicidad" name="periodicidad" class="form-control" required>
														<option value="01">01	Diario</option>
														<option value="02">02	Semanal</option>
														<option value="03">03	Catorcenal</option>
														<option selected value="04">04	Quincenal</option>
														<option value="05">05	Mensual</option>
														<option value="06">06	Bimestral</option>
														<option value="07">07	Unidad obra</option>
														<option value="08">08	Comisión</option>
														<option value="09">09	Precio alzado</option>
														<option value="10">10	Decenal</option>
														<option value="99">99	Otra Periodicidad</option>
													</select>
												</div>
											</div>
											
										</div>
										<button  type="button"  class="btn btn-success btn-lg pull-right next">
											Siguiente <i class="fa fa-arrow-right"></i>
										</button>
									</form>
								</div>
							</div>
						</div>
						
						
						
						<div class="tab-pane fade" id="datos_factura">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4>
										3-Datos de la Nómina
									</h4>
								</div>
								<div class="panel-body">
									<form id="form_nomina">
										<div class="row">
											<div class="col-sm-6">
												
												<div class="form-group">
													<label class="control-label" for="forma_pago">Forma de Pago:</label>
													<select id="forma_pago" name="forma_pago" class="form-control" >
														<option value="">Seleccione...</option>
														<option value="01" >01 Efectivo</option>
														<option value="02">02 Cheque nominativo</option>
														<option value="03" >03 Transferencia electrónica de fondos</option>
														<option value="04">04 Tarjeta de crédito</option>
														<option value="28" >28 Tarjeta de débito</option>
														<option value="29" >29 Tarjeta de servicios</option>
														<option selected value="99" >99 Por definir</option>
													</select>
												</div>
												<div class="form-group">
													<label for="">Tipo de Nómina</label>
													<select id="tipo_nomina" name="tipo_nomina" class="form-control" >
														<option selected value="O">Ordinaria</option>
														<option value="E" >Extraordinaria</option>
													</select>
												</div>
												<div class="form-group">
													<label for="">Serie:</label>
													<input type="text" name="serie_nomina" id="serie_nomina" class="form-control" placeholder="opcional" value="">
													
												</div>
												<div class="form-group">
													<label for="">Folio:</label>
													<input type="text" name="folio_nomina" id="folio_nomina" class="form-control" value="<?php echo $folio_nuevo;?>"> 
												</div>
												
												<div class="form-group hidden">
													<label for="">Lugar de Expedición</label>
													<input type="text" name="lugar_expedicion" id="lugar_expedicion" class="form-control" value="42040">
												</div>
												
												<div class="form-group hidden">
													<label class="control-label" for="regimen_emisores">Régimen Fiscal<span class="requiredd-validation-error">*</span>:</label>
													<select id="regimen_emisores" name="regimen_emisores" class="form-control">
														<option value="">Seleccione...</option>
														<option selected value="621">621 Incorporación Fiscal</option>
													</select>
												</div>
											</div>
											
											
											<div class="col-sm-6">
												<div class="form-group">
													<label for=""> Fecha de pago:: *</label>
													<input  class="form-control" type="date" id="fecha_pago" requiredd name="fecha_pago" value="<?php echo date("Y-m-d")?>" >
												</div>
												<div class="form-group col-6">
													<label for=""> Periodo de Pago del: *</label>
													<input  class="form-control" type="date" id="fecha_inicial" requiredd name="fecha_inicial" 
													value="">
												</div>
												<div class="form-group col-6">
													<label for=""> Al: *</label>
													<input  class="form-control" type="date" id="fecha_final" requiredd name="fecha_final" value="" >
												</div>
												<div class="form-group col-6">
													<label for=""> Días Pagados: *</label>
													<input  class="form-control" type="number" id="dias_pagados" requiredd name="dias_pagados" value="15" >
												</div>
												
											</div>
										</div>
										<a  type="button"  class="btn btn-success btn-lg pull-left anterior">
											Anterior <i class="fa fa-arrow-left"></i>
										</a>
										<a   type="button"  class="btn btn-success btn-lg pull-right next">
											Siguiente <i class="fa fa-arrow-right"></i>
										</a>
									</form>
								</div>
							</div>
						</div>
						
						<div class="tab-pane fade" id="datos_conceptos">
							<div class="panel panel-primary ">
								<div class="panel-heading">
									<h4> 
										4-Conceptos
									</h4>
								</div>
								<div class="panel-body">
									<form id="form_conceptos" autocomplete="off">
										<div class="row" hidden >
											<div class="form-group col-sm-1">
												<label>CANTIDAD</label>
											</div>	 
											<div class=" col-sm-4">
												<label>DESCRIPCIÓN</label>
											</div> 
											<div class="form-group col-sm-2">
												<label>PRECIO UNITARIO</label>
											</div>
											<div class="form-group col-sm-2"> 
												<label>IMPORTE</label>
											</div>
											<div class="form-group col-sm-2"> 
												<label>DESCUENTO</label>
											</div>
										</div>
										<div id="div_conceptos" hidden >
											<div class="row fila_concepto">
												<div class="form-group col-sm-1">
													<input requiredd type="number" step=".01" name="conceptos[0][cantidad]" class="form-control cantidad conceptos" value="1">
												</div>	 
												<div class="form-group col-sm-4">
													<input requiredd value="Pago de Nómina" name="conceptos[0][descripcion]" class="form-control conceptos">
												</div> 
												<div class="form-group col-sm-2">
													<input requiredd type="number"step="any" name="conceptos[0][precio_unitario] " class="form-control precio_unitario conceptos">
												</div>
												<div class="form-group col-sm-2"> 
													<input requiredd  type="number" step="any"  name="conceptos[0][importe]" class="form-control importe conceptos">
												</div>
												<div class="form-group col-sm-2"> 
													<input requiredd  id="descuento" type="number" step="any" name="conceptos[0][descuento]" class="form-control descuento conceptos">
												</div>
											</div>
										</div>
										<hr>
										<div class="well">
											<legend>
												Percepciones 
												<button class="btn btn-success" type="button" id="agregar_percepcion">
													<i class="fa fa-plus"></i> Agregar
												</button>
											</legend> 
											<div class="row">
												<div class="col-sm-4">
													Percepcion
												</div>	 
												<div class="col-sm-1">
													Clave Interna
												</div>	 
												<div class="form-group col-sm-2">
													Importe Gravado
												</div> 
												<div class="form-group col-sm-2">
													Importe Excento
												</div>
												<div class="form-group col-sm-1">
													Eliminar
												</div>
											</div>  
											<div id="div_percepciones" class="contenedor">
												<div class="row fila_percepcion">
													<div class="form-group col-sm-4">
														<?php echo generar_select($link, "percepciones", "id_percepcion", "percepcion", "percepciones[tipo_percepcion][]")?>
														<input requiredd value="" hidden name="percepciones[concepto][]" class="form-control concepto hidden" >
													</div>	
													<div class="form-group col-sm-1">
														<input required value="" name="percepciones[clave][]" class="form-control ">
													</div>	 
													<div class="form-group col-sm-2">
														<input required value="0" min="0" name="percepciones[gravado][]" class="form-control gravado">
													</div> 
													<div class="form-group col-sm-2">
														<input required type="number" step=".01" name="percepciones[excento][]" class="form-control excento" value="0"  >
													</div> 
													<div class="form-group col-sm-1">
														<button class="btn btn-danger btn_borrar" type="button">
															<i class="fa fa-times"></i>
														</button>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-5">
												</div>	 
												<div class="form-group col-sm-2">
													<label>Total Gravado</label>
													<input class="form-control" id="total_gravado" name="total_gravado">
												</div> 
												<div class="form-group col-sm-2">
													<label>Total Excento</label>
													<input class="form-control" id="total_excento" name="total_excento">
												</div> 
												<div class="form-group col-sm-2">
													<label>Total Percepciones</label>
													<input class="form-control" id="total_percepciones" name="total_percepciones">
												</div> 
											</div>
										</div>
										
										
										<div class="well">
											<legend>Deducciones 
												<button class="btn btn-success" type="button" id="agregar_deduccion">
													<i class="fa fa-plus"></i> Agregar
												</button>
											</legend> 
											<div class="row">
												<div class="col-sm-4">
													Tipo Deducción
												</div>	 
												<div class="form-group col-sm-1">
													Clave Interna 
												</div>  
												<div class="form-group col-sm-2">
													Importe 
												</div> 
												
											</div>
											<div id="div_deducciones" class="contenedor">
												<div class="row fila_deduccion">
													<div class="form-group col-sm-4">
														<?php echo generar_select($link, "deducciones", "id_deduccion", "deduccion" , "deducciones[tipo_deduccion][]")?>
														<input requiredd value="" hidden name="deducciones[concepto][]" class="form-control concepto hidden" >
													</div>	 
													<div class="form-group col-sm-1">
														<input requiredd value="" name="deducciones[clave][]" class="form-control ">
													</div>
													<div class="form-group col-sm-2">
														<input requiredd value="0" name="deducciones[importe][]" class="form-control importe_deduccion">
													</div> 
													<div class="form-group col-sm-1">
														<button class="btn btn-danger btn_borrar" type="button">
															<i class="fa fa-times"></i>
														</button>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-5">
												</div>	 
												<div class="form-group col-sm-2">
													<label>Total Deducciones</label>
													<input class="form-control" id="total_deducciones" name="total_deducciones">
												</div> 
											</div>
										</div>
										
										
										
										<div class="well">
											<legend>
												Otros Pagos 
												<button class="btn btn-success" type="button" id="agregar_otros_pagos">
													<i class="fa fa-plus"></i> Agregar
												</button>
											</legend> 
											<div class="row">
												<div class="col-sm-3">
													Tipo Otro Pago
												</div>	 
												<div class="col-sm-1">
													Clave Interna
												</div>	 
												<div class="col-sm-3">
													Concepto
												</div>	 
												<div class="form-group col-sm-2">
													Importe
												</div>
												<div class="form-group col-sm-1">
													Eliminar
												</div>
												<div class="form-group col-sm-2">
													<label>Subsidio Causado</label>
												</div>
											</div>  
											<div id="div_otros_pagos" class="contenedor">
												<div class="row fila_otros_pagos">
													<div class="form-group col-sm-3">
														<select name="otros_pagos[tipo][]" class="form-control tipo_otro_pago" >
															<option value="">Seleccione...</option>
															<option value="001" >001 Reintegro de ISR pagado en exceso siempre que no haya sido enterado al SAT
															</option>	
															<option value="002" >002 Subsidio para el empleo efectivamente entregado al trabajador
															</option>
															<option value="003" >003 Viáticos entregados al trabajador
															</option>
															<option value="004" >004 Aplicación de saldo a favor por compensación anual
															</option>
															<option value="005" >005 Reintegro de ISR retenido en exceso de ejercicio anterior siempre que no haya sido enterado al SAT
															</option>
															<option value="999" >999 Pagos distintos a los listados y que no deben considerarse como ingreso por sueldos, salarios o ingresos asimilados
															</option>
														</select>
													</div>
													<div class="form-group col-sm-1">
														<input value="" name="otros_pagos[clave][]" class="form-control ">
													</div>	
													<div class="form-group col-sm-3">
														<input    name="otros_pagos[concepto][]" class="form-control concepto" >
													</div>	 
													<div class="form-group col-sm-2">
														<input  value="0" min="0" name="otros_pagos[importe][]" class="form-control otro_pago">
													</div> 
													<div class="form-group col-sm-1">
														<button class="btn btn-danger btn_borrar" type="button">
															<i class="fa fa-times"></i>
														</button>
													</div>
													<div class="form-group col-sm-2">
														
														<input class="form-control subsidio_causado"  name="otros_pagos[subsidio_causado][]" disabled value="0">
													</div> 
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-7">
												</div>	 
												<div class="form-group col-sm-2">
													<label>Total Otros Pagos</label>
													<input class="form-control" id="total_otros_pagos" name="total_otros_pagos" value="0">
												</div> 
											</div>
											
											
										</div>
										
										
										<hr>
										<div class="row" >
											<div class="col-sm-3 col-sm-offset-6 text-right">
												<label>SUBTOTAL:</label>
											</div>
											<div class="col-sm-3">
												<input required type="number" step="any" class="form-control" name="subtotal" id="subtotal">
											</div>
										</div>
										
										<div class="row" >
											<div class="col-sm-3 col-sm-offset-6 text-right">
												<label>DESCUENTO:</label>
											</div>
											<div class="col-sm-3">
												<input required type="number" step="any" class="form-control" name="descuento" id="total_descuento">
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-3 col-sm-offset-6 text-right">
												<label>TOTAL:</label>
											</div>
											<div class="col-sm-3">
												<input required type="number" step="any" class="form-control" name="total" id="total">
											</div>
										</div>
										<hr>
										<div class="alert alert-danger" id="mensaje_error">
											
										</div>
										<a   type="button"  class="btn btn-success btn-lg pull-left anterior">
											Anterior <i class="fa fa-arrow-left"></i>
										</a>
										<div class="pull-right ">
											<label  class="control-label" >
												<input type="checkbox" name="modo_pruebas" value="SI">
												Modo Pruebas
											</label> 
											<button type="submit" id="btn_facturar"  class="btn btn-success btn-lg ">
												Timbrar <i class="fa fa-arrow-right"></i>
											</button> 
										</div>
									</form> 
								</div> 
							</div>
						</div>
						
					</div>		
				</div>
				
				
			</div>
			
			<hr>
			<?php include("scripts.php");?>
			<script src="js/nomina_nueva.js"></script>
			
			
			<form id="form_cliente" class="form" autocomplete="off">
				<div id="modal_cliente" class="modal fade" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title text-center">Datos del Cliente</h4>	
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Id</label>
											<input type="text" readonly id="id_clientes" name="id_clientes" class="form-control">
										</div>
										<div class="form-group">
											<label for="">Razon Social</label>
											<input type="text" name="razon_social_clientes" id="razon_social_clientes" class="form-control">
										</div>
										<div class="form-group">
											<label for="">RFC</label>
											<input type="text" name="rfc_clientes" id="rfc_clientes" class="form-control">
										</div>
										<div class="form-group">
											<label for="">Correo</label>
											<input type="email" name="correo_clientes" id="correo_clientes" class="form-control">
										</div>
									</div>
								</div>		
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">
									<i class="fa fa-times"></i> 
									Cerrar
								</button>
								<button type="submit" class="btn btn-success">
									<i class="fa fa-save" aria-hidden="true"></i> 
									Guardar
								</button>
							</div>
							
						</div>
					</div>
				</div>
			</form>
		</body>
	</html>																																														