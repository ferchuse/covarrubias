<form id="form_nuevo_beca" class="form">
	<div id="modal_nuevo_beca" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<!--INICIO DEL MODAL -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Editar Beca</h4>	
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<!--INICIO DEL FORMULARIO -->
							<div class="panel panel-default">
								
								<div class="panel-body">
									<div class="form-group">
										<input id="id_descuentos" class="hidden" name="id_descuentos">
										<label for="nombre_descuentos" class="text-center">Descripción: </label>
										<input type="text" class="form-control" id="nombre_descuentos" name="nombre_descuentos" required>
									</div>	
									<div class="form-group">
										<input id="id_descuentos" class="hidden" name="id_descuentos">
										<label for="tipo_descuento" class="text-center">Tipo de Descuento: </label>
										<select class="form-control" id="tipo_descuento" name="tipo_descuento" required>
											<option>Elige...</option>
											<option value="Monto">Monto</option>
											<option value="Procentaje"> Procentaje</option>
										</select>
									</div>
									<div class="form-group">
										<label for="cantidad_descuentos" class="text-center">Cantidad: </label>
										<input type="number" class="form-control " step="any" id="cantidad_descuentos" name="cantidad_descuentos" required>
									</div> 
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> 
						Cerrar
					</button>
					<button type="submit" class="btn btn-success">
						<i class="fa fa-save" aria-hidden="true"></i> 
						Guardar
					</button>
				</div>
				
			</div>
			
			<!--FINAL DEL MODAL -->	
		</div>
	</div>
</form>



<form id="beca">	
	<div id="modal_calcular_beca" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<!--INICIO DEL MODAL -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Calcula tu beca</h4>	
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<!--INICIO DEL FORMULARIO -->
							<div class="panel panel-default">
								
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4">
											<label for="">Costo:</label>
											<select id="costo_pagar" class="form-control"> 
												<?php
													$consulta = "SELECT * FROM costos LEFT JOIN niveles USING (id_niveles) WHERE usa_meses='1'";
													$result = mysqli_query($link,$consulta);
													while($row = mysqli_fetch_assoc($result)){
														extract($row);
													?>
													<option title="<?php echo '$'.$cantidad_costos.'°°'; ?>" value="<?php echo $cantidad_costos; ?>"><?php echo $concepto_costos.' | '.$nombre_niveles; ?></option>
													<?php
													}
												?>
											</select>
										</div>
										<div class="col-md-4">
											<label for="">Cantidad a pagar:</label>
											<input type="number" min="0" id="cant_pagar" class="form-control"> 
										</div>
										<div class="col-md-4">
											<label for="">Porcentaje:</label>
											<input type="text" readonly id="porc_pagar" class="form-control"> 
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> 
						Cerrar
					</button>
					<button type="submit" class="btn btn-success">
						<i class="fa fa-save" aria-hidden="true"></i> 
						Guardar
					</button>
				</div>
				
			</div>
			
			<!--FINAL DEL MODAL -->	
		</div>
	</div>
</form>	