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


    $id=intval($_GET['idquestion']);
    if (isset($_GET['idquestion']) && !empty($_GET['idquestion'])){
        $id=$_GET["idquestion"];
    } else {
        header("Location: ?view=encuestor_design");  
    }
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Respuestas</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=encuestor_design"><i class="fa fa-calendar-o"></i> Encuestas</a></li>
                <li><a href="?view=encuestor_questions&idsurvey=<?php echo intval($_GET['idsurvey']) ?>"><i class="fa fa-question"></i> Preguntas</a></li>
                <li><a href="?view=encuestor_response&idsurvey=<?php echo intval($_GET['idsurvey']) ?>&idquestion=<?php echo intval($_GET['idquestion']) ?>"><i class="fa fa-th-list"></i> Respuestas</a></li>
                <li class="active">Nueva Respuesta</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-xs-12 col-md-6">
                <div id="result"></div>
                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nueva Respuesta</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="add" id="add">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <input type="text" name="description" class="form-control" id="description">
                                </div>
                                <div class="form-group">
                                    <label for="SatisfactionPorcentage">Porcentaje de Satisfacción</label>
                                    <input type="number" name="SatisfactionPorcentage" class="form-control" id="SatisfactionPorcentage">
                                </div>
                                <input type="hidden" name="idquestion" id="idquestion" value="<?php echo intval($_GET['idquestion']) ?>">
                                <input type="hidden" name="idsurvey" id="idsurvey" value="<?php echo intval($_GET['idsurvey']) ?>">
                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" class="chosen-select form-control" id="status" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                            <option value="1" >Activo</option>
                                            <option value="0" >Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" id="save_data" class="btn btn-success">Agregar</button>
                                <a style="margin-left: 20px;" class="btn btn-default" href="javascript:history.back()"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

  <?php include "footer.php" ?>

<script>
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addencuestorResponse.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

</script>