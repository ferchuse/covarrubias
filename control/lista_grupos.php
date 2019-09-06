<?php include("../conexi.php");
	$link=Conectarse();
?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th class="text-center">Grupo</th>
					<th class="text-center">Nivel</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		$q_aulas ="
			SELECT * FROM grupos 
				LEFT JOIN grados USING (id_grados)
				LEFT JOIN niveles ON grupos.id_niveles = niveles.id_niveles
				";
							$result_aulas=mysqli_query($link,$q_aulas) or die("Error en: $q_aulas  ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result_aulas)){
								$id_grupos = $row["id_grupos"];
								$nombre_grupos = $row["nombre_grupos"];
								$nombre_niveles = $row["nombre_niveles"];
								
	?>
				<tr>
				<td class="text-center"><?php  echo $nombre_grupos; ?></td>
				<td class="text-center"><?php  echo $nombre_niveles; ?></td>
				<td class="text-center">
				<button class="btn btn-warning btn_editar" data-id_grupos=" <?php echo $id_grupos?>">
					<i class="fa fa-pencil" ></i>
				</button>
				<button class="btn btn-danger btn_eliminar" data-id_grupos=" <?php echo $id_grupos?>">
						<i class="fa fa-trash" ></i>
				</button>
				</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
