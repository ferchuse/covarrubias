<?php
	include("login/login_success.php");
	include_once("conexi.php");
	$link = Conectarse();
	$menu_activo = "control";
	
	
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Credenciales</title>
		<link href="css/imprimir_credenciales.css" rel="stylesheet" media="screen">
		<link href="css/imprimir_credenciales.css" rel="stylesheet" media="print">
		<?php include("styles.php");?>
		<style>
		.frente{margin-right: 10px;}
		</style>
	</head>
	<body>
		 
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		<div class="container">
			<h2 class="text-center hidden-print">
				
				Credenciales 
				
				<button class="btn btn-info pull-right" type="button" onclick="window.print()" title="Imprimir" >
					<i class="fa fa-print" ></i> Imprimir
				</button>
			</h2>
			<hr class="hidden-print">
			
			<?php 
				
				$alumnos_array = $_GET["alumnos"];
				$alumnos = implode(",", $alumnos_array );
				$consulta = "SELECT * FROM alumnos 
				LEFT JOIN niveles USING (id_niveles)
				LEFT JOIN inscripciones USING(id_alumnos)
				LEFT JOIN grupos USING(id_grupos)
				LEFT JOIN padres USING(id_alumnos)
				LEFT JOIN madres USING(id_alumnos)
				WHERE id_alumnos IN ($alumnos)
				AND id_ciclos = 5";
				
				$result = mysqli_query($link,$consulta) or die("Error en $consulta".mysqli_error($link));
				
				
			?>
			<div class="container">
				<?php
					while($fila = mysqli_fetch_assoc($result)){
						
						
					?>
					<div class="row">
						
						<div class="credencial frente">
							<div class="row">
								<div class="logo_credencial">
									<img class="img-responsive" src="img/logo_credencial.png" >
								</div>
								<div class="foto">
									
								</div>
								
								<div class="datos_alumno">
									<p  class="nombre">
										NOMBRE: <?php echo $fila["nombre_alumnos"].' '.$fila["apellidop_alumnos"].' '.$fila["apellidom_alumnos"];?>
									</p>
									<p class="nivel">NIVEL: <?php echo $fila["nombre_niveles"];?></p>
									<p class="grupo">GRUPO: <?php echo $fila["nombre_grupos"];?></p>
								</div>
							</div>
						</div>
						
						<div class="reverso credencial">
							<h5 >Datos de Contacto:</h5>
							<label>Madre: </label>  <?php echo $fila["nombre_madres"]. " ". $fila["paterno_madres"]. " ". $fila["materno_madres"] ;?><br>
							<label>Teléfono: </label> <?php echo $fila["telefono_madres"]. ", ". $fila["telefonoreferencia_madres"] ;?> <br>
							<label>Padre: </label>  <?php echo $fila["nombre_padres"]. " ". $fila["paterno_padres"]. " ". $fila["materno_padres"] ;?><br>
							<label>Teléfono: </label> <?php echo $fila["telefono_padres"]. ", ". $fila["telefonoreferencia_padres"] ;?> <br>
							<small>
								Felipe Carrillo Puerto 606, Morelos 1a. Sección, 42040 Pachuca, Hgo.
								Teléfono: 01 771 107 3571
							</small>
						</div>
						
					</div>
					<hr>
					<?php
						
					}
					
				?>
			</div>
		</div>
		
		<?php  include('scripts.php'); ?>
		<script src="js/maestros.js"></script>
		
	</body>
</html>
