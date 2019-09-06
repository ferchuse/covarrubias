<?php
include("../conexi.php");
$link = Conectarse();
?>



<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th class="text-center">Nombre</th>
					<th class="text-center">Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$consulta ="SELECT * FROM alumnos 
					WHERE id_clientes = '".$_GET['id_clientes']."'
					";
					$resultado = mysqli_query($link,$consulta) or die("Error en: $consulta ".mysqli_error($link));
					while($row = mysqli_fetch_assoc($resultado)){
						$id_alumnos = $row["id_alumnos"] ;
						$nombre_alumnos = $row["nombre_alumnos"]. " " .$row["apellidop_alumnos"]." ".$row["apellidom_alumnos"] ;
				?>
						<tr>
							<td class="text-center">
								<?php echo $nombre_alumnos;?>
							</td>
							<td class="text-center">
								<button class="btn btn-danger btn_quitar_alumno" type="button" title="Quitar Alumno" data-id_valor="<?php echo $id_alumnos?>"><i class="fa fa-times"></i>
									</button>
							</td>
						</tr>
				<?php 
				}
				?>
			</tbody>
		</table>
	</div>
</div>