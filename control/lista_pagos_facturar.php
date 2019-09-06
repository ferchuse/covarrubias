<?php

include("../conexi.php");
$link = Conectarse();

	
$consulta = "SELECT
	id_pagos,
	subtotal,
	recargo_pagos,
	descuento_pagos,
	total_pagos,
	GROUP_CONCAT(
		pagos_detalle.descripcion_pagos
	) AS descripcion
FROM
	pagos
LEFT JOIN pagos_detalle USING (id_pagos)
WHERE
	
 ISNULL(es_articulo)
AND ISNULL(estatus_pagos)
AND facturado <> 1
AND id_alumnos = ".$_GET['id_alumnos']."
GROUP BY
	id_pagos";

$result = mysqli_query($link, $consulta)
or die ("Error al ejecutar consulta: $consulta".mysqli_error($link));

$numero_filas = mysqli_num_rows($result);
if(mysqli_num_rows($result) == 0){
	
	echo "<div class='alert alert-warning'>No hay Pagos para Facturar</div>";
}
else{?>
	
		<div class="list-group">		
		<?php
		while($fila = mysqli_fetch_assoc($result)){?>
			<label class="list-group-item">
														
					<input class="sumar_checked" 
					
					data-importe="<?php echo $fila["subtotal"]; ?>"  
					data-descuento="<?php echo $fila["descuento_pagos"]; ?>" 
					data-descripcion="<?php echo $fila["descripcion"]; ?>" 
					type="checkbox" name="id_pagos[]" value="<?php echo $fila["id_pagos"]?>">
					<?php 
							echo "Folio: ".$fila["id_pagos"]."<br>"; 
							echo "Conceptos: ".$fila["descripcion"]."<br>"; 
							echo "Subtotal: ".$fila["subtotal"]."<br>"; 
							echo "Descuento: ".$fila["descuento_pagos"]."<br>"; 
							echo "Recargos: ".$fila["recargo_pagos"]."<br>"; 
								echo "Total: ".$fila["total_pagos"]."<br>"; 
						?>
					
					<input disabled class="importe hidden" name="importe[]" >
					<input disabled class="descripcion hidden" name="descripcion[]" >
					<input disabled class="descuento hidden" name="descuento[]" >
					<input disabled class="recargos hidden" name="recargos[]" >
			</label>
	
		<?php
		}
		?>
		</div>
<?php		
}
?>


