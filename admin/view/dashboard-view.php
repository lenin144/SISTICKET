<?php
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
		$active1="active";
		include "header.php";
		include "sidebar.php";
		$registrados=mysqli_query($con, "select * from tickets where status_id=1 and status_ticket=1");
		$asignados=mysqli_query($con, "select * from tickets where status_id=2 && asigned_id!=0 and status_ticket=1");
		$proceso=mysqli_query($con, "select * from tickets where status_id=3 and status_ticket=1");
		$finalizados=mysqli_query($con, "select * from tickets where status_id=4 and status_ticket=1");
		$cancelados=mysqli_query($con, "select * from tickets where status_id=5 and status_ticket=1");

		$sesion_id=$_SESSION['admin_id'];

		$registrados_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=1 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
		$asignados_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=2 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
		$proceso_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=3 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
		$finalizados_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=4 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
		$cancelados_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=5 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dashboard
			</h1>
			<ol class="breadcrumb">
				<li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Info boxes -->
			<?php if($is_admin==1){?>
				<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<a href="?view=registrados" style="color:#000">
								<div style="border-radius: 20px; bkacground: #ca4300;" class="info-box">
									<span style="border-radius: 20px; background: var !important;" class="info-box-icon bg-yellow"><i class="fa fa-list-alt"></i></span>
									<div class="info-box-content">
										<span style="color:white" class="info-box-text">Registrados</span>
										<span style="color:white" class="info-box-number"><?php echo mysqli_num_rows($registrados) ?></span>
									</div>
								</div><!-- /.info-box -->
							</a><!-- /.info-box-content -->
						</div><!-- /.col -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<a href="?view=asignados" style="color: #000">
								<div style="border-radius: 20px; background: #00c0ef !important" class="info-box">
									<span style="border-radius: 20px; background: #00c0ef !important" class="info-box-icon bg-aqua"><i class="fa fa-rocket"></i></span>
									<div class="info-box-content">
										<span style="color: white" class="info-box-text">Asignados</span>
										<span style="color: white" class="info-box-number"><?php echo mysqli_num_rows($asignados) ?></span>
									</div><!-- /.info-box-content -->
								</div><!-- /.info-box -->
							</a>
						</div><!-- /.col -->

						<div class="col-md-3 col-sm-6 col-xs-12"> 
							<a href="?view=proceso" style="color:#000">
								<div style="border-radius: 20px; background: #ca4300 !important" class="info-box">
									<span style="border-radius: 20px; background: #ca4300 !important" class="info-box-icon bg-blue"><i class="fa fa-flask"></i></span>
									<div class="info-box-content">
											<span style="color: white" class="info-box-text">En Proceso</span>
											<span style="color: white" class="info-box-number"><?php echo mysqli_num_rows($proceso) ?></span>
									</div><!-- /.info-box-content -->
								</div><!-- /.info-box -->
							</a>
						</div> <!-- /.col -->

						<div class="col-md-3 col-sm-6 col-xs-12">
							<a href="?view=finalizados" style="color:#000">
								<div style="border-radius: 20px; background:#00a65a !important" class="info-box">
									<span style="border-radius: 20px; background: #00a65a !important" class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
									<div class="info-box-content">
											<span style="color:white" class="info-box-text">Finalizados</span>
											<span style="color:white" class="info-box-number"><?php echo mysqli_num_rows($finalizados) ?></span>
									</div><!-- /.info-box-content -->
								</div><!-- /.info-box -->
							</a>
						</div><!-- /.col -->




						<!-- nuevo -->
							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=cancelados" style="color:#000">
									<div style="border-radius: 20px; background: #ed1c24 !important" class="info-box">
										<span style="border-radius: 20px; background: #ed1c24 !important" class="info-box-icon bg-red"><i class="fa fa-times"></i></span>
										<div class="info-box-content">
												<span style="color: white" class="info-box-text">Cancelados</span>
												<span style="color: white" class="info-box-number"><?php echo mysqli_num_rows($cancelados) ?></span>
										</div> <!-- /.info-box-content -->
									</div> <!-- /.info-box -->
								</a>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=datos" style="color:#000">
									<div style="border-radius: 20px; background: #3B9EC4 !important" class="info-box">
										<span style="border-radius: 20px; background: #3B9EC4 !important" class="info-box-icon bg-red"><i class="fa fa-file-text-o"></i></span>
										<div class="info-box-content">
												<span style="color: white; margin-top: 18px;" class="info-box-text">Inventario y actas <br> de Laptop y Desktop</span>
												
										</div> <!-- /.info-box-content -->
									</div> <!-- /.info-box -->
								</a>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=impresoras" style="color:#000">
									<div style="border-radius: 20px; background: #96bf48 !important" class="info-box">
										<span style="border-radius: 20px; background:  #96bf48 !important" class="info-box-icon bg-red"><i class="fa fa-print"></i></span>
										<div class="info-box-content">
												<span style="color: white; margin-top: 18px;" class="info-box-text">Inventario de <br> impresoras</span>
												
										</div> <!-- /.info-box-content -->
									</div> <!-- /.info-box -->
								</a>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=licencias" style="color:#000">
									<div style="border-radius: 20px; background: #9cb4c5 !important" class="info-box">
										<span style="border-radius: 20px; background:  #9cb4c5 !important" class="info-box-icon bg-red"><i class="fa fa-file-word-o"></i></span>
										<div class="info-box-content">
												<span style="color: white; margin-top: 18px;" class="info-box-text"> Software <br> licenciados</span>
												
										</div> <!-- /.info-box-content -->
									</div> <!-- /.info-box -->
								</a>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=mantenimiento" style="color:#000">
									<div style="border-radius: 20px; background: #56605d !important" class="info-box">
										<span style="border-radius: 20px; background: #56605d !important" class="info-box-icon bg-red"><i class="fa fa-wrench"></i></span>
										<div class="info-box-content">
												<span style="color: white; margin-top: 18px;" class="info-box-text">Plan de mantenimiento <br> preventivo</span>
												
										</div> <!-- /.info-box-content -->
									</div> <!-- /.info-box -->
								</a>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=danados" style="color:#000">
									<div style="border-radius: 20px; background: #c09853 !important" class="info-box">
										<span style="border-radius: 20px; background: #c09853 !important" class="info-box-icon bg-red"><i class="fa fa-file-excel-o"></i></span>
										<div class="info-box-content">
												<span style="color: white; margin-top: 18px;" class="info-box-text">Equipos <br> dañados</span>
												
										</div> <!-- /.info-box-content -->
									</div> <!-- /.info-box -->
								</a>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=compras" style="color:#000">
									<div style="border-radius: 20px; background: #356e35 !important" class="info-box">
										<span style="border-radius: 20px; background: #356e35 !important" class="info-box-icon bg-red"><i class="fa fa-shopping-cart"></i></span>
										<div class="info-box-content">
												<span style="color: white; margin-top: 18px;" class="info-box-text">Reporte de compras <br>del area de T.I.</span>
												
										</div> <!-- /.info-box-content -->
									</div> <!-- /.info-box -->
								</a>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=proveedor" style="color:#000">
									<div style="border-radius: 20px; background: var !important" class="info-box">
										<span style="border-radius: 20px; background: var !important" class="info-box-icon bg-red"><i class="fa fa-list"></i></span>
										<div class="info-box-content">
												<span style="color: white; margin-top: 18px;" class="info-box-text">Proveedores del <br> area de T.I.</span>
												
										</div> <!-- /.info-box-content -->
									</div> <!-- /.info-box -->
								</a>
							</div>

							 <!-- /.col -->
							<!--<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="#" style="color:#000">
									<div class="info-box">
										<span class="info-box-icon bg-purple"><i class="fa fa-calendar-check-o"></i></span>
										<div class="info-box-content">
												<span style="font-size: 12px" class="info-box-text">Satisfacción General</span>
												<span class="info-box-number"><?php echo mysqli_num_rows($finalizados) ?>%</span>
										</div>
									</div> 
								</a>
							</div> --><!-- /.col -->
						<!-- end nuevo -->




		</div><!-- /.row -->
<?php }  ?> 

