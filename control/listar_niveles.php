<?php 
	include('../conexi.php');
	$link = Conectarse();
?>
<div class="row">
	<table class="table">
		<thead>
			<tr>
			<th class="text-center">Id</th>
			<th  class="text-center">Nombre</th>
			<th  class="text-center">Activo</th>
			<th  class="text-center">Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$q ="SELECT * FROM niveles";
							$result=mysqli_query($link,$q) or die("Error en: $q_alumnos  ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result)){
								$id_niveles = $row["id_niveles"];
								$nombre_niveles = $row["nombre_niveles"];
								$activo_niveles = $row["activo_niveles"];
		?>
			<tr>
				<td class="text-center"><?php echo $id_niveles; ?></td>
				<td class="text-center"><?php echo $nombre_niveles; ?></td>
				<td class="text-center"><input onclick="javascript: return false;" type="checkbox" <?php 
				if($activo_niveles == 1){
				echo "checked";//es un atributo booleano cuando esta presente un elemento input debe estar marcado 
				//se aplica tanto como checkbox y radio
				}?>></td>
				<td class="text-center">
							<button class="btn btn-warning btn_editar"  data-id_niveles="<?php echo $id_niveles; ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
							</button>
							<button class="btn btn-danger btn_eliminar"  data-id_niveles="<?php echo $id_niveles; ?>"><i class="fa fa-trash" aria-hidden="true"></i>
							</button>
							<button class="btn btn_doc"  data-id_niveles="<?php echo $id_niveles; ?>"><i class="fa fa-file-text" aria-hidden="true"></i>
							</button>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
</div>