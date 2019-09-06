<?php
	
	// include("../conexi.php"); 
	
	// $link = Conectarse();
	 
	function generar_select($link, $tabla, $llave_primaria, $campo_etiqueta, $name , $id_selected = 0){
		$consulta = "SELECT * FROM $tabla";
		
		 
		$select = "<select ";
		
		$select .= $required ? " required " : " ";
		$select .= $disabled ? " disabled " : " ";
		$select.= "class='form-control $llave_primaria'  name='$name' id='$llave_primaria' >";
		if($filtro){
			$select .= "<option value=''>Todos</option>";
		}
		else{
			$select .= "<option value=''>Seleccione...</option>";
		}
		
		$result = mysqli_query($link, $consulta);
		
		while($fila = mysqli_fetch_assoc($result)){
			$select.="<option value='".$fila[$llave_primaria]."'";
			$select.=$fila[$llave_primaria] == $id_selected ? " selected" : "" ;
			$select.=" >".$fila[$llave_primaria]."-".$fila[$campo_etiqueta] ."</option>";
			
		}
		$select.="</select>";
		
		return $select;
	}
	
?>