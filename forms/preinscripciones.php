<form id="form_preinscripciones" class="was-validated">
				<!--INICIO DEL FORMULARIO DE ALUMNO-->
				<div class="panel panel-primary">
						 <div class="panel-heading"><h4 class="text-center">DATOS PERSONALES DEL ALUMNO</h4></div>
						  <div class="panel-body">
						  
							<input type="text" class="form-control hidden" name="id_alumnos" id="id_alumnos">
								<div class="row">
									<div class="col-xs-4">
										<div class="form-group">
											<label for="nombre_alumnos">Nombre(s): </label> <i class="fa fa-asterisk text-danger"></i>
											<input required type="text" class="form-control" name="nombre_alumnos" id="nombre_alumnos">
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="apellidop_alumnos">Apellido Paterno:</label> <i class="fa fa-asterisk text-danger"></i>
											<input required type="text" class="form-control" name="apellidop_alumnos" id="apellidop_alumnos">
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="apellidom_alumnos">Apellido Materno:</label> <i class="fa fa-asterisk text-danger"></i>
											<input required type="text" class="form-control" name="apellidom_alumnos" id="apellidom_alumnos">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
										<label for="dia">Dia:</label>
										<select  name="dia" id="dia" class="form-control" title="Dia de nacimiento">
											<option value=""></option>
												<?php 
													$i = 1;
													while ( $i <= 31 ) {
														if ( $i < 10 ) {
															$dia = '0' . $i;
														} 	
														else {
															$dia = $i;
														}
														echo "<option value='$dia'>$dia</option>";
														$i++;
													}
												?>
										</select>
									</div>
									<div class="col-md-2">
										<label for="mes">Mes:</label>
										<select  name="mes" id="mes" class="form-control" title="Mes de nacimiento">
											<option value=""></option>
										<?php 
											$meses = array(
												'01' => 'Enero',
												'02' => 'Febrero',
												'03' => 'Marzo',
												'04' => 'Abril',
												'05' => 'Mayo',
												'06' => 'Junio',
												'07' => 'Julio',
												'08' => 'Agosto',
												'09' => 'Septiembre',
												'10' => 'Octubre',
												'11' => 'Noviembre',
												'12' => 'Diciembre'
											);
											foreach ($meses as $num_mes => $mes) {
												echo "<option value='$num_mes'>$mes</option>";
											}
										?>
										</select>
									</div>
									<div class="col-md-1">
										<label for="año">A&ntildeo</label>
										<select  name="año" id="año" class="form-control" title="Año de nacimiento">
											<option value=""></option>
										<?php 
											$tope = date( 'Y' );
											$e_max = 15;
											$e_min = 0;
											
											$anyo = $tope - $e_min;
											while ( $anyo >= ( $tope - $e_max )) {
												echo "<option value='$anyo'>$anyo</option>";
												--$anyo;
											}
										?>
										</select>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="curp_alumnos">CURP:</label><a href="" class="direccion_curp"> Consulta tu curp</a>
											<input  type="text" class="form-control" name="curp_alumnos" id="curp_alumnos">
										</div>
									</div>
									<div class="col-xs-2">
										<div class="form-group">
											<label for="sexo_alumnos">Sexo:</label> <i class="fa fa-asterisk text-danger"></i>
											<select required class="form-control" name="sexo_alumnos" id="sexo_alumnos">
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
											<input  type="text" class="form-control" name="domicilio_alumnos" id="domicilio_alumnos">
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="colonia_alumnos">Colonia:</label>
											<input  type="text" class="form-control" name="colonia_alumnos" id="colonia_alumnos">
										</div>
									</div>
									<div class="col-xs-2">
										<div class="form-group">
											<label for="codpostal_alumnos">Codigo Postal:</label>
											<input  type="number" class="form-control" name="codpostal_alumnos" id="codpostal_alumnos">
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="localidad_alumnos">Localidad:</label>
											<input  type="text" class="form-control" name="localidad_alumnos" id="localidad_alumnos">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<div class="form-group">
											<label for="municipio_alumnos">Municipio:</label>
											<input  type="text" class="form-control" name="municipio_alumnos" id="municipio_alumnos">
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="estado_alumnos">Estado:</label> <i class="fa fa-asterisk text-danger"></i>
											 <select required class="form-control requerido"  name="estado_alumnos" id="estado_alumnos" >
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
														<OPTION selected VALUE="HIDALGO">HIDALGO</OPTION>
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
									<div class="col-xs-4">
										<div class="form-group">
											<label for="lugarnac_alumnos">Lugar de Nacimiento:</label>
											<input  type="text" class="form-control" name="lugarnac_alumnos" id="lugarnac_alumnos">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-2">
										<div class="form-group">
											<label for="discapacidad_alumnos">¿Tiene alguna discapacidad?</label><br>
											<input type="radio" id="discapacidad_alumnos" name="discapacidad_alumnos" value="SI"> Si 
											<input type="radio" checked id="discapacidad_alumnos" name="discapacidad_alumnos" value="NO"> No
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="desdiscapacidad_alumnos">¿Cúal?</label>
											<input type="text"  class="form-control" name="desdiscapacidad_alumnos" id="desdiscapacidad_alumnos">
										</div>
									</div>
									<div class="col-xs-2">
										<div class="form-group">
											<label for="extranjero_alumnos">¿Es extranjero?</label><br>
											<input type="radio" id="extranjero_alumnos" name="extranjero_alumnos" value="SI"> Si 
											<input type="radio" checked id="extranjero_alumnos" name="extranjero_alumnos" value="NO"> No
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="paisextranjero_alumnos">¿De qué pais?</label>
											<input type="text"  class="form-control" name="paisextranjero_alumnos" id="paisextranjero_alumnos">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-2">
									
										<label for="id_niveles">Nivel:</label> <i class="fa fa-asterisk text-danger"></i>
										<select required class="form-control" id="id_niveles" name="id_niveles">
										<option value="">Elije un nivel</option>
										<?php
										
										$consulta = "SELECT * FROM niveles WHERE activo_niveles = 1";
										
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
									<div class="col-xs-2" >
										<label for="id_grados">Grado:</label> <i class="fa fa-asterisk text-danger"></i>
										<select required class="form-control" id="id_grados" name="id_grados">
											<option value="">Elije un grado</option>
										</select>
									</div>
									<div class="col-xs-2" >
										<label for="id_grados">Grupo:</label> <i class="fa fa-asterisk text-danger"></i>
										<select required class="form-control" id="id_grupos" name="id_grupos">
											<option value="">Elije un grupo</option>
										</select>
									</div>
									<div class="col-xs-2">
									
										<label for="id_ciclos">Ciclo:</label> <i class="fa fa-asterisk text-danger"></i>
										<select required class="form-control" id="id_ciclos" name="id_ciclos">
										<?php
										
										$ciclo = "SELECT * FROM ciclo_escolar";
										
										$resultado = mysqli_query($link,$ciclo) or die('Error en consulta $ciclo '.mysqli_error($link));
										
											while($fila = mysqli_fetch_assoc($resultado)){
													$id_ciclos = $fila['id_ciclos'];
													$nombre_ciclos = $fila['nombre_ciclos'];
										?>
											<option selected id-nombre="<?php echo $nombre_ciclos; ?>" value="<?php echo $id_ciclos;?>"><?php echo $nombre_ciclos;?></option>
											<?php 
											}
											?>
										</select>
									</div>
									<div class="col-xs-2">
										<label for="id_descuentos">Becas: </label>
										<select class="form-control" id="id_descuentos" name="id_descuentos">
											<option value="">Ninguna</option>
											<?php
												$consulta = "SELECT * FROM descuentos";
												$resultado = mysqli_query($link,$consulta) or die('Error en consulta').mysqli_error($link);
												while($row = mysqli_fetch_assoc($resultado)){
													$id_descuentos = $row['id_descuentos'];
													$nombre_descuentos = $row['nombre_descuentos'];
											?>
												<option value="<?php echo $id_descuentos;?>"><?php echo $nombre_descuentos;?></option>
											<?php
												}
											?>
										</select>
									</div>
									<div class="col-xs-2">
										<label for="id_costos">Plan de pago: </label> <i class="fa fa-asterisk text-danger"></i>
										<select required class="form-control" id="id_costos" name="id_costos">
											<option value="">Elige...</option>											
										</select>
									</div>
								</div>
						  </div>
				</div>
				<!--FIN DEL FORMULARIO DE ALUMNO-->
		
						<!--FORMULARIO PADRES-->
						<div class="panel panel-primary">
						 <div class="panel-heading"><h4 class="text-center">DATOS DEL PADRE</h4></div>
						  <div class="panel-body">
	<!--INICIO DEL FORMULARIO -->
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="nombre_padres" class="text-center">Nombre (s):</label>
				<input  type="text" class="form-control" name="nombre_padres" id="nombre_padres">
			</div>
		</div>
			<div class="col-xs-4">
				<div class="form-group">
					<label for="paterno_padres" class="text-center">Apellido paterno:</label>
					<input  type="text" class="form-control" name="paterno_padres" id="paterno_padres">
				</div>
			</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label for="materno_padres" class="text-center">Apellido materno:</label>
						<input  type="text" class="form-control" name="materno_padres" id="materno_padres">
					</div>
				</div>
	</div>	
		<div class="row">
			<div class="col-xs-2">
				<div class="form-group">
					<label for="fecha_nacimiento" class="text-center">Fecha de nacimiento:</label>
					<input  type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento">
				</div>
			</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="curp_padres" class="text-center">CURP:</label><a href="" class="direccion_curp"> Consulta tu curp</a>
						<input  type="text" class="form-control" name="curp_padres" id="curp_padres">
					</div>
				</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label for="sexo_padres">Sexo:</label>
							<select selected class="form-control" name="sexo_padres" id="sexo_padres">
								<option value="MASCULINO">Masculino</option>
								<option value="FEMENINO">Femenino</option>
							</select>
						</div>
					</div>
						<div class="col-xs-3">
							<div class="form-group">
								<label for="correo_padres">Correo electronico:</label>
								<input  type="email" class="form-control" name="correo_padres" id="correo_padres">
							</div>
						</div>
		</div>
			<div class="row">
				<div class="col-xs-4">
					<div class="form-group">
						<label for="domicilio_padres" class="text-center">Domicilio:</label>
						<input  type="text" class="form-control" name="domicilio_padres" id="domicilio_padres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="colonia_padres" class="text-center">Colonia:</label>
						<input  type="text" class="form-control" name="colonia_padres" id="colonia_padres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="municipio_padres" class="text-center">Municipio:</label>
						<input  type="text" class="form-control" name="municipio_padres" id="municipio_padres">
					</div>
				</div>
					
			</div>
				<div class="row">
					<div class="col-xs-3">
							<div class="form-group">
								<label for="estado_padres">Estado:</label>
								<select  class="form-control" name="estado_padres" id="estado_padres">
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
				<div class="col-xs-2">
					<div class="form-group">
						<label for="codigopostal_padres" class="text-center">Codigo Postal:</label>
						<input  type="number" class="form-control" name="codigopostal_padres" id="codigopostal_padres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="telefono_padres">Telefono:</label>
						<input  type="tel" class="form-control" name="telefono_padres" id="telefono_padres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="telefonoreferencia_padres">Telefono de referencia:</label>
						<input  type="tel" class="form-control" name="telefonoreferencia_padres" id="telefonoreferencia_padres">
					</div>
				</div>
			</div>
	<!--FIN DEL FORMULARIO -->
	</div>
