<?php 
include( "login/login_success.php"); 
include_once( "conexi.php"); 
$link = Conectarse(); 
$menu_activo= "administracion"; 
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASIGNACION DEL GRUPO</title>

    <?php include( "styles.php");?>
</head>

<body>
    <div class="container-fluid">
        <?php include( "menu.php");?>
    </div>
    <h2 class="text-center">Asignación del grupo</h2>
    <hr>
    <br>
    <br>
    <form id="form_todo">
        <div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<ul class="nav nav-wizard">
						<li class="active" id="c1"><a data-toggle="tab">Nivel</a>
						</li>
						<li id="c2"><a data-toggle="tab">Grado</a>
						</li>
						<li id="c3"><a data-toggle="tab">Alumnos</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="tab-content">
                <div id="uno" class="tab-pane fade in active">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<h3>Nivel</h3>
							<p>
								<select class="form-control" id="id_niveles" name="id_niveles">
									<option value="">Selecciona un nivel</option>
									<?php $consultarniveles="SELECT * FROM niveles WHERE activo_niveles = 1";
									$resultado= mysqli_query($link,$consultarniveles) or die( 'Error en la DB '.mysqli_error($link)); 
									while($row = mysqli_fetch_assoc($resultado)){ 
										$id_niveles = $row[ 'id_niveles']; 
										$nombre_niveles = $row[ 'nombre_niveles']; ?>
									<option value="<?php echo $id_niveles;?>">
										<?php echo $nombre_niveles; ?>
									</option>
									<?php } ?>
								</select>
							</p>
							<div class="pull-right">
								<button class="btn btn-success btn-lg" id="btn_uno" data-toggle="pill" href="#dos"><i class="fa fa-arrow-right"></i>
									Siguiente
								</button>
							</div>
						</div>
					</div>
                </div>
                <div id="dos" class="tab-pane fade">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<h3>Grados</h3>
							<p>
								<select class="form-control" id="id_grados" name="id_grados">
									<option value="">Selecciona un grado</option>
									<?php $consultargrados = "SELECT * FROM grados"; 
									$resultado= mysqli_query($link,$consultargrados) or die( 'Error en la DB '.mysqli_error($link));
									while($row = mysqli_fetch_assoc($resultado)){ 
										$id_grados = $row[ 'id_grados']; 
										$nombre_grados = $row['nombre_grados'];?>
									<option value="<?php echo $id_grados;?>">
										<?php echo $nombre_grados; ?>
									</option>
									<?php } ?>
								</select>
							</p>
							<div class="pull-right">
								<button class="btn btn-success btn-lg" id="btn_dos" data-toggle="pill" href="#tres"><i class="fa fa-arrow-right"></i>
									Siguiente
								</button>
							</div>
							<div class="pull-left">
								<button class="btn btn-success btn-lg" id="btn_tres" data-toggle="pill" href="#uno"><i class="fa fa-arrow-left"></i>
									Atras
								</button>
							</div>
						</div>
                    </div>
                </div>
                <div id="tres" class="tab-pane fade">
                    <h3>Alumnos</h3>
                    <div class="row">
                        <div class="col-md-11">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Nombre del alumno(a)
                                        </th>
                                        <th class="text-center">
                                            Sexo
                                        </th>
                                        <th class="text-center">
                                            Grado
                                        </th>
                                        <th class="text-center">
                                            Nivel
                                        </th>
                                        <th class="text-center">
                                            <div>
                                                Seleciona al alumno(a)
                                                <input type="checkbox" id="todos_checkbox" title="Seleccionar todos">
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="cuerpo">

                                </tbody>
                            </table>
                            <div class="pull-right">
                                <button class="btn btn-success btn-lg" id="btn_Agrupo" type="button"><i class="fa fa-check-square"></i>
                                    Finalizar
                                </button>
                            </div>
							<div class="pull-left">
								<button class="btn btn-success btn-lg" id="btn_cuatro" data-toggle="pill" href="#dos"><i class="fa fa-arrow-left"></i>
									Atras
								</button>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php include( "forms/form_asignacion_grupo.php"); ?>
    <?php include( 'scripts.php'); ?>
    <script src="js/asignacion.js"></script>

</body>

</html>
