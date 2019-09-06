<?php 
// header("Content-Type: application/json");
// include("../conexi.php"); 
// $link = Conectarse(); 
// $respuesta = array ();
// $cons_niveles="SELECT * FROM niveles WHERE activo_niveles = 1";
// $resultado_niveles=mysqli_query ($link,$cons_niveles);
// while($fila_niveles = mysqli_fetch_assoc($resultado_niveles))
// {
	// $grados_lista = array();
	// $cons_grados="SELECT * FROM grados LEFT JOIN grupos USING(id_grados) WHERE grupos.id_niveles = ".$fila_niveles["id_niveles"];
	// $resultado_grados=mysqli_query ($link,$cons_grados);
	
	// while($fila_grados = mysqli_fetch_assoc($resultado_grados)){
		// $alumnos_lista = array();
	
		// $cons_alumnos = "SELECT * FROM inscripciones  FULL JOIN alumnos USING(id_alumnos) WHERE id_grupos =".$fila_grados["id_grupos"] ." ORDER BY apellidop_alumnos"; 
		// $resultado_alumnos=mysqli_query ($link,$cons_alumnos);
		
		// while($fila_alumnos = mysqli_fetch_assoc($resultado_alumnos)){
			// $alumnos_lista[] = array("text"=>$fila_alumnos["estatus_alumnos"]." ".$fila_alumnos["apellidop_alumnos"]." ". $fila_alumnos["apellidom_alumnos"]." ". $fila_alumnos["nombre_alumnos"]);
		// }
		 
		// $grados_lista[] = array("text"=>$fila_grados["nombre_grados"], "nodes"=>$alumnos_lista );
		
	// }
   
	// $respuesta[] = array("text"=>$fila_niveles["nombre_niveles"],"nodes"=>$grados_lista);
// }
// echo json_encode ($respuesta);

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
include("../conexi.php");

$link = Conectarse();
$respuesta = array ();
$cons_niveles="SELECT * FROM niveles WHERE activo_niveles = 1";
$resultado_niveles=mysqli_query ($link,$cons_niveles);
while($fila_niveles = mysqli_fetch_assoc($resultado_niveles))
{
	$grados_lista = array();
	$cons_grados="SELECT * FROM grados LEFT JOIN grupos USING(id_grados) WHERE grupos.id_niveles = ".$fila_niveles["id_niveles"];
	$resultado_grados=mysqli_query ($link,$cons_grados);
	
	while($fila_grados = mysqli_fetch_assoc($resultado_grados)){
		$alumnos_lista = array();
	
		$cons_alumnos = "SELECT * FROM inscripciones  FULL JOIN alumnos USING(id_alumnos) WHERE id_grupos =".$fila_grados["id_grupos"] ." ORDER BY apellidop_alumnos";
		$resultado_alumnos=mysqli_query ($link,$cons_alumnos);
			
		while($fila_alumnos = mysqli_fetch_assoc($resultado_alumnos)){
			$alumnos_lista[] = array("text"=>$fila_alumnos["apellidop_alumnos"]." ". $fila_alumnos["apellidom_alumnos"]." ". $fila_alumnos["nombre_alumnos"]);
		}
		 
		$grados_lista[] = array("text"=>$fila_grados["nombre_grados"], "nodes"=>$alumnos_lista );
		
	}
   
	$respuesta[] = array("text"=>$fila_niveles["nombre_niveles"],"nodes"=>$grados_lista);
}
echo "<div  class='list-group'>";
foreach($respuesta as $index=>$nivel){
	
	
	echo "<a class='list-group-item'>".$nivel["text"];
	
		echo "<div class='list-group'><a class='list-group-item'>1</a></div>";
	
	
	echo "</a>";
}
echo "</div>";
?>
