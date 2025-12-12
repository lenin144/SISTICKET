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
    header("Location:?view=datos");
}

$sql = mysqli_query($con, "select * from datos where id=$id");
while ($rows = mysqli_fetch_array($sql)) {
    $id = $rows['id'];
    $nombre = $rows['nombre'];
    $apellido = $rows['apellido'];
    $departamento = $rows['departamento'];
    $sucursal = $rows['sucursal'];
    $categoria = $rows['categoria'];
    $edad = $rows['edad'];
    $marca = $rows['marca'];
    $modelo = $rows['modelo'];
    $equipo = $rows['equipo'];
    $serial = $rows['serial'];
    $so = $rows['so'];
    $procesador = $rows['procesador'];
    $memoria = $rows['memoria'];
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
            <h1>Datos</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=datos"><i class="fa fa-bars"></i> Datos</a></li>
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
                                    <label for="nombre">Equipo</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" value="<?php echo $nombre ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="apellido">Responsable</label>
                                    <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" value="<?php echo $apellido ?>" required="">
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
                                    <label for="edad">Descripcion</label>
                                    <input type="text" name="edad" class="form-control" id="edad" placeholder="Descripcion" value="<?php echo $edad ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" name="marca" class="form-control" id="marca" placeholder="Marca" value="<?php echo $marca ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" name="modelo" class="form-control" id="modelo" placeholder="Modelo" value="<?php echo $modelo ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="equipo">Nombre del equipo</label>
                                    <input type="text" name="equipo" class="form-control" id="equipo" placeholder="Nombre del equipo" value="<?php echo $equipo ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="serial">Serial</label>
                                    <input type="text" name="serial" class="form-control" id="serial" placeholder="Serial N°" value="<?php echo $serial ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="so">Sistema operativo</label>
                                    <input type="text" name="so" class="form-control" id="so" placeholder="Sistema operativo" value="<?php echo $so ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="procesador">Procesador</label>
                                    <input type="text" name="procesador" class="form-control" id="procesador" placeholder="Procesador" value="<?php echo $procesador ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="memoria">Memoria</label>
                                    <input type="text" name="memoria" class="form-control" id="memoria" placeholder="Memoria" value="<?php echo $memoria ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado</label>
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
                url: "action/upddato.php" + fileExist,
                data:  new FormData(this),
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
});

</script>