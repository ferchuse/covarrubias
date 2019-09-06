<form id="form_nuevo_costo" class="form">
	<div id="modal_nuevo_costo" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
<!--INICIO DEL MODAL -->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Colegiatura</h4>	
			</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
						<!--INICIO DEL FORMULARIO -->
							
									
										<div class="form-group col-md-1">
											<label  for="id_costos" class="text-center">Id:</label>
											<input readonly type="text" class="form-control" name="id_costos" id="id_costos">
										</div>
										<div class="form-group col-md-6">
											<label for="concepto_costos" class="text-center">Concepto:</label>
											<input type="text" class="form-control" required name="concepto_costos" id="concepto_costos">
										</div>
										<div class="form-group col-md-5">
											<label for="cantidad_costos" class="text-center">Precio:</label>
											<input type="text" class="form-control" name="cantidad_costos" id="cantidad_costos" required>
										</div>
									
										
											<div class="form-group col-md-6">
												<label for="periodo_costos">Periodo:</label>
												<select id="periodo_costos" name="periodo_costos" class="form-control">
													<option>Selecciona el periodo</option>
													<option data-meses="1" value="MENSUAL">MENSUAL</option>
													<option data-meses="4" value="CUATRIMESTRAL">CUATRIMESTRAL</option>
													
													<option data-meses="6" value="SEMESTRAL">SEMESTRAL</option>
													<option data-meses="12" value="ANUAL">ANUAL</option>
												</select>
											</div> 
											<div class="form-group col-md-6">
												<label for="dia_limite">Día Limite de Pago:</label>
												<input type="number" id="dia_limite" name="dia_limite" class="form-control" value="20">
													
											</div>
												<div class="form-group col-md-6"> 
												<label for="id_niveles">Nivel:</label>
												<select id="id_niveles" required name="id_niveles" class="form-control">
													<option>Selecciona el nivel</option>
												<?php
													include('../conexi.php');
													$link = Conectarse();
													 
													$consulta = "SELECT * FROM niveles WHERE activo_niveles = 1";
													$resultado = mysqli_query($link,$consulta) or die('Error en la DB '.mysqli_error($link));
													
													while($row = mysqli_fetch_assoc($resultado)){
														$id_niveles = $row['id_niveles'];
														$nombre_niveles = $row['nombre_niveles'];
													?>
													<option value="<?php echo $id_niveles?>"><?php echo $nombre_niveles?></option>
													<?php 
														}
													?>
												</select>
											</div>
									
											<div class="form-group col-md-6">
												<label for="dia_corte" class="text-center">Día de Corte:</label>
												<input type="text" class="form-control" name="dia_corte" value="1" id="dia_corte">
											</div>
											<input type="checkbox" id ="usa_meses" name="usa_meses" value="1"> 
												
											<div class="form-group col-md-6 div_usa_meses">
												
													<label  for="usa_meses">Usa Meses</label> 
														
												<div class="checkbox">
													<label><input type="checkbox"  value="9">Septiembre</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="10">Octubre</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="11">Noviembre</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="12">Diciembre</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="1">Enero</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="2">Febrero</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="3">Marzo</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="4">Abril</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="5">Mayo</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="6">Junio</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value="7">Julio</label>
												</div>
											</div>
									
										
										
						
						<!--FIN DEL FORMULARIO -->
							<!--<input type="text" id="accion" name="accion" class="hidden">
							<input type="text" id="id_materias" name="id_materias" class="hidden">-->
						
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