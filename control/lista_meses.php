
<?php
	
	include('../conexi.php');
	$link = Conectarse();
	$id_alumnos = $_POST['id_alumnos'];
	$id_ciclos = $_POST['id_ciclos'];
	$meses =  array(
	"1" => "Enero", 
	"2" => "Febrero", 
	"3" => "Marzo", 
	"4" => "Abril", 
	"5" => "Mayo", 
	"6" => "Junio", 
	"7" => "Julio", 
	"8" => "Incripción", 
	"9" => "Septiembre", 
	"10" => "Octubre", 
	"11" => "Noviembre",  
	"12" => "Diciembre"
	);
	
	$cons_pagos = "SELECT * FROM colegiaturas_por_alumno 
	WHERE id_alumnos = '$id_alumnos'
	AND id_ciclos = $id_ciclos ";
	
	$result_pagos = mysqli_query($link, $cons_pagos) or die('Error en'.$cons_pagos .mysqli_error($link));							 
	
	// echo "<pre>$cons_pagos</pre>";
?>											


<label >Meses:</label>
<div class="list-group" >		
	<?php
		
		while($fila_pagos = mysqli_fetch_assoc($result_pagos)){ 
			$vencido = $fila_pagos["estatus_colegiaturas"] == "VENCIDO" ? 1 : 0;
			$importe = $fila_pagos["importe_colegiaturas"];
			$descripcion_colegiaturas = $fila_pagos["descripcion_colegiaturas"];
			// $descripcion_pagos = $fila_pagos["estatus_colegiaturas"];
		?>
		<label class="list-group-item"> 
			<?php 
				if($fila_pagos["estatus_colegiaturas"] != 'PAGADO'){ ?>
				<input class="sumar_checked" 
				data-valor="<?php echo $fila_pagos["restante_colegiaturas"]; ?>"
				data-vencido="<?php echo $vencido; ?>" 
				data-importe="<?php echo $importe; ?>" 
				data-descripcion="<?php echo $descripcion_colegiaturas;?>" 
				type="checkbox" name="id_colegiaturas[]" value="<?php echo $fila_pagos["id_colegiaturas"]?>">
				<?php echo $descripcion_colegiaturas;  ?>
				<span class="pull-right">
					<input class="importe " name="importe[]" value="<?php echo $importe; ?>">
				</span>
				<input disabled class="descripcion hidden" name="descripcion[]" >
				<?php	
					}else{
					
					echo $meses[$fila_pagos["mes_colegiaturas"]];  
				}
			?>
			
			<?php
				switch($fila_pagos["estatus_colegiaturas"]){ 
					case 'VENCIDO':
				?>	
				<span class="badge badge-danger badge-pill">VENCIDO</span>
				<?php	
					break;
					case 'PAGADO':
				?>	
				<span class="badge badge-success badge-pill">PAGADO</span>
				<?php	
					break;
				}
			?>	
		</label>
		<?php 
		}
	?>
</div>