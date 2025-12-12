<?php  
	/*-------------------------
	Autor: Autor Dev
	Web: www.google.com
	E-Mail: waptoing7@gmail.com
	---------------------------*/
	$active3="active";
	include "header.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
	  <h1 style="display: none;">
		<i class="fa fa-list-alt icon-title"></i> Mis Encuestas
	  </h1>
	</section>
	  <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-body">
						<table id="mistickets" class="table table-bordered table-striped table-hover">
							<thead class="table_header">
								<tr>
									<th class="center">Detalle</th>
									<th class="center">N° Ticket</th>
									<th class="center">Asunto </th>
									<th class="center">Agente</th>
									<th class="center">Fecha Registro</th>
									<th class="center">Fecha Finalizado</th>
									<th class="center">Estatus</th>
									<th class="center">Accion</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$client_id=$_SESSION['user_id'];

								$sql = mysqli_query($con, "SELECT surveyticket.idSurveyTicket,surveyticket.IdUserClient,surveyticket.DateSend,surveyticket.DateCompleted,surveyticket.Porcentage,tickets.number_ticket,tickets.asunt,tickets.status_id,tickets.created_at,tickets.date_atendid,tickets.id,user.name,user.lastname  FROM surveyticket inner join tickets on surveyticket.IdTicket=tickets.id inner join user on surveyticket.IdUserAgent=user.id where IdUserClient=$client_id and DateCompleted is null and Porcentage is null order by DateSend desc");
								foreach($sql as $client){


								   	list($dateEnd,$horaEnd)=explode(" ",$client['created_at']);
									list($Y,$m,$d)=explode("-",$dateEnd);
									list($H,$i,$s)=explode(":",$horaEnd);
									$fechaEnd=$d."/".$m."/".$Y;
									$horaEnd=$H.":".$i." hrs";
									$created_at = $fechaEnd." ".$horaEnd;

									list($dateEnd,$horaEnd)=explode(" ",$client['date_atendid']);
									list($Y,$m,$d)=explode("-",$dateEnd);
									list($H,$i,$s)=explode(":",$horaEnd);
									$fechaFinish=$d."/".$m."/".$Y;
									$horaFinish=$H.":".$i." hrs";
									$date_atendid = $fechaFinish." ".$horaFinish;
									
								$status_id=$client['status_id'];
							?>
								<tr>
									<td width='30' class='center'><a class="btn btn-default btn-xs" href="?view=ticket_detail&id=<?php echo $client['id'] ?>">Ver <span class="glyphicon glyphicon-arrow-right"></span></a></td>
									<td width='80' class='center'><?php echo $client['number_ticket'];?></td>
									<td width='150' align='center'><?php echo $client['asunt']; ?></td>
									<td width='150' align="center"><?php echo $client['name']," ",$client['lastname']; ?></td>
									<td width='110' align="center"><?php echo $created_at; ?></td>
									<td width='110' align="center"><?php echo $date_atendid; ?></td>
									<td class='center' width='80'>
										<div>
											<?php  

											if($status_id==1){
												echo"<p style='padding:3px; margin-bottom:0; background-color:#f39c12;color:#fff;text-align:center'  class='alert alert-'>Registrado</p>";
												
											}else if($status_id==2){
												echo "<p style='padding:3px; margin-bottom:0; background-color:#00c0ef;color:#fff;text-align:center' class='alert alert-'>Asignado</p>";
											}else if($status_id==3){
												echo "<p style='padding:3px; margin-bottom:0; background-color:#0073b7;color:#fff;text-align:center' class='alert alert-'>En Proceso</p>
												";
											}else{
												echo "<p style='padding:3px; margin-bottom:0; background-color:#00a65a;color:#fff;text-align:center'  class='alert alert-'>Finalizado</p>";
											}

										?>
										</div>
									</td>
									<td width='30' class='center'><a class="btn btn-default btn-xs" href="?view=response_survey&id=<?php echo $client['idSurveyTicket'] ?>">Contestar Encuesta</a></td>
								</tr>
						<?php
							} //en while
						?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!--/.col -->
		</div>   <!-- /.row -->
	</section><!-- /.content-->
</div><!-- /.content-wrapper -->

<?php include "footer.php" ?>