<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active2="active";
   // $active3="active";
    include "header.php";
    include "sidebar.php";

    $id=intval($_GET['id']);

       if (isset($_GET['id']) && !empty($_GET['id'])){
        $id=$_GET["id"];

        $sql=mysqli_query($con,"select * from tickets where id=$id");
        $rows=mysqli_fetch_array($sql);
        $tipo_requerimiento_id=$rows['tipo_requerimiento'];
        $area_id=$rows['area_id'];
        $asigned_id=$rows['asigned_id'];
    } else {
        header("Location: ?view=asignados");  
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Actualizar Asignación </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <!-- <li><a href="registrados.php"><i class="fa fa-th-list"></i> Tickets Registrados</a></li> -->
                <li class="active"><i class="fa fa-ticket"></i> Tickets </li> 
                <li class="active">Actualizar Asignación</li>
            </ol>
        </section>
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-xs-12 col-md-6">
                <div id="result"></div>
                    <div class="box box-success"> <!-- general form elements -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Actualizar Asignación</h3>
                        </div><!-- /.box-header -->
                        <form role="form" method="post" name="add" id="add"> <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="id_area">Area</label>
                                    <select name="id_area" class="chosen-select form-control" id="id_area" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                    <?php
                                        $sql=mysqli_query($con, "select * from area");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['id'] ?>" <?php if($row['id']==$area_id){echo"selected";} ?>><?php echo $row['name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_requerimiento">Categoría</label>
                                    <select name="tipo_requerimiento" class="chosen-select form-control" id="tipo_requerimiento" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                    <?php
                                        $sql=mysqli_query($con, "select * from tipos_requerimientos");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['id'] ?>" <?php if($row['id']==$tipo_requerimiento_id){echo"selected";} ?>><?php echo $row['name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="asigned_id">Agente: </label>
                                    <select name="asigned_id" class="select2 form-control" id="asigned_id" required >
                                        <?php 
                                            // $sql_user=mysqli_query($con,"select * from user where id=$asigned_id");
                                            $sql_user=mysqli_query($con,"select * from usuarios_areas INNER join user on usuarios_areas.user_id=user.id where usuarios_areas.area_id='$area_id'");
                                                while($rows_us=mysqli_fetch_array($sql_user)){
                                        ?>
                                            <option value="<?php echo $rows_us['id'] ?>" <?php if($rows_us['id']==$asigned_id){echo"selected";} ?>><?php echo $rows_us['name']." ".$rows_us['lastname'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="ticked_id" value="<?php echo $id ?>">
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" id="save_data" class="btn btn-success">Actualizar</button>
                                <a style="margin-left: 20px;" class="btn btn-default" href="javascript:history.back()"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

  <?php include "footer.php" ?>
<script type = "text/javascript">
    $(document).ready(function(){
        $('#id_area').on('change', function(){
                if($('#id_area').val() == ""){
                    $('#asigned_id').empty();
                    $('<option value = "">Selecciona un agente</option>').appendTo('#asigned_id');
                    $('#asigned_id').attr('disabled', 'disabled');
                }else{
                    $('#asigned_id').removeAttr('disabled', 'disabled');
                    $('#asigned_id').load('./ajax/empleados_get.php?id_area=' + $('#id_area').val());
                }
        });
    });
</script>

<script>
$( "#add" ).submit(function( event ) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addreasigned.php",
            data: parametros,
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
})

</script>