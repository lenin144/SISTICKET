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
            <h1>Cancelar Ticket</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><i class="fa fa-tickets"></i> Tickets</li>
                <li class="active">Cancelar Ticket</li>
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
                            <h3 class="box-title">Cancelar Ticket</h3>
                        </div> <!-- /.box-header -->
                        <form role="form" method="post" name="upd" id="upd" enctype="multipart/form-data"><!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="idReasonCancellation">Motivo</label>
                                    <select name="idReasonCancellation" class="chosen-select form-control" id="idReasonCancellation" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                    <?php
                                        $sql=mysqli_query($con, "select * from reasoncancellation");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['idReasonCancellation'] ?>" ><?php echo $row['Description'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripción: </label>
                                    <textarea required type="text" name="description" class="form-control" id="description" placeholder="Descripción..." rows="10"></textarea>
                                </div>
                                <input type="hidden" name="mod_id" value="<?php echo $id ?>">
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" id="save_data" class="btn btn-success">Cancelar Ticket</button>
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
$( "#upd" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addcancelticket.php",
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