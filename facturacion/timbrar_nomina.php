<?php
	
	// error_reporting(~(E_WARNING));
	error_reporting(0);
	
	date_default_timezone_set('America/Mexico_City');
	
	require_once 'sdk2.php';
	include_once("../conexi.php");
	$link = Conectarse();
	
	setlocale(LC_ALL,"en_US"); 
	
	$respuesta = array();
	$respuesta["locale"] = localeconv();
	
	$respuesta["post"]= $_POST;
	
	$datos['complemento'] = 'nomina12';
	
	$datos['version_cfdi'] = '3.3';
	$datos['cfdi']="nominas/nomina_{$_POST["folio_nomina"]}.xml";
	$datos['xml_debug']="nominas/debug_ejemplo_cfdi33_nomina12.xml";
	
	$datos['PAC']['usuario'] = 'VACL600123UX1';
	$datos['PAC']['pass'] = 'covarrubias';
	$datos['PAC']['produccion'] = isset($_POST["modo_pruebas"])? "NO" : "SI";
	
	$datos['conf']['cer'] = 'certificados/VACL600123UX1.cer.pem';
	$datos['conf']['key'] = 'certificados/VACL600123UX1.key.pem';
	$datos['conf']['pass'] = 'COVA23LOR';
	
	$datos['factura']['condicionesDePago'] = '';
	$datos['factura']['fecha_expedicion'] = date('Y-m-d\TH:i:s', time() - 120);
	$datos['factura']['serie'] = $_POST["serie_nomina"];
	$datos['factura']['folio'] = $_POST["folio_nomina"];
	$datos['factura']['forma_pago'] = $_POST["forma_pago"];
	$datos['factura']['LugarExpedicion'] =  $_POST["lugar_expedicion"]; 
	$datos['factura']['metodo_pago'] = 'PUE';
	$datos['factura']['moneda'] = 'MXN';
	$datos['factura']['tipocambio'] = '1';
	$datos['factura']['tipocomprobante'] = 'N';
	$datos['factura']['subtotal'] = $_POST["subtotal"];
	$datos['factura']['descuento'] = $_POST["descuento"];
	$datos['factura']['total'] =  $_POST["total"];
	
	/*$datos['CfdisRelacionados']['TipoRelacion'] = '01';
	$datos['CfdisRelacionados']['UUID'][0]='A39DA66B-52CA-49E3-879B-5C05185B0EF7';*/
	
	//$datos['factura']['Confirmacion'] = '0234';
	$datos['emisor']['rfc'] = 'VACL600123UX1'; 
	$datos['emisor']['nombre'] = 'LORENA BELEN VARGAS COVARRUBIAS'; 
	$datos['factura']['RegimenFiscal'] = $_POST["regimen_emisores"];
	
	$datos['receptor']['rfc'] = $_POST["rfc_empleados"];
	$datos['receptor']['UsoCFDI'] = 'P01';
	$datos['receptor']['nombre'] = $_POST["nombre_empleados"];
	
	//$datos['receptor']['ResidenciaFiscal'] = 'MEX';
	//$datos['receptor']['NumRegIdTrib'] = '1234567890';
	
	
	$datos['conceptos'][0]['cantidad'] = '1';
	$datos['conceptos'][0]['descripcion'] =  'Pago de nómina';
	$datos['conceptos'][0]['valorunitario'] =  $_POST["conceptos"][0]["precio_unitario"];
	$datos['conceptos'][0]['importe'] = $_POST["conceptos"][0]["importe"];
	$datos['conceptos'][0]['ClaveUnidad'] = 'ACT';
	$datos['conceptos'][0]['ClaveProdServ'] = '84111505';
	$datos['conceptos'][0]['Descuento'] = $_POST["conceptos"][0]["descuento"];
	
	
	
	// Obligatorios
	$datos['nomina12']['TipoNomina'] = $_POST["tipo_nomina"];
	$datos['nomina12']['FechaPago'] = $_POST["fecha_pago"];
	$datos['nomina12']['FechaInicialPago'] =  $_POST["fecha_inicial"];
	$datos['nomina12']['FechaFinalPago'] = $_POST["fecha_final"];
	$datos['nomina12']['NumDiasPagados'] = $_POST["dias_pagados"];
	// Opcionales
	
	// SUB NODOS OPCIONALES DE NOMINA [Emisor, Percepciones, Deducciones, OtrosPagos, Incapacidades]
	// Nodo Emisor, OPCIONALES
	
	
	$datos['nomina12']['Emisor']['RfcPatronOrigen'] = 'VACL600123UX1';
	$datos['nomina12']['Emisor']['Curp'] = 'VACL600123MHGRVR02';
	
	// SUB NODOS OBLIGATORIOS DE NOMINA [Receptor]
	// Obligatorios de Receptor
	
	$datos['nomina12']['Receptor']['ClaveEntFed'] = 'HID';
	$datos['nomina12']['Receptor']['Curp'] = $_POST["curp_empleados"];
	$datos['nomina12']['Receptor']['NumEmpleado'] = $_POST["id_empleados"];
	$datos['nomina12']['Receptor']['PeriodicidadPago'] = $_POST["periodicidad"];
	$datos['nomina12']['Receptor']['TipoContrato'] = $_POST["tipo_contrato"];
	$datos['nomina12']['Receptor']['TipoRegimen'] =  $_POST["tipo_regimen"]; // Asalariados, 03, Jubilados
	
	/*
		// Opcionales de Receptor ErrorNOM164-El(Los) atributo(s) 
		NumSeguridadSocial,
		nomina12:Receptor:FechaInicioRelLaboral,
		nomina12:Receptor:Antigüedad,
		nomina12:Receptor:RiesgoPuesto y 
		nomina12:Receptor:SalarioDiarioIntegrado debe(n) existir.
		
		RegistroPatronal= B5510768108
		Por excepción, este dato no aplica cuando el empleador realice el pago a contribuyentes
		asimilados a salarios, no se sitúe en los supuestos contemplados en los artículos 12 y
		13 de la Ley del Seguro Social, o bien no cuente con un registro asignado en términos
		de las disposiciones aplicables.
		Este dato debe existir cuando en el campo TipoContrato se haya registrado alguna de
		las siguiente claves: 01(Contrato de trabajo por tiempo indeterminado), 02 Contrato
		de trabajo para obra determinada, 03 (Contrato de trabajo por tiempo determinado),
		04 (Contrato de trabajo por temporada), 05(Contrato de trabajo sujeto a prueba),
		06(Contrato de trabajo con capacitación inicial), 07(Modalidad de contratación por
		pago de hora laborada), 08 (Modalidad de trabajo por comisión laboral).
		
	*/
	// $datos['nomina12']['Receptor']['Banco'] = '021';
	// $datos['nomina12']['Receptor']['CuentaBancaria'] = '1234567890';
	// $datos['nomina12']['Receptor']['Puesto'] = 'Desarrollador';
	
	
	
	$asimilados = ["09", "10", "99" ];
	if(!in_array($_POST["tipo_contrato"], $asimilados)){
		$datos['nomina12']['Emisor']['RegistroPatronal'] = 'B7022732103';
		
		
		$datos['nomina12']['Receptor']['Antiguedad'] = $_POST["antiguedad"];
		$datos['nomina12']['Receptor']['FechaInicioRelLaboral'] = $_POST["fecha_inicio_laboral"];
		$datos['nomina12']['Receptor']['NumSeguridadSocial'] = $_POST["nss"];
		
		$datos['nomina12']['Receptor']['RiesgoPuesto'] = $_POST["riesgo"];
		$datos['nomina12']['Receptor']['SalarioBaseCotApor'] =  $_POST["salario_base"];
		$datos['nomina12']['Receptor']['SalarioDiarioIntegrado'] = $_POST["salario_diario"];
		
	}
	
	// NODO PERCEPCIONES
	
	// Agregar Percepciones (Todos obligatorios)
	
	/*
		TotalSueldos:
		Este dato debe ser igual a la suma de los campos ImporteGravado e ImporteExento
		donde la clave expresada en el campo TipoPercepcion sea distinta de 
		"022" (Prima porAntigüedad), 
		"023" (Pagos por separación),
		"025" (Indemnizaciones), 
		"039" (Jubilaciones, pensiones o haberes de retiro en una exhibición) y 
		"044" (Jubilaciones,pensiones o haberes de retiro en parcialidades)
		
		// $datos['nomina12']['Percepciones'][0]['TipoPercepcion'] = '001';
		// $datos['nomina12']['Percepciones'][0]['Clave'] = '001';
		// $datos['nomina12']['Percepciones'][0]['Concepto'] = 'Sueldos, Salarios Rayas y Jornales';
		// $datos['nomina12']['Percepciones'][0]['ImporteGravado'] = '3855.00';
		// $datos['nomina12']['Percepciones'][0]['ImporteExento'] = '0.00';
	*/
	
	$no_sueldo = ["022", "023", "025" , "039" , "044"];
	$total_sueldos=0;
	
	foreach($_POST["percepciones"]["tipo_percepcion"] as $index => $percepcio){
		$datos['nomina12']['Percepciones'][$index]['TipoPercepcion'] = $_POST["percepciones"]["tipo_percepcion"][$index];
		$datos['nomina12']['Percepciones'][$index]['Clave'] = $_POST["percepciones"]["clave"][$index];
		$datos['nomina12']['Percepciones'][$index]['Concepto'] =  $_POST["percepciones"]["concepto"][$index];
		$datos['nomina12']['Percepciones'][$index]['ImporteGravado'] = $_POST["percepciones"]["gravado"][$index];
		$datos['nomina12']['Percepciones'][$index]['ImporteExento'] = $_POST["percepciones"]["excento"][$index];
		
		if(!in_array($_POST["percepciones"]["tipo_percepcion"][$index], $no_sueldo)){
			
			$total_sueldos+= $_POST["percepciones"]["gravado"][$index] + $_POST["percepciones"]["excento"][$index];
			
		}
		
	} 
	
	
	// Totales Obligatorios
	$datos['nomina12']['Percepciones']['TotalGravado'] = $_POST["total_gravado"];
	$datos['nomina12']['Percepciones']['TotalExento'] = $_POST["total_excento"];
	$datos['nomina12']['Percepciones']['TotalSueldos'] = $total_sueldos;
	
	$datos['nomina12']['TotalPercepciones'] = $_POST["total_percepciones"];
	
	$datos['nomina12']['TotalOtrosPagos'] = $_POST["total_otros_pagos"];
	
	
	// NODO DEDUCCIONES
	
	$total_otras_deducciones = 0;
	$total_impuestos_retenidos = 0;
	
	if($_POST["total_deducciones"] > 0){
		
		foreach($_POST["deducciones"]["tipo_deduccion"] as $index => $percepcion){
			$datos['nomina12']['Deducciones'][$index]['TipoDeduccion'] = $_POST["deducciones"]["tipo_deduccion"][$index];
			$datos['nomina12']['Deducciones'][$index]['Clave'] = $_POST["deducciones"]["clave"][$index];
			$datos['nomina12']['Deducciones'][$index]['Concepto'] =  $_POST["deducciones"]["concepto"][$index];
			$datos['nomina12']['Deducciones'][$index]['Importe'] = $_POST["deducciones"]["importe"][$index];
			
			if($_POST["deducciones"]["tipo_deduccion"][$index] == '002'){
				$total_impuestos_retenidos+= $_POST["deducciones"]["importe"][$index];
				
			}
			else{
				$total_otras_deducciones+= $_POST["deducciones"]["importe"][$index];
			}
			
		} 
		
		$datos['nomina12']['Deducciones']['TotalOtrasDeducciones'] = $total_otras_deducciones;
		if($total_impuestos_retenidos > 0){
			$datos['nomina12']['Deducciones']['TotalImpuestosRetenidos'] = $total_impuestos_retenidos; 
		}
		
		
		$datos['nomina12']['TotalDeducciones'] = $_POST["total_deducciones"];
	}
	
	
	//NODO Otros Pagos
	
	if($_POST["total_otros_pagos"] > 0){
		
		foreach($_POST["otros_pagos"]["tipo"] as $index => $otros_pagos){
			$datos['nomina12']['OtrosPagos'][$index]['TipoOtroPago'] = $_POST["otros_pagos"]["tipo"][$index];
			$datos['nomina12']['OtrosPagos'][$index]['Clave'] = $_POST["otros_pagos"]["clave"][$index];
			$datos['nomina12']['OtrosPagos'][$index]['Concepto'] = $_POST["otros_pagos"]["concepto"][$index];
			$datos['nomina12']['OtrosPagos'][$index]['Importe'] = $_POST["otros_pagos"]["importe"][$index];
			
			if($_POST["otros_pagos"]["tipo"][$index] == '002'){
				
				$datos['nomina12']['OtrosPagos'][$index]['SubsidioAlEmpleo']["SubsidioCausado"] =$_POST["otros_pagos"]["subsidio_causado"][$index];
				
			}
			
		} 
		
	}
	
	
	
	// $respuesta["post"]= $_POST; 
	$respuesta["datos"]= $datos;
	$respuesta["timbrado"]= mf_genera_cfdi($datos);
	
	
	if($respuesta["timbrado"]["codigo_mf_numero"] == 0){
		//guardar en base de datos
		
		$guardar_nomina = "INSERT INTO nominas SET
		folio_nomina ='{$_POST["folio_nomina"]}',
		id_empleados = '{$_POST["id_empleados"]}',
		tipo_nomina = '{$_POST["tipo_nomina"]}',
		fecha_pago = '{$_POST["fecha_pago"]}',
		fecha_inicial = '{$_POST["fecha_inicial"]}',
		fecha_final = '{$_POST["fecha_final"]}',
		dias_pagados = '{$_POST["dias_pagados"]}',
		subtotal = '{$_POST["subtotal"]}',
		descuento = '{$_POST["descuento"]}',
		total = '{$_POST["total"]}',
		forma_pago = '{$_POST["forma_pago"]}',
		lugar_expedicion = '{$_POST["lugar_expedicion"]}',
		concepto_importe = '{$_POST["conceptos"][0]["importe"]}',
		concepo_descuento = '{$_POST["conceptos"][0]["descuento"]}',
		total_deducciones = '{$_POST["total_deducciones"]}',
		total_percepciones = '{$_POST["total_percepciones"]}',
		total_excento = '{$_POST["total_excento"]}',
		total_gravado = '{$_POST["total_gravado"]}',
		total_sueldos = '{$_POST["total_sueldos"]}',
		total_impuestos = '{$total_impuestos_retenidos}',
		total_otros_pagos = '{$_POST["total_otros_pagos"]}',
		total_otras_deducciones = '{$total_otras_deducciones}',
		folio_fiscal = '{$respuesta["timbrado"]["uuid"]}',
		cadena_original = '{$respuesta["timbrado"]["representacion_impresa_cadena"]}',
		fecha_timbrado = '{$respuesta["timbrado"]["representacion_impresa_fecha_timbrado"][0]}',
		
		sello_emisor = '{$respuesta["timbrado"]["representacion_impresa_sello"]}',
		sello_sat = '{$respuesta["timbrado"]["representacion_impresa_selloSAT"]}'
		
		";
		
		$result_nomina = mysqli_query($link, $guardar_nomina);
		if($result_nomina){
			
			$respuesta["result_nomina"] = "success";
			$respuesta["id_nominas"] = mysqli_insert_id($link);
			
		}
		else{
			$respuesta["result_nomina"] ="error".mysqli_error($link);
			
		}	
		
		
		//Percepciones
		foreach($_POST["percepciones"]["tipo_percepcion"] as $index => $percepcion){
			$guardar_percepciones = "INSERT INTO nominas_percepciones SET 
			tipo_percepcion = '{$_POST["percepciones"]["tipo_percepcion"][$index]}',
			concepto = '{$_POST["percepciones"]["concepto"][$index]}',
			gravado = '{$_POST["percepciones"]["gravado"][$index]}',
			excento = '{$_POST["percepciones"]["excento"][$index]}',
			id_nominas = '{$respuesta["id_nominas"]}'
			
			";
			$result_percepciones = mysqli_query($link, $guardar_percepciones);
			if($result_percepciones){
				$respuesta["result_percepciones"] = "success";
			}
			else{
				$respuesta["result_percepciones"] ="error".mysqli_error($link);
			}
		} 
		
		//Deducciones
		foreach($_POST["deducciones"]["tipo_deduccion"] as $index => $percepcion){
			$guardar_deducciones = "INSERT INTO nominas_deducciones SET 
			tipo_deduccion = '{$_POST["deducciones"]["tipo_deduccion"][$index]}',
			concepto = '{$_POST["deducciones"]["concepto"][$index]}',
			importe = '{$_POST["deducciones"]["importe"][$index]}',
			id_nominas = '{$respuesta["id_nominas"]}'
			
			
			";
			$result_deducciones = mysqli_query($link, $guardar_deducciones);
			if($result_deducciones){
				$respuesta["result_deducciones"] = "success";
			}
			else{
				$respuesta["result_deducciones"] ="error".mysqli_error($link);
			}
		} 	
		
		//Otros Pagos
		
		foreach($_POST["otros_pagos"]["tipo"] as $index => $percepcion){
			$guardar_otros_pagos = "INSERT INTO nominas_otros_pagos SET 
			tipo= '{$_POST["otros_pagos"]["tipo"][$index]}',
			concepto = '{$_POST["otros_pagos"]["concepto"][$index]}',
			importe = '{$_POST["otros_pagos"]["importe"][$index]}',
			subsidio_causado = '{$_POST["otros_pagos"]["subsidio_causado"][$index]}',
			id_nominas = '{$respuesta["id_nominas"]}'
			
			
			";
			$result_otros_pagos = mysqli_query($link, $guardar_otros_pagos);
			if($result_otros_pagos){
				$respuesta["result_otros_pagos"] = "success";
			}
			else{
				$respuesta["result_otros_pagos"] ="error".mysqli_error($link);
				$respuesta["guardar_otros_pagos "] =$guardar_otros_pagos ;
			}
		} 
		
		
		
		
		
	}
	
	
	echo json_encode($respuesta);
	
?>	