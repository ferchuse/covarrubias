<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	$nombre_padres = $_POST['nombre_padres'];
	$paterno_padres = $_POST['paterno_padres'];
	$materno_padres = $_POST['materno_padres'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$curp_padres = $_POST['curp_padres'];
	$sexo_padres = $_POST['sexo_padres'];
	$estado_civil = $_POST['estado_civil'];
	$domicilio_padres = $_POST['domicilio_padres'];
	$colonia_padres = $_POST['colonia_padres'];
	$municipio_padres = $_POST['municipio_padres'];
	$estado_padres = $_POST['estado_padres'];
	$correo_padres = $_POST ['correo_padres'];
	$telefono_padres = $_POST['telefono_padres'];
	$telefonoreferencia_padres = $_POST['telefonoreferencia_padres'];
	$codigopostal_padres = $_POST['codigopostal_padres'];
	$id_alumno = $_POST['id_alumno'];
	
	$consulta = "INSERT INTO padres SET nombre_padres='$nombre_padres', paterno_padres='$paterno_padres', materno_padres='$materno_padres', fecha_nacimiento='$fecha_nacimiento',correo_padres='$correo_padres',telefono_padres='$telefono_padres',telefonoreferencia_padres='$telefonoreferencia_padres',curp_padres='$curp_padres', sexo_padres='$sexo_padres', estado_civil='$estado_civil', domicilio_padres='$domicilio_padres', colonia_padres='$colonia_padres', municipio_padres='$municipio_padres', estado_padres='$estado_padres', codigopostal_padres='$codigopostal_padres', id_alumnos='$id_alumno'";
	
	if(mysqli_query($link,$consulta)){
		$respuesta['estatus'] = 'success';
	}else{
		$respuesta['estatus'] = 'error';
		$respuesta['error'] = "Error en la DB $consulta ".mysqli_error($link);
	}
	
	echo json_encode($respuesta);
?>