<?php
	$zip = new ZipArchive();
	$zip_name = time().".zip"; // Zip name
	$zip->open($zip_name,  ZipArchive::CREATE);
	
	$directorio = 'nominas/';
	$files  = scandir($directorio);
	echo "<pre>";
	echo var_dump($files);
	echo "</pre>";
	// $files = ["1000.pdf", "1001.pdf", "nomina_1000.xml", "nomina_1001.xml"];
	// foreach ($files as $file) {
	
	// if(file_exists($file)){
	// $zip->addFromString(basename($path),  file_get_contents($path));  
	// }
	// else{
	// echo"file does not exist";
	// }
	// }
	// $zip->close();
	
	// header('Content-Type: application/zip');
	// header('Content-disposition: attachment; filename='.$zip_name);
	// header('Content-Length: ' . filesize($zip_name));
	// readfile($zip_name);
?>