<!-- empleado -->
		<?php if($is_admin!=1){?><!-- Info boxes -->
		<div class="row">
				<div class="col-md-12">
						<?php if(isset($_GET['error'])) {
							echo "<br><div class='alert alert-warning' role='alert'>
								<button type='button' class='close' data-dismiss='alert'>&times;</button>
								<strong>¡Error!</strong><br> Estas accediendo a una area restringida, si esto es un error, contacta al administrador.</div>";
						} ?> 
				</div>

				<!-- fix for small devices only -->
				<div class="clearfix visible-sm-block"></div>
			<?php if($is_admin==1 or $soy_supervisor>=1){?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="?view=registrados" style="color:#000">
						<div class="info-box">
							<span class="info-box-icon bg-yellow"><i class="fa fa-glass"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">Registrados</span>
								<span class="info-box-number"><?php echo mysqli_num_rows($registrados_emp) ?></span>
							</div> <!-- /.info-box-content -->
						</div><!-- /.info-box -->
					</a>
				</div><!-- /.col -->
			<?php } ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="?view=asignados" style="color:#000">
						<div class="info-box">
							<span class="info-box-icon bg-aqua"><i class="fa fa-rocket"></i></span>
							<div class="info-box-content">
									<span class="info-box-text">Asignados</span>
									<span class="info-box-number"><?php echo mysqli_num_rows($asignados_emp) ?></span>
							</div><!-- /.info-box-content -->
						</div><!-- /.info-box -->
					</a>
				</div> <!-- /.col -->

				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="?view=proceso" style="color:#000">
						<div class="info-box">
							<span class="info-box-icon bg-blue"><i class="fa fa-flask"></i></span>
							<div class="info-box-content">
									<span class="info-box-text">En Proceso</span>
									<span class="info-box-number"><?php echo mysqli_num_rows($proceso_emp) ?></span>
							</div> <!-- /.info-box-content -->
						</div> <!-- /.info-box -->
					</a>
				</div> <!-- /.col -->

				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="?view=finalizados" style="color:#000">
						<div class="info-box">
							<span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
							<div class="info-box-content">
									<span class="info-box-text">Finalizados</span>
									<span class="info-box-number"><?php echo mysqli_num_rows($finalizados_emp) ?></span>
							</div> <!-- /.info-box-content -->
					</div> <!-- /.info-box -->
					</a>
				</div> <!-- /.col -->



				<!-- nuevo -->
					<div class="col-md-3 col-sm-6 col-xs-12">
						<a href="?view=cancelados" style="color:#000">
							<div class="info-box">
								<span class="info-box-icon bg-red"><i class="fa fa-calendar-check-o"></i></span>
								<div class="info-box-content">
										<span class="info-box-text">Cancelados</span>
										<span class="info-box-number"><?php echo mysqli_num_rows($cancelados_emp) ?></span>
								</div> <!-- /.info-box-content -->
							</div> <!-- /.info-box -->
						</a>
					</div> <!-- /.col -->
					<!--<div class="col-md-3 col-sm-6 col-xs-12">
						<a href="#" style="color:#000">
							<div class="info-box">
								<span class="info-box-icon bg-purple"><i class="fa fa-calendar-check-o"></i></span>
								<div class="info-box-content">
										<span style="font-size: 12px" class="info-box-text">Satisfacción General</span>
										<span class="info-box-number"><?php echo mysqli_num_rows($finalizados_emp) ?>%</span>
								</div>
							</div> 
						</a>
					</div>--> <!-- /.col -->
				<!-- end nuevo -->




		</div><!-- /.row -->
<?php }  ?> 
<!-- end empleado -->



<?php if($is_admin==1){?>
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<div class="col-md-12">
				<?php 
					$sql = mysqli_query($con, "SELECT * from tickets where status_ticket=1 order by created_at desc limit 10");
					if (mysqli_num_rows($sql)>0) {
							# code...
					
				?>
					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Tickets Recientes</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->

						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin table-bordered">
									<thead class="table_header">
									<tr>
										<th>No. Ticket</th>
										<th>Cliente</th>
										<th>Asunto</th>
										<th>Area</th>
										<th>Categoria</th>
										<th>Prioridad </th>
										<!-- <th>Descripción</th> -->
										<th>Estatus</th>
										<th>Reporte</th>
									</tr>
									</thead>
									<tbody>
									<?php 
												foreach ($sql as $result): 
												$client_id=$result['client_id'];
												$empresas=mysqli_query($con, "select * from user where id=$client_id");

												$idPriority=$result['idPriority'];
												$prioridades=mysqli_query($con, "select * from priority where idPriority=$idPriority");
												$prioridades_rw=mysqli_fetch_array($prioridades);
												$name_priority=$prioridades_rw['Description'];

												$area=$result['area'];
												$areas=mysqli_query($con, "select * from area where id=$area");
												$areas_rw=mysqli_fetch_array($areas);
												$name_area=$areas_rw['name'];

												$tipo_requerimiento=$result['tipo_requerimiento'];
												$categorias=mysqli_query($con, "select * from tipos_requerimientos where id=$tipo_requerimiento");
												$categorias_rw=mysqli_fetch_array($categorias);
												$name_category=$categorias_rw['name'];

												$status_id=$result['status_id'];
												$statuses=mysqli_query($con, "select * from status where id=$status_id");
									?>
									<tr>
										<td><a href="?view=ticket_detail&id=<?php echo $result['id'] ?>"><?php echo $result['number_ticket'] ?></a></td>
										<?php foreach ($empresas as $cat): ?>
										<td>
												
														<?php if($cat['fullname']!=""){
																		echo $cat['fullname'];
																}else{
																		echo $cat['name']," ",$cat['lastname'];
																}
														?>
												
										</td>
										<?php endforeach; ?>
										<td><?php echo $result['asunt'];?></td>
										
										<td><?php echo $name_area;?></td>
										<td><?php echo $name_category;?></td>
										<td><?php echo $name_priority;?></td>
										
										<!-- <td>
											<div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo substr($result['comment'],0,45) ?></div>
										</td> -->
										 <td>   
												<?php
														if($result['status_id']==1){
																echo "<span class='label label-warning'>Registrado</span>";
														}else if($result['status_id']==2){
																echo "<span class='label label-info'>Asignado</span>";
														}else if($result['status_id']==3){
																echo "<span class='label label-primary'>En Proceso</span>";
														}else if($result['status_id']==4){
																echo "<span class='label label-success'>Finalizado</span>";
														}
												?>
										 </td>
										 <td>
										 	<a href="<?php echo ((isset($_SERVER['HTTPS']))?'https://'.$_SERVER['HTTP_HOST']: 'http://'.$_SERVER['HTTP_HOST'].'/ticket_cal') ?>/admin/?view=pdf_reporte&id=<?=$result['id']?>" target="_blank">Reporte</a>
										 </td>
									</tr>
							<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>
						<!-- /.box-footer -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
												<?php

										}else{
												//echo "<p class='aler alert-info'>Aun no hay tickets!</p>";
										}

								 ?>
			</div>
			<!-- /.row -->

				<?php } ?>

<!-- empleado -->
	
	<?php if($is_admin!=1){?>
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<div class="col-md-12">

							<?php 
							$sql = mysqli_query($con, "SELECT tickets.id,tickets.client_id,tickets.status_id,tickets.number_ticket,tickets.asunt,tickets.comment,area.name,tickets.idPriority,tickets.tipo_requerimiento from tickets inner join area on tickets.area=area.id where (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id) and status_ticket=1 order by tickets.created_at desc limit 10 ");
							if (mysqli_num_rows($sql)>0) {
							?>

					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Tickets Recientes</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->

						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin table-bordered">
									<thead class="table_header">
									<tr>
										<th>No. Ticket</th>
										<th>Cliente</th>
										<th>Asunto</th>
										<th>Area</th>
										<th>Categoria</th>
										<th>Prioridad </th>
										<!-- <th>Descripción</th> -->
										<th>Estatus</th>
									</tr>
									</thead>
									<tbody>
									<?php 
												foreach ($sql as $result): 
												$client_id=$result['client_id'];
												$empresas=mysqli_query($con, "select * from user where id=$client_id");

												$idPriority=$result['idPriority'];
												$prioridades=mysqli_query($con, "select * from priority where idPriority=$idPriority");
												$prioridades_rw=mysqli_fetch_array($prioridades);
												$name_priority=$prioridades_rw['Description'];


												$tipo_requerimiento=$result['tipo_requerimiento'];
												$categorias=mysqli_query($con, "select * from tipos_requerimientos where id=$tipo_requerimiento");
												$categorias_rw=mysqli_fetch_array($categorias);
												$name_category=$categorias_rw['name'];


												$status_id=$result['status_id'];
												$statuses=mysqli_query($con, "select * from status where id=$status_id");
									?>
									<tr>
										<td><a href="?view=ticket_detail&id=<?php echo $result['id'] ?>"><?php echo $result['number_ticket'] ?></a></td>
										<?php foreach ($empresas as $cat): ?>
										<td>
												
														<?php 
																if($cat['fullname']!=""){
																		echo $cat['fullname'];
																}else{
																		echo $cat['name']," ",$cat['lastname'];
																}
														?>
												
										</td>
										<?php endforeach; ?>
										<td><?php echo $result['asunt'];?></td>
										<!-- <td>
											<div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo substr($result['comment'],0,45) ?></div>
										</td> -->
										<td><?php echo $result['name'];?></td>

										<td><?php echo $name_category;?></td>
										<td><?php echo $name_priority;?></td>

										 <td>   
												<?php
														if($result['status_id']==1){
																echo "<span class='label label-warning'>Registrado</span>";
														}else if($result['status_id']==2){
																echo "<span class='label label-info'>Asignado</span>";
														}else if($result['status_id']==3){
																echo "<span class='label label-primary'>En Proceso</span>";
														}else if($result['status_id']==4){
																echo "<span class='label label-success'>Finalizado</span>";
														}
												?>
										 </td>
									</tr>
							<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>
						<!-- /.box-footer -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
												<?php

										}else{
												//echo "<p class='aler alert-info'>Aun no hay tickets!</p>";
										}

								 ?>
			</div>
			<!-- /.row -->

				<?php } ?>


<!-- end empleado -->
				



		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

<?php include "footer.php" ?>