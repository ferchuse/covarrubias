<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	$id_pagos = $_POST['id_pagos'];
	$id_usuarios = $_POST['id_usuarios'];
	$motivo = $_POST['motivo'];

	$consulta = "UPDATE pagos
	LEFT JOIN pagos_detalle USING (id_pagos)
	LEFT JOIN colegiaturas_por_alumno USING (id_colegiaturas)
	SET estatus_pagos = 'CANCELADO',
	 estatus_colegiaturas = 'PENDIENTE',
	 restante_colegiaturas = importe_colegiaturas
	WHERE
		id_pagos = '$id_pagos'";
		
	if(mysqli_query($link,$consulta)){
		$respuesta['estatus'] = 'success';
	}else{
		$respuesta['estatus'] = 'error';
		$respuesta['error'] = "Error en la DB $consulta ".mysqli_error($link);
	}
	
	echo json_encode($respuesta);
?>