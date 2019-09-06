<?php
header("Content-Type: application/json");//espicifica el tipo de documento
include ("../conexi.php");
$link = Conectarse();
$respuesta = Array();


$tabla = "inscripciones";
$id_grupos = $_POST["id_grupos"];
$id_ciclos = $_POST["id_ciclos"];
	foreach($_POST["inscrito"] as $index => $id_alumnos){
		
		$query = "INSERT INTO inscripciones SET 
		id_grupos='$id_grupos',
		id_alumnos='$id_alumnos',
		id_ciclos='$id_ciclos'
		";
	}
$exec_query = 	mysqli_query($link,$query);


if($exec_query){
	$respuesta["estatus"] = "success";
	$respuesta["mensaje"] = "Agregado";
	$respuesta["query"] = $query;
}	
else{
	$respuesta["estatus"] = "error";
	$respuesta["mensaje"] = "Error en insert: $query  ".mysqli_error($link);		
}

echo json_encode($respuesta);
?>