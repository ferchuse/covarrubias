
<div class="row">
	<table class="table">
		<thead>
			<tr>
			<th class="text-center">Id</th>
			<th  class="text-center">Nombre</th>
			<th  class="text-center">Estatus</th>
			<th  class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$q_alumnos ="SELECT * FROM alumnos WHERE estatus_alumnos='PREINSCRITO'";
							$result_alumnos=mysqli_query($link,$q_alumnos) or die("Error en: $q_alumnos  ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result_alumnos)){
								$id_alumnos = $row["id_alumnos"];
								$nombre_alumnos = $row["nombre_alumnos"];
								$apellidop_alumnos = $row["apellidop_alumnos"];
								$apellidom_alumnos = $row["apellidom_alumnos"];
								$estatus_alumnos = $row["estatus_alumnos"];
		?>
			<tr>
				<td class="text-center"><?php echo $id_alumnos; ?></td>
				<td class="text-center"><?php echo $nombre_alumnos." ".$apellidop_alumnos." ".$apellidom_alumnos; ?></td>
				<td class="text-center"><?php echo $estatus_alumnos; ?></td>
				<td class="text-center">

							<button class="btn btn-danger btn_eliminar"  data-id_alumnos="<?php echo $id_alumnos; ?>"><i class="fa fa-trash" aria-hidden="true"></i>
							</button>
							<?php 
							if($estatus_alumnos == "PREINSCRITO"){?>
								<button class="btn btn_detalles"  data-id_alumnos="<?php echo $id_alumnos; ?>"><i class="fa fa-eye" aria-hidden="true"></i>
							</button>
							<?php
								}
							?>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
</div>