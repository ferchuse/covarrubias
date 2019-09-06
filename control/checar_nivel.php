<?php  
include('../conexi.php');
$link = Conectarse();

$respuesta = array();

$dato = $_POST['dato'];

$consulta = "SELECT * FROM carreras WHERE id_niveles='$dato'";

$resultado = mysqli_query($link,$consulta) or die('Error en la DB $consulta '.mysqli_error($link));

$numero_filas = mysqli_num_rows($resultado);

if($resultado){
	$respuesta['filas'] = $numero_filas;
	$respuesta['estatus'] = 'success';
}else{
	$respuesta['estatus'] = 'error';
	$respuesta['mensaje'] = mysqli_error($link);
}

echo json_encode($respuesta);
?>