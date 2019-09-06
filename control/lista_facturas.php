<?php 
	include("../conexi.php");
	$link = Conectarse();
	
	$span_cancelado ="<span class='badge badge-danger'>CANCELADO</span>"; 
	$span_activo ="<span class='badge badge-success'>ACTIVO</span>"; 
	$suma_subtotal = 0 ; 
	$suma_iva = 0 ; 
	$suma_total = 0; 
	
	$query ="SELECT * FROM facturas 
	LEFT JOIN emisores USING(id_emisores) 
	LEFT JOIN clientes USING(id_clientes) 
	
	";
	
	
	if(isset($_GET['year_facturas'])){
		
		$query.=" WHERE YEAR(fecha_facturas) = '".$_GET['year_facturas']."' ";
		if($_GET['mes_facturas'] != ""){
			$query.=" AND MONTH(fecha_facturas) = '".$_GET['mes_facturas']."' ";
			
		}
		}elseif(isset($_GET['mes_facturas'])){
		if($_GET['mes_facturas'] != ""){
			$query.=" WHERE  MONTH(fecha_facturas) = '".$_GET['mes_facturas']."' ";
		}
		
	}
	
	$query .= " ORDER BY folio_facturas ";
	$result =mysqli_query($link,$query) or die("Error en: $query  ".mysqli_error($link));
	
	while($row = mysqli_fetch_assoc($result)){
		$id_facturas = $row["id_facturas"];
		$folio_facturas = $row["folio_facturas"];
		$fecha_facturas = date("d/m/Y", strtotime($row["fecha_facturas"]));
		$razon_social_clientes = $row["razon_social_clientes"];
		$rfc_clientes = $row["rfc_clientes"];
		$correo_clientes = $row["correo_clientes"];
		$alias_clientes = $row["alias_clientes"];
		$uuid = $row["uuid"];
		$url_pdf = $row["url_pdf"];
		$url_xml = $row["archivo_xml"];
		$subtotal = $row["subtotal"];
		$uuid = $row["uuid"];
		// $iva = $row["iva"];
		$total = $row["total"];
		$cancelada = $row["cancelada"];
		
		if($cancelada != 1){
			// $suma_subtotal+= $subtotal ; 
			// $suma_iva+= $iva ; 
			$suma_total+= $total; 
			
		}
	?>
	<tr>
		<td class="text-center"><?php echo $folio_facturas; ?></td>
		<td class="text-center"><small><?php echo strtoupper($uuid); ?></small></td>
		<td class="text-center"><?php echo $fecha_facturas;?></td>
		<td class="text-center">
				<?php echo $razon_social_clientes;?> <br>
				<small><?php echo $row["nombre_alumnos"];?></small> 
		</td>
		<td class="text-center">
				<?php echo $rfc_clientes;
					
				?>
				
			</td>
		<td class="text-right">$<?php echo number_format($total); ?></td>
		<td class="text-center"><?php echo $cancelada == '1' ? $span_cancelado : $span_activo; ?></td>
		<?php 
			if($folio_facturas == "A314"){
				
				$url_xml = "timbrados/".strtoupper ($uuid).".xml";
				$url_pdf = "timbrados/".strtoupper ($uuid).".pdf";
				
				
			?>
			
			<?php 
			}
			
		?>
		<td class="text-center hidden-print"> 
			<button class="btn btn-danger btn_cancelar <?php echo $cancelada == '1' ? "hidden" : ''; ?>" type="button" title="Cancelar Factura" data-folio_facturas="<?php echo $folio_facturas; ?>" data-id_facturas="<?php echo $id_facturas; ?>">
				<i class="fa fa-times" ></i>
			</button>
			<button class="btn btn-primary btn_correo" type="button" title="Enviar por Correo" data-correo="<?php echo $correo_clientes; ?>" data-url_xml="<?php echo $url_xml;?>" data-url_pdf="<?php echo $url_pdf;?>"> <i class="fa fa-envelope" ></i>
			</button>
			<a class="btn btn-info" target="_blank" type="button" title="Ver PDF" href="facturacion/<?php echo $url_pdf; ?>">
				<i class="fa fa-file-pdf-o"></i>
			</a> 
			
			<a class="btn btn-default" target="_blank" type="button" title="Ver XML" href="facturacion/<?php echo $url_xml; ?>">
				<i class="fa fa-qrcode"></i>
			</a>
		</td>
		
	</tr>
<?php }?>