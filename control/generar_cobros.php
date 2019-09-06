<?php 
	//Ultima Modificacion 19-07-2018 8:50
	function generarcobros($id_alumnos, $id_ciclos,$link	,$colegio, $es_preinscripcion = false){ 
		// $respuesta = [$id_alumnos, $id_ciclos,$link,$colegio];
		
		
		$mesesNombre =  array( 
		"9" => "Septiembre", 
		"10" => "Octubre", 
		"11" => "Noviembre", 
		"12" => "Diciembre", 
		"1" => "Enero", 
		"2" => "Febrero", 
		"3" => "Marzo", 
		"4" => "Abril", 
		"5" => "Mayo", 
		"6" => "Junio", 
		"7" => "Julio"
		);
		
		// $mes_inscripcion = $fechainscripcion_alumnos;
		// $year_inscripcion = $fechainscripcion_alumnos;
		//$mes_inscripcion = 10;
		$mes_inscripcion = intval (date("n")); //se saca el mes numerico
		$year_inscripcion = intval (date("Y")); //se saca el año numerico
		$respuesta["mes_inscripcion"] = $mes_inscripcion;
		
		$inicio_ciclo = date("Y"); //obtener el año de la fecha de inicio_ciclo
		$year = $inicio_ciclo; 
		
		
		$cons_costos = "SELECT * FROM costos RIGHT JOIN alumnos ON costos.id_costos = alumnos.id_plan WHERE id_alumnos = '$id_alumnos'";
		
		$result_costos= mysqli_query($link,$cons_costos) ;
		
		if($result_costos){
			
			$respuesta['estatus_costos'] = 'success';
			//agregar concepto preinscripcion 25/07/2018 -D
			while($row = mysqli_fetch_assoc($result_costos)){
				$respuesta['datos_plan'] = $row;
				$mensualidad = $row['cantidad_costos'];
				$costo_preinscripcion = $row['costo_preinscripcion'];
				$costo_inscripcion = $row['costo_inscripcion'];
				$dia_limite = $row['dia_limite'];
				$meses = explode(",", $row['meses']);
				
				$index_inicial = array_search($mes_inscripcion,$meses) ;
				if(!$index_inicial or $es_preinscripcion){
					$index_inicial = 0;
				}
				
			}
			
			$respuesta['index_inicial'] = $index_inicial;
			$respuesta['meses'] = $meses;
			
			
			//Descuento por inscripcion anticipada
			if($mes_inscripcion > 0 && $mes_inscripcion < 7 ){
				switch($colegio){
					case 'La paz':
					$meses_restantes = sizeof($meses) - $index_inicial;
					$costo_inscripcion =  $costo_inscripcion * $meses_restantes / 12 ;
					break;
					
					case 'covarrubias':
					$costo_inscripcion = $costo_inscripcion / 2;
					break;
				}
				
			}
			
			$insertar_preinscripcion = "INSERT INTO colegiaturas_por_alumno
			SET id_alumnos='$id_alumnos', 
			id_ciclos='$id_ciclos', 
			mes_colegiaturas='8',
			estatus_colegiaturas='PENDIENTE',
			importe_colegiaturas='$costo_preinscripcion',
			restante_colegiaturas='$costo_preinscripcion',
			descripcion_colegiaturas = 'Preinscripción $year'
			"; 
			
			if(mysqli_query($link,$insertar_preinscripcion)){
				$respuesta['estatus_preinscripcion'] = "success";
				}else{
				$respuesta['estatus_preinscripcion'] = "error";
				$respuesta['mensaje_preinscripcion'] = "Error en $insertar_preinscripcion".mysqli_error($link);
			}
			
			//Inserta el costo de la inscripcion
			$insertar_inscripcion = "INSERT INTO colegiaturas_por_alumno
			SET id_alumnos='$id_alumnos', 
			id_ciclos='$id_ciclos', 
			mes_colegiaturas='8',
			estatus_colegiaturas='PENDIENTE',
			importe_colegiaturas='$costo_inscripcion',
			restante_colegiaturas='$costo_inscripcion',
			descripcion_colegiaturas = 'Inscripción $year'
			"; 
			
			if(mysqli_query($link,$insertar_inscripcion)){
				$respuesta['estatus_inscripcion'] = "success";
				}else{
				$respuesta['estatus_inscripcion'] = "error";
				$respuesta['mensaje_inscripcion'] = "Error en $insertar_inscripcion".mysqli_error($link);
			}
			
			// return $respuesta;
			
			//Inserta las colegiaturas_por_alumno
			for($i = $index_inicial; $i < count($meses); $i++){
				$mes = $meses[$i];	
				
				if($i == 3){
					$year++;
				} 
				
				
				if($i >= 20){
					exit();
					
				}
				// setlocale(LC_ALL,"es_ES");
				
				
				$cons_colegiaturas = "INSERT INTO colegiaturas_por_alumno
				SET id_alumnos='$id_alumnos', 
				id_ciclos='$id_ciclos', 
				mes_colegiaturas='$mes',
				estatus_colegiaturas='PENDIENTE',
				importe_colegiaturas='$mensualidad',
				restante_colegiaturas='$mensualidad',
				fecha_corte= '$year-$mes-01' , 
				fecha_vencimiento= '$year-$mes-$dia_limite',
				descripcion_colegiaturas = '{$mesesNombre[$mes]}- {$year}'				";
				
				// echo $cons_colegiaturas."<br>";
				if(mysqli_query($link,$cons_colegiaturas)){
					$respuesta['estatus_colegiaturas'] = "success";
					$respuesta['cons_colegiaturas'][] = $cons_colegiaturas;
					}else{
					$respuesta['estatus_colegiaturas'] = "error";
					$respuesta['mensaje_colegiaturas'] = "Error en $cons_colegiaturas".mysqli_error($link);
				}
				
			}
			
			
			
			}else{
			$respuesta['estatus_costos'] = 'error';
			$respuesta['mensaje_costos'] = 'Error en '.$cons_costos.mysqli_error($link);
		}		
		
		return $respuesta;
	}
	
?>