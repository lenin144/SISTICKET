<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/

    include "header.php";
    include "sidebar.php";

    $celulares =mysqli_query($con, "select * from celulares order by MES asc");
    
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
                    <a style="color:#fff; background-color:#F2C811;" class="btn btn-default pull-right" href="#"><i class='fa fa-file-excel-o'></i> Power BI</a>
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="action/excel_celulares.php"><i class='fa fa-file-excel-o'></i> Excel</a>
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_celulares"><i class='fa fa-plus'></i> Nuevo</a>
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
                                        
                                        <th style="background: #ca4300">Telefono</th>
                                        <th>Monto total sin IGV</th>
                                        <th>Monto total con IGV</th>
                                        <th>Fecha de recibo</th>
                                        <th>Mes</th>
                                        <th>Plan</th>
                                        <th>Responsable</th>
                                        <th>Ubicacion</th>
                                        <th>Area</th>
                                        <th>Equipo</th>
                                        <th>Sistema Operativo</th>
                                        <th>IMEI</th>
                                        <th>Marca</th>
                                        <th>Fecha de compra</th>
                                        <th>Fecha de activacion de Chip</th>
                                        <th>Estado</th>
                                        <th>Con o sin equipo</th>
                                        <th>Fecha de renovacion</th>
                                        <th>Cobranzas diferidas</th>
                                        <th>Penalidad</th>
                                        <th>Reconexion por morosidad sin IGV</th>
                                        <th>Reconexion por morosidad con IGV</th>
                                        <th>Cambio de numero</th>
                                        <th>Cambio de numero con IGV</th>
                                        <th>Recibo</th>
                                         <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($celulares as $item):
                                ?>
                                    <tr>
                             
                                        <td><?php echo $item['TELEFONO'] ?></td>
                                        <td><?php echo $item['MONTO_TOTAL_SIN_IGV'] ?></td>
                                        <td><?php echo $item['MONTO_TOTAL_CON_IGV'] ?></td>
                                        <td><?php echo $item['FECHA_DE_RECIBO'] ?></td>
                                        <td><?php echo $item['MES'] ?></td>
                                        <td><?php echo $item['PLAN'] ?></td>
                                        <td><?php echo $item['RESPONSABLE'] ?></td>
                                        <td><?php echo $item['UBICACION'] ?></td>
                                        <td><?php echo $item['AREA'] ?></td>
                                        <td><?php echo $item['EQUIPO'] ?></td>
                                        <td><?php echo $item['SISTEMA_OPERATIVO'] ?></td>
                                        <td><?php echo $item['IMEI'] ?></td>
                                        <td><?php echo $item['MARCA'] ?></td>
                                        <td><?php echo $item['FECHA_DE_COMPRA'] ?></td>
                                        <td><?php echo $item['FECHA_DE_ACTIVACION_CHIP'] ?></td>
                                        <td><?php echo $item['ESTADO'] ?></td>
                                        <td><?php echo $item['CON_O_SIN_EQUIPO'] ?></td>
                                        <td><?php echo $item['FECHA_DE_RENOVACION'] ?></td>
                                        <td><?php echo $item['COBRANZAS_DIFERIDAS'] ?></td>
                                        <td><?php echo $item['PENALIDAD'] ?></td>
                                        <td><?php echo $item['RECONEXION_POR_MOROSIDAD_SIN_IGV'] ?></td>
                                        <td><?php echo $item['RECONEXION_POR_MOROSIDAD_CON_IGV'] ?></td>
                                        <td><?php echo $item['CAMBIO_DE_NUMERO'] ?></td>
                                        <td><?php echo $item['CAMBIO_DE_NUMERO_CON_IGV'] ?></td>
                                        <td><?php 
                                            if($item['adjunto1'] != null){
                                                echo "<a href=../".$item['adjunto1']." target='_blank'>Archivo 1</a>";
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
                                                    <li><a href="?view=editar_celulares&id=<?php echo $item['id'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    <li><a href="action/delcelulares.php?id=<?php echo $item['id'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li>
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