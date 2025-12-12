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
    header("Location:?view=ordendecompra");
}

$sql = mysqli_query($con, "select * from ordendecompra where id=$id");
while ($rows = mysqli_fetch_array($sql)) {
    $id = $rows['id'];
    $area = $rows['area'];
    $usuario = $rows['usuario'];
    $numero = $rows['numero'];
    $proveedor = $rows['proveedor'];
    $fecha = $rows['fecha'];
    $bienservicio = $rows['bienservicio'];
    $categoria = $rows['categoria'];
    $marca = $rows['marca'];
    $descripcion = $rows['descripcion'];
    $cantidad = $rows['cantidad'];
    $ptsoles = $rows['ptsoles'];
    $ptdolares = $rows['ptdolares'];
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
            <h1>Datos de orden de compra</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=ordendecompra"><i class="fa fa-bars"></i> Datos</a></li>
                <li class="active">Editar orden de compra</li>
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
                            <h3 class="box-title">Editar Orden de compra</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="upd" id="upd" enctype="multipart/form-data">
                            <div class="box-body">
                            <div class="form-group">
                                    <label for="area">Area</label>
                                    <input type="text" name="area" class="form-control" id="area" placeholder="Area" value="<?php echo $area ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" value="<?php echo $usuario ?>" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="numero">Numero de O.C.</label>
                                    <input type="text" name="numero" class="form-control" id="numero" placeholder="Numero de comprobante" value="<?php echo $numero ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="proveedor">Proveedor</label>
                                    <input type="text" name="proveedor" class="form-control" id="proveedor" placeholder="Proveedor" value="<?php echo $proveedor ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha de emision</label>
                                    <input type="date" name="fecha" class="form-control" id="fecha" placeholder="Fecha de emision" value="<?php echo $fecha ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="bienservicio">Bien o servicio</label>
                                    <input type="text" name="bienservicio" class="form-control" id="bienservicio" placeholder="Bien o servicio" value="<?php echo $bienservicio ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <input type="text" name="categoria" class="form-control" id="categoria" placeholder="Categoria" value="<?php echo $categoria ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" name="marca" class="form-control" id="marca" placeholder="Marca" value="<?php echo $marca ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="text" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad" value="<?php echo $cantidad ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="ptsoles">Precio total en soles</label>
                                    <input type="text" name="ptsoles" class="form-control" id="ptsoles" placeholder="Precio total en soles" value="<?php echo $ptsoles ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="ptdolares">Precio total en dolares</label>
                                    <input type="text" name="ptdolares" class="form-control" id="ptdolares" placeholder="Precio total en dolares" value="<?php echo $ptdolares ?>" >
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
                url: "action/updordendecompra.php" + fileExist,
                data:  new FormData(this),
                contentType:false,
                processData:false,
                 beforeSend: function(objeto){
                    $("#result").html("Mensaje: Cargando...");
                  },
                success: function(ordendecompra){
                $("#result").html(ordendecompra);
                $('#upd_data').attr("disabled", false);
                load(1);
              }
        });
      event.preventDefault();
});

</script>