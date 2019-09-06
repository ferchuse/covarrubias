<form id="form_nuevo_documento" class="form">
	<div id="modal_nuevo_documento" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
<!--INICIO DEL MODAL -->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title2 text-center"></h4>	
			</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
						<!--INICIO DEL FORMULARIO -->
						
										<div class="col-md-2 col-md-offset-3">
											<div class="form-group">
												<label for="id_documentacion" class="text-center">Id:</label>
												<input readonly type="text" class="form-control" name="id_documentacion" id="id_documentacion">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="nombre_documentacion" class="text-center">Documento:</label>
												<input type="text" class="form-control" name="nombre_documentacion" id="nombre_documentacion">
											</div>
										</div>
										<input type="text" name="id_niveles" id="id_niveles2" class="">
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