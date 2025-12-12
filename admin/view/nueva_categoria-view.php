<?php 
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    $active13="active";
    include "header.php";
    include "sidebar.php";
    
    if($is_admin!=1){
        print "<script>window.location='?view=dashboard&error';</script>";
    }
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Categorias</h1>
            <ol class="breadcrumb">
                <li><a href="?view=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="?view=categorias"><i class="fa fa-bars"></i> Categorias</a></li>
                <li class="active">Nueva Categoria</li>
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
                            <h3 class="box-title">Nueva Categoria</h3>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="post" name="add" id="add">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="requerimiento">Categoria</label>
                                    <input type="text" name="requerimiento" class="form-control" id="requerimiento" placeholder="Categoría" required="">
                                </div>
                                <div class="form-group">
                                    <label for="area_id">Areas</label>
                                    <select name="area_id" class="chosen-select form-control" id="area_id" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                    <?php
                                        $sql=mysqli_query($con, "select * from area");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="type">Tipo</label>
                                    <select name="type" class="chosen-select form-control" id="type" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                    <?php
                                        $sql=mysqli_query($con, "select * from type");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['idType'] ?>"><?php echo $row['Description'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="impact_id">Impacto</label>
                                    <select name="impact_id" class="form-control" id="impact_id" required >
                                        <option value="">---SELECCIONE---</option>
                                    <?php
                                        $sql=mysqli_query($con, "select * from impact");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['idImpact'] ?>"><?php echo $row['Description'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="urgency_id">Urgencia</label>
                                    <select name="urgency_id" class=" form-control" id="urgency_id" required >
                                  </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="urgency_id">Urgencia</label>
                                    <select name="urgency_id" class="chosen-select form-control" id="urgency_id" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                    <?php
                                        $sql=mysqli_query($con, "select * from urgency");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['idUrgency'] ?>"><?php echo $row['Description'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div> -->
                                <div class="form-group">
                                    <label for="priority_id">Prioridad</label>
                                    <select name="priority_id" class=" form-control" id="priority_id" required >
                                  </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="priority_id">Prioridad</label>
                                    <select name="priority_id" class="chosen-select form-control" id="priority_id" required data-placeholder="-- Seleccionar --" autocomplete="off">
                                        <option value=""></option>
                                    <?php
                                        $sql=mysqli_query($con, "select * from priority");
                                        while ($row=mysqli_fetch_array($sql)) {?>
                                            <option value="<?php echo $row['idPriority'] ?>"><?php echo $row['Description'] ?></option>
                                    <?php
                                        }
                                    ?>
                                  </select>
                                </div> -->
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

<script>
    $( "#add" ).submit(function( event ) {
        if($("#priority_id").val()>0){
            $('#save_data').attr("disabled", true);
             var parametros = $(this).serialize();
                 $.ajax({
                        type: "POST",
                        url: "action/addtyperequire.php",
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
              
              // alert('La prioridad es valida');
        }else{
            alert('La prioridad no es valida!');
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