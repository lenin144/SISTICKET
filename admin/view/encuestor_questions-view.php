<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $activeEnkuestor="active";
    $activeEnkuestorDesign="active";
    include "header.php";
    include "sidebar.php";

    $id=intval($_GET['idsurvey']);
    if (isset($_GET['idsurvey']) && !empty($_GET['idsurvey'])){
        $id=$_GET["idsurvey"];
    } else {
        header("Location: ?view=encuestor_design");  
    }

    $tipos=mysqli_query($con, "select * from surveyquestions where idSurvey=$id order by idQuestion asc");
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Preguntas</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=encuestor_design"><i class="fa fa-calendar-o"></i> Encuestas</a></li>
                <li class="active">Preguntas</li>
            </ol>


        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <a style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="?view=nuevo_encuestor_question&idsurvey=<?php echo $id ?>"><i class='fa fa-plus'></i> Nueva</a>
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
                            <h3 class="box-title">Registro de Preguntas</h3>
                            <?php 
                                $sqlSurvey=mysqli_query($con,"SELECT * FROM Survey where idSurvey=$id");
                                $surveyRow=mysqli_fetch_array($sqlSurvey);
                            ?>
                            <p></p>
                            <p>
                                <i class="fa fa-check-circle-o"></i><strong> Encuesta:</strong> <?php echo $surveyRow['Title'] ?>
                            </p>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="table_header">
                                    <tr>
                                        <th>Pregunta</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($tipos as $area):
                                        $active=$area['Active'];
                                       
                                        if($active==1){
                                            $status="<span class='label label-success'>Activo</span>";
                                        }else if($active==0){
                                            $status="<span class='label label-danger'>Inactivo</span>";
                                        }
                                ?>
                                    <tr>
                                        <td><?php echo $area['Description'] ?></td>
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
                                                    <li><a href="?view=editar_encuestor_question&id=<?php echo $area['idQuestion'] ?>&idsurvey=<?php echo intval($_GET['idsurvey']) ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    <li><a href="?view=encuestor_response&idsurvey=<?php echo intval($_GET['idsurvey']) ?>&idquestion=<?php echo $area['idQuestion'] ?>"><i class="fa fa-compress"></i> Respuestas</a></li>
                                                    <!-- <li><a href="action/delrequerimiento.php?id=<?php echo $area['idSurvey'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li> -->
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