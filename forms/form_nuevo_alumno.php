<form id="form_nuevo_alumno" class="form">
	<div id="modal_nuevo_alumno" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Nuevo Alumno</h4>	
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nombre_alumnos">Nombre(s):</label>
								<input required type="text" class="form-control" name="nombre_alumnos" id="nombre_alumnos">
							</div>
							<div class="form-group">
								<label for="apellidop_alumnos">Apellido Paterno:</label>
								<input required type="text" class="form-control" name="apellidop_alumnos" id="apellidop_alumnos">
							</div>
							<div class="form-group">
								<label for="apellidom_alumnos">Apellido Materno:</label>
								<input required type="text" class="form-control" name="apellidom_alumnos" id="apellidom_alumnos">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="nuevo_id_niveles">Selecciona el nivel:</label>
								<select required class="form-control" id="nuevo_id_niveles" >
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
							
							<div class="form-group" >
								<label for="nuevo_id_grados">Selecciona el grado:</label>
								<select required class="form-control" id="nuevo_id_grados" name="id_grados">
									<option value="">Elije un grado</option>
								</select>
							</div>
							<div class="form-group">
								<label for="nuevo_id_grupos" class="text-center">Grupo:</label>
								<select required class="form-control" id="nuevo_id_grupos"   >
									<option value="">Elige un grupo</option>
									
								</select>
							</div>
							<div class="form-group">
								<label for="nuevo_id_ciclos" class="text-center">Ciclo:</label>
								<select class="form-control" id="nuevo_id_ciclos" required  >
									
									<?php
									$consultarciclo = "SELECT * FROM ciclo_escolar";
									
									$resultado = mysqli_query($link,$consultarciclo) or die('Error en la DB '.mysqli_error($link));
									
									while($row = mysqli_fetch_assoc($resultado)){
										$id_value = $row['id_ciclos'];
										$text = $row['nombre_ciclos'];
										?>
										<option value="<?php echo $id_value;?>"><?php echo $text; ?></option>
									<?php
									}
									?>
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
							<i class="fa fa-save" ></i> 
							Guardar
						</button>
				</div>
			</div>
		</div>
	</div>
</form>