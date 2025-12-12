<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active2="active";
    include "header.php";
    include "sidebar.php";

    $id=intval($_GET['id']);

    if (isset($_GET['id']) && !empty($_GET['id'])){
        $id=$_GET["id"];
    }else{
        header("Location: ?view=dashboard&error");  
    }   
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Bitacora</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><i class="fa fa-tickets"></i> Tickets</li>
                <li class="active">Nueva Bitacora</li>
            </ol>
        </section>
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-xs-12 col-md-6">
                <div id="result"></div>
                    <!-- general form elements -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nueva Bitacora</h3>
                        </div> <!-- /.box-header -->
                        <form role="form" method="post" name="upd" id="upd" enctype="multipart/form-data"><!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="date">Fecha: </label>
                                    <input type="date" class="form-control" id="date" name="date" required value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="time">Hora: </label>
                                    <input type="time" class="form-control" id="time" name="time" required value="<?php echo date("H:i"); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="incidencia">Incidencía: </label>
                                    <textarea required type="text" name="incidencia" class="form-control" id="incidencia" placeholder="Bitacora..." rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="asunt">Adjunto:</label>
                                    <input type="file" class='form-control' name="imagefile[]" multiple id="imagefile">
                                    <span class="text-info">Selecciona un archivo, Peso Máximo 2MB</span>
                                </div>
                                <input type="hidden" name="mod_id" value="<?php echo $id ?>">
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
$("#upd").submit(function( event ) {
    $('#upd_data').attr("disabled", true);
    if($("#imagefile").val()!=""){
        var fileExist= "?file=true";
        // console.log('hay archivo');
    }else{
        var fileExist= "?file=false";
        // console.log('no hay archivos');
    }
    $.ajax({
        type: "POST",
        url: "action/addincidencia.php"+fileExist,
        data: new FormData(this),
        contentType:false,
        processData:false,
        beforeSend: function(objeto){
            $("#result").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#result").html(datos);
            $('#upd_data').attr("disabled", false);
            // load(1);
        }
    });
    event.preventDefault();
})
</script>