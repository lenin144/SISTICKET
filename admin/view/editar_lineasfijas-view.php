<?php
/*-------------------------
Autor: Autor Dev
Web: www.google.com
E-Mail: waptoing7@gmail.com
---------------------------*/
$active13 = "active";
include "header.php";
include "sidebar.php";

$id = intval($_GET['id']);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET["id"];
} else {
    header("Location:?view=lineasfijas");
}

$sql = mysqli_query($con, "select * from lineasfijas where id=$id");
while ($rows = mysqli_fetch_array($sql)) {
    $id = $rows['id'];
    $MONTO_TOTAL_CON_IGV = $rows['MONTO_TOTAL_CON_IGV'];
    $FECHA_DE_RECIBO = $rows['FECHA_DE_RECIBO'];
    $MES = $rows['MES'];
    $SERVICIO = $rows['SERVICIO'];
    $MB = $rows['MB'];
    $RESPONSABLE = $rows['RESPONSABLE'];
    $UBICACION = $rows['UBICACION'];
    $AREA = $rows['AREA'];
    $adjunto1 = $rows['adjunto1'];
}

if ($is_admin != 1) {
    print "<script>window.location='?view=dashboard&error';</script>";
}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Datos de lineas fijas</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=lineasfijas"><i class="fa fa-bars"></i> Datos</a></li>
                <li class="active">Editar Dato</li>
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
                            <h3 class="box-title">Editar lineas fijas</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="upd" id="upd" enctype="multipart/form-data">
                            <div class="box-body">
                            <div class="form-group">
                                    <label for="MONTO_TOTAL_CON_IGV">Monto total con IGV</label>
                                    <input type="text" name="MONTO_TOTAL_CON_IGV" class="form-control" id="equipo" placeholder="Monto total con IGV" value="<?php echo $MONTO_TOTAL_CON_IGV ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="FECHA_DE_RECIBO">Fecha de recibo</label>
                                    <input type="date" name="FECHA_DE_RECIBO" class="form-control" id="FECHA_DE_RECIBO" placeholder="Fecha de recibo" value="<?php echo $FECHA_DE_RECIBO ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="MES">Mes</label>
                                    <input type="text" name="MES" class="form-control" id="MES" placeholder="Mes" value="<?php echo $MES ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="SERVICIO">Servicio</label>
                                    <input type="text" name="SERVICIO" class="form-control" id="SERVICIO" placeholder="Servicio" value="<?php echo $SERVICIO ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="MB">MB</label>
                                    <input type="text" name="MB" class="form-control" id="MB" placeholder="MB" value="<?php echo $MB ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="RESPONSABLE">Responsable</label>
                                    <input type="text" name="RESPONSABLE" class="form-control" id="RESPONSABLE" placeholder="Responsable" value="<?php echo $RESPONSABLE ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="UBICACION">Ubicacion</label>
                                    <input type="text" name="UBICACION" class="form-control" id="UBICACION" placeholder="Total" value="<?php echo $UBICACION ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="AREA">Area</label>
                                    <input type="text" name="AREA" class="form-control" id="AREA" placeholder="Total" value="<?php echo $AREA ?>" required="">
                                </div>
                               
                              
                                <div class="form-group">
                                    <label for="asunt">Archivo adjunto 1</label>
                                    <input type="file" class='form-control' name="imagefile" id="imagefile">

                                </div>
                                
                                    <?php
                                    if ($adjunto1 != null) {
                                        echo "<br><span><a href=../" . $adjunto1 . " target='_blank'>Descargar archivo 1</a></span>";
                                    }
                                    ?>
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" id="save_data" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

  <?php include "footer.php"?>

<script>
$( "#upd" ).submit(function( event ) {
    $('#upd_data').attr("disabled", true);

     if($("#imagefile").val()!="" || $("#imagefile2").val()!="" || $("#imagefile3").val()!=""){
                var fileExist= "?file=true";
                // console.log('hay archivo');
            }else{
                var fileExist= "?file=false";
                // console.log('no hay archivos');
            }
         $.ajax({
                type: "POST",
                url: "action/updlineasfijas.php" + fileExist,
                data:  new FormData(this),
                contentType:false,
                processData:false,
                 beforeSend: function(objeto){
                    $("#result").html("Mensaje: Cargando...");
                  },
                success: function(lineasfijas){
                $("#result").html(lineasfijas);
                $('#upd_data').attr("disabled", false);
                load(1);
              }
        });
      event.preventDefault();
});

</script>