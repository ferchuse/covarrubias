<form id="form_nuevo_maestro" class="form" >
		<div id="modal_nuevo_maestro" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-center">Nuevo Profesor</h4>
					</div>
				 
					<div class="modal-body">
		
						<div class="row">
							<div class="col-md-12">
								<!--INICIO FORMULARIO MAESTRO-->
								<div class="panel panel-primary">
										 <div class="panel-heading"><h4 class="text-center">DATOS PERSONALES DEL PROFESOR</h4></div>
										  <div class="panel-body">
										  
												<div class="row">
												<input type="text" id="id_maestros" name="id_maestros" class="hidden">
													<div class="col-md-4">
														<div class="form-group">
															<label for="nombre_maestro">Nombre(s):</label>
															<input type="text" class="form-control" name="nombre_maestro" id="nombre_maestro" required>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="paterno_maestro">Apellido Paterno:</label>
															<input type="text" class="form-control" name="paterno_maestro" id="paterno_maestro" required>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="materno_maestro">Apellido Materno:</label>
															<input type="text" class="form-control" name="materno_maestro" id="materno_maestro" required>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label for="nivel_maestro">Nivel academico:</label>
																<select class="form-control" id="nivel_maestro" name="nivel_maestro">
																	<option value="SELECCIONE">Seleccione</option>
																	<option value="NORMALISTA">Normalista</option>
																	<option value="LICENCIATURA">Licenciatura</option>
																	<option value="MAESTRIA">Maestria</option>
																	<option value="DOCTORADO">Doctorado</option>
																</select>
														</div>
													</div>
													 <div class="col-md-3">
														<div class="form-group">
															<label for="descarrera_maestro">Carrera:</label>
															<input readonly type="text" class="form-control" name="descarrera_maestro" id="descarrera_maestro" required>
														</div>
													</div> 
													<div class="col-md-3">
														<div class="form-group">
															<label for="correo_maestro">Correo electronico:</label>
															<input type="email" class="form-control" name="correo_maestro" id="correo_maestro">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="telefonofijo_maestro">Telefono fijo:</label>
															<input type="tel" class="form-control" name="telefonofijo_maestro" id="telefonofijo_maestro" required>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label for="telefonocelular_maestro">Telefono celular:</label>
															<input type="tel" class="form-control" name="telefonocelular_maestro" id="telefonocelular_maestro" required>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="telefonoreferencia_maestro">Telefono de referencia:</label>
															<input type="tel" class="form-control" name="telefonoreferencia_maestro" id="telefonoreferencia_maestro">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="domicilio_maestro">Domicilio:</label>
															<input type="text" class="form-control" name="domicilio_maestro" id="domicilio_maestro" required>
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label for="codigopostal_maestro">Codigo Postal:</label>
															<input type="number" class="form-control" name="codigopostal_maestro" id="codigopostal_maestro" required>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label for="colonia_maestro">Colonia:</label>
															<input type="text" class="form-control" name="colonia_maestro" id="colonia_maestro" required>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="municipio_maestro">Municipio:</label>
															<input type="text" class="form-control" name="municipio_maestro" id="municipio_maestro" required>
														</div>
													</div>
													
													<div class="col-md-3">
															<div class="form-group">
																<label for="estado_maestro">Estado:</label>
																 <select  class="form-control requerido"  name="estado_maestro" id="estado_maestro" required>
																		<OPTION VALUE="">Elige...</OPTION>
																		<OPTION VALUE="AGUASCALIENTES">AGUASCALIENTES</OPTION>
																		<OPTION VALUE="BAJA CALIFORNIA">BAJA CALIFORNIA</OPTION>
																		<OPTION VALUE="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</OPTION>
																		<OPTION VALUE="CAMPECHE">CAMPECHE</OPTION>
																		<OPTION VALUE="COAHUILA">COAHUILA</OPTION>
																		<OPTION VALUE="COLIMA">COLIMA</OPTION>
																		<OPTION VALUE="CHIAPAS">CHIAPAS</OPTION>
																		<OPTION VALUE="CHIHUAHUA">CHIHUAHUA</OPTION>
																		<OPTION VALUE="CUIDAD DE MÉXICO">CUIDAD DE MÉXICO</OPTION>
																		<OPTION VALUE="DURANGO">DURANGO</OPTION>
																		<OPTION VALUE="GUANAJUATO">GUANAJUATO</OPTION>
																		<OPTION VALUE="GUERRERO">GUERRERO</OPTION>
																		<OPTION VALUE="HIDALGO">HIDALGO</OPTION>
																		<OPTION VALUE="JALISCO">JALISCO</OPTION>
																		<OPTION VALUE="MÉXICO">MÉXICO</OPTION>
																		<OPTION VALUE="MICHOACÁN">MICHOACÁN</OPTION>
																		<OPTION VALUE="MORELOS">MORELOS</OPTION>
																		<OPTION VALUE="NAYARIT">NAYARIT</OPTION>
																		<OPTION VALUE="NUEVO LEÓN">NUEVO LEÓN</OPTION>
																		<OPTION VALUE="OAXACA">OAXACA</OPTION>
																		<OPTION VALUE="PUEBLA">PUEBLA</OPTION>
																		<OPTION VALUE="QUERÉTARO">QUERÉTARO</OPTION>
																		<OPTION VALUE="QUINTANA ROO">QUINTANA ROO</OPTION>
																		<OPTION VALUE="SAN LUIS POTOSÍ">SAN LUIS POTOSÍ</OPTION>
																		<OPTION VALUE="SINALOA">SINALOA</OPTION>
																		<OPTION VALUE="SONORA">SONORA</OPTION>
																		<OPTION VALUE="TABASCO">TABASCO</OPTION>
																		<OPTION VALUE="TAMAULIPAS">TAMAULIPAS</OPTION>
																		<OPTION VALUE="TLAXCALA">TLAXCALA</OPTION>
																		<OPTION VALUE="VERACRUZ">VERACRUZ</OPTION>
																		<OPTION VALUE="YUCATÁN">YUCATÁN</OPTION>
																		<OPTION VALUE="ZACATECAS">ZACATECAS</OPTION>
																	</select>
															</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="estadocivil_maestro">Estado Civil</label>
															<select class="form-control" name="estadocivil_maestro" id="estadocivil_maestro">
																<option value="SOLTERO">Soltero</option>
																<option value="CASADO">Casado</option>
															</select>
														</div>
													</div>
												</div>
										  </div>
								</div>
								<!--FIN DEL FORMULARIO MAESTRO-->
								
								<!--INICIO FORMULARIO DE DOCUMENTOS-->
								<div class="panel panel-primary">
										 <div class="panel-heading"><h4 class="text-center">DOCUMENTACION</h4></div>
										  <div class="panel-body">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Selecciona los documentos proporcionados</label>
																<div class="checkbox">
																	<label><input type="checkbox" id="dcurp_maestros" name="dcurp_maestros" value="1"> CURP</label>
																</div>
																<div class="checkbox">
																	<label><input type="checkbox" id="dacta_maestros" name="dacta_maestros" value="1"> Acta de nacimiento</label>
																</div>
																<div class="checkbox">
																	<label><input type="checkbox" id="dcelula_maestros" name="dcelula_maestros" value="1"> Cedula
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																	<input type="checkbox" id="dcomprobante_maestro" name="dcomprobante_maestro" value="1"> Comprobante de domicilio
																	</label>
																</div>
														</div>
													</div>
													
												</div>
										  
										  </div>
								</div>
								
								<!--<input type="text" id="accion" name="accion" class="hidden">-->
								
								<!--FIN DEL FORMULARIO DE DOCUMENTOS-->
								
							</div>			
						</div>		
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> Cerrar
					</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i>
					Guardar
					</button>			
				  </div>
				</div>
			</div>
		</div>
	</form>
	

