<form id="form_nuevo_articulo" class="form">
	<div id="modal_nuevo_articulo" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
<!--INICIO DEL MODAL -->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Nuevo Artículo</h4>	
			</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
						<!--INICIO DEL FORMULARIO -->
						<div class="panel panel-default">
							
								<div class="panel-body">
									<div class="form-group">
												<input id="id_articulo" class="hidden" name="id_articulo">
													<label for="nombre_articulo" class="text-center">Nombre o Categoría: </label> 
													<input type="text" class="form-control" id="nombre_articulo" name="nombre_articulo" placeholder="EJ. UNIFORMES">
												</div>
												<div class="form-group">
													<label for="descripcion_articulo" class="text-center">Descripción: </label>
													<input type="text" class="form-control fecha" id="descripcion_articulo" name="descripcion_articulo" placeholder="EJ. PANTALON TALLA 10">
												</div>
												<div class="form-group">
													<label for="costo_articulo" class="text-center">Precio: </label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-dollar" ></i></span>
														<input type="number" class="form-control fecha" id="costo_articulo" name="costo_articulo" min="0">
													</div>
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
	
<!--FINAL DEL MODAL -->	
		</div>
	</div>
</form>