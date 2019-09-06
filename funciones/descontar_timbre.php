<?php
	
	function dame_folio($link, $tabla, $pk){
		$respuesta = Array();
		$consulta = "UPDATE emisores SET folios_restantes = folios_restantes -1";
		$respuesta["consulta"] = $consulta;
		$result = mysqli_query($link, $consulta);
		
		if(!$result){
			$respuesta["result"] = mysqli_error($link);
			
			$respuesta["num_rows"] = 0;
		}
		else{
			$respuesta["num_rows"] =  mysqli_num_rows($result);
				
			
		}
		
		
		return $respuesta;
	}
	
?>