<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "reportes";
	
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
	<style>
		.btn-success{
			margin-top: 25px;
		}
	</style>
    <title>REPORTES DE EGRESOS</title>

	<?php include("styles.php");?>
	
  </head>
  <body>

   <div class="container-fluid">
		<?php include("menu.php");?>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-center">Reportes de egresos</h3>
				<hr>
				<form id="form_reporte">
				<div class="row">
					<div class="col-md-2 text-center">
						<label for="desde_fecha">DESDE:</label>
						<input required class="form-control" type="date" name="desde_fecha" id="desde_fecha" value="<?php echo $fecha_inicial;?>">
					</div>
					<div class="col-md-2 text-center">
						<label for="hasta_fecha">HASTA:</label>
						<input required class="form-control" type="date" name="hasta_fecha" id="hasta_fecha" value="<?php echo $fecha_final;?>">
					</div>
						<div class="col-md-2 text-center">
							<button type="submit" class="btn btn-success" id="btn_fechas">
								<i class="fa fa-search" aria-hidden="true"></i> Buscar
							</button>
						</div>
					</form>
				</div>
				<br>
				<div class="row">
					<div id="reportes" class="text-center">
					
					</div>
				</div>
			</div>
		</div>
	</div>
	
		<?php  include('scripts.php'); ?>
		<script src="js/reportesEgresos.js"></script>
  </body>
</html>