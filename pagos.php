<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "administracion";
	
	if(isset($_GET["nombre_alumnos"])){
		$nombre_alumnos = $_GET["nombre_alumnos"];
		$id_alumnos = $_GET["id_alumnos"];
	}
	else{
		$nombre_alumnos = "";
		$id_alumnos = "";
	}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registrar Pago</title>

		<?php include("styles.php");?>
	
  </head>
  <body>

  <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-primary">
				  <div class="panel-heading"><h4 class="text-center">Nuevo Pago</h4></div>
					<div class="panel-body">
						
						<div class="row">
							<div class="col-sm-12">
								<form id="form_nuevo_pago" class="" method="GET" action="pagos.php">
									<div class="form-group">
											<label for="buscar_alumnos">Nombre del Alumno: 
												<a href="#" data-toggle="modal" data-target="#modal_nuevo_alumno">Nuevo</a>
												</label>
											<div class="input-group">
												<input autofocus placeholder="Escribe para Buscar" class="form-control" id="buscar_alumnos" required name="cliente" type="text" value="<?php echo $nombre_alumnos;?>"/>
												<span id="id_alumnos_span" class="input-group-addon">	
													<?php echo $id_alumnos;?>
												</span>
											</div>
									</div>
									<div class="form-group hidden">
											<label for="id_alumnos">Id del alumno:</label>
											<input class="form-control" readonly id="id_alumnos" required name="id_alumnos" type="text" value="<?php echo $id_alumnos;?>"/>
									</div>
									
									<input class="hidden" name="descripcion_pagos" id="descripcion_pagos">
									
									<div class="form-group show_articulos " id="conceptos_articulos">
											<label for="buscar_articulo">Artículo:</label>
											<div class="input-group">
												<input placeholder="Escribe para Buscar" class="form-control" id="buscar_articulo" required name="descripcion_pagos" type="text"/>
												<span id="id_articulos_span" class="input-group-addon">	
												</span>
												<input id="id_articulos" name="id_costos" class="hidden">
												<input id="es_articulo" name="es_articulo" class="hidden" value="1">
											</div>
									</div>
									<div id="datos_precio" class="">
										<div class="form-group">
											<label for="cantidad_costos">Precio:</label>
											<input required class="form-control" id="cantidad_costos" name="cantidad_costos" type="text">
										</div>
										
									
									
									
										<div class="form-group">
											<label for="total_costos">Total:</label>
											<input class="form-control" id="total_costos" required name="total_costos" type="text">
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success btn-lg btn-block" disabled>
											<i class="fa fa-money" ></i> Pagar
										</button >
									</div>
								</form>
							</div><!--col-sm-12 !-->
						</div><!--row !-->
					</div><!-- panel-body !-->
				</div><!-- panel !-->
			</div><!--col-md-4 !-->
		</div><!--row !-->
	</div><!--container-fluid !-->
	
	<?php include("forms/form_nuevo_alumno.php")?>
		<?php  include('scripts.php'); ?>
		<script src="js/pagos.js"></script>
  </body>
</html>