<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "alumnos";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRO DE ALUMNOS</title>

	<?php include("styles.php");?>
	<link href="css/imprimir_preinscripcion.css" rel="stylesheet" media="all">
  </head>
  <body>

  <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	<div class="container visible-print">
		<div class="row">
			<div class="col-sm-4">
				<img src="login/login_logo.png" width="30%">
			</div>
		</div>
	</div>
	<h3 class="text-center visible-print">COLEGIO MIGUEL COVARRUBIAS <span id="nombre_ciclo"></span></h3>
	
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php include("forms/preinscripciones.php"); ?>
			</div>
		</div>
	</div>
	
		<?php  include('scripts.php'); ?>
		<script src="js/preinscripciones.js">
		</script>
  </body>
</html>