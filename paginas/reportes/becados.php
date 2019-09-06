<?php
	include("../../login/login_success.php");
	include_once("../../conexi.php");
	$link = Conectarse();
	$menu_activo = "reportes";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de Becados</title>
		
		<?php include("../../css.php");?>
		
	</head>
  <body>
		
		<div class="container-fluid">
			<?php include("../../menu_paginas.php");?>
		</div>
		
		<h2 class="text-center">Reporte de Becados</h2>
		
		<div class="container">
			<div class="row">
				
			</div>
		</div>
	
		<div class="container" id="lista_registros">
			<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
		</div>
		
		<div class="container">
			<?php include("forms/becas.php"); ?>
		</div>
		
		<?php  include('../../js.php'); ?>
		<script src="js/becados.js"></script>
		
	</body>
</html>
