<?php
	$zip = new ZipArchive();
	$zip_name = "Nominas".time().".zip"; // Zip name
	$zip->open($zip_name,  ZipArchive::CREATE);
	
	$directorio = 'nominas/';
	$files  = scandir($directorio);
	
	// $files = ["1000.pdf", "1001.pdf", "nomina_1000.xml", "nomina_1001.xml"];
	$archivos = array_diff($files, array('..', '.'));
	// echo "<pre>";
	// echo var_dump($archivos);
	// echo "</pre>";
	foreach ($files as $file) {
		$path = "nominas/".$file;
		if(file_exists($path)){
			$zip->addFromString(basename($path),  file_get_contents($path));  
			
			// $zip->addFile($path);
		}
		else{
			echo"file does not exist";
		}
	}
	$zip->close();
	
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zip_name);
	header('Content-Length: ' . filesize($zip_name));
	readfile($zip_name);
?>