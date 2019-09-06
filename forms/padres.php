<div class="panel panel-default">
<div class="panel-heading"><h4 class="text-center">PADRES</h4></div>

<div class="panel-body">
<form id="form_nuevo_padres" class="form">
	<!--INICIO DEL FORMULARIO -->
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="nombre_padres" class="text-center">Nombre (s):</label>
				<input type="text" class="form-control" name="nombre_padres" id="nombre_padres">
			</div>
		</div>
			<div class="col-xs-4">
				<div class="form-group">
					<label for="paterno_padres" class="text-center">Apellido paterno:</label>
					<input type="text" class="form-control" name="paterno_padres" id="paterno_padres">
				</div>
			</div>
				<div class="col-xs-4">
					<div class="form-group">
						<label for="materno_padres" class="text-center">Apellido materno:</label>
						<input type="text" class="form-control" name="materno_padres" id="materno_padres">
					</div>
				</div>
	</div>	
		<div class="row">
			<div class="col-xs-2">
				<div class="form-group">
					<label for="fecha_nacimiento" class="text-center">Fecha de nacimiento:</label>
					<input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento">
				</div>
			</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="curp_padres" class="text-center">CURP:</label><a href="" id="direccion_curp"> Consulta tu curp</a>
						<input type="text" class="form-control" name="curp_padres" id="curp_padres">
					</div>
				</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label for="sexo_padres">Sexo:</label>
							<select class="form-control" name="sexo_padres" id="sexo_padres">
								<option value="MASCULINO">Masculino</option>
								<option value="FEMENINO">Femenino</option>
							</select>
						</div>
					</div>
						<div class="col-xs-2">
							<div class="form-group">
								<label for="estado_civil">Estado civil:</label>
								<select class="form-control" name="estado_civil" id="estado_civil">
									<option value="CASADO">Casado</option>
									<option value="SOLTERO">Soltero</option>
									<option value="DIVORCIADO">Divorciado</option>
									<option value="VIUDO">Viudo</option>
								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<div class="form-group">
								<label for="correo_padres">Correo electronico:</label>
								<input type="email" class="form-control" name="correo_padres" id="correo_padres">
							</div>
						</div>
		</div>
			<div class="row">
				<div class="col-xs-4">
					<div class="form-group">
						<label for="domicilio_padres" class="text-center">Domicilio:</label>
						<input type="text" class="form-control" name="domicilio_padres" id="domicilio_padres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="colonia_padres" class="text-center">Colonia:</label>
						<input type="text" class="form-control" name="colonia_padres" id="colonia_padres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="municipio_padres" class="text-center">Municipio:</label>
						<input type="text" class="form-control" name="municipio_padres" id="municipio_padres">
					</div>
				</div>
					
			</div>
				<div class="row">
					<div class="col-xs-3">
							<div class="form-group">
								<label for="estado_padres">Estado:</label>
								<select class="form-control" name="estado_padres" id="estado_padres">
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
						<input type="number" class="form-control" name="codigopostal_padres" id="codigopostal_padres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="telefono_padres">Telefono:</label>
						<input type="tel" class="form-control" name="telefono_padres" id="telefono_padres">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
						<label for="telefonoreferencia_padres">Telefono de referencia:</label>
						<input type="tel" class="form-control" name="telefonoreferencia_padres" id="telefonoreferencia_padres">
					</div>
				</div>
				</div>
	<!--FIN DEL FORMULARIO -->
</form>
</div>
</div>