<?php 
include ('../conexi.php');
$link = Conectarse();

$respuesta = array();

$id_egresos = $_POST['id_egresos'];


$consulta = "SELECT * FROM egresos WHERE  id_egresos = '$id_egresos' ";
$respuestaC = mysqli_query($link,$consulta);


if($respuestaC){
	$respuesta['estatus'] = "success";
	while($row = mysqli_fetch_assoc($respuestaC)){
	$respuesta["fila"] = $row;
}
}else{
	$respuesta['estatus'] = "error";
	$respuesta['mensaje'] = "Error en ".mysqli_query($link);
}

echo json_encode($respuesta);

?>