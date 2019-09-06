<?php 
include ('../conexi.php');
$link = Conectarse();

$respuesta = array();
$id_egresos = $_POST['id_egresos'];
$descripcion_egresos = $_POST['descripcion_egresos'];
$cantidad_egresos = $_POST['cantidad_egresos'];
$area_egresos = $_POST['area_egresos'];
$fecha_egresos = $_POST['fecha_egresos'];

if($id_egresos == ""){
	$consulta = "INSERT INTO egresos SET descripcion_egresos='$descripcion_egresos', cantidad_egresos='$cantidad_egresos', area_egresos='$area_egresos',
	fecha_egresos= '$fecha_egresos' , hora_egresos=CURTIME()";

	if(mysqli_query($link,$consulta)){
		$respuesta['estatus'] = "success";
	}else{
		$respuesta['estatus'] = "error";
		$respuesta['mensaje'] = "Error en ".mysqli_query($link);
	}
}else{
	$update = "UPDATE egresos SET descripcion_egresos='$descripcion_egresos', cantidad_egresos='$cantidad_egresos', area_egresos='$area_egresos',
	fecha_egresos= '$fecha_egresos' WHERE id_egresos = '$id_egresos' ";

	if(mysqli_query($link,$update)){
		$respuesta['estatus'] = "success";
	}else{
		$respuesta['estatus'] = "error";
		$respuesta['mensaje'] = "Error en ".mysqli_query($link);
	}
}
echo json_encode($respuesta);

?>