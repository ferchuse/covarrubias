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

extract($_POST);
$id_emisores = "1";
$id_clientes = "1";

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

// Credenciales de Timbrado
// $datos['PAC']['usuario'] = 'DEMO700101XXX';
// $datos['PAC']['pass'] = 'DEMO700101XXX';
// $datos['PAC']['produccion'] = 'NO';

$datos['PAC']['usuario'] = 'VACL600123UX1';
$datos['PAC']['pass'] = 'covarrubias';

$datos['PAC']['produccion'] = isset($_POST["modo_pruebas"])? "NO" : "SI";
$timbrado= isset($_POST["modo_pruebas"])? 0 : 1;
 
// Rutas y clave de los CSD
$datos['conf']['cer'] = 'certificados/VACL600123UX1.cer.pem';
$datos['conf']['key'] = 'certificados/VACL600123UX1.key.pem';
$datos['conf']['pass'] = 'COVA23LOR';

// Datos del Emisor
$datos['emisor']['rfc'] = "VACL600123UX1";
$datos['emisor']['nombre'] = "LORENA BELEN VARGAS COVARRUBIAS"; 
$datos['factura']['RegimenFiscal'] = "621";

// Datos del Receptor
$datos['receptor']['rfc'] = "XAXX010101000";
$datos['receptor']['nombre'] = "VENTA AL PUBLICO GENERAL";
$datos['receptor']['UsoCFDI'] = "P01";

// Datos de la Factura
$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 120);
$datos['factura']['serie'] = $_POST["serie"];
$datos['factura']['folio'] = $_POST["folio"];
$datos['factura']['forma_pago'] = $_POST["forma_pago"];;
$datos['factura']['LugarExpedicion'] = "42040"; 
$datos['factura']['tipocomprobante'] = "I";
$datos['factura']['metodo_pago'] = "PUE";
$datos['factura']['moneda'] = 'MXN';


$datos['factura']['subtotal'] = $_POST["importe"];
//$datos['factura']['descuento'] = $_POST["descuento"];
$datos['factura']['total'] = $_POST["importe"];


$datos['conceptos'][$indice]['ClaveProdServ'] = '01010101';
$datos['conceptos'][$indice]['ClaveUnidad'] = 'NA'; 
$datos['conceptos'][$indice]['cantidad'] = '1';
$datos['conceptos'][$indice]['unidad'] = 'NA';
$datos['conceptos'][$indice]['descripcion'] = $_POST["descripcion"];
$datos['conceptos'][$indice]['valorunitario'] = $_POST["importe"];
$datos['conceptos'][$indice]['importe'] = $_POST["importe"];
//$datos['conceptos'][$indice]['Descuento'] = $_POST["descuento"];



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
	$insert_facturas.="subtotal = '". $_POST["importe"] . "',";
	$insert_facturas.="total = '".$_POST["importe"] . "',";
	$insert_facturas.="tipo_comprobante = '". $datos['factura']['tipocomprobante']. "',";
	$insert_facturas.="uso_cfdi = 'D10',";
	$insert_facturas.="timbrada = '$timbrado',";
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
	
	
	//Actualiza los pagos como facturado 
	if(isset($_POST["fecha_inicial"])){
		$update_pagos = "UPDATE pagos SET facturado = 1 WHERE estatus_pagos IS NULL
		AND fecha_pagos BETWEEN '". $_POST["fecha_inicial"] ."' AND '" . $_POST["fecha_final"]."'";
		 
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
	
	if($timbrado == 1){
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
}
else{
	
	$respuesta["datos_enviados"]  = $datos;
}



echo json_encode($respuesta);



