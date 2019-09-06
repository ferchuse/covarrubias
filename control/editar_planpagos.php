<?php 
	include('../conexi.php');
	include('generar_cobros.php');
	$link = Conectarse();
	$id_alumnos = $_POST['id_alumnos'];
	$id_plan = $_POST['id_plan'];
	$colegio = "covarrubias";

	
	$actualizarPlan = "UPDATE alumnos SET id_plan = '$id_plan' WHERE id_alumnos='$id_alumnos' ";
	
	if(mysqli_query($link,$actualizarPlan)){
		
		$respuesta['estatus'] = 'success';
		
		$consultaCiclo = "SELECT * FROM inscripciones WHERE id_alumnos = '$id_alumnos'";
		
		$resultado = mysqli_query($link,$consultaCiclo);
		while($row_ciclo = mysqli_fetch_assoc($resultado)){
			extract($row_ciclo);
		}
		//Elimina colegiaturas anteriores y vuelve a generarlas
		$eliminarMes = "DELETE FROM colegiaturas_por_alumno WHERE id_alumnos = '$id_alumnos' AND id_ciclos = '$id_ciclos'";
		
		if(mysqli_query($link,$eliminarMes)){
			
			$respuesta['estatus'] = 'success';
			
			$respuesta['generarcobros'] =generarcobros($id_alumnos, $id_ciclos,$link	,$colegio, true);
			
		}else{
			
			$respuesta['estatus'] = 'error';
			$respuesta['mensaje'] = 'No se eliminaron los meses del alumno(a)';
		}
	}else{
		
		$respuesta['estatus'] = 'error';
		$respuesta['mensaje'] = 'Error al actualizar plan de pagos';
	}
	
	
		
	
	// function Meses($id_alumnos,$link,$id_ciclos){
		// $cons_costos = "SELECT * FROM costos RIGHT JOIN alumnos ON costos.id_costos = alumnos.id_plan WHERE id_alumnos = '$id_alumnos'";

		// $result_costos= mysqli_query($link,$cons_costos) ;

		// if($result_costos){
			// $respuesta['estatus_costos'] = 'success';
			// while($row = mysqli_fetch_assoc($result_costos)){
				
				// $mensualidad = $row['cantidad_costos'];
				// $costo_inscripcion = $row['costo_inscripcion'];
				// $dia_limite = $row['dia_limite'];
				// $meses = explode(",", $row['meses']);
				// $precio = 2400;
				// $meses = array(9,10,11,12,1,2,3,4,5,6,7);
				// $meses = array(9,10,11,12,1,2,3,4,5,6,);
				// $meses_restantes(3)
				
				
			// }
			// $inicio_ciclo = date("Y");
			// $year = $inicio_ciclo; ///obtener el año de la fecha de inicio_ciclo

			// foreach($meses as $index => $mes){
					
				 // if($index == 4){
					 // $year++;
				 // } 
				 // $precio = $mensualidad;
				 // if($mes == 8){
					// $precio = $costo_inscripcion;
					// $dia_vencimiento = 31;
					 
				 // }
				 // setlocale(LC_ALL,"es_ES");
				 
				 // $mesesNombre =  array(
					// "1" => "Enero", 
					// "2" => "Febrero", 
					// "3" => "Marzo", 
					// "4" => "Abril", 
					// "5" => "Mayo", 
					// "6" => "Junio", 
					// "7" => "Julio", 
					// "8" => "Agosto", 
					// "9" => "Septiembre", 
					// "10" => "Octubre", 
					// "11" => "Noviembre", 
					// "12" => "Diciembre"
					// );
				// $cons_colegiaturas = "INSERT INTO colegiaturas_por_alumno
					// SET id_alumnos='$id_alumnos', 
					// id_ciclos='$id_ciclos', 
					// mes_colegiaturas='$mes',
					// estatus_colegiaturas='PENDIENTE',
					// importe_colegiaturas='$precio',
					// restante_colegiaturas='$precio',
					// fecha_corte= '$year-$mes-01' , 
					// fecha_vencimiento= '$year-$mes-$dia_limite',
					// descripcion_colegiaturas = '".$mesesNombre[$mes]."'
					// ";
				// if(mysqli_query($link,$cons_colegiaturas)){
					// $respuesta['estatus_colegiaturas'] = "success";
				// }else{
					// $respuesta['estatus_colegiaturas'] = "error";
					// $respuesta['mensaje_colegiaturas'] = "Error en $cons_colegiaturas".mysqli_error($link);
				// }
			// }
			
			
		// }else{
			// $respuesta['estatus_costos'] = 'error';
			// $respuesta['mensaje_costos'] = 'Error en '.$cons_costos.mysqli_error($link);
		// }		
	// }
	
	
	
	function meses_restantes(){
		
		//$mes_actual = date("m");
		//encontrar posicion
		//Contar meses restantes
		//regresar nuevo array con meses restantes
	}
	echo json_encode($respuesta);
 ?>