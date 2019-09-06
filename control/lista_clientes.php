<?php 
	include("../conexi.php");
	$link = Conectarse();
	$query ='SELECT
		*
	FROM
		clientes
	LEFT JOIN (
		SELECT
			GROUP_CONCAT(nombre_alumnos," " , apellidop_alumnos, " ",apellidom_alumnos SEPARATOR "<br>") AS alumnos, 
			id_clientes
		FROM
			alumnos
		GROUP BY
			id_clientes
	) AS alumnos_por_cliente USING (id_clientes) ';
		
	
	$result=mysqli_query($link,$query) or die("Error en: $query  ".mysqli_error($link));
		
	while($row = mysqli_fetch_assoc($result)){
		$id_clientes = $row["id_clientes"];
		$razon_social_clientes = $row["razon_social_clientes"];
		$rfc_clientes = $row["rfc_clientes"];
		$alias_clientes = $row["alias_clientes"];
		$alumnos = $row["alumnos"];
?>
	<tr>
		<td class="text-center"> <?php echo $razon_social_clientes.$alias_clientes; ?></td>
		<td class="text-center"><?php echo $rfc_clientes; ?></td>
		<td class="text-center"><?php echo $alumnos; ?></td>
		<td class="text-center">
			<button title="Editar"  class="btn btn-warning btn_editar"  data-id_value="<?php echo $id_clientes; ?>">
				<i class="fa fa-edit" ></i>
			</button>
			
			<button title="Asignar Alumnos" class="btn btn-info btn_alumnos "  data-id_value="<?php echo $id_clientes; ?>">
				<i class="fa fa-users" ></i>
			</button>
			<button title="Eliminar" class="btn btn-danger btn_eliminar"  data-id_value="<?php echo $id_clientes; ?>">
				<i class="fa fa-trash" ></i>
			</button>
		</td>
	</tr>
	<?php }?>