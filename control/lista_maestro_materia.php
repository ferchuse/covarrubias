<?php 
	include('../conexi.php');
	$link = Conectarse();
	$id_maestros = $_POST['id_maestros'];
?>

<div class="row">
	<table class="table">
		<thead>
			<tr>
			
			<th  class="text-center">Materia</th>
			<th  class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$q ="SELECT * FROM materias_maestros
LEFT JOIN materias ON materias_maestros.id_materias = materias.id_materias
LEFT JOIN maestros ON materias_maestros.id_maestros = maestros.id_maestros
WHERE materias_maestros.id_maestros='$id_maestros'";
							$result=mysqli_query($link,$q) or die("Error en: $q  ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result)){
								$id_materiasmaestros = $row["id_materiasmaestros"];
								$id_materias = $row["id_materias"];
								$nombre_materias = $row["nombre_materias"];
		?>
			<tr>
				<td class="text-center"><?php echo $nombre_materias; ?></td>
				<td class="text-center">
							<button class="btn btn-danger btn_eliminar_materia"  data-id_materiasmaestros="<?php echo $id_materiasmaestros; ?>">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</button>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
</div>