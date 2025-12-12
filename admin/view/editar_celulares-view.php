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
    header("Location:?view=celulares");
}

$sql = mysqli_query($con, "select * from celulares where id=$id");
while ($rows = mysqli_fetch_array($sql)) {
    $id = $rows['id'];
    $TELEFONO = $rows['TELEFONO'];
    $MONTO_TOTAL_SIN_IGV = $rows['MONTO_TOTAL_SIN_IGV'];
    $MONTO_TOTAL_CON_IGV = $rows['MONTO_TOTAL_CON_IGV'];
    $FECHA_DE_RECIBO = $rows['FECHA_DE_RECIBO'];
    $MES = $rows['MES'];
    $PLAN = $rows['PLAN'];
    $RESPONSABLE = $rows['RESPONSABLE'];
    $UBICACION = $rows['UBICACION'];
    $AREA = $rows['AREA'];
    $EQUIPO = $rows['EQUIPO'];
    $SISTEMA_OPERATIVO = $rows['SISTEMA_OPERATIVO'];
    $IMEI = $rows['IMEI'];
    $MARCA = $rows['MARCA'];
    $FECHA_DE_COMPRA = $rows['FECHA_DE_COMPRA'];
    $FECHA_DE_ACTIVACION_CHIP = $rows['FECHA_DE_ACTIVACION_CHIP'];
    $ESTADO = $rows['ESTADO'];
    $AREA = $rows['AREA'];
    $CON_O_SIN_EQUIPO = $rows['CON_O_SIN_EQUIPO'];
    $FECHA_DE_RENOVACION = $rows['FECHA_DE_RENOVACION'];
    $COBRANZAS_DIFERIDAS = $rows['COBRANZAS_DIFERIDAS'];
    $PENALIDAD = $rows['PENALIDAD'];
    $RECONEXION_POR_MOROSIDAD_SIN_IGV = $rows['RECONEXION_POR_MOROSIDAD_SIN_IGV'];
    $RECONEXION_POR_MOROSIDAD_CON_IGV = $rows['RECONEXION_POR_MOROSIDAD_CON_IGV'];
    $CAMBIO_DE_NUMERO = $rows['CAMBIO_DE_NUMERO'];
    $CAMBIO_DE_NUMERO_CON_IGV = $rows['CAMBIO_DE_NUMERO_CON_IGV'];
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
                <li><a href="?view=celulares"><i class="fa fa-bars"></i> Datos</a></li>
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
                                    <label for="TELEFONO">Telefono</label>
                                    <input type="text" name="TELEFONO" class="form-control" id="TELEFONO" placeholder="Telefono" value="<?php echo $TELEFONO ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="MONTO_TOTAL_SIN_IGV">Monto total sin IGV</label>
                                    <input type="text" name="MONTO_TOTAL_SIN_IGV" class="form-control" id="MONTO_TOTAL_SIN_IGV" placeholder="Monto total sin IGV" value="<?php echo $MONTO_TOTAL_SIN_IGV ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="MONTO_TOTAL_CON_IGV">Monsto total con IGV</label>
                                    <input type="text" name="MONTO_TOTAL_CON_IGV" class="form-control" id="MONTO_TOTAL_CON_IGV" placeholder="Monto total con IGV" value="<?php echo $MONTO_TOTAL_CON_IGV ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label for="FECHA_DE_RECIBO">Fecha de recibo</label>
                                    <input type="date" name="FECHA_DE_RECIBO" class="form-control" id="FECHA_DE_RECIBO" placeholder="Fecha de recibo" value="<?php echo $FECHA_DE_RECIBO ?>" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="MES">Mes</label>
                                    <input type="text" name="MES" class="form-control" id="MES" placeholder="Mes" value="<?php echo $MES ?>" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="PLAN">Plan</label>
                                    <input type="text" name="PLAN" class="form-control" id="PLAN" placeholder="Plan" value="<?php echo $PLAN ?>">
                                </div>
                                <div class="form-group">
                                    <label for="RESPONSABLE">Responsable</label>
                                    <input type="text" name="RESPONSABLE" class="form-control" id="RESPONSABLE" placeholder="Responsable" value="<?php echo $RESPONSABLE ?>">
                                </div>
                                <div class="form-group">
                                    <label for="UBICACION">Ubicacion</label>
                                    <input type="text" name="UBICACION" class="form-control" id="UBICACION" placeholder="Ubicacion" value="<?php echo $UBICACION ?>">
                                </div>
                                <div class="form-group">
                                    <label for="AREA">Area</label>
                                    <input type="text" name="AREA" class="form-control" id="AREA" placeholder="Area" value="<?php echo $AREA ?>">
                                </div>
                                <div class="form-group">
                                    <label for="EQUIPO">Equipo</label>
                                    <input type="text" name="EQUIPO" class="form-control" id="EQUIPO" placeholder="Equipo" value="<?php echo $EQUIPO ?>">
                                </div>
                                <div class="form-group">
                                    <label for="SISTEMA_OPERATIVO">Sistema Operativo</label>
                                    <input type="text" name="SISTEMA_OPERATIVO" class="form-control" id="SISTEMA_OPERATIVO" placeholder="Sistema Operativo" value="<?php echo $SISTEMA_OPERATIVO ?>">
                                </div>
                                <div class="form-group">
                                    <label for="IMEI">IMEI</label>
                                    <input type="text" name="IMEI" class="form-control" id="IMEI" placeholder="IMEI" value="<?php echo $IMEI ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="MARCA">Marca</label>
                                    <input type="text" name="MARCA" class="form-control" id="MARCA" placeholder="Marca" value="<?php echo $MARCA ?>">
                                </div>
                                <div class="form-group">
                                    <label for="FECHA_DE_COMPRA">Fecha de compra</label>
                                    <input type="date" name="FECHA_DE_COMPRA" class="form-control" id="FECHA_DE_COMPRA" placeholder="Fecha de compra" value="<?php echo $FECHA_DE_COMPRA ?>">
                                </div>
                                 <div class="form-group">
                                    <label for="FECHA_DE_ACTIVACION_CHIP">Fecha de activacion de chip</label>
                                    <input type="date" name="FECHA_DE_ACTIVACION_CHIP" class="form-control" id="FECHA_DE_ACTIVACION_CHIP" placeholder="Fecha de activacion de chip" value="<?php echo $FECHA_DE_ACTIVACION_CHIP ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="ESTADO">Estado</label>
                                    <input type="text" name="ESTADO" class="form-control" id="ESTADO" placeholder="Estado" value="<?php echo $ESTADO ?>">
                                </div>
                                <div class="form-group">
                                    <label for="CON_O_SIN_EQUIPO">Con o sin equipo</label>
                                    <input type="text" name="CON_O_SIN_EQUIPO" class="form-control" id="CON_O_SIN_EQUIPO" placeholder="Con o sin equipo" value="<?php echo $CON_O_SIN_EQUIPO ?>">
                                </div>
                                <div class="form-group">
                                    <label for="FECHA_DE_RENOVACION">Fecha de renovacion</label>
                                    <input type="date" name="FECHA_DE_RENOVACION" class="form-control" id="FECHA_DE_RENOVACION" placeholder="Fecha de renovacion" value="<?php echo $FECHA_DE_RENOVACION ?>">
                                </div>
                                <div class="form-group">
                                    <label for="COBRANZAS_DIFERIDAS">Cobranzas diferidas</label>
                                    <input type="text" name="COBRANZAS_DIFERIDAS" class="form-control" id="COBRANZAS_DIFERIDAS" placeholder="Cobranzas diferidas" value="<?php echo $COBRANZAS_DIFERIDAS ?>">
                                </div>
                                <div class="form-group">
                                    <label for="PENALIDAD">Penalidad</label>
                                    <input type="text" name="PENALIDAD" class="form-control" id="PENALIDAD" placeholder="Penalidad" value="<?php echo $PENALIDAD ?>">
                                </div>
                                <div class="form-group">
                                    <label for="RECONEXION_POR_MOROSIDAD_SIN_IGV">Reconexión por morosidad sin IGV</label>
                                    <input type="text" name="RECONEXION_POR_MOROSIDAD_SIN_IGV" class="form-control" id="RECONEXION_POR_MOROSIDAD_SIN_IGV" placeholder="Reconexión por morosidad sin IGV" value="<?php echo $RECONEXION_POR_MOROSIDAD_SIN_IGV ?>">
                                </div>
                                <div class="form-group">
                                    <label for="RECONEXION_POR_MOROSIDAD_CON_IGV">Reconexión por morosidad con IGV</label>
                                    <input type="text" name="RECONEXION_POR_MOROSIDAD_CON_IGV" class="form-control" id="RECONEXION_POR_MOROSIDAD_CON_IGV" placeholder="Reconexión por morosidad con IGV" value="<?php echo $RECONEXION_POR_MOROSIDAD_CON_IGV ?>">
                                </div>
                                <div class="form-group">
                                    <label for="CAMBIO_DE_NUMERO">Cambio de numero</label>
                                    <input type="text" name="CAMBIO_DE_NUMERO" class="form-control" id="CAMBIO_DE_NUMERO" placeholder="Cambio de numero" value="<?php echo $CAMBIO_DE_NUMERO ?>">
                                </div>
                                <div class="form-group">
                                    <label for="CAMBIO_DE_NUMERO_CON_IGV">Cambio de numero con IGV</label>
                                    <input type="text" name="CAMBIO_DE_NUMERO_CON_IGV" class="form-control" id="CAMBIO_DE_NUMERO_CON_IGV" placeholder="Cambio de numero con IGV" value="<?php echo $CAMBIO_DE_NUMERO_CON_IGV ?>">
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
                url: "action/updcelulares.php" + fileExist,
                data:  new FormData(this),
                contentType:false,
                processData:false,
                 beforeSend: function(objeto){
                    $("#result").html("Mensaje: Cargando...");
                  },
                success: function(celulares){
                $("#result").html(celulares);
                $('#upd_data').attr("disabled", false);
                load(1);
              }
        });
      event.preventDefault();
});

</script>