<?php include("../conexi.php");
	$link=Conectarse();
?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Nombre de la carrera</th>
					<th class="text-center">RVOE</th>
					<th class="text-center">Nivel de la carrera</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		$q_carreras ="SELECT * FROM carreras NATURAL JOIN niveles ORDER BY id_carreras ASC";
							$result_carreras=mysqli_query($link,$q_carreras) or die("Error en: $q_carreras ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result_carreras)){
								$id_carreras = $row["id_carreras"];
								$nombre_carreras = $row["nombre_carreras"];
								$rvoe_carreras=$row["rvoe_carreras"];
								$nombre_niveles=$row["nombre_niveles"];
								
								
	?>
				<tr>
				<td class="text-center"><?php  echo $id_carreras?></td>
				<td class="text-center"><?php  echo $nombre_carreras?></td>
				<td class="text-center"><?php  echo $rvoe_carreras?></td>
				<td class="text-center"><?php  echo $nombre_niveles?></td>
				<td class="text-center">
				<button class="btn btn-warning btn_editar" data-id_carreras=" <?php echo $id_carreras?>"><i class="fa fa-pencil" aria-hidden="true"></i>
				</button>
				<button class="btn btn-danger btn_eliminar" data-id_carreras=" <?php echo $id_carreras?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
				</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
