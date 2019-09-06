<?php
header("Content-Type: application/json");
include ("../conexi.php");
$link = Conectarse();
$response = Array();
$vencidos = 0;

$consulta = "SELECT * FROM colegiaturas_por_alumno 
WHERE CURDATE() >= fecha_vencimiento   
AND estatus_colegiaturas <> 'VENCIDO' AND estatus_colegiaturas <> 'PAGADO' ";

		


	//VENCIDOS
	$result = 	mysqli_query($link, $consulta);
	
	if($result){
		while($fila=mysqli_fetch_assoc($result)){
			$actualizar = "UPDATE colegiaturas_por_alumno SET estatus_colegiaturas = 'VENCIDO'  
			WHERE id_colegiaturas='".$fila['id_colegiaturas']."'";
			
			if(mysqli_query($link, $actualizar)){
				$vencidos++;
				
				$response["estatus"] = "success";
				$response["mensaje"] = "Modificado";
				$response["query"] = "$actualizar";
			}else{
					$response["estatus"] = "error";
					$response["mensaje"] = "Error al actualizar: $actualizar  ".mysqli_error($link);		
			}
		}
		
	}	
	else{
		$response["estatus"] = "error";
		$response["mensaje"] = "Error: $result  ".mysqli_error($link);		
	}
	$response['vencidos'] = $vencidos;
	


echo json_encode($response);
?>