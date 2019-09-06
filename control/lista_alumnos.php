<?php 
	error_reporting(E_ALL);
	include("../conexi.php");
	$link = Conectarse();
	$consulta ="SELECT * FROM alumnos
	LEFT JOIN inscripciones ON inscripciones.id_alumnos = alumnos.id_alumnos
	LEFT JOIN grados ON alumnos.id_grados = grados.id_grados
	LEFT JOIN grupos ON inscripciones.id_grupos = grupos.id_grupos
	LEFT JOIN descuentos USING (id_descuentos)
	LEFT JOIN niveles ON grupos.id_niveles = niveles.id_niveles WHERE 1  ";
	if(isset($_POST['filtros'])){ 
		
		foreach($_POST['filtros'] as $key => $value){
			if($value != ""){
				$consulta.= " AND $key='$value' ";
			}
		}
	}
	
	$consulta.= " ORDER BY nombre_niveles, nombre_grupos, apellidop_alumnos ";
	
	$result_alumnos=mysqli_query($link,$consulta) or die("Error en: $consulta  ".mysqli_error($link));
	
	while($row = mysqli_fetch_assoc($result_alumnos)){
		$id_alumnos = $row["id_alumnos"];
		$id_ciclos = $row["id_ciclos"];
		$id_grupos = $row["id_grupos"];
		$id_grados = $row["id_grados"];
		$id_niveles = $row["id_niveles"];
		$nombre_alumnos = $row["nombre_alumnos"];
		$nombre_niveles = $row["nombre_niveles"];
		$nombre_grados = $row["nombre_grados"];
		$nombre_grupos = $row["nombre_grupos"];
		$apellidop_alumnos = $row["apellidop_alumnos"];
		$apellidom_alumnos = $row["apellidom_alumnos"];
		$estatus_alumnos = $row["estatus_alumnos"];
		$nombre_descuentos = $row["nombre_descuentos"];
		$porc_descuentos = $row["porcentaje_descuentos"];
		$curp_alumnos = $row["curp_alumnos"];
		$nombre_completo = $nombre_alumnos." ".$apellidop_alumnos." ".$apellidom_alumnos;
	?>
	<tr class="<?php echo $estatus_alumnos == 'BAJA' ? 'danger': '' ;?>">
		
		<td class="text-center">
			<a target="_blank" href="detalles_alumnos.php?id_alumnos=<?php echo $id_alumnos;?>&id_ciclos=<?php echo $id_ciclos;?>" class="nombre_alumnos">
				<?php echo $nombre_completo; ?>
			</a> 
		</td> 
		<td class="text-center"><?php echo $nombre_niveles;?></td>
		<td class="text-center"><?php echo $nombre_grupos." ".$nombre_niveles;?></td>
		<td class="text-center"><?php echo $estatus_alumnos; ?></td>
		<td class="text-center">
			<?php 
				if($estatus_alumnos != 'BAJA'){
				?>
				<button class="btn btn-danger btn_baja" type="button" title="Dar de baja" data-id_alumnos="<?php echo $id_alumnos; ?>"><i class="fa fa-user-times" ></i>
				</button>
				<a class="btn btn-info"  title="Pagar Colegiaturas" href="pagar_colegiaturas.php?id_alumnos=<?php echo $id_alumnos;?>&nombre_alumnos=<?php echo $nombre_completo;?>&nombre_descuentos=<?php echo $nombre_descuentos;?>&porc_descuentos=<?php echo $porc_descuentos;?>&curp=<?php echo $curp_alumnos;?>&id_ciclos=<?php echo $id_ciclos;?>">
					<i class="fa fa-dollar" ></i>
				</a>
				<a class="btn btn-default"  title="Venta de Artículos" href="pagos.php?id_alumnos=<?php echo $id_alumnos;?>&nombre_alumnos=<?php echo $nombre_completo;?>">
					<i class="fa fw fa-shopping-bag"></i>
				</a>
				<a class="btn btn-warning btn_detalles" type="button" title="Editar" href="detalles_alumnos.php?id_alumnos=<?php echo $id_alumnos; ?>&id_ciclos=<?php echo $id_ciclos;?>"><i class="fa fa-pencil" ></i>
				</a>
				<a class="btn btn-default btn_historial" type="button" title="Historial de pagos" href="historial_pagos.php?id_alumnos=<?php echo $id_alumnos; ?>"><i class="fa fa-clock-o" ></i>
				</a>
				<button class="btn btn-success btn_ciclo" type="button" title="Promover Grado" 
				data-id_alumnos="<?php echo $id_alumnos; ?>" 
				data-grado_anterior="<?php echo $nombre_grupos." ".$nombre_niveles;?>" 
				data-id_ciclos="<?php echo $id_ciclos; ?>" 
				data-id_grupos="<?php echo $id_grupos; ?>" 
				data-nombre_alumnos="<?php echo $nombre_completo; ?>" 
				data-id_grados="<?php echo $id_grados; ?>" 
				data-id_niveles="<?php echo $id_niveles; ?>">
					<i class="fa fa-fast-forward" ></i>
				</button>
				<button class="btn btn-primary btn_reinscribir" type="button" title="Reinscribir" 
				data-id_alumnos="<?php echo $id_alumnos; ?>" 
				data-grado_anterior="<?php echo $nombre_grupos." ".$nombre_niveles;?>" 
				data-id_ciclos="<?php echo $id_ciclos; ?>" 
				data-id_grupos="<?php echo $id_grupos; ?>"  
				data-nombre_alumnos="<?php echo $nombre_completo; ?>" 
				data-id_grados="<?php echo $id_grados; ?>" 
				data-id_niveles="<?php echo $id_niveles; ?>">
					<i class="fa fa-repeat" ></i>
				</button>
				<?php
					}else{
				?>
				<button class="btn btn-success btn_alta" type="button" title="Alta" data-id_alumnos="<?php echo $id_alumnos; ?>"><i class="fa fa-user-plus"></i>
				</button>
			<?php }?>
			
			
		</td>
		<td class="text-center">
			<input form="form_seleccionados" type="checkbox" name="alumnos[]" class="seleccionado" value="<?php echo $id_alumnos; ?>">
		</td>
	</tr>
	<?php 
	}
?>
<tr hidden>
	<td COLSPAN="6">
		<pre >
			
			<?php echo $consulta;?>
		</pre>
	</td>
	
</tr>