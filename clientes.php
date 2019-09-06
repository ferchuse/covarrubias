<?php
	include("login/login_success.php");
	include_once("conexi.php");
	$link = Conectarse();
	$menu_activo = "facturas";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clientes</title>

<?php include("styles.php");?>

</head>
<body>

<div class="container-fluid">
	<?php include("menu.php");?>
</div>

<div class="container">
	<h2 class="text-center">Clientes 
		
	<button type="button" class="btn btn-success pull-right" id="btn_insert">
			<i class="fa fa-plus" ></i> Agregar
	</button>	
	</h2>
	<hr>

		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th  class="text-center">Nombre</th>
							<th  class="text-center">RFC</th>
							<th  class="text-center">Alumnos Asignados</th>
							<th  class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody id="cuerpo">
						
					</tbody>
				</table>
			</div>
		</div>
	</form>
</div>
		
	
	<?php include('forms/clientes.php'); ?>
	
	<div id="modal_alumnos_asignados" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Alumnos Asignados</h4>	
				</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Agregar Alumno</label>
									<input type="text" id="id_clientes_asignado" class="hidden" >
									<input type="search" id="buscar_alumnos" class="form-control" placeholder="Escribe para buscar">
								</div>
							</div>
							</div>
						<hr>
						<div class="row">
							<div class="col-md-12" id="lista_alumnos_por_cliente">
								
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">
							<i class="fa fa-times"></i> 
							Cerrar
						</button>
					</div>
			</div>
		</div>
	</div>
	<?php  include('scripts.php'); ?>
	<script src="js/clientes.js"></script>
	
  </body>
</html>
