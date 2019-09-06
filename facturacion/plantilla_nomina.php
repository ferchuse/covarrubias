<?php
	include("../conexi.php");
	$link = Conectarse();
	
	// $nomina= [];
	$percepciones= [];
	$deducciones= [];
	$otros_pagos= [];
	
	$consulta_nomina= "SELECT * FROM nominas
	LEFT JOIN empleados USING(id_empleados)
	WHERE id_nominas = '{$_POST["id_nominas"]}' ";
	
	$result = mysqli_query($link, $consulta_nomina);
	if($result){
		while($fila = mysqli_fetch_assoc($result)){	
			$nomina = $fila;
		}
	}
	else{
		die("Error al buscar nomina").mysqli_error($link);
	}
	
	$consulta_percepciones= "SELECT * FROM nominas_percepciones
	WHERE id_nominas = '{$nomina["id_nominas"]}'";
	
	$result = mysqli_query($link, $consulta_percepciones);
	if($result){
		while($fila = mysqli_fetch_assoc($result)){	
			$percepciones[] = $fila;
		}
	}
	else{
		die("Error al buscar percepciones").mysqli_error($link);
	}
	
	$consulta_deducciones= "SELECT * FROM nominas_deducciones
	WHERE id_nominas = '{$nomina["id_nominas"]}'";
	
	$result = mysqli_query($link, $consulta_deducciones);
	if($result){
		while($fila = mysqli_fetch_assoc($result)){	
			$deducciones[] = $fila;
		}
	}
	else{
		die("Error al buscar percepciones").mysqli_error($link);
	}
	
	$consulta_otros_pagos= "SELECT * FROM nominas_otros_pagos
	WHERE id_nominas = '{$nomina["id_nominas"]}'";
	
	$result = mysqli_query($link, $consulta_otros_pagos);
	if($result){
		while($fila = mysqli_fetch_assoc($result)){	
			$otros_pagos[] = $fila;
		}
	}
	else{
		die("Error al buscar otros_pagos").mysqli_error($link);
	}
	
	
	$cat_tipo_comprobante =  array("I"=>"Ingreso");
	$cat_metodo_pago =  array("PUE"=>"Pago en una sola exhibición");
	$cat_forma_pago = array("01"=> "Efectivo", 
	"02"=>	"Cheque nominativo",
	"03"=>	"Transferencia electrónica de fondos",
	"99"=>	"Por definir");
?>

