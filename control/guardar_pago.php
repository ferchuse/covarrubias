<?php
include('../conexi.php');
$link = Conectarse();
$respuesta = array();



$id_usuarios= $_POST['id_usuarios'];
$id_alumnos = $_POST['id_alumnos'];
$es_articulo = $_POST['es_articulo'];
$total_pagos = $_POST['total_costos'];
$descripcion_pagos = $_POST['descripcion_pagos'];
$id_costos = $_POST['id_costos'];

if($es_articulo != 1){
	
	$id_ciclos = $_POST['ciclo_pagos'];
	$meses_pagos = $_POST['mes_pagos'];
	$recargo_pagos = $_POST['recargo_costos'];
	$descuento_pagos = $_POST['descuento_costos'];

	$consulta =  "INSERT INTO pagos SET 
	id_alumnos='$id_alumnos',
	id_usuarios='$id_usuarios',
	id_costos='$id_costos',
	descripcion_pagos='$descripcion_pagos',
	id_ciclos='$id_ciclos',
	meses_pagos='$meses_pagos',
	recargo_pagos='$recargo_pagos',
	descuento_pagos='$descuento_pagos',
	total_pagos='$total_pagos',
	fecha_pagos=CURDATE(),
	hora_pagos=CURTIME()";

}
else{

	$consulta =  "INSERT INTO pagos SET 
		id_alumnos='$id_alumnos',
		id_usuarios='$id_usuarios',
		es_articulo='$es_articulo',
		descripcion_pagos='$descripcion_pagos',
		id_costos='$id_costos',
		total_pagos='$total_pagos',
		fecha_pagos=CURDATE(),
		hora_pagos=CURTIME()";

	
}




if(mysqli_query($link,$consulta)){
	$respuesta['estatus'] = "success";
	$respuesta['consulta'] = $consulta;
	$respuesta['folio_pago'] = mysqli_insert_id($link); 
}else{
	$respuesta['estatus'] = "error";
	$respuesta['mensaje'] = "Error en DB ".mysqli_error($link);
}

echo json_encode($respuesta);
?>