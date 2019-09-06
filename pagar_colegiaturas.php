<?php
	error_reporting(0);
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse(); 
	$menu_activo = "administracion";
	
	
	if(isset($_GET["id_alumnos"])){
		$id_alumnos = $_GET["id_alumnos"];
		
		$id_ciclos = $_GET["id_ciclos"];
		
	}
	
	$cons_alumnos = "SELECT *, alumnos.id_niveles  AS  id_nivel_actual
	FROM
	alumnos
	LEFT JOIN inscripciones USING (id_alumnos)
	LEFT JOIN grupos USING(id_grupos)
	LEFT JOIN grados ON grupos.id_grados = grados.id_grados
	LEFT JOIN niveles ON niveles.id_niveles = grados.id_niveles
	LEFT JOIN descuentos USING (id_descuentos)
	
	WHERE id_alumnos = '$id_alumnos' and id_ciclos = $id_ciclos";
	
	$result_alumnos =  mysqli_query($link, $cons_alumnos);
	
	if($result_alumnos ){
		while($fila_alumnos = mysqli_fetch_assoc($result_alumnos)){
			
			$id_niveles = $fila_alumnos["id_nivel_actual"];
			$id_plan = $fila_alumnos["id_plan"];
			$id_beca_alumno = $fila_alumnos["id_descuentos"];
			$nombre_niveles = $fila_alumnos["nombre_niveles"];
			$id_ciclos = $fila_alumnos['id_ciclos'];
			$nombre_ciclos = $fila_alumnos['nombre_ciclos'];
			$curp = $fila_alumnos["curp_alumnos"];
			$nivel = $fila_alumnos["nombre_grados"]." ". $fila_alumnos["nombre_niveles"];
			$nombre_alumnos = $fila_alumnos["apellidop_alumnos"]." ". $fila_alumnos["apellidom_alumnos"]." ". $fila_alumnos["nombre_alumnos"];
			$tipo_beca = $fila_alumnos["nombre_descuentos"];
			$porc_beca = $fila_alumnos["porc_descuentos"];
		}
	}
	else{
		
		
	}
	
	function dame_costos($id_niveles, $id_plan, $link){
		$options ="";
		$consulta_costos = "SELECT *
		FROM
		costos
		LEFT JOIN niveles USING(id_niveles)
	  ";
		
		$result_costos =  mysqli_query($link, $consulta_costos)	;
		
		if(mysqli_num_rows($result_costos) == 0)	{
			return "
			<option value=''>No hay Plan asignado </option>
			<option value=''>$consulta_costos </option>
			
			" ;
		}
		if($result_costos)	{
			while($fila_costos = mysqli_fetch_assoc($result_costos)){
				
				$id_costos = $fila_costos["id_costos"];
				$concepto_costos =$fila_costos["nombre_niveles"]."-". $fila_costos["concepto_costos"];
				$selected = $id_costos == $id_plan ? "selected" : "";
				$options.= "<option $selected value='$id_costos'>$concepto_costos</option>";
			}
		}
		else{
			$options = "<option value=''>Ocurrio un Error $consulta_costos ".mysqli_error($link). "</option>" ;
		}
		return $options;
		
	}
	
	function dame_becas($id_beca_alumno, $link){
		$options ="";
		$consulta = "SELECT *
		FROM
		descuentos ";
		
		$result =  mysqli_query($link, $consulta)	;
		
		if($result)	{
			while($fila = mysqli_fetch_assoc($result)){
				
				$id_descuentos = $fila["id_descuentos"];
				$nombre_descuentos = $fila["nombre_descuentos"];
				$porc_beca = $fila["porcentaje_descuentos"];
				$tipo_descuento = $fila["tipo_descuento"];
				$cantidad_descuentos = $fila["cantidad_descuentos"];
				$simbolo = $fila["tipo_descuento"];
				$selected = $id_descuentos == $id_beca_alumno ? "selected" : "";
				$options.= "<option $selected data-tipo_descuento='$tipo_descuento' data-cantidad_descuentos='$cantidad_descuentos' data-porc_beca='$porc_beca' ";
				$options.= "value='$id_descuentos'>$nombre_descuentos";
				$options.= $tipo_descuento == 'Monto' ? "( $ $cantidad_descuentos)" : "($porc_beca%)</option>";
				
				
			}
		}
		else{
			$options = "<option value=''>Ocurrio un Error $consulta ".mysqli_error($link). "</option>" ;
		}
		return $options;
		
	}
	
	$meses =  array(
	"8" => "Inscripción", 
	"9" => "Septiembre", 
	"10" => "Octubre", 
	"11" => "Noviembre", 
	"12" => "Diciembre", 
	"1" => "Enero", 
	"2" => "Febrero", 
	"3" => "Marzo", 
	"4" => "Abril", 
	"5" => "Mayo", 
	"6" => "Junio", 
	"7" => "Julio"
	);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			.spinner_meses{
			margin-top: 120px;
			}
		</style>
    <title>Pago de Colegiaturas</title>
		
		<?php include("styles.php");?>
		
	</head>
  <body>
		
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		
		<pre hidden>
			<?php echo $cons_alumnos?>
			<?php echo $id_plan?>
		</pre>
		<form id="form_nuevo_pago" >
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading"><h4 class="text-center">Pago de Colegiaturas</h4></div>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="buscar_alumnos">Nombre del Alumno: 
												
											</label>
											<div class="input-group">
												<input autofocus placeholder="Escribe para Buscar" class="form-control" id="buscar_alumnos" required name="cliente" type="text" value="<?php echo $nombre_alumnos;?>"/>
												<span id="id_alumnos_span" class="input-group-addon">	
													<?php echo $id_alumnos;?>
												</span>
											</div>
										</div>
										
										<div class="form-group hidden">
											<label for="id_alumnos">Id del alumno:</label>
											<input class="form-control" readonly id="id_alumnos" required name="id_alumnos" type="text" value="<?php echo $id_alumnos;?>"/>
										</div>
										<div class="form-group">
											<label for="id_alumnos">Nivel:</label>
											<input class="form-control" readonly  type="text" value="<?php echo $nombre_niveles;?>"/>
											<input class="hidden"  name="id_niveles" type="text" value="<?php echo $id_niveles;?>"/>
										</div>
										<div class="form-group">
											<label for="id_alumnos">Plan de Pagos</label>
											<select class="form-control"  id="id_plan">
												<?php echo dame_costos($id_niveles, $id_plan,$link);?>
											</select>
										</div>
										<div class="form-group">
										<label >Descuento:</label>
											<select class="form-control" name="id_descuentos" id="id_descuentos">
												<option value="" data-porc_beca="0">Sin beca ...</option>
												<?php echo dame_becas($id_beca_alumno, $link);?>
											</select>
										</div>
									
										<div class="form-group">
											<label for="tipo_pago">Tipo de pago:</label>
											<select class="form-control" name="tipo_pago" id="tipo_pago" required>
												
												<option value="Efectivo" >Efectivo</option>
												<option value="Transferencia" >Transferencia</option>
											</select>
										</div>
										<div class="form-group">
											<label for="fecha_pagado">Fecha de Pago:</label>
											<input type="date" class="form-control fecha_anterior" name="fecha_pagado" id="fecha_pagado" value="<?php echo date("Y-m-d");?>">
										</div>
										<div class="form-group">
											<label >Ciclo Escolar:</label>
											<select class="form-control" name="id_ciclos" id="id_ciclos">
												<option <?php  echo $id_ciclos == 4 ? "selected": ""; ?>  value="4">2017-2018</option>
												<option <?php  echo $id_ciclos == 5 ? "selected": ""; ?> value="5">2018-2019</option>
												<option <?php  echo $id_ciclos == 6 ? "selected": ""; ?> value="6">2019-2020</option>
											</select>
										</div>
									</div><!--col-sm-4 !-->
									
									
									<div class="col-sm-5" id="listarMeses">
										<div class="form-group">
											<label >Meses:</label>
											<div class="list-group" >		
												<?php
													
													$cons_pagos = "SELECT * FROM colegiaturas_por_alumno WHERE id_alumnos = '$id_alumnos' AND id_ciclos = $id_ciclos";
													
													$result_pagos = mysqli_query($link, $cons_pagos) or die('Error en'.$cons_pagos .mysqli_error($link));							 
													
													while($fila_pagos = mysqli_fetch_assoc($result_pagos)){
														$vencido = $fila_pagos["estatus_colegiaturas"] == "VENCIDO" ? 1 : 0;
														$importe = $fila_pagos["importe_colegiaturas"];
														// $descripcion_pagos = $fila_pagos["estatus_colegiaturas"];
													?>
													<label class="list-group-item">
														<?php 
															if($fila_pagos["estatus_colegiaturas"] != 'PAGADO'){ ?>
															<input class="sumar_checked" 
															data-valor="<?php echo $fila_pagos["restante_colegiaturas"]; ?>"
															data-vencido="<?php echo $vencido; ?>" 
															data-importe="<?php echo $importe; ?>" 
															data-descripcion="<?php echo $fila_pagos["descripcion_colegiaturas"];?>" 
															type="checkbox" name="id_colegiaturas[]" value="<?php echo $fila_pagos["id_colegiaturas"]?>">
															<?php echo $fila_pagos["descripcion_colegiaturas"];  ?>
															<span class="pull-right">
																<input class="importe " name="importe[]" value="<?php echo $importe; ?>">
															</span>
															<input disabled class="descripcion hidden" name="descripcion[]" value="<?php echo $fila_pagos["descripcion_colegiaturas"];?>">
															<?php	
																}else{
																
																// echo $meses[$fila_pagos["mes_colegiaturas"]];  
																echo $fila_pagos["descripcion_colegiaturas"]; 
															}
														?>
														
														<?php
															switch($fila_pagos["estatus_colegiaturas"]){ 
																case 'VENCIDO':
															?>	
															<span class="badge badge-danger badge-pill">VENCIDO</span>
															<?php	
																break;
																case 'PAGADO':
															?>	
															<span class="badge badge-success badge-pill">PAGADO</span>
															<?php	
																break;
															}
														?>	
													</label>
													<?php 
													}
												?>
											</div>
										</div>
									</div>
									
									<div class="col-sm-3">
										<div class="form-group">
											<label for="recargos">Recargos:</label>
											<input class="form-control" id="recargos" name="recargo_pagos" type="number">
										</div>
										<div class="form-group">
											<label for="subtotal">Subtotal:</label>
											<input class="form-control" id="subtotal" required  name="subtotal" type="text">
										</div>
										
										<div class="form-group">
											<label for="descuento_desc">Descuento Descripción:</label>
											<input class="form-control" id="descuento_desc"  name="descuento_desc" type="text">
										</div>
										<div class="form-group">
											<label for="descuento_cantidad">Descuento Porcentaje:</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-percent"></i></span>
												<input class="form-control" max="100" id="descuento_porc" name="descuento_porc" type="number" value="<?php echo $porc_beca?>">
												
											</div>
										</div>
										<div class="form-group">
												<label ><input type="checkbox" id="aplica_beca" checked> Descuento:</label>
											<input class="form-control" id="descuento" step="any" name="descuento_pagos" type="number">
										</div>
										
										<div class="form-group">
											<label for="total_costos">Total:</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-usd"></i></span>
												<input class="form-control" id="total_costos" required  name="total_pagos" type="text">
											</div>
										</div>
									</div><!--4 !--> 	
								</div><!--row !-->
								<div class="row">
									<div class="col-sm-12 text-right"> 
										<button type="submit" disabled id="btn_pagar" class="btn btn-success btn-lg " >
											<i class="fa fa-money" ></i> Pagar
										</button >
									</div><!--  !-->
								</div><!-- !-->
							</div><!-- panel-body !-->
						</div><!-- panel !-->
					</div><!--col-md-4 !-->
				</div><!--row !-->
			</div><!--container-fluid !-->
		</form>
		
		<pre class="hidden">
			<?php echo $cons_alumnos;?>
		</pre>
		<?php include("forms/form_nuevo_alumno.php")?>
		<?php  include('scripts.php'); ?>
		<script src="js/pagar_colegiaturas.js"></script>
	</body>
</html>