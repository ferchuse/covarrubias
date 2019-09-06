<form id="form_edicion" class="form">
	<div id="modal_edicion" class="modal fade " role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Nuevo Empleado</h4>	
				</div>
				<div class="modal-body">
					<div class="row">
						<div class=" col-sm-6">
							
							
							<div class="form-group ">
								<label for="">Num Empleado *</label>
								<input id="id_empleados"  type="text" name="id_empleados" class="form-control" placeholder="captura y presiona enter para buscar" autofocus="on">
							</div>
							<div class="form-group">
								<label for="">Nombre del Empleado *</label>
								<input id="nombre_empleados" placeholder="Escribe para Buscar" type="text" name="nombre_empleados" class="form-control"  value="">
							</div>
							<div class="form-group">
								<label for="">RFC</label>
								<input type="text" name="rfc_empleados" id="rfc_empleados" class="form-control" value="">
							</div>
							<div class="form-group">
								<label for="">CURP: *</label>
								<input  requiredd type="text" id="curp_empleados" name="curp_empleados" class="form-control" value="">
							</div>
							<div class="form-group">
								<label for="">NSS: *</label>
								<input  class="form-control"  id="nss" requiredd name="nss" value="">
							</div>
							<div class="form-group">
								<label for="">Correo: *</label>
								<input  class="form-control"  id="correo_empleados" requiredd name="correo_empleados" value="">
							</div>
						</div>
						<div class=" col-sm-6" >
							<div class="form-group">
								<label for="">Tipo de Contrato</label>
								<select id="tipo_contrato" name="tipo_contrato" class="form-control">
									<option value="">Seleccione...</option>
									<option selected value="01">01	Contrato de trabajo por tiempo indeterminado</option>
									<option value="02">02	Contrato de trabajo para obra determinada</option>
									<option  value="03">03	Contrato de trabajo por tiempo determinado</option>
									<option value="04">04	Contrato de trabajo por temporada</option>
									<option value="05">05	Contrato de trabajo sujeto a prueba</option>
									<option value="06">06	Contrato de trabajo con capacitación inicial</option>
									<option value="07">07	Modalidad de contratación por pago de hora laborada</option>
									<option value="08">08	Modalidad de trabajo por comisión laboral</option>
									<option value="09">09	Modalidades de contratación donde no existe relación de trabajo</option>
									<option value="10">10	Jubilación, pensión, retiro.</option>
									<option  value="99">99	Otro contrato</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Tipo de Régimen</label>
								<select id="tipo_regimen" name="tipo_regimen" class="form-control">
									<option value="">Seleccione...</option>
									<option value="02">02	Sueldos</option>
									<option value="03">03	Jubilados</option>
									<option  value="04">04	Pensionados</option>
									<option value="09">09	Asimilados Honorarios</option>
									<option value="13">09 Indemnización o Separación</option>
									
								</select>
							</div>
							<div class="form-group">
								<label for="">Salario base cotización: *</label>
								<input  class="form-control" type="number" step="any" id="salario_base" requiredd name="salario_base" >
							</div>
							<div class="form-group">
								<label for=""> Salario diario integrado: *</label>
								<input  class="form-control" type="number" step="any" id="salario_diario" requiredd name="salario_diario"  >
							</div>
							
							<div class="form-group">
								<label for=""> Fecha de Inicio Relación Laboral: </label>
								<input  class="form-control" type="date" id="fecha_inicio_laboral" requiredd name="fecha_inicio_laboral" value="" >
							</div>
							<div class="form-group">
								<label for=""> Antigüedad: </label>
								<input  class="form-control" type="text" id="antiguedad" placeholder="Opcional" name="antiguedad" value="" >
							</div>
							<div class="form-group">
								<label for=""> Riesgo: </label>
								<select id="riesgo" name="riesgo" class="form-control">
									<option value="">Seleccione</option>
									<option selected value="1">Clase I</option>
									<option value="2">Clase II</option>
									<option value="3">Clase III</option>
									<option value="4">Clase IV</option>
									<option value="5">Clase V</option>
									<option value="99">99	No aplica</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Periodicidad</label>
								<select id="periodicidad" name="periodicidad" class="form-control">
									<option value="01">01	Diario</option>
									<option value="02">02	Semanal</option>
									<option value="03">03	Catorcenal</option>
									<option selected value="04">04	Quincenal</option>
									<option value="05">05	Mensual</option>
									<option value="06">06	Bimestral</option>
									<option value="07">07	Unidad obra</option>
									<option value="08">08	Comisión</option>
									<option value="09">09	Precio alzado</option>
									<option value="10">10	Decenal</option>
									<option value="99">99	Otra Periodicidad</option>
								</select>
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
		</div>
	</div>
</form>