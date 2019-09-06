<?php
	header("Content-Type: application/json");
	// Se desactivan los mensajes de debug
	error_reporting(~(E_WARNING|E_NOTICE));
	//error_reporting(E_ALL);
	
	include_once("../conexi.php");
	$link = Conectarse();
	
	$respuesta = array();
	$datos = array();
	
	$serie = $_POST["serie"];
	$folio = $_POST["folio"];
	$folio_facturas = $serie.$folio ;
	
	$id_clientes = $_POST["id_clientes"];
	$rfc_clientes =  $_POST["rfc_clientes"];
	$razon_social_clientes =  $_POST["razon_social_clientes"];
	
	$id_emisores = "1";
	$rfc_emisores = "VACL600123UX1";
	$razon_social_emisores= "LORENA BELEN VARGAS COVARRUBIAS";
	$regimen_emisores= "621"; 
	
	$consulta_emisores = "SELECT * FROM emisores WHERE id_emisores = $id_emisores";
	
	$result_emisores = mysqli_query($link, $consulta_emisores);
	
	$lugar_expedicion = "42040";
	$metodo_pago = "PUE";
	$forma_pago = $_POST["forma_pago"];
	$uso_cfdi= "D10";
	$tipo_comprobante = "I";
	
	
	$subtotal =  $_POST["subtotal"];
	$descuento_total =  $_POST["descuento_total"];
	$total = $_POST["total_pagos"];
	$conceptos = array(); 
	
	$datos['complemento'] = 'iedu10';
	
	
	if(isset($_POST["descripcion"])){ 
		$conceptos = array();
		foreach($_POST["descripcion"] as $indice => $descripcion){ 
			
			// $datos['conceptos'][$indice]['ID'] = $_POST["id_colegiaturas"][$indice]; 
			$datos['conceptos'][$indice]['ClaveProdServ'] =  $_POST["clave_productos"][$indice] ;
			$datos['conceptos'][$indice]['ClaveUnidad'] = $_POST["clave_unidad"][$indice];
			$datos['conceptos'][$indice]['cantidad'] = '1';
			// $datos['conceptos'][$indice]['unidad'] = 'Actividad';
			
			$datos['conceptos'][$indice]['unidad'] = $_POST["nombre_unidades"][$indice]; 
			$datos['conceptos'][$indice]['descripcion'] = $_POST["descripcion"][$indice].', ALUMNO: '.$_POST["nombre_alumnos"]. ", CURP: ".$_POST["curp"].', NIVEL: '. $_POST["nivel"];
			$datos['conceptos'][$indice]['valorunitario'] = $_POST["importe"][$indice];
			$datos['conceptos'][$indice]['importe'] = $_POST["importe"][$indice];
			if($descuento_total > 0 ){
				
				$datos['conceptos'][$indice]['Descuento'] = $_POST["descuento"][$indice];
				
			}
			
			if($_POST["recargo_pagos"] > 0){
				
				$recargos['ClaveProdServ'] = '01010101';
				$recargos['ClaveUnidad'] = 'ACT';
				$recargos['cantidad'] = 1.00;
				$recargos['unidad'] = 'NA';
				$recargos['descripcion'] = "Recargos";
				$recargos['valorunitario'] = $_POST["recargo_pagos"];
				$recargos['importe'] = $_POST["recargo_pagos"];
				
				array_push($datos['conceptos'], $recargos);
			}
			$respuesta["conceptos"] = $datos['conceptos'];
		}
	}
	else{
		
		die("No hay Conceptos");
	}
	
	// Se especifica la zona horaria
	date_default_timezone_set('America/Mexico_City');
	
	// Se incluye el SDK
	require_once 'sdk2.php';
	
	// Se especifica la version de CFDi 3.3
	$datos['version_cfdi'] = '3.3';
	
	// Ruta del XML Timbrado
	$datos['cfdi']='timbrados/'.$folio_facturas.'.xml';
	
	// Ruta del XML de Debug
	$datos['xml_debug']='timbrados/sin_timbrar'.$folio_facturas.'.xml';
	
	
	
	$datos['PAC']['usuario'] = 'VACL600123UX1'; 
	$datos['PAC']['pass'] = 'covarrubias';
	
	$datos['PAC']['produccion'] = isset($_POST["modo_pruebas"])? "NO" : "SI";
	
	// Rutas y clave de los CSD
	$datos['conf']['cer'] = 'certificados/VACL600123UX1.cer.pem';
	$datos['conf']['key'] = 'certificados/VACL600123UX1.key.pem';
	$datos['conf']['pass'] = 'COVA23LOR';
	
	// Datos de la Factura
	$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 120);
	// $datos['factura']['serie'] = $serie;
	$datos['factura']['folio'] = $folio_facturas;
	
	$datos['factura']['forma_pago'] = $forma_pago;
	$datos['factura']['LugarExpedicion'] = $lugar_expedicion; 
	$datos['factura']['tipocomprobante'] = $tipo_comprobante;
	$datos['factura']['metodo_pago'] = $metodo_pago;
	$datos['factura']['moneda'] = 'MXN';
	
	
	
	// Datos del Emisor
	$datos['emisor']['rfc'] = $rfc_emisores; //RFC DE PRUEBA
	$datos['emisor']['nombre'] = $razon_social_emisores;  // EMPRESA DE PRUEBA
	$datos['factura']['RegimenFiscal'] = $regimen_emisores;
	
	// Datos del Receptor
	$datos['receptor']['rfc'] = $rfc_clientes;
	$datos['receptor']['nombre'] = $razon_social_clientes;
	$datos['receptor']['UsoCFDI'] = $uso_cfdi; //D10 Pagos por servicios educativos (colegiaturas)
	
	$datos['factura']['subtotal'] = $subtotal;
	if($descuento_total > 0 ){
		
		// $datos['conceptos'][$indice]['Descuento'] = $_POST["descuento"][$indice];
		$datos['factura']['descuento'] = $descuento_total; 
		
	}
	$datos['factura']['total'] = $total;
	
	
	$datos['iedu10']['nombreAlumno']=$_POST["nombre_alumnos"]; 
	$datos['iedu10']['CURP']=$_POST["curp"];
	if (strpos($_POST["nivel"], 'PREESCOLAR') !== false) {
		$datos['iedu10']['nivelEducativo']= "Preescolar";
	}
	else{
		
		$datos['iedu10']['nivelEducativo']= "Primaria";
		
	}
	
	$datos['iedu10']['autRVOE'] = $datos['iedu10']['nivelEducativo'] == "Preescolar" ? "13PJN0046K" : "13PPR0345Z";
	// $datos['iedu10']['rfcPago']='SOHM7509289MA';
	
	
	// $datos['iedu10']['nombreAlumno']='FULANITO PEREZ OCHOA';
	// $datos['iedu10']['CURP']='MAGC870912HGTRRS06';
	// $datos['iedu10']['nivelEducativo']='Preescolar';
	// $datos['iedu10']['autRVOE']='1234-ABC';
	// $datos['iedu10']['rfcPago']='SOHM7509289MA';
	
	$respuesta["datos"] = $datos;
	
	
	// Se ejecuta el SDK
	$respuesta["timbrado"] = mf_genera_cfdi($datos);
	
	if($respuesta["timbrado"]["codigo_mf_numero"] == 0){
		
		// TODO guardar en BD 
		
		$insert_facturas = "INSERT INTO facturas SET ";
		$insert_facturas.="folio_facturas = '". $folio_facturas . "',";
		$insert_facturas.="id_emisores = '". $id_emisores . "',";
		$insert_facturas.="fecha_facturas = CURDATE(),";
		$insert_facturas.="id_clientes = '". $id_clientes . "',";
		$insert_facturas.="metodo_pago = '". $metodo_pago . "',";
		$insert_facturas.="forma_pago = '". $forma_pago . "',";
		$insert_facturas.="lugar_expedicion = '". $lugar_expedicion . "',";
		$insert_facturas.="subtotal = '". $subtotal . "',";
		$insert_facturas.="descuento = '". $descuento_total . "',";
		$insert_facturas.="total = '". $total . "',";
		$insert_facturas.="tipo_comprobante = '". $tipo_comprobante . "',";
		$insert_facturas.="timbrada = '1',";
		$insert_facturas.="uso_cfdi = '". $uso_cfdi . "',";
		$insert_facturas.="archivo_xml = '". $respuesta["timbrado"]["archivo_xml"] . "',";
		$insert_facturas.="archivo_png = '". $respuesta["timbrado"]["archivo_png"] . "',";
		$insert_facturas.="uuid = '". $respuesta["timbrado"]["uuid"] . "',";
		$insert_facturas.="representacion_impresa_cadena = '". $respuesta["timbrado"]["representacion_impresa_cadena"] . "',";
		$insert_facturas.="representacion_impresa_certificado_no = '". $respuesta["timbrado"]["representacion_impresa_certificado_no"] . "',";	
		$insert_facturas.="representacion_impresa_fecha_timbrado = '". $respuesta["timbrado"]["representacion_impresa_fecha_timbrado"] . "',";$insert_facturas.="representacion_impresa_sello = '". $respuesta["timbrado"]["representacion_impresa_sello"] . "',";
		$insert_facturas.="representacion_impresa_selloSAT = '". $respuesta["timbrado"]["representacion_impresa_selloSAT"] . "',";
		$insert_facturas.="representacion_impresa_certificadoSAT = '". $respuesta["timbrado"]["representacion_impresa_certificadoSAT"] . "',";$insert_facturas.="url_pdf = '". 'timbrados/'.$folio_facturas.'.pdf' . "'";
		
		$result = mysqli_query($link, $insert_facturas);
		
		if($result){
			$respuesta["insert_facturas_estatus"]  = "sucess";
			$respuesta["insert_facturas_mensaje"]  = "Agregado a DB";
			$id_facturas =  mysqli_insert_id($link);
			$respuesta["id_facturas"]  = $id_facturas;
			
			foreach($datos['conceptos'] as $index=>$concepto){
				
				$datos['conceptos'][1]['ClaveProdServ'] = '01010101';
				$clave_productos= $concepto['ClaveProdServ'];
				$clave_unidad = $concepto['ClaveUnidad'];
				$cantidad = $concepto['cantidad'];
				$unidad = $concepto['unidad'];
				$descripcion	 = $concepto['descripcion'];
				$precio	 = $concepto['valorunitario'];
				$importe	 = $concepto['importe'];
				
				$insert_detalle	= "INSERT INTO facturas_detalle SET 
				id_facturas = '$id_facturas', 
				clave_productos = '$clave_productos', 
				clave_unidad = '$clave_unidad', 
				cantidad = '$cantidad', 
				unidad = '$unidad', 
				descripcion = '$descripcion', 
				precio = '$precio', 
				importe = '$importe'";
				
				if(mysqli_query($link, $insert_detalle)){
					$respuesta["insert_detalle"][]["estatus"]  = "success";
				}
				else{
					$respuesta["insert_detalle"][]["estatus"]  = "error";
					$respuesta["insert_detalle"][]["mensaje"]  = mysqli_error($link);
					$respuesta["insert_detalle"][]["query"]  = $insert_detalle;
					
				}
			}
		}
		else{
			$respuesta["insert_facturas_estatus"]  = "error";
			$respuesta["insert_facturas_mensaje"]  = mysqli_error($link);
			
		}
		
		$respuesta["insert_facturas"]  = $insert_facturas;
		
		
		//Actualiza id_pagos como facturado 
		if(isset($_POST["id_pagos"])){
			$update_pagos = "UPDATE pagos SET facturado = 1 WHERE id_pagos IN(".implode(",",$_POST["id_pagos"]).")";
			
			$respuesta["update_pagos"]  = $update_pagos;
			
			$result = mysqli_query($link, $update_pagos);
			if($result){
				$respuesta["update_pagos_estatus"]  = "success";
				$respuesta["update_pagos_mensaje"]  = "Pagos facturados";
				
			}
			else{
				$respuesta["update_pagos_estatus"]  = "error";
				$respuesta["update_pagos_mensaje"]  = mysqli_error($link);
				
			}
		}
		
		
		//Actualiza Folios 
		$folio_facturas++;
		$update_folios = "UPDATE emisores
		LEFT JOIN (
		SELECT
		id_emisores,
		folios_restantes_emisores - 1 AS folios_restantes
		FROM
		emisores
		WHERE
		id_emisores = '1'
		) AS tabla_folios_nuevos USING (id_emisores)
		SET serie_actual_emisores = '$folio_facturas',
		folios_restantes_emisores = folios_restantes
		WHERE
		id_emisores = '$id_emisores'";
		
		
		$result = mysqli_query($link, $update_folios); 
		
		if($result){
			$respuesta["update_folios_estatus"]  = "sucess";
			$respuesta["update_folios_mensaje"]  = "Folios Actualizados";
			
		}
		else{
			$respuesta["update_folios_estatus"]  = "error";
			$respuesta["update_folios_mensaje"]  = mysqli_error($link);
			
		}
		$respuesta["update_folios"]  = $update_folios;
		$respuesta["folio_facturas"]  = $folio_facturas;
		
	}
	else{
		
		$respuesta["datos_enviados"]  = $datos;
	}
	
	
	
	echo json_encode($respuesta);
	
	
	
		