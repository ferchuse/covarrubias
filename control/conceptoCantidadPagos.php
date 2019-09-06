<?php
include('../conexi.php');
$link = Conectarse();

$id_niveles = $_POST['id_niveles'];
?>


<div class="form-group">
	<label for="cantidad_costos">Cantidad:<label/>
	<input class="form-control" id="cantidad_costos" name="cantidad_costos" type="text">
</div>
<div class="form-group hidden" id="meses">
<label for="mes_pagos">Mes a pagar:</label>
	<select class="form-control" id="mes_pagos" name="mes_pagos">
		<option value="">Elije un mes...</option>
		<option value="01">Enero</option>
		<option value="02">Febrero</option>
		<option value="03">Marzo</option>
		<option value="04">Abril</option>
		<option value="05">Mayo</option>
		<option value="06">Junio</option>
		<option value="07">Julio</option>
		<option value="08">Agosto</option>
		<option value="09">Septiembre</option>
		<option value="10">Octubre</option>		
		<option value="11">Noviembre</option>		
		<option value="12">Diciembre</option>		
	</select>
</div>
<div class="form-group hidden" id="ciclo">
<label for="ciclo_pagos">Ciclo:</label>
	<select  class="form-control" id="ciclo_pagos"  name="ciclo_pagos">
	<option value="">Elije un ciclo...</option>
	<?php  
	$ciclos = "SELECT * FROM ciclo_escolar";
	
	$resultado_ciclo = mysqli_query($link, $ciclos) or die('Error en la DB '.mysqli_error($link));
	
	while($fila = mysqli_fetch_assoc($resultado_ciclo)){
		$id_ciclos = $fila['id_ciclos'];
		$nombre_cliclos = $fila['nombre_ciclos'];
	?>
	<option value="<?php echo $id_ciclos; ?>"><?php echo $nombre_cliclos; ?></option>
	<?php 
		}
	?>
	</select>
</div>
<div class="form-group">
	<label for="recargo_costos">Recargo (%):<label/>
	<input class="form-control" id="recargo_costos" name="recargo_costos" type="text">
</div>
<div class="form-group">
	<label for="descuento_costos">Descuento (%):</label>
	<select name="descuento_costos" id="descuento_costos" class="form-control">
		<option value="" data-por_desc="0">Elije beca...</option>
		<?php 
			$beca = "SELECT * FROM descuentos";
			$resultado_becas = mysqli_query($link, $beca) or die('Error en $beca '.mysqli_error($link));
			while($row2=mysqli_fetch_assoc($resultado_becas)){
				$id_descuentos = $row2['id_descuentos'];
				$nombre_descuentos = $row2['nombre_descuentos'];
				$porcentaje_descuentos = $row2['porcentaje_descuentos'];
		?>
		<option data-por_desc="<?php echo $porcentaje_descuentos; ?>" value="<?php echo $id_descuentos; ?>"><?php echo $nombre_descuentos; ?></option>
		<?php  
		}
		?>
	</select>
</div>
<div class="form-group">
	<label for="descuento_costos">Descuento Cantidad:</label>
	<input class="form-control" id="decuento_cantidad" name="decuento_cantidad" type="number">
</div>
<div class="form-group">
	<label for="total_costos">Total:<label/>
	<input class="form-control" id="total_costos" required name="total_costos" type="text">
</div>