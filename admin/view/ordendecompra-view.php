<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/

    include "header.php";
    include "sidebar.php";

    $ordendecompra =mysqli_query($con, "select * from ordendecompra order by area asc");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>REGISTRO DE ORDENES DE COMPRA- LIMA AREQUIPA</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Ordenes de compra</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="action/excel_ordendecompra.php"><i class='fa fa-file-excel-o'></i> Excel</a>
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_ordendecompra"><i class='fa fa-plus'></i> Nuevo</a>
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
                            <h3 class="box-title">Registro de ordenes de compra Lima - Arequipa</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="table_header">
                                    <tr>
                                        
                                        <th style="background: #ca4300">Area</th>
                                        <th>Usuario</th>
                                        <th>Numero de O.C.</th>
                                        <th>Proveedor</th>
                                        <th>Fecha</th>
                                        <th>Bien o Servicio</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>Precio total en soles</th>
                                        <th>Precio total en dolares</th>
                                        <th>Orden de compra</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($ordendecompra as $item):
                                ?>
                                    <tr>
                             
                                        <td><?php echo $item['area'] ?></td>
                                        <td><?php echo $item['usuario'] ?></td>
                                        <td><?php echo $item['numero'] ?></td>
                                        <td><?php echo $item['proveedor'] ?></td>
                                        <td><?php echo $item['fecha'] ?></td>
                                        <td><?php echo $item['bienservicio'] ?></td>
                                        <td><?php echo $item['categoria'] ?></td>
                                        <td><?php echo $item['marca'] ?></td>
                                        <td><?php echo $item['descripcion'] ?></td>
                                        <td><?php echo $item['cantidad'] ?></td>
                                        <td><?php echo $item['ptsoles'] ?></td>
                                        <td><?php echo $item['ptdolares'] ?></td>
                                        <td><?php 
                                            if($item['adjunto1'] != null){
                                                echo "<a href=".$item['adjunto1']." target='_blank'>Archivo 1</a>";
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
                                                    <li><a href="?view=editar_ordendecompra&id=<?php echo $item['id'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    <li><a href="action/delordendecompra.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li>
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