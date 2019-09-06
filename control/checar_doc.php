<?php  
include('../conexi.php');
$link = Conectarse();
$id_nivel = $_POST['dato'];

$consulta = "SELECT * FROM grados WHERE id_niveles='$id_nivel'";

$resultado = mysqli_query($link,$consulta) or die('Error en la DB '.mysqli_error($link));

while($row = mysqli_fetch_assoc($resultado)){

	$nombre_grados = $row['nombre_grados'];
?>

									
<?php
}
?>