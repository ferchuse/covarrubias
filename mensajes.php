<?php
	include_once("conexi.php");
	$link= Conectarse();
	$menu_activo = "administracion";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTIFICACIONES</title>
	<?php include("styles.php")?>
</head>
<body>
	<div class="container-fluid">
		<?php include("menu.php");?>
	</div>
		<h2 class="text-center">Notificaciones</h2>
		<hr>
		<div class="container">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" id="btn-altaNew">
						<i class="fa fa-plus" aria-hidden="true"></i>
							Nuevo mensaje
						</button>
					</div>
				</div>
			</div>
					<div class="container">
						<?php include("forms/form_notification.php");?>
					</div>
						<?php include('scripts.php');?>
						<script src="js/mensajes.js"></script>
		</hr>
</body>
</html>