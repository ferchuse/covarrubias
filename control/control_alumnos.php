<form id="form_alumno" class="form" >
		<div id="modal_alumno" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-center">Aspirante</h4>
					</div>
				 
					<div class="modal-body">
		
						<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
			
				<!--INICIO DEL FORMULARIO DE ALUMNO-->
				<div class="panel panel-default">
						 <div class="panel-heading"><h4 class="text-center">DATOS PERSONALES DEL ASPIRANTE</h4></div>
						  <div class="panel-body">
								
								<form id="form_preinscripciones">
							<input type="text" class="form-control hidden" name="id_alumnos" id="id_alumnos">
								<div class="row">
									<div class="col-xs-4">
										<div class="form-group">
											<label for="nombre_alumnos">Nombre(s):</label>
											<input type="text" class="form-control" name="nombre_alumnos" id="nombre_alumnos">
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="apellidop_alumnos">Apellido Paterno:</label>
											<input type="text" class="form-control" name="apellidop_alumnos" id="apellidop_alumnos">
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="apellidom_alumnos">Apellido Materno:</label>
											<input type="text" class="form-control" name="apellidom_alumnos" id="apellidom_alumnos">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-2">
										<div class="form-group">
											<label for="fechanac_alumnos">Fecha de Nacimiento:</label>
											<input type="date" class="form-control" name="fechanac_alumnos" id="fechanac_alumnos">
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="lugarnac_alumnos">Lugar de Nacimiento:</label>
											<input type="text" class="form-control" name="lugarnac_alumnos" id="lugarnac_alumnos">
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="curp_alumnos">CURP:</label><a href="" id="direccion_curp"> Consulta tu curp</a>
											<input type="text" class="form-control" name="curp_alumnos" id="curp_alumnos">
										</div>
									</div>
									<div class="col-xs-2">
										<div class="form-group">
											<label for="sexo_alumnos">Sexo:</label>
											<select class="form-control" name="sexo_alumnos" id="sexo_alumnos">
												<option value="MASCULINO">Masculino</option>
												<option value="FEMENINO">Femenino</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-4">
										<div class="form-group">
											<label for="domicilio_alumnos">Domicilio:</label>
											<input type="text" class="form-control" name="domicilio_alumnos" id="domicilio_alumnos">
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="colonia_alumnos">Colonia:</label>
											<input type="text" class="form-control" name="colonia_alumnos" id="colonia_alumnos">
										</div>
									</div>
									<div class="col-xs-2">
										<div class="form-group">
											<label for="codpostal_alumnos">Codigo Postal:</label>
											<input type="number" class="form-control" name="codpostal_alumnos" id="codpostal_alumnos">
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="localidad_alumnos">Localidad:</label>
											<input type="text" class="form-control" name="localidad_alumnos" id="localidad_alumnos">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<div class="form-group">
											<label for="municipio_alumnos">Municipio:</label>
											<input type="text" class="form-control" name="municipio_alumnos" id="municipio_alumnos">
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="estado_alumnos">Estado:</label>
											 <select  class="form-control requerido"  name="estado_alumnos" id="estado_alumnos" required>
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
								</div>
								<div class="row">
									<div class="col-xs-2">
										<div class="form-group">
											<label for="discapacidad_alumnos">¿Tiene alguna discapacidad?</label><br>
											<input type="radio" id="discapacidad_alumnos1" name="discapacidad_alumnos" value="SI"> Si 
											<input type="radio" id="discapacidad_alumnos2" name="discapacidad_alumnos" value="NO"> No
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="desdiscapacidad_alumnos">¿C&uacuteal?</label>
											<input type="text" class="form-control" name="desdiscapacidad_alumnos" id="desdiscapacidad_alumnos">
										</div>
									</div>
									<div class="col-xs-2">
										<div class="form-group">
											<label for="extranjero_alumnos">¿Es extranjero?</label><br>
											<input type="radio" id="extranjero_alumnos1" name="extranjero_alumnos" value="SI"> Si 
											<input type="radio" id="extranjero_alumnos2" name="extranjero_alumnos" value="NO"> No
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="paisextranjero_alumnos">¿De qu&eacute pais?</label>
											<input type="text" class="form-control" name="paisextranjero_alumnos" id="paisextranjero_alumnos">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
									<label for="id_niveles">Selecciona el nivel:</label>
										<select class="form-control" id="id_niveles" name="id_niveles">
										<option value="">Elije una carrera</option>
										<?php
										include('../conexi.php');
										$conex = Conectarse();
										
										$consulta = "SELECT * FROM niveles";
										
										$resultado = mysqli_query($link,$consulta) or die('Error en consulta $consulta '.mysqli_error($link));
										
											while($fila = mysqli_fetch_assoc($resultado)){
													$id_niveles = $fila['id_niveles'];
													$nombre_niveles = $fila['nombre_niveles'];
										?>
											<option data-id_nivel="<?php echo $id_niveles;?>" value="<?php echo $id_niveles;?>"><?php echo $nombre_niveles;?></option>
											<?php 
											}
											?>
										</select>
									</div>
									<div class="col-xs-6" id="opcion_carrera">
									</div>
								</div>
							</form>
						  
								
				</div>
				<!--FIN DEL FORMULARIO DE ALUMNO-->
				
				
			</div>			
		</div>
	</div>


										
				  </div>
				  <div class="modal-footer">
					
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> Cerrar
					</button>
					<button type="button" class="btn btn-success btn-editar"><i class="fa fa-save" aria-hidden="true"></i>
						Guardar Cambios
					</button>
					<button type="button" class="btn btn-info btn-inscribir"><i class="fa fa-share" aria-hidden="true"></i>
						Dar de alta
					</button>
									
				  </div>
				
				</div>
			</div>
		</div>
	</form>
	







	