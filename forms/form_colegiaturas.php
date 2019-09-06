
<div class="panel panel-primary">
				 
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
					<label for="id_alumnos">Plan de Pagos:</label>
					<select class="form-control"  id="id_plan">
						 <?php echo dame_costos($id_niveles, $id_plan,$link);?>
					</select>
				</div>
				<div class="form-group">
						<label for="id_descuentos">Beca:</label>
						<select class="form-control" name="id_descuentos" id="id_descuentos">
						<option value="" data-porc_beca="0">Sin beca ...</option>
							 <?php echo dame_becas($id_beca_alumno, $link);?>
						</select>
				</div>
				<!-- ## otoniel 
					colocacion de un select para escoger el tipo de pago guardandolo en la BD en la tabla pagos_detalle
				-->
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
						</select>
				</div>
			</div><!--col-sm-4 !-->
				<div class="col-sm-4" id="listarMeses">
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
											data-descripcion="<?php echo $meses[$fila_pagos["mes_colegiaturas"]];?>" 
											type="checkbox" name="id_colegiaturas[]" value="<?php echo $fila_pagos["id_colegiaturas"]?>">
											<?php echo $meses[$fila_pagos["mes_colegiaturas"]];  ?>
											<input disabled class="importe hidden" name="importe[]" >
											<input disabled class="descripcion hidden" name="descripcion[]" >
									<?php	
									}else{
										
										 echo $meses[$fila_pagos["mes_colegiaturas"]];  
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
			
			<div class="col-sm-4">
				<div class="form-group">
					<label for="recargos">Recargos:</label>
					<input class="form-control" id="recargos" name="recargo_pagos" type="number">
				</div>
				<div class="form-group">
					<label for="subtotal">Subtotal:</label>
					<input class="form-control" id="subtotal" required readonly name="subtotal" type="text">
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
					<label for="descuento_cantidad">Descuento Cantidad:</label>
					<input class="form-control" id="descuento" step="any" name="descuento_pagos" type="number">
				</div>
				
				<div class="form-group">
					<label for="total_costos">Total:</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-usd"></i></span>
						<input class="form-control" id="total_costos" required readonly name="total_pagos" type="text">
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
