<form id="form_nuevo_maestromateria" class="form">
	<div id="modal_nuevo_maestromateria" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
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
												<input readonly type="text" class="hidden" name="id_materiasmaestros" id="id_materiasmaestros" >
										<!--<div class="col-md-4">-->
											<div class="form-group">
												<label for="id_materias" class="text-center">Materia(s):</label>
												<select required class="form-control" id="id_materias" name="id_materias" >
												<option >Elige una opcion...</option>
												<?php  
												include("../conexi.php");
												$link=Conectarse();
												$consulta= "SELECT * FROM materias";
												$resultado=mysqli_query($link,$consulta) or die("Error BD $consulta".mysqli_error($link));
												while($row=mysqli_fetch_assoc($resultado)){
													$id_materias = $row['id_materias'];
													$nombre_materias = $row['nombre_materias'];
												?>
													<option value="<?php echo $id_materias;?>"><?php echo $nombre_materias;?></option>
													<?php } ?>
												</select>
											</div>
										<!--</div>-->
										
						</div>
						<input type="text" name="id_maestros" id="id_maestros2" class="hidden">
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