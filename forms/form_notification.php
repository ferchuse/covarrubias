<form id="form_nuevo_notification" class="form" >
		<div id="modal_nuevo_notification" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-center"></h4>
					</div>
				 
					<div class="modal-body">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="titulo" class="text-center">Titulo: </label>
										<input type="text" class="form-control" name="titulo" id="titulo">
									</div>
									<div class="form-group">
											<label for="subtitulo" class="text-center">Mensaje: </label>
											<textarea type="text" rows="10" class="form-control" name="subtitulo" id="subtitulo"></textarea>
									</div>
								</div>
							</div>
						</div>			
					</div>
				  <div class="modal-footer">
					
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							<i class="fa fa-times"></i> Cerrar
						</button>
						<button type="submit" class="btn btn-success"><i class="fa fa-envelope-o" aria-hidden="true"></i>
						Enviar
						</button>
									
				  </div>
				
				</div>
			</div>
		</div>
	</form>
	

