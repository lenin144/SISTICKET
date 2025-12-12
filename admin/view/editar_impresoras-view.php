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
    header("Location:?view=impresoras");
}

$sql = mysqli_query($con, "select * from impresoras where id=$id");
while ($rows = mysqli_fetch_array($sql)) {
    $id = $rows['id'];
    $equipo = $rows['equipo'];
    $responsable = $rows['responsable'];
    $departamento = $rows['departamento'];
    $sucursal = $rows['sucursal'];
    $categoria = $rows['categoria'];
    $descripcion = $rows['descripcion'];
    $marca = $rows['marca'];
    $modelo = $rows['ip'];
    $ip = $rows['sucursal'];
    $estado = $rows['estado'];
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
            <h1>Datos Impresora</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=impresoras"><i class="fa fa-bars"></i> Datos</a></li>
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
                            <h3 class="box-title">Editar Categoria</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="upd" id="upd" enctype="multipart/form-data">
                            <div class="box-body">
                            <div class="form-group">
                                    <label for="equipo">Equipo</label>
                                    <input type="text" name="equipo" class="form-control" id="equipo" placeholder="Equipo" value="<?php echo $equipo ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="responsable">Responsable</label>
                                    <input type="text" name="responsable" class="form-control" id="responsable" placeholder="Responsable" value="<?php echo $responsable ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input type="text" name="departamento" class="form-control" id="departamento" placeholder="Departamento" value="<?php echo $departamento ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="sucursal">Sucursal</label>
                                    <input type="text" name="sucursal" class="form-control" id="sucursal" placeholder="sucursal" value="<?php echo $sucursal ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <input type="text" name="categoria" class="form-control" id="categoria" placeholder="categoria" value="<?php echo $categoria ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" name="marca" class="form-control" id="sucursal" placeholder="marca" value="<?php echo $marca ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" name="modelo" class="form-control" id="modelo" placeholder="Modelo" value="<?php echo $modelo ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="ip">Direccion IP</label>
                                    <input type="text" name="ip" class="form-control" id="ip" placeholder="Direccion IP" value="<?php echo $ip ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="ip">Estado</label>
                                    <input type="text" name="estado" class="form-control" id="estado" placeholder="Estado" value="<?php echo $estado ?>" required="">
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
                url: "action/updimpresoras.php" + fileExist,
                data:  new FormData(this),
                contentType:false,
                processData:false,
                 beforeSend: function(objeto){
                    $("#result").html("Mensaje: Cargando...");
                  },
                success: function(impresoras){
                $("#result").html(impresoras);
                $('#upd_data').attr("disabled", false);
                load(1);
              }
        });
      event.preventDefault();
});

</script>