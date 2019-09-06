<?php include("../conexi.php");
	$link=Conectarse();
?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Materias</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		$q_materias ="SELECT * FROM materias";
							$result_materias=mysqli_query($link,$q_materias) or die("Error en: $q_materias ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result_materias)){
								$id_materias = $row["id_materias"];
								$nombre_materias = $row["nombre_materias"];
								
	?>
				<tr>
				
				<td class="text-center"><?php  echo $id_materias?></td>
				<td class="text-center"><?php  echo $nombre_materias?></td>
				<td class="text-center">
				<button class="btn btn-warning btn_editar" data-id_materias=" <?php echo $id_materias?>"><i class="fa fa-pencil" aria-hidden="true"></i>
				</button>
				<button class="btn btn-danger btn_eliminar" data-id_materias=" <?php echo $id_materias?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
				</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
