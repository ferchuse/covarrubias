<?php
include("login/login_success.php");
include("conexi.php");
$link = Conectarse();
$menu_activo = "facturas";

$dt_fecha_inicial= new DateTime("first day of this month");
$dt_fecha_final = new DateTime("last day of this month");

$fecha_inicial = $dt_fecha_inicial->format("Y-m-d");
$fecha_final = $dt_fecha_final->format("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Factura Global</title>
		<?php include("styles.php");?>
	
  </head>
<body>


<div class="container-fluid">
	<?php include("menu.php");?>
</div>


	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 ">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>
							Datos de la Factura
						</h4>
					</div>
					<div class="panel-body">
						<form id="form_factura">
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
									<label class="control-label" ><input type="checkbox" name="modo_pruebas" value="SI">
											<i class="fa fa-flask"></i> Modo Pruebas</label>
								</div>
							
							</form>
					</div>
				</div>
			</div>
		
			<div class="col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading"><h4>Pagos a Facturar</h4></div>
					<div class="panel-body">
						<form id="form_fechas">
						<div class="row">
							<div class="col-sm-4">
								<label >Fecha Inicial</label>
								<input class="form-control" type="date" name="fecha_inicial" value="<?php echo $fecha_inicial; ?>">
							</div>
							<div class="col-sm-4">
								<label >Fecha Final</label>
								<input class="form-control" type="date" name="fecha_final" value="<?php echo $fecha_final; ?>">
							</div>
							<div class="col-sm-4">
								<br>
								<button class="btn btn-primary submit-inline" type="submit" id="buscar_fechas">
									<i class="fa fa-search"></i> Buscar
								</button>
							</div>
						</div>
						</form>
						<hr>
						<div class="row"  id="lista_pagos">
							
						</div>
						<hr>
						<div id="mensaje_error" class="alert alert-danger hidden">
									
						</div>
						<div id="mensaje_timbrado" class="alert alert-success hidden">
							Facturando <i class="fa fa-spinner fa-spin"></i>
						</div>
						<div id="mensaje_pdf" class="alert alert-success hidden">
							Generando PDF <i class="fa fa-spinner fa-spin"></i>
						</div>
						<div id="mensaje_correo" class="alert alert-success hidden">
							Enviando Correo <i class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="pull-right">
							<button class="btn btn-success btn-lg" id="btn_facturar" form="form_factura" type="submit">
								<i class="fa fa-arrow-right"></i> Facturar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div> 
		
	</div>

<hr>
<?php include("scripts.php");?>
<script src="js/factura_global.js"></script>


</body>
</html>