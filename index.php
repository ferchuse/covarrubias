<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "principal";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PRINCIPAL</title>
 
	<?php include("styles.php");?>
	
  </head>
  <body>
   <div class="container-fluid">
		<?php include("menu.php");?>
	</div>
	<h2 class="text-center">Resumen del dia <?php echo date("d/m/Y");?></h2>
	<hr>
<form id="lista_egresos">
   <div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading hidden-print">
						<h4 class="text-center"> 
							Ingresos
							<span class="pull-right">	
									<button class="btn btn-info" id="btn_ingresos" type="button" title="imprimir">
											<i class="fa fa-print" ></i> Imprimir
									</button>	
							</span>
						</h4>
					</div>
					<div class="panel-body" id="panel_ingresos">
						<div class="table-responsive">
							<h4>
								<table class="table table-hover">
									<tr>
										<th class="text-center"> Hora</th>
										<th class="text-center"> Alumno(a)</th>
										<th class="text-center"> Concepto</th>
										<th class="text-center"> Cantidad</th>
										<th class="text-center hidden-print"> Acciones</th>
									</tr>
									<?php
										$consulta = "SELECT * FROM pagos 
										LEFT JOIN alumnos ON pagos.id_alumnos = alumnos.id_alumnos
										LEFT JOIN costos ON pagos.id_costos = costos.id_costos
										WHERE fecha_pagos = CURDATE()" ;
										$resultado=mysqli_query($link,$consulta) or die ("ERROR EN: $consulta ".mysqli_error($link));
										$total = array();
										while($row = mysqli_fetch_assoc($resultado)){
											$id_pagos = $row["id_pagos"];
											$hora_pagos = $row["hora_pagos"];
											$estatus_pagos = $row["estatus_pagos"];
											$nombre_alumnos = $row["nombre_alumnos"];
											$apellidop_alumnos = $row["apellidop_alumnos"];
											$apellidom_alumnos = $row["apellidom_alumnos"];
											$concepto_costos = $row["concepto_costos"];
											$total_pagos = $row["total_pagos"];
											$es_articulo = $row["es_articulo"];
											$descripcion_pagos = $row["descripcion_pagos"];
											
											$descipciones = array();
											
											if($row["es_articulo"] == "1"){
												
												$descipciones[] = $row['descripcion_pagos'];
											}else{
												
												$consultaDetalle = "SELECT * FROM pagos_detalle WHERE id_pagos='$id_pagos'";
												$resultDetalle = mysqli_query($link, $consultaDetalle);
												while($rowDetalle = mysqli_fetch_assoc($resultDetalle)){
												
													$descipciones[] = $rowDetalle['descripcion_pagos'];
													
												}
											}
										
											if($estatus_pagos == 'CANCELADO'){
											
									?>
										<tr class="cancelado">
											<td class="text-center cancelado">
												<s>
												<?php echo $hora_pagos; ?>
												</s>
											</td>
											<td class="text-center cancelado">
												<s>
												<?php echo $apellidop_alumnos." ".$apellidom_alumnos." ".$nombre_alumnos;?>
												</s>
											</td>
											<td class="text-center">
												<s>
												<?php echo implode(",",$descipciones);?>
												</s>	
											</td>
											<td class="text-center">
												<s>
												<?php echo $total_pagos?>
												</s>
											</td>
										</tr>
										<?php 
										}else{
											
											$total[] = $total_pagos;
											?>
											<tr>
												<td class="text-center">
													<?php echo $hora_pagos; ?>
												</td>
												<td class="text-center">
													<?php echo $apellidop_alumnos." ".$apellidom_alumnos." ".$nombre_alumnos;?>
												</td>
												<td class="text-center">
													<?php echo implode(",",$descipciones);?>
												</td>
												<td class="text-center">
													<?php echo $total_pagos?>
												</td>
												<td class="text-center hidden-print">
													<button class="btn btn-danger btn-cancelar" data-id_pagos="<?php echo $id_pagos;?>" title="Cancelar" type="button">
														<i class="fa fa-times"></i>
													</button>
													<a class="btn btn-info btn-reprimir" title="Reimpresión pago" href="imprimir_pago.php?folio_pago=<?php echo $id_pagos;?>">
														<i class="fa fa-print"></i>
													</a>
												</td>
											</tr>
										<?php
											}
										}
									?>
									<tr>
										<td colspan="3" class="text-right text-right text-danger">
									<b>TOTAL:</b>
										</td>
										<td class="text-center">
										<?php 
											$forma = array_sum($total);
											
											echo "$". number_format(array_sum($total));
										?>
										</td>
									</tr>
									</table> 
							</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading hidden-print">
						<h4 class="text-center">
							Egresos
							<span class="pull-right">	
									<button class="btn btn-info" id="btn_egresos" type="button" title="imprimir">
											<i class="fa fa-print" ></i> Imprimir
									</button>	
							</span>
						</h4>
					</div>
					<div class="panel-body" id="panel_egresos">
						<div class="table-responsive">
							<h4>
							<table class="table table-hover">
								<tr>
									<th class="text-center">Hora</th>
									<th class="text-center">Nombre</th>
									<th class="text-center">Area</th>
									<th class="text-center">Cantidad</th>
									<th class="text-center hidden-print">Acciones</th>
								</tr>
								<?php 
									$consultar = "SELECT * FROM egresos WHERE fecha_egresos = CURDATE() ";
									$resultados = mysqli_query($link,$consultar) or die ("Error en la BD $consultar".mysqli_error($link));
									$totales = array();
									while($row = mysqli_fetch_assoc($resultados)){
										extract($row);
									if($estatus_egresos == 'CANCELADO'){
								?>
									<tr class="text-center">
										<td><s><?php echo $hora_egresos;?></s></td>
										<td><s><?php echo $descripcion_egresos;?></s></td>
										<td><s><?php echo $area_egresos;?></s></td>
										<td><s><?php echo $cantidad_egresos;?></s></td>
									</tr>
									<?php
									}else{ 
									
										$totales[] = $cantidad_egresos;
										?>
											<tr class="text-center">
											<td><?php echo $hora_egresos;?></td>
											<td><?php echo $descripcion_egresos;?></td>
											<td><?php echo $area_egresos;?></td>
											<td><?php echo $cantidad_egresos;?></td>
											<td class="text-center hidden-print">
												<button class="btn btn-danger btn-cancela" data-id_egresos="<?php echo $id_egresos;?>" title="Cancelar" type="button">
													<i class="fa fa-times"></i>
												</button>
											</td>
										</tr>
										<?php		
											}
									}
									?>
									<tr>
										<td colspan="3" class="text-right text-right text-danger">
											<b>TOTAL:</b>
										</td>
										<td class="text-center">
											<?php 
												$forma2 = array_sum($totales);
												echo "$". number_format(array_sum($totales));
											?>
										</td>
									</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<tr>
					<td class="text-danger">
						<h3>
							<b>BALANCE TOTAL:</b>
						</h3>
					</td>
					<td class="text-center">
						<h3>
							<?php 
								$todo = $forma - $forma2;
								echo "$". number_format($todo);
							?>
						</h3>
					</td>
				</tr>
			</div>
		</div>
	</div>
</form> 
<!--<footer>
	<pre>
		<?php echo $consulta;?>
	</pre>
</footer>-->
	<?php  include('scripts.php'); ?>
	<script src="js/index_cancelar.js"></script>
  </body>
</html>