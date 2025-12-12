<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active2_0="active";
    include "header.php";
    include "sidebar.php";

    $prioritymatrix=mysqli_query($con, "select * from prioritymatrix order by idMatrix asc");
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Prioridades</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Prioridades</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <a onclick="location.href='?view=prioridades&success';" style="color:#fff; background-color:#0858D1;" class="btn btn-default pull-right" href="#"><i class='fa fa-floppy-o'></i> Guardar</a>
                    <br><br>
                    <?php 

                        if (isset($_GET)) {
                           if (isset($_GET['deletesuccess'])) {
                              echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Datos Eliminados Correctamente!</div>";
                           }
                           if (isset($_GET['errordelete'])) {
                              echo "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Hubo un error al eliminar los datos!</div>";
                           }
                           if (isset($_GET['success'])) {
                              echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>Datos Guardados Correctamente!</div>";
                           }
                        }

                    ?>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Registro de Prioridades</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                    <div id="resultados" class='col-md-12' ></div><!-- Carga los datos ajax -->
                            <!-- <table id="example1" class="table table-bordered table-striped"> -->
                            <table class="table table-bordered table-striped">
                                <thead class="table_header">
                                    <tr>
                                        <!-- <th>#ID</th> -->
                                        <th class="text-center">Impacto</th>
                                        <th class="text-center">Urgencia</th>
                                        <th class="text-center">Prioridad</th>
                                        <!-- <th>Estado</th> -->
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach($prioritymatrix as $priority_max):
                                        $idImpact=$priority_max['idImpact'];


                                        $impactos=mysqli_query($con,"select * from impact where idImpact=$idImpact");
                                        $rw_impact=mysqli_fetch_array($impactos);
                                        $Description_impact=$rw_impact['Description'];


                                        $idUrgency=$priority_max['idUrgency'];
                                        $urgencias=mysqli_query($con,"select * from urgency where idUrgency=$idUrgency");
                                        $rw_urgency=mysqli_fetch_array($urgencias);
                                        $Description_urgency=$rw_urgency['Description'];


                                        $idPriority=$priority_max['idPriority'];
                                        $prioridades=mysqli_query($con,"select * from priority where idPriority=$idPriority");
                                        $rw_priority=mysqli_fetch_array($prioridades);
                                        $Description_priority=$rw_priority['Description'];

                                        $active=$priority_max['Active'];
                                       
                                        if($active==1){
                                            $status="<span class='label label-success'>Activo</span>";
                                        }else if($active==0){
                                            $status="<span class='label label-danger'>Inactivo</span>";
                                        }

                                ?>
                                    <tr>
                                        <!-- <td><?php echo $priority_max['idMatrix'] ?></td> -->
                                        <td class="text-center"><?php echo $Description_impact; ?></td>
                                        <td class="text-center"><?php echo $Description_urgency; ?></td>
                                        <!-- <td><?php echo $Description_priority; ?></td> -->
                                        <td class="text-center" style="width: 250px">
                                               <select name="q" id="q" class="form-control text-center" onchange="priority_update(<?php echo $priority_max['idMatrix']; ?>,$(this).val());">
                                                        <option value="0"  <?php if($priority_max['idPriority']>0){ echo "selected";}?>>Sin Prioridad</option>
                                                    <?php
                                                        $priority_sql=mysqli_query($con,"select * from priority");
                                                            foreach ($priority_sql as $priority) {  
                                                    ?>  
                                                        <option value="<?php echo $priority['idPriority'];?>" <?php 
                                                                if ($priority_max['idPriority']==$priority['idPriority']) {
                                                                    echo "selected";
                                                                }
                                                                ?>>
                                                            <?php echo $priority['Description'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                        </td>
                                        <!-- <td><?php echo $status; ?></td> -->
                                        <!-- <td style="text-align: center;">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Acción</button>
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="?view=editar_prioridad&id=<?php echo $priority_max['idMatrix'] ?>"><i class="fa fa-pencil"></i> Editar</a></li>
                                                    <li><a href="action/delpriority.php?id=<?php echo $priority_max['idMatrix'] ?>"><i class="fa fa-trash"></i> Eliminar</a></li> 
                                                </ul>
                                            </div>
                                        </td>-->
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
<script>
    
    function priority_update(id,value){
        // var value=$("#q").val();

        var parametros = {"value":value,'id':id};
        $.ajax({
            type: "POST",
            url: "ajax/upd_priority.php",
            // data: "value="+value+"&id="+id,
            data: parametros,
                success: function(datos){
                    $("#resultados").html(datos);
                }
        });
    }
</script>