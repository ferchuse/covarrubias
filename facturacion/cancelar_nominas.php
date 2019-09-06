<?php
header("Content-Type: application/json");
error_reporting(0);
date_default_timezone_set('America/Mexico_City');

include_once("../conexi.php");
include_once "sdk2.php";

$link = Conectarse();
$respuesta = array();

$datos['cancelar']='SI';
$datos['cfdi']='nominas/nomina_'.$_POST["folio_nominas"].'.xml';
$datos['PAC']['usuario'] = 'VACL600123UX1';
$datos['PAC']['pass'] = 'COVA23LOR';
$datos['PAC']['produccion'] = 'SI'; //   
$datos['conf']['cer'] = 'certificados/VACL600123UX1.cer';
$datos['conf']['key'] = 'certificados/VACL600123UX1.key';
$datos['conf']['pass'] = 'COVA23LOR';

$respuesta["datos"]= $datos;

$respuesta["respuesta_pac"]= cfdi_cancelar($datos);

if($respuesta["respuesta_pac"]["codigo_mf_numero"] == 0){
	
	$mensaje_original_pac_json =  json_decode($respuesta["respuesta_pac"]["mensaje_original_pac_json"] , true);
	
	$acuse = $mensaje_original_pac_json["CancelarCSDResult"];
	
	// Actualizar estatus de Factura a CANCELADO
	$update_factura	= "UPDATE nominas SET 
				cancelada = 1, 
				motivo_cancelacion = '".$_POST["motivo_cancelacion"]."' 
				WHERE id_nominas = '".$_POST["id_nominas"]."'";
	
	if(mysqli_query($link, $update_factura)){
		$respuesta["update_factura"]["estatus"]  = "success";
		$respuesta["update_factura"]["mensaje"]  = "CFDI CANCELADO CORRECTAMENTE";
		$respuesta["update_factura"]["query"]  = $update_factura;
	}
	else{
		$respuesta["update_factura"]["estatus"]  = "error";
		$respuesta["update_factura"]["mensaje"]  = mysqli_error($link);
	
	}
	
	
	if(!file_put_contents("acuses/cancelacion_".$_POST["folio_nominas"].'.xml',$acuse )){
		$respuesta["acuse"]["estatus"]  = "success";
		$respuesta["acuse"]["mensaje"]  = "Acuse Creado Correctamente";
		$respuesta["acuse"]["ruta"]  = "acuses/".$_POST["folio_nominas"].'.xml';
	}
	else{
		$respuesta["acuse"]["estatus"]  = "error";
	}
}

echo json_encode($respuesta);

?>
