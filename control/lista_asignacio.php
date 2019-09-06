<?php
	//include("login/login_success.php");
	include("../conexi.php");
	$link = Conectarse();
	$consulta = "SELECT *, alumnos.id_alumnos AS id_bueno FROM alumnos 
	INNER JOIN grados ON alumnos.id_grados = grados.id_grados 
	LEFT JOIN niveles ON grados.id_niveles = niveles.id_niveles
	LEFT OUTER JOIN inscripciones ON alumnos.id_alumnos = inscripciones.id_alumnos
	WHERE ISNULL(id_inscripciones)
";

		if(isset($_GET['id_niveles'])){
		
		if(isset($_GET['id_grados'])){
			$id_grados = $_GET['id_grados'];
			$id_niveles = $_GET['id_niveles'];
			$consulta.= " AND grados.id_niveles = '$id_niveles' AND grados.nombre_grados='$id_grados'";
		}elseif(isset($_GET['id_grados'])){
			$id_grados = $_GET['id_grados'];
			$id_niveles = $_GET['id_niveles'];
			$consulta.= " AND grados.id_niveles = '$id_niveles' AND grados.nombre_grados='$id_grados'";
		}elseif(isset($_GET['id_grupos'])){
			$id_niveles = $_GET['id_niveles'];
			$id_grupos = $_GET['id_grupos'];
			$consulta.= " AND grados.id_niveles = '$id_niveles' AND grupos.id_grupos='$id_grupos'";
		}else{
		$id_niveles = $_GET['id_niveles'];
		$consulta.= " AND niveles.id_niveles = '$id_niveles'";
		}
		
	}elseif(isset($_GET['id_grados'])){
		$id_grados = $_GET['id_grados'];
		
	}

	$result = mysqli_query($link,$consulta) or die("Error en: $consulta ".mysqli_error($link));
	while($row = mysqli_fetch_assoc($result))
	{
		$id_alumnos = $row["id_bueno"];
		$nombre_alumnos = $row["nombre_alumnos"];
		$apellidop_alumnos = $row["apellidop_alumnos"];
		$apellidom_alumnos = $row["apellidom_alumnos"];
		$nombre_grados = $row["nombre_grados"];
		$sexo_alumnos = $row["sexo_alumnos"];
		$nombre_niveles = $row["nombre_niveles"];
	?>
	<tr>
		<td class="text-center"><?php echo $apellidop_alumnos."\n".$apellidom_alumnos."\n".$nombre_alumnos;?></td>
		<td class="text-center"><?php echo $sexo_alumnos;?></td>
		<td class="text-center"><?php echo $nombre_grados."°";?></td>
		<td class="text-center"><?php echo $nombre_niveles;?></td>
		<td class="text-center">
			<input type="checkbox" class="seleccion" name="inscrito[]" value="<?php echo $id_alumnos;?>">
		</td>
		
	</tr>
	<?php 
	}
	?>
				
	