<form id="form_nuevo_materia" class="form">
	<div id="modal_nuevo_materia" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
<!--INICIO DEL MODAL -->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Nueva materia</h4>	
			</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
						<!--INICIO DEL FORMULARIO -->
						<div class="panel panel-default">
							
								<div class="panel-boy">
									<div class="row">
									<div class="col-md-2 col-md-offset-3">
											<div class="form-group">
												<label  for="id_materias" class="text-center">Id:</label>
												<input readonly type="text" class="form-control" name="id_materias" id="id_materias">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="nombre_materias" class="text-center">Nombre de la materia:</label>
												<input type="text" class="form-control" name="nombre_materias" id="nombre_materias">
											</div>
										</div>
									</div>
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