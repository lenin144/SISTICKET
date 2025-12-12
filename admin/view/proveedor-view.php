<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/

    include "header.php";
    include "sidebar.php";

    $proveedor =mysqli_query($con, "select * from proveedor order by tipo asc");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>REPORTE DE PROVEEDOR T.I. - LIMA AREQUIPA</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Reporte de proveedores</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="action/excel_proveedor.php"><i class='fa fa-file-excel-o'></i> Excel</a>
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_proveedor"><i class='fa fa-plus'></i> Nuevo</a>
                    <br><br>
                    <?php 

                        if (isset($_GET)) {
                           if (isset($_GET['deletesuccess'])) {
                              echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Datos Eliminados Correctamente!</div>";
                           }
                           if (isset($_GET['errordelete'])) {
                              echo "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Hubo un error al eliminar los datos!</div>";
                           }
                        }

                    ?>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Inventario de Proveedores Lima - Arequipa</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="table_header">
                                    <tr>
                                        
                                        <th style="background: #ca4300">Tipo de documento</th>
                                        <th>Numero de documento</th>
                                        <th>Razon social</th>
                                        <th>Direccion</th>
                                        <th>Nombre del vendedor</th>
                                        <th>Celular</th>
                                        <th>Correo</th>
                                        <th>Acta</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($proveedor as $item):
                                ?>
                                    <tr>
                             
                                        <td><?php echo $item['tipo'] ?></td>
                                        <td><?php echo $item['numero'] ?></td>
                                        <td><?php echo $item['razon'] ?></td>
                                        <td><?php echo $item['direccion'] ?></td>
                                        <td><?php echo $item['nombre'] ?></td>
                                        <td><?php echo $item['celular'] ?></td>
                                        <td><?php echo $item['correo'] ?></td>
                                        <td><?php 
                                            if($item['adjunto1'] != null){
                                                echo "<a href=../".$item['adjunto1']." target='_blank'>Archivo 1</a>";
                                            }
                                            if($item['adjunto2'] != null){
                                                echo "<a href=../".$item['adjunto2']." target='_blank'>, Archivo 2</a>";
                                            }
                                            if($item['adjunto3'] != null){
                                                echo "<a href=../".$item['adjunto3']." target='_blank'>, Archivo 3</a>";
                                            }
                                        ?></td>
                                        
                                        <td style="text-align: center;">
                                            <!-- Split button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Acción</button>
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="?view=editar_proveedor&id=<?php echo $item['id'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    <li><a href="action/delproveedor.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>    
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