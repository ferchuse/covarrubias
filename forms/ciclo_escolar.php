<form id="form_nuevo_ciclo" class="form">
	<div id="modal_nuevo_ciclo" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
<!--- INICIO DEL MODAL-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;
					</button>
						<h4 class="modal-title text-center">Alta del ciclo escolar</h4>
				</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
						
								<div class="panel panel-default">
									<div class="panel-body">
												<div class="form-group">
												<input id="id_ciclos" class="hidden" name="id_ciclos">
													<label for="nombre_ciclos" class="text-center">Nombre del ciclo: </label>
													<input type="text" class="form-control" id="nombre_ciclos" name="nombre_ciclos">
												</div>
												<div class="form-group">
													<label for="inicio_fechas" class="text-center">Fecha Inicial: </label>
													<input type="date" class="form-control fecha" id="inicio_fechas" name="inicio_fechas">
												</div>
										
												<div class="form-group">
													<label for="fin_fechas" class="text-center">Fecha Final: </label>
													<input type="date" class="form-control fecha" id="fin_fechas" name="fin_fechas">
												</div>
												
												<div class="form-group">
													<label for="periodo_ciclos" class="text-center">Periodos: </label>
													<input type="number" class="form-control" id="periodo_ciclos" name="periodo_ciclos" min="1" max="12">
												</div>
												<div class="form-group">
													<label for="id_niveles">Nivel:</label>
													<select name="id_niveles" id="id_niveles" class="form-control">
														<option value="">Elije nivel ...</option>
														<?php
														$consulta = "SELECT * FROM niveles";
														
														$result = mysqli_query($link,$consulta) or die('Error en $consulta '.mysqli_error($link));
														
														while($row = mysqli_fetch_assoc($result)){
															$id_niveles = $row['id_niveles'];
															$nombre_niveles = $row['nombre_niveles'];
														?>
														<option value="<?php echo $id_niveles; ?>"><?php echo $nombre_niveles; ?></option>
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