<?php include("../conexi.php");
	$link=Conectarse();
?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th class="text-center">Nombre del Profesor</th>
					<th class="text-center">Correo Electronico</th>
					<th class="text-center">Acciones</th>	
				</tr>
			</thead>
			<tbody>
	<?php 
		$q_maestros ="SELECT DISTINCT * FROM maestros ORDER BY nombre_maestro ASC";
							$result_maestros=mysqli_query($link,$q_maestros) or die("Error en: $q_maestros  ".mysqli_error($link));
								
							while($row = mysqli_fetch_assoc($result_maestros)){
								$id_maestros = $row["id_maestros"];
								$nombre_maestro = $row["nombre_maestro"];
								$paterno_maestro = $row["paterno_maestro"];
								$materno_maestro = $row["materno_maestro"];
								$correo_maestro = $row["correo_maestro"];
							
	?>
				<tr>
				<td class="text-center"><?php  echo $paterno_maestro." ".$materno_maestro." ".$nombre_maestro?></td>
				
				<td class="text-center"><?php  echo $correo_maestro?></td>
				<td class="text-center">
				<button class="btn btn-warning btn_editar_maestro" data-id_maestros="<?php echo $id_maestros?>">
					<i class="fa fa-pencil" ></i>
				</button>
				<button class="btn btn-danger btn_eliminar_maestro" data-id_maestros="<?php echo $id_maestros?>">
					<i class="fa fa-trash"></i>
				</button>
				<button class="btn btn_materias"  title="Materias" data-id_maestros="<?php echo $id_maestros?>">
					<i class="fa fa-file-text" ></i>
				</button>
				</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>
