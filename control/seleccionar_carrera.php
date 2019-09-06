
<div class="row">
<div class="col-md-4">
<label for="id_carreras">Carreas</label>
<select class="form-control" id="id_carreras" name="id_carreras">
<?php
	include('../conexi.php');
	$link = Conectarse();
	
	$id_nivel = $_POST['id_nivel'];
	
	$seleccionar_niveles = "SELECT * FROM carreras WHERE id_niveles='$id_nivel'";
	
	$resultado = mysqli_query($link,$seleccionar_niveles) or die('Error en DB '.mysqli_error($link));
	
	while($row = mysqli_fetch_assoc($resultado)){
		$id_carreras = $row['id_carreras'];
		$nombre_carreras = $row['nombre_carreras'];
?>
<option value="<?php echo $id_carreras; ?>"><?php  echo $nombre_carreras; ?></option>
	<?php  } ?>
</select>
</div>
<div class="col-md-3"> 
<label for="padres_alumnos">¿Alguien paga tus estudios?</label><br>
<input type="radio" class="padres_alumnos" name="discapacidad_alumnos" value="SI"> Si 
<input  type="radio" class="padres_alumnos" name="discapacidad_alumnos" value="NO"> No
</div>
</div>