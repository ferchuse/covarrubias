<?php 
	include('../conexi.php');
	$link = Conectarse();
	$id_niveles = $_POST['id_niveles'];
?>
<button class="btn btn-success" id="btn_documento" data-id_niveles="<?php echo $id_niveles; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
<div class="row">
	<table class="table">
		<thead>
			<tr>
			<th class="text-center">Id</th>
			<th  class="text-center">Documento</th>
			<th  class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$q ="SELECT * FROM documentacion WHERE id_niveles='$id_niveles'";
							$result=mysqli_query($link,$q) or die("Error en: $q  ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result)){
								$id_documentacion = $row["id_documentacion"];
								$nombre_documentacion = $row["nombre_documentacion"];
		?>
			<tr>
				<td class="text-center"><?php echo $id_documentacion; ?></td>
				<td class="text-center"><?php echo $nombre_documentacion; ?></td>
				<td class="text-center">
							<button class="btn btn-warning btn_editar"  data-id_documentacion="<?php echo $id_documentacion; ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
							</button>
							<button class="btn btn-danger btn_eliminar"  data-id_documentacion="<?php echo $id_documentacion; ?>"><i class="fa fa-trash" aria-hidden="true"></i>
							</button>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
</div>