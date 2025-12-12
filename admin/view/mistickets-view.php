<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active14="active";
    include "header.php";
    include "sidebar.php";
    $id=$_SESSION['admin_id'];
    // $registrados=mysqli_query($con, "SELECT * from tickets where (asigned_id=$id or client_id=$id) and status_ticket=1");
    $registrados=mysqli_query($con, "SELECT tickets.id, tickets.client_id, tickets.status_id,tickets.number_ticket, tickets.asunt, tickets.asigned_id,tickets.status_id, tickets.status_ticket, area.supervisor_id, tickets.area,tickets.tipo_requerimiento,tickets.idPriority from tickets inner join area on tickets.area=area.id where (tickets.client_id=$id) and (tickets.status_ticket=1) order by tickets.created_at desc ");
    // $registrados=mysqli_query($con, "SELECT tickets.id, tickets.client_id, tickets.status_id,tickets.number_ticket, tickets.asunt, tickets.asigned_id,tickets.status_id, tickets.status_ticket, area.supervisor_id from tickets inner join area on tickets.area=area.id where (area.supervisor_id=$id or tickets.asigned_id=$id or tickets.client_id=$id and tickets.status_ticket=1 and tickets.status_id=1) order by tickets.created_at desc ");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tickets </h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Tickets </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                    <?php 

                        if (isset($_GET)) {
                           if (isset($_GET['deletesuccess'])) {
                              echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Datos Eliminado Correctamente!</div>";
                           }
                           if (isset($_GET['errordelete'])) {
                              echo "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Hubo un error al eliminar los datos!</div>";
                           }
                        }

                    ?>
                <div class="box">
                    <div class="box-header">
                      <!-- <h3 class="box-title">Registro de tickets</h3> -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="table_header">
                                <tr>
                                    <th></th>
                                    <!-- <th>Nombre</th> -->
                                    <!-- <th>E-mail</th> -->
                                    <th>N° Ticket</th>
                                    <th>Cliente</th>
                                    <th>Asunto</th>
                                    <th>Area</th>
                                    <th>Categoria</th>
                                    <th>Prioridad </th>
                                    <th>Estado</th>
                                    <!-- <th></th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($registrados as $cat):
                                    $status_id=$cat['status_id'];

                                $client_id=$cat['client_id'];

                                $clients=mysqli_query($con, "select * from user where id=$client_id");




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

                                    


                                $rows=mysqli_fetch_array($clients);
                                    /*if($rows['business']!=""){
                                        $name_client=$rows['business'];
                                    }else{
                                        $name_client=$rows['name']." ".$rows['lastname'];;
                                    }*/
                                    if($rows['fullname']!=""){
                                        $name_client=$rows['fullname'];
                                    }else{
                                        $name_client=$rows['name']." ".$rows['lastname'];
                                    }
                            ?>
                                <tr>
                                    <td width='30' class='center'><a class="btn btn-default btn-xs" href="?view=ticket_detail&id=<?php echo $cat['id'] ?>">Ver <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                    <!-- <td><?php echo $cat['name'] ?></td> -->
                                    <!-- <td><?php echo $cat['email'] ?></td> -->
                                    <td><?php echo $cat['number_ticket'] ?></td>
                                    <td><?php echo $name_client ?></td>
                                    <td><?php echo $cat['asunt'] ?></td>
                                    <td><?php echo $name_area;?></td>
                                    <td><?php echo $name_category;?></td>
                                    <td><?php echo $name_priority;?></td>
                                    <td>                        
                                        <?php
                                            if($status_id==1){
                                                echo "<span class='label label-warning'>Registrado</span>";
                                            }else if($status_id==2){
                                                echo "<span class='label label-info'>Asignado</span>";
                                            }else if($status_id==3){
                                                echo "<span class='label label-primary'>En Proceso</span>";
                                            }else if($status_id==4){
                                                echo "<span class='label label-success'>Finalizado</span>";
                                            }
                                        ?>
                                    </td>
                                    <!-- <td style="text-align: center;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default <?php if($status_id==4){echo"disabled";} ?>">Acción</button>
                                            <button type="button" class="btn btn-default dropdown-toggle <?php if($status_id==4){echo"disabled";} ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php if($status_id==1 and $cat['supervisor_id']==$id and $soy_supervisor>=1){ ?>
                                                <li><a href="?view=asignar_ticket&id=<?php echo $cat['id'] ?>"><i class="fa fa-child"></i> Asignar</a></li>
                                                <?php }else if($status_id==2 and $soy_supervisor>=1){ ?>
                                                <li><a href="?view=reasignar_ticket&id=<?php echo $cat['id'] ?>"><i class="fa fa-child"></i> Reasignar</a></li>

                                                <?php }else if($status_id==2 or $status_id==3){ ?>
                                                <li><a href="?view=incidencias&id=<?php echo $cat['id'] ?>"><i class="fa fa-ban"></i> Agregar Bitacora</a></li>
                                                <li><a href="?view=atender_ticket&id=<?php echo $cat['id'] ?>"><i class="fa fa-check"></i> Cerrar Ticket</a></li>

                                                <?php }else{ ?>
                                                    <li class="disabled"><a href="#"><i class="fa fa-th"></i> Sin Acción</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td> -->
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