<?php
	
	function dame_folio($link, $tabla, $pk){
		$respuesta = Array();
		$consulta = "SELECT * FROM $tabla ORDER BY $pk DESC LIMIT 1";
		$respuesta["consulta"] = $consulta;
		$result = mysqli_query($link, $consulta);
		
		if(!$result){
			$respuesta["result"] = mysqli_error($link);
			
			$respuesta["num_rows"] = 0;
		}
		else{
			$respuesta["num_rows"] =  mysqli_num_rows($result);
				
			
			while($fila = mysqli_fetch_assoc($result)){
				$respuesta["folio"] = $fila[$pk];
			}
		}
		
		
		return $respuesta;
	}
	
?>