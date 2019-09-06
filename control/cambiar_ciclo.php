<?php
	
	include("generar_cobros.php");
	include("../conexi.php");
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	$link = Conectarse();
	
	$id_alumnos=$_GET["id_alumnos"];
	$id_ciclos=$_GET["id_ciclos"];
	$id_grupos=$_GET["id_grupos"];
	$id_plan=$_GET["id_plan"];
	$reinscripcion= 	$_GET["reinscripcion"];
	$colegio="covarrubias";
	//echo var_dump(generarcobros($id_alumnos, $id_ciclos,$link,"covarrubias"));
	
	if($reinscripcion =="NO"){
		$desinscribir = "UPDATE inscripciones SET activa='0' WHERE id_alumnos='$id_alumnos'";
		
		if(mysqli_query($link, $desinscribir)){
			$respuesta['estatus_desinsc'] = 'success';
			
			}else{
			$respuesta['estatus_desinsc'] = 'error';
			$respuesta['mensaje_desinsc'] = 'Error en $desinscribir'.mysqli_error($link);
		}
	}
	
	
	$inscribir = "INSERT INTO inscripciones SET 
		id_ciclos='$id_ciclos', 
		id_grupos='$id_grupos',
		id_alumnos='$id_alumnos',
		id_costos='$id_plan'
		
		ON DUPLICATE KEY UPDATE 
		id_ciclos='$id_ciclos', 
		id_grupos='$id_grupos',
		id_alumnos='$id_alumnos',
		id_costos='$id_plan'
		";
	
	
	if(mysqli_query($link, $inscribir)){
	$respuesta['estatus_insc'] = 'success';
	$respuesta["colegiaturas"] = generarcobros($id_alumnos,$id_ciclos,$link,$colegio, true);
	}else{
	$respuesta['estatus_insc'] = 'error';
	$respuesta['mensaje_insc'] = 'Error en '.mysqli_error($link);
	}
	
	
	$cambiar_plan = "UPDATE alumnos SET id_plan = '$id_plan' WHERE id_alumnos='$id_alumnos'";
	
	
	 
	if(mysqli_query($link, $cambiar_plan)){
		$respuesta['estatus_plan'] = 'success';
		
		}else{
		$respuesta['estatus_plan'] = 'error';
		$respuesta['mensaje_plan'] = 'Error en '.mysqli_error($link);
	}
	
	echo json_encode($respuesta);
?>