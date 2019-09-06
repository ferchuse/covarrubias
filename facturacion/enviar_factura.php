<?php
header("Content-Type: application/json");
require 'lib/phpmailer/PHPMailerAutoload.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$respuesta = array();
session_start();

$correo_clientes = isset($_GET["correo"]) ? $_GET["correo"] : "sistemas@glifo.mx";
$url_xml = isset($_GET["url_xml"]) ? $_GET["url_xml"] : 'timbrados/A2000.xml';
$url_pdf = isset($_GET["url_pdf"]) ? $_GET["url_pdf"] : 'timbrados/A2000.pdf';
$nombre_emisor = "Lorena Belen Vargas Covarrubias";

$nombre_colegio = "Colegio Miguel Covarrubias Pachuca";

$mail = new PHPMailer;

// $mail->isSMTP();                                    
// $mail->Host = 'smtp.live.com';  
// $mail->SMTPAuth = true;                              
// $mail->Username = 'facturacion@glifo.mx';                
// $mail->Password = 'glifo951';                            
// $mail->SMTPSecure = 'tls';                         
// $mail->Port = 587;                                    
// $mail->SMTPDebug = 0;                            

$mail->setFrom('facturacion@glifo.micrositio.mx', 'Facturacion Glifo');

 
$mail->addAddress($correo_clientes);     // Destinatario
$mail->AddReplyTo("desp_cont@yahoo.com.mx" ,"Despacho Contable"); 
// $mail->addBCC("sistemas@glifo.mx");     // Copia Oculta
$mail->addBCC("colegiocovarrubias@gmail.com");     //  Copia Primaria
$mail->addBCC("cri_medina@hotmail.com");     //  Copia Oculta
$mail->addBCC("desp_cont@yahoo.com.mx");     //  Copia Oculta
$mail->addAttachment($url_xml);        // Add attachments
$mail->addAttachment($url_pdf);         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Factura '. $nombre_colegio;
$mail->Body    = "<center><b>$nombre_emisor le envia la factura $url_pdf</b> </center>
<hr>
";
$mail->AltBody = "Adjunto Factura  ";

if(!$mail->send()) {
		$respuesta["estatus_correo"] = "error";
		$respuesta["mensaje_correo"] = 'No se envio el correo.'. $mail->ErrorInfo;
		 
		 } else {
		$respuesta["estatus_correo"] = "success"; 
		$respuesta["mensaje_correo"] = "Correo Enviado Correctamente";
		 
}

echo json_encode($respuesta);
?>