<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Factura</title>
    <link rel="stylesheet" href="http://phptopdf.com/bootstrap.css">
    <style>
			body { 
			font-family: DejaVu Sans, sans-serif; 
			font-size: 11px;
			}
			@page { margin: 10px; }
			.header_datos{
			padding-top: 10px;
			}
			footer{
			position:absolute;
			bottom: 1cm;
			overflow-wrap: break-word !important;
			word-wrap: break-word !important;
			}
			.conceptos{
			padding: 5px 5px 5px 5px !important;
			}
			
			.small{
			font-size: 6px;
			overflow-wrap: break-word !important;
			word-wrap: break-word !important;
			max-width: 18cm;
			}
			@media print{
			body{
			font-size: 11px;
			}
			footer{
			position:absolute;
			bottom: 1cm;
			}
			}
		</style>
	</head>
  
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-1">
          <h1>
            <img src="logo_factura.jpg" class="img-responsive">
					</h1>
				</div> 
				<div class="header_datos">
					<div class="col-xs-4">
						<h6>Emisor: </h6> <a href="#">LORENA BELEN VARGAS COVARRUBIAS</a> <br>
						<p>
							RFC: VACL600123UX1  <br>
							Régimen: VACL600123UX1<br>
							CURP: VACL600123MHGRVR02<br>
							Registro Patronal: B7022732103
						</p>
					</div>
					<div class="col-xs-4 ">
						<h4>RECIBO DE NOMINA</h4>
						Folio: <span class="text-danger"><?php echo $nomina["folio_nomina"];?></span><br>
						Folio Fiscal: <?php echo $nomina["folio_fiscal"] ;?> <br>
						Fecha Certificación: <?php echo $nomina["fecha_timbrado"];?> <br>
						
					</div>
				</div>
			</div>
      <div class="row">
        <div class="col-xs-5  ">
          <div class="panel panel-default">
            <div class="panel-heading">
							Empleado:
						</div>
            <div class="panel-body">
              <p>
								Nombre:<?php echo $nomina["nombre_empleados"];?> <br>
                RFC: <?php echo $nomina["rfc_empleados"];?> <br>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xs-5 ">
          <div class="panel panel-default">
            <div class="panel-heading">
              Datos de Pago:
						</div>
            <div class="panel-body">
							Fecha de Pago: <?php echo $nomina["fecha_pago"];?><br>
							Forma de Pago: 99-Por Definir<br>
							Periodo de Pago: <?php echo $nomina["fecha_inicial"];?> al <?php echo $nomina["fecha_final"];?><br>
							Dias Pagados: <?php echo $nomina["dias_pagados"];?>
						</div>
					</div>
				</div>
			</div>
      <!-- / Datos factura y receptor -->
			<DIV class="well">
				PERCEPCIONES
				<div class="row text-center">
					<div class="col-xs-6">
						<b>Concepto</b>
					</div>
					<div class="col-xs-2">
						<b>Importe Gravado</b>
					</div>
					<div class="col-xs-2">
						<b>Importe Excento</b>
					</div>
				</div>
				
				<?php 
					foreach($percepciones as $index => $percepcion){?>
					<div class="row">
						<div class="col-xs-6 text-center">
							<?php echo $percepcion["concepto"];?>
						</div>
						<div class="col-xs-2 text-center">
							<?php echo $percepcion["gravado"];?>
						</div>
						<div class="col-xs-2 text-center">
							<?php echo $percepcion["excento"];?>
						</div>
					</div>
					<?php 
					}
				?>
				
				<div class="row">
					<div class="col-xs-6 text-center">
					</div>
					<div class="col-xs-2 text-center">
						<b><?php echo $nomina["total_gravado"];?></b>
					</div>
					<div class="col-xs-2 text-center">
					<b>	<?php echo $nomina["total_excento"];?></b>
					</div>
				</div>
			</div>
			
			<DIV class="well">
				DEDUCCIONES
				<div class="row text-center">
					<div class="col-xs-6">
						<b>Concepto</b>
					</div>
					<div class="col-xs-2">
						<b>Importe </b>
					</div>
				</div>
				<?php 
					foreach($deducciones as $index => $deduccion){?>
					<div class="row">
						<div class="col-xs-6 text-center">
							<?php echo $deduccion["concepto"];?>
						</div>
						<div class="col-xs-2 text-center">
							<?php echo $deduccion["importe"];?>
						</div>
						<div class="col-xs-2">
							
						</div>
					</div>
					<?php 
					}
				?>
				<div class="row">
					<div class="col-xs-6 text-center">
					</div>
					<div class="col-xs-2 text-center">
						<?php echo $nomina["total_deducciones"];?>
					</div>
				</div>
			</div>
			
			<?php if(count($otros_pagos) > 0){ ?>
				<DIV class="well">
					OTROS PAGOS
					<div class="row text-center">
						<div class="col-xs-6">
							Concepto
						</div>
						<div class="col-xs-2">
							Importe 
						</div>
					</div>
					<?php 
						foreach($otros_pagos as $index => $otro_pago){?>
						<div class="row">
							<div class="col-xs-6 text-center">
								<?php echo $otro_pago["concepto"];?>
							</div>
							<div class="col-xs-2 text-center">
								<?php echo $otro_pago["importe"];?>
							</div>
							<div class="col-xs-2">
									<?php
										if($otro_pago["tipo"] == '002'){
											echo "Subsidio Causado: <br>";
											echo $otro_pago["subsidio_causado"];
										}
										?>
							</div>
						</div>
						<?php 
						}
					?>
					<div class="row">
						<div class="col-xs-6 text-center">
						</div>
						<div class="col-xs-2 text-center">
							<?php echo $nomina["total_otros_pagos"];?>
						</div>
					</div>
				</div>
				<?php
				}
			?>
			<div class="row ">
        <div class="col-xs-3 col-xs-offset-5 text-right">
          <p>
            <strong>
							Subtotal : <br>
							Descuento :  <br>
							Total : <br>
						</strong>
					</p>
				</div>
        <div class="col-xs-2 text-right">
          <strong>
						$ <?php echo number_format($nomina["subtotal"],2);?> <br>
						$ <?php echo number_format($nomina["descuento"],2);?> <br>
						$ <?php echo number_format($nomina["total"],2);?> <br>
						<br>
					</strong>
				</div>
			</div>
			<?php if($nomina["timbrada"] == "000"){ 	?>
				
				<h3 class="text-center">
					FACTURA DE PRUEBA NO VÁLIDA PARA EFECTOS FISCALES
				</h3>
				<?php 	
				}
				else{
				?>
				<footer>
					<div class="row">
						<div class="col-xs-8">
							Sello Digital CFDI: <div class="small" ><?php echo $nomina["sello_emisor"];?></div>
							Sello SAT : <div class="small" > <?php echo $nomina["sello_sat"];?></div>
							Cadena original del complemento de certificación digital del SAT:
							<div class="small" > 
								<?php echo $nomina["cadena_original"];?> 
							</div>
						</div>
						<div class="col-xs-2">
							<img class="img-responsive" alt="QR" src="nominas/nomina_<?php echo $nomina["folio_nomina"];?>.png">
						</div>
						
					</div>
					<div class="text-center">Este documento es una representación impresa de un CFDI</div>
					<pre hidden>
						<?php //echo var_dump($nomina);?>
					</pre>
				</footer>
				<?php 
					
				}
			?>
			
		</div>
	</body>
</html>