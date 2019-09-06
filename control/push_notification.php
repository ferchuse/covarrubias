<?php 
$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];

	function send_notification ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			'registration_ids' => $tokens,
			'data' => $message
			);
		
		$headers = array(
			// key anterior:'Authorization:key = AAAAIKQb7c8:APA91bGOY9Erd-qyghVLlmIRCjuPmiPsi800VeIdTBUlr07O2P1ZXVddeLwzr9Qjtm-1LEAQf_9Erkz2W7x8UJ42eUu-WrED4YvNzkySknYCfjIYMov-ROSPKBlTrgLc90fWfHt2to2P',
			'Authorization:key = AAAAuhurjjQ:APA91bHosiyETqdvZinXgXEdpt7mhPNjixUCcDhCYCRhXg7FL7x6XmpQveuQA-RiPxJXEJyh4qYMPSSUGAFKzNEqN_4FiWwqRhSr3dx6bmCPXJgJJtPdS66yQ383xoDPdP__9H4KQcnp5PyU5TyVG93Y9WiPeOmd4g',
			
			'Content-Type: application/json');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

		$result = curl_exec($ch);
		if($result === FALSE){
			die('Curl failed: '. curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}

	$conn = mysqli_connect("localhost","root","","fcm");

	$sql = "SELECT Token FROM user";

	$result = mysqli_query($conn,$sql);
	$tokens = array();

	if(mysqli_num_rows($result) > 0){

		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["Token"];
		}
	}
	mysqli_close($conn);
	
	$tokens[] = "cpNVbSLANsg:APA91bEgYRaoBqmg4Y4sZMMmRf9B_wMuFBQRUUWEofjKQMWPb6E8ctTutlQpCFd8NI8HN1NJrrEMjz3SVS3SD3lRvVFPtQi57s9_DnrC0YHnT6dLIheng56UqAwr8p62OOuk_L3Mjt8h";
	$message = array("message" => $titulo,"titulo" => $subtitulo);
	$message_status = send_notification($tokens, $message);
	echo $message_status;
	echo json_encode($message_status);

 ?>