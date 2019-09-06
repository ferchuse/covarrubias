<?php
	//include("login/login_success.php");
	include_once("conexi.php");
	$link = Conectarse();
	$menu_activo = "alumnos";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASPIRANTES</title>

	<?php include("styles.php");?>

  </head>
  <body>

   <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	<h2 class="text-center">Aspirantes</h2>
	<hr>
	<br><br>
	
	<div class="container">
		<?php include('control/lista_aspirantes.php'); ?>
	</div>
	
	<div class="container">
		<?php include('control/control_alumnos.php'); ?>
	</div>
	
		<?php  include('scripts.php'); ?>
		<script src="js/lista_alumnos.js"></script>
		
  </body>
</html>
