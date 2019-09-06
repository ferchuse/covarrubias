<form id="form_nueva_carrera" class="form">
	<div id="modal_nueva_carrera" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
<!--INICIO DEL MODAL -->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center"></h4>	
			</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
						<!--INICIO DEL FORMULARIO -->
							
								<div class="panel-boy">
									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label for="id_carreras" class="text-center">Id:</label>
												<input readonly type="text" class="form-control" name="id_carreras" id="id_carreras">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="nombre_carreras" class="text-center">Nombre de la carrera:</label>
												<input type="text" class="form-control" name="nombre_carreras" id="nombre_carreras">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="rvoe_carreras" class="text-center">RVOE:</label>
												<input type="text" class="form-control" name="rvoe_carreras" id="rvoe_carreras">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="id_niveles" class="text-center">Nivel:</label>
												<select required class="form-control" id="id_niveles" name="id_niveles">
												<option >Elige una opcion...</option>
												<?php  
												include("../conexi.php");
												$link=Conectarse();
												$consulta= "SELECT * FROM niveles";
												$resultado=mysqli_query($link,$consulta) or die("Error BD $consulta".mysqli_error($link));
												while($row=mysqli_fetch_assoc($resultado)){
													$id_niveles = $row['id_niveles'];
													$nombre_niveles = $row['nombre_niveles'];
												?>
													<option value="<?php echo $id_niveles;?>"><?php echo $nombre_niveles;?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
						<!--FIN DEL FORMULARIO -->
							<!--<input type="text" id="accion" name="accion" class="">
							<input type="text" id="id_carreras" name="id_carreras" class="">-->
						
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