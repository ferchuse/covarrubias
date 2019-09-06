<?php
	header("Content-Type: application/json");
	require 'vendor/autoload.php';
	include_once("../conexi.php");
	
	use Dompdf\Dompdf; 
	
	$link = Conectarse();
	$respuesta = array();
	$datos_factura = array();
	$id_facturas = $_GET["id_facturas"] ;
	
	
	
	//busca datos de factura 
	$consulta_facturas	= "SELECT * FROM facturas
	LEFT JOIN emisores USING(id_emisores)
	LEFT JOIN clientes USING(id_clientes)
	WHERE id_facturas = '$id_facturas'";
	
	$result = mysqli_query($link, $consulta_facturas);
	
	if($result && mysqli_num_rows($result)){
		$respuesta["consulta_facturas_estatus"] = "success";
		while($fila = mysqli_fetch_assoc($result)){
			$datos_factura = $fila;
		}
		
	}
	else{
		$respuesta["consulta_facturas_estatus"] = "error";
		$respuesta["consulta_facturas_mensaje"] = mysqli_error($link);
		$respuesta["consulta_facturas_query"] = $consulta_facturas;
	}
	
	$respuesta["datos_factura"] = $datos_factura;
	
	//generar pdf
	$dompdf = new Dompdf();
	
	// 
	//
	$html = get_factura_html($datos_factura);
	$dompdf->set_option('enable_html5_parser', TRUE);
	$dompdf->loadHtml($html);
	
	$dompdf->setPaper('Letter', 'Portrait');
	
	$dompdf->render();
	
	$pdf_file = $dompdf->output();
	
	if($datos_factura["folio_facturas"] == "A314"){
		$folio = strtoupper($datos_factura["uuid"]);
		$pdf_path = "timbrados/".$folio.".pdf";
		$respuesta["pdf_path"] = $pdf_path ;
		$respuesta["url_pdf"] = "timbrados/".$folio.".pdf";
		$respuesta["url_xml"] = "timbrados/".$folio.".xml";
		
		
		
	}
	else{
		$pdf_path = "timbrados/".$datos_factura["folio_facturas"].".pdf";
		$respuesta["pdf_path"] = $pdf_path ;
		$respuesta["url_pdf"] = "timbrados/".$datos_factura["folio_facturas"].".pdf";
		$respuesta["url_xml"] = "timbrados/".$datos_factura["folio_facturas"].".xml";
		
		
	}
	
	$respuesta["html"] = $html;
	
	
	
	
	if(!file_put_contents($pdf_path, $pdf_file)){
		$respuesta["estatus_pdf"] = "error";
		
		}else{
		$respuesta["estatus_pdf"] = "success";
	}
	
	//$respuesta["server"] =$_SERVER;
	// $respuesta["server2"] =$_SERVER['SERVER_NAME']; 
	$respuesta["execution_time"] = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
	
	
	function get_factura_html($datos_factura){
		$url = $_SERVER['HTTP_HOST'].'/facturacion/plantilla_pdf.php';
		
		$ch = curl_init(); //ajax
		curl_setopt($ch, CURLOPT_URL, $url); //url
		curl_setopt($ch, CURLOPT_POST, true); // method
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datos_factura)) ; // data
		
		$result = curl_exec($ch);
		if($result === FALSE){
			$respuesta["curl_estatus"] = "error";
			$respuesta["curl_mensaje"] = 'Curl failed: '. curl_error($ch);
		}
		curl_close($ch);
		return $result;
	}		
	
	echo json_encode($respuesta);
	
?>