<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active17="active";
    include "header.php";
    include "sidebar.php";
    
    if($is_admin!=1){
        // print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section style="display: none;" class="content-header">
            <h1>Mis Encuestas</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Mis Encuestas</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
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
                                $client_id=$_SESSION['admin_id'];

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
                                    
          
                            ?>
                                    <tr>
                                        <td width='30' class='center'><a class="btn btn-default btn-xs" href="?view=ticket_detail&id=<?php echo $client['id'] ?>">Ver <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                        <td class='center'><?php echo $client['number_ticket'];?></td>
                                        <td align='center'><?php echo $client['asunt']; ?></td>
                                        <td align="center"><?php echo $client['name']," ",$client['lastname']; ?></td>
                                        <td align="center"><?php echo $created_at; ?></td>
                                        <td align="center"><?php echo $date_atendid; ?></td>
                                        <td class='center' >
                                            <div>
                                                <?php  

                                                        if($client['status_id']==1){
                                                                echo "<span class='label label-warning'>Registrado</span>";
                                                        }else if($client['status_id']==2){
                                                                echo "<span class='label label-info'>Asignado</span>";
                                                        }else if($client['status_id']==3){
                                                                echo "<span class='label label-primary'>En Proceso</span>";
                                                        }else if($client['status_id']==4){
                                                                echo "<span class='label label-success'>Finalizado</span>";
                                                        }
                               

                                            ?>
                                            </div>
                                        </td>
                                        <td class='center'><a class="btn btn-default btn-xs" href="?view=response_survey&id=<?php echo $client['idSurveyTicket'] ?>">Contestar Encuesta</a></td>
                                    </tr>
                                <?php
                                    } //en while
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

  <?php include "footer.php" ?>