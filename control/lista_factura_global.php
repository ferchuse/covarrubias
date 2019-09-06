<?php 
	include("../conexi.php");
	$link = Conectarse();

	$fecha_inicial = $_GET["fecha_inicial"];
	$fecha_final = $_GET["fecha_final"];
	
	
	$query ="SELECT *, 
	SUM(total_pagos) AS total_pagos 
	FROM pagos 
	WHERE fecha_pagos
	BETWEEN '$fecha_inicial' AND '$fecha_final'
	AND estatus_pagos IS NULL
	AND facturado = 0	";
		
	
	$result =mysqli_query($link,$query) or die("Error en: $query  ".mysqli_error($link));
	while($fila = mysqli_fetch_assoc($result)){
		if($fila["total_pagos"]==  ''){
			
			echo '<div class="alert alert-warning">No hay pagos pendientes de facturar</div>';
		}
		else{
			
				 
		?> 
			<div class="col-sm-10 form-group">
				<label>Descripción</label>
				<input form="form_factura" class="form-control" type="text" name="descripcion" value="Ingresos por colegiaturas del <?php echo date("d/m/Y", strtotime($fecha_inicial))." al ".date("d/m/Y", strtotime($fecha_final)) ;	?>">
						
					
			</div>
			<div class="col-sm-2">
				
				<label>Importe</label>
				<input  form="form_factura"  class="form-control" type="number" name="importe" value="<?php echo $fila["total_pagos"] ;	?>">
					
			</div>
			<?php
			//echo mysqli_num_rows($result);
			}
	}?>