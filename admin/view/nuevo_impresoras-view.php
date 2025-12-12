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
            <h1>Impresoras</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=impresoras"><i class="fa fa-bars"></i> Impresoras</a></li>
                <li class="active">Nueva impresora</li>
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
                            <h3 class="box-title">Nuevo dato</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="add" id="add" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="equipo">Equipo</label>
                                    <input type="text" name="equipo" class="form-control" id="equipo" placeholder="Equipo" required="">
                                </div>
                                <div class="form-group">
                                    <label for="resposanble">Responsable</label>
                                    <input type="text" name="responsable" class="form-control" id="responsable" placeholder="Responsable" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input type="text" name="departamento" class="form-control" id="departamento" placeholder="Departamento" required="">
                                </div>
                                <div class="form-group">
                                    <label for="sucursal">Sucursal</label>
                                    <input type="text" name="sucursal" class="form-control" id="sucursal" placeholder="Sucursal" required="">
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <input type="text" name="categoria" class="form-control" id="categoria" placeholder="Categoria" required="">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion" required="">
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" name="marca" class="form-control" id="marca" placeholder="Marca" required="">
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" name="modelo" class="form-control" id="modelo" placeholder="Modelo" required="">
                                </div>
                                <div class="form-group">
                                    <label for="ip">Direccion IP</label>
                                    <input type="text" name="ip" class="form-control" id="ip" placeholder="Direccion IP" >
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <input type="text" name="estado" class="form-control" id="estado" placeholder="Estado" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="asunt">Archivos adjuntos (Máximo 3)</label>
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
                        url: "action/addimpresoras.php" + fileExist,
                        data: new FormData(this),
                        contentType:false,
                        processData:false,
                        beforeSend: function(objeto){
                            $("#result").html("Mensaje: Cargando...");
                        },
                        success: function(impresoras){
                        $("#result").html(impresoras);
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