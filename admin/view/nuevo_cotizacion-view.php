<?php
/*-------------------------
Autor: Autor Dev
Web: www.google.com
E-Mail: waptoing7@gmail.com
---------------------------*/
$active13 = "active";
include "header.php";
include "sidebar.php";

if ($is_admin != 1) {
    print "<script>window.location='?view=dashboard&error';</script>";
}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Nueva cotizacion</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=cotizacion"><i class="fa fa-bars"></i> Nueva cotizacion</a></li>
                <li class="active">Nueva cotizacion</li>
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
                            <h3 class="box-title">Nueva cotizacion</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="add" id="add" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="area">Area </label>
                                    <input type="text" name="area" class="form-control" id="area" placeholder="Area" required="">
                                </div>
                                <div class="form-group">
                                    <label for="usuario">Usuario </label>
                                    <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" required="">
                                </div>
                                <div class="form-group">
                                    <label for="numero">Numero de comprobante</label>
                                    <input type="text" name="numero" class="form-control" id="numero" placeholder="Numero de comprobante" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="proveedor">Proveedor</label>
                                    <input type="text" name="proveedor" class="form-control" id="proveedor" placeholder="Proveedor" required="">
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha de envio</label>
                                    <input type="date" name="fecha" class="form-control" id="fecha" placeholder="Fecha solicitada" required="">
                                </div>
                                <div class="form-group">
                                    <label for="bienservicio">Bien o servcio</label>
                                    <input type="text" name="bienservicio" class="form-control" id="bienservicio" placeholder="Bien o servcio">
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <input type="text" name="categoria" class="form-control" id="categoria" placeholder="Categoria">
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" name="marca" class="form-control" id="marca" placeholder="Marca">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion">
                                </div>
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="text" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad">
                                </div>
                                 <div class="form-group">
                                    <label for="ptsoles">Precio total en soles</label>
                                    <input type="text" name="ptsoles" class="form-control" id="ptsoles" placeholder="Precio Total en soles">
                                </div>
                                <div class="form-group">
                                    <label for="ptdolares">Precio total en dolares</label>
                                    <input type="text" name="ptdolares" class="form-control" id="ptdolares" placeholder="Precio total en dolares">
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <input type="text" name="estado" class="form-control" id="estado" placeholder="Estado">
                                </div>
                               
                                
                                <div class="form-group">
                                    <label for="asunt">Archivo adjunto</label>
                                    <input type="file" class='form-control' name="imagefile[]" multiple id="imagefile">
                                    <span class="text-info">Selecciona tus archivos, peso máximo 2MB</span>
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

  <?php include "footer.php"?>

<script>
    $( "#add" ).submit(function( event ) {
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>3){
         alert("Solo puedes subir un máximo de 3 archivos");
        }else{
            $('#save_data').attr("disabled", true);
             var parametros = $(this).serialize();
             if($("#imagefile").val()!=""){
                var fileExist= "?file=true";
                // console.log('hay archivo');
            }else{
                var fileExist= "?file=false";
                // console.log('no hay archivos');
            }
                 $.ajax({
                        type: "POST",
                        url: "action/addcotizacion.php" + fileExist,
                        data: new FormData(this),
                        contentType:false,
                        processData:false,
                        beforeSend: function(objeto){
                            $("#result").html("Mensaje: Cargando...");
                        },
                        success: function(cotizacion){
                        $("#result").html(cotizacion);
                        $('#save_data').attr("disabled", false);
                        load(1);
                      }
                });
        }

            

        event.preventDefault();
    })

</script>


<script>
    $(function(){
    $('#impact_id').on('change', function(){
        var id = $('#impact_id').val();
        var url = 'ajax/agrega_urgencia.php';
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(data){
                $('#urgency_id option').remove();
                $('#urgency_id').append(data);
            }
        });
        return false;
    });

    $('#urgency_id').on('change', function(){
        var id = $('#urgency_id').val();
        var impact = $('#impact_id').val();
        var parametros = {"id":id,'impact':impact};
        var url = 'ajax/agrega_prioridades.php';
        $.ajax({
            type:'POST',
            url:url,
            // data:'id='+id+'impact='+impact,
            data:parametros,
            success: function(data){
                $('#priority_id option').remove();
                $('#priority_id').append(data);
            }
        });
        return false;
    });
});


</script>