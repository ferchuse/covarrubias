<?php

include("../conexi.php");
$link = Conectarse();

$consulta = "SELECT
	*
FROM
	pagos
	LEFT JOIN costos USING (id_costos)
	LEFT JOIN ciclo_escolar USING (id_ciclos) 
WHERE
	id_alumnos = ".$_GET['id_alumnos'];

$meses = array(
0 => "ENERO",
1 => "FEBRERO",
2 => "MARZO",
3 => "ABRIL",
4 => "MAYO",
5 => "JUNIO",
6 => "JULIO",
7 => "AGOSTO",
8 => "SEPTIEMBRE",
9 => "OCTUBRE",
10 => "NOVIEMBRE",
11 => "DICIEMBRE"
);

$mensaje_error = 'no encontrado';

$result_complete = mysqli_query($link, $consulta)
or die ("Error al ejecutar consulta: $consulta".mysqli_error($link));

$numero_filas = mysqli_num_rows($result_complete);
$contador = 0;

$tabla_pagos = array();


?>
<table class="table table-bordered" id="exportar_exel">
		<thead>
				<tr>
					<th>Fecha Pago</th>
					<th>Ciclo Escolar</th>
					<th>Concepto</th>
					<th>Descuento</th>
					<th>Recargos</th>
					<th>Total Pagado</th>
					<th class="hidden-print">Acciones</th>
				</tr>
		</thead>
		<tbody>
			<?php
			while($fila = mysqli_fetch_assoc($result_complete)){
				$contador++;
				$id_pagos = $fila['id_pagos'];
				$nombre_ciclos  = $fila['nombre_ciclos'];
				$fecha_pagos  = date("d/m/Y", strtotime($fila['fecha_pagos']));
				$meses_pagos  = $fila['meses_pagos'];
				$descripcion_pagos  = $fila['descripcion_pagos'];
				$descuento_pagos  = $fila['descuento_pagos'];
				$recargos_pagos  = $fila['recargo_pagos'];
				$total_pagos  = $fila['total_pagos'];
				$es_articulo = $fila["es_articulo"];
				//$tabla_pagos[$id_ciclos][$meses_pagos][] =$total_pagos  ;
				$descripcion = array();
				
				if($fila['es_articulo'] == "1"){
					$descripcion[] = $fila['descripcion_pagos'];
				}else{
					$consultaDetalle = "SELECT * FROM pagos_detalle WHERE id_pagos='$id_pagos'";
					$resultDetalle = mysqli_query($link, $consultaDetalle);
					while($rowDetalle = mysqli_fetch_assoc($resultDetalle)){
				
					$descripcion[] = $rowDetalle['descripcion_pagos'];
					
					}
				}
				?>
			
				<tr>
					<td><?php echo $fecha_pagos;?></td>
					<td><?php echo $nombre_ciclos;?></td>
					<td><?php echo implode(",",$descripcion);?></td>
					<td><?php echo $descuento_pagos;?></td>
					<td><?php echo $recargos_pagos;?></td>
					<td class="text-right"> $ <?php echo number_format($total_pagos);?></td>
					<td class="text-center hidden-print">
						<a  title="Reimpresión pago" class="btn btn-info btn_reimprecionPago  hidden-print" href="imprimir_pago.php?folio_pago=<?php echo $id_pagos;?>"><i class="fa fa-print"></i></a> 
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
</table>
