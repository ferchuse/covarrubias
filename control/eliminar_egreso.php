<?php
include('../conexi.php');
$respuesta = array();
$link = Conectarse();

$id_egreso = $_POST['id_egreso'];

$consulta = "UPDATE egresos SET estatus_egresos='INACTIVO' WHERE id_egresos='$id_egreso'";

if(mysqli_query($link,$consulta)){
	$respuesta['estatus'] = "success";
}else{
	$respuesta['estatus'] = "error";
	$respuesta['mensaje'] = "Error en ".mysqli_error($link);
}

echo json_encode($respuesta);

?>