<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active2="active";
    $active6="active";
    include "header.php";
    include "sidebar.php";

    if($is_admin!=1 and $soy_supervisor==0 and $soy_agente==0){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
    #Ahora

    if($is_admin==1){
        $atendidos=mysqli_query($con, "select * from tickets where status_id=3 order by created_at desc");
    }elseif($soy_supervisor>=1 or $soy_agente==1){
        $atendidos=mysqli_query($con, "SELECT tickets.id, tickets.client_id, tickets.status_id,tickets.number_ticket, tickets.asunt, tickets.asigned_id,tickets.status_id, tickets.status_ticket, area.supervisor_id, tickets.area,tickets.tipo_requerimiento,tickets.idPriority from tickets inner join area on tickets.area=area.id where (area.supervisor_id=$id or tickets.asigned_id=$id) and (tickets.status_ticket=1 and tickets.status_id=3) order by tickets.created_at desc ");
        // $atendidos=mysqli_query($con, "SELECT tickets.id, tickets.client_id, tickets.status_id,tickets.number_ticket, tickets.asunt, tickets.asigned_id,tickets.status_id, tickets.status_ticket, area.supervisor_id, tickets.area,tickets.tipo_requerimiento,tickets.idPriority from tickets inner join area on tickets.area=area.id where (area.supervisor_id=$id or tickets.asigned_id=$id or tickets.client_id=$id) and (tickets.status_ticket=1 and tickets.status_id=3) order by tickets.created_at desc ");
    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tickets en Proceso</h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Tickets en Proceso</li>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($atendidos as $cat):
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
                                    <td><?php echo "<span class='label label-primary'>En Proceso</span>
                                                "; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <!-- Split button -->
                                        <div class="btn-group" style="width: 100px">
                                            <button type="button" class="btn btn-default">Acción</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="?view=incidencias&id=<?php echo $cat['id'] ?>"><i class="fa fa-ban"></i> Agregar Bitácora</a></li>
                                                <li><a href="?view=reasignar_ticket&id=<?php echo $cat['id'] ?>"><i class="fa fa-child"></i> Re-asignar</a></li>
                                                <li><a href="?view=cancel_ticket&id=<?php echo $cat['id'] ?>"><i class="fa fa-ban"></i> Cancelar Ticket</a></li>
                                                <li><a href="?view=atender_ticket&id=<?php echo $cat['id'] ?>"><i class="fa fa-check"></i> Finalizar Ticket</a></li>
                                            </ul>
                                        </div>
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