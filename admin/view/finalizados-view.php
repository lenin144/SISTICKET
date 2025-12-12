<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active2="active";
    $active4="active";
    include "header.php";
    include "sidebar.php";
    if($is_admin!=1 and $soy_supervisor==0 and $soy_agente==0){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
    if($is_admin==1){
        $atendidos=mysqli_query($con, "select * from tickets where status_id=4 order by created_at desc");
    }elseif($soy_supervisor>=1 or $soy_agente==1){
        $atendidos=mysqli_query($con, "SELECT tickets.id, tickets.client_id, tickets.status_id,tickets.number_ticket, tickets.asunt, tickets.asigned_id,tickets.status_id, tickets.status_ticket, area.supervisor_id, tickets.area,tickets.tipo_requerimiento,tickets.idPriority from tickets inner join area on tickets.area=area.id where (area.supervisor_id=$id or tickets.asigned_id=$id) and (tickets.status_ticket=1 and tickets.status_id=4) order by tickets.created_at desc ");
        // $atendidos=mysqli_query($con, "SELECT tickets.id, tickets.client_id, tickets.status_id,tickets.number_ticket, tickets.asunt, tickets.asigned_id,tickets.status_id, tickets.status_ticket, area.supervisor_id, tickets.area,tickets.tipo_requerimiento,tickets.idPriority from tickets inner join area on tickets.area=area.id where (area.supervisor_id=$id or tickets.asigned_id=$id or tickets.client_id=$id) and (tickets.status_ticket=1 and tickets.status_id=4) order by tickets.created_at desc ");
    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tickets Finalizados</h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Tickets Finalizados</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="table_header">
                                <tr>
                                    <th></th>
                                    <th>N° Ticket</th>
                                    <th>Cliente</th>
                                    <th>Asunto</th>
                                    <th>Asignado</th>
                                     <th>Area</th>
                                    <th>Categoria</th>
                                    <th>Prioridad </th>
                                    <th>Estatus</th>
                                    <th>Encuesta</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($atendidos as $cat):
                                $ticket_id=$cat['id'];
                                $status_id=$cat['status_id'];
                                $client_id=$cat['client_id'];


                                $idPriority=$cat['idPriority'];
                                $prioridades=mysqli_query($con, "select * from priority where idPriority=$idPriority");
                                $prioridades_rw=mysqli_fetch_array($prioridades);
                                $name_priority=$prioridades_rw['Description'];

                                $area=$cat['area'];
                                $areas=mysqli_query($con, "select * from area where id=$area");
                                $areas_rw=mysqli_fetch_array($areas);
                                $name_area=$areas_rw['name'];

                                $tipo_requerimiento=$cat['tipo_requerimiento'];
                                $categorias=mysqli_query($con, "select * from tipos_requerimientos where id=$tipo_requerimiento");
                                $categorias_rw=mysqli_fetch_array($categorias);
                                $name_category=$categorias_rw['name'];

                                $asigned_id=$cat['asigned_id'];
                                    $sql=mysqli_query($con, "select * from user where id=$asigned_id");
                                    $rows02=mysqli_fetch_array($sql);
                                        $name_user=$rows02['name'];
                                        $lastname_user=$rows02['lastname'];
                                        $email_user=$rows02['email'];

                                $empresa=mysqli_query($con, "select * from user where id=$client_id");
                                $rows=mysqli_fetch_array($empresa);
                                    $fullname=$rows['fullname'];
                                    $name_lastname_user=$rows['name']." ".$rows['lastname'];
                            ?>
                                <tr>
                                    <td width='30' class='center'><a class="btn btn-default btn-xs" href="?view=ticket_detail&id=<?php echo $cat['id'] ?>">Ver <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                    <td><?php echo $cat['number_ticket'] ?></td>
                                   <td>
                                        <?php 
                                            if($fullname!=""){
                                                echo $fullname;
                                            }else{
                                                echo $name_lastname_user;
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $cat['asunt'] ?></td>
                                    <td><?php echo $name_user." ".$lastname_user ?></td>
                                    <td><?php echo $name_area;?></td>
                                    <td><?php echo $name_category;?></td>
                                    <td><?php echo $name_priority;?></td>
                                    <td>
                                        <?php echo "<span class='label label-success'>Finalizado</span> "; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php 
                                            $existingSurvey=mysqli_query($con,"select * from surveyticket where IdTicket=$ticket_id and IdUserClient=$client_id and DateCompleted is not null and Porcentage is not null");
                                            $rwexisting=mysqli_fetch_array($existingSurvey);
                                            if (mysqli_num_rows($existingSurvey)>0) {

                                        ?>
                                        <a class="btn btn-default" href="?view=encuesta_detail&id=<?php echo $rwexisting['idSurveyTicket'] ?>"> Ver Encuesta</a>    
                                        <?php  } ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php include "footer.php" ?>