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
    } else {
        header("Location: ?view=cancelados");  
    }

   
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Finalizar Ticket</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><i class="fa fa-tickets"></i> Tickets</li>
                <li class="active">Finalizar Ticket</li>
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
                            <h3 class="box-title">Finalizar Ticket</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="upd" id="upd" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="idCauseSolution">Causa de Solución</label>
                                    <select name="idCauseSolution" class="chosen-select form-control" id="idCauseSolution" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                    <?php
                                        $sql=mysqli_query($con, "select * from causesolution");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['idCauseSolution'] ?>" ><?php echo $row['Description'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="datepicker">Fecha: </label>
                                    <input type="text" class="form-control" id="datepicker" name="date" required value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="time">Hora: </label>
                                    <input type="time" class="form-control" id="time" name="time" required value="<?php echo date("H:i"); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="comentario">Solución: </label>
                                    <textarea required type="text" name="comentario" class="form-control" id="comentario" placeholder="Solución"></textarea>
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
                                <button type="submit" id="save_data" class="btn btn-success">Finalizar Ticket</button>
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
        url: "action/addfinishticket.php"+fileExist,
        data: new FormData(this),
        contentType:false,
        processData:false,
        beforeSend: function(objeto){
            $("#result").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#result").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
        }
    });
  event.preventDefault();
})
</script>