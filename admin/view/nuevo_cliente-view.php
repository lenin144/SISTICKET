<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active10="active";
    include "header.php";
    include "sidebar.php";
    
    if($is_admin!=1){
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
            <h1>Registro de Clientes</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=clientes"><i class="fa fa-child"></i> Clientes</a></li>
                <li class="active">Nuevo Cliente</li>
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
                            <h3 class="box-title">Nuevo Cliente</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="add" id="add">
                            <div class="box-body">
                                <div class="form-group">
                                  <label for="nombre">Nombre: </label>
                                  <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                  <label for="apellidos">Apellidos: </label>
                                  <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" required>
                                </div>
                                <div class="form-group">
                                  <label for="empresa">Empresa: </label>
                                  <input type="text" name="empresa" class="form-control" id="empresa" placeholder="Empresa" required>
                                </div>
                                <div class="form-group">
                                  <label for="email">E-mail: </label>
                                  <input type="email" name="email" class="form-control" id="email" placeholder="Correo Electrónico" required>
                                </div>
                                <div class="form-group">
                                  <label for="ruc">Codigo </label>
                                  <input type="text" name="ruc" class="form-control" id="ruc" placeholder="codigo" required maxlength="11" onblur="aMayusculas(this.value,this.id)">
                                </div>
                                <div class="form-group">
                                  <label for="phone">Telefóno: </label>
                                  <input type="number" name="phone" class="form-control" id="phone" placeholder="Telefóno" required >
                                </div>
                                <div class="form-group">
                                  <label for="password">Contraseña: </label>
                                  <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required >
                                </div>
                                <div class="form-group">
                                  <label for="confirm_pass">Confirmar Contraseña: </label>
                                  <input type="password" name="confirm_pass" class="form-control" id="confirm_pass" placeholder="Confirmar Contraseña" required >
                                </div>
                                <div class="form-group">
                                <div class="form-group">
                                    <label for="asunt">Archivos adjuntos (Máximo 2)</label>
                                    <input type="file" class='form-control' name="imagefile[]" id="imagefile1">
                                    <input type="file" class='form-control' name="imagefile[]" id="imagefile2">
                                    <span class="text-info">Selecciona tus archivos, peso máximo 10MB</span>
                                </div>
                                        

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
    <input type="hidden" class="search_latitude" size="30" id="lat" name="lat">
    <input type="hidden" class="search_longitude" size="30" id="long" name="long">



                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" id="save_data" class="btn btn-success">Agregar</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

  <?php include "footer.php" ?>


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
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>2){
            event.preventDefault();
         alert("Solo puedes subir un máximo de 2 archivos");
        }else{
            $( "#add" ).submit(function( event ) {
                $('#save_data').attr("disabled", true);
                    var parametros = $(this).serialize();
                    if($("#imagefile1").val()!="" || $("#imagefile2").val()!=""){
                    var fileExist= "?file=true";
                    // console.log('hay archivo');
                    }else{
                        var fileExist= "?file=false";
                        // console.log('no hay archivos');
                    }
                    $.ajax({
                        type: "POST",
                        url: "action/addclient.php" + fileExist,
                        data: new FormData(this),
                        contentType:false,
                        processData:false,
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
            });
    }
    }else{
        alert("Las contraseñas no coinciden!");
        event.preventDefault();
        //$("#result").html("Mensaje: Las contraseñas no coinciden...");
    }
});
</script>


