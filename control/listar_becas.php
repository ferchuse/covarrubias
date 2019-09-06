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
						Tipo de Descuento
					</th>
					<th  class="text-center">
						Cantidad
					</th>
					<th class="text-center">
						Acciones
					</th>
				</tr>
			</thead>
				<tbody>
					<?php $q_descuentos = "SELECT * FROM descuentos ";
					$result_descuentos=mysqli_query($link,$q_descuentos) or die("Error en: $q_descuentos ".mysqli_error($link));
					while($fila = mysqli_fetch_assoc($result_descuentos))
					{
					$id_descuentos = $fila["id_descuentos"];
					$nombre_descuentos = $fila["nombre_descuentos"];
					?>
					<tr>
					<td class="text-center"><?php echo $nombre_descuentos;?></td>
					<td class="text-center"><?php echo $fila["tipo_descuento"];;?></td>
					<td class="text-center"><?php echo $fila["cantidad_descuentos"];;?></td>
					<td class="text-center">
						
						
						<button class="btn btn-warning btn_editar" data-id_descuentos="<?php echo $id_descuentos?>"><i class="fa fa-pencil" aria-hidden="true"></i>
						</button>
						<button class="btn btn-danger btn_eliminar" data-id_descuentos="<?php echo $id_descuentos?>"><i class="fa fa-trash" aria-hidden="true"></i>
						</button>
						
					</td>
					</tr>
					<?php }?>
				</tbody>
		</table>
	</div>
</div>