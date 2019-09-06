<?php
	include("login/login_success.php");
	include_once("conexi.php");
	$link = Conectarse();
	$menu_activo = "administracion";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EGRESOS</title>

	<?php include("styles.php");?>
	
  </head>
  <body>

   <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	<div class="container">
		<h2 class="text-center">
			Egresos
			<button class="btn btn-success pull-right" id="btn-altaEgreso">
				<i class="fa fa-plus" ></i> Agregar
			</button>		
		</h2>
		<hr>
		<div class="row">
			<div class="col-md-3">
				<input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?php echo date("Y-m-d");?>">
			</div>
				<button type="submit" class="btn btn-success" id="btn_buscar"><i class="fa fa-search"></i> Buscar</button>
		</div>
	</div>
	<br>
	<div class="container text-center" id="listar_egresos">
		<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
	</div>
	
	<div class="container">
		<?php include("forms/egresos.php"); ?>
	</div>
	
		<?php  include('scripts.php'); ?>
		<script src="js/egresos.js"></script>
		
  </body>
</html>
