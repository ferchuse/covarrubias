<?php
	include("login/login_success.php");
	include_once("conexi.php");
	$link= Conectarse();
	$menu_activo = "reportes";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Historial de Pagos</title>
	<?php include("styles.php")?>
</head>
<body>
	<div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	<div class="container">
		<h4 class="text-center">Historial de Pagos por alumno</h4>
		<hr>
		
		
			<div class="row">
				<div class="col-sm-12">
					<form id="form_pagos" class="form-inline">
						<input  class="form-control hidden" type="text" name="id_alumnos" id="id_alumnos">
							
						<div class="form-group  hidden-print">
							<label for="nombre_alumnos">Nombre del Alumno:</label>
							<input required class="form-control" type="text" name="nombre_alumnos" id="nombre_alumnos">
						</div>						
						
							<button class="btn btn-success hidden-print" id="btn_balumno">
								<i class="fa fa-search"></i> Buscar
							</button>
							<span class="pull-right">
								<button class="btn btn-info  hidden-print" type="button" id="btn_exel"><i class="fa fa-file-excel-o"></i> Exportar a Exel</button>
								<button class="btn btn-default  hidden-print" type="button" id="btn_imprimir"><i class="fa fa-print"></i> Imprimir</button>
							</span>
					</form>
				</div>
			</div>
	
	<?php include("historial_pagos.php")?>
		
		<?php include('scripts.php');?>
		<script src="js/tablaalumnos_pagos.js"></script>
		
</body>
</html>