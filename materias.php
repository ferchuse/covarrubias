<?php
	//include("login/login_success.php");
	include_once("conexi.php");
	$link = Conectarse();
	$menu_activo = "control";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Materias</title>

	<?php include("styles.php");?>
	
  </head>
  <body>

   <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	<h2 class="text-center">Materias</h2>
	<hr>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-success" id="btn-altaMaterias"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>			
			</div>
		</div>
	</div>
	<br><br>
	
	<div class="container" id="lista_materias">
		<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
	</div>
	
	<div class="container">
		<?php include("forms/materias.php"); ?>
	</div>
	
		<?php  include('scripts.php'); ?>
		<script src="js/materias.js"></script>
		
  </body>
</html>
