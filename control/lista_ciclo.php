<?php
include("../conexi.php");
$link = Conectarse();
?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th class="text-center">
						Nombre
					</th>
					<th  class="text-center">
						Fecha de inicio
					</th>
					<th class="text-center">
						Fecha final
					</th>
					<th class="text-center">
						Acciones
					</th>
				</tr>
			</thead>
				<tbody>
					<?php $q_ciclos = "SELECT * FROM ciclo_escolar ORDER BY nombre_ciclos ASC ";
					$result_ciclos=mysqli_query($link,$q_ciclos) or die("Error en: $q_ciclos ".mysqli_error($link));
					while($row = mysqli_fetch_assoc($result_ciclos))
					{
					$id_ciclos = $row["id_ciclos"];
					$inicio_fechas = $row["inicio_fechas"];
					$fin_fechas = $row["fin_fechas"];
					$nombre_ciclos = $row["nombre_ciclos"];
					?>
					<tr>
					<td class="text-center"><?php echo $nombre_ciclos;?></td>
					<td class="text-center"><?php echo date("d/m/Y",strtotime($inicio_fechas));?></td>
					<td class="text-center"><?php echo date("d/m/Y",strtotime($fin_fechas));?></td>
					<!--strtotime convierte una fecha en ingles a una con la siguiente mascara d/m/Y
					-->
					<td class="text-center">
						<button class="btn btn-danger btn_eliminar" data-id_ciclos="<?php echo $id_ciclos?>"><i class="fa fa-trash" aria-hidden="true"></i>
						</button>
					</td>
					</tr>
					<?php }?>
				</tbody>
		</table>
	</div>
</div>