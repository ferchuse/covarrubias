<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "alumnos";
	$id_alumno = $_GET['id_alumnos'];
	$ciclo_actual = "2018-2019";
	$id_ciclos = 5;
	
	
	$consulta = "SELECT DISTINCT
	*
	FROM
	alumnos
	LEFT JOIN padres USING (id_alumnos)
	LEFT JOIN personas_autorizadas USING (id_alumnos)
	WHERE
	id_alumnos = $id_alumno";
	$result = mysqli_query($link,$consulta) or die('Error en '.mysqli_error($link));
	while($row = mysqli_fetch_assoc($result)){
		extract($row);
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos del Alumno</title>
		
		<?php include("styles.php");?>
		<link href="css/imprimir_preinscripcion.css" rel="stylesheet" media="print">
	</head>
  <body>
		
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		
		<div class="container visible-print">
			<div class="row">
				<div class="col-xs-1">
					<img src="login/login_logo.png" class="img-responsive">
				</div>
				<div class="col-xs-10">
					<h4 class="text-center visible-print">COLEGIO MIGUEL COVARRUBIAS 2018-2019</h4>
				</div>
			</div>
		</div>
		
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<?php include("forms/detalles_alumnos.php"); ?>
				</div>
			</div>
		</div>
		
		<?php  include('scripts.php'); ?>
		<script src="js/detalles_alumnos.js">
		</script>
	</body>
</html>