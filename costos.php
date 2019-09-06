<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "control";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Costos de Colegiaturas</title>
	<?php include("styles.php");?>
	
  </head>
  <body>

   <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	
	
	<div class="container" >
		<div class="row">
			<div class="col-sm-12 text-center" >
				<h3 >
					Costos
					<button class="btn btn-success pull-right" id="btn_nuevoCosto">
						<i class="fa fa-plus" ></i> Agregar
					</button> 
				</h3>
			</div>
		</div>
	
		<hr>
		<div class="row">
			<div class="col-sm-12" id="lista_costos">
				<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
			</div>
		</div>
	</div>
	
	<div id="form_costos">
		<?php include('forms/costos.php'); ?>
	</div>
	
		<?php  include('scripts.php'); ?>
		<script src="js/costos.js"></script>
  </body>
</html>