</div>

	<div class="panel panel-primary">
						 <div class="panel-heading"><h4 class="text-center">DATOS DE LA MADRE</h4></div>
						  <div class="panel-body">
	<!--INICIO DEL FORMULARIO -->
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="nombre_madres" class="text-center">Nombre (s):</label>
				<input  type="text" class="form-control" name="nombre_madres" id="nombre_madres">
			</div>
		</div>
			<div class="col-xs-4">
				<div class="form-group">
					<label for="paterno_madres" class="text-center">Apellido paterno:</label>
					<input  type="text" class="form-control" name="paterno_madres" id="paterno_madres">
				</div>
			</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label for="materno_madres" class="text-center">Apellido materno:</label>
						<input  type="text" class="form-control" name="materno_madres" id="materno_madres">
					</div>
				</div>
	</div>	
		<div class="row">
			<div class="col-xs-2">
				<div class="form-group">
					<label for="fecha_nacimientom" class="text-center">Fecha de nacimiento:</label>
					<input  type="date" class="form-control" name="fecha_nacimientom" id="fecha_nacimientom">
				</div>
			</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="curp_madres" class="text-center">CURP:</label><a href="" class="direccion_curp"> Consulta tu curp</a>
						<input  type="text" class="form-control" name="curp_madres" id="curp_madres">
					</div>
				</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label for="sexo_madres">Sexo:</label>
							<select selected class="form-control" name="sexo_madres" id="sexo_madres">
								<option value="MASCULINO">Masculino</option>
								<option value="FEMENINO">Femenino</option>
							</select>
						</div>
					</div>
						<div class="col-xs-3">
							<div class="form-group">
								<label for="correo_madres">Correo electronico:</label>
								<input  type="email" class="form-control" name="correo_madres" id="correo_madres">
							</div>
						</div>
		</div>
			<div class="row">
				<div class="col-xs-4">
					<div class="form-group">
						<label for="domicilio_madres" class="text-center">Domicilio:</label>
						<input  type="text" class="form-control" name="domicilio_madres" id="domicilio_madres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="colonia_madres" class="text-center">Colonia:</label>
						<input  type="text" class="form-control" name="colonia_madres" id="colonia_madres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="municipio_madres" class="text-center">Municipio:</label>
						<input  type="text" class="form-control" name="municipio_madres" id="municipio_madres">
					</div>
				</div>
					
			</div>
				<div class="row">
					<div class="col-xs-3">
							<div class="form-group">
								<label for="estado_madres">Estado:</label>
								<select  class="form-control" name="estado_madres" id="estado_madres">
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
				<div class="col-xs-2">
					<div class="form-group">
						<label for="codigopostal_madres" class="text-center">Codigo Postal:</label>
						<input  type="number" class="form-control" name="codigopostal_madres" id="codigopostal_madres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="telefono_madres">Telefono:</label>
						<input  type="tel" class="form-control" name="telefono_madres" id="telefono_madres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="telefonoreferencia_madres">Telefono de referencia:</label>
						<input  type="tel" class="form-control" name="telefonoreferencia_madres" id="telefonoreferencia_madres">
					</div>
				</div>
			</div>
	<!--FIN DEL FORMULARIO -->
	</div>
