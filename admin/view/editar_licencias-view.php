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
    header("Location:?view=licencias");
}

$sql = mysqli_query($con, "select * from licencias where id=$id");
while ($rows = mysqli_fetch_array($sql)) {
    $id = $rows['id'];
    $equipo = $rows['equipo'];
    $responsable = $rows['responsable'];
    $departamento = $rows['departamento'];
    $sucursal = $rows['sucursal'];
    $programa = $rows['programa'];
    $licencia = $rows['licencia'];
    $correo = $rows['correo'];
    $clave = $rows['clave'];
    $fechareg = $rows['fechareg'];
    $fechaven = $rows['fechaven'];
    $estado = $rows['estado'];
    $observacion = $rows['observacion'];
    $nompro = $rows['nompro'];
    $numpro = $rows['numpro'];
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
            <h1>Datos Licencias</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=licencias"><i class="fa fa-bars"></i> Datos</a></li>
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
                                    <label for="programa">Programa</label>
                                    <input type="text" name="programa" class="form-control" id="programa" placeholder="programa" value="<?php echo $programa ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="licencia">Licencia</label>
                                    <input type="text" name="licencia" class="form-control" id="licencia" placeholder="Licencia" value="<?php echo $licencia ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="correo">correo</label>
                                    <input type="text" name="correo" class="form-control" id="correo" placeholder="Correo" value="<?php echo $correo ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="clave">Clave</label>
                                    <input type="text" name="clave" class="form-control" id="clave" placeholder="Clave" value="<?php echo $clave ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="fechareg">Fecha de registro</label>
                                    <input type="date" name="fechareg" class="form-control" id="fechareg" placeholder="Fecha de registro" value="<?php echo $fechareg ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="fechaven">Fecha de vencimiento</label>
                                    <input type="date" name="fechaven" class="form-control" id="fechaven" placeholder="Fecha de registro" value="<?php echo $fechaven ?>">
                                </div>
                                <div class="form-group">
                                    <label for="ip">Estado</label>
                                    <input type="text" name="estado" class="form-control" id="estado" placeholder="Estado" value="<?php echo $estado ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="observacion">Observacion</label>
                                    <input type="text" name="observacion" class="form-control" id="observacion" placeholder="Observacion" value="<?php echo $observacion ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="nompro">Nombre del proveedor</label>
                                    <input type="text" name="nompro" class="form-control" id="nompro" placeholder="Nombre del proveedor" value="<?php echo $nompro ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="numpro">Numero del proveedor</label>
                                    <input type="text" name="numpro" class="form-control" id="numpro" placeholder="Numero del proveedor" value="<?php echo $numpro ?>" required="">
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
                url: "action/updlicencias.php" + fileExist,
                data:  new FormData(this),
                contentType:false,
                processData:false,
                 beforeSend: function(objeto){
                    $("#result").html("Mensaje: Cargando...");
                  },
                success: function(licencias){
                $("#result").html(licencias);
                $('#upd_data').attr("disabled", false);
                load(1);
              }
        });
      event.preventDefault();
});

</script>