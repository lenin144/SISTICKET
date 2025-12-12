<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active2="active";
    $active3="active";
    include "header.php";
    include "sidebar.php";
    $id=$_SESSION['admin_id'];
    if($is_admin!=1 and $soy_supervisor==0){
        //header("location: dashboard.php");
        print "<script>window.location='?view=dashboard&error';</script>";
    }
    
    if($is_admin==1){
        $registrados=mysqli_query($con, "select * from tickets where status_id=1 order by created_at desc");

    }elseif($soy_supervisor>=1){
        // $registrados=mysqli_query($con, "SELECT tickets.id, tickets.client_id, tickets.status_id,tickets.number_ticket, tickets.asunt, tickets.asigned_id,tickets.status_id, tickets.status_ticket, area.supervisor_id, tickets.area,tickets.tipo_requerimiento,tickets.idPriority from tickets inner join area on tickets.area=area.id where (area.supervisor_id=$id or tickets.asigned_id=$id or tickets.client_id=$id) and (tickets.status_ticket=1 and tickets.status_id=1) order by tickets.created_at desc ");
        $registrados=mysqli_query($con, "SELECT tickets.id, tickets.client_id, tickets.status_id,tickets.number_ticket, tickets.asunt, tickets.asigned_id,tickets.status_id, tickets.status_ticket, area.supervisor_id, tickets.area,tickets.tipo_requerimiento,tickets.idPriority from tickets inner join area on tickets.area=area.id where (area.supervisor_id=$id or tickets.asigned_id=$id) and (tickets.status_ticket=1 and tickets.status_id=1) order by tickets.created_at desc ");

    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tickets Registrados</h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Tickets Registrados</li>
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
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead class="table_header">
                                <tr>
                                    <th></th>
                                    <th>N° Ticket</th>
                                    <th>Cliente</th>
                                    <th>Asunto</th>
                                    <th>Area</th>
                                    <th>Categoria</th>
                                    <th>Prioridad </th>
                                    <th>Estatus</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($registrados as $cat):
                                    $status_id=$cat['status_id'];
                                    $client_id=$cat['client_id'];
                                    // $area=$cat['area'];

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
                                    <td><?php echo $name_area;?></td>
                                    <td><?php echo $name_category;?></td>
                                    <td><?php echo $name_priority;?></td>
                                    <td><?php echo"<span class='label label-warning'>Registrado</span>" ?></td>
                                    <td style="text-align: center;">
                                        <!-- Split button -->
                                        <?php 

                                            /*$mi_area=mysqli_query($con,"select * from area where id=$area");
                                            $areas=mysqli_fetch_array($mi_area);
                                            //print_r($areas);
                                            if($areas['supervisor_id']==$id){*/
                                            if(@$cat['supervisor_id']==$id or $is_admin==1){
                                        ?>
                                        <div class="btn-group" style="width: 100px">
                                            <button type="button" class="btn btn-default">Acción</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="?view=asignar_ticket&id=<?php echo $cat['id'] ?>"><i class="fa fa-child"></i> Asignar</a></li>
                                                <li><a href="?view=cancel_ticket&id=<?php echo $cat['id'] ?>"><i class="fa fa-ban"></i> Cancelar Ticket</a></li>
                                            </ul>
                                        </div>
                                        <?php 
                                            }
                                        ?>
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