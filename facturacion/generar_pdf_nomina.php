<?php
	header("Content-Type: application/json");
	require 'vendor/autoload.php';
	include_once("../conexi.php");
	
	use Dompdf\Dompdf; 
	
	$link = Conectarse();
	$respuesta = array();
	$datos_factura = ["id_nominas"=> $_GET["id_nominas"], 'folio_nomina' => $_GET["folio_nomina"]];
	
	
	
	//generar pdf
	$dompdf = new Dompdf();
	
	$html = get_factura_html($datos_factura);
	$dompdf->set_option('enable_html5_parser', TRUE);
	$dompdf->loadHtml($html);
	$dompdf->setPaper('Letter', 'Portrait');
	
	$dompdf->render();
	
	$pdf_file = $dompdf->output();
	
	
	
	$respuesta["pdf_path"] = "nominas/".$datos_factura["folio_nomina"].".pdf";
	
	
	// $respuesta["html"] = $html;
	
	
	
	
	if(!file_put_contents($respuesta["pdf_path"], $pdf_file)){
		$respuesta["estatus_pdf"] = "error";
		
	}
	else{
		$respuesta["estatus_pdf"] = "success";
	}
	
	$respuesta["execution_time"] = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
	
	
	function get_factura_html($datos_factura){
		$url = $_SERVER['HTTP_HOST'].'/facturacion/plantilla_nomina.php';
		
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