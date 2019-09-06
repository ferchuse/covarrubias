<?php 
	include('../conexi.php');
	$link = Conectarse();
		$desde = $_POST['desde'];
	$hasta = $_POST['hasta'];
?>
<div class="row">
	<table class="table">
		<thead>
			<tr>
			<th class="text-center">Folio</th>
			<th  class="text-center">Descripcion</th>
			<th  class="text-center">Fecha</th>
			<th  class="text-center">Cantidad</th>
			<th  class="text-center">Area</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$q ="SELECT * FROM egresos WHERE fecha_egresos BETWEEN '$desde' 
	AND '$hasta'";
							$result=mysqli_query($link,$q) or die("Error en: $q  ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result)){
								extract($row);
								$fecha_egresos = date("d/m/Y", strtotime($row['fecha_egresos']));
								if($estatus_egresos == 'INACTIVO'){
					?>
			<tr>
				<td class="text-center"><s><?php echo $id_egresos?></s></td>
				<td class="text-center"><s><?php echo $descripcion_egresos; ?></s></td>
				<td class="text-center"><s><?php echo $fecha_egresos; ?></s></td>
				<td class="text-center"><s><?php echo $cantidad_egresos; ?></s></td>
				<td class="text-center"><s><?php echo $area_egresos; ?></s></td>
			</tr>
		<?php				
								}else{
									$totalPagos[] = $row['cantidad_egresos'];
		?>
			<tr>
				<td class="text-center"><?php echo $id_egresos?></td>
				<td class="text-center"><?php echo $descripcion_egresos; ?></td>
				<td class="text-center"><?php echo $fecha_egresos; ?></td>
				<td class="text-center"><?php echo $cantidad_egresos; ?></td>
				<td class="text-center"><?php echo $area_egresos; ?></td>
			</tr>
		<?php 
								}
							}
		?>
		</tbody>
	</table>
	<div class="row">
	<div class="col-md-12 text-right">
		Total: $<?php 
			if(isset($totalPagos)){
				echo array_sum($totalPagos); 
			}else{
				
			}
		?>
	</div>
 </div>
</div>