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
            <h1>Nuevo Orden de Compra</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=celulares"><i class="fa fa-bars"></i> Nuevo Orden de compra</a></li>
                <li class="active">Nuevo Orden de compra</li>
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
                                    <label for="TELEFONO">Telefono</label>
                                    <input type="text" name="TELEFONO" class="form-control" id="TELEFONO" placeholder="Telefono" required="">
                                </div>
                                <div class="form-group">
                                    <label for="MONTO_TOTAL_SIN_IGV">Monto total sin IGV</label>
                                    <input type="text" name="MONTO_TOTAL_SIN_IGV" class="form-control" id="MONTO_TOTAL_SIN_IGV" placeholder="Monto total sin IGV" required="">
                                </div>
                                <div class="form-group">
                                    <label for="MONTO_TOTAL_CON_IGV">Monsto total con IGV</label>
                                    <input type="text" name="MONTO_TOTAL_CON_IGV" class="form-control" id="MONTO_TOTAL_CON_IGV" placeholder="Monto total con IGV" required="">
                                </div>
                                <div class="form-group">
                                    <label for="FECHA_DE_RECIBO">Fecha de recibo</label>
                                    <input type="date" name="FECHA_DE_RECIBO" class="form-control" id="FECHA_DE_RECIBO" placeholder="Fecha de recibo" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="MES">Mes</label>
                                    <input type="text" name="MES" class="form-control" id="MES" placeholder="Mes" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="PLAN">Plan</label>
                                    <input type="text" name="PLAN" class="form-control" id="PLAN" placeholder="Plan">
                                </div>
                                <div class="form-group">
                                    <label for="RESPONSABLE">Responsable</label>
                                    <input type="text" name="RESPONSABLE" class="form-control" id="RESPONSABLE" placeholder="Responsable">
                                </div>
                                <div class="form-group">
                                    <label for="UBICACION">Ubicacion</label>
                                    <input type="text" name="UBICACION" class="form-control" id="UBICACION" placeholder="Ubicacion">
                                </div>
                                <div class="form-group">
                                    <label for="AREA">Area</label>
                                    <input type="text" name="AREA" class="form-control" id="AREA" placeholder="Area">
                                </div>
                                <div class="form-group">
                                    <label for="EQUIPO">Equipo</label>
                                    <input type="text" name="EQUIPO" class="form-control" id="EQUIPO" placeholder="Equipo">
                                </div>
                                <div class="form-group">
                                    <label for="SISTEMA_OPERATIVO">Sistema Operativo</label>
                                    <input type="text" name="SISTEMA_OPERATIVO" class="form-control" id="SISTEMA_OPERATIVO" placeholder="Sistema Operativo">
                                </div>
                                
                                <div class="form-group">
                                    <label for="IMEI">IMEI</label>
                                    <input type="text" name="IMEI" class="form-control" id="IMEI" placeholder="IMEI">
                                </div>
                                <div class="form-group">
                                    <label for="MARCA">Marca</label>
                                    <input type="text" name="MARCA" class="form-control" id="MARCA" placeholder="Marca">
                                </div>
                                <div class="form-group">
                                    <label for="FECHA_DE_COMPRA">Fecha de compra</label>
                                    <input type="date" name="FECHA_DE_COMPRA" class="form-control" id="FECHA_DE_COMPRA" placeholder="Fecha de compra">
                                </div>
                                <div class="form-group">
                                    <label for="FECHA_DE_ACTIVACION_CHIP">Fecha de activacion de chip</label>
                                    <input type="date" name="FECHA_DE_ACTIVACION_CHIP" class="form-control" id="FECHA_DE_ACTIVACION_CHIP" placeholder="Fecha de activacion de chip">
                                </div>
                                
                                <div class="form-group">
                                    <label for="ESTADO">Estado</label>
                                    <input type="text" name="ESTADO" class="form-control" id="ESTADO" placeholder="Estado">
                                </div>
                                <div class="form-group">
                                    <label for="CON_O_SIN_EQUIPO">Con o sin equipo</label>
                                    <input type="text" name="CON_O_SIN_EQUIPO" class="form-control" id="CON_O_SIN_EQUIPO" placeholder="Con o sin equipo">
                                </div>
                                <div class="form-group">
                                    <label for="FECHA_DE_RENOVACION">Fecha de renovacion</label>
                                    <input type="date" name="FECHA_DE_RENOVACION" class="form-control" id="FECHA_DE_RENOVACION" placeholder="Fecha de renovacion">
                                </div>
                                <div class="form-group">
                                    <label for="COBRANZAS_DIFERIDAS">Cobranzas diferidas</label>
                                    <input type="text" name="COBRANZAS_DIFERIDAS" class="form-control" id="COBRANZAS_DIFERIDAS" placeholder="Cobranzas diferidas">
                                </div>
                                <div class="form-group">
                                    <label for="PENALIDAD">Penalidad</label>
                                    <input type="text" name="PENALIDAD" class="form-control" id="PENALIDAD" placeholder="Penalidad">
                                </div>
                                <div class="form-group">
                                    <label for="RECONEXION_POR_MOROSIDAD_SIN_IGV">Reconexion por morosidad sin IGV</label>
                                    <input type="text" name="RECONEXION_POR_MOROSIDAD_SIN_IGV" class="form-control" id="RECONEXION_POR_MOROSIDAD_SIN_IGV" placeholder="Reconexion por morosidad sin IGV">
                                </div>
                                <div class="form-group">
                                    <label for="RECONEXION_POR_MOROSIDAD_CON_IGV">Reconexion por morosidad con IGV</label>
                                    <input type="text" name="RECONEXION_POR_MOROSIDAD_CON_IGV" class="form-control" id="RECONEXION_POR_MOROSIDAD_CON_IGV" placeholder="Reconexion por morosidad con IGV">
                                </div>
                                <div class="form-group">
                                    <label for="CAMBIO_DE_NUMERO">Cambio de numero</label>
                                    <input type="text" name="CAMBIO_DE_NUMERO" class="form-control" id="CAMBIO_DE_NUMERO" placeholder="Cambio de numero">
                                </div>
                                <div class="form-group">
                                    <label for="CAMBIO_DE_NUMERO_CON_IGV">Cambio de numero con IGV</label>
                                    <input type="text" name="CAMBIO_DE_NUMERO_CON_IGV" class="form-control" id="CAMBIO_DE_NUMERO_CON_IGV" placeholder="Cambio de numero con IGV">
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
                        url: "action/addcelulares.php" + fileExist,
                        data: new FormData(this),
                        contentType:false,
                        processData:false,
                        beforeSend: function(objeto){
                            $("#result").html("Mensaje: Cargando...");
                        },
                        success: function(celulares){
                        $("#result").html(celulares);
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