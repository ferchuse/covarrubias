<?php
	include "login/login_success.php";
	include ("conexi.php");
	$link = Conectarse();
	$menu_activo = "administracion";
	$folio_pago = $_GET["folio_pago"];
	$reimprimir = isset($_GET["reimprimir"]) ? $_GET["reimprimir"] : 0;
	//$tipo_pago= $_GET["tipo_pago"];
	$q_nota = "SELECT * FROM  pagos
	LEFT JOIN alumnos 
	USING(id_alumnos)
	LEFT JOIN ciclo_escolar
	USING (id_ciclos)
	LEFT JOIN costos
	USING (id_costos)
	LEFT JOIN usuarios
	USING (id_usuarios)
	LEFT JOIN articulos
	ON articulos.id_articulo = pagos.id_costos
	WHERE id_pagos = '$folio_pago' ";
	
	
	$result_nota= mysqli_query($link, $q_nota) or die("Error en: $q_nota  ".mysqli_error($link));		
	
	if(mysqli_num_rows($result_nota) == 0){
		
		die("Folio no encontrado");
	}	
	while($row = mysqli_fetch_assoc($result_nota)){
		
		extract($row);
		
	}
	
?>

<!DOCTYPE html>
<html lang="es">
	<head> 
		<title>Imprimir Pago</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<?php include("styles.php");?>
		<link href="css/imprimir_pago.css" rel="stylesheet" media="all">
	</head>
	<body>
		
		<div class="container-fluid hidden-print ">
			<?php include("menu.php");?>
		</div>
		<div class="container-fluid text-center ">
			<div class="row hidden-print">
				<div class="col-xs-6 col-sm-offset-3 text-center">
					<button class="btn btn-info" onclick="window.print();">
						<i class="fa fa-print" ></i> Copia Cliente
					</button>
					<button class="btn btn-primary" onclick="window.print();">
						<i class="fa fa-print" ></i> Copia Colegio
					</button>
					<?php
						if($facturado == '0'){ ?>
						<a class="btn btn-default" href="facturas_nueva.php?id_pagos=<?php echo $id_pagos;?>">
							<i class="fa fa-dollar" ></i> Facturar
						</a>
						
						<?php 
							}else{
							echo "<div class><div class='alert alert-warning'>Facturado</div> ";
						}
					?>
					<?php
						if($estatus_pagos == 'CANCELADO'){ ?>
						<div class='alert alert-danger'>CANCELADO</div> 
						<?php 
						}else{?>
						<button class="btn btn-danger " id="cancelar_pago" data-id_pagos="<?php echo $id_pagos?>">
							<i class="fa fa-times" ></i> Cancelar
						</button>
						<?php
						}
					?>
					
					
				</div>
			</div>
		</div>
		<div class="container-fluid text-center hoja " style="padding-left: 3mm !important; max-width: 5cm !important;">
			<br>
			<div class="row header">
				<div class="col-xs-12 text-center">
					<?php 
						if($nombre_usuarios == "Preescolar"){
							echo '<img src="img/logo_cricri.jpg" class="img-responsive">';
						}
						else {
							echo '<img src="img/logo-horizontal.jpg" class="img-responsive">';
						}
					?>
					
				</div>
			</div>
			
			<div class="row cuerpo">
				
				<div class="col-xs-12">
					<?php 
						if($nombre_usuarios == "Preescolar"){
							echo 'R.F.C. VACL600123UX1<br>
					Clave SEP: 13PJN0046K<br>
					CARRILLO PUERTO #602 B PACHUCA, HGO.<br>
					TEL. 713-67-75 Preescolar </br>';
						}
						else {
							echo 'R.F.C. VACL600123UX1<br>
					Clave SEP: 13PPR0345Z<br>
					CARRILLO PUERTO #606 PACHUCA, HGO.<br>
					TEL. 1073571 Primaria';
						}
						?>
					
				</div>
				<center>colegiocovarrubias@gmail.com</center>
				<hr>
				<div class="folio">
					<?php 
						if($folio_pagos == ""){
							echo "Folio interno"." ".$id_pagos;
							}else{
							echo "Consecutivo"." ".$id_pagos."<br>("."Folio interno"." ".$folio_pagos.")";
						}
					?>
					<br><br>
				</div>
				<div class="fecha">
					<strong>Fecha: </strong><?php echo date("d/m/Y", strtotime($fecha_pagos)); ?><br>
					<strong>Usuario: </strong><?php echo $nombre_usuarios; ?>
				</div>
				<br>
				
				<br>
				<div class="col-xs-12 contenido">
					<div class="text-left">
						<strong>Nombre del alumno(a): </strong><br>
						<i><?php echo $nombre_alumnos.' '.$apellidop_alumnos.' '.$apellidom_alumnos;?></i>
						<br>
						
						<u><i>
							<strong> Conceptos : </strong>	
							
							<?php 
								// echo "esartidsadasdculo:" . var_dump($es_articulo);
								if($es_articulo == '1'){
									echo $nombre_articulo.'-'.$descripcion_articulo;
									}else{
									$cons_detalle = "SELECT * FROM pagos_detalle WHERE id_pagos = '$id_pagos'";
									
									$result_detalle= mysqli_query($link, $cons_detalle) ;		
									
									
									while($fila_detalle = mysqli_fetch_assoc($result_detalle)){?>
									<div class="row">
										<div class="col-xs-7">
											<?php echo $fila_detalle["descripcion_pagos"]?>
										</div>
										<div class="col-xs-4 text-right">
											$<?php echo number_format($fila_detalle["importe"]);?>
										</div>
									</div>
									<?php	
									}
								}
							?></i></u>
							<hr>
							<div class="row">
								<div class="col-xs-7">
									<b>Subtotal: </b>
								</div>
								<div class="col-xs-4 text-right">
									$<?php echo number_format($subtotal);?>
								</div>
							</div>
							
							<?php if($descuento_pagos > 0){
							?>
							<div class="row">
								<div class="col-xs-7">
									<b>Descuento: </b>
								</div>
								<div class="col-xs-4 text-right">
									$<?php echo number_format($descuento_pagos);?>
								</div>
							</div>
							<?php } ?>
							<div class="row">
								<div class="col-xs-7">
									<b>Total: </b>
								</div>
								<div class="col-xs-4 text-right">
									$<?php echo number_format($total_pagos);?>
									<span id="total_pagos" class="hidden"><?php echo $total_pagos;?></span>
								</div>
							</div>
							
							<br>
							<i><u>(<span id="total_texto"></span>/100 M.N.).</u></i>
							<br>
							
					</div>
				</div>		
			</div>
			<div class="text-center footer">
				
				
				<br>
			</div>
		</div>
		
		
		
		
		<?php include("scripts.php");?>
		<script src="js/numerosLetras.js"></script>
		<script>
			
			$('#cancelar_pago').click(function cancelar(event) {
				event.preventDefault();
				var boton = $(this);
				boton.prop('disabled', true);
				icono = boton.find(".fa");
				
				var id_pagos = boton.data('id_pagos');
				
				function cancelar(evet,motivo) {
					$.ajax({
						url: 'control/cancelar_pago.php',
						method: 'POST',
						data:{
							motivo: motivo,
							id_pagos: id_pagos,
							id_usuarios: $("#id_usuarios").val()
						}
						}).done(function(respuesta){
						alertify.success("Se ha cancelado el pago"); 
						window.location.reload();//cargar la paguina;
						
					});
				}
				
				
				alertify.prompt('Confirmacion', '¿Deseas cancelarlo?','Escribe el motivo', cancelar, function () {
					
					boton.prop('disabled', false);
				});
				
			});
		</script>
	</body>
</html>
