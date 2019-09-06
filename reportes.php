<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "reportes";
	
	
	$dt_fecha_inicial= new DateTime("first day of this month");
	$dt_fecha_final = new DateTime("last day of this month");
	
	$fecha_inicial = $dt_fecha_inicial->format("Y-m-d");
	$fecha_final = $dt_fecha_final->format("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			.btn-success{
			margin-top: 25px;
			}
			.btn-exportar{
			margin-top: 25px;
			}
		</style>
    <title>Reportes</title>
		
		<?php include("styles.php");?>
		
	</head>
  <body>
		
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h4 class="text-center">Reportes de Pagos</h4>
					<hr>
					<form id="form_reporte">
						<div class="row">
							<div class="col-md-2 text-center">
								<label for="desde_fecha">DESDE:</label>
								<input required class="form-control" type="date" name="desde" id="desde_fecha" value="<?php echo $fecha_inicial?>">
							</div>
							<div class="col-md-2 text-center">
								<label for="hasta_fecha">HASTA:</label>
								<input required class="form-control" type="date" name="hasta" id="hasta_fecha" value="<?php echo $fecha_final?>">
							</div>
							<div class="col-md-2 text-center hidden">
								<label for="id_nivel">Nivel:</label>
								<select  class="form-control" id="id_niveles" name="filtros[id_niveles]" disabled>
									<option value="">Todos</option>
									<?php 
										$consulta = "SELECT * FROM niveles WHERE activo_niveles=1";
										
										$resultado = mysqli_query($link,$consulta) or die('Error en la DB $consulta '.mysqli_error($link));
										
										while($row = mysqli_fetch_assoc($resultado)){
											
											$id_niveles = $row['id_niveles'];
											$nombre_niveles = $row['nombre_niveles'];
										?>
										<option value="<?php echo $id_niveles; ?>"><?php echo $nombre_niveles; ?></option>	
										<?php
										}
									?>
									
								</select>
							</div>
							<div class="col-md-2 text-center hidden" id="concepto">
								<label for="id_costos">Concepto:</label>
								<select  class="form-control" id="id_costos" for="id_costos" name="filtros[id_costos]" disabled>
									<option value="">Todos</option>	
									<?php 
										$listarConcepto = "SELECT * FROM costos LEFT JOIN niveles USING(id_niveles)";
										
										$resultado = mysqli_query($link,$listarConcepto) or die('Error en la DB $listarConcepto '.mysqli_error($link));
										
										while($row = mysqli_fetch_assoc($resultado)){
											$id_costos = $row['id_costos'];
											$nombre_niveles = $row['nombre_niveles'];
											$concepto_costos = $row['concepto_costos'];
										?>
										<option value="<?php echo $id_costos; ?>"><?php echo $concepto_costos." ".$nombre_niveles; ?></option>
										<?php
										}
									?>
									
								</select>
							</div>
							<div class="col-md-2 text-center">
								<button type="submit" class="btn btn-success" id="btn_fechas">
									<i class="fa fa-search" ></i> Buscar
								</button>
							</div>
							<div class="col-md-2 text-center">
								<button class="btn btn-info btn-exportar" id="btn_exportar" type="button">
									<i class="fa fa-file-excel-o"></i> Exportar a Excel
								</button>
							</div>
						</div>
					</form>
					<br>
					<div class="row">
						<div id="reportes" class="text-center">
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php  include('scripts.php'); ?>
		<script src="js/reportes.js"></script>
	</body>
</html>