<aside class="main-sidebar" style="<?php if(isset($_SESSION['sidebar'])){echo 'padding-top: 50px;'; } ?>" ><!-- Left side column. contains the logo and sidebar -->
	<section class="sidebar"><!-- sidebar: style can be found in sidebar.less -->
		<div class="user-panel"><!-- Sidebar user panel -->
			<div class="pull-left image">
				<img src="images/profiles/<?php echo $profile_pic ?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $name." ".$lastname ?></p>
				<!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
				<a href="#">
					<?php 
						if ($is_admin==1) {
						   echo " Administrador";
						}else if($soy_supervisor==1){
						 	echo " Supervisor";
						}else{
							echo " Agente";
						}
					?>
				</a>
			</div>
		</div>
		<ul class="sidebar-menu"><!-- sidebar menu: : style can be found in sidebar.less -->
			<li class="header">MENU</li>
			<li class="<?php if(isset($active1)){echo $active1;}?>">
				<a href="?view=dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="<?php if(isset($active1_1)){echo $active1_1;}?>">
				<a href="?view=addticket">
					<i class="fa fa-plus"></i> <span>Crear Ticket</span>
				</a>
			</li>
			<?php if($is_admin==1 or $soy_supervisor>=1 or $soy_agente==1){?>
			<li class="treeview <?php if(isset($active2)){echo $active2;}?>">
				<a href="#">
					<i class="fa fa-ticket"></i> <span>TICKETS</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<?php if($is_admin==1 or $soy_supervisor>=1){?>
						<li class="<?php if(isset($active3)){echo $active3;}?>"><a href="?view=registrados"><i class="fa fa-circle-o"></i> Tickets Registrados</a></li>
					<?php } ?>
					<li class="<?php if(isset($active5)){echo $active5;}?>"><a href="?view=asignados"><i class="fa fa-circle-o"></i> Tickets Asignados</a></li>
					<li class="<?php if(isset($active6)){echo $active6;}?>"><a href="?view=proceso"><i class="fa fa-circle-o"></i> Tickets En Proceso</a></li>
					<li class="<?php if(isset($active_5)){echo $active_5;}?>"><a href="?view=cancelados"><i class="fa fa-circle-o"></i> Tickets Cancelados</a></li>
					<li class="<?php if(isset($active4)){echo $active4;}?>"><a href="?view=finalizados"><i class="fa fa-circle-o"></i> Tickets Finalizados</a></li>
				</ul>
			</li>
			<?php } ?>
			<?php if($is_admin!=1){?>
				<li class="<?php if(isset($active14)){echo $active14;}?>">
					<a href="?view=mistickets">
						<i class="fa fa-ticket"></i> <span>Mis Tickets</span>
					</a>
				</li>
					
				<?php 
					$id_client = $_SESSION['admin_id'];
					$encuestor = mysqli_query($con,"select * from surveyticket where IdUserClient=$id_client and DateCompleted is null and Porcentage is null");
				?>
				<li style="display: none;"> class="<?php if(isset($active17)){echo $active17;}?>">
					<a href="?view=mysurvey">
						<i class="fa fa-list-alt"></i> <span>Mis Encuestas </span>
						<span class="pull-right-container">
							<?php if(mysqli_num_rows($encuestor)>0){  ?>
							<span class="label label-danger pull-right">
								<?php echo mysqli_num_rows($encuestor); ?>
							</span>
							<?php } ?>
						</span>
				  	</a>
				</li>
			<?php } ?>
			<?php if($is_admin==1){?>
			<li class="<?php if(isset($active2_0)){echo $active2_0;}?>">
				<a href="?view=prioridades">
					<i class="fa fa-th"></i> <span>Prioridades</span>
				</a>
			</li>
			<li class="<?php if(isset($active7)){echo $active7;}?>">
				<a href="?view=areas">
					<i class="fa fa-th-list"></i> <span>Areas</span>
				</a>
			</li>
			<li class="<?php if(isset($active13)){echo $active13;}?>">
				<a href="?view=categorias">
					<i class="fa fa-bars"></i> <span>Categorias</span>
				</a>
			</li>


			<li class="<?php if(isset($active15)){echo $active15;}?>">
				<a href="?view=cause_solution">
					<i class="fa fa-folder-o"></i> <span>Causas de Solución</span>
				</a>
			</li>
			<li class="<?php if(isset($active16)){echo $active16;}?>">
				<a href="?view=reason_cancellation">
					<i class="fa fa-list-alt"></i> <span>Motivos de Cancelación</span>
				</a>
			</li>

			<li style="display: none;"> class="treeview <?php if(isset($activeEnkuestor)){echo $activeEnkuestor;}?>">
				<a href="#">
					<i class="fa fa-calendar-o"></i> <span>ENCUESTAS</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if(isset($activeEnkuestorDesign)){echo $activeEnkuestorDesign;}?>"><a href="?view=encuestor_design"><i class="fa fa-circle-o"></i> Diseño</a></li>
					<li class="<?php if(isset($activeEnkuestorConfig)){echo $activeEnkuestorConfig;}?>"><a href="?view=encuestor_configuration"><i class="fa fa-circle-o"></i> Configuración</a></li>
				</ul>
			</li>


			<li class="<?php if(isset($active9)){echo $active9;}?>">
				<a href="?view=reportes">
					<i class="fa fa-area-chart"></i> <span>Reporte tickets</span>
				</a>
			</li>
			<li class="<?php if(isset($active10)){echo $active10;}?>">
				<a href="?view=clientes">
					<i class="fa fa-child"></i> <span>Empleados</span>
				</a>
			</li>
			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=usuarios">
					<i class="fa fa-users"></i> <span>Usuarios</span>
				</a>
			</li>

			<li class="<?php if(isset($active13)){echo $active13;}?>">
				<a href="?view=mantenimiento">
					<i class="fa fa-wrench"></i> <span>Mantenimiento</span>
				</a>
			</li>

			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=datos">
					<i class="fa fa-laptop"></i> <span>Inventario y actas</span>
				</a>
			</li>

			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=impresoras">
					<i class="fa fa-print"></i> <span>Inventario de impresoras</span>
				</a>
			</li>

			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=licencias">
					<i class="fa fa-file-word-o"></i> <span>Software licenciados</span>
				</a>
			</li>

			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=danados">
					<i class="fa fa-file-excel-o"></i> <span>Equipos Dañados</span>
				</a>
			</li>

			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=cotizacion">
					<i class="fa fa-file-o"></i> <span>Cotizaciones</span>
				</a>
			</li>
			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=ordendecompra">
					<i class="fa fa-file-pdf-o"></i> <span>Ordenes de compra</span>
				</a>
			</li>
			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=compras">
					<i class="fa fa-shopping-cart"></i> <span>Compras T.I.</span>
				</a>
			</li>

			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=laptopsdesktops">
					<i class="fa fa-laptop"></i> <span>Laptops / Desktop en venta</span>
				</a>
			</li>

			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=celulares">
					<i class="fa fa-tablet"></i> <span>Celulares</span>
				</a>
			</li>
			
			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=lineasfijas">
					<i class="fa fa-phone"></i> <span>Lineas fijas</span>
				</a>
			</li>


			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=laptopsdesktops">
					<i class="fa fa-laptop"></i> <span>Equipos moviles en venta</span>
				</a>
			</li>

			<li class="<?php if(isset($active11)){echo $active11;}?>">
				<a href="?view=proveedor">
					<i class="fa fa-list"></i> <span>Proveedores T.I.</span>
				</a>
			</li>
			


			<li style="display: none;" class="<?php if(isset($active12)){echo $active12;}?>">
				<a href="?view=configuracion">
					<i class="fa fa-cog"></i> <span>Configuración</span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</section>
</aside><!-- /.sidebar -->