<?php
include("login/login_success.php");
	include_once("conexi.php");
	$link= Conectarse();
	$menu_activo = "control";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ciclo Escolar</title>
	<?php include("styles.php")?>
</head>
<body>
	<div class="container-fluid">
		<?php include("menu.php");?>
	</div>
		<h2 class="text-center">Ciclo Escolar</h2>
		<hr>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" id="btn-altaCiclo">
						<i class="fa fa-plus" aria-hidden="true"></i>
							Agregar
						</button>
					</div>
				</div>
			</div>
				<div calss="container" id="listar_ciclo">
					<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i>
					</div>
				</div>
					<div class="container">
						<?php include("forms/ciclo_escolar.php");?>
					</div>
						<?php include('scripts.php');?>
						<script src="js/ciclo_escolar.js"></script>
		</hr>
</body>
</html>