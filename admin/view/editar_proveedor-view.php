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
    header("Location:?view=proveedor");
}

$sql = mysqli_query($con, "select * from proveedor where id=$id");
while ($rows = mysqli_fetch_array($sql)) {
    $id = $rows['id'];
    $tipo = $rows['tipo'];
    $numero = $rows['numero'];
    $razon = $rows['razon'];
    $direccion = $rows['direccion'];
    $nombre = $rows['nombre'];
    $celular = $rows['celular'];
    $correo = $rows['correo'];
    $adjunto1 = $rows['adjunto1'];
    $adjunto2 = $rows['adjunto2'];
    $adjunto3 = $rows['adjunto3'];
}

if ($is_admin != 1) {
    print "<script>window.location='?view=dashboard&error';</script>";
}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Datos de equipo dañados</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=proveedor"><i class="fa fa-bars"></i> Datos</a></li>
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
                            <h3 class="box-title">Editar Productos Dañados</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="upd" id="upd" enctype="multipart/form-data">
                            <div class="box-body">
                            <div class="form-group">
                                    <label for="tipo">Tipo de documento</label>
                                    <input type="text" name="tipo" class="form-control" id="tipo" placeholder="Tipo de documento" value="<?php echo $tipo ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="numero">Numero de Documento</label>
                                    <input type="text" name="numero" class="form-control" id="numero" placeholder="Numero de documento" value="<?php echo $numero ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="razon">Razon social</label>
                                    <input type="text" name="razon" class="form-control" id="razon" placeholder="Razon social" value="<?php echo $razon ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Direccion</label>
                                    <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Direccion" value="<?php echo $direccion ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre del vendedor</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre del vendedor" value="<?php echo $nombre ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="text" name="celular" class="form-control" id="celular" placeholder="Celular" value="<?php echo $celular ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="text" name="correo" class="form-control" id="correo" placeholder="Correo" value="<?php echo $correo ?>" required="">
                                </div>
                               
                              
                                <div class="form-group">
                                    <label for="asunt">Archivo adjunto 1</label>
                                    <input type="file" class='form-control' name="imagefile" id="imagefile">

                                </div>
                                <div class="form-group">
                                    <label for="asunt">Archivo adjunto 2</label>
                                    <input type="file" class='form-control' name="imagefile2" id="imagefile2">

                                </div>
                                <div class="form-group">
                                    <label for="asunt">Archivo adjunto 3</label>
                                    <input type="file" class='form-control' name="imagefile3" id="imagefile3">

                                </div>
                                    <?php
                                    if ($adjunto1 != null) {
                                        echo "<br><span><a href=../" . $adjunto1 . " target='_blank'>Descargar archivo 1</a></span>";
                                    }
                                    if ($adjunto2 != null) {
                                        echo "<br><span><a href=../" . $adjunto2 . " target='_blank'>Descargar archivo 2</a></span>";
                                    }
                                    if ($adjunto3 != null) {
                                        echo "<br><span><a href=../" . $adjunto3 . " target='_blank'>Descargar archivo 3</a></span>";
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
                url: "action/updproveedor.php" + fileExist,
                data:  new FormData(this),
                contentType:false,
                processData:false,
                 beforeSend: function(objeto){
                    $("#result").html("Mensaje: Cargando...");
                  },
                success: function(proveedor){
                $("#result").html(proveedor);
                $('#upd_data').attr("disabled", false);
                load(1);
              }
        });
      event.preventDefault();
});

</script>