</div>
					
					
			<div class="panel panel-primary">
				<div class="panel-heading"><h4 class="text-center">DATOS DE PERSONAS AUTORIZADAS</h4></div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-8">
							<label for="nombre_autorizada">Nombre:</label>
							<input type="text" class="form-control" name="nombre_autorizada[]">
						</div>
						<div class="col-xs-4">
							<label for="parentesco_autorizada">Parentesco:</label>
							<input  type="text" class="form-control" name="parentesco_autorizada[]">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<label for="nombre_autorizada">Nombre:</label>
							<input type="text" class="form-control" name="nombre_autorizada[]">
						</div>
						<div class="col-xs-4">
							<label for="parentesco_autorizada">Parentesco:</label>
							<input type="text" class="form-control" name="parentesco_autorizada[]">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<label for="nombre_autorizada">Nombre:</label>
							<input type="text" class="form-control" name="nombre_autorizada[]">
						</div>
						<div class="col-xs-4">
							<label for="parentesco_autorizada">Parentesco:</label>
							<input type="text" class="form-control" name="parentesco_autorizada[]">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<label for="nombre_autorizada">Nombre:</label>
							<input type="text" class="form-control" name="nombre_autorizada[]">
						</div>
						<div class="col-xs-4">
							<label for="parentesco_autorizada">Parentesco:</label>
							<input type="text" class="form-control" name="parentesco_autorizada[]">
						</div>
					</div>
				</div>
			</div>						  
				
					<div class="row">
						<div class=" col-xs-12 text-center">
							<button type="submit" class="btn btn-success btn-lg hidden-print"  id="btn_alta">
									<i class="fa fa-save" ></i> Guardar 
							</button>
						</div>
					</div>
</form>
				<!--FIN DEL FORMULARIO PADRES-->
			
