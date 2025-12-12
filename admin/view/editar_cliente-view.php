<?php
/*-------------------------
Autor: Autor Dev
Web: www.google.com
E-Mail: waptoing7@gmail.com
---------------------------*/
$active10 = "active";
include "header.php";
include "sidebar.php";

$id = intval($_GET['id']);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET["id"];
} else {
    header("Location: ?view=clientes");
}

$sql = mysqli_query($con, "select * from user where id=$id");
$rows = mysqli_fetch_array($sql);
$id = $rows['id'];
$business = $rows['business'];
// $fullname=$rows['fullname'];
$nombre = $rows['name'];
$apellidos = $rows['lastname'];
$email = $rows['email'];
$ruc = $rows['ruc'];
$phone = $rows['phone'];
$is_active = $rows['is_active'];
$adjunto1 = $rows['file1'];
$adjunto2 = $rows['file2'];

$latitude = $rows['latitude'];
$longitude = $rows['longitude'];

if ($is_admin != 1) {
    print "<script>window.location='?view=dashboard&error';</script>";
}
?>
<head>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
</head>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Editar Cliente</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=clientes"><i class="fa fa-th-child"></i> Clientes</a></li>
                <li class="active">Editar Cliente</li>
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
                            <h3 class="box-title">Editar Cliente</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="upd" id="upd">
                            <div class="box-body">
                                <div class="form-group">
                                  <label for="nombre">Nombre:</label>
                                  <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required value="<?php echo $nombre ?>">
                                </div>
                                <div class="form-group">
                                  <label for="apellidos">Apellidos:</label>
                                  <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" required value="<?php echo $apellidos ?>">
                                </div>
                                <div class="form-group">
                                  <label for="empresa">Empresa:</label>
                                  <input type="text" name="empresa" class="form-control" id="empresa" placeholder="Empresa" required value="<?php echo $business ?>">
                                </div>
                                <div class="form-group">
                                  <label for="email">E-mail:</label>
                                  <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="<?php echo $email ?>" required>
                                </div>
                                <div class="form-group">
                                  <label for="ruc">RFC:</label>
                                  <input type="text" name="ruc" class="form-control" id="ruc" placeholder="RFC" value="<?php echo $ruc ?>" required onblur="aMayusculas(this.value,this.id)">
                                </div>
                                <div class="form-group">
                                  <label for="phone">Telefóno</label>
                                  <input type="number" name="phone" class="form-control" id="phone" placeholder="Telefóno" value="<?php echo $phone ?>" required>
                                </div>

                                <div class="form-group">
                                  <label for="password">Nueva Contraseña</label>
                                  <input type="password" name="password" class="form-control" id="password" placeholder="Nueva Contraseña">
                                </div>
                                <div class="form-group">
                                  <label for="confirm_pass">Confirmar Nueva Contraseña</label>
                                  <input type="password" name="confirm_pass" class="form-control" id="confirm_pass" placeholder="Confirmar Nueva Contraseña">
                                    <p class="text-info">La contraseña solo se modifica si escribes algo, en caso contrario no.</p>
                                </div>
                                <div class="form-group">
                                    <label for="asunt">Archivo adjunto 1</label>
                                    <input type="file" class='form-control' name="imagefile" id="imagefile">
                                </div>
                                <div class="form-group">
                                    <label for="asunt">Archivo adjunto 2</label>
                                    <input type="file" class='form-control' name="imagefile2" id="imagefile2">
                                </div>
                                <?php
if ($adjunto1 != null) {
    echo "<br><span><a href=../" . $adjunto1 . " target='_blank'>Descargar archivo 1</a></span>";
}
if ($adjunto2 != null) {
    echo "<br><span><a href=../" . $adjunto2 . " target='_blank'>Descargar archivo 2</a></span>";
}
?>

     <!-- search input box -->
    <!-- <form> -->
        <div class="form-group input-group">
            <input type="text" id="search_location" class="form-control" placeholder="Buscar Ubicación">
            <div class="input-group-btn">
                <button class="btn btn-default get_map" type="submit">
                    Buscar
                </button>
            </div>
        </div>
    <!-- </form> -->

    <!-- display google map -->
    <div id="geomap" style="width: 100%; height: 400px;"></div>
    <input type="hidden" class="search_latitude" size="30" id="lat" name="lat" value="<?php echo $latitude ?>">
    <input type="hidden" class="search_longitude" size="30" id="long" name="long" value="<?php echo $longitude ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Estado</label>
                                    <select name="status" class="chosen-select form-control" id="status" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value="1" <?php if ($is_active == 1) {echo "selected";}?>>Activo</option>
                                        <option value="0" <?php if ($is_active == 0) {echo "selected";}?>>Inactivo</option>
                                </select>
                                </div>
                                <input type="hidden" name="mod_id" value="<?php echo $id ?>">
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


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX6wD6FcmE4ZEFB2gEVka9qNkdsA4eqeg"></script>
<script src="../assets/js/localizacion.js" type="text/javascript"></script>



<script>
    function aMayusculas(obj,id){
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
    }
</script>
<script>
$( "#save_data" ).click(function( event ) {
    if($("#password").val()==$("#confirm_pass").val()){
        //alert("Las contraseñas son iguales");
        if($("#imagefile").val()!="" || $("#imagefile2").val()!="" || $("#imagefile3").val()!=""){
                var fileExist= "?file=true";
                // console.log('hay archivo');
            }else{
                var fileExist= "?file=false";
                // console.log('no hay archivos');
            }


        $( "#upd" ).submit(function( event ) {
            $('#upd_data').attr("disabled", true);
            var parametros = $(this).serialize();
                 $.ajax({
                        type: "POST",
                        url: "action/updclient.php" + fileExist,
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
    }else{
        alert("Las contraseñas no coinciden!");
        event.preventDefault();
        //$("#result").html("Mensaje: Las contraseñas no coinciden...");
    }

});
</script>
