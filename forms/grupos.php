<form id="form_nuevo_grupo" class="form">
	<div id="modal_nuevo_grupo" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Nuevo Grupo</h4>	
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group">
										<label  for="id_grupos" class="text-center">Id:</label>
										<input readonly type="text" class="form-control" name="id_grupos" id="id_grupos">
									</div>
									<div class="form-group">
										<label for="nombre_grupos" class="text-center">Nombre del grupo:</label>
										<input type="text" placeholder="Ejemplo: 3° A" required class="form-control" name="nombre_grupos" id="nombre_grupos">
									</div>
									<div class="form-group">
										<label for="id_grados" class="text-center">Nivel:</label>
										<select class="form-control" id="id_niveles" required name="id_niveles" >
											<option value="">Elige un Nivel</option>
											<?php
											$consultarniveles = "SELECT * FROM niveles WHERE activo_niveles = 1";
											
											$resultado = mysqli_query($link,$consultarniveles) or die('Error en la DB '.mysqli_error($link));
											
											while($row = mysqli_fetch_assoc($resultado)){
												$id_value = $row['id_niveles'];
												$option_text = $row['nombre_niveles'];
												?>
												<option value="<?php echo $id_value;?>"><?php echo $option_text; ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label for="id_grados" class="text-center">Grado:</label>
										<select class="form-control" id="id_grados" disabled required name="id_grados" >
											<option value="">Elige un Grado</option>
											<?php
											$consultargrados = "SELECT * FROM grados";
											
											$resultado = mysqli_query($link,$consultargrados) or die('Error en la DB '.mysqli_error($link));
											
											while($row = mysqli_fetch_assoc($resultado)){
												$id_grados = $row['id_grados'];
												$nombre_grados = $row['nombre_grados'];
												?>
												<option value="<?php echo $id_grados;?>"><?php echo $nombre_grados; ?></option>
											<?php
											}
											?>
										</select>
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
		</div>
	</div>
</form>