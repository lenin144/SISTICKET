<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $activeEnkuestor="active";
    $activeEnkuestorConfig="active";
    include "header.php";
    include "sidebar.php";

    $tipos=mysqli_query($con, "select * from surveycategory order by idSurveyCategory asc");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Configuración de Encuestas</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Configuración de Encuestas</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_encuestor_config"><i class='fa fa-plus'></i> Nueva</a>
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
                            <h3 class="box-title">Registro de Configuración de Encuestas</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="table_header">
                                    <tr>
                                        <th>Encuesta</th>
                                        <th>Area</th>
                                        <th>Categoría</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($tipos as $cat):
                                        $active=$cat['Active'];

                                        $IdCategory=$cat['IdCategory'];

                                        $categories = mysqli_query($con,"SELECT tipos_requerimientos.name as category, area.name as area FROM tipos_requerimientos inner join area on tipos_requerimientos.area_id=area.id where tipos_requerimientos.id=$IdCategory");
                                        $rw_cat = mysqli_fetch_array($categories);
                                        $area_name = $rw_cat['area'];
                                        $category_name = $rw_cat['category'];
                                       
                                        if($active==1){
                                            $status="<span class='label label-success'>Activo</span>";
                                        }else if($active==0){
                                            $status="<span class='label label-danger'>Inactivo</span>";
                                        }
                                ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                $idSurvey= $cat['idSurvey'];
                                                $areas=mysqli_query($con,"select Title from survey where idSurvey=$idSurvey");
                                                $rows=mysqli_fetch_array($areas);
                                                echo $rows['Title'];
                                            ?>
                                        </td>
                                        <td><?php echo $area_name ?></td>
                                        <td><?php echo $category_name ?></td>
                                        <td><?php echo $cat['ExpireDateStar']; ?></td>
                                        <td><?php echo $cat['ExpireDateEnd']; ?></td>
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
                                                    <li><a href="?view=editar_encuestor_config&id=<?php echo $cat['idSurveyCategory'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    <!-- <li><a href="action/delrequerimiento.php?id=<?php echo $cat['id'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li> -->
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