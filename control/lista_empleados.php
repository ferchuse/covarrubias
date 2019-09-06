<?php 
	include("../conexi.php");
	$link = Conectarse();
	
	$consulta ='SELECT
	*
	FROM
	empleados
	ORDER BY id_empleados
	';
	
	
	$result=mysqli_query($link,$consulta) or die("Error en: $consulta  ".mysqli_error($link));
	
	
?>
<table class="table table-bordered ">
	<thead>
		<tr>
			<th>
				Num
			</th>
			<th>
				Nombre
			</th>
		</tr>
	</thead>
	<?php
		
		while($fila = mysqli_fetch_assoc($result)){
			
		?>
		
		<tr>
			<td class="text-center"> <?php echo $fila["id_empleados"]; ?></td>
			<td class="text-center"> <?php echo $fila["nombre_empleados"]; ?></td>
			<td class="text-center">
				<button title="Editar"  class="btn btn-warning btn_editar"  data-id_registro="<?php echo $fila["id_empleados"]; ?>">
					<i class="fa fa-edit" ></i>
				</button>
				<button title="Eliminar" class="btn btn-danger btn_eliminar"  data-id_registro="<?php echo $fila["id_empleados"]; ?>">
					<i class="fa fa-trash" ></i>
				</button>
			</td>
		</tr>
		<?php
		}
	?>
	<tr>
		<td>
			<?php echo mysqli_num_rows($result);?> Registros.
		</td>
		<td></td>
		<td></td>
	</tr>
</table>