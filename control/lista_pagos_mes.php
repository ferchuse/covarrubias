<?php

include("../conexi.php");
$link = Conectarse();

	$meses = array(
			'Semestre',
			'Agosto',
			'Septiembre',
			'Octubre',
			'Noviembre',
			'Diciembre',
			'Enero',
			'Febrero',
			'Marzo',
			'Abril',
			'Mayo',
			'Junio',
			'Julio'
			);

	$semestres = array(
		'0','1','2','3',
		'4','5','6');
	$no_mes = array(
		'8','9','10','11','12',
		'1','2','3','4','5','6','7');
		
?>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12">	
			<div class="panel panel-default">
				<div class="panel-body">
				<!---INICIO TABLA-->	
					<div class="table-responsive">
						<table class="table table-hover" id="tabla">
							<tbody>
							<?php
							$consulta = "SELECT
	id_alumnos,
	id_ciclos,
	meses_pagos,
	total_pagos
FROM
	pagos
WHERE
	id_alumnos = ".$_GET['id_alumnos'];

$mensaje_error = 'no encontrado';

$result_complete = mysqli_query($link, $consulta)
or die ("Error al ejecutar consulta: $consulta".mysqli_error($link));

$numero_filas = mysqli_num_rows($result_complete);
$contador = 0;

$tabla_pagos = array();

while($fila = mysqli_fetch_assoc($result_complete)){
	$contador++;
	$id_ciclos  = $fila['id_ciclos'];
	$meses_pagos  = $fila['meses_pagos'];
	$total_pagos  = $fila['total_pagos'];
	$tabla_pagos[$id_ciclos][$meses_pagos][] =$total_pagos  ;
}

echo "<pre>".var_dump($tabla_pagos)."</pre>";

for($fila=0;$fila<count($semestres);$fila++){
		echo "<tr>";
		for($col=0;$col<count($meses);$col++){	
				if($fila==0){
					echo "<th>".$meses[$col]."</th>";
					
				}else if($fila != 0 && $col ==0){
					echo "<td>".$semestres[$fila]."</td>";
					
				}else{
					echo "<td>".$no_mes[$fila]."</td>";
					
				}
			
		}
		echo "</tr>";
	}
							?>
							</tbody>
						</table>
					</div>
					<!---FIN DE LA TABLA-->	
				</div>
			</div>
		</div>
	</div>
</div>
