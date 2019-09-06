<?php
	include('../conexi.php');
	$link = Conectarse();
	
	$desde = $_POST['desde'];
	$hasta = $_POST['hasta'];
	//$filtros = $_POST['filtros'];
	$totalPagos = array();
	
	$consulta = "SELECT
	*, GROUP_CONCAT(pagos_detalle.descripcion_pagos) AS conceptos
	FROM
	pagos
	LEFT JOIN pagos_detalle USING (id_pagos)
	LEFT JOIN alumnos USING (id_alumnos)
	LEFT JOIN costos ON alumnos.id_plan = costos.id_costos
	LEFT JOIN niveles ON alumnos.id_niveles = niveles.id_niveles
	WHERE fecha_pagos BETWEEN '$desde' AND '$hasta'
	GROUP BY id_pagos
	
	";
	/*foreach($filtros as $key => $value){
		if($value != ""){
		$consulta.= "AND $key='$value' ";
		}
	}	*/
	
	$result = mysqli_query($link, $consulta) or die('Error en'.$consulta .mysqli_error($link));
	$count_rows = mysqli_num_rows($result);
?>
<?php  
	
	if($count_rows < 1){
	?>
	<br>
	<br>
	<div class="alert alert-warning text-center">
	  <strong>No hay pagos en estas fechas</strong> 
	</div>
	<?php	
		}else{
	?>
	
	<table class="table table-hover" id="reportes_pagos">
		<thead>
			<th>Consecutivo</th>
			<th>Folio interno</th>
			<th>Fecha</th>
			<th>Nivel</th>
			<th>Alumno</th>
			<th>Concepto</th>
			<th>Forma de pago</th>
			<th>Facturado</th>
			<th>Cantidad</th>
			<th>Acciones</th>
		</thead>
		
		<?php	
			
			while($row = mysqli_fetch_assoc($result)){
				extract($row);
				$id_alumnos = $row['id_alumnos'];
				$concepto_costos = $row['concepto_costos'];
				$fecha_pagos = date("d/m/Y", strtotime($row['fecha_pagos']));
				$total_pagos = $row['total_pagos'];
				$nombre_alumnos = $row['nombre_alumnos'];
				
				if($row['estatus_pagos']  == 'CANCELADO'){
					
				?>
				
				<tr class="cancelado">
					<td class="text-center"><?php echo $id_pagos; ?></td>
					<td class="text-center"><?php echo ($folio_pagos == '') ?  "-" : $folio_pagos;?></td>
					<td class="text-center"> <?php echo $fecha_pagos; ?></td>
					<td class="text-center"><?php echo $row['nombre_niveles']; ?></td>
					<td class="text-center">
						<a href="detalles_alumnos.php?id_alumnos=<?php echo $id_alumnos;?>">
							<?php echo $nombre_alumnos." " .$row['apellidop_alumnos']." " .$row['apellidom_alumnos']; ?>
						</a>
					</td>
					<td class="text-center"><?php echo $tipo_pago; ?></td>
					<td class="text-center"><?php echo $motivoCancelacion_pagos; ?></td>
					<td class="text-center">$<?php echo $total_pagos; ?></td>
					<td class="text-center"></td>
				</tr>
				
				<?php 
				}
				else{
					$totalPagos[] = $row['total_pagos'];
					
				?>
				<tbody>
					<td class="text-center"><?php echo $id_pagos; ?></td>
					<td class="text-center"><?php echo ($folio_pagos == '') ?  "-" : $folio_pagos;?></td>
					<td class="text-center"><?php echo $fecha_pagos; ?></td>
					<td class="text-center"><?php echo $row['nombre_niveles']; ?></td>
					<td class="text-center">
						<a href="detalles_alumnos.php?id_alumnos=<?php echo $id_alumnos;?>">
							<?php echo $nombre_alumnos." " .$row['apellidop_alumnos']." " .$row['apellidom_alumnos']; ?>
						</a>
					</td>	
					<td class="text-center"><?php echo $conceptos; ?></td>
					<td class="text-center"><?php echo $tipo_pago; ?></td>
					<td class="text-center"><?php echo $facturado == 0 ? "<span class='badge badge-danger'>NO</span>" : "<span class='badge badge-success'>SI</span>";?></td>
					<td class="text-center">$<?php echo number_format($total_pagos); ?></td>
					<!--colocacion de number_format 11-03-18 -->
					<td class="text-center">
						<a class="btn btn-info btn-reprimir" title="Reimpresión pago" href="imprimir_pago.php?folio_pago=<?php echo $id_pagos;?>">
							<i class="fa fa-print"></i>
						</a>
					</td>
				</tbody>
				<?php	
				}
			}
		}
	?>
	
</table>
<div class="row">
	<div class="col-md-11 text-right">
		<h3><b>
			Total: $<?php echo number_format(array_sum($totalPagos),2); ?>
		</b>
		</h3>
	</div>
</div>

<pre class="hidden">
	<?php echo $consulta; ?>
</pre>