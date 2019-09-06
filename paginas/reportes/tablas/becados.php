<?php
	include("../../../conexi.php");
	$link = Conectarse();
	
	$consulta = "
			SELECT
			*
		FROM
			descuentos
		FULL JOIN alumnos USING (id_descuentos)
		LEFT JOIN inscripciones USING (id_alumnos)
		LEFT JOIN grupos USING (id_grupos)
		LEFT JOIN niveles ON niveles.id_niveles = grupos.id_niveles
		WHERE
			id_descuentos <> 0
		AND estatus_alumnos = 'INSCRITO'
		AND inscripciones.id_ciclos = '5'
		ORDER BY
			nombre_niveles, nombre_descuentos ";
	$result=mysqli_query($link,$consulta) or die("Error en: $consulta ".mysqli_error($link));
	while($fila = mysqli_fetch_assoc($result)){
		$registros[] = $fila;
	}
?>


<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
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
					<th  class="text-center">
						Nivel
					</th>
				
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($registros as $i => $fila){
					?>
					<tr>
						<td class="text-center">
							<?php echo $fila["nombre_alumnos"]." ".$fila["apellidop_alumnos"]." ".$fila["apellidom_alumnos"];?>
						</td>
						<td class="text-center"><?php echo $fila["nombre_descuentos"];?></td>
						<td class="text-center">
							<?php 
								if($fila["tipo_descuento"] == 'Monto'){
									echo "$".$fila["cantidad_descuentos"];
									
								}
								else{
									echo $fila["cantidad_descuentos"]."%";
								}
							?> 
						</td>
						<td class="text-center"><?php echo $fila["nombre_niveles"];?></td>
					</tr>
					<?php
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td>Registros: <?php echo mysqli_num_rows($result)?></td>
					<td></td>
					<td></td>
					<td></td>
					
				</tr>
			</tfoot>
		</table>
	</div>
</div>		