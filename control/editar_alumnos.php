<?php
	header("Content-Type: application/json");
	include ("../conexi.php");
	$link = Conectarse();
	$respuesta = Array();
	
	$id_alumnos = $_POST['id_alumnos'];
	
	if(isset($_POST['dia']) && isset($_POST['mes']) && isset($_POST['año'])){
		$dia = $_POST['dia'];
		$mes = $_POST['mes'];
		$año = $_POST['año'];
		$fechanac_alumnos = $año.'-'.$mes.'-'.$dia;
		}else{
		$fechanac_alumnos = '';
	}
	//---------ALUMNOS
	$nombre_alumnos = $_POST['nombre_alumnos'];
	$apellidop_alumnos = $_POST['apellidop_alumnos'];
	$apellidom_alumnos = $_POST['apellidom_alumnos'];
	//$fechanac_alumnos = $_POST['fechanac_alumnos'];
	$lugarnac_alumnos = $_POST['lugarnac_alumnos'];
	$curp_alumnos = $_POST['curp_alumnos'];
	$sexo_alumnos = $_POST['sexo_alumnos'];
	$domicilio_alumnos = $_POST['domicilio_alumnos'];
	$colonia_alumnos = $_POST['colonia_alumnos'];
	$codpostal_alumnos = $_POST['codpostal_alumnos'];
	$localidad_alumnos = $_POST['localidad_alumnos'];
	$municipio_alumnos = $_POST['municipio_alumnos'];
	$estado_alumnos = $_POST['estado_alumnos'];
	$discapacidad_alumnos=$_POST['discapacidad_alumnos'];
	$desdiscapacidad_alumnos=$_POST['desdiscapacidad_alumnos'];
	$extranjero_alumnos=$_POST['extranjero_alumnos'];
	$paisextranjero_alumnos=$_POST['paisextranjero_alumnos'];
	$id_descuentos = $_POST['id_descuentos'];
	
	$id_grados = $_POST['id_grados'];
	
	$guardar_alumno = "UPDATE alumnos SET 
	nombre_alumnos='$nombre_alumnos',
	apellidop_alumnos='$apellidop_alumnos',
	apellidom_alumnos='$apellidom_alumnos',
	fechanac_alumnos='$fechanac_alumnos',
	lugarnac_alumnos='$lugarnac_alumnos',
	curp_alumnos='$curp_alumnos',
	sexo_alumnos='$sexo_alumnos',
	domicilio_alumnos='$domicilio_alumnos',
	colonia_alumnos='$colonia_alumnos',
	codpostal_alumnos='$codpostal_alumnos',
	localidad_alumnos='$localidad_alumnos',
	municipio_alumnos='$municipio_alumnos',
	estado_alumnos='$estado_alumnos',
	discapacidad_alumnos='$discapacidad_alumnos',
	desdiscapacidad_alumnos='$desdiscapacidad_alumnos',
	extranjero_alumnos='$extranjero_alumnos',
	paisextranjero_alumnos='$paisextranjero_alumnos',
	id_grados='$id_grados',
	id_descuentos='$id_descuentos'
	WHERE id_alumnos='$id_alumnos'
	";
	
	if(mysqli_query($link,$guardar_alumno)){
		$respuesta['estatus'] = 'success';
		}else{
		$respuesta['estatus'] = 'error al editar el alumno';
		$respuesta['mensaje'] = 'Error en '.mysqli_error($link);
	}
	//--------PADRES
	$nombre_padres = $_POST['nombre_padres'];
	$paterno_padres = $_POST['paterno_padres'];
	$materno_padres = $_POST['materno_padres'];
	$fecha_nacimiento = $_POST['fecha_nacimiento'];
	$curp_padres = $_POST['curp_padres'];
	$sexo_padres = $_POST['sexo_padres'];
	$correo_padres = $_POST['correo_padres'];
	$domicilio_padres = $_POST['domicilio_padres'];
	$colonia_padres = $_POST['colonia_padres'];
	$municipio_padres = $_POST['municipio_padres'];
	$estado_padres = $_POST['estado_padres'];
	$codigopostal_padres = $_POST['codigopostal_padres'];
	$telefono_padres = $_POST['telefono_padres'];
	$telefonoreferencia_padres = $_POST['telefonoreferencia_padres'];
	
	
	//consulta padre   
	
	$consulta_padre = "SELECT * FROM padres WHERE id_alumnos = '$id_alumnos'";
	
	$result_padre = mysqli_query($link, $consulta_padre); 
	
	$respuesta["result_padre"] = $result_padre;
	 
	if(mysqli_num_rows($result_padre) > 0 ){
		
		$insertar_padres = "UPDATE padres SET nombre_padres='$nombre_padres', paterno_padres='$paterno_padres', materno_padres='$materno_padres', fecha_nacimiento='$fecha_nacimiento', curp_padres='$curp_padres', sexo_padres='$sexo_padres', correo_padres='$correo_padres', domicilio_padres='$domicilio_padres', colonia_padres='$colonia_padres', municipio_padres='$municipio_padres', estado_padres='$estado_padres', codigopostal_padres='$codigopostal_padres', telefono_padres='$telefono_padres', telefonoreferencia_padres='$telefonoreferencia_padres' WHERE id_alumnos='$id_alumnos'";
		
	}
	else{
		$insertar_padres = "INSERT INTO padres SET nombre_padres='$nombre_padres', paterno_padres='$paterno_padres', materno_padres='$materno_padres', fecha_nacimiento='$fecha_nacimiento', curp_padres='$curp_padres', sexo_padres='$sexo_padres', correo_padres='$correo_padres', domicilio_padres='$domicilio_padres', colonia_padres='$colonia_padres', municipio_padres='$municipio_padres', estado_padres='$estado_padres', codigopostal_padres='$codigopostal_padres', telefono_padres='$telefono_padres', telefonoreferencia_padres='$telefonoreferencia_padres',  id_alumnos='$id_alumnos'";
		
		
	}
	
	
	if(mysqli_query($link,$insertar_padres)){
		$respuesta['estatus_padre'] = 'success';
		}else{
		$respuesta['estatus_padre'] = 'error al editar el padre';
		$respuesta['error_padre'] = 'Error en '.mysqli_error($link);
	}
	
	//--------MADRES
	$nombre_madres = $_POST['nombre_madres'];
	$paterno_madres = $_POST['paterno_madres'];
	$materno_madres = $_POST['materno_madres'];
	$fecha_nacimientom = $_POST['fecha_nacimientom'];
	$curp_madres = $_POST['curp_madres'];
	if(isset($_POST['sexo_madres'])){
		if($_POST['sexo_madres'] == ''){
			$sexo_madres = 'FEMENINO';
			}else{
			$sexo_madres = $_POST['sexo_madres'];
		}	
		}else{
		$sexo_madres = 'FEMENINO';
	}
	$correo_madres = $_POST['correo_madres'];
	$domicilio_madres = $_POST['domicilio_madres'];
	$colonia_madres = $_POST['colonia_madres'];
	$municipio_madres = $_POST['municipio_madres'];
	$estado_madres = $_POST['estado_madres'];
	$codigopostal_madres = $_POST['codigopostal_madres'];
	$telefono_madres = $_POST['telefono_madres'];
	$telefonoreferencia_madres = $_POST['telefonoreferencia_madres'];
	
	//consulta madres 
	
	$consulta_madre = "SELECT * FROM madres WHERE id_alumnos = '$id_alumnos'";
	
	$result_madre = mysqli_query($link, $consulta_madre);
	
	$respuesta["result_madre"] = $result_madre;
	
	if(mysqli_num_rows($result_madre) > 0 ){
		$insertar_madres = "UPDATE  madres SET nombre_madres='$nombre_madres', paterno_madres='$paterno_madres', materno_madres='$materno_madres', fecha_nacimientom='$fecha_nacimientom', curp_madres='$curp_madres', sexo_madres='$sexo_madres', correo_madres='$correo_madres', domicilio_madres='$domicilio_madres', colonia_madres='$colonia_madres', municipio_madres='$municipio_madres', estado_madres='$estado_madres', codigopostal_madres='$codigopostal_madres', telefono_madres='$telefono_madres', telefonoreferencia_madres='$telefonoreferencia_madres' WHERE id_alumnos='$id_alumnos'";
		
		
	}
	else{
		$insertar_madres = "INSERT INTO  madres SET id_alumnos='$id_alumnos',nombre_madres='$nombre_madres', paterno_madres='$paterno_madres', materno_madres='$materno_madres', fecha_nacimientom='$fecha_nacimientom', curp_madres='$curp_madres', sexo_madres='$sexo_madres', correo_madres='$correo_madres', domicilio_madres='$domicilio_madres', colonia_madres='$colonia_madres', municipio_madres='$municipio_madres', estado_madres='$estado_madres', codigopostal_madres='$codigopostal_madres', telefono_madres='$telefono_madres', telefonoreferencia_madres='$telefonoreferencia_madres' ";
		
	}
	
	
	
	
	if(mysqli_query($link,$insertar_madres)){
		$respuesta['estatusMadre'] = 'success';
		}else{
		$respuesta['estatusMadre'] = 'error al guardar el madre';
		$respuesta['error_madre'] = 'Error en '.mysqli_error($link);
	}
	
	//-------PERSONAS AUTORIZADAS
	$numero_nombre = count($_POST['nombre_autorizada']);
	$numero_parentesco = count($_POST['parentesco_autorizada']);
	$insertar_autorizadas = "";
	for($i=0;$i < $numero_nombre;$i++){
		if($_POST['nombre_autorizada'][$i] == "" && $_POST['parentesco_autorizada'][$i] == ""){
			
			}else{
			$insertar_autorizadas = "UPDATE personas_autorizadas SET nombre_autorizada='".$_POST['nombre_autorizada'][$i]."', parentesco_autorizada='".$_POST['parentesco_autorizada'][$i]."' WHERE id_alumnos='$id_alumnos'";
			if(mysqli_query($link, $insertar_autorizadas)){
				$respuesta['mensaje'] = 'success';
				}else{
				$respuesta['mensaje'] = 'error en personas autorizadas';
				$respuesta['error'] = 'Error en '.mysqli_error($link);
			}
		}
	}
	$respuesta['total'] = $i;
	
	
	
	echo json_encode($respuesta);
?>