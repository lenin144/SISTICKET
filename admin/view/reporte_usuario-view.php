<?php
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
		$active11="active";
		include "header.php";
		include "sidebar.php";

		$sesion_id=intval($_GET['id']);

		$users = mysqli_query($con,"select * from user where id=$sesion_id");
		$userrw = mysqli_fetch_array($users);
		$fullname = $userrw['name']." ".$userrw['lastname'];

		$registrados=mysqli_query($con, "select * from tickets where status_id=1 and status_ticket=1 and asigned_id=$sesion_id");
		$asignados=mysqli_query($con, "select * from tickets where status_id=2 && asigned_id!=0 and status_ticket=1 and asigned_id=$sesion_id");
		$proceso=mysqli_query($con, "select * from tickets where status_id=3 and status_ticket=1 and asigned_id=$sesion_id");
		$finalizados=mysqli_query($con, "select * from tickets where status_id=4 and status_ticket=1 and asigned_id=$sesion_id");
		$cancelados=mysqli_query($con, "select * from tickets where status_id=5 and status_ticket=1 and asigned_id=$sesion_id");

		/*$sesion_id=$_SESSION['admin_id'];

		$registrados_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=1 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
		$asignados_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=2 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
		$proceso_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=3 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
		$finalizados_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=4 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");
		$cancelados_emp=mysqli_query($con, "SELECT * from tickets inner join area on tickets.area=area.id where status_id=5 and (area.supervisor_id=$sesion_id or tickets.asigned_id=$sesion_id ) and status_ticket=1");*/
?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Tickets asignados a: <strong><?php echo $fullname ?></strong>
			</h1>
			<ol class="breadcrumb">
				<li class="active"><a href="#"><i class="fa fa-dashboard"></i> Tickets asignados </a></li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Info boxes -->
		
				<div class="row">
						<!-- <div class="col-md-3 col-sm-6 col-xs-12">
							<a href="?view=registrados" style="color:#000">
								<div class="info-box">
									<span class="info-box-icon bg-yellow"><i class="fa fa-glass"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Registrados</span>
										<span class="info-box-number"><?php echo mysqli_num_rows($registrados) ?></span>
									</div>
								</div>
							</a>
						</div> -->

						<!-- fix for small devices only -->
						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<a href="?view=asignados" style="color: #000">
								<div class="info-box">
									<span class="info-box-icon bg-aqua"><i class="fa fa-rocket"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">Asignados</span>
										<span class="info-box-number"><?php echo mysqli_num_rows($asignados) ?></span>
									</div>
								</div>
							</a>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12">
							<a href="?view=proceso" style="color:#000">
								<div class="info-box">
									<span class="info-box-icon bg-blue"><i class="fa fa-flask"></i></span>
									<div class="info-box-content">
											<span class="info-box-text">En Proceso</span>
											<span class="info-box-number"><?php echo mysqli_num_rows($proceso) ?></span>
									</div><!-- /.info-box-content -->
								</div><!-- /.info-box -->
							</a>
						</div> <!-- /.col -->

						<div class="col-md-3 col-sm-6 col-xs-12">
							<a href="?view=finalizados" style="color:#000">
								<div class="info-box">
									<span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o"></i></span>
									<div class="info-box-content">
											<span class="info-box-text">Finalizados</span>
											<span class="info-box-number"><?php echo mysqli_num_rows($finalizados) ?></span>
									</div><!-- /.info-box-content -->
								</div><!-- /.info-box -->
							</a>
						</div><!-- /.col -->




						<!-- nuevo -->
							<div class="col-md-3 col-sm-6 col-xs-12">
								<a href="?view=cancelados" style="color:#000">
									<div class="info-box">
										<span class="info-box-icon bg-red"><i class="fa fa-calendar-check-o"></i></span>
										<div class="info-box-content">
												<span class="info-box-text">Cancelados</span>
												<span class="info-box-number"><?php echo mysqli_num_rows($cancelados) ?></span>
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
												<span class="info-box-number"><?php echo mysqli_num_rows($finalizados) ?>%</span>
										</div>
									</div> 
								</a>
							</div> --><!-- /.col -->
						<!-- end nuevo -->




		</div><!-- /.row -->



			<!-- Main row -->
			<div class="row" style="display: none">
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

			<?php 
				    function sumRegitrados($month){
					   // $income=IncomeData::sumIncome_Month($month,$_SESSION["user_id"]);
					    global $registrados;
					    #echo $total=number_format($income->total,2,'.','');
					    echo mysqli_num_rows($registrados);
				    }
				    function sumAsignados($month){
				    	global $asignados;
				    	echo mysqli_num_rows($asignados);
				    } 

				    function sumProceso($month){
				    	global $proceso;
				    	echo mysqli_num_rows($proceso);
				    } 

				    function sumFinalizados($month){
				    	global $finalizados;
				    	echo mysqli_num_rows($finalizados);
				    } 

				    function sumCancelados($month){
				    	global $cancelados;
				    	echo mysqli_num_rows($cancelados);
				    } 
				?>



								
							<div class="row">
								<div class="col-md-12">
									<div class="box">
						                <div class="box-header  with-border">
						                    <h4><!-- Ingresos vrs Gastos --> <small>Reporte de tickets</small></h4>
						                    <div class="box-tools pull-right">
						                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
						                          <i class="fa fa-minus"></i></button>
						                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar/Ocultar">
						                          <i class="fa fa-times"></i></button>
						                    </div>
						                </div>
						                <div class="box-body"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
						                    <canvas id="mybarChart2" style="width: 521px; height: 260px;" width="521" height="260"></canvas>
						                </div>
							        </div>
									
								</div>
							</div>


		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

<?php include "footer.php" ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <!-- <script src="res/plugins/chartjs/Chart.min.js"></script> -->
    <script>
    if($("#mybarChart2").length) {
            var f=document.getElementById("mybarChart2");
            new Chart(f,
            {
                type:"bar",
                data: {
                    labels:[], //"Registrados","Asignados", "En Proceso", "Finalizados", "Cancelados"
                    datasets:[ /*{
                        label: "Registrados", backgroundColor: "#f39c12", data: [<?php echo sumRegitrados(1); ?>]
                    }
                    ,*/
                    {
                        label: "Asignados", backgroundColor: "#00c0ef", data: [<?php echo sumAsignados(1);?>]
                    }
                    ,
                    {
                        label: "En Proceso", backgroundColor: "#0073b7", data: [<?php echo sumProceso(1);?>]
                    }
                    ,
                    {
                        label: "Finalizados", backgroundColor: "#00a65a", data: [<?php echo sumFinalizados(1);?>]
                    }
                    ,
                    {
                        label: "Cancelados", backgroundColor: "#dd4b39", data: [<?php echo sumCancelados(1);?>]
                    }

                    ]
                }
                ,
                options: {
                    scales: {
                        yAxes:[ {
                            ticks: {
                                beginAtZero: !0
                            }
                        }
                        ]
                    }
                }
            }
            )
        }
</script>  