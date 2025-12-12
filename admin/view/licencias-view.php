<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/

    include "header.php";
    include "sidebar.php";

    $licencias =mysqli_query($con, "select * from licencias order by equipo asc");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>INVENTARIO DE LICENCIAS - LIMA AREQUIPA</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Inventario</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="action/excel_licencias.php"><i class='fa fa-file-excel-o'></i> Excel</a>
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_licencias"><i class='fa fa-plus'></i> Nuevo</a>
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
                            <h3 class="box-title">Inventario de licencias Lima - Arequipa</h3>
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
                                        <th>Programa</th>
                                        <th>Licencia</th>
                                        <th>Correo</th>
                                        <th>Clave</th>
                                        <th>Fecha de registro</th>
                                        <th>Fecha de Vcto.</th>
                                        <th>Estado</th>
                                        <th>Obs.</th>
                                        <th>Nombre de proveedor</th>
                                        <th>Numero de Proveedor</th>
                                        <th>Acta</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($licencias as $item):
                                ?>
                                    <tr>
                             
                                        <td><?php echo $item['equipo'] ?></td>
                                        <td><?php echo $item['responsable'] ?></td>
                                        <td><?php echo $item['departamento'] ?></td>
                                        <td><?php echo $item['sucursal'] ?></td>
                                        <td><?php echo $item['programa'] ?></td>
                                        <td><?php echo $item['licencia'] ?></td>
                                        <td><?php echo $item['correo'] ?></td>
                                        <td><?php echo $item['clave'] ?></td>
                                        <td><?php echo $item['fechareg'] ?></td>
                                        <td><?php echo $item['fechaven'] ?></td>
                                        <td><?php echo $item['estado'] ?></td>
                                        <td><?php echo $item['observacion'] ?></td>
                                        <td><?php echo $item['nompro'] ?></td>
                                        <td><?php echo $item['numpro'] ?></td>
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
                                                    <li><a href="?view=editar_licencias&id=<?php echo $item['id'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    <li><a href="action/dellicencias.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li>
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