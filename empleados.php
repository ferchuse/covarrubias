<?php
	include("login/login_success.php");
	include_once("conexi.php");
	$link = Conectarse();
	$menu_activo = "facturacion";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empleados</title>
		
		<?php include("styles.php");?>
		
	</head>
  <body>
		
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		<div class="container">
			<h2 class="text-center">
				Empleados
				<button class="btn btn-lg btn-success nuevo pull-right">
					<i class="fa fa-plus"></i> Agregar
				</button>			
			</h2>
			<hr>
			
			<div class="row">
				<div class="col-md-12">
					
				</div>
			</div>
		</div>
		
		<div class="container" >
			<div class="table-responsive" id="lista_registros">
				<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
			</div>
		</div>
		
		
		<?php include("forms/empleados.php"); ?>
		
		<?php  include('scripts.php'); ?>
		<script src="js/empleados.js"></script>
		
	</body>
</html>
