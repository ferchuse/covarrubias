<?php
	include("login/login_success.php");
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
    <title>Lista de Artículos </title>

	<?php include("styles.php");?>
	
  </head>
  <body>

   <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-center">Lista de Artículos 
				<button class="btn btn-success pull-right" id="btn-altaArticulos">
					<i class="fa fa-plus" ></i> Agregar
				</button></h3>
							
			</div>
		</div>
	</div>
	<hr>
	<div class="container" id="listar_articulos">
		<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
	</div>
	
	<div class="container">
		<?php include("forms/articulos_varios.php"); ?>
	</div>
	
		<?php  include('scripts.php'); ?>
		<script src="js/articulos_varios.js"></script>
		
  </body>
</html>
