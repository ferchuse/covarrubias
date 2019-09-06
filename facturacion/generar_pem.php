<?php
header("Content-Type: application/json");
$respuesta=array();

/////////////////////////////////////////////////
////        GENERACION PEM 
/////////////////////////////////////////////////
error_reporting(0);
    $rfc = "VACL600123UX1";
		// $pass = 'VALO6001CL23';
		$pass = 'COVA23LOR';
    include "lib/cfdi32_multifacturas.php";
    $error='OK';
    if(function_exists('certificado_pem'))
    {
        
        $cer= file_get_contents("certificados/".$rfc.".cer");
        $key= file_get_contents("certificados/".$rfc.".key");
        file_put_contents("tmp/".$rfc.".cer",$cer);
        file_put_contents("tmp/".$rfc.".key",$key);
        //unlink('tmp/GUAF880601NA6.cer.pem');
       // unlink('tmp/GUAF880601NA6.key.pem');
        $datos['conf']['cer'] = "tmp/".$rfc.".cer.pem";
        $datos['conf']['key'] = "tmp/".$rfc.".key.pem";
        $datos['conf']['pass'] = $pass;
        certificado_pem($datos);
        if(file_exists("tmp/".$rfc.".cer.pem"))
        {
					
            $respuesta["cer"]["estatus"] = "success";
        }
        else
        {
						 $respuesta["cer"]["estatus"] = "error";
            // echo "<p>ERROR GENERANDO ARCHIVO .CER.PEM   <b>OK</b></p>";
            $error.='SI';
        }

        if(file_exists("tmp/".$rfc.".key.pem"))
        {
            $respuesta["key"]["estatus"] = "success";
					 // echo "<p>ARCHIVOS .KEY.PEM   <b>OK</b></p>";
        }
        else
        {
						$respuesta["key"]["estatus"] = "error";
            // echo "<p>ERROR GENERANDO ARCHIVO .KEY.PEM   <b>OK</b></p>";
            $error.='SI';
        }
        
    }
    else
    {
        $error.='SI';
        $respuesta["all"]["estatus"] = "error";
				// ECHO "<p>ERROR : <b>FALTA el archivo cfdi32_multifacturas.php para realizar la ultima prueba</b></p>";
    }
    
    if($error!='OK')
    {
				 $respuesta["all"]["estatus"] = "error";
				 $respuesta["all"]["error"] = "$error";
        // echo "<h1>ERROR GRAVE, NO SE PUEDEN PROCESAR LOS CERTIFICADOS</h1>";
    }


echo json_encode($respuesta);
?>