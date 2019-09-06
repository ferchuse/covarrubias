<?php date_default_timezone_set('America/Mexico_City');
	
	function permisos($seccion){
		
		if($_SESSION["permisos"] == "Contabilidad"){
			switch($seccion){
				
				case 'facturacion';
				
				return "";
				break;
				default:
				return " hidden ";
				break;
				
			}
		}
	}	
?>
<div class="row">
	<nav class="navbar navbar-default " >
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button> 
			
			<a class="navbar-brand hide" href="#"></a>
		</div>
		
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
			<ul class="nav navbar-nav">
				<li  class="<?php echo $menu_activo == "principal" ? "active": '' .permisos("inicio");?>">
					<a href="/" >
						<i class="fa fa-home" aria-hidden="true"></i> Inicio	 
					</a>
				</li>
				
				<li  class="hidden <?php echo $menu_activo == "maestros" ? "active": ''.permisos("inicio") ;?>"> 
					<a href="/maestros.php" >
						<i class="fa fa-users" ></i> Maestros	
					</a>
				</li>
				
				
				
				
				<li class="dropdown <?php echo $menu_activo == "alumnos" ? "active": '' .permisos("inicio");?>">
					<a href="/alumnos.php">
						<i class="fa fa-graduation-cap" ></i> Alumnos 
					</a>
					<ul class="dropdown-menu hidden">
						<li>
							<a href="/preinscripciones.php"><i class="fa fa-file-text" aria-hidden="true"></i> Preinscripciones</a>
						</li>
						<li>
							<a href="/alumnos.php"><i class="fa fa-graduation-cap" ></i>Lista de Alumnos</a>
						</li>
					</ul>
				</li>
				
				<li class="dropdown <?php echo $menu_activo == "control" ? "active": ''.permisos("inicio") ;?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-list" ></i> Catálogos <strong class="caret"></strong>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="/articulos_varios.php"><i class="fa fa-th-large" aria-hidden="true"></i> Articulos Varios</a>
						</li>
						<li>
							<a href="/costos.php"><i class="fa fa-dollar" ></i> Costos de Colegiaturas</a>
						</li>
						<li>
							<a href="/becas.php"><i class="fa fa-percent" aria-hidden="true"></i> Becas</a>
						</li>
						<li class="hidden">
							<a href="/carreras.php"><i class="fa fa-file-text" aria-hidden="true"></i> Carreras</a>
						</li>
						<li>
							<a href="/ciclo_escolar.php"><i class="fa fa-calendar" aria-hidden="true"></i> Ciclo Escolar</a>
						</li>
						<li class="hidden">
							<a href="/materias.php"><i class="fa fa-book" aria-hidden="true"></i> Materias</a>
						</li>
						<li>
							<a href="/grupos.php"><i class="fa fa-th-list" aria-hidden="true"></i> Grupos</a>
						</li>
						<li>
							<a href="/niveles.php"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i> Niveles</a>
						</li>
						
						
						
						
					</ul>
				</li>
				
				<li class="dropdown <?php echo $menu_activo == "administracion" ? "active": '' .permisos("inicio");?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-money" aria-hidden="true"></i> Administracion <strong class="caret"></strong>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="/asignacion_grupo.php">
								<i class="fa fa-check-square" ></i> Asignación de Grupo
							</a>
						</li>
						
						<li>
							<a href="/pagos.php"><i class="fa fw fa-shopping-bag"></i> Venta de Articulos</a>
						</li>
						
						<li class="hidden">
							<a href="/mensajes.php">
								<i class="fa fw fa-bell-o" aria-hidden="true"></i> Notificaciones
							</a>
						</li>
						<li>
							<a href="/egresos.php">
								<i class="fa fw fa-usd" ></i> Egresos 
							</a>
						</li>
						<li>
							<a href="/preinscripciones.php">
								<i class="fa fw fa-usd" ></i> Preinscripciones 
							</a>
						</li>
						
						
					</ul>
				</li>
				<li class="dropdown <?php echo $menu_activo == "reportes" ? "active": '' .permisos("inicio");?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bar-chart" ></i> Reportes <strong class="caret"></strong>
					</a>
					<ul class="dropdown-menu">
						
						<li>
							<a href="/reportes.php"><i class="fa fa-dollar" ></i> Reporte Mensual</a>
						</li>
						<li>
							<a href="/reporte_colegiaturas.php"><i class="fa fa-dollar" ></i> Colegiaturas por Grupo</a>
						</li>
						<li>
							<a href="/reportesEgresos.php"><i class="fa fa-dollar" ></i> Reporte de Egresos</a>
						</li>
						<li>
							<a href="/reportesdeudores.php"><i class="fa fa-dollar" ></i> Reporte de Deudores</a>
						</li>
						
						<li>
							<a href="/paginas/reportes/becados.php"><i class="fa fa-percent" ></i> Reporte de Becados</a>
						</li>
						
						
						
					</ul>
				</li>
				<li class="dropdown <?php echo $menu_activo == "facturas" ? "active": '' .permisos("facturacion");?>">
					<a  href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-dollar" ></i> Facturación 
						<span title="Folios Restantes" class="badge badge-default" id="span_folios_restantes"></span>
						<input type="hidden" id="folios_restantes_emisores" value=""/>
						<strong class="caret"></strong>
					</a>
					<ul class="dropdown-menu">
						
						<li>
							<a href="/facturas_nueva.php">
								<i class="fa fa-plus" ></i> Nueva Factura
							</a>
						</li>
						<li>
							<a href="/nominas.php">
								<i class="fa fa-user-plus" ></i> Nóminas
							</a>
						</li>
						<li>
							<a href="/empleados.php">
								<i class="fa fa-users" ></i> Empleados
							</a>
						</li>
						<li>
							<a href="/factura_global.php">
								<i class="fa fa-globe"></i> Factura Global
							</a>
						</li>
						<li>
							<a href="/clientes.php">
								<i class="fa fa-users" ></i> Clientes
							</a>
						</li>
						<li>
							<a href="/facturas.php">
								<i class="fa fa-table" ></i> Facturas
							</a>
						</li>
						<li class="hidden">
							<a href="#">
								<i class="fa fa-certificate"></i> Datos Fiscales
							</a>
						</li>
					</ul>
				</li>
				
				<?php 
					//}	
				?>
				
			</ul>
			
			<form class="navbar-form navbar-left form-inline" role="search" method="GET" action="/imprimir_pago.php">
				<div class="input-group navbar-search">
					
					<input class="form-control" id="" required name="folio_pago" type="text" placeholder="Buscar Folio"/>
					<div class="input-group-btn">
						<button type="submit" class="btn btn-default">
							<i class="fa fa-search"></i> 
						</button>
					</div> 
				</div>         
			</form>
			
			
			
			<ul class="nav navbar-nav navbar-right">
				<li class="hidden">
					
					<a href="#">
						<i class="fa fa-clock-o"></i> Turno:
						<span ><?php //echo $_SESSION["turno"]?></span> 
						<input type="hidden" id="turno" value="<?php //echo $_SESSION["turno"]?>">
						
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-user"></i>
						<span id="menu_nombre_usuario">
							<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?>
						</span> 
						<strong class="caret"></strong>
						<input type="hidden" id="id_usuarios" value="<?php echo isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : "" ;?>">
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="login/logout.php"><i class="fa fa-sign-out"></i> Salir</a>
						</li>
						
					</ul>
				</li>
			</ul>
			
		</div>
	</nav>
</div>
<pre hidden>
	<?php 
		echo var_dump($_COOKIE);
		echo $_COOKIE["id_usuario"];
		echo $_COOKIE["username"];
		echo $_COOKIE["permisos"];
		
	?>
</pre>


