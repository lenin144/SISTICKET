<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/

    include "header.php";
    include "sidebar.php";

    $datos =mysqli_query($con, "select * from datos order by nombre asc");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>INVENTARIO Y ACTAS - DESKTOP Y LAPTOP - LIMA AREQUIPA</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Inventario</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="action/excel_datos.php"><i class='fa fa-file-excel-o'></i> Excel</a>
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_dato"><i class='fa fa-plus'></i> Nuevo</a>
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
                            <h3 class="box-title">Inventario de equipos Lima - Arequipa</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="table_header">
                                    <tr>
                                        
                                        <th style="background: #ca4300">Equipo</th>
                                        <th>Responsable</th>
                                        <th>Departamento</th>
                                        <th>Sucursal</th>
                                        <th>Categoria</th>
                                        <th>Descripcion</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Nombre del equipo</th>
                                        <th>Serial</th>
                                        <th>Sistema operativo</th>
                                        <th>Procesador</th>
                                        <th>Memoria</th>
                                        <th>Estado</th>
                                        <th>Acta</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($datos as $item):
                                ?>
                                    <tr>
                             
                                        <td><?php echo $item['nombre'] ?></td>
                                        <td><?php echo $item['apellido'] ?></td>
                                        <td><?php echo $item['departamento'] ?></td>
                                        <td><?php echo $item['sucursal'] ?></td>
                                        <td><?php echo $item['categoria'] ?></td>
                                        <td><?php echo $item['edad'] ?></td>
                                        <td><?php echo $item['marca'] ?></td>
                                        <td><?php echo $item['modelo'] ?></td>
                                        <td><?php echo $item['equipo'] ?></td>
                                        <td><?php echo $item['serial'] ?></td>
                                        <td><?php echo $item['so'] ?></td>
                                        <td><?php echo $item['procesador'] ?></td>
                                        <td><?php echo $item['memoria'] ?></td>
                                        <td><?php echo $item['estado'] ?></td>
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
                                                    <li><a href="?view=editar_dato&id=<?php echo $item['id'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    <li><a href="action/delDato.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li>
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