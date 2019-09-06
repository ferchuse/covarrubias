<form id="form_nueva_asignacion" class="form">
	<div id="modal_nueva_asignacion" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Asignar grupo</h4>	
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-body">
									
									<div class="form-group">
										<label for="id_grupos" class="text-center">Grupo:</label>
										<select class="form-control" id="id_grupos" required name="id_grupos" >
											<option value="">Elige un grupo</option>
											<?php
											$consultargrupo = "SELECT * FROM grupos LEFT JOIN niveles USING(id_niveles)";
											
											$resultado = mysqli_query($link,$consultargrupo) or die('Error en la DB '.mysqli_error($link));
											
											while($row = mysqli_fetch_assoc($resultado)){
												$id_value = $row['id_grupos'];
												$text = $row['nombre_grupos'];
												$text2 = $row['nombre_niveles'];
												?>
												<option value="<?php echo $id_value;?>"><?php echo $text."\n".$text2; ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label for="id_ciclos" class="text-center">Ciclo:</label>
										<select class="form-control" id="id_ciclos" required name="id_ciclos" >
											<option value="">Elige un Ciclo</option>
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