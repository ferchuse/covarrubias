<?php 
header("Content-Type: application/json");
include('../conexi.php');
$link = Conectarse();

$respuesta = array();


$id_alumnos = $_POST['id_alumnos'];

$consultarPadre = "SELECT * FROM padres WHERE id_alumnos='$id_alumnos'";
$fila = mysqli_query($link,$consultarPadre) or die('Error en DB '.mysqli_error($link));
$numFilas = mysqli_num_rows($fila);

if($numFilas > 0){
	$respuesta['mensaje'] = 'si existe';
	$consulta = "DELETE alumnos, padres FROM padres 
		JOIN alumnos ON padres.id_alumnos = alumnos.id_alumnos
		WHERE padres.id_alumnos = '$id_alumnos'";

		if(mysqli_query($link,$consulta)){
			$respuesta['estatus'] = 'success';
		}else{
			$respuesta['estatus'] = 'error';
			$respuesta['error'] = 'Error en DB'.mysqli_error($link);
		}
		
}else{
	
	$respuesta['mensaje'] = 'no existe';
	$consulta = "DELETE FROM alumnos WHERE id_alumnos='$id_alumnos'";
	
	if(mysqli_query($link,$consulta)){
		$respuesta['estatus'] = 'success';
	}else{
		$respuesta['estatus'] = 'error';
		$respuesta['error'] = 'Error en la DB '.mysqli_error($link);
	}
	
}

echo json_encode($respuesta);
?>