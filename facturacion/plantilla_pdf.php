<?php
include("../conexi.php");
$link = Conectarse();

if(isset($_POST["id_facturas"])){
	
	$id_facturas = $_POST["id_facturas"];
	
	error_reporting(0);
	
}
else{
	$id_facturas = "1";
}


//Buscar Conceptos
$consulta_detalle	= "SELECT * FROM facturas_detalle
WHERE id_facturas = '$id_facturas'";

$result = mysqli_query($link, $consulta_detalle);
if($result){
	while($fila = mysqli_fetch_assoc($result)){	
		$conceptos[] = $fila;
	}
}
else{
	die("Error al generar Conceptos").mysqli_error($link);
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
        <div class="col-xs-2">
          <h1>
            <img src="logo_factura.jpg" class="img-responsive">
          </h1>
        </div> 
				<div class="header_datos">
					<div class="col-xs-4">
						<h6>Emisor: </h6> <a href="#"><?php echo $_POST["razon_social_emisores"];?></a> <br>
						<p>
							RFC: <?php echo $_POST["rfc_emisores"];?>  <br>
							Régimen:  <?php echo $_POST["regimen_emisores"];?><br>
							Certificado: <?php echo $_POST["representacion_impresa_certificado_no"];?><br>
						</p>
					</div>
					<div class="col-xs-4 text-right">
						Folio: <span class="text-danger"><?php echo $_POST["folio_facturas"];?></span><br>
						Fecha: <?php echo date("d/m/Y", strtotime($_POST["fecha_facturas"]));?><br>
						Folio SAT: <?php echo $_POST["uuid"] ;?> <br>
						Fecha Certificación: <?php echo $_POST["representacion_impresa_fecha_timbrado"];?> <br>
						Certificado SAT: <?php echo $_POST["representacion_impresa_certificadoSAT"];?> <br>
						
					</div>
				</div>
      </div>
      <div class="row">
        
        <div class="col-xs-5  ">
          <div class="panel panel-default">
            <div class="panel-heading">
             Receptor:
            </div>
            <div class="panel-body">
              <p>
								Nombre:<?php echo $_POST["razon_social_clientes"];?> <br>
                RFC: <?php echo $_POST["rfc_clientes"];?> <br>
                USO CFDI: <?php echo $_POST["uso_cfdi"];?> <br>
               
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
              
                Tipo de Comprobante: <?php echo $_POST["tipo_comprobante"]."-".$cat_tipo_comprobante[$_POST["tipo_comprobante"]];?> <br>
                Lugar de Expedición: <?php echo $_POST["lugar_expedicion"];?><br>
                Forma de Pago: <?php echo $_POST["forma_pago"]."-".$cat_forma_pago[$_POST["forma_pago"]];?><br>
                Método de Pago:<?php echo $_POST["metodo_pago"]."-".$cat_metodo_pago[$_POST["metodo_pago"]];?><br>
              
            </div>
          </div>
        </div>
      </div>
      <!-- / Datos factura y receptor -->
			
			
							<div class="row text-center">
								<div class="col-xs-1">
									Cantidad
								</div>
								<div class="col-xs-1">
									Unidad 
								</div>
								<div class="col-xs-4">
									Descripción
								</div>
								<div class="col-xs-1">
									<h6>Precio</h6>
								</div>
								<div class="col-xs-1">
									<h6>Importe</h6>
								</div>
							</div>
					
							<?php 
							foreach($conceptos as $index => $concepto){?>
								<div class="row conceptos">
									<div class="col-xs-1 text-center">
											<?php echo $concepto["cantidad"];?>
									</div>
									<div class="col-xs-1 text-center">
											Clave: <?php echo $concepto["clave_unidad"]."<br>".$concepto["unidad"];?>
									</div>
									<div class="col-xs-4">
										<?php echo $concepto["clave_productos"]."<br>".$concepto["descripcion"];?>
									</div>
									<div class="col-xs-1  text-right">$<?php echo number_format($concepto["precio"], 2);?></div>
									<div class="col-xs-1 text-right">$<?php echo number_format($concepto["importe"], 2);?></div>
								</div>
							<?php 
								
							}
							?>
						
					
			<hr>
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
          $ <?php echo number_format($_POST["subtotal"],2);?> <br>
					$ <?php echo number_format($_POST["descuento"],2);?> <br>
					$ <?php echo number_format($_POST["total"],2);?> <br>
					<br>
          </strong>
        </div>
      </div>
				<?php if($_POST["timbrada"] == "000"){ 	?>
					
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
									Sello Digital CFDI: <div class="small" ><?php echo $_POST["representacion_impresa_sello"];?></div>
									Sello SAT : <div class="small" > <?php echo $_POST["representacion_impresa_selloSAT"];?></div>
									Cadena original del complemento de certificación digital del SAT:
									<div class="small" > 
										<?php echo $_POST["representacion_impresa_cadena"];?> 
									</div>
							</div>
							<div class="col-xs-2">
								<img class="img-responsive" alt="QR" src="<?php echo $_POST["archivo_png"];?>">
							</div>
				
						</div>
						<h5 class="text-center">Este documento es una representación impresa de un CFDI</h5>
						<pre hidden>
							<?php //echo var_dump($_POST);?>
						</pre>
					</footer>
				<?php 
					
				}
				?>
			
    </div>
  </body>
</html>