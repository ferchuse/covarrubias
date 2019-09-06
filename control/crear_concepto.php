<?php 
	include('../conexi.php');
	$link = Conectarse();
	$id_niveles = $_POST['nivel'];
?>
	<label for="id_costos">Concepto:</label>
	<select class="form-control" id="id_costos" for="id_costos">
			<option value="">Elije un concepto</option>
		<?php 
			$listarConcepto = "SELECT DISTINCT concepto_costos FROM costos";
			
			$resultado = mysqli_query($link,$listarConcepto) or die('Error en la DB $listarConcepto '.mysqli_error($link));
			
			while($row = mysqli_fetch_assoc($resultado)){
				$id_costos = $row['id_costos'];
				$concepto_costos = $row['concepto_costos'];
		?>
				<option value="<?php echo $id_niveles ?>"><?php echo $concepto_costos; ?></option>
		<?php
			}
		?>
	</select>