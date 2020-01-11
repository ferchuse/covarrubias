<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "facturas";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Factura</title>
		<?php include("styles.php");?>
		
	</head>
	<body>
		
		
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		
		<form id="form_factura">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 ">
						<ul class="nav nav-pills nav-justified">
							<li class="active">
								<a data-toggle="tab" id="tab_alumno" href="#paso1">	1-Alumno</a>
							</li>
							<li class="disabled">
								<a class="" data-toggle="tab" id="tab_cliente"  href="#datos_cliente">2-Cliente</a>
							</li>
							<li class="disabled">
								<a class=""  data-toggle="tab" id="tab_factura" href="#datos_factura">3-Factura</a>
							</li>
							<li class="disabled">
								<a class="" data-toggle="tab" id="tab_conceptos" href="#datos_conceptos">4-Conceptos</a>
							</li>
						</ul>
						<div class="tab-content"> 
							<div class="tab-pane fade in active" id="paso1">
								<div class="panel panel-primary ">
									<div class="panel-body">
										
										<div class="form-group hidden">
											<label for="">Id Alumno *</label>
											<input id="id_alumnos" readonly type="text" name="id_alumnos" class="form-control">
										</div>
										<div class="form-group">
											<label for="">Nombre del Alumno *</label>
											<input id="nombre_alumnos" placeholder="Escribe para buscar" type="text" name="nombre_alumnos" class="form-control">
										</div>
										<div class="form-group">
											<label for="">CURP: *</label>
											<input  required type="text" id="curp" name="curp" class="form-control">
										</div>
										<div class="form-group">
											<label for="nivel">Nivel: *</label>
											<input class="form-control"  id="nivel" required name="nivel" >
										</div>
										
										<button disabled  type="button"  class="btn btn-success btn-md pull-right next">
											Siguiente <i class="fa fa-arrow-right"></i>
										</button>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="datos_cliente">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h4>
											2-Datos del Cliente
										</h4>
									</div>
									<div class="panel-body">
										<div class="form-group hidden">
											<label for="">Id</label>
											<input type="text" readonly id="id_clientes" name="id_clientes" class="form-control" >
										</div>
										<div class="form-group">
											<label for="">Razon Social</label>
											<input type="text" placeholder="Escribe para Buscar" name="razon_social_clientes" id="razon_social_clientes" class="form-control" >
										</div>
										<div class="form-group">
											<label for="">RFC</label>
											<input type="text" name="rfc_clientes" id="rfc_clientes" class="form-control" >
										</div>
										
										<div class="form-group">
											<label for="">Correo</label>
											<input type="email" name="correo_clientes" id="correo_clientes" class="form-control">
										</div>
										<a   type="button"  class="btn btn-success btn-md pull-left anterior">
											Anterior <i class="fa fa-arrow-left"></i>
										</a>
										<button type="button"  class="btn btn-success btn-md pull-right next">
											Siguiente <i class="fa fa-arrow-right"></i>
										</button>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="datos_factura">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h4>
											3-Datos de la Factura
										</h4>
									</div>
									<div class="panel-body">
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
										<div class="form-group hidden">
											<label for="">Metodo de pago</label>
											<select id="metodo_pago" name="metodo_pago" class="form-control" >
												<option value="">Seleccione...</option>
												<option selected  value="PUE">
													Pago en una sola exhibición
												</option>
												<option value="PPD" >
													Pago en parcialidades o diferido
												</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Num de Cuenta</label>
											<input type="text" name="num_cuenta" id="num_cuenta" class="form-control" placeholder="opcional">
											
										</div>
										<div class="form-group">
											<label for="">Serie:</label>
											<input type="text" name="serie" id="serie" class="form-control" placeholder="opcional" value="A">
											
										</div>
										<div class="form-group">
											<label for="">Folio:</label>
											<input type="text" name="folio" id="folio" class="form-control" placeholder="opcional">
										</div>
										<div class="form-group hidden">
											<label for="">Lugar de Expedición</label>
											<input type="text" name="lugar_expedicion" id="lugar_expedicion" class="form-control" value="42040">
										</div>
										<div class="form-group hidden">
											<label for="">Tipo de Comprobante</label>
											
											<select id="tipocomprobante" name="tipocomprobante" class="form-control" >
												<option value="">Seleccione...</option>
												<option value="E">E Egreso</option>
												<option selected value="I">I Ingreso</option>
												<option value="N">N Nómina</option>
												<option value="P">P Pago</option>
												<option value="T">T Traslado</option>
											</select> 
										</div>
										
										<div class="form-group hidden">
											<label class="control-label" for="regimen_emisores">Régimen fiscal<span class="required-validation-error">*</span>:</label>
											<select id="regimen_emisores" name="regimen_emisores" class="form-control">
												<option value="">Seleccione...</option>
												
												<option selected value="621">621 Incorporación Fiscal</option>
											</select>
										</div>
										<div class="form-group ">
											<label class="control-label" ><input type="checkbox" name="modo_pruebas" value="SI"> Modo Pruebas</label>
											
										</div>
										<a  type="button"  class="btn btn-success btn-md pull-left anterior">
											Anterior <i class="fa fa-arrow-left"></i>
										</a>
										<a   type="button"  class="btn btn-success btn-md pull-right next">
											Siguiente <i class="fa fa-arrow-right"></i>
										</a>
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
										<div class="row">
											<div class="col-sm-12" id="pagos_facturar">
												
											</div>
										</div>
										<h3>
											<label>
												<input type="checkbox" id="check_agregar_conceptos"> 
												Agregar Conceptos Manualmente
											</label> 
											<button type="button" class="btn btn-success pull-right" id="agregar_concepto">
												<i class="fa fa-plus"></i> Agregar Concepto
											</button>
										</h3>
										<div class="row">
											<div class="form-group col-sm-1">
												<label>CANTIDAD</label>
											</div>	 
											<div class="form-group col-sm-1">
												<label>UNIDAD</label>
											</div>   
											<div class="form-group col-sm-2">
												<label>CLAVE</label>
											</div>  
											<div class="form-group col-sm-4">
												<label>DESCRIPCIÓN</label>
											</div> 
											<div class="form-group col-sm-1">
												<label>PRECIO UNITARIO</label>
												
											</div>
											<div class="form-group col-sm-1"> 
												<label>IMPORTE</label>
												
											</div>
											<div class="form-group col-sm-1">
												<label>DESCUENTO</label>
											</div>
										</div>
										<div id="div_conceptos">
											<div class="row fila_concepto">
												
												<div class="form-group col-sm-1">
													<input required type="number" min="0" step=".01" disabled name="cantidad[]" class="form-control cantidad conceptos" value="1">
												</div>	
												<div class="form-group col-sm-1">
													<select disabled name="clave_unidad[]" class="form-control clave_unidad conceptos">
														<option value="ACT">Actividad</option>
														<option value="E48">Unidad de Servicio</option>
													</select >
													<input type="text" class="nombre_unidades hidden" name="nombre_unidades[]" >
												</div>	
												<div class="form-group col-sm-2">
													<select disabled name="clave_productos[]" class="form-control conceptos">
														<option>86121500</option>
														<option>86121501</option>
														<option>86121503</option>
													</select >
												</div>	 
												<div class="form-group col-sm-4">
													<input required value="COLEGIATURA MENSUAL " placeholder="ESCRIBA EL MES O MESES, EJ: OCTUBRE" disabled name="descripcion[]" class="form-control conceptos">
												</div> 
												<div class="form-group col-sm-1">
													
													<input required type="number" min="1" step=".01" disabled name="precio_unitario[] " class="form-control precio_unitario conceptos">
												</div>
												<div class="form-group col-sm-1"> 
													
													<input required readonly type="number" min="1" step=".01" disabled name="importe[]" class="form-control importe conceptos">
												</div>
												<div class="form-group col-sm-1">
													
													<input  disabled value="0" type="number"  step=".01" name="descuento[]" class="form-control descuento conceptos">
												</div>
												<div class="col-sm-1">
													<button type="button" class="btn btn-danger btn_borrar" title="Eliminar">
														<i class="fa fa-times"></i>
													</button>
												</div>
												
												
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-sm-3 col-sm-offset-6 text-right">
												<label>SUBTOTAL:</label>
											</div>
											<div class="col-sm-3">
												<input required type="number" class="form-control" name="subtotal" id="subtotal">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-3 col-sm-offset-6 text-right">
												<label>DESCUENTO:</label>
											</div>
											<div class="col-sm-3">
												<input type="number" value="0" class="form-control" name="descuento_total" id="descuento">
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-3 col-sm-offset-6 text-right">
												<label>TOTAL:</label>
											</div>
											<div class="col-sm-3">
												<input required type="number" class="form-control" name="total_pagos" id="total">
											</div>
										</div>
										<div class="alert alert-danger" id="mensaje_error">
											
										</div>
										<hr>
										<a   type="button"  class="btn btn-success btn-md pull-left anterior">
											Anterior <i class="fa fa-arrow-left"></i>
										</a>
										<button disabled type="submit" id="btn_facturar"  class="btn btn-success btn-md pull-right">
											Facturar <i class="fa fa-arrow-right"></i>
										</button>
									</div>
								</div>
							</div>
							
						</div>		
					</div>
					
					
				</div>
			</form>
			<hr>
			<?php include("scripts.php");?>
			<script src="js/facturas_nueva.js"></script>
			
			
			<form id="form_cliente" class="form">
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