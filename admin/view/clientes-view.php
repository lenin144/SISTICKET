<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active10="active";
    include "header.php";
    include "sidebar.php";

    $clientes=mysqli_query($con, "select * from user where is_client=1");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Clientes</h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Clientes</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <a style="color:#fff; background-color: #0858D1;" class="btn btn-default pull-right" href="?view=nuevo_cliente"><i class='fa fa-plus'></i> Nuevo</a>
                    <br><br>
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
                      <h3 class="box-title">Registro de clientes</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="table_header">
                                <tr>
                                    <!-- <th>#ID</th> -->
                                    <th>Empresa</th>
                                    <th>Cliente</th>
                                    <th>Correo Electrónico</th>
                                    <th>Telefóno</th>
                                    <th>RFC</th>
                                    <th>Fecha / Hora</th>
                                    <th>Último ingreso</th>
                                    <th>Último salida</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($clientes as $cliente):
                                    $id=$cliente['id'];
                                    $active=$cliente['is_active'];
                                    if($active==1){
                                        $status="<span class='label label-success'>Activo</span>";
                                    }else if($active==0){
                                        $status="<span class='label label-danger'>Inactivo</span>";
                                    }
                                    // $tickets=mysqli_query($con, "select * from tickets where client_id=$id");
                            ?>
                                <tr>
                                    <!-- <td><?php echo $cliente['id'] ?></td> -->
                                    <td><?php echo $cliente['business'] ?></td>
                                    <td><?php echo $cliente['name']," ",$cliente['lastname'] ?></td>
                                    <td><?php echo $cliente['email'] ?></td>
                                    <td><?php echo $cliente['phone'] ?></td>
                                    <td><?php echo $cliente['ruc'] ?></td>
                                    <td><?php echo $cliente['created_at'] ?></td>
                                    <td><?php echo $cliente['last_login'] ?></td>
                                    <td><?php echo $cliente['last_logout'] ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td style="text-align: center;">
                                        <!-- Split button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Acción</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="?view=editar_cliente&id=<?php echo $cliente['id'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                <!-- <li><a href="action/delclient.php?id=<?php echo $cliente['id'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li> -->
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
    </section> <!-- /.content -->
</div><!-- /.content-wrapper -->

<?php include "footer.php" ?>