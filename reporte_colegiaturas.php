<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "reportes";
	
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		
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
					<form id="form_reporte" class="form-inline">
						
						<div class="form-group">
							<label for="id_grupos">Grupo:</label>
							<select class="form-control" id="id_grupos" required name="id_grupos" >
								<option value="">Elige...</option>
								<?php
									$consultargrupo = "SELECT * FROM grupos LEFT JOIN niveles USING(id_niveles)";
									
									$resultado = mysqli_query($link,$consultargrupo) or die('Error en la DB '.mysqli_error($link));
									
									while($row = mysqli_fetch_assoc($resultado)){
										$id_value = $row['id_grupos'];
										$text = $row['nombre_grupos'];
										$text2 = $row['nombre_niveles'];
									?>
									<option value="<?php echo $id_value;?>"><?php echo $text."\n".$text2; ?></option>
									<?php
									}
								?>
							</select>
						</div>	
						
						<div class="form-group">
							<label for="id_ciclos">Ciclo:</label>
							<select class="form-control" name="id_ciclos" id="id_ciclos">
								<option value="4">2017-2018</option>
								<option value="5"  >2018-2019</option>
								<option value="6" selected >2019-2020</option>
							</select>
						</div>
						<div class="form-group">	
							<button type="submit" class="btn btn-success" id="btn_fechas">
								<i class="fa fa-search" ></i> Buscar
							</button>
						</div>
						
						<button class="btn btn-info btn-exportar pull-right " id="btn_exportar" type="button">
							<i class="fa fa-file-excel-o"></i> Exportar a Excel
						</button>
						
						
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
		<script src="js/reporte_colegiaturas.js"></script>
	</body>
</html>