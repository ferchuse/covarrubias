<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "alumnos";
	$id_alumnos = $_GET['id_alumnos'];
	$id_ciclos = $_GET['id_ciclos'];
	
	$consulta = "SELECT DISTINCT
	*
FROM
	alumnos
LEFT JOIN padres USING (id_alumnos)
LEFT JOIN personas_autorizadas USING (id_alumnos)
WHERE
	id_alumnos = $id_alumnos";
	$result = mysqli_query($link,$consulta) or die('Error en '.mysqli_error($link));
	while($row = mysqli_fetch_assoc($result)){
		extract($row);
	}
	
	
	
	
$cons_alumnos = "SELECT *
FROM
	alumnos
LEFT JOIN descuentos USING (id_descuentos)
LEFT JOIN inscripciones USING (id_alumnos)
LEFT JOIN grupos USING(id_grupos)
LEFT JOIN grados ON grupos.id_grados = grados.id_grados
LEFT JOIN niveles ON niveles.id_niveles = grados.id_niveles
WHERE id_alumnos = '$id_alumnos' and id_ciclos = $id_ciclos";

$result_alumnos =  mysqli_query($link, $cons_alumnos);

if($result_alumnos ){
	while($fila_alumnos = mysqli_fetch_assoc($result_alumnos)){
		
		$id_niveles = $fila_alumnos["id_niveles"];
		$id_plan = $fila_alumnos["id_plan"];
		$id_beca_alumno = $fila_alumnos["id_descuentos"];
		$porc_beca = $fila_alumnos["porcentaje_descuentos"];
		$nombre_niveles = $fila_alumnos["nombre_niveles"];
		$id_ciclos = $fila_alumnos['id_ciclos'];
		$curp = $fila_alumnos["curp_alumnos"];
		$nivel = $fila_alumnos["nombre_grados"]." ". $fila_alumnos["nombre_niveles"];
	}
}
else{
	
	
}

function dame_costos($id_niveles, $id_plan, $link){
	$options ="";
	$consulta_costos = "SELECT *
	FROM
		costos
		WHERE  id_niveles = '$id_niveles'  ";

	$result_costos =  mysqli_query($link, $consulta_costos)	;

	if(mysqli_num_rows($result_costos) == 0)	{
		return "<option value=''>No hay Plan asignado</option>" ;
	}
	if($result_costos)	{
		while($fila_costos = mysqli_fetch_assoc($result_costos)){
			
			$id_costos = $fila_costos["id_costos"];
			$concepto_costos = $fila_costos["concepto_costos"];
			$selected = $id_costos == $id_plan ? "selected" : "";
			$options.= "<option $selected value='$id_costos'>$concepto_costos</option>";
		}
	}
	else{
		$options = "<option value=''>Ocurrio un Error $consulta_costos ".mysqli_error($link). "</option>" ;
	}
	return $options;
		
}

function dame_becas($id_beca_alumno, $link){
	$options ="";
	$consulta = "SELECT *
	FROM
		descuentos ";

	$result =  mysqli_query($link, $consulta)	;

	if($result)	{
		while($fila = mysqli_fetch_assoc($result)){
			
			$id_descuentos = $fila["id_descuentos"];
			$nombre_descuentos = $fila["nombre_descuentos"];
			$porc_beca = $fila["porcentaje_descuentos"];
			$selected = $id_descuentos == $id_beca_alumno ? "selected" : "";
			$options.= "<option $selected data-porc_beca='$porc_beca' value='$id_descuentos'>$nombre_descuentos($porc_beca%)</option>";
		}
	}
	else{
		$options = "<option value=''>Ocurrio un Error $consulta ".mysqli_error($link). "</option>" ;
	}
	return $options;
		
}

$meses =  array(
					"8" => "Inscripción", 
					"9" => "Septiembre", 
					"10" => "Octubre", 
					"11" => "Noviembre", 
					"12" => "Diciembre", 
					"1" => "Enero", 
					"2" => "Febrero", 
					"3" => "Marzo", 
					"4" => "Abril", 
					"5" => "Mayo", 
					"6" => "Junio", 
					"7" => "Julio"
);
?>




<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DETALLES ALUMNO</title>

	<?php include("styles.php");?>
	<link href="css/imprimir_preinscripcion.css" rel="stylesheet" media="all">
  </head>
  <body>

  <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	
	<div class="container visible-print">
		<div class="row">
			<div class="col-md-4">
				<img src="login/login_logo.png" width="30%">
			</div>
		</div>
	</div>
	
	<h3 class="text-center visible-print">COLEGIO MIGUEL COVARRUBIAS 2017-2018</h3>
	<hr class="visible-print">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-9">
				<ul class="nav nav-pills nav-justified hidden-print">
					<li class="active"><a data-toggle="pill" href="#div_colegiaturas">Colegiaturas</a></li>
					<li><a data-toggle="pill" href="#div_datos_personales">Datos Personales</a></li>
				</ul>
				
				<div class="tab-content">
					<div id="div_colegiaturas" class="tab-pane fade in active">
							<?php include("forms/form_colegiaturas.php"); ?>
					</div>
					<div id="div_datos_personales" class="tab-pane fade ">
					
						<?php include("forms/detalles_alumnos.php"); ?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				
			</div>
		</div>
	</div>
	
		<?php  include('scripts.php'); ?>
		
		<script src="js/detalles_alumnos.js">
		</script>
  </body>
</html>