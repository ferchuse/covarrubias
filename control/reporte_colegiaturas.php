<?php
	include('../conexi.php');
	$link = Conectarse();
	
	$id_grupos = $_POST['id_grupos'];
	$id_ciclos = $_POST['id_ciclos'];
	
	
	$cons_alumnos = "SELECT * FROM inscripciones 
	LEFT JOIN alumnos USING(id_alumnos)
	LEFT JOIN costos ON alumnos.id_plan = costos.id_costos
	WHERE id_grupos = '$id_grupos'
	AND inscripciones.id_ciclos = $id_ciclos
	AND estatus_alumnos = 'INSCRITO'
	ORDER BY apellidop_alumnos  ";
	
	$result = mysqli_query($link, $cons_alumnos) or die('Error en'.$cons_alumnos .mysqli_error($link));
	$count_rows = mysqli_num_rows($result);
?>

<table class="table" id="reportes_pagos">
	
	<thead>
		<th>Alumno</th>
		<?php 
			//Cargar Periodos del ciclo escolar
			if($id_ciclos == 4){ ?>
						
				<th>Inscripción</th>
				<th>SEP</th>
				<th>OCT</th>
				<th>NOV</th>
				<th>DIC</th>
				<th>ENE</th>
				<th>FEB</th>
				<th>MAR</th>
				<th>ABR</th>
				<th>MAY</th>
				<th>JUN</th>
				<th>JUL</th>

			<?php 
			}
			else{?>
				<th>Preinscripción</th>
				<th>Inscripción</th>
				<th>SEP</th>
				<th>OCT</th>
				<th>NOV</th>
				<th>DIC</th>
				<th>ENE</th>
				<th>FEB</th>
				<th>MAR</th>
				<th>ABR</th>
				<th>MAY</th>
				<th>JUN</th>
				<th>JUL</th>
			<?php 
				
			}
		?>
	</thead>
	
	<?php	
		
		while($row = mysqli_fetch_assoc($result)){
			
			$id_alumnos = $row['id_alumnos'];
		// $concepto_costos = $row['concepto_costos'];
		// $fecha_pagos = date("d/m/Y", strtotime($row['fecha_pagos']));
		// $total_pagos = $row['total_pagos'];
		// $nombre_alumnos = $row['nombre_alumnos'];
		
		$cons_pagos = "SELECT * FROM colegiaturas_por_alumno 
		
		WHERE id_alumnos = '$id_alumnos'
		AND id_ciclos = '$id_ciclos'
		";
		
		$result_pagos = mysqli_query($link, $cons_pagos) or die('Error en'.$cons_pagos .mysqli_error($link));							 
		?>
		
		<tr >
		
		<td class="text-center">
		<a title="<?php echo $row["concepto_costos"];?>" href="pagar_colegiaturas.php?id_alumnos=<?php echo $row["id_alumnos"]."&id_ciclos=".$id_ciclos ?>">
		<?php echo $row['apellidop_alumnos']." " .$row['apellidom_alumnos']." " .$row['nombre_alumnos']; ?>
		</a>
		
		</td>
		<?php 
			while($fila_pagos = mysqli_fetch_assoc($result_pagos)){ 
				switch($fila_pagos["estatus_colegiaturas"]){
					case "VENCIDO":
					$badge = "badge-danger";
					break;
					case "PENDIENTE":
					$badge = "badge-defalt";
					break;
					case "PAGADO":
					$badge = "badge-success";
					break;
					
				}
			?>
			<td class="text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $fila_pagos["importe_colegiaturas"]; ?>">
			<?php 
				//echo number_format($fila_pagos["importe_colegiaturas"] - $fila_pagos["restante_colegiaturas"]); 
				
			?>
			<div class="badge <?php echo $badge;?>" >
			
			<?php echo $fila_pagos["estatus_colegiaturas"];?>
			
			</div> 
			<small>	<?php echo $fila_pagos["descripcion_colegiaturas"];?></small>
			</td> 
			<?php 
			}
		?>
		</tr>
		
		<?php 
			
		}
		
		?>
		</table>
				