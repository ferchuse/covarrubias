
<form id="form_nuevo_nivel" class="form" >
		<div id="modal_nuevo_nivel" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-center"></h4>
					</div>
				 
					<div class="modal-body">
						
							<div class="form-group">
								<label for="id_niveles">Id:</label>
								<input readonly type="text" name="id_niveles" id="id_niveles" class="form-control" >
							</div>
							<div class="form-group">
								<label for="nombre_niveles">Nivel de estudio:</label>
								<input type="text" name="nombre_niveles" id="nombre_niveles" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="activo_niveles">Activo</label>
								<select class="form-control" id="activo_niveles" name="activo_niveles">
									<option value="1">Activo</option>
									<option value="0">Inactivo</option>
								</select>								
							</div>
					</div>
						
										
				 
				  <div class="modal-footer">
					
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> Cerrar
					</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i>
					Guardar
					</button>
									
				  </div>
				
				</div>
			</div>
		</div>
	</form>
	

