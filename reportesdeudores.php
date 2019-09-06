<?php 
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "reportes";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte de Deudores</title>
	<?php include("styles.php");?>
</head>
<body>
	<div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	<div class="container">
		<div class="row"> 
			<div class="col-md-12">
				<h3 class="text-center">
					Reporte de Deudores
					
					<span class="pull-right">	
						<button class="btn btn-default hidden-print" id="btn_exportar" title="Exportar a excel">
							<i class="fa fa-file-excel-o" ></i> Exportar
						</button>
						<button class="btn btn-info hidden-print"  type="button" title="Imprimir" onclick="window.print()">
								<i class="fa fa-print" ></i> Imprimir
						</button>	
					</span>
				</h3>
				<hr>
				<form id="form_deudores">
					<div class="row">
						<div class="col-md-6">
							<table class="table" id="tabla_reporte">
								
								<thead>
									<tr>
										<th class="text-center">
											NOMBRE
										</th>
										<th class="text-center">
											GRUPO
										</th>
										<th class="text-center">
											DEUDA
										</th>
									</tr>
									<tbody>
										<?php
											$consulta = " SELECT
														CONCAT(apellidop_alumnos, ' ',apellidom_alumnos,' ', nombre_alumnos)
														AS nombre_completo,
														id_alumnos,
														SUM(restante_colegiaturas) AS totaldeuda,
														nombre_grupos,
														nombre_niveles
													FROM
														colegiaturas_por_alumno
													LEFT JOIN alumnos USING(id_alumnos)
													LEFT JOIN grupos USING (id_grados)
													LEFT JOIN niveles ON grupos.id_niveles = niveles.id_niveles
													WHERE
														estatus_colegiaturas = 'VENCIDO'
														AND estatus_alumnos <> 'BAJA'
													GROUP BY
														id_alumnos";
											$resultado = mysqli_query($link,$consulta) or die ("Error en la $consulta".mysqli_error($link));
												$total = array();
												$labels = array();
												$values = array();
												$colores = array();
												
											while($row = mysqli_fetch_assoc($resultado)){
												$nombre_grupos = $row['nombre_grupos'];
												$nombre_niveles = $row['nombre_niveles'];
												$nombre_completo = $row['nombre_completo'];
												$totaldeuda = $row['totaldeuda'];
												$labels[]= "'$nombre_completo'";
												$values[]= $totaldeuda;
												$colores[]= "'#".substr(md5(rand()), 0, 6)."'";
										 ?>
											<tr>
												<td class="text-center">
													<?php echo $nombre_completo;?>
												</td>
												<td class="text-center">
													<?php echo $nombre_grupos." ".$nombre_niveles;?>
												</td>
												<td class="text-right text-center">
													<?php echo "$". number_format($totaldeuda);?>
												</td>
											</tr>
											<?php $total[]=$totaldeuda;?>
										<?php
											}
										?>
										
									</tbody>
								</thead>
							</table>
								<div class="row">
									<div class="col-md-12 text-right">
										<h4>TOTAL DE ADEUDO:
											<?php
												echo "$". number_format(array_sum($total));
											?>
										</h4>
									</div>
								</div>
						</div>
						<div class="col-sm-6 text center">
							<canvas id="grafica">
						
							</canvas>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			
		</div>
	</div>
	
	<?php include("scripts.php");?>
	<script src="lib/chart.min.js"></script>
	<script>
		$(document).ready(function(){
			var myPieChart = new Chart($("#grafica"),{
				type: 'pie',
				data : {
					labels: [
							<?php echo implode(",", $labels)?>
					],
					datasets: [
							{
									data: [<?php echo implode(",", $values)?>],
									backgroundColor: [
											<?php echo implode(",", $colores)?>
									]
							}]
			}
			});	
			
			$("#btn_exportar").click(function(){
		
				$('#tabla_reporte').tableExport(
				{
					type:'excel',
					tableName:'Reporte', 
					ignoreColumn: [],
					escape: true
				});
			});
		});
	</script>
</body>
</html>