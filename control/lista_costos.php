<?php
include('../conexi.php');
$link = Conectarse();

?>

<div class="col-md-12">
	<table class="table">
		<tr>
			<th class="text-center">Concepto</th>
			<th class="text-center">Precio</th>
			<th class="text-center">Periodo</th>
			<th class="text-center">Niveles</th>
			<th class="text-center">Acciones</th>
		</tr>
		<?php
		$consulta = "SELECT * FROM costos LEFT JOIN niveles USING (id_niveles)";
		$resultado = mysqli_query($link,$consulta) or die('Error en la DB '.mysqli_error($link));
		
		while($row = mysqli_fetch_assoc($resultado)){
			$id_costos = $row['id_costos'];
			$concepto_costos = $row['concepto_costos'];
			$cantidad_costos = $row['cantidad_costos'];
			$numero_costos = $row['numero_costos'];
			$periodo_costos = $row['periodo_costos'];
			$id_niveles = $row['id_niveles'];
			$nombre_niveles= $row['nombre_niveles'];
			
			
		
		?>
		<tr>
			<td class="text-center"><?php echo $concepto_costos; ?></td>
			<td class="text-center"><?php echo $cantidad_costos; ?></td>
			<td class="text-center"><?php echo $periodo_costos; ?></td>
			<td class="text-center"><?php echo $nombre_niveles; ?></td>
			<td class="text-center">
							<button class="btn btn-warning btn_editar"  data-id_costos="<?php echo $id_costos; ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
							</button>
							<button class="btn btn-danger btn_eliminar"  data-id_costos="<?php echo $id_costos; ?>"><i class="fa fa-trash" aria-hidden="true"></i>
							</button>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>