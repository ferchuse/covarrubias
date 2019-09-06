<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "principal";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PRINCIPAL</title>

	<?php include("styles.php");?>
	
  </head>
  <body>
   <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	<?php  include('scripts.php'); ?>
	<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
  </body>
</html>