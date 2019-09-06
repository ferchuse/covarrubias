<?php
	include("login/login_success.php");
	include_once("conexi.php");
	$link = Conectarse();
	$menu_activo = "alumnos";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumnos</title>
		
		<?php include("styles.php");?>
		
	</head>
  <body>
		
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		
		<div class="container-fluid hidden-print">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">
						
						<span class="pull-left">
							<select class="form-control" name="id_ciclos" id="id_ciclos">
								<option value="4">2017-2018</option>
								<option value="5"  >2018-2019</option>
								<option value="6" selected >2019-2020</option>
							</select> 
						</span>
						Alumnos
						<span class="badge badge-success" id="cantidad_alumnos"></span>
						<span class="pull-right">
							<a href = "preinscripciones.php" class="btn btn-success" title="Agregar Nuevo Alumno">
								<i class="fa fa-plus" ></i> Agregar
							</a>
							<button class="btn btn-default" id="btn_imprimirAlumnos" title="Exportar a Exel">
								<i class="fa fa-file-excel-o" ></i> Exportar
							</button>
							<button  id="btn_credenciales" form="form_seleccionados" disabled class="btn btn-info" type="submit"  title="Generar Credenciales" >
								<i class="fa fa-id-card" ></i> Credenciales <span> </span>
							</button>
						</span>
					</h3>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<table class="table" id="lista_alumnos">
						<thead>
							<tr>
								<th  class="text-center">
									Nombre
								</th>
								<th  class="text-center">
									Nivel
								</th>
								
								<th  class="text-center">
									Grupo
								</th>
								<th  class="text-center">Estatus</th>
								<th  class="text-center">Acciones</th>
								<th  class="text-center">
									<label>
										<input  type="checkbox"  class="todos_checkbox"> Todos
									</label>
								</th>
							</tr>
							<tr class="no_exportar">
								<th>
									<input autofocus="" autocomplete="off" type="text" id="buscar_alumno" class="form-control filtro_texto" data-campo="nombre_alumno" placeholder="Escribe para buscar" data-indice="0">
								</th>
								<th>
									<select class="form-control" id="id_niveles" name="id_niveles" data-indice="1">
										<option value="">Todos</option>
										<?php
											$consultaNiveles = "SELECT * FROM niveles WHERE activo_niveles = 1";
											$resultado = mysqli_query($link,$consultaNiveles) or die ('Error en la BD'.mysqli_error($link));
											while($row = mysqli_fetch_assoc($resultado)){
												$id_niveles = $row['id_niveles'];
												$nombre_niveles = $row['nombre_niveles'];
											?>
											<option value="<?php echo $nombre_niveles;?>"><?php echo $nombre_niveles;?></option>
											<?php
											}
										?>
									</select>
								</th>
								
								<th>
									<select class="form-control" id="id_grupos" name="id_grupos" data-indice="3">
										<option value="">Todos</option>
										<?php
											$consultaGrupos = "SELECT * FROM grupos LEFT JOIN niveles ON grupos.id_niveles=niveles.id_niveles";
											$resultado = mysqli_query($link,$consultaGrupos) or die ('Error en la Bd'.mysqli_error($link));
											while($row = mysqli_fetch_assoc($resultado)){
												$id_grupos = $row['id_grupos'];
												$id_niveles = $row['id_niveles'];
												$nombre_niveles = $row['nombre_niveles'];
												$nombre_grupos = $row['nombre_grupos'];
											?>
											<option data-id_gruposniveles="<?php echo $id_niveles;?>" value="<?php echo $nombre_grupos." ".$nombre_niveles;?>"><?php echo $nombre_grupos." ".$nombre_niveles;?></option>
											<?php
											}
										?>
									</select>
								</th>
								<th>
									<select class="form-control" id="estatus_alumnos" name="estatus_alumnos" data-indice="4">
										<option value="">Todos</option>
										<option selected value="INSCRITO">INSCRITO</option>
										<option value="BAJA">BAJA</option>
									</select>
								</th>
								<th></th>
								<th>
									
								</th>
							</tr>
						</thead>
						<tbody id="cuerpo">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<form id="form_Alumnos">
		</form>
		
		
		<form id="form_seleccionados" class="" action="credenciales.php" method="GET">
		</form>
		
		<form id="form_cambiar_ciclo">
			<div id="modal_cambiar_ciclo" class="modal fade" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Promover de Ciclo</h4>
						</div>
						<div class="modal-body">
							
							<div class="form-group">
								<label for="">Alumno</label>
								<input type="text" class="form-control" id="nombre_alumnos" readonly>
								<input type="text" class="hidden" id="id_alumnos">
							</div>
							<div class="form-group">
								<label for="">Grado Anterior</label>
								<input type="text" class="form-control" id="grado_anterior" readonly>
							</div>
							<div class="form-group">
								<label for="">Reinscripción</label>
								<input type="text" class="form-control" name="reinscripcion" id="reinscripcion" readonly>
							</div>
							<div class="form-group">
								<label for="">Grupo:</label>
								<select required class="form-control" id="ciclo_id_grupos" name="id_grupos" data-indice="3">
									<option value="">Elige</option>
									<?php
										$consultaGrupos = "SELECT * FROM grupos LEFT JOIN niveles ON grupos.id_niveles=niveles.id_niveles";
										$resultado = mysqli_query($link,$consultaGrupos) or die ('Error en la Bd'.mysqli_error($link));
										while($row = mysqli_fetch_assoc($resultado)){
											$id_grupos = $row['id_grupos'];
											$id_niveles = $row['id_niveles'];
											$id_grados = $row['id_grados'];
											$nombre_niveles = $row['nombre_niveles'];
											$nombre_grupos = $row['nombre_grupos'];
										?>
										<option data-id_grados = "<?php echo $id_grados;?>" data-id_niveles = "<?php echo $id_niveles;?>" value="<?php echo $id_grupos;?>"><?php echo $nombre_grupos." ".$nombre_niveles;?></option>
										<?php
										}
									?>
									</select>
							</div>
							<DIV class="form-group">
								<label for="">Ciclo Escolar:</label>
								<select required class="form-control" id="ciclo_id_ciclos" name="id_ciclos" data-indice="3">
									<option value="">Elige</option>
									<?php
										$consultaGrupos = "SELECT * FROM ciclo_escolar ";
										$resultado = mysqli_query($link,$consultaGrupos) or die ('Error en la Bd'.mysqli_error($link));
										while($row = mysqli_fetch_assoc($resultado)){
											$id_ciclos = $row['id_ciclos'];
											$nombre_ciclos = $row['nombre_ciclos'];
										?>
										<option  selected value="<?php echo $id_ciclos; ?>"><?php echo $nombre_ciclos;?></option>
										<?php
										}
									?>
								</select>
							</DIV>
							<div class="form-group">
								<label for="">Plan de Pagos:</label>
								<select required class="form-control" id="id_plan" name="id_plan" required>
									<option value="">Elige...</option>
									<?php
										$consulta_costos = "SELECT * FROM costos LEFT JOIN niveles USING(id_niveles) WHERE costos_activo = 1 ";
										$resultado = mysqli_query($link,$consulta_costos) or die ('Error en la Bd'.mysqli_error($link));
										while($row = mysqli_fetch_assoc($resultado)){
										$id_costos= $row['id_costos'];
										$concepto_costos = $row['concepto_costos'];
										$cantidad_costos = $row['cantidad_costos'];
										$nombre_niveles = $row['nombre_niveles'];
										
										?>
										<option  value="<?php echo $id_costos;?>"><?php echo $nombre_niveles ." ". $concepto_costos." $".$cantidad_costos;?></option>
										<?php
										}
									?>
									</select>
									</div>
									
									
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
						<button type="submit" class="btn btn-success"  id="btn_guardar_ciclo">
							<i class="fa fa-save"></i> Guardar</button>
						</div>
					</div>
					
				</div>
			</div>
		</form>
		
		
		
		<?php  include('scripts.php'); ?>
		<script src="js/alumnos.js"></script>
		
		
		
	</body>
</html>
