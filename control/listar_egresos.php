<?php 
	include('../conexi.php');
	$link = Conectarse();
	if(isset($_POST['fecha_inicio']) ){
		$fecha_inicio = $_POST['fecha_inicio'];
		$q ="SELECT * FROM egresos WHERE fecha_egresos = '$fecha_inicio' ";
	}else{
		$q ="SELECT * FROM egresos ";
	}
	
?>
<div class="row">
	<table class="table">
		<thead>
			<tr>
				<th class="text-center">Fecha</th>
				<th  class="text-center">Descripcion</th>
				<th  class="text-center">Cantidad</th>
				<th  class="text-center">Area</th>
				<th  class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		
							$result=mysqli_query($link,$q) or die("Error en: $q  ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result)){
								extract($row);
								if($estatus_egresos == 'INACTIVO'){
					?>
			<tr>
				<td class="text-center"><s><?php echo $fecha_egresos?></s></td>
				<td class="text-center"><s><?php echo $descripcion_egresos; ?></s></td>
				<td class="text-center"><s><?php echo $cantidad_egresos; ?></s></td>
				<td class="text-center"><s><?php echo $area_egresos; ?></s></td>
			</tr>
		<?php				
								}else{
		?>
			<tr>
				<td class="text-center"><?php echo  date("d/m/Y", strtotime($fecha_egresos));?></td>
				<td class="text-center"><?php echo $descripcion_egresos; ?></td>
				<td class="text-center"><?php echo $cantidad_egresos; ?></td>
				<td class="text-center"><?php echo $area_egresos; ?></td>
				<td class="text-center">
					<button class="btn btn-warning btn_editar" title="Editar" data-id_egreso="<?php echo $id_egresos ?>"><i class="fa fa-pencil"></i>
					</button>
					<button class="btn btn-danger btn_eliminar" title="Eliminar" data-id_egreso="<?php echo $id_egresos ?>"><i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
		<?php 
								}
							}
		?>
		</tbody>
	</table>
</div>