<form id="form_edit" class="form">
	<div id="modal_edit" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Datos del Cliente</h4>	
				</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Id</label>
									<input type="text" readonly id="id_clientes" name="id_clientes" class="form-control">
									<input type="text" readonly  class="action hidden" value="insert">
								</div>
								<div class="form-group">
									<label for="">Razon Social</label>
									<input type="text" name="razon_social_clientes" id="razon_social_clientes" class="form-control">
								</div>
								<div class="form-group">
									<label for="">RFC</label>
									<input type="text" name="rfc_clientes" id="rfc_clientes" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Correo</label>
									<input type="email" name="correo_clientes" id="correo_clientes" class="form-control">
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