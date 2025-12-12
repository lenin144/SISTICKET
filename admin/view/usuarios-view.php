<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active11="active";
    include "header.php";
    include "sidebar.php";
    $usuarios=mysqli_query($con, "select * from user where is_client=0");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Usuarios</h1>
        <ol class="breadcrumb">
            <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Usuarios</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_usuario"><i class='fa fa-plus'></i> Nuevo</a>
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
                      <h3 class="box-title">Registro de usuarios</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="table_header">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Correo Electrónico</th>
                                    <!-- <th>Activo</th> -->
                                    <th>Tipo de Usuarios</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($usuarios as $user):
                                $active=$user['is_active'];
                                       
                                if($active==1){
                                    $status="<span class='label label-success'>Activo</span>";
                                }else if($active==0){
                                    $status="<span class='label label-danger'>Inactivo</span>";
                                }
                            ?>
                                <tr>
                                    <td><?php echo $user['name']." ".$user['lastname'] ?></td>
                                    <td><?php echo $user['username'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <!-- <td style="text-align: center;"><?php 
                                        if($user['is_active']){
                                            echo "<i class='glyphicon glyphicon-ok'></i>";
                                        }else{
                                             echo "<i class='glyphicon glyphicon-remove'></i>";
                                        }

                                    ?></td> -->
                                    <td>
                                        <?php if($user['is_admin']){
                                            echo "Admin";
                                        }else{
                                            echo "Agente";
                                        }

                                        ?>
                                        
                                    </td>
                                    <td><?php echo $status; ?></td>
                                    <td style="text-align: center;">
                                        <!-- Split button -->
                                        <div class="btn-group"  style="width: 100px">
                                            <button type="button" class="btn btn-default">Acción</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="?view=editar_usuario&id=<?php echo $user['id'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                <li><a href="?view=reporte_usuario&id=<?php echo $user['id'] ?>"><i class="fa fa-bar-chart-o"></i> Reporte</a></li>
                                                <!-- <li><a href="action/deluser.php?id=<?php echo $user['id'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li> -->
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