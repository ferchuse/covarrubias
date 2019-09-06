<?php 
include ('../conexi.php');
$link = Conectarse();

$respuesta = array();
$id_alumnos = $_POST['id_alumnos'];
$id_usuarios = $_POST['id_usuarios'];
$recargo_pagos = $_POST['recargo_pagos'];
$descuento_pagos = $_POST['descuento_pagos'];
$subtotal = $_POST['subtotal'];
$total_pagos = $_POST['total_pagos'];
$arr_colegiaturas = $_POST['id_colegiaturas'];
$str_id_colegiaturas = implode(", ",$_POST['id_colegiaturas']);
$facturar = isset($_POST['facturar']) ? $_POST['facturar'] : 0;
$importe = $_POST['importe'];
$descripcion = $_POST['descripcion'];
$fecha_pagos = $_POST['fecha_pagado'];
$tipo_pago = $_POST['tipo_pago'];

$consulta_folioActual = "SELECT folioactual_usuarios FROM usuarios WHERE id_usuarios = '$id_usuarios' ";
$result_folioActual = mysqli_query($link,$consulta_folioActual);
while($filaActual= mysqli_fetch_assoc($result_folioActual)){
	
	$folioactual_usuarios = $filaActual['folioactual_usuarios'];
}

$update_colegiaturas = "UPDATE colegiaturas_por_alumno
SET 
restante_colegiaturas=0,
fecha_pagado=CURDATE(),
estatus_colegiaturas = 'PAGADO'
WHERE id_colegiaturas IN ($str_id_colegiaturas)
";


if(mysqli_query($link,$update_colegiaturas)){
	$respuesta['estatus_colegiaturas'] = "success";
}else{
	$respuesta['estatus_colegiaturas'] = "error";
	$respuesta['mensaje_colegiaturas'] = "Error en: $update_colegiaturas,".mysqli_error($link);
}

//guarda el cliente y si factura
if($facturar == '1'){
	$id_clientes = $_POST['id_clientes'];
	$update_alumno = "UPDATE alumnos
	SET 
	facturar='$facturar',
	id_clientes = '$id_clientes'
	WHERE id_alumnos = '$id_alumnos'
	";


	if(mysqli_query($link,$update_alumno)){
		$respuesta['estatus_alumnos'] = "success";
	}else{
		$respuesta['estatus_alumnos'] = "error";
		$respuesta['mensaje_alumnos'] = "Error en: $update_alumno,".mysqli_error($link);
	}
}

//guarda el cliente y si factura
if($recargo_pagos > 0){
	$arr_colegiaturas[] = "Recargos";
	$descripcion[] = "Recargos";
	$importe[] = $recargo_pagos;
	
}

// insertar en pagos y pagos detalle
$insert_pagos = "INSERT INTO pagos SET 
id_alumnos = $id_alumnos,
recargo_pagos = '$recargo_pagos',
descuento_pagos = '$descuento_pagos',
subtotal = '$subtotal',
total_pagos = '$total_pagos',
folio_pagos='$folioactual_usuarios',
fecha_pagos = '$fecha_pagos',
hora_pagos = CURTIME(),
id_usuarios = $id_usuarios";

if(mysqli_query($link,$insert_pagos)){
	$respuesta['estatus_pagos'] = "success";
	$respuesta['id_pagos'] =mysqli_insert_id($link);
	$respuesta['folio_anterior'] = $folioactual_usuarios;
	//ACTUALIZAR FOLIO ACTUAL
	
		 $folioactual_usuarios++;
		 
		$actualizar_folioactual = "UPDATE usuarios SET folioactual_usuarios = '$folioactual_usuarios' WHERE id_usuarios = '$id_usuarios' ";
	
	if(mysqli_query($link,$actualizar_folioactual)){
		$respuesta['estatus_folioactual'] = "success";
	}else{
		$respuesta['estatus_folioactual'] = "error";
		$respuesta['mensaje'] = "Error al actualizar";
	}
	$respuesta['folio_siguente'] = $folioactual_usuarios;
}else{
	$respuesta['estatus_pagos'] = "error";
	$respuesta['mensaje_pagos'] = "Error en: $insert_pagos, ".mysqli_error($link);
}



foreach ($arr_colegiaturas  as $index=> $id_colegiaturas){
	
	$insert_detalle = "INSERT INTO pagos_detalle SET 
	id_pagos = '".$respuesta['id_pagos']."',
	cantidad = '1',
	importe = '".$importe[$index]."',
	descripcion_pagos = '".$descripcion[$index]."',
	id_colegiaturas = '$id_colegiaturas',
	tipo_pago = '$tipo_pago'
	
	";

	if(mysqli_query($link,$insert_detalle)){
		$respuesta['estatus_detalle'] = "success";
		$respuesta['insert_detalle'][] = $insert_detalle ;
	}else{
		$respuesta['estatus_detalle'] = "error";
		$respuesta['mensaje_detalle'] = "Error en: $insert_detalle, ".mysqli_error($link);
	}
	
}


if(	$respuesta['estatus_pagos'] == "success" && $respuesta['estatus_colegiaturas'] ){
	
		$respuesta['estatus'] = "success";
}else{

	$respuesta['estatus'] = "error";
}
echo json_encode($respuesta);

?>