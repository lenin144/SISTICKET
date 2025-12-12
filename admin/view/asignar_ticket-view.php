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
        $area=$rows['area'];
    } else {
        header("Location: ?view=registrados");  
    }
    
    if($is_admin!=1 and $soy_supervisor==0){
        //header("location: dashboard.php");
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Asignar Ticket</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <!-- <li><a href="registrados.php"><i class="fa fa-th-list"></i> Tickets Registrados</a></li> -->
                <li class="active"><i class="fa fa-ticket"></i> Tickets </li> 
                <li class="active">Nueva Asignación</li>
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
                            <h3 class="box-title">Nueva Asignación</h3>
                        </div><!-- /.box-header -->
                        <form role="form" method="post" name="add" id="add"><!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="id_area">Area</label>
                                    <select name="id_area" class="chosen-select form-control" id="id_area" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                    <?php
                                        $ticket_tipos_requerimientos=mysqli_query($con, "select * from tickets where id=$id");
                                        $rw_type_area=mysqli_fetch_array($ticket_tipos_requerimientos);
                                        $area_seleccionada=$rw_type_area['area'];

                                        $sql=mysqli_query($con, "select * from area");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['id'] ?>" <?php if($area_seleccionada==$row['id']){echo"selected";} ?>><?php echo $row['name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_requerimiento">Categoría</label>
                                    <select name="tipo_requerimiento" class="chosen-select form-control" id="tipo_requerimiento" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                    <?php
                                    $ticket_tipos_requerimientos=mysqli_query($con, "select * from tickets where id=$id");
                                    $rw_type_category=mysqli_fetch_array($ticket_tipos_requerimientos);
                                    $categoria_id=$rw_type_category['tipo_requerimiento'];

                                        $sql=mysqli_query($con, "select * from tipos_requerimientos");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['id'] ?>" <?php if($categoria_id==$row['id']){echo"selected";} ?>><?php echo $row['name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="asigned_id">Agente: </label>
                                    <select name="asigned_id" class="select2 form-control" id="asigned_id" required >
                                        <option value="">----Seleccione un Agente----</option>
                                        <?php 
                                            // $sql_user=mysqli_query($con,"select * from user where id=$asigned_id");
                                            $sql_user=mysqli_query($con,"select * from usuarios_areas INNER join user on usuarios_areas.user_id=user.id where usuarios_areas.area_id='$area'");
                                                while($rows_us=mysqli_fetch_array($sql_user)){
                                        ?>
                                            <option value="<?php echo $rows_us['id'] ?>"><?php echo $rows_us['name']." ".$rows_us['lastname'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="ticked_id" value="<?php echo $id ?>">
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" id="save_data" class="btn btn-success">Asignar</button>
                                <a class="btn btn-default" href="javascript:history.back()"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
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
            url: "action/addasigned.php",
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
});
</script>