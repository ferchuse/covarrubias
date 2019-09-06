<?php

include('../conexi.php');
$link = Conectarse();

$respuesta = array();

$id_alumno = $_POST['id_alumno'];

$consulta = "UPDATE alumnos SET estatus_alumnos='INSCRITO' WHERE id_alumnos='".$id_alumno."'";

if(mysqli_query($link,$consulta)){
	$respuesta['estatus'] = "success";
}else{
	$respuesta['estatus'] = "error";
	$respuesta['mensaje'] = "Error en la DB ".mysqli_error($link);
}

echo json_encode($respuesta